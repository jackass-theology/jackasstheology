<?php
/*  Copyright 2013-2017 Renzo Johnson (email: renzojohnson at gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

$plugins = get_option('active_plugins');
$plugchimpmail ='chimpmail/chimpmail.php';

if ( in_array( $plugchimpmail , $plugins ) ) {
    //do_action( 'ep_before_list',$panels);
}else {
  add_filter( 'wpcf7_editor_panels', 'show_mch_metabox' );
  add_action( 'wpcf7_after_save', 'wpcf7_mch_save_mailchimp' );
  add_filter('wpcf7_form_response_output', 'spartan_mce_author_wpcf7', 40,4);
  add_action( 'wpcf7_before_send_mail', 'wpcf7_mch_subscribe_remote' );
  add_filter( 'wpcf7_form_class_attr', 'spartan_mce_class_attr' );
}

resetlogfile_mce(); //para resetear



function wpcf7_mch_add_mailchimp($args) {
  $cf7_mch_defaults = array();
  $cf7_mch = get_option( 'cf7_mch_'.$args->id(), $cf7_mch_defaults );

  $host = esc_url_raw( $_SERVER['HTTP_HOST'] );
  $url = $_SERVER['REQUEST_URI'];
  $urlactual = $url;

  //var_dump($cf7_mch['logfileEnabled']);

  include SPARTAN_MCE_PLUGIN_DIR . '/lib/view.php';

}



function resetlogfile_mce() {

  if ( isset( $_REQUEST['mce_reset_log'] ) ) {

    $mch_debug_logger = new mch_Debug_Logger();

    $mch_debug_logger->reset_mch_log_file( 'log.txt' );
    $mch_debug_logger->reset_mch_log_file( 'log-cron-job.txt' );
    echo '<div id="message" class="updated is-dismissible"><p>Debug log files have been reset!</p></div>';
  }

}



function wpcf7_mch_save_mailchimp($args) {

  if (!empty($_POST)){
    update_option( 'cf7_mch_'.$args->id(), $_POST['wpcf7-mailchimp'] );

  }

}



function show_mch_metabox ( $panels ) {

  $new_page = array(
    'MailChimp-Extension' => array(
      'title' => __( 'MailChimp!', 'contact-form-7' ),
      'callback' => 'wpcf7_mch_add_mailchimp'
    )
  );

  $panels = array_merge($panels, $new_page);

  return $panels;

}



function spartan_mce_author_wpcf7( $mce_supps, $class, $content, $args ) {

  $cf7_mch_defaults = array();
  $cf7_mch = get_option( 'cf7_mch_'.$args->id(), $cf7_mch_defaults );
  $cfsupp = ( isset( $cf7_mch['cf-supp'] ) ) ? $cf7_mch['cf-supp'] : 0;

  if ( 1 == $cfsupp ) {

    $mce_supps .= mce_referer();
    $mce_supps .= mce_author();

  } else {

    $mce_supps .= mce_referer();
    $mce_supps .= '<!-- Chimpmail extension by Renzo Johnson -->';
  }
  return $mce_supps;

}



function cf7_mch_tag_replace( $pattern, $subject, $posted_data, $html = false ) {

  if( preg_match($pattern,$subject,$matches) > 0) {

    if ( isset( $posted_data[$matches[1]] ) ) {
      $submitted = $posted_data[$matches[1]];

      if ( is_array( $submitted ) )
        $replaced = join( ', ', $submitted );
      else
        $replaced = $submitted;

      if ( $html ) {
        $replaced = strip_tags( $replaced );
        $replaced = wptexturize( $replaced );
      }

      $replaced = apply_filters( 'wpcf7_mail_tag_replaced', $replaced, $submitted );

      return stripslashes( $replaced );
    }

    if ( $special = apply_filters( 'wpcf7_special_mail_tags', '', $matches[1] ) )
      return $special;

    return $matches[0];
  }
  return $subject;

}



function wpcf7_mch_subscribe_remote($obj) {
  $cf7_mch = get_option( 'cf7_mch_'.$obj->id() );

  $submission = WPCF7_Submission::get_instance();

  $logfileEnabled = isset($cf7_mch['logfileEnabled']) && !is_null($cf7_mch['logfileEnabled']) ? $cf7_mch['logfileEnabled'] : false;


  if( $cf7_mch ) {
    $subscribe = false;

    $regex = '/\[\s*([a-zA-Z_][0-9a-zA-Z:._-]*)\s*\]/';
    $callback = array( &$obj, 'cf7_mch_callback' );

    $email = cf7_mch_tag_replace( $regex, $cf7_mch['email'], $submission->get_posted_data() );
    $name = cf7_mch_tag_replace( $regex, $cf7_mch['name'], $submission->get_posted_data() );

    $lists = cf7_mch_tag_replace( $regex, $cf7_mch['list'], $submission->get_posted_data() );
    $listarr = explode(',',$lists);

    $merge_vars=array('FNAME'=>$name);// *x1

        // *x2
        $parts = explode(" ", $name);
        if(count($parts)>1) { // *x3

          $lastname = array_pop($parts);
          $firstname = implode(" ", $parts);
          $merge_vars=array('FNAME'=>$firstname, 'LNAME'=>$lastname);

        } else { // *x4

          $merge_vars=array('FNAME'=>$name);// *x5

        }


    if( isset($cf7_mch['accept']) && strlen($cf7_mch['accept']) != 0 ) {

      $accept = cf7_mch_tag_replace( $regex, $cf7_mch['accept'], $submission->get_posted_data() );

      if($accept != $cf7_mch['accept']) {
        if(strlen($accept) > 0)
          $subscribe = true;
      }

    } else {

      $subscribe = true;

    }

    for($i=1;$i<=20;$i++){

      if( isset($cf7_mch['CustomKey'.$i]) && isset($cf7_mch['CustomValue'.$i]) && strlen(trim($cf7_mch['CustomValue'.$i])) != 0 ) {

        $CustomFields[] = array('Key'=>trim($cf7_mch['CustomKey'.$i]), 'Value'=>cf7_mch_tag_replace( $regex, trim($cf7_mch['CustomValue'.$i]), $submission->get_posted_data() ) );
        $NameField=trim($cf7_mch['CustomKey'.$i]);
        $NameField=strtr($NameField, "[", "");
        $NameField=strtr($NameField, "]", "");
        $merge_vars=$merge_vars + array($NameField=>cf7_mch_tag_replace( $regex, trim($cf7_mch['CustomValue'.$i]), $submission->get_posted_data() ) );
      }

    }

    if( isset($cf7_mch['confsubs']) && strlen($cf7_mch['confsubs']) != 0 ) {

      $mce_csu = 'pending';

    } else {

      $mce_csu = 'subscribed';

    }

    if($subscribe && $email != $cf7_mch['email']) {

      try {

        $cad_mergefields = "";
        $cuentarray = count($merge_vars);

        //Armando mergerfields
        foreach($merge_vars as $clave=>$valor) {
            $cadvar= '"'.$clave.'":"' .$valor. '", ';
            $cad_mergefields = $cad_mergefields . $cadvar ;
        }

        $cad_mergefields = substr($cad_mergefields,0,strlen($cad_mergefields) -2);


        // rj tests
        // ================================================================
        $api   = $cf7_mch['api'];
        $dc    = explode( "-", $api );
        $urlmcv3 = "https://anystring:$dc[0]@$dc[1].api.mailchimp.com/3.0";
        $list  = $lists;
        $vc_date = date( 'Md.H:i' );
        $vc_user_agent = '.' . SPARTAN_MCE_VERSION . '.' . strtolower( $vc_date );  // rj
        $vc_headers = array( "Content-Type" => "application/json" ) ;


        // 1
        // ================================================================
        $url_get_merge_fields = "$urlmcv3/lists/$list/merge-fields";  //// $urlmcv3
        $opts = array(
                  'headers' => $vc_headers,
                  'user-agent' => 'mce-r' . $vc_user_agent
                );

        $mergerfield = wp_remote_get( $url_get_merge_fields, $opts );
        $resultbody = wp_remote_retrieve_body( $mergerfield );
        $arraymerger = json_decode( $resultbody, True );

        $campreque = array_column($arraymerger['merge_fields'],'required','merge_id'); // arr de req campos

          foreach($campreque as $clave=>$valor) {

              if ($valor) {
                  $cadreq = '{"required":false}';
                  $url_edit   = "$urlmcv3/lists/$list/merge-fields/$clave"; //// $urlmcv3

                  $opts = array(
                            'method' => 'PATCH',
                            'headers' => $vc_headers,
                            'body' => $cadreq,
                            'user-agent' => 'mce-h' . $vc_user_agent
                          );

                  $resptres = wp_remote_post( $url_edit, $opts );

              }

          }


        // 2
        // ================================================================
        $url_put   = "$urlmcv3/lists/$list";  //// $urlmcv3
        $info  = '{"members": [

                    { "email_address": "'.$email.'",
                      "status": "'.$mce_csu.'",
                      "merge_fields":{ '.$cad_mergefields.' }
                    }

                  ],
                  "update_existing": true}';

        $opts = array(
                  'method' => 'POST',
                  'headers' => $vc_headers,
                  'body' => $info,
                  'user-agent' => 'mce-p' . $vc_user_agent
                );

        $respenvio = wp_remote_post( $url_put, $opts );
        $resp = wp_remote_retrieve_body( $respenvio );
        // $respArr = json_decode( $resultbody,true);

        mce_save_contador();

        $mch_debug_logger = new mch_Debug_Logger();
        $mch_debug_logger->log_mch_debug( 'Contact Form 7 response: Mail sent OK | MailChimp.com response: ' . $resp , 1 , $logfileEnabled );


      } // end try

      catch (Exception $e) {

        $mch_debug_logger = new mch_Debug_Logger();
        $mch_debug_logger->log_mch_debug( 'Contact Form 7 response: ' . $e->getMessage(), 4, $logfileEnabled );

      }  // end catch


    } // end $subscribe

  }

}



function mce_save_contador() {
  $option_name = 'mce_sent' ;
  $new_value = 1 ;
  $valorvar = get_option( $option_name );

  if ( $valorvar !== false ) {

    update_option( $option_name, $valorvar + 1 );

  } else {

    $deprecated = null;
    $autoload = 'no';
    add_option( $option_name, $new_value, $deprecated, $autoload );

  }

}



function mce_get_contador() {
  $option_name = 'mce_sent' ;
  $new_value = 1 ;

  $valorvar = get_option( $option_name );

  if ( $valorvar !== false ) {

    echo 'Contador: '.$valorvar;

  } else {

    echo 'Contador: 0' ;

  }

}



function vc_post( $url, $info, $method = 'POST', $adminEmail = false ){// primary function

  if(ini_get('allow_url_fopen')){// test for allow_url_fopen

    return cf7mce_use_fopen( $url, $info, $method );

  } elseif (in_array('curl',get_loaded_extensions())){// test for cURL

    return cf7mce_use_curl( $url, $info, $method );

  } else { // neither method is available, send mail

    if( !$adminEmail ){ $adminEmail = get_bloginfo( 'admin_email' ); }
    return cf7mce_use_wpmail($url,$info,$method,$adminEmail);

  }

}



function cf7mce_use_fopen( $url, $info, $method ){

  $vc_date = date('M.d.H.i');
  $data = array(
    'http' => array(

      'method'  => $method,
      'content' => $info,
      'header'  => array( 'content-type: application/x-www-form-urlencoded', 'user-agent: mce.P.'. SPARTAN_MCE_VERSION . $vc_date . '_' )

    )
  );
  return stream_get_contents(fopen($url,'rb',0,stream_context_create($data)));

}



function cf7mce_use_curl($url,$info,$method){

  $vc_date = date('M.d.H.i');
  $useragent = 'mce.C.'. SPARTAN_MCE_VERSION . $vc_date . '_';

  $apikey = explode(':',$url);
  $apikey1 = explode('@',$apikey[2]);
  $apikey = $apikey1[0];// api key only - no dash or dc

  $dc = $apikey1[1];
  $dc1 = explode('.',$dc);
  $dc = $dc1[0];

  $shortURL = array_shift($dc1);
  $shortURL = implode('.',$dc1);
  $shortURL = 'https://'.$shortURL;

  $originalAPIkey = $apikey .'-'. $dc;
  $apikey = $originalAPIkey;
  $auth = base64_encode( 'anystring:'. $apikey );
  $shortURL =$url;
  //return "###--apikey=$apikey|--shortUrl=$shortURL|--URL=$url###";
  if($method == 'POST'){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $shortURL);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Basic '.$auth));
    curl_setopt($ch, CURLOPT_USERAGENT, '' . $useragent . '');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $info);
    return curl_exec($ch);

  } elseif($method == 'GET'){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $shortURL);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Basic '. $auth));
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $info);


    return curl_exec($ch);

  } else {

    return 'Be sure to use only POST or GET as 3rd parameter';

  }

}



function cf7mce_use_wpmail($url,$info,$method,$adminEmail){
  $msg = "Attempted to send ".$info." to ".$url." but server doesnt support allow_url_fopen OR cURL";
  $wp_mail_resp = wp_mail( $adminEmail,'CF7 Mailchimp Extension Problem',$msg);
    if($wp_mail_resp){
      return 'allow_url_fopen & cURL not available, sent details to ' . $adminEmail;
    }else{
      return 'ERROR: Problem with allow_url_fopen/cURL/wp_mail';
    }
}



function spartan_mce_class_attr( $class ) {

  $class .= ' mailchimp-ext-' . SPARTAN_MCE_VERSION;
  return $class;

}

if (! function_exists('array_column')) {
    function array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if ( !array_key_exists($columnKey, $value)) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            }
            else {
                if ( !array_key_exists($indexKey, $value)) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
}
