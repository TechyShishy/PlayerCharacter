<?php
include("lib/Logger.php");
include("lib/Player.php");
include("lib/Character.php");
include("lib/D20Character.php");
$x = new Player();
$y = new D20Character('/dev/shm/d20test/');
$y->levelOne("Marketh", "Paladin", "Human", 15, array());
$x->addCharacter($y);
var_dump($x);
passthru('git log');
