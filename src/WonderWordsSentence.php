<?php

/*
 * This file is part of the WonderWordsPHP package.
 *
 * (c) Piotr Grabski-Gradziński <piotr.gradzinski@navisborealis.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NavisBorealis\WonderwordsPhp;

use NavisBorealis\WonderwordsPhp\Words\Noun;
use NavisBorealis\WonderwordsPhp\Words\Verb;

class WonderWordsSentence
{
    /**
     * Prefix word with vowel-aware article.
     *
     * @param string $word the word to prefix with an article
     *
     * @return string the word prefixed with 'a ' or 'an '
     */
    private static function withArticle(string $word): string
    {
        $vowels = ['a', 'e', 'i', 'o', 'u'];
        $firstLetter = strtolower(substr($word, 0, 1));

        if (in_array($firstLetter, $vowels, true)) {
            return "an $word";
        }

        return "a $word";
    }

    /**
     * Convert verb to 3rd-person singular present tense.
     *
     * @param string $verb the verb to convert
     *
     * @return string the present tense form of the verb
     */
    private static function presentTense(string $verb): string
    {
        $lastChar = substr($verb, -1);
        $lastTwoChars = substr($verb, -2);

        if ('y' === $lastChar && !in_array(substr($verb, -2, 1), ['a', 'e', 'i', 'o', 'u'])) {
            return substr($verb, 0, -1).'ies';
        } elseif (in_array($lastChar, ['s', 'x', 'z'], true) || in_array($lastTwoChars, ['sh', 'ch'], true)) {
            return $verb.'es';
        }

        return $verb.'s';
    }

    /**
     * Generate a bare-bone sentence in the form of
     * `[(article)] [subject (noun)] [predicate (verb)].`
     * Example: `A cat runs.`.
     *
     * @param array $nounOptions options for generating the noun
     * @param array $verbOptions options for generating the verb
     *
     * @return string the generated sentence
     */
    public static function bareBoneSentence(array $nounOptions = [], array $verbOptions = []): string
    {
        $noun = self::withArticle(Noun::randomWord($nounOptions));
        $verb = self::presentTense(Verb::randomWord($verbOptions));

        return ucfirst($noun).' '.$verb.'.';
    }

    /**
     * Generate a simple sentence in the form of
     * `[(article)] [subject (noun)] [predicate (verb)] [direct object (noun)].`
     * Example: `A cake plays golf.`.
     *
     * @param array $nounOptions options for generating the nouns
     * @param array $verbOptions options for generating the verb
     *
     * @return string the generated sentence
     */
    public static function simpleSentence(array $nounOptions = [], array $verbOptions = []): string
    {
        $subject = self::withArticle(Noun::randomWord($nounOptions));
        $verb = self::presentTense(Verb::randomWord($verbOptions));
        $object = self::withArticle(Noun::randomWord($nounOptions));

        return ucfirst($subject).' '.$verb.' '.$object.'.';
    }
}
