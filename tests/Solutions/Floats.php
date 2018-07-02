<?php

namespace PeterColes\GAO\Tests\Solutions;

use PeterColes\GAO\Solution;

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
}
