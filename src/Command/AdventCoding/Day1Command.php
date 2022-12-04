<?php

namespace App\Command\AdventCoding;

#[AsCommand(name: 'app:day1')]
class Day1Command extends AdventDayAbstract
{
    protected static $defaultName = 'app:day1';
    protected string $inputFileName = 'day1';

    public function stepOne(): void
    {
        $elfesCalories  = [];

        $elfNumber = 0;
        foreach($this->getInputFileContent() as $singleLine) {
            if (!is_numeric($singleLine)) {
                $elfNumber++;
                continue;
            }
            if (!isset($elfesCalories[$elfNumber])) {
                $elfesCalories[$elfNumber] = 0;
            }
            $elfesCalories[$elfNumber] += $singleLine;
//            dump($singleLine);

            if ($elfNumber == 2) {
//                break;
            }
        }

        for($i = 0; $i < 3; $i++) {

        }

        rsort($elfesCalories);
        $most = $elfesCalories[0] + $elfesCalories[1] + $elfesCalories[2];
        dd($most);
        $max = max($elfesCalories);
        $flippedAray = array_flip($elfesCalories);
        $theMostCalElf = $flippedAray[$max] + 1;
        echo "The most caloires Elf number $theMostCalElf is carying the most of calories";
        // TODO: Implement stepOne() method.
    }

    public function stepTwo(): void
    {
        // TODO: Implement stepTwo() method.
    }
}