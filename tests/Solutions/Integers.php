<?php

namespace PeterColes\GAO\Tests\Solutions;

use PeterColes\GAO\Solution;

class Integers extends Solution
{
    public function genome()
    {
        return [
            ['integer', 0, 100],
            ['integer', -100, 0],
            ['integer', -1, 1],
        ];
    }

    public function evaluate($data)
    {
        $this->fitness = 0;
        foreach ($data as $weights) {
            $this->fitness += $this->chromosomes[0] * $weights[0]
                + $this->chromosomes[1] * $weights[1]
                + $this->chromosomes[2] * $weights[2];
        }
    }
}
