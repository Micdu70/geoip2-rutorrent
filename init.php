<?php

if($theSettings->isPluginRegistered("geoip"))
	$jResult .= "plugin.disable();";
else
{
	require_once( "sqlite.php" );

	eval( getPluginConf( $plugin["name"] ) );

	$retrieveCountry = ($retrieveCountry && PHP_VERSION_ID >= 50400 && extension_loaded('phar'));
	$retrieveComments = ($retrieveComments && sqlite_exists());

	if( $retrieveHost || $retrieveCountry || $retrieveComments )
	{
		$theSettings->registerPlugin($plugin["name"],$pInfo["perms"]);
		if($retrieveCountry)
			$jResult .= "plugin.retrieveCountry = true;";
		if($retrieveHost)
			$jResult .= "plugin.retrieveHost = true;";
		if($retrieveComments)
			$jResult .= "plugin.retrieveComments = true;";
	}
	else
		$jResult .= "plugin.disable();";
}
