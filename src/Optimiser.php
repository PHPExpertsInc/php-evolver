<?php

namespace PeterColes\GAO;

use PeterColes\GAO\Exceptions\EvaluationDataException;

class Optimiser
{
    protected $evaluationData = null;

    public function __construct()
    {
        //
    }

    public function run()
    {
        if (!$this->evaluationData) {
            throw new EvaluationDataException('No data against which to evaluate fitness');
        }
    }
}
