<?php

namespace App\Command\AdventCoding;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AdventDayAbstract extends Command
{
    protected string $inputFileName;

    public abstract function stepOne(): void;
    public abstract function stepTwo(): void;


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->stepOne();
        $this->stepTwo();

        dd(" ");
    }

    private function getFilePath(): string
    {
        if (!isset($this->inputFileName)) {
            throw new \Exception('$inputFileName in class ' . get_class($this) . ' is not set');
        }

        return "./public/adwentcode/{$this->inputFileName}";
    }

    protected function getInputFileContent(): \Generator
    {
        $contents = file_get_contents($this->getFilePath());
        $lines = explode("\r\n", $contents); // this is your array of words

        foreach($lines as $singleLine) {
            yield $singleLine;
        }
    }
}