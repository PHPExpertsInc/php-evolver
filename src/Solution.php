<?php

namespace PeterColes\GAO;

abstract class Solution
{
    protected $chromosomes;

    public $fitness;

    abstract public function genome();

    abstract public function evaluate($data);

    public function initialise()
    {
        $this->chromosomes = collect($this->genome())->map(function ($definition) {
            return $this->chromosome($definition);
        })->toArray();
    }

    public function chromosome($definition)
    {
        $randomiser = 'random' . ucfirst($definition[0]);
        return $this->$randomiser($definition);
    }

    public function mutate()
    {
        $definition = $this->genome();
        $chromosomePosition = mt_rand(0, sizeof($definition) - 1);
        $this->chromosomes[$chromosomePosition] = $this->chromosome($definition[$chromosomePosition]);
        return $this;
    }

    public function chromosomes()
    {
        return $this->chromosomes;
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
