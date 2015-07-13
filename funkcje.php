<?php

	function CreateCharacter ($wiedzmin){
		
		do{
		$points = 300;
		
		if ($wiedzmin)
			echo 'Tworzenie Wiedzmina', PHP_EOL;
		else
			echo 'Tworzenie Potwora', PHP_EOL;
		
		echo 'Wszystkie statystyki nie moga przekraczyc 300 pkt!', PHP_EOL, 'Podaj Szybkosc', PHP_EOL;
		$szybkosc = trim(fgets(STDIN));
		$points -= $szybkosc;
		echo "Podaj Sile (Mozesz jeszcze wykorzystac: $points punktow)", PHP_EOL;
		$sila = trim(fgets(STDIN));
		$points -= $sila;
		echo "Podaj Zrecznosc (Mozesz jeszcze wykorzystac: $points punktow)", PHP_EOL;
		$zrecznosc = trim(fgets(STDIN));
		$points -= $zrecznosc;
		echo "Podaj Zycie (Mozesz jeszcze wykorzystac: $points punktow)", PHP_EOL;
		$zycie = trim(fgets(STDIN));
		$points -= $zycie;
	
		if ($points<0)
			echo 'Uzyles wiecej punktow, niz jest to mozliwe. Zacznij tworzenie postaci od nowa.', PHP_EOL, PHP_EOL;
		else if ($szybkosc <= 0 || $sila <= 0 || $zrecznosc <= 0 || $zycie <= 0)
			echo 'Zle rozdales statystki! Wartosci nie moga byc ujemne lub rowne zero!', PHP_EOL, PHP_EOL;
		else
			break;
		}while(true);
			
		if ($wiedzmin){
			echo 'Tworzenie Wiedzmina zakonczone sukcesem', PHP_EOL, PHP_EOL;
			return new Wiedzmin ($szybkosc, $sila, $zrecznosc, $zycie);
		}
		else{
			echo 'Tworzenie Potwora zakonczone sukcesem', PHP_EOL, PHP_EOL;
			return new Potwor ($szybkosc, $sila, $zrecznosc, $zycie);
		}			
	}
	
	function WhoIsFaster($wiedzmin, $potwor){
		
		if ($wiedzmin->getSpeed() >= $potwor->getSpeed()){
			$wiedzmin->setPunktyAkcji((int)($wiedzmin->getSpeed()/$potwor->getSpeed()));
			$potwor->setPunktyAkcji(1);
			
			Menu ($wiedzmin, $potwor);
			if ($potwor->getHP() > 0)
				AtakPotwora ($wiedzmin, $potwor);
			
		}
		else if ($potwor->getSpeed() > $wiedzmin->getSpeed()){
			$potwor->setPunktyAkcji ((int)($potwor->getSpeed()/$wiedzmin->getSpeed()));
			$wiedzmin->setPunktyAkcji(1);
			echo PHP_EOL, 'Atakuje Potwor z '.$potwor->getPunktyAkcji().' pkt akcji!',PHP_EOL;
			
			AtakPotwora ($wiedzmin, $potwor);
			if ($wiedzmin->getHP() > 0)
				Menu ($wiedzmin, $potwor);
			else
				echo PHP_EOL, PHP_EOL, 'Niestety, potwor Cie zalatwil!', PHP_EOL;
			
		}
	
	}
	
	
	function Menu ($wiedzmin, $potwor){
		
		do{
			if ($potwor->getHP() <= 0){
				echo PHP_EOL, PHP_EOL, 'Brawo! Zmiazdzyles potwora!', PHP_EOL;
				break;
			}
			
			else{
				
				echo 'Posiadasz jeszcze '.$wiedzmin->getPunktyAkcji().' punktow akcji.';
			
				echo PHP_EOL, '1. Atak (1)', PHP_EOL, '2. Stworzenie eliksiru (1 + poziom eliksiru)', PHP_EOL, 
				'3. Wypicie eliksir (1)', PHP_EOL, '4. Obrona (2+)', PHP_EOL, '5. Koniec tury (1+)', PHP_EOL, PHP_EOL;
			
				$menu = trim(fgets(STDIN));
		
				switch ($menu){
					case 1: $wiedzmin->Atak($potwor);
							break;
					
					case 2: 
							$wiedzmin->stworzEliksir();
							break;
					
					case 3: $wiedzmin->wypijEliksir();
							break;
						
					case 4:	$wiedzmin->Obrona();
							break;
						
					case 5: $wiedzmin->setPunktyAkcji(0);
							echo 'Wszystkie Twoje punkty akcji zostaly utracone.', PHP_EOL;
							break;
				}
			}
		}while($wiedzmin->getPunktyAkcji() >= 1);
	}
	
	function AtakPotwora ($wiedzmin, $potwor){
		echo PHP_EOL, 'Potwor dzieki swoim punktom akcji atakuje '.$potwor->getPunktyAkcji().' razy!', PHP_EOL, PHP_EOL;
		
			do{
				if ($wiedzmin->getHP() < 0)
					break;
				
				$potwor->Atak($wiedzmin);
				
			}while($potwor->getPunktyAkcji() > 0);
	}
		
		