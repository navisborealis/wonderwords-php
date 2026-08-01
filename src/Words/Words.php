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
     *
     * @param array $options filtering options: starts_with, ends_with, word_min_length, word_max_length, regex
     *
     * @return string a randomly selected word
     *
     * @throws \RuntimeException       if no words match the given filters
     * @throws EmptyWordsListException if the word list is empty
     */
    public static function randomWord(array $options = []): string
    {
        if (empty(static::$words)) {
            static::setWordList(static::DEFAULT_WORDS);
        }

        $filteredWords = static::applyFilters($options);

        return $filteredWords[array_rand($filteredWords)];
    }

    /**
     * Generate random words.
     *
     * @param int   $num     number of words to generate
     * @param array $options filtering options: starts_with, ends_with, word_min_length, word_max_length, regex
     *
     * @return string[] an array of randomly selected words
     *
     * @throws \InvalidArgumentException if the number of words is less than 1 or exceeds the available words
     * @throws \RuntimeException         if no words match the given filters
     * @throws EmptyWordsListException   if the word list is empty
     */
    public static function randomWords(int $num = 1, array $options = []): array
    {
        if (empty(static::$words)) {
            static::setWordList(static::DEFAULT_WORDS);
        }

        $filteredWords = static::applyFilters($options);

        if ($num < 1) {
            throw new \InvalidArgumentException('Number of words must be positive');
        } elseif ($num > count($filteredWords)) {
            throw new \InvalidArgumentException('Cannot request more words than are available in the word list');
        } elseif (1 == $num) {
            return [static::randomWord($options)];
        }

        return array_map(function ($key) use ($filteredWords) {
            return $filteredWords[$key];
        }, array_rand($filteredWords, $num));
    }

    /**
     * Filter word list.
     *
     * @param array $options filtering options
     *
     * @return string[] list of filtered words
     *
     * @throws \RuntimeException if no words match the given filters
     */
    protected static function applyFilters(array $options): array
    {
        if (empty($options)) {
            return static::$words;
        }

        $filtered = static::$words;

        if (!empty($options['starts_with'])) {
            $filtered = array_filter($filtered, function ($w) use ($options) {
                return 0 === stripos($w, $options['starts_with']);
            });
        }

        if (!empty($options['ends_with'])) {
            $filtered = array_filter($filtered, function ($w) use ($options) {
                $len = strlen($options['ends_with']);

                return 0 === strcasecmp(substr($w, -$len), $options['ends_with']);
            });
        }

        if (isset($options['word_min_length'])) {
            $filtered = array_filter($filtered, function ($w) use ($options) {
                return strlen($w) >= $options['word_min_length'];
            });
        }

        if (isset($options['word_max_length'])) {
            $filtered = array_filter($filtered, function ($w) use ($options) {
                return strlen($w) <= $options['word_max_length'];
            });
        }

        if (!empty($options['regex'])) {
            $filtered = array_filter($filtered, function ($w) use ($options) {
                return 1 === preg_match($options['regex'], $w);
            });
        }

        $filtered = array_values($filtered);

        if (empty($filtered)) {
            throw new \RuntimeException('No words match the given filters');
        }

        return $filtered;
    }

    /**
     * Set available words.
     *
     * @param string[] $words an array of words
     *
     * @throws EmptyWordsListException if the provided array is empty
     */
    public static function setWordList(array $words): void
    {
        if (!$words) {
            throw new EmptyWordsListException();
        }

        static::$words = $words;
    }

    /**
     * Restore default words.
     */
    public static function reset(): void
    {
        static::setWordList(static::DEFAULT_WORDS);
    }
}
