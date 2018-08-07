<?php

namespace PHPExperts\GAO\Tests\Solutions;

use PHPExperts\GAO\Solution;

class Mixed extends Solution
{
    public function genome()
    {
        return [
            ['char', 'ABC'],
            ['float', 0, 1],
            ['integer', -100, 100],
        ];
    }

    public function evaluate($data)
    {
        $this->fitness = abs((ord($this->chromosomes[0]) + $this->chromosomes[2]) / $this->chromosomes[1]);
    }
}
