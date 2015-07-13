<?php
require_once ('postac.php');
	
	class Wiedzmin extends Postac{

		protected $ekwipunek = [];
		protected $iloscEliksirow = 0;
	
	
	//---------------- GET / SET -------------------
		public function setDefense($value){
			$this->obrona = $value;
		}

	
	//----------------- FUNKCJE -------------------
		public function stworzEliksir (){
		
		if ($this->getPunktyAkcji() > 1)
		{
			do{
				$poziom = rand(1,3);
			}while($poziom>=$this->getPunktyAkcji());		// losuje tak długo, póki nie wylosuje liczby mniejsze od liczby posiadanych punktów akcji
														// gdyby nie znak "=" mógłby przekroczyć liczbę posiadanych punktów akcji (1 punkt schodzi na samo tworzenie eliksiru)
		
				switch (rand(1,3)){
					case 1: $this->ekwipunek[$this->iloscEliksirow][0] = new EliksirZycia($poziom);
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
			
			$this->setPunktyAkcji($this->getPunktyAkcji()-(1+$poziom));
		}
		
		else
			echo 'Masz za malo punktow akcji, zeby stworzyc eliksir!', PHP_EOL;
		}
		
		public function wypijEliksir (){
			
			if ($this->iloscEliksirow > 0){
				
				echo 'Jaki eliksir chcesz wypic?', PHP_EOL;
				for ($i = 0; $i<$this->iloscEliksirow; $i++)
					if (isset($this->ekwipunek[$i]))
						echo "$i. ".$this->ekwipunek[$i][1], PHP_EOL;

				$wybor = trim(fgets(STDIN));
				
				if ($wybor >= 0 && $wybor<=$i){
					$this->ekwipunek[$wybor][0]-> useElixir($this);
					$this->iloscEliksirow-=1;
					unset($this->ekwipunek[$wybor]);
					sort($this->ekwipunek);		
					
					$this->setPunktyAkcji($this->getPunktyAkcji()-1);
				}
				else
					echo 'Podales niepoprawna wartosc!', PHP_EOL;
			}
			else
				echo 'Nie posiadasz zadnego eliksiru do wypicia!', PHP_EOL;
		}
		
		public function Obrona(){
			
			if ($this->getPunktyAkcji()>=2){
				$this->obrona = true;
				$this->setPunktyAkcji(0);
				echo 'Przyjmujesz pozycje obronna w oczekiwaniu na atak potwora.', PHP_EOL;
			}
			else
				echo 'Masz za malo punktow akcji, zeby sie bronic!', PHP_EOL;
		}		
	
	}