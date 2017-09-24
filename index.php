<?php
/**
 * Przykładowe użycie klasy SimpleTemplate
 */

//Załączenie SimpleTemplate
include "SimpleTemplate.php";

//Załadowanie szablonu
SimpleTemplate::loadHTML("templates/main.html");
SimpleTemplate::loadHTMLstring("<div class=\"box\"><h2>{header}</h2><p>{content}</p></div>", "box");

//Załadowanie znacznika
SimpleTemplate::loadMark("title", "SimpleTemplate w akcji!");

//Załadowanie znaczników z array'a do widoku box
SimpleTemplate::loadMarks([
        "header" => "Prosty w obsłudze!",
        "content" => "Prezentowana tutaj zawartość została wygenerowana automatycznie na podstawie szablonu z pliku <b>HTML</b>, w którym znaczniki zostały podmienione przez klasę <b>SimpleTemplate</b>.",
    ], "box"
);
//Podmiana znacznika box1 z wewnętrznie wygenerowanego widoku box
SimpleTemplate::loadMark("box1", SimpleTemplate::renderView("box"));

//Ponowne załadowanie znaczników z dwóch array'ów do widoku box
SimpleTemplate::loadMarks(["header" => "Obsługa widoków!"], "box");
SimpleTemplate::loadMarks(["content" => "System ten obsługuje osobne widoki, które podawane są do funkcji jako osobny ewentualny parametr. Jak widać znaczniki mogą być podmieniane na kod <b>HTML</b> wraz z jego formatowaniem."], "box");

//Podmiana znacznika box2 z wewnętrznie wygenerowanego widoku box z innymi wartościami
SimpleTemplate::loadMark("box2", SimpleTemplate::renderView("box"));

//Ponowne załadowanie dwóch znaczników bez arraya do widoku box
SimpleTemplate::loadMark("header","Czytelność kodu", "box");
SimpleTemplate::loadMark("content", "Kod klasy <b>SimpleTemplate</b> jest napisany bez zbędnego upychania i skracania kodu przy jednoczesym zachowaniu jego optymalizacji! Daje to czytelny a zarazem optymalny w działaniu kod.", "box");

//Podmiana znacznika box32 z wewnętrznie wygenerowanego widoku box z innymi wartościami
SimpleTemplate::loadMark("box3", SimpleTemplate::renderView("box"));

//Ponowne załadowanie znaczników z array'a i bez do widoku box
SimpleTemplate::loadMarks(["header" => "Skalowalne użycie"], "box");
SimpleTemplate::loadMark("content", "Widzisz te cztery okienka, które teraz czytasz? Jest to jeden wygenerowany widok <i>box</i>, w którym zmieniana jest jedynie treść. Pozwala to na ponowne użycie napisanych wcześniej komponentów.", "box");

//Podmiana znacznika box4 z wewnętrznie wygenerowanego widoku box z innymi wartościami
SimpleTemplate::loadMark("box4", SimpleTemplate::renderView("box"));

//Wyrenderowanie widoku, który wyświetla całą stronę
echo SimpleTemplate::renderView();

?>