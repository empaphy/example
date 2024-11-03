<?php

/**
 * @noinspection StaticClosureCanBeUsedInspection
 */

declare(strict_types=1);

namespace Tests\Unit;

use empaphy\example\Example;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\TestCase;

#[CoversClass(Example::class)]
class ExampleTest extends TestCase
{
    public function testExample(): void
    {
        $example = new Example('Example');

        $this->assertSame('Hello, Example!', $example->example());
    }
}
