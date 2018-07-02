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

    protected function initialise()
    {
        for ($i = 0; $i < $this->size; $i++) {
            $solution = new $this->model;
            $solution->initialise();
            $this->solutions[] = $solution;
        }
    }
}
