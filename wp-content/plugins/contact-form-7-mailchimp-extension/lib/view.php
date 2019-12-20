<?php
/*  Copyright 2013-2019 Renzo Johnson (email: renzojohnson at gmail.com)

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


function vc_utm() {

  global $wpdb;

  $utms  = '?utm_source=MailChimp';
  $utms .= '&utm_campaign=w' . get_bloginfo( 'version' ) . '-' . mce_difer_dateact_date() . 'c' . WPCF7_VERSION . ( defined( 'WPLANG' ) && WPLANG ? WPLANG : 'en_US' ) . '';
  $utms .= '&utm_medium=cme-' . SPARTAN_MCE_VERSION . '';
  $utms .= '&utm_term=P' . PHP_VERSION . 'Sq' . $wpdb->db_version() . '-';
  // $utms .= '&utm_content=';
  return $utms;
}

function mce_panel_gen ($apivalid,$listdata,$cf7_mch,$listatags,$mce_txcomodin) {
  ?>
   <div class="mystery">

    <input type="hidden" id="mce_txtcomodin" name="wpcf7-mailchimp[mce_txtcomodin]" value="<?php echo( isset( $mce_txcomodin ) ) ? esc_textarea( $mce_txcomodin ) : ''; ?>" style="width:0%;" />
    <div class="mce-custom-fields">
      <div class="mail-field">
        <div id="mce_panel_listamail" >

            <?php mce_html_panel_listmail( $apivalid, $listdata, $cf7_mch); // Get listas ?>

        </div>
        <small class="description">Hit the Connect button to load your lists <a href="https://chimpmatic.com/how-to-find-your-mailchimp-api-key<?php echo vc_utm() ?>MC-list-id" class="helping-field" target="_blank" title="get help with MailChimp List ID:"> Read More <span class="red-icon dashicons dashicons-admin-links"></span></a></small>
      </div>
    </div>

    <div class="mce-custom-fields">
      <div class="mail-field md-half">
        <label for="wpcf7-mailchimp-email"><?php echo esc_html( __( 'Subscriber Email: *|EMAIL|* ', 'wpcf7' ) ); ?> <span class="mce-required" > Required</span></label><br />
         <?php mce_html_selected_tag ('email',$listatags,$cf7_mch,'email') ;  ?>
        <small class="description">MUST be an email tag <a href="<?php echo MCE_URL ?>/mailchimp-contact-form<?php echo vc_utm() ?>MC-email" class="helping-field" target="_blank" title="get help with Subscriber Email:"> Read More <span class="red-icon dashicons dashicons-admin-links"></span></a></small>
      </div>

      <div class="mail-field md-half">
        <label for="wpcf7-mailchimp-name"><?php echo esc_html( __( 'Subscriber Name - *|FNAME|* ', 'wpcf7' ) ); ?></label><br />
         <?php mce_html_selected_tag ('name',$listatags,$cf7_mch,'text') ; ?>
        <small class="description"> This may be sent as Name <a href="<?php echo MCE_URL ?>/mailchimp-contact-form<?php echo vc_utm() ?>MC-name" class="helping-field" target="_blank" title="get help with Subscriber name:"> Read More <span class="red-icon dashicons dashicons-admin-links"></span></a></small>
      </div>
    </div>

    <div class="mce-custom-fields holder-img">
      <a href="https://chimpmatic.com?utm_source=ChimpMatic&utm_campaign=Groups-img" target="_blank" title="ChimpMatic Pro Options"><img src="/wp-content/plugins/contact-form-7-mailchimp-extension/assets/images/ChimpMatic-lite-groups-options.png" alt="ChimpMatic Pro Options" title="ChimpMatic Pro Options"></a>
    </div>

  </div>


<?php
}

?>


<div class="mce-main-fields pos-rel" data-info="6283ef9bdef6755f8fe686ce53bdf75a-us4">

  <a href="http://bit.ly/latte4renzo" class="dops-button is-primary donate-2019" target="_blank">DONATE</a>

  <div id="mce_apivalid">
    <h2>ChimpMatic <span class="cm-lite">Lite</span>  <?php echo isset( $apivalid ) && '1' == $apivalid ? $chm_valid : $chm_invalid ; ?> <span class="mc-code"><?php global $wpdb; $mce_sents = get_option( 'mce_sent'); echo SPARTAN_MCE_VERSION . 'CF7:' . WPCF7_VERSION . 'WP' . get_bloginfo( 'version' ) . 'P' . PHP_VERSION . 'S' . $wpdb->db_version() .' - ' . $mce_sents .  ' sent in ' .  mce_difer_dateact_date(); ?></span></h2>

  </div>

  <div class="mce-custom-fields">

    <label for="wpcf7-mailchimp-api"><?php echo esc_html( __( 'MailChimp API Key:', 'wpcf7' ) ); ?> </label><br />
    <input type="text" id="wpcf7-mailchimp-api" name="wpcf7-mailchimp[api]" class="wide" size="50" placeholder="9283ef9bdef6755f8fe686ce53bdf75a-us4..." value="<?php echo (isset($cf7_mch['api']) ) ? esc_attr( $cf7_mch['api'] ) : ''; ?>" />

    <span><input id="mce_activalist" type="button" value="Connect and Fetch Your Mailing Lists" class="button button-primary" style="width:35%;" /><span class="spinner"></span></span>

    <small class="description need-api"><a href="https://chimpmatic.com/how-to-find-your-mailchimp-api-key<?php echo vc_utm() ?>MC-api" class="helping-field" target="_blank" title="get help with MailChimp API Key:"> Find your Mailchimp API here <span class="red-icon dashicons dashicons-arrow-right"></span><span class="red-icon dashicons dashicons-arrow-right"></span></a></small>


    <div id="chmp-new-user" class="new-user <?php echo ( ( $apivalid == 1  ) ? 'chmp-inactive' : 'chmp-active' ) ;  ?>">

      <?php  chmp_new_usr(); ?>

    </div>

    <div id="mce_panel_ajagen" class="<?php echo ( ( $apivalid == 1  ) ? 'chmp-active' : 'chmp-inactive' ) ;  ?>">
        <?php  mce_panel_gen ($apivalid,$listdata,$cf7_mch,$listatags,$mce_txcomodin) ;    ?>
    </div>


    <div id="cme-container" class="cme-container mce-support" style="display:none">

        <div class="mailchimp-custom-fields">
          <p>In the following fields, you can use these mail-tags: <?php echo mce_mail_tags(); ?>.</p>

          <?php for($i=1;$i<=10;$i++){ ?>
          <div>

            <div class="col-6">
              <label for="wpcf7-mailchimp-CustomValue<?php echo $i; ?>"><?php echo esc_html( __( 'Contact Form [mail-tag] '.$i.':', 'wpcf7' ) ); ?></label><br />
              <input type="text" id="wpcf7-mailchimp-CustomValue<?php echo $i; ?>" name="wpcf7-mailchimp[CustomValue<?php echo $i; ?>]" class="wide" size="70" placeholder="[your-mail-tag]" value="<?php echo (isset( $cf7_mch['CustomValue'.$i]) ) ?  esc_attr( $cf7_mch['CustomValue'.$i] ) : '' ;  ?>" />
            </div>


            <div class="col-6">
              <label for="wpcf7-mailchimp-CustomKey<?php echo $i; ?>"><?php echo esc_html( __( 'MailChimp field name or *|MERGE|* tag '.$i.':', 'wpcf7' ) ); ?> <a href="<?php echo MCE_URL ?>/mailchimp/mailchimp-list-fields-and-merge-tags<?php echo vc_utm() ?>MC-custom-fields" class="helping-field" target="_blank" title="get help with Custom Fields"> Help <span class="red-icon dashicons dashicons-sos"></span></a></label><br />
              <input type="text" id="wpcf7-mailchimp-CustomKey<?php echo $i; ?>" name="wpcf7-mailchimp[CustomKey<?php echo $i; ?>]" class="wide" size="70" placeholder="MERGE<?php echo $i+2;?>" value="<?php echo (isset( $cf7_mch['CustomKey'.$i]) ) ?  esc_attr( $cf7_mch['CustomKey'.$i] ) : '' ;  ?>" />
            </div>

          </div>
          <?php } ?>
        </div><!-- /.mailchimp-custom-field -->


        <?php include SPARTAN_MCE_PLUGIN_DIR . '/lib/parts/tanu.php'; ?>


   </div>


  <div class="<?php echo ( ( $apivalid == 1  ) ? 'chmp-active' : 'chmp-inactive' ) ;  ?>">
  <p class="p-author"><a type="button" aria-expanded="false" class="mce-trigger a-support ">Show advanced settings</a> &nbsp; <a class="cme-trigger-sys a-support ">Get System Information</a> &nbsp; <a class="cme-trigger-log a-support ">Management View Log</a></p>
  </div>

  <?php include SPARTAN_MCE_PLUGIN_DIR . '/lib/system.php'; ?>

  <?php  echo chimp_html_log_view() ; ?>

  <div class="dev-cta mce-cta welcome-panel" style="display: none;">

    <div class="welcome-panel-content">
        <?php echo mce_set_welcomebanner() ; ?>
    </div>

  </div>



</div>

<!--
    <div id="informationdiv_aux" class="postbox mce-move mc-lateral">
      <h3>ChimpMatic is Here!</h3>
      <div class="inside">
        <p>We have the the best tool to integrate Contact Form 7 with your Chimpmail mailing lists with nifty features:</p>
        <ol>
          <li><a href="https://chimpmatic.com" target="_blank">Groups / Categories</a></li>
          <li><a href="https://chimpmatic.com" target="_blank">Unlimited Fileds</a></li>
          <li><a href="https://chimpmatic.com" target="_blank">Unlimited Audiences</a></li>
          <li><a href="https://chimpmatic.com" target="_blank">Great Pricing Options</a></li>
        </ol>
        <p><a href="https://chimpmatic.com" class="dops-button is-primary" target="_blank">Read More</a></p>
      </div>
    </div> -->
</div>
<?php echo mce_lateral_banner () ?>



