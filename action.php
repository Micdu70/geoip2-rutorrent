<?php

require_once( '../../php/util.php' );
eval( getPluginConf( 'geoip2' ) );
require_once( 'ip_db.php' );

$db = new ipDB();
$db->add($_REQUEST["ip"],$_REQUEST["comment"]);

cachedEcho( safe_json_encode( array( "ip"=>$_REQUEST["ip"], "comment"=>$_REQUEST["comment"] ) ), "application/json" );
