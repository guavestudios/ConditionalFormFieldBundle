<?php

namespace Guave\ConditionalFormFieldBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GuaveConditionalFormFieldBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
