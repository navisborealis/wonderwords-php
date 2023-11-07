<?php

namespace NavisBorealis\WonderwordsPhp\Tests;

use NavisBorealis\WonderwordsPhp\Exceptions\EmptyWordsListException;
use NavisBorealis\WonderwordsPhp\Words\Words;

class WordsTest extends BaseTestCase
{
    /**
     * @dataProvider wordsClassProvider
     */
    public function testGetsRandomWord(Words $wordsInstance)
    {
        $this->assertIsString($wordsInstance::randomWord());
        $this->assertTrue((bool) $wordsInstance::randomWord());
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
        $this->assertEquals('word', $wordsInstance::randomWord());
    }

    /**
     * @dataProvider wordsClassProvider
     */
    public function testResetWords(Words $wordsInstance)
    {
        $wordsInstance::setWordList(['asdqweasd']);
        $this->assertEquals('asdqweasd', $wordsInstance::randomWord());

        $wordsInstance::reset();

        $this->assertNotContains('asdqweasd', $wordsInstance::$words);
    }

    /**
     * @dataProvider wordsClassProvider
     */
    public function testPositiveGettingRandomWords(Words $wordsInstance)
    {
        $words = $wordsInstance::randomWords();
        $this->assertCount(1, $words);

        $words = $wordsInstance::randomWords(5);
        $this->assertCount(5, $words);
    }

    /**
     * @dataProvider wordsClassProvider
     */
    public function testNegativeGettingRandomWords(Words $wordsInstance)
    {
        $this->expectException(\InvalidArgumentException::class);
        $wordsInstance::randomWords(-5);
    }
}
