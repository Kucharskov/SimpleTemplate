# SimpleTemplate
## Prosty system szablonów dla "programistów HTML" :)

#### Metody:
 * ***loadHTML($plik)*** pobiera kod HTML z podanego pliku do danego widoku
 * ***loadHTMLstring($string)*** ustawia podany string jako kod HTML dla widoku
 * ***clearHTML()*** usuwa HTML danego widoku
 * ***loadMark($znacznik, $wartość)*** ustawia wartosc dla danego znacznika dla widoku
 * ***loadMarks($znaczniki)*** ustawia tablice (znacznik => wartość) dla widoku
 * ***clearMarks()*** czyści listę znaczników i ich wartości dla widoku
 * ***renderView($clear)*** zwraca widok HTML z podmienionymi znacznikami na wartości ($clear ustawione na true usuwa niepodmienione znaczniki)
 * ***debugView()*** zwraca tablicę debugową z informacjami na temat danego widoku
 
W wersji 2.0 pozbyto się widoków na rzecz zorientowania bardziej OOP.
Każdy widok od teraz jest inicjowany jak w zwykły obiekt $widok = new SimpleTemplate();