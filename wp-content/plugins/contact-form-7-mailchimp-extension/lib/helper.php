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
	
function chimp_html_log_view (){
?>
		<div id="sys-dev"> 
			
  <div id="eventlog-sys" class="highlight" style="margin-top: 1em; margin-bottom: 1em; display: none;">
    <h3>Log Viewer</h3><input id="log_reset" type="button" value="Log Reset" class="button button-primary" style="width:15%;">

			<pre><code id="log_panel" ><?php get_log_array ()  ?></code></pre>

	 </div>

</div> 
<?php	
}
	
	
function mce_html_log_datefilter( $object ) {

		$default = array() ;
		$log = get_option ('mce_db_issues_log', $default  ) ;

		$result = array_column( $log,'dateonly','id' );
		$datesfilter = array_unique( $result ) ;

		var_dump ( $datesfilter );


}



