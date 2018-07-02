<?php

namespace PeterColes\GAO;

abstract class Solution
{
    protected $chromosomes;

    protected $fitness;

    abstract public function genome();

    abstract public function evaluate($data);

    public function initialise()
    {
        $this->chromosomes = collect($this->genome())->map(function ($chromosome) {
            $randomiser = 'random' . ucfirst($chromosome[0]);
            return $this->$randomiser($chromosome);
        })->toArray();
    }

    public function chromosomes()
    {
        return $this->chromosomes;
    }

    public function fitness()
    {
        return $this->fitness;
    }

    protected function randomChar($chromosome)
    {
        return $chromosome[1][mt_rand(0, strlen($chromosome[1]) - 1)];
    }

    protected function randomInteger($chromosome)
    {
        return mt_rand($chromosome[1], $chromosome[2]);
    }

    protected function randomFloat($chromosome)
    {
        return $chromosome[1] + mt_rand() / mt_getrandmax() * abs($chromosome[2] - $chromosome[1]);
    }
}
