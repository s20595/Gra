<?php	
//abstrakcyjna klasa ostaci, z której dziedziczy widzmin i potwór
	abstract class Postac {
	
		protected $szybkosc = 0;	
		protected $sila = 0;
		protected $zrecznosc = 0;
		protected $zycie = 0;		
		protected $maxHP = 0;
		protected $punktyAkcji = 0;
		protected $obrona = false;	
		
	// konstruktor postaci
		public function __construct($szybkosc, $sila, $zrecznosc, $zycie)		
		{
			$this->szybkosc = $szybkosc; 			
			$this->sila = $sila;
			$this->zrecznosc = $zrecznosc;
			$this->zycie = $zycie;			
			$this->maxHP = $zycie;
		}		
	//------------------- FUNKCJE ------------------
	
//funkcja odowiedzialna za atak, 
		public function Atak ($obronca){
			
			$agility = $obronca->getAgility();
			
			if ($obronca->getDefense()){             //warunek sprawdzający, czy gracz użył obrony
				$agility *= 1.5;                     //zwiększenie zręczności o 50% 
				$obronca->setDefense(false);         //wyłączenie obrony (w następnej turze zręczność będzie wynosiła 100% maksymalnej wartości)
			}
	//określenie współczynnika skuteczności ataku		
			$sk = (($this->getAgility() - $agility) / $agility ) * 100;
				
				if ($sk>90)                         //ograniczenie skrajności (nie będzie mniej niż 10% a więcej niż 90%)
					$sk=90;
				else if($sk<10)
					$sk=10;
				
	//warunek odpowiedzialny za skuteczność ataku. 
    //jeśli skuteczność ataku jest większa lub równa wylosowanej liczbie to atak się powiedzie 	
				if ($sk>=rand(1,100)){
					$obronca->setHP($obronca->getHP()-$this->getStrength());
					echo 'Atak sie powiodl, zabral '.$this->getStrength().' HP, pozostalo zycia '.$obronca->getHP().' z '.$obronca->getMaxHP().'.', PHP_EOL;
				}
				else
					echo "Atak chybil o wlos!", PHP_EOL;
				
			$this->setPunktyAkcji($this->getPunktyAkcji()-1);	 //zmniejsze punktów akcji o 1 (koszt ataku)
		}
	
	
	// ------------- GET / SET -------------------
	
	//gettery i settery do właściwości postaci
	
		public function getAgility(){
			return $this->zrecznosc;
		}
		
		public function setAgility($value){
			$this->zrecznosc=$value;
		}
	
		public function getSpeed(){
			return $this->szybkosc;
		}
		
		public function setSpeed($value){
			$this->szybkosc = $value;
		}

		public function getHP(){
			return $this->zycie;
		}
		
		public function setHP($value){
			$this->zycie = $value;
		}	
		
		public function getMaxHP(){
			return $this->maxHP;
		}

		public function getStrength(){
			return $this->sila;
		}
		
		public function setStrength($value){
			$this->sila = $value;
		}	
		
		public function getPunktyAkcji (){
			return $this->punktyAkcji;
		}
		
		public function setPunktyAkcji ($value){
			$this->punktyAkcji = $value;
		}
		
		public function getDefense(){
			return $this->obrona;
		}
}		