<?php

namespace PeterColes\GAO;

class Optimiser
{
    protected $evaluationData = null;

    public function __construct($params = [])
    {
        collect($params)->each(function ($value, $key) {
            $this->$key = $value;
        });
    }

    public function run()
    {
        //
    }

    public function loadEvaluationData($data)
    {
        $this->evaluationData = $data;
    }
}
