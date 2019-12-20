<?php
/**
*
* @version       0.1
* @author        Chimpmatic LLC https://chimpmatic.com - fer coss
* @copyright     Copyright (c) 2013-2019 Chimpmatic LLC (help@chimpmatic.com)
* @package       Chimpmatic
* @license       Copyright (c) Renzo Johnson
* 
*/


class chimp_db_log {
	
		// Atributos
    public $form;
    public $debug_enabled;
		public $category ;
		public $idform ;
  	
		public function __construct( $form, $debug_enabled, $category, $idform = ''   ) {

			$this->form = $form; 
			$this->debug_enabled = $debug_enabled ;
			$this->category = $category ; 
			$this->idform = $idform ; 

		}
	
		public function chimp_log_insert_db ( $mstype, $content, $object ) {

			if ( !$this->debug_enabled ) return ; 

			$form = $this->form  ;

			$default = array() ;
			$master_error = get_option ( $form.'_log', $default ) ;
			$master_error = is_null ( $master_error ) ? array() :  $master_error ;
			
			//error_log ( print_r ( $master_error,true ) ) ;
			
			$maxarray = count ( $master_error  ) + 1 ;
			//error_log ( print_r ( 'cuenta :' . $maxarray  ) ) ;

			$serror_log  = array(
					'id'  => uniqid(),
					'idform' => $this->idform,
					'category' => $this->category,
					'mstype' => $mstype,
					'date' => getdate(),       
					'datetxt' => date('m/d/y H:i:s'),
					'dateonly' => date('m/d/y'),
					'timestamp' => current_time ('timestamp'),
					'content' => $content,
					'object' => $object
					) ;

			if ( $maxarray == 1 )
				$master_error = array( $maxarray => $serror_log ) ;
			else 
				$master_error = $master_error + array( $maxarray => $serror_log ) ;
			
			if ( !get_option ( $form.'_log' ) ) {
				//	error_log ( 'Entra al log Add'  ) ; 
					$deprecated = null;
      		$autoload = 'no';
      		add_option( $form.'_log', $master_error, $deprecated, $autoload );
				
			} else {
				//	error_log ( 'Entra al log Up'  ) ; 				
				  update_option ( $form.'_log' , $master_error  ) ;
			}
						
			//error_log ( print_r ( $master_error,true )  ) ;
			
			$master_save = get_option ( $form.'_log' ) ;
									
			
		}
	
		public function chimp_log_delete_db () {
			$form = $this->form.'_log'   ;
			 
			//error_log ( $form  ) ;
			$result = delete_option ( $form ) ;
			return $result ;
		} 
	
	
}