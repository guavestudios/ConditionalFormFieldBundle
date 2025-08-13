<?php

declare(strict_types=1);

namespace Guave\ConditionalFormFieldBundle\Tests;

use Guave\ConditionalFormFieldBundle\GuaveConditionalFormFieldBundle;
use PHPUnit\Framework\TestCase;

class GuaveConditionalFormFieldBundleTest extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        $bundle = new GuaveConditionalFormFieldBundle();

        $this->assertInstanceOf('Guave\ConditionalFormFieldBundle\GuaveConditionalFormFieldBundle', $bundle);
    }
}
