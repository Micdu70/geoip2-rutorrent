<?php

function sqlite_exists()
{
	return( (version_compare(PHP_VERSION, '5.4.0', '<')) ? function_exists("sqlite_open") : class_exists("SQLite3") );
}

function sqlite_open1($filename, $mode = 0666, &$error_msg)
{
	if (version_compare(PHP_VERSION, '5.4.0', '<'))
	{
		$dbhandle = sqlite_open($filename, $mode, $error_msg);
	}
	else
	{
		try
		{
			$dbhandle = new SQLite3($filename);
		}
		catch (Exception $exception)
		{
			$error_msg = $exception->getMessage();
		}
	}
	return $dbhandle;
}

function sqlite_close1($dbhandle)
{
	if (version_compare(PHP_VERSION, '5.4.0', '<'))
	{
		sqlite_close($dbhandle);
	}
	else
	{
		$dbhandle->close();
	}
}

function sqlite_exec1($dbhandle, $query, &$error_msg)
{
	if (version_compare(PHP_VERSION, '5.4.0', '<'))
	{
		@sqlite_exec($dbhandle, $query, $error_msg);
	}
	else
	{
		try
		{
			@$dbhandle->exec($query);
		}
		catch (Exception $exception)
		{
			$error_msg = $exception->getMessage();
		}
	}
}

function sqlite_query1($dbhandle, $query, &$error_msg)
{
	$result = '';
	if (version_compare(PHP_VERSION, '5.4.0', '<'))
	{
		$res = sqlite_unbuffered_query($dbhandle, $query, SQLITE_ASSOC, $error_msg);
		if($res!==false)
			$result = strval(sqlite_fetch_single($res));
	}
	else
	{
		try
		{
			$result = strval($dbhandle->querySingle($query));
		}
		catch (Exception $exception)
		{
			$error_msg = $exception->getMessage();
		}
	}
	return $result;
}

function sqlite_escape_string1($item)
{
	return( (version_compare(PHP_VERSION, '5.4.0', '<')) ? sqlite_escape_string($item) : SQLite3::escapeString($item) );
}

function sqlite_db_name()
{
	return( (version_compare(PHP_VERSION, '5.4.0', '<')) ? "peers.dat" : "peers3.dat" );
}
