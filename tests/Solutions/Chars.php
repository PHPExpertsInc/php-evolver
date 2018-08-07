<?php

namespace PHPExperts\GAO\Tests\Solutions;

use PHPExperts\GAO\Solution;

class Chars extends Solution
{
    public function genome()
    {
        $genome = [];

        for ($i = 0; $i < 30; $i++) {
            $genome[] = ['char', ' abcdefghijklmnopqrstuvwxyz'];
        }

        return $genome;
    }

    public function evaluate($data)
    {
        //
    }
}
