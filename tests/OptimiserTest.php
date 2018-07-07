<?php

namespace PeterColes\GAO\Tests;

use PeterColes\GAO\Optimiser;
use PeterColes\GAO\Population;
use PHPUnit\Framework\TestCase;
use PeterColes\GAO\Tests\Solutions\Mixed;

class OptimiserTest extends TestCase
{
    /** @test */
    public function can_load_evaluation_data_after_gao_construction_and_run_optimiser()
    {
        $gao = new Optimiser(new Population(Mixed::class, 10));
        $gao->loadEvaluationData('anything');
        $gao->run();
        $this->addToAssertionCount(1);
    }

    /** @test */
    public function can_load_evaluation_data_during_gao_construction_and_run_optimiser()
    {
        $gao = new Optimiser(new Population(Mixed::class, 10), ['evaluationData' => 'something']);
        $gao->run();
        $this->addToAssertionCount(1);
    }

    /** @test */
    public function running_optimiser_yields_results_for_each_generation()
    {
        $optimiser = new Optimiser(new Population(Mixed::class, 10));
        $optimiser->run();

        $this->assertCount(10, $optimiser->results);
        foreach ($optimiser->results as $result) {
            $this->assertInstanceOf(Mixed::class, $result);
        }
    }

    /** @test */
    public function number_of_generations_is_controllable()
    {
        $optimiser = new Optimiser(new Population(Mixed::class, 10), ['maxGenerations' => 5]);
        $optimiser->run();

        $this->assertCount(5, $optimiser->results);
    }
}
