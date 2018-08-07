<?php

namespace PHPExperts\GAO;

class Breeder
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

    public function run(callable $exitCondition = null)
    {
        static $numOfGenerations = 0;
        if (!$exitCondition) {
            // Never exit early by default.
            $exitCondition = function ($bestEntity) {
                return false;
            };
        }

        for ($generation = 0; $generation < $this->maxGenerations; $generation++) {
            if ($generation > 0) {
                $this->population->nextGeneration();
            }

            $this->population->evaluate($this->evaluationData);

            $bestEntity = $this->population->findBest();
            $this->results[] = $bestEntity;

            ++$numOfGenerations;

            if ($exitCondition($bestEntity)) {
                break;
            }
        }
    }

    public function loadEvaluationData($data)
    {
        $this->evaluationData = $data;
    }
}
