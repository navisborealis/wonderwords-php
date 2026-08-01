<?php

/*
 * This file is part of the WonderWordsPHP package.
 *
 * (c) Piotr Grabski-Gradziński <piotr.gradzinski@navisborealis.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NavisBorealis\WonderwordsPhp\Tests;

use NavisBorealis\WonderwordsPhp\WonderWordsGenerator;
use NavisBorealis\WonderwordsPhp\Words\Adjective;
use NavisBorealis\WonderwordsPhp\Words\Noun;
use NavisBorealis\WonderwordsPhp\Words\Verb;

class WonderWordsGeneratorTest extends BaseTestCase
{
    public function testTwoWordPhrase()
    {
        Adjective::setWordList(['funny']);
        Noun::setWordList(['mug']);

        $this->assertEquals(
            'Funny Mug',
            WonderWordsGenerator::phrase()
        );
        $this->assertEquals(
            'Funny-Mug',
            WonderWordsGenerator::phrase('-')
        );
        $this->assertEquals(
            'funny mug',
            WonderWordsGenerator::phrase(' ', 1, 1, 'strtolower')
        );
        $this->assertEquals(
            'FUNNY MUG',
            WonderWordsGenerator::phrase(' ', 1, 1, 'strtoupper')
        );
        $this->assertEquals(
            'funny mug',
            WonderWordsGenerator::phrase(' ', 1, 1, function ($phrase) {
                return $phrase;
            })
        );
    }

    public function testCountedWordsPhrase()
    {
        $phrase = WonderWordsGenerator::phrase();
        $this->assertCount(2, explode(' ', $phrase));

        $phrase = WonderWordsGenerator::phrase(' ', 2, 3);
        $this->assertCount(5, explode(' ', $phrase));
    }

    public function testZeroAdjectives()
    {
        Noun::setWordList(['mug']);
        $this->assertEquals('Mug', WonderWordsGenerator::phrase(' ', 0, 1));
    }

    public function testZeroNouns()
    {
        Adjective::setWordList(['funny']);
        $this->assertEquals('Funny', WonderWordsGenerator::phrase(' ', 1, 0));
    }

    public function testZeroWordsThrowsException()
    {
        $this->expectException(\InvalidArgumentException::class);
        WonderWordsGenerator::phrase(' ', 0, 0);
    }

    public function testNegativeWordsThrowsException()
    {
        $this->expectException(\InvalidArgumentException::class);
        WonderWordsGenerator::phrase(' ', -1, 1);
    }

    public function testProxyMethods()
    {
        \NavisBorealis\WonderwordsPhp\Words\Adverb::setWordList(['quickly']);
        \NavisBorealis\WonderwordsPhp\Words\Animal::setWordList(['cat']);
        \NavisBorealis\WonderwordsPhp\Words\Color::setWordList(['blue']);
        \NavisBorealis\WonderwordsPhp\Words\Name::setWordList(['Alice']);
        \NavisBorealis\WonderwordsPhp\Words\Profanity::setWordList(['badword']);
        \NavisBorealis\WonderwordsPhp\Words\TechTerm::setWordList(['api']);
        Noun::setWordList(['box']);
        Verb::setWordList(['eat']);
        Adjective::setWordList(['tall']);

        $this->assertEquals('quickly', WonderWordsGenerator::adverb());
        $this->assertEquals('cat', WonderWordsGenerator::animal());
        $this->assertEquals('blue', WonderWordsGenerator::color());
        $this->assertEquals('Alice', WonderWordsGenerator::name());
        $this->assertEquals('badword', WonderWordsGenerator::profanity());
        $this->assertEquals('api', WonderWordsGenerator::techTerm());
        $this->assertEquals('box', WonderWordsGenerator::noun());
        $this->assertEquals('eat', WonderWordsGenerator::verb());
        $this->assertEquals('tall', WonderWordsGenerator::adjective());

        $this->assertIsString(WonderWordsGenerator::firstName());
        $this->assertIsString(WonderWordsGenerator::lastName());
    }
}
