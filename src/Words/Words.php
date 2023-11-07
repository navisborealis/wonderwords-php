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

use NavisBorealis\WonderwordsPhp\Exceptions\EmptyWordsListException;

abstract class Words
{
    public static $words = [];

    public const DEFAULT_WORDS = [];

    /**
     * Get a random word.
     */
    public static function random(): string
    {
        if (empty(static::$words)) {
            static::setWordList(static::DEFAULT_WORDS);
        }

        return static::$words[array_rand(static::$words)];
    }

    /**
     * Set the possible words that can be returned.
     *
     * @param string[] $words
     * @throws \NavisBorealis\WonderwordsPhp\Exceptions\EmptyWordsListException
     */
    public static function setWordList(array $words): void
    {
        if (!$words) {
            throw new EmptyWordsListException();
        }

        static::$words = $words;
    }

    /**
     * Reset the words to their original word lists.
     */
    public static function reset(): void
    {
        static::setWordList(static::DEFAULT_WORDS);
    }
}
