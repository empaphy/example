<?php

/**
 * @author    Alwin Garside <alwin@garsi.de>
 * @copyright 2025 The Empaphy Project
 * @license   MIT
 * @package   Example
 */

declare(strict_types=1);

namespace empaphy\example;

/**
 * An Example.
 */
class Example implements ExampleInterface
{
    /**
     * @param  string  $property  A property.
     */
    public function __construct(readonly private string $property) {}

    /**
     * @return string Returns a property.
     */
    public function hello(): string
    {
        return "Hello $this->property!";
    }
}
