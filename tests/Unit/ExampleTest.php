<?php

/**
 * @noinspection StaticClosureCanBeUsedInspection
 */

declare(strict_types=1);

namespace Pest;

use empaphy\example\Example;

describe('Example`::`hello()', function () {
    test('prefixes text with "Hello"', function () {
        $example = new Example('world');
        $hello = $example->hello();

        expect($hello)->toBe('Hello world!');
    });
});
