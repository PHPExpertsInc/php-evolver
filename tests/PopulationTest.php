<?php

namespace PeterColes\GAO\Tests;

use PeterColes\GAO\Population;
use PHPUnit\Framework\TestCase;
use PeterColes\GAO\Tests\Solutions\Mixed;
use PeterColes\GAO\Tests\Solutions\Integers;

class PopulationTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        mt_srand(0); // seed random number generator for consistent test results
    }

    /** @test */
    public function can_initialise_new_population()
    {
        $population = new Population(Integers::class, 10);

        $this->assertCount(10, $population->solutions());
        foreach ($population->solutions() as $solution) {
            $this->assertInstanceOf(Integers::class, $solution);
            $this->assertCount(3, $solution->chromosomes());
        }
        $this->assertEquals([42, -4, -1], $population->solutions()[1]->chromosomes());
    }

    /** @test */
    public function can_evaluate_a_population_without_evaluation_data()
    {
        $population = new Population(Mixed::class, 3);
        $population->evaluate(null);
        $best = $population->findBest();

        $this->assertEquals(['C', 0.5928, 70], $best->chromosomes(), '', 0.0001);
        $this->assertEquals(231.0892, $best->fitness, '', 0.0001);
    }

    /** @test */
    public function can_evaluate_a_population_with_evaluation_data()
    {
        $population = new Population(Integers::class, 3);
        $evalData = [[2, -1, 90], [3, 0, 85], [1, -2, 82]];
        $population->evaluate($evalData);
        $best = $population->findBest();

        $this->assertEquals(771, $best->fitness, '', 0.0001);
        $this->assertEquals([82, -93, 0], $best->chromosomes(), '', 0.0001);
    }

    /** @test */
    public function apply_selection_strategy()
    {
        $population = new Population(Integers::class, 12);
        $evalData = [[2, -1, 90], [3, 0, 85], [1, -2, 82]];
        $population->evaluate($evalData);
        $selections = $population->select(6);

        $this->assertCount(6, $selections);
        $this->assertEquals([1052, 771, 758, 683, 641, 607], $selections->pluck('fitness')->toArray());
    }

    /** @test */
    public function apply_mutation_strategy()
    {
        $population = new Population(Integers::class, 12);
        $this->assertEquals([90, -52, -1], $population->solutions()[5]->chromosomes());

        $population->mutate();
        $this->assertEquals([90, -83, -1], $population->solutions()[5]->chromosomes());
    }
}
