# Gra


Gra składa się z sześciu plików:
1. postac.php - podstawowa kalsa postaci.
2. wiedzmin.php - klasa rozszerzająca klasę podstawową postac.
3. potwor.php - klasa potwór dziedzicząca po klasie postac.
4. eliksir.php - abstrakcyjna klasa eliksir.
5. funkcje.php - funkcje odpowiedzialne za akcje w grze
6. gra.php - plik uruchamiający grę

Wszystkie pliki pobieramy do jednego katalogu, w którym następnie włączamy konsolę poleceń i uruchamiamy plik "gra.php" poleceniem "php gra.php"
W trakcie rozgrywki uzywamy numerów przypisanych do danej pozycji w menu wyswietlanym na ekranie.

O grze.
1. Gracz kieruje Wiedźminem o parametrach (szybkość, siła, zręczność, życie).
2. Walczy z Potworem (takie same statystyki). 
3. Wartości statystyk obu przeciwników ustalamy przed rozpoczęciem walki. Po 300 puntków na postać.
4. O kolejności i liczbie działań w turze decyduje szybkość. Szybsza postać wykorzystuje wszystkie swoje akcje przed postacią wolniejszą.
5. Akcje dostępne dla wiedźmina to:
   - atak
   - stworzenie eliksiru
   - wypicie eliksiru
   - obrona
   - koniec tury
6. Potwór może tylko atakować. 
7. Stworzenie eliksiru polega na utworzeniu losowego eliksiru danego poziomu (1-3). Dostępne są eliksiry siły, szybkości i życia. Poziom eliksiru mówi o tym jak wiele punktów danej cechy daje wypity eliksir. Eliksir życia nie może podnieść punktów życia powyżej poziomu początkowego.
Miłej gry.

