<?php

namespace PHPExperts\GAO;

class Population
{
    protected $size;

    protected $solutions = [];

    public function __construct(protected $model, int $size)
    {
        $this->size = $size;

        $this->initialise();
    }

    public function solutions()
    {
        return $this->solutions;
    }

    public function evaluate($data, callable $exitCondition = null)
    {
        collect($this->solutions)->each(function ($solution) use ($data, $exitCondition) {
            $solution->evaluate($data, $exitCondition);
        });
    }

    public function findBest()
    {
        $s = collect($this->solutions);
        return $s->where('fitness', $s->min('fitness'))->first();
    }

    public function nextGeneration()
    {
        $selections = $this->select($this->size / 2);
        $this->crossover($selections);
        $this->mutate();
    }

    public function select($number)
    {
        return collect($this->solutions)->sortBy('fitness')->take($number);
    }

    public function crossover($parents)
    {
        $numParents = $parents->count();
        $familySize = 2 * $this->size / $numParents;
        $chromosomeCount = sizeof($parents->first()->chromosomes());

        if (is_int($familySize)) {
            $this->solutions = $parents->shuffle()->chunk(2)->map(function ($parents) use ($familySize, $chromosomeCount) {
                $children = [];
                for ($i = 0; $i < $familySize; $i++) {
                    $crossover = mt_rand(0, $chromosomeCount);
                    $left = array_slice($parents->first()->chromosomes(), 0, $crossover);
                    $right = array_slice($parents->last()->chromosomes(), $crossover);
                    $children[] = new $this->model(['chromosomes' => array_merge($left, $right)]);
                }
                return $children;
            })->flatten();
        }
    }

    public function mutate()
    {
        $this->solutions = collect($this->solutions)->map(function ($solution) {
            if (mt_rand(1, 7) == 1) {
                $solution->mutate();
            }
            return $solution;
        })->toArray();
    }

    protected function initialise()
    {
        for ($i = 0; $i < $this->size; $i++) {
            $solution = new $this->model;
            $solution->initialise();
            $this->solutions[] = $solution;
        }
    }
}
