<?php

namespace PeterColes\GAO\Tests\Solutions;

use PeterColes\GAO\Solution;

class Textual extends Solution
{
    public function genome()
    {
        $genome = [];

        for ($i = 0; $i < 30; $i++) {
            $genome[] = ['char', ' abcdefghijklmnopqrstuvwxyz'];
        }

        return $genome;
    }
}
