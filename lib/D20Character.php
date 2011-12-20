<?php

class D20Character extends Character
{
	const CURRENT_HEALTH = 'CurrentHealth';
	
	public function getCurrentHealth()
	{
		return $this->getValue(self::CURRENT_HEALTH);
	}
	
	public function getLevel()
	{
		return 0;
	}
	
	public function levelOne($name, $class, $race, $hp, $skills)
	{
		$this->startEvent('Initial Character Creation');
		$this->setName($name);
		$this->addClassLevel($class);
		$this->setRace($race);
		$this->endEvent();
	}
	
	protected function setRace($race)
	{
		return $this->setValue('race', $race);
	}
	
	protected function addClassLevel($class)
	{
		$newLevel = $this->getLevel() + 1;
		return $this->setValue(sprintf('Class/Level-%02d', $newLevel), $class);
	}
}
