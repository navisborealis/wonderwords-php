<?php

/*
 * This file is part of the WonderWordsPHP package.
 *
 * (c) Piotr Grabski-Gradziński <piotr.gradzinski@navisborealis.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NavisBorealis\WonderwordsPhp\Faker;

use Faker\Provider\Base;
use NavisBorealis\WonderwordsPhp\WonderWordsGenerator;
use NavisBorealis\WonderwordsPhp\WonderWordsSentence;

/**
 * A FakerPHP provider for WonderWords.
 *
 * @see https://github.com/FakerPHP/Faker
 */
class WonderWordsProvider extends Base
{
    /**
     * Generate a random phrase combining adjectives and nouns.
     *
     * @param string        $separator          separator between words
     * @param int           $numAdjectives      number of adjectives to generate
     * @param int           $numNouns           number of nouns to generate
     * @param callable|null $stringCaseFunction Function that formats the phrase. Defaults to ucwords().
     *
     * @return string the generated phrase
     */
    public function wonderWordsPhrase(
        string $separator = ' ',
        int $numAdjectives = 1,
        int $numNouns = 1,
        ?callable $stringCaseFunction = null
    ): string {
        return WonderWordsGenerator::phrase($separator, $numAdjectives, $numNouns, $stringCaseFunction);
    }

    /**
     * Generate a bare-bone sentence.
     * Example: `A fluffy cat quickly runs.`.
     *
     * @param array $nounOptions      options for generating the noun
     * @param array $verbOptions      options for generating the verb
     * @param array $adjectiveOptions options for generating the adjective
     * @param array $adverbOptions    options for generating the adverb
     *
     * @return string the generated sentence
     */
    public function wonderWordsBareBoneSentence(
        array $nounOptions = [],
        array $verbOptions = [],
        array $adjectiveOptions = [],
        array $adverbOptions = []
    ): string {
        return WonderWordsSentence::bareBoneSentence($nounOptions, $verbOptions, $adjectiveOptions, $adverbOptions);
    }

    /**
     * Generate a simple sentence.
     * Example: `A fluffy cake quickly plays golf.`.
     *
     * @param array $nounOptions      options for generating the nouns
     * @param array $verbOptions      options for generating the verb
     * @param array $adjectiveOptions options for generating the adjective
     * @param array $adverbOptions    options for generating the adverb
     *
     * @return string the generated sentence
     */
    public function wonderWordsSimpleSentence(
        array $nounOptions = [],
        array $verbOptions = [],
        array $adjectiveOptions = [],
        array $adverbOptions = []
    ): string {
        return WonderWordsSentence::simpleSentence($nounOptions, $verbOptions, $adjectiveOptions, $adverbOptions);
    }

    public function wonderWordsAdjective(array $options = []): string
    {
        return WonderWordsGenerator::adjective($options);
    }

    public function wonderWordsAdverb(array $options = []): string
    {
        return WonderWordsGenerator::adverb($options);
    }

    public function wonderWordsAnimal(array $options = []): string
    {
        return WonderWordsGenerator::animal($options);
    }

    public function wonderWordsColor(array $options = []): string
    {
        return WonderWordsGenerator::color($options);
    }

    public function wonderWordsName(array $options = []): string
    {
        return WonderWordsGenerator::name($options);
    }

    public function wonderWordsFirstName(array $options = []): string
    {
        return WonderWordsGenerator::firstName($options);
    }

    public function wonderWordsLastName(array $options = []): string
    {
        return WonderWordsGenerator::lastName($options);
    }

    public function wonderWordsNoun(array $options = []): string
    {
        return WonderWordsGenerator::noun($options);
    }

    public function wonderWordsProfanity(array $options = []): string
    {
        return WonderWordsGenerator::profanity($options);
    }

    public function wonderWordsTechTerm(array $options = []): string
    {
        return WonderWordsGenerator::techTerm($options);
    }

    public function wonderWordsVerb(array $options = []): string
    {
        return WonderWordsGenerator::verb($options);
    }
}
