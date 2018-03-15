<?php
/**
 * Przykładowe użycie klasy SimpleTemplate
 */

//Załączenie SimpleTemplate
include "SimpleTemplate.php";

//Załadowanie szablonów
$main = new SimpleTemplate();
$main->loadHTML("templates/main.html");
$box = new SimpleTemplate();
$box->loadHTMLstring("<div class=\"box\"><h2>{header}</h2><p>{content}</p></div>");

//Załadowanie znacznika
$main->loadMark("title", "SimpleTemplate w akcji!");

//Załadowanie znaczników z array'a do widoku box
$box->loadMarks([
    "header" => "Prosty w obsłudze!",
    "content" => "Prezentowana tutaj zawartość została wygenerowana automatycznie na podstawie szablonu z pliku <b>HTML</b>, w którym znaczniki zostały podmienione przez klasę <b>SimpleTemplate</b>.",
]);

//Podmiana znacznika box1 z wewnętrznie wygenerowanego widoku box
$main->loadMark("box1", $box->renderView());

//Ponowne załadowanie znaczników z dwóch array'ów do widoku box
$box->loadMarks(["header" => "Obsługa widoków!"]);
$box->loadMarks(["content" => "System ten obsługuje osobne widoki, które podawane są do funkcji jako osobny ewentualny parametr. Jak widać znaczniki mogą być podmieniane na kod <b>HTML</b> wraz z jego formatowaniem."]);

//Podmiana znacznika box2 z wewnętrznie wygenerowanego widoku box z innymi wartościami
$main->loadMark("box2", $box->renderView());

//Ponowne załadowanie dwóch znaczników bez arraya do widoku box
$box->loadMark("header","Czytelność kodu");
$box->loadMark("content", "Kod klasy <b>SimpleTemplate</b> jest napisany bez zbędnego upychania i skracania kodu przy jednoczesym zachowaniu jego optymalizacji! Daje to czytelny a zarazem optymalny w działaniu kod.");

//Podmiana znacznika box32 z wewnętrznie wygenerowanego widoku box z innymi wartościami
$main->loadMark("box3", $box->renderView());

//Ponowne załadowanie znaczników z array'a i bez do widoku box
$box->loadMarks(["header" => "Skalowalne użycie"]);
$box->loadMark("content", "Widzisz te cztery okienka, które teraz czytasz? Jest to jeden wygenerowany widok <i>box</i>, w którym zmieniana jest jedynie treść. Pozwala to na ponowne użycie napisanych wcześniej komponentów.");

//Podmiana znacznika box4 z wewnętrznie wygenerowanego widoku box z innymi wartościami
$main->loadMark("box4", $box->renderView());

//Wyrenderowanie widoku, który wyświetla całą stronę
echo $main->renderView();

?>