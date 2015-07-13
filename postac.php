<?php	
	abstract class Postac {
	
		protected $szybkosc = 0;	
		protected $sila = 0;
		protected $zrecznosc = 0;
		protected $zycie = 0;		
		protected $maxHP = 0;
		protected $punktyAkcji = 0;
		protected $obrona = false;	
		
		
		public function __construct($szybkosc, $sila, $zrecznosc, $zycie)		// Konstruktor
		{
			$this->szybkosc = $szybkosc; 			
			$this->sila = $sila;
			$this->zrecznosc = $zrecznosc;
			$this->zycie = $zycie;			
			$this->maxHP = $zycie;
		}		
	

//------------------- FUNKCJE ------------------
		public function Atak ($obronca){
			
			$agility = $obronca->getAgility();
			
			if ($obronca->getDefense()){
				$agility *= 1.5;
				$obronca->setDefense(false);
			}
			
			$sk = (($this->getAgility() - $agility) / $agility ) * 100;
				
				if ($sk>90)
					$sk=90;
				else if($sk<10)
					$sk=10;
				
				
				if ($sk>=rand(1,100)){
					$obronca->setHP($obronca->getHP()-$this->getStrength());
					echo 'Atak sie powiodl, zabral '.$this->getStrength().' HP, pozostalo zycia '.$obronca->getHP().' z '.$obronca->getMaxHP().'.', PHP_EOL;
				}
				else
					echo "Atak chybil o wlos!", PHP_EOL;
				
			$this->setPunktyAkcji($this->getPunktyAkcji()-1);	
		}
	
	
	// ------------- GET / SET -------------------
	
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