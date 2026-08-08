<?php

/*
 * This file is part of the WonderWordsPHP package.
 *
 * (c) Piotr Grabski-Gradziński <piotr.gradzinski@navisborealis.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NavisBorealis\WonderwordsPhp\Tests\Faker;

use Faker\Factory;
use NavisBorealis\WonderwordsPhp\Faker\WonderWordsProvider;
use PHPUnit\Framework\TestCase;

class WonderWordsProviderTest extends TestCase
{
    /** @var \Faker\Generator */
    private $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $this->faker->addProvider(new WonderWordsProvider($this->faker));
    }

    public function testWonderWordsPhrase(): void
    {
        $phrase = $this->faker->wonderWordsPhrase();
        $this->assertIsString($phrase);
        $this->assertNotEmpty($phrase);
        $this->assertStringContainsString(' ', $phrase);
    }

    public function testWonderWordsBareBoneSentence(): void
    {
        $sentence = $this->faker->wonderWordsBareBoneSentence();
        $this->assertIsString($sentence);
        $this->assertStringEndsWith('.', $sentence);
    }

    public function testWonderWordsSimpleSentence(): void
    {
        $sentence = $this->faker->wonderWordsSimpleSentence();
        $this->assertIsString($sentence);
        $this->assertStringEndsWith('.', $sentence);
    }

    public function testWonderWordsAdjective(): void
    {
        $word = $this->faker->wonderWordsAdjective();
        $this->assertIsString($word);
        $this->assertNotEmpty($word);
    }

    public function testWonderWordsAnimal(): void
    {
        $word = $this->faker->wonderWordsAnimal();
        $this->assertIsString($word);
        $this->assertNotEmpty($word);
    }
}
