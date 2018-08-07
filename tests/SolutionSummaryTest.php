<?php

namespace PHPExperts\GAO\Tests;

use PHPUnit\Framework\TestCase;
use PHPExperts\GAO\Tests\Solutions\Floats;
use PHPExperts\GAO\Tests\Solutions\Integers;

class SolutionSummaryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        mt_srand(0); // seed random number generator for consistent test results
    }

    /** @test */
    public function can_summarise_solution()
    {
        $solution = new Integers();
        $solution->initialise();
        $solution->evaluate([[10, 5, 1]]);

        $summary = $solution->summary();

        $this->assertEquals(446, $summary->fitness);
        $this->assertEquals('64:-39:1', $summary->chromosomes);
    }

    /** @test */
    public function can_tailor_solution_summaries()
    {
        $solution = new Floats();
        $solution->initialise();
        $solution->evaluate();

        $summary = $solution->summary();

        $this->assertEquals(15.570, $summary->fitness);
        $this->assertEquals([54.88, -40.72, 0.72, 0.69], $summary->chromosomes);
    }
}
