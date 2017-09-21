# SimpleTemplate
## Prosty system szablonów dla "programistów HTML" :)

#### Metody:
 * ***loadHTML($plik, $widok)*** pobiera kod HTML z podanego pliku do danego widoku
 * ***clearHTML($widok)*** usuwa HTML danego widoku
 * ***loadMark($znacznik, $wartość, $widok)*** ustawia wartosc dla danego znacznika dla widoku
 * ***loadMarks($znaczniki, $widok)*** ustawia tablice (znacznik => wartość) dla widoku
 * ***clearMarks($widok)*** czyści listę znaczników i ich wartości dla widoku
 * ***renderView($widok)*** zwraca widok HTML z podmienionymi znacznikami na wartości