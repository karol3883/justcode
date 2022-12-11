<?php

namespace App\Command\AdventCoding;

#[AsCommand(name: 'app:day4')]
class Day4Command extends AdventDayAbstract
{
    protected static $defaultName = 'app:day4';
    protected string $inputFileName = 'day4';

    public function stepOne(): void
    {
        $points = 0;
        foreach($this->getInputFileContent() as $singleRow) {
            $pairs = explode(',', $singleRow);

            if (empty($pairs[0]) || empty($pairs[1])) {
                continue;
            }

            $pairOne = $pairs[0];
            $pairTwo = $pairs[1];

            $splittedPartOne = explode('-', $pairOne);
            $splittedPartTwo = explode('-', $pairTwo);

            $partOneRange = range($splittedPartOne[0], $splittedPartOne[1]);
            $partTwoRange = range($splittedPartTwo[0], $splittedPartTwo[1]);

            if (!array_diff($partOneRange, $partTwoRange) || !array_diff($partTwoRange, $partOneRange)) {
                $points++;
            }
        }

        dump($points);
    }

    public function stepTwo(): void
    {
        $points = 0;
        foreach ($this->getInputFileContent() as $singleRow) {
            $pairs = explode(',', $singleRow);

            if (empty($pairs[0]) || empty($pairs[1])) {
                continue;
            }

            $pairOne = $pairs[0];
            $pairTwo = $pairs[1];

            $splittedPartOne = explode('-', $pairOne);
            $splittedPartTwo = explode('-', $pairTwo);

            $partOneRange = range($splittedPartOne[0], $splittedPartOne[1]);
            $partTwoRange = range($splittedPartTwo[0], $splittedPartTwo[1]);

            $loopSecondPair = true;
            foreach($partOneRange as $singleItemRangeOne) {
                if (in_array($singleItemRangeOne, $partTwoRange)) {
                    $points++;
                    $loopSecondPair = false;
                    break;
                }
            }

            if ($loopSecondPair) {
                foreach($partTwoRange as $singleItemRangeOne) {
                    if (in_array($singleItemRangeOne, $partOneRange)) {
                        $points++;
                        break;
                    }
                }
            }

        }
        dd($points);
    }
}