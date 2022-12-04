<?php

namespace App\Command\AdventCoding;

#[AsCommand(name: 'app:day3')]
class Day3Command extends AdventDayAbstract
{
    protected static $defaultName = 'app:day3';
    protected string $inputFileName = 'day3';

    public function stepOne(): void
    {
        $test = [];
        $counter = 0;
        $points = 0;
        $threeLines = [];

        foreach($this->getInputFileContent() as $word) {
            if ($counter == 3) {
                $counter = 0;
                $threeLines = [];
            }

            $counter++;
            $threeLines[] = $word;
            if ($counter == 3) {
                for($i = 0; $i < strlen($threeLines[0]); $i++) {
                    if (str_contains($threeLines[1], $threeLines[0][$i]) &&
                        str_contains($threeLines[2], $threeLines[0][$i])) {

                        $theLetter =  $threeLines[0][$i];
//                        dump($theLetter);
                        if (ord($theLetter) >= 97) {
                            $multipleBy = ord($theLetter) - 96;
                        } else {
                            $multipleBy = ord($theLetter) - 38;
                        }
                        $points += $multipleBy;
                        break;
                    }

                }

            }
        }
        dump($points);
    }

    public function stepTwo(): void
    {
        $test = [];
        foreach($this->getInputFileContent() as $word) {

//            dump($word);
            if (strlen($word) % 2 != 0) {
                continue;
            }

            $halfOfLine = strlen($word) / 2;
            if ($halfOfLine < 1) {
                continue;
            }

            $splitedWord = str_split($word, $halfOfLine);
            $firstWord = $splitedWord[0];
            $secondWord = $splitedWord[1];

            $usedLetters = [];
            for($i = 0; $i < strlen($splitedWord[0]); $i++) {
                if (str_contains($secondWord, $firstWord[$i]) && !in_array($firstWord[$i], $usedLetters)) {
                    if (!empty($test[$firstWord[$i]])) {
                        $test[$firstWord[$i]] = $test[$firstWord[$i]] + 1;
                    } else {
                        $test[$firstWord[$i]] = 1;
                    }

                    $usedLetters[] = $firstWord[$i];
                }
            }
        }

        $points = 0;
        foreach ($test as $letter => $numberOfappearances) {
            if (ord($letter) >= 97) {
                $multipleBy = ord($letter) - 96;
            } else {
                $multipleBy = ord($letter) - 38;
            }

            $points += $multipleBy * $numberOfappearances;
        }
        dump($points);
    }
}