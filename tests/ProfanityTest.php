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

use NavisBorealis\WonderwordsPhp\Words\Profanity;
use PHPUnit\Framework\TestCase;

class ProfanityTest extends TestCase
{
    public function setUp(): void
    {
        Profanity::setWordList(['badword1', 'badword2', 'piss']);
    }

    public function testIsProfanity()
    {
        $this->assertTrue(Profanity::isProfanity('badword1'));
        $this->assertTrue(Profanity::isProfanity(' BADword2 '));
        $this->assertTrue(Profanity::isProfanity('piss'));

        $this->assertFalse(Profanity::isProfanity('goodword'));
    }

    public function testFilterProfanity()
    {
        $words = ['apple', 'badword1', 'orange', 'PISS'];
        $filtered = Profanity::filterProfanity($words);

        $this->assertCount(2, $filtered);
        $this->assertEquals(['apple', 'orange'], $filtered);
    }
}
