<?php

class Logger
{
	private $instance;
	
	public static function log($logLevel, $message)
	{
		return $this->instance->doLog($logLevel, $message);
	}
	
	public function doLog($logLevel, $message)
	{
		return $this->$logLevel($message);
	}
	
	public function debug($message)
	{
		error_log(sprintf('DEBUG: %s', $message));
	}
	public function info($message)
	{
		error_log(sprintf('INFO: %s', $message));
	}
	public function warn($message)
	{
		error_log(sprintf('WARN: %s', $message));
	}
	public function error($message)
	{
		error_log(sprintf('ERROR: %s', $message));
	}
	public function crit($message)
	{
		error_log(sprintf('CRIT: %s', $message));
	}
}
