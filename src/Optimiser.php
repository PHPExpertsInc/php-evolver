<?php

namespace PeterColes\GAO;

class Optimiser
{
    protected $population;

    protected $evaluationData = null;

    protected $maxGenerations = 10;

    public $results = [];

    public function __construct($population, $params = [])
    {
        $this->population = $population;

        collect($params)->each(function ($value, $key) {
            $this->$key = $value;
        });
    }

    public function run()
    {
        for ($generation = 0; $generation < $this->maxGenerations; $generation++) {
            if ($generation > 0) {
                $this->population->nextGeneration();
            }

            $this->population->evaluate($this->evaluationData);

            $this->results[] = $this->population->findBest();
        }
    }

    public function loadEvaluationData($data)
    {
        $this->evaluationData = $data;
    }
}
