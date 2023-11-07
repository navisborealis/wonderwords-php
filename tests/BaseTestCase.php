<?php

namespace NavisBorealis\WonderwordsPhp\Tests;

use NavisBorealis\WonderwordsPhp\Words\Adjective;
use NavisBorealis\WonderwordsPhp\Words\Noun;
use NavisBorealis\WonderwordsPhp\Words\Verb;
use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    public function setUp(): void
    {
        Adjective::reset();
        Noun::reset();
        Verb::reset();
    }

    /**
     * @throws \ReflectionException
     */
    public static function wordsClassProvider(): array
    {
        return [
            [(new \ReflectionClass(Adjective::class))->newInstanceWithoutConstructor()],
            [(new \ReflectionClass(Noun::class))->newInstanceWithoutConstructor()],
            [(new \ReflectionClass(Verb::class))->newInstanceWithoutConstructor()],
        ];
    }
}
