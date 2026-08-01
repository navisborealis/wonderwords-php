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

/**
 * Class Name.
 *
 * Contains dictionaries of first and last names.
 */
class Name extends Words
{
    public static $words;

    public const FIRST_NAMES = [
        'Alice',
        'Bob',
        'Charlie',
        'David',
        'Eve',
        'Frank',
        'Grace',
        'Heidi',
        'Ivan',
        'Judy',
        'Mallory',
        'Oscar',
        'Peggy',
        'Sybil',
        'Trent',
        'Victor',
        'Walter',
        'Arthur',
        'Betty',
        'Clarence',
        'Dorothy',
        'Edward',
        'Florence',
        'George',
        'Helen',
        'Isaac',
        'Jane',
        'Kevin',
        'Laura',
        'Michael',
        'Nancy',
        'Oliver',
        'Patricia',
        'Quinn',
        'Rachel',
        'Steven',
        'Tracy',
        'Ulysses',
        'Victoria',
        'William',
        'Xena',
        'Yvonne',
        'Zachary',
        'Aaron',
        'Brenda',
        'Colin',
        'Diane',
        'Ethan',
        'Fiona',
        'Gavin',
        'Hannah',
        'Ian',
        'Julia',
    ];

    public const LAST_NAMES = [
        'Smith',
        'Johnson',
        'Williams',
        'Jones',
        'Brown',
        'Davis',
        'Miller',
        'Wilson',
        'Moore',
        'Taylor',
        'Anderson',
        'Thomas',
        'Jackson',
        'White',
        'Harris',
        'Martin',
        'Thompson',
        'Garcia',
        'Martinez',
        'Robinson',
        'Clark',
        'Rodriguez',
        'Lewis',
        'Lee',
        'Walker',
        'Hall',
        'Allen',
        'Young',
        'Hernandez',
        'King',
        'Wright',
        'Lopez',
        'Hill',
        'Scott',
        'Green',
        'Adams',
        'Baker',
        'Gonzalez',
        'Nelson',
        'Carter',
        'Mitchell',
        'Perez',
        'Roberts',
        'Turner',
        'Phillips',
        'Campbell',
        'Parker',
        'Evans',
        'Edwards',
        'Collins',
        'Stewart',
    ];

    public const DEFAULT_WORDS = self::FIRST_NAMES;

    /**
     * Get a random first name.
     *
     * @param array $options filtering options
     */
    public static function firstName(array $options = []): string
    {
        $backup = static::$words;
        static::$words = self::FIRST_NAMES;
        $filteredWords = static::applyFilters($options);
        static::$words = $backup;

        return $filteredWords[array_rand($filteredWords)];
    }

    /**
     * Get a random last name.
     *
     * @param array $options filtering options
     */
    public static function lastName(array $options = []): string
    {
        $backup = static::$words;
        static::$words = self::LAST_NAMES;
        $filteredWords = static::applyFilters($options);
        static::$words = $backup;

        return $filteredWords[array_rand($filteredWords)];
    }
}
