<?php

namespace PeterColes\GAO\Tests;

use PeterColes\GAO\Optimiser;
use PHPUnit\Framework\TestCase;

class OptimiserTest extends TestCase
{
    /** @test */
    public function can_load_evaluation_data_after_gao_construction_and_run_optimiser()
    {
        $gao = new Optimiser();
        $gao->loadEvaluationData('anything');
        $gao->run();
        $this->addToAssertionCount(1);
    }

    /** @test */
    public function can_load_evaluation_data_during_gao_construction_and_run_optimiser()
    {
        $gao = new Optimiser(['evaluationData' => 'something']);
        $gao->run();
        $this->addToAssertionCount(1);
    }
}
