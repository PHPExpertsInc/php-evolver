<?php

namespace PeterColes\GAO;

use PeterColes\GAO\Exceptions\MissingModelException;

class Optimiser
{
    protected $evaluationData = null;

    protected $model;

    protected $maxGenerations = 10;

    protected $populationSize = 100;

    public $results = [];

    public function __construct($params = [])
    {
        collect($params)->each(function ($value, $key) {
            $this->$key = $value;
        });
    }

    public function run()
    {
        if (!$this->model) {
            throw new MissingModelException;
        }

        for ($generation = 0; $generation < $this->maxGenerations; $generation++) {
            if ($generation == 0) {
                $population = new Population($this->model, $this->populationSize);
            } else {
                $population->nextGeneration();
            }

            $population->evaluate($this->evaluationData);

            $this->results[] = $population->findBest();
        }
    }

    public function loadEvaluationData($data)
    {
        $this->evaluationData = $data;
    }

    public function model()
    {
        return $this->model;
    }
}
