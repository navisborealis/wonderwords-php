<?php

namespace NavisBorealis\WonderwordsPhp\Tests;

use NavisBorealis\WonderwordsPhp\Exceptions\EmptyWordsListException;
use NavisBorealis\WonderwordsPhp\Words\Adjective;
use NavisBorealis\WonderwordsPhp\Words\Noun;
use NavisBorealis\WonderwordsPhp\Words\Verb;
use NavisBorealis\WonderwordsPhp\Words\Words;
use PHPUnit\Framework\TestCase;

class WordsTest extends TestCase
{
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

    /**
     * @dataProvider wordsClassProvider
     */
    public function testGetsRandomWord(Words $wordsInstance)
    {
        $this->assertIsString($wordsInstance::random());
        $this->assertTrue((bool) $wordsInstance::random());
    }

    /**
     * @dataProvider wordsClassProvider
     */
    public function testSetWordListWithEmptyArray(Words $wordsInstance)
    {
        $this->expectException(EmptyWordsListException::class);
        $wordsInstance::setWordList([]);
    }

    /**
     * @dataProvider wordsClassProvider
     */
    public function testSetWordList(Words $wordsInstance)
    {
        $wordsInstance::setWordList(['word']);
        $this->assertEquals('word', $wordsInstance::random());
    }

    /**
     * @dataProvider wordsClassProvider
     */
    public function testResetWords(Words $wordsInstance)
    {
        $wordsInstance::setWordList(['asdqweasd']);
        $this->assertEquals('asdqweasd', $wordsInstance::random());

        $wordsInstance::reset();

        $this->assertNotContains('asdqweasd', $wordsInstance::$words);
    }
}
