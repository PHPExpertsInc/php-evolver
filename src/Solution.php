<?php

namespace PeterColes\GAO;

abstract class Solution
{
    abstract public function genome();

    public function initialise()
    {
        return collect($this->genome())->map(function ($chromosome) {
            return $this->randomChar($chromosome);
        })->toArray();
    }

    protected function randomChar($chromosome)
    {
        return $chromosome[1][mt_rand(0, strlen($chromosome[1]) - 1)];
    }
}
