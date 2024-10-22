<?php

function clear() {
    if (PHP_OS === "WINNT") {
        system ("cls");
    }
    else {
        system ("Clear");
    }
}

$posible_words = ["Bebida", "Prisma", "Ala", "Dolor",
    "Piloto", "Baldosa", "Terremoto", "Asteroide", "Gallo"];

define("Max_Attempts", 6);

echo "Juego de ahorcado! \n";

//Iniciamos el juego

$choosen_word = $posible_words [rand(0, 8)];
$choosen_word = strtolower($choosen_word);
$word_length = strlen($choosen_word);
$discover_letters = str_pad("", $word_length, "_");
$attemps = 0;

do {
    echo "Palabra de $word_length letras \n\n";
    echo $discover_letters . "\n\n";

//Pedimos al usuario que escriba
    $player_letter = readline("Escribe una letra: ");
    $player_letter = strtolower($player_letter);

    if (str_contains ($choosen_word, $player_letter)) {
        //Verificar todas las ocurrencias de esta letra para reemplazarla
        $offset = 0;

        while (
            ($letter_position = strpos($choosen_word, $player_letter,
                $offset)) !== false
        ){

            $discover_letters [$letter_position] = $player_letter;
            $offset = $letter_position + 1;
        }
    }
     else {
        clear();
        $attemps++;
        echo "Letra incorrecta . Te quedan " . (Max_Attempts - $attemps) . " intentos.";
        sleep(2);
    }
    clear();

} while ( $attemps < Max_Attempts && $discover_letters != $choosen_word);
clear();

if ($attemps < Max_Attempts)
    echo "Felicidades! Has adivinado la palabra. \n\n";
else
    echo "Suerte para la proxima";

echo "\n";
