<?php

use GeoIp2\Database\Reader;

if($theSettings->isPluginRegistered("geoip"))
	$jResult .= "plugin.disable();";
else
{
	require_once( "sqlite.php" );

	eval( getPluginConf( $plugin["name"] ) );

	$retrieveCountry = ($retrieveCountry && version_compare(PHP_VERSION, '5.4.0', '>=') && extension_loaded('phar'));
	if($retrieveCountry)
	{
		require_once 'geoip2.phar';

		$cityDbFile = $rootPath.'/plugins/geoip2/database/GeoLite2-City.mmdb';
		$countryDbFile = $rootPath.'/plugins/geoip2/database/GeoLite2-Country.mmdb';

		try{
			if(is_file($cityDbFile) && is_readable($cityDbFile))
				$reader = new Reader($cityDbFile);
			else
			{
				if(is_file($countryDbFile) && is_readable($countryDbFile))
					$reader = new Reader($countryDbFile);
				else
				{
					$retrieveCountry = false;
					$jResult .= "plugin.showError('theUILang.databaseNotFound');";
				}
			}
		} catch(Exception $e){$retrieveCountry = false; $jResult .= "plugin.showError('theUILang.databaseError');";}
	}
	$retrieveComments = ($retrieveComments && sqlite_exists());

	if( $retrieveCountry || $retrieveHost || $retrieveComments )
	{
		$theSettings->registerPlugin($plugin["name"], $pInfo["perms"]);
		if($retrieveCountry)
			$jResult .= "plugin.retrieveCountry = true;";
		if($retrieveComments)
			$jResult .= "plugin.retrieveComments = true;";
	}
	else
		$jResult .= "plugin.disable();";
}
