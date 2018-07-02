<?php

namespace PeterColes\GAO\Tests\Solutions;

use PeterColes\GAO\Solution;

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
}
