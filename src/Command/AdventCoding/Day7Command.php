<?php

namespace App\Command\AdventCoding;

#[AsCommand(name: 'app:day7')]
class Day7Command extends AdventDayAbstract
{
    protected static $defaultName = 'app:day7';
    protected string $inputFileName = 'day7';

    private array $container = [];

    private array $moves1 = [];
    private array $moves2 = [];

    public function stepOne(): void
    {
        $prevLine = null;

        $directorySum = 0;
        $totalDirectorySum = 0;
        $moreThan100000 = 0;
        $path = [];

        $pathElements = [];
        $debug = false;
        $debugLines = 0;
        foreach ($this->getInputFileContent() as $singleLine) {
            $explodedLine = explode(' ', $singleLine);
            if (str_contains($singleLine, '$ cd')) {

                $cdElement = array_pop($explodedLine);

                if ($cdElement == '..') {
                    array_pop($path);
                    continue;
                }

                $path[] = $cdElement;
            }

            $currentPath = implode('*', $path);
            if (empty($pathElements[$currentPath])) {
                $pathElements[$currentPath] = 0;
            }

            foreach ($explodedLine as $lineElement) {
                if (!is_numeric($lineElement)) {
                    continue;
                }
                $pathElements[$currentPath] += (int) $lineElement;
            }

        }


        uksort($pathElements, function($a, $b) {
            return strlen($b) <=> strlen($a);
        });
//        $pathElements = $this->unsetMoreThanLimit($pathElements);
        $needed = 30000000 - (70000000 - array_sum($pathElements));
        foreach ($pathElements as $path => $value) {

            $pathArray = explode('*', $path);
            array_pop($pathArray);
            $parentPathArray = $pathArray;
            $parentPath = implode('*', $parentPathArray);

            if (isset($pathElements[$parentPath])) {
                if ($pathElements[$parentPath] + $pathElements[$path] < 100000) {
//                    $test = $pathElements[$parentPath] + $pathElements[$path];
//                    $pathElements[$parentPath] = $test;
                }
//                $test = $pathElements[$parentPath] + $pathElements[$path];
//                $pathElements[$parentPath] += $test;
            }

        }

        dd($pathElements);
        $correctvalues = [];
        foreacH($pathElements as $key => $value) {
            if ($value >= $needed) {
                $correctvalues[] = $value;
            }
        }

        sort($correctvalues);
        dump("Needed space: $needed");
        unset($pathElements['/']);
        dump(array_sum($pathElements));
    }

    public function stepTwo(): void
    {
        $input = $this->getInputFileContent();

        foreach ($input as $l) {
            $tok = explode(' ', $l);
            if ($tok[0] == '$') {
                if ($tok[1] == 'cd') {
                    $path = match ($tok[2]) {
                        '/' => 'root/',
                        '..' => (strrpos($path, '/', -1) === false ?
                            'root/' :
                            substr($path, 0, strrpos($path, '/', -1) - 1)
                        ),
                        default => $path . $tok[2] . '/'
                    };
                }
            } else {
                if ($tok[0] !== 'dir') {
                    if (isset($tok[1])) {
                        $dirs[$path][$tok[1]] = $tok[0];
                    }
                }
            }
        }
        $totals = [];
        foreach ($dirs as $path => $files) {
            $pathwalk = '';
            foreach (explode('/', $path) as $segment) {
                if ($segment == '') continue;
                $pathwalk = $pathwalk . '/' . $segment;
                if (array_key_exists($pathwalk, $totals)) {
                    $totals[$pathwalk] += array_sum($files);
                } else {
                    $totals[$pathwalk] = array_sum($files);
                }
            }
        }
        $p1 = 0;
        foreach ($totals as $total) {
            if ($total <= 100000) $p1 += $total;
        }
        echo "Sum of total sizes of directories under 100K: $p1\n";

        $p2 = $totals['/root'];
        $needed = 30000000 - (70000000 - $p2);

        $keyneeded = '';
        foreach ($totals as $key => $total) {
            if ($total < $p2 && $total >= $needed){
                $p2 = $total;
                $keyneeded = $key;
            }
        }
        echo "Size of directory to delete: $p2\n";
        echo "Test: $keyneeded\n";
    }

    private function unsetMoreThanLimit($pathElements)
    {
        uksort($pathElements, function($a, $b) {
            return strlen($b) <=> strlen($a);
        });

        foreach($pathElements as $pathElement => $value) {
            if ($value > 100000) {
                $pathArray = explode('*', $pathElement);

                while (count($pathArray) > 0) {
                    array_pop($pathArray);
                    $parentPath = implode('*', $pathArray);
                    unset($pathElements[$parentPath]);
//                    dump($parentPath);
                }
                unset($pathElements[$pathElement]);
            }
        }

        uksort($pathElements, function($a, $b) {
            return strlen($b) <=> strlen($a);
        });

        return $pathElements;
    }
}