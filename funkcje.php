<?php
//wrowadzanie danych dla danej postaci.
//jesli funkcja jest wywyołana jako "true" tworzymy wiedzmina, a jak "false" to potwora
	function CreateCharacter ($wiedzmin){
		
		do{
		$points = 300;
		
		if ($wiedzmin)
			echo 'Tworzenie Wiedzmina', PHP_EOL;
		else
			echo 'Tworzenie Potwora', PHP_EOL;
		
		echo 'Wszystkie statystyki nie moga przekraczyc 300 pkt!', PHP_EOL, 'Podaj Szybkosc', PHP_EOL;
		$szybkosc = trim(fgets(STDIN));     //wcztywanie wartości z konsoli
		$points -= $szybkosc;               //odejmowanie podanej wartości od maksymalnej ilości możliwych punktów
		echo "Podaj Sile (Mozesz jeszcze wykorzystac: $points punktow)", PHP_EOL;
		$sila = trim(fgets(STDIN));
		$points -= $sila;
		echo "Podaj Zrecznosc (Mozesz jeszcze wykorzystac: $points punktow)", PHP_EOL;
		$zrecznosc = trim(fgets(STDIN));
		$points -= $zrecznosc;
		echo "Podaj Zycie (Mozesz jeszcze wykorzystac: $points punktow)", PHP_EOL;
		$zycie = trim(fgets(STDIN));
		$points -= $zycie;
	
	//warunek zabezpiecza przed wykorzystaniem większej ilości punktów
		if ($points<0)
			echo 'Uzyles wiecej punktow, niz jest to mozliwe. Zacznij tworzenie postaci od nowa.', PHP_EOL, PHP_EOL;
		else if ($szybkosc <= 0 || $sila <= 0 || $zrecznosc <= 0 || $zycie <= 0)     //nie można zostawić któregoś parametru z 0 wartością
			echo 'Zle rozdales statystki! Wartosci nie moga byc ujemne lub rowne zero!', PHP_EOL, PHP_EOL;
		else
			break;
		}while(true);         //pętla z zawsze prawdziwym warunkiem - wychodzi się z niej gdy nie zostanie wykorzystane więcej punktów niż to możliwe
	
	//zwracanie nowego obiektu klasy Wiedźmin z podanymi wartościami	
		if ($wiedzmin){
			echo 'Tworzenie Wiedzmina zakonczone sukcesem', PHP_EOL, PHP_EOL;
			return new Wiedzmin ($szybkosc, $sila, $zrecznosc, $zycie);
		}
	//zwracanie nowego obiektu klasy Potówr z podanymi wartościami
		else{
			echo 'Tworzenie Potwora zakonczone sukcesem', PHP_EOL, PHP_EOL;
			return new Potwor ($szybkosc, $sila, $zrecznosc, $zycie);
		}			
	}
		function WhoIsFaster($wiedzmin, $potwor){
		
		if ($wiedzmin->getSpeed() >= $potwor->getSpeed()){                              //jeśli wiedźmin jest szybszy od potwora
			$wiedzmin->setPunktyAkcji((int)($wiedzmin->getSpeed()/$potwor->getSpeed()));//przypisuje ilość punktów akcji (parsowanie na int (liczby całkowite))
			$potwor->setPunktyAkcji(1);                                                 //potwór dostaje jeden punkt akcji
			
			Menu ($wiedzmin, $potwor);                                                  //wywołanie funkcji menu
			if ($potwor->getHP() > 0)                                                   //sprawdza,czy potwór nie zginął
				AtakPotwora ($wiedzmin, $potwor);                                       //wywołanie funkcji AtakPotwora
			
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
	
	//menu gry
	function Menu ($wiedzmin, $potwor){
		
		do{
			if ($potwor->getHP() <= 0){      //warunek zabezpieczający wykonanie akcji po śmierci potwora
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
		}while($wiedzmin->getPunktyAkcji() >= 1);              //pętla wykonująca się dopóki Wiedźmin ma punkty akcji (wiedźmin / gracz)
	}
	//funkcja odpowiedzialna za atak potwora
	function AtakPotwora ($wiedzmin, $potwor){
		echo PHP_EOL, 'Potwor dzieki swoim punktom akcji atakuje '.$potwor->getPunktyAkcji().' razy!', PHP_EOL, PHP_EOL;
		
			do{
				if ($wiedzmin->getHP() < 0)
					break;
				
				$potwor->Atak($wiedzmin);
				
			}while($potwor->getPunktyAkcji() > 0);
	}
		
		