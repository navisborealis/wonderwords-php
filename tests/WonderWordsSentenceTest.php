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

use NavisBorealis\WonderwordsPhp\WonderWordsSentence;
use NavisBorealis\WonderwordsPhp\Words\Noun;
use NavisBorealis\WonderwordsPhp\Words\Verb;
use PHPUnit\Framework\TestCase;

class WonderWordsSentenceTest extends TestCase
{
    public function setUp(): void
    {
        Noun::setWordList(['cat', 'apple', 'dog', 'box']);
        Verb::setWordList(['run', 'play', 'eat', 'fly', 'fix']);
        \NavisBorealis\WonderwordsPhp\Words\Adjective::setWordList(['fluffy']);
        \NavisBorealis\WonderwordsPhp\Words\Adverb::setWordList(['quickly']);
    }

    public function testBareBoneSentence()
    {
        $sentence = WonderWordsSentence::bareBoneSentence();

        $this->assertStringEndsWith('.', $sentence);
        $this->assertTrue(ctype_upper(substr($sentence, 0, 1)));

        $words = explode(' ', substr($sentence, 0, -1));
        $this->assertCount(5, $words); // article adjective noun adverb verb
    }

    public function testSimpleSentence()
    {
        $sentence = WonderWordsSentence::simpleSentence();

        $this->assertStringEndsWith('.', $sentence);
        $this->assertTrue(ctype_upper(substr($sentence, 0, 1)));

        $words = explode(' ', substr($sentence, 0, -1));
        $this->assertCount(8, $words); // article adjective noun adverb verb article adjective noun
    }
}
