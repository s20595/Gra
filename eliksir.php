<?php
//abstrakcyjna klasa eliksir
abstract class Eliksir {
		
		protected $efekt = 0;
	
		abstract public function useElixir($postac);
	}
	
	//klasa elisir szybkośći
	class EliksirSzybkosci extends Eliksir {
		
		//konstruktor eliksiru
		public function __construct($poziomEliksiru)
		{
			//obliczanie efektu eliksiru
			$this->efekt=5*$poziomEliksiru;
			echo "Stworzyles Eliksir Szybkosci poziomu $poziomEliksiru";
		}
		public function useElixir($postac) {
			echo 'Wypiles Eliksir szybkosci!', PHP_EOL,
			 'Twoja szybkosc wzrosla z : ', $postac->getSpeed(),
			$postac->setSpeed($postac->getSpeed()+$this->efekt),
		     ' do : ', $postac->getSpeed(), PHP_EOL;
		//toksyczna właściwośc eliksiru, obliczanie negatywnego efektu
			 $trucizna = (int)($postac->getHP()/rand(40,50)*$this->efekt);
			 $postac->setHP($postac->getHP() - $trucizna);
			 echo 'Pijac trujacy eliksir straciles '.$trucizna.' punktow zycia.', PHP_EOL, 'Twoj aktualny poziom zdrowia: '.$postac->getHP(),PHP_EOL;
		}
	}
	//klasa eliksir sily	
	class EliksirSily extends Eliksir {
		
		public function __construct($poziomEliksiru)
		{
			$this->efekt=3*$poziomEliksiru;
			echo "Stworzyles Eliksir Sily poziomu $poziomEliksiru", PHP_EOL;			
		}
		public function useElixir($postac) {
			echo 'Wypiles Eliksir sily!', PHP_EOL,
			'Twoja sila wzrosla z : ', $postac->getStrength(),
			$postac->setStrength($postac->getStrength()+$this->efekt),
			' do : ', $postac->getStrength(), PHP_EOL;
			
			$trucizna = (int)($postac->getHP()/rand(32,50)*$this->efekt);
			$postac->setHP($postac->getHP() - $trucizna);
			echo 'Pijac trujacy eliksir straciles '.$trucizna.' punktow zycia.', PHP_EOL, 'Twoj aktualny poziom zdrowia: '.$postac->getHP(),PHP_EOL;			
		}
	}
	//klasa eliksir zycia
	class EliksirZycia extends Eliksir {
		
		public function __construct($poziomEliksiru)
		{
			$this->efekt = (4 * $poziomEliksiru);
			echo "Stworzyles Eliksir Zycia poziomu $poziomEliksiru", PHP_EOL;			
		}
		public function useElixir($postac) {
			
			//Sprawdzanie, czy po wypiciu eliksiru nie zostanie przekroczona wartość maksymalna
			if (($postac->getHP()+$this->efekt) <= $postac->getMaxHP()){
				echo 'Wypiles Eliksir zycia!', PHP_EOL,
				 'Twoje zycie wzroslo z : ', $postac->getHP(),
				$postac->setHP($postac->getHP()+$this->efekt),
				 ' do : ', $postac->getHP(), PHP_EOL;
			}
			
			else{
				echo 'Moc Eliksiru Zycia zostala ograniczona. Twoje zycie siegnelo maksimum (100)!', PHP_EOL;
				$postac->setHP($postac->getMaxHP());
			}
				
		}
	}	