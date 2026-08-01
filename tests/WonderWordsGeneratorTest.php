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
}
