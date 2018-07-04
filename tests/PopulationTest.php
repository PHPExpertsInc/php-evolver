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

        $this->assertEquals(['B', 0.8473, -57], $best->chromosomes(), '', 0.0001);
        $this->assertEquals(10.6226, $best->fitness, '', 0.0001);
    }

    /** @test */
    public function can_evaluate_a_population_with_evaluation_data()
    {
        $population = new Population(Integers::class, 3);
        $evalData = [[2, -1, 90], [3, 0, 85], [1, -2, 82]];
        $population->evaluate($evalData);
        $best = $population->findBest();

        $this->assertEquals(7, $best->fitness, '', 0.0001);
        $this->assertEquals([42, -4, -1], $best->chromosomes(), '', 0.0001);
    }

    /** @test */
    public function apply_selection_strategy()
    {
        $population = new Population(Integers::class, 12);
        $evalData = [[2, -1, 90], [3, 0, 85], [1, -2, 82]];
        $population->evaluate($evalData);
        $selections = $population->select(6);

        $this->assertCount(6, $selections);
        $this->assertEquals([7, 330, 345, 385, 439, 494], $selections->pluck('fitness')->toArray());
    }

    /** @test */
    public function apply_crossover_strategy()
    {
        $population = new Population(Integers::class, 12);
        $selections = collect($population->solutions())->take(6);
        $this->assertEquals([64, -39, 1], $population->solutions()[0]->chromosomes());

        $population->crossover($selections);
        $this->assertEquals([82, -93, 0], $population->solutions()[0]->chromosomes());
        $this->assertEquals([82, -39, 1], $population->solutions()[2]->chromosomes());
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
