<?php

class Character
{
	private $GUID;
	private $folder;
	private $system;
	private $event;
	
	public function __construct($folder)
	{
		$this->folder = $folder;
		$this->buildGitRepo($this->folder);
	}
	
	public function getValue($key)
	{
		return file_get_contents(realpath($this->folder.$key));
	}
	
	public function startEvent($message)
	{
		$this->event = array('timestamp' => time(), 'message' => $message);
	}
	
	public function setValue($key, $value)
	{
		if($this->event)
		{
			$filename = realpath($this->folder.$key);
			if($filename && file_exists($filename))
			{
				file_put_contents($filename, $value);
				exec(sprintf('git add "%s"', $filename));
			}
			else
			{
				touch($this->folder.$key);
				Logger::debug(sprintf('Recursing into setValue with key "%s" and value "%s".', $key, $value));
				return $this->setValue($key, $value);
			}
		}
		else
			Logger::error(sprintf('Tried to set key "%s" to value "%s" without an event.', $key, $value));
	}
	
	public function endEvent()
	{
		exec(sprintf('git commit -m %s', escapeshellarg($this->event['message'])));
	}
	
	protected function setName($name)
	{
		return $this->setValue('name', $name);
	}
	
	private function buildGitRepo($folder)
	{
		exec(sprintf('rm -r %s', escapeshellarg($folder)));
		exec(sprintf('mkdir %s', escapeshellarg($folder)));
		chdir($folder);
		exec(sprintf('git init'));
		exec(sprintf('mkdir Class'));
	}
}
