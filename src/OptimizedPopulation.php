<?php

namespace PHPExperts\GAO;

class OptimizedPopulation extends Population
{
    public function __construct(string $model, array $solutions)
    {
        $this->size = count($solutions);
        $this->model = $model;

        $this->solutions = $solutions;
    }
}
