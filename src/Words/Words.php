<?php

/*
 * This file is part of the WonderWordsPHP package.
 *
 * (c) Piotr Grabski-Gradziński <piotr.gradzinski@navisborealis.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NavisBorealis\WonderwordsPhp\Words;

abstract class Words
{
    public static $words = [];

    public const DEFAULT_WORDS = [];

    /**
     * Get a random word.
     */
    public static function random(): string
    {
        if (empty(self::$words)) {
            self::setWordList(self::DEFAULT_WORDS);
        }

        return self::$words[array_rand(self::$words)];
    }

    /**
     * Set the possible words that can be returned.
     *
     * @param string[] $words
     */
    public static function setWordList(array $words = []): void
    {
        self::$words = $words;
    }

    /**
     * Reset the words to their original word lists.
     */
    public static function reset(): void
    {
        self::setWordList(self::DEFAULT_WORDS);
    }
}
