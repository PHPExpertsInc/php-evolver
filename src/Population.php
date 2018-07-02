<?php

namespace PeterColes\GAO;

class Population
{
    protected $size;

    protected $model;

    protected $solutions = [];

    public function __construct($model, int $size)
    {
        $this->size = $size;
        $this->model = $model;

        $this->initialise();
    }

    public function solutions()
    {
        return $this->solutions;
    }

    public function evaluate($data)
    {
        collect($this->solutions)->each(function ($solution) use ($data) {
            $solution->evaluate($data);
        });
    }

    public function findBest()
    {
        $s = collect($this->solutions);
        return $s->where('fitness', $s->max('fitness'))->first();
    }

    public function select($number)
    {
        return collect($this->solutions)->sortByDesc('fitness')->take($number);
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
