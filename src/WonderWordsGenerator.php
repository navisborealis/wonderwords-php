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

use NavisBorealis\WonderwordsPhp\Words\Adjective;
use NavisBorealis\WonderwordsPhp\Words\Noun;

class WonderWordsGenerator
{
    /**
     * @param callable|null $stringCaseFunction function that accepts whole phrase and converts letters. By default,
     *                                          ucwords() will be used.
     *
     * @see StringCase
     */
    public static function phrase(
        string $separator = ' ',
        int $numAdjectives = 1,
        int $numNouns = 1,
        ?callable $stringCaseFunction = null
    ): string {
        if ($numAdjectives < 0 || $numNouns < 0) {
            throw new \InvalidArgumentException('Number of adjectives and nouns must be non-negative');
        }
        if ($numAdjectives === 0 && $numNouns === 0) {
            throw new \InvalidArgumentException('At least one word must be generated');
        }

        $adjectives = $numAdjectives > 0 ? Adjective::randomWords($numAdjectives) : [];
        $nouns = $numNouns > 0 ? Noun::randomWords($numNouns) : [];
        $words = array_merge($adjectives, $nouns);

        $phrase = join($separator, $words);

        return $stringCaseFunction ? $stringCaseFunction($phrase) : ucwords($phrase, $separator);
    }
}
