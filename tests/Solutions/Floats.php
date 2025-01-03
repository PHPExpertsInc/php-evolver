<?php

namespace PHPExperts\GAO\Tests\Solutions;

use PHPExperts\GAO\Solution;

class Floats extends Solution
{
    public function genome()
    {
        return [
            ['float', 0, 100],
            ['float', -100, 0],
            ['float', 0, 1],
            ['float', -1, 1],
        ];
    }

    public function evaluate($data = null)
    {
        $this->fitness = collect($this->chromosomes)->sum();
    }

    public function summary()
    {
        return (object) [
            'fitness' => number_format($this->fitness, 3),
            'chromosomes' => collect($this->chromosomes)->map(fn($chromosome) => number_format($chromosome, 2))->toArray(),
        ];
    }
}
