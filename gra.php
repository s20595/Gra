<?php
	require_once ('wiedzmin.php');
	require_once ('potwor.php');
	require_once ('eliksir.php');
	require_once ('funkcje.php');

		$geralt = CreateCharacter(true);
		$potwor = CreateCharacter(false);
		
		do{
			WhoIsFaster($geralt, $potwor);
		}while ($geralt->getHP() > 0 && $potwor->getHP() > 0);