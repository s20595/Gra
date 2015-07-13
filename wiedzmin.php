<?php
//klasa wiedzmin która dziedziczy po klasie postac
require_once ('postac.php');
	
	class Wiedzmin extends Postac{
//klasa wiedzmin posiada dwa dodatkowe pola "ekwiunek" oraz "ilośc eliksirów"
		protected $ekwipunek = [];
		protected $iloscEliksirow = 0;
	
	
	//---------------- GET / SET -------------------
		public function setDefense($value){
			$this->obrona = $value;
		}

	
	//----------------- FUNKCJE -------------------
	
		//funkcja tworząca eliksir
		public function stworzEliksir (){
		
		if ($this->getPunktyAkcji() > 1)
		{
		// losuje tak długo, póki nie wylosuje liczby mniejszej od liczby posiadanych punktów akcji
		// gdyby nie znak "=" mógłby przekroczyć liczbę posiadanych punktów akcji (1 punkt schodzi na samo tworzenie eliksiru)
		
			do{
				$poziom = rand(1,3);
			}while($poziom>=$this->getPunktyAkcji());		
				switch (rand(1,3)){
					case 1: $this->ekwipunek[$this->iloscEliksirow][0] = new EliksirZycia($poziom);  //tworzenie nowego obiektu klasy eliksiru danego rodzaju i wylosowanego poziomu
							$this->ekwipunek[$this->iloscEliksirow][1] = "Eliksir Zycia ($poziom)";
							$this->iloscEliksirow+=1;
							break;
			
					case 2: $this->ekwipunek[$this->iloscEliksirow][0] = new EliksirSily($poziom);
							$this->ekwipunek[$this->iloscEliksirow][1] = "Eliksir Sily ($poziom)";
							$this->iloscEliksirow+=1;
							break;
				
					case 3: $this->ekwipunek[$this->iloscEliksirow][0] = new EliksirSzybkosci($poziom);
							$this->ekwipunek[$this->iloscEliksirow][1] = "Eliksir Szybkosci ($poziom)";
							$this->iloscEliksirow+=1;
							break;			
				}
			
			$this->setPunktyAkcji($this->getPunktyAkcji()-(1+$poziom));    //odjęcie punktów akcji (1 punkt za stworzenie eliksiru + od 1 do 3 punktów za poziom eliksiru)
		}
		
		else
			echo 'Masz za malo punktow akcji, zeby stworzyc eliksir!', PHP_EOL;
		}
		//fukncja odowiedzialna za wypicie eliksiru
		public function wypijEliksir (){
			
			if ($this->iloscEliksirow > 0){  //jeśli w ekwipunku znajdują się jakieś eliksiry to je wyświetla
			
			//funkcja sprawdza ilośc punktów akcji oraz poprawnośc wyboru
				echo 'Jaki eliksir chcesz wypic?', PHP_EOL;
				for ($i = 0; $i<$this->iloscEliksirow; $i++)
					if (isset($this->ekwipunek[$i]))         //sprawdza, czy w ekwipunku znajduje się obiekt 
						echo "$i. ".$this->ekwipunek[$i][1], PHP_EOL;

				$wybor = trim(fgets(STDIN));
				
				if ($wybor >= 0 && $wybor<=$i){
					$this->ekwipunek[$wybor][0]-> useElixir($this);
					$this->iloscEliksirow-=1;              //dekrementacja ilości eliksirów
					unset($this->ekwipunek[$wybor]);       //usuwanie objektu z ekwipunku
					sort($this->ekwipunek);		           //sortowanie tablicy na nowo
					
					$this->setPunktyAkcji($this->getPunktyAkcji()-1);
				}
				else
					echo 'Podales niepoprawna wartosc!', PHP_EOL;
			}
			else
				echo 'Nie posiadasz zadnego eliksiru do wypicia!', PHP_EOL;
		}
		//funkcja obrony wiedzmina
		public function Obrona(){
			
			if ($this->getPunktyAkcji()>=2){              //warunek sprawdzający, czy jest wystarczająca ilość punktów akcji
				$this->obrona = true;                     //włączenie obrony
				$this->setPunktyAkcji(0);                 //wyzerowanie punktów akcji (obrona wykorzystuje wszystkie możliwe punkty akcji)
				echo 'Przyjmujesz pozycje obronna w oczekiwaniu na atak potwora.', PHP_EOL;
			}
			else
				echo 'Masz za malo punktow akcji, zeby sie bronic!', PHP_EOL;
		}		
	
	}