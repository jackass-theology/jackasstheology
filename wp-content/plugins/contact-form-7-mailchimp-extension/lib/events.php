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


function vc_gaParseCookie() {

	if (isset($_COOKIE['_ga'])) {
		list($version, $domainDepth, $cid1, $cid2) = explode('.', $_COOKIE["_ga"], 4);
		$contents = array('version' => $version, 'domainDepth' => $domainDepth, 'cid' => $cid1 . '.' . $cid2);
		$cid = $contents['cid'];
	} else {
		$cid = vc_gaGenerateUUID();
	}
	return $cid;

}


function vc_gaGenerateUUID() {

	return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		mt_rand(0, 0xffff), mt_rand(0, 0xffff),
		mt_rand(0, 0xffff),
		mt_rand(0, 0x0fff) | 0x4000,
		mt_rand(0, 0x3fff) | 0x8000,
		mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
	);

}


function vc_gaSendData($data) { //https://developers.google.com/analytics/devguides/collection/protocol/v1/devguide#event

	$getString = 'https://ssl.google-analytics.com/collect';
	$getString .= '?payload_data&';
	$getString .= http_build_query($data);
	$result = wp_remote_get($getString);
  //$result = file_get_contents($getString);
	return $result;

}


function vc_ga_send_pageview($hostname=null, $page=null, $title=null) { //Send Pageview Function for Server-Side Google Analytics

	$data = array(
		'v' => 1,
		'tid' => 'UA-3140900-24',
		'cid' => vc_gaParseCookie(),
		't' => 'pageview',
		'dh' => $hostname, //Document Hostname "renzojohnson.com"
		'dp' => $page, //Page "/something"
		'dt' => $title //Title
	);
	return vc_gaSendData($data);

}


function vc_ga_send_event($category=null, $action=null, $label=null) { //Send Event Function for Server-Side Google Analytics

	$data = array(
		'v' => 1,
		'tid' => 'UA-3140900-24', //@TODO: Change this to your Google Analytics Tracking ID.
		'cid' => vc_gaParseCookie(),
		't' => 'event',
		'ec' => $category, //Category (Required)
		'ea' => $action, //Action (Required)
		'el' => $label //Label
	);
	return vc_gaSendData($data);

}