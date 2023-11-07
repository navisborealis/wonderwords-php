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
    public const DEFAULT_WORDS = [];

    public static $words;

    /**
     * Get a random word.
     */
    public static function randomWord(): string
    {
        if (empty(static::$words)) {
            static::setWordList(static::DEFAULT_WORDS);
        }

        return static::$words[array_rand(static::$words)];
    }

    /**
     * Get a random word.
     *
     * @param int $num number of words
     *
     * @return array[string]
     */
    public static function randomWords(int $num = 1): array
    {
        if (empty(static::$words)) {
            static::setWordList(static::DEFAULT_WORDS);
        }

        if ($num < 1) {
            throw new \InvalidArgumentException('Number of words must be positive');
        } elseif (1 == $num) {
            return [static::randomWord()];
        }

        return array_map(function ($key) {
            return static::$words[$key];
        }, array_rand(static::$words, $num));
    }

    /**
     * Set the possible words that can be returned.
     *
     * @param string[] $words
     *
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
