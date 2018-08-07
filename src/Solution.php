<?php

namespace PHPExperts\GAO;

abstract class Solution
{
    protected $chromosomes;

    public $fitness;

    abstract public function genome();

    abstract public function evaluate($data);

    public function __construct($params = null)
    {
        if ($params) {
            foreach ($params as $key => $value) {
                $this->$key = $value;
            }
        }
    }

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

        $keys = array_keys($this->chromosomes);
        $this->chromosomes[$keys[$chromosomePosition]] = $this->chromosome($definition[$keys[$chromosomePosition]]);
        return $this;
    }

    public function chromosomes()
    {
        return $this->chromosomes;
    }

    public function summary()
    {
        return (object) [
            'fitness' => $this->fitness,
            'chromosomes' => $this->chromosomes,
        ];
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
