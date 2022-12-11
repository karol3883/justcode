<?php

namespace App\Command\AdventCoding;

#[AsCommand(name: 'app:day5')]
class Day5Command extends AdventDayAbstract
{
    protected static $defaultName = 'app:day5';
    protected string $inputFileName = 'day5';

    private array $container = [];

    private array $moves1 = [];
    private array $moves2 = [];
    public function stepOne(): void
    {
        $containers = [];
        foreach($this->getInputFileContent() as $singleLine) {
            if (!str_contains($singleLine,'move') && !str_contains($singleLine, '1')) {
//            if (!str_contains($singleLine,'move')) {

                if (str_contains($singleLine, '1')) {
                    foreach (range(1, 9) as $number) {
                        $singleLine = str_replace($number, "[$number]", $singleLine);
                        $singleLine = str_replace("   ", " ", $singleLine);
                    }
                    foreach (range(1,3) as $number) {
                        $test[] = "[$number]";
                    }
                    $singleLine = implode(' ', $test);
                }

                for($i = 0; $i < strlen($singleLine); $i++) {
                    if (($i+1) % 4 == 0) {
                        $singleLine[$i] = '/';
                    }
                }
                for($i = 0; $i < strlen($singleLine); $i++) {
                    if ($singleLine[$i] == '/' && $singleLine[$i+1] != '[') {
                        $singleLine[$i+1] = '[';
                        $singleLine[$i+2] = 'x';
                        $singleLine[$i+3] = ']';
                    }
                }
                $singleLineArray = explode('/', $singleLine);

                foreach ($singleLineArray as $index => $value) {
                    if ($value === '[x]' || trim($value) === '') {
                        continue;
                    }

                    $containers[$index+1][] = $value;
                }
                $this->container = $containers;
            }

            if (str_contains($singleLine, 'move')) {
                $moves = explode(' ', $singleLine);

                $movesArray = [];
                foreach ($moves as $singleMove) {
                    if (!is_numeric($singleMove)) {
                        continue;
                    }

                    $movesArray[] = $singleMove;
                }

                $this->move($movesArray[0], $movesArray[1], $movesArray[2]);
            }
        }

        $test = [];
        $range = range(1,count($this->container));
        foreach ($range as $item) {
            $test[$item] = $this->container[$item][0];
        }
        dump(str_replace(['[',']'], '',implode('', $test)));
//        dump($this->moves1);
    }

    private array $compareSteps1 = [];
    private array $compareSteps2 = [];
    private function move(int $numberOfContainers, int $container, int $directionContainer)
    {
        for($i = 0; $i < $numberOfContainers; $i++) {
            if (count($this->container[$container]) < 1) {
            }
            $takedOut = array_shift($this->container[$container]);
            $this->moves1[] = $takedOut;
            array_unshift($this->container[$directionContainer], $takedOut);
            $this->compareSteps1[] = $this->container;
        }
    }

    public function stepTwo(): void
    {
        $input = file_get_contents("public/adwentcode/day5");
        $inputArray = explode("\r\n\r\n", $input);
$diagram = $inputArray[0];
$rows = explode("\r\n", $diagram);
$rows = array_reverse($rows);  // build table from bottom up to create arrays as stacks
$moves = explode("\r\n", $inputArray[1]);

// Is each row of diagram same length?
// foreach ($rows as $stack) {
//     echo strlen($stack);
//     echo " <br>";
// }

$table = array();

// table index is 1 (not 0) to facilitate converting moves to array positions
$rowNum = 1;

// put the diagram columns into indexed arrays (table[column][row])
foreach ($rows as $row) { // rows are equal length string of characters with specific spacing

    $colNum = 1;

    // first element is in string position 1 and then every 4 positions after that is new column
    for ($i = 1; $i <= strlen($row); $i += 4) {
        $char = substr($row, $i, 1);
        $table[$colNum][$rowNum] = $char;
        $colNum ++;
    }
    $rowNum ++;
}

// delete empty entries from each column
$numCols = count($table);

// for each column
for ($i = 1; $i <= $numCols; $i ++) {
    $col = $table[$i];
    // check each row
    $numRows = count($col);
    for ($j = 1; $j <= $numRows; $j ++) {
        if ($col[$j] == " ") {  // if entry is a space character then it was blank on diagram
            unset($table[$i][$j]);  // so delete it from table
        }
    }
}

// table is now correctly indexed so execute pop and push moves
foreach ($moves as $move)
{
    $move = str_replace("move ", "", $move);
    $move = str_replace(" from", "", $move);
    $move = str_replace("to ", "", $move);
    $moveArray = explode(" ", $move);  // $moveArray[0] is number of moves, [1] is source, [2] is destination
    $items = array();

    for ($i = 0; $i < $moveArray[0]; $i ++) {
        $test = array_pop($table[$moveArray[1]]);
        $this->moves2[] = $test;
        array_push($items, $test);
//        dump($items);
    }

    // uncomment next line for part 2 answer
    // $items = array_reverse($items);
    foreach ($items as $item) {
        array_push($table[$moveArray[2]], $item);
    }
}

// answer for part 1 if reverse line above is commented
//        dd($table);
        $test = [];
foreach ($table as $col) {
//    dump($col);
    echo array_pop($col);
    $test[]= array_pop($col);
}

//        dump($table);
//    $this->compareMoves();
    }

    private function compareMoves()
    {
        foreach ($this->moves2 as $index => $value) {
            $this->moves2[$index] = "[{$this->moves2[$index]}]";
        }
    }
}
