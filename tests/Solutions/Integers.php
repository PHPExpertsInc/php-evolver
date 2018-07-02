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
}
