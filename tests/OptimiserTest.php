<?php

namespace PHPExperts\GAO\Tests;

use PHPExperts\GAO\Breeder;
use PHPExperts\GAO\Population;
use PHPUnit\Framework\TestCase;
use PHPExperts\GAO\Tests\Solutions\Mixed;

class BreederTest extends TestCase
{
    /** @test */
    public function can_load_evaluation_data_after_gao_construction_and_run_optimiser()
    {
        $gao = new Breeder(new Population(Mixed::class, 10));
        $gao->loadEvaluationData('anything');
        $gao->run();
        $this->addToAssertionCount(1);
    }

    /** @test */
    public function can_load_evaluation_data_during_gao_construction_and_run_optimiser()
    {
        $gao = new Breeder(new Population(Mixed::class, 10), ['evaluationData' => 'something']);
        $gao->run();
        $this->addToAssertionCount(1);
    }

    /** @test */
    public function running_optimiser_yields_results_for_each_generation()
    {
        $optimiser = new Breeder(new Population(Mixed::class, 10));
        $optimiser->run();

        $this->assertCount(10, $optimiser->results);
        foreach ($optimiser->results as $result) {
            $this->assertInstanceOf(Mixed::class, $result);
        }
    }

    /** @test */
    public function number_of_generations_is_controllable()
    {
        $optimiser = new Breeder(new Population(Mixed::class, 10), ['maxGenerations' => 5]);
        $optimiser->run();

        $this->assertCount(5, $optimiser->results);
    }
}
