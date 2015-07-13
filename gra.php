<?php
//Importowanie plików
	require_once ('wiedzmin.php');
	require_once ('potwor.php');
	require_once ('eliksir.php');
	require_once ('funkcje.php');

	//wywołanie funkcji, w której wprowadza się dane do stworzenia obiektu wiedzmin i potwór
		$geralt = CreateCharacter(true);
		$potwor = CreateCharacter(false);
		
	//pętla gry	
		do{
			WhoIsFaster($geralt, $potwor);
		}while ($geralt->getHP() > 0 && $potwor->getHP() > 0);