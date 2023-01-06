<?php

namespace App\Command\AdventCoding;

#[AsCommand(name: 'app:day10')]
class Day10Command extends AdventDayAbstract
{
    protected static $defaultName = 'app:day10';
    protected string $inputFileName = 'day7';

    private array $container = [];

    private array $moves1 = [];
    private array $moves2 = [];

    public function stepOne(): void
    {

    }

    public function stepTwo(): void
    {
    }
}