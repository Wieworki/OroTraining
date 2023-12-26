<?php

namespace Oro\Bundle\TrainingBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class OroTrainingBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
