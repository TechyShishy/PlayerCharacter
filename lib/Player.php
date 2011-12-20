<?php

class Player
{
	private $email;
	private $username;
	private $characters = array();
	
	public function getCharacter($charId)
	{
		if(!empty($this->characters[$charId]))
			return $this->characters[$charId];
		else
			return false;
	}
	public function addCharacter(Character $character)
	{
		$this->characters[$this->newCharId()] = $character;
	}
	
	protected function newCharId()
	{
		return count($this->characters) ? max(array_keys($this->characters)) + 1 : 0;
	}
}
