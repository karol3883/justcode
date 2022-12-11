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


        $pathElements = $this->unsetMoreThanLimit($pathElements);
        $compareArray = [];
        foreach ($pathElements as $path => $value) {
            if ($pathElements[$path] != $value) {
                $compareArray[$path] = [
                    '$value' => $value,
                    '$pathElements[$path]' => $pathElements[$path],
                ];
            }

            $pathArray = explode('*', $path);
            array_pop($pathArray);
            $parentPathArray = $pathArray;
            $parentPath = implode('*', $parentPathArray);
            if (isset($pathElements[$parentPath])) {
                if ($pathElements[$parentPath] + $pathElements[$path] < 100000) {
                    $test = $pathElements[$parentPath] + $pathElements[$path];
                    $pathElements[$parentPath] = $test;
                }
            }

        }

        $this->test = $pathElements;
        dump(array_sum($pathElements));
        dd(1);
        dd($newArray);
//        dd($compareArray);
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

    private function addValueToParent(string $path)
    {

    }

    public function stepTwo(): void
    {
        $filesystem = [];
        $here = ["root"];

        foreach($this->getInputFileContent() as $line) {
            list($start, $cmd, $dir) = array_pad(explode(' ', $line), 3, null);
            if ($start === '$') {
                $lastCmd = $cmd;
                if ($cmd === 'cd') {
                    if ($dir === "/") {
                        $here = ["root"];
                    } elseif ($dir === "..") {
                        array_pop($here);
                    } else {
                        array_push($here, $dir);
                    }
                }
            } else {
                if($start !== 'dir') {
                    array_push($filesystem, implode('/', $here) . '/' . $start);
                }
            }
        }

        $totals = [];

        foreach ($filesystem as $path) {
            $savePath = '';
            $path = explode('/', $path);
            foreach ($path as $segment) {
                $savePath = $savePath . '/' . $segment;
                if (!is_numeric($segment)) {
                    if(array_key_exists($savePath, $totals)) {
                        $totals[$savePath] += (int) end($path);
                    } else {
                        $totals[$savePath] = (int) end($path);
                    }
                }
            }
        }

        $totalsLessThan100000 = array_filter($totals, function($total) {
            return $total <= 100000;
        });


        uksort($totalsLessThan100000, function($a, $b) {
            return strlen($b) <=> strlen($a);
        });

        $newArray = [];
        foreach($totalsLessThan100000 as $path => $value) {
            $path = str_replace('/','*', $path);
            $path = str_replace('root','/', $path);

//            $path = "/$path";
            $newArray[$path] = $value;
        }
        $this->test2 = $newArray;
        $answer = array_sum($totalsLessThan100000);

        $this->test2 = $newArray;
        $this->test();
        dd($answer);
    }
    private function test()
    {
        $testval = 0;
        foreach($this->test as $path => $value) {
            if($this->test2["*$path"] !== $value) {
                dump("$path - myval = $value; theirval = {$this->test2["*$path"]}");
                $testval += $this->test2["*$path"];
            }
        }
        dump($testval);
    }
    private array $test = [];
    private array $test2 = [];
}