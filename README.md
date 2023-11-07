[![Github Tests Action Status](https://github.com/navisborealis/wonderwords-php/actions/workflows/unit-tests.yml/badge.svg)](https://github.com/navisborealis/wonderwords-php/actions/workflows/unit-tests.yml)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/navisborealis/wonderwords-php.svg)](https://packagist.org/packages/navisborealis/wonderwords-php)
[![Total Downloads](https://img.shields.io/packagist/dt/navisborealis/wonderwords-php.svg)](https://packagist.org/packages/navisborealis/wonderwords-php)

# Wonderwords PHP

Generate random words, phrases and sentences with ease in PHP.

## Installation

To install the package, run the following command:
```bash 
composer require navisborealis/wonderwords-php
```

## Usage

With this library you can generate:
- words - adjectives, nouns or verbs
- phrases - 1+ adjective and 1+ noun, like `Blushing Inspection`
- sentences - this feature is still in development

### Phrases

Basic structure of the phrase is `adjective noun`. You can change:
- string separator, default ` `,
- number of adjectives and nouns, default `1`,
- function used to modify the letters case, default `ucwords()`.

To use your own list of words see [Changing default word list](#changing-default-word-list).

```php
phrase(
        string $separator = ' ',
        int $numAdjectives = 1,
        int $numNouns = 1,
        callable $stringCaseFunction = null)
```

#### Generic, two word, space separated phrase 

```php
use NavisBorealis\WonderwordsPhp\WonderWordsGenerator;

echo WonderWordsGenerator::phrase(); // Output: Blushing Inspection
```

#### Custom separator

```php
use NavisBorealis\WonderwordsPhp\WonderWordsGenerator;

echo WonderWordsGenerator::phrase('-'); // Output: Blushing-Inspection
```

#### Different number of adjectives and nouns

```php
use NavisBorealis\WonderwordsPhp\WonderWordsGenerator;

echo WonderWordsGenerator::phrase(' ', 2, 3); // Output: Receptive Weary Disease Motive Vegetarian
```

#### Custom function to change letters casing

```php
use NavisBorealis\WonderwordsPhp\WonderWordsGenerator;

echo WonderWordsGenerator::phrase(' ', 1, 1, 'strtoupper'); // Output: BLUSHING INSPECTION
```

```php
use NavisBorealis\WonderwordsPhp\WonderWordsGenerator;

echo WonderWordsGenerator::phrase(' ', 1, 1, function ($phrase) {
    return ucfirst($phrase);
}); // Output: Blushing inspection
```

### Words

#### Generating words

From each category (`Adjective`, `Noun`, `Verb`) you can generate a single word:

```php
use NavisBorealis\WonderwordsPhp\Words\Adjective;

echo Adjective::randomWord(); // Output: various
```

or an array of words:

```php
use NavisBorealis\WonderwordsPhp\Words\Adjective;

$words = Adjective::randomWords(5); // ["innate", "noiseless", "screeching", "sloppy", "squeamish"]
```

#### Changing default word list

For each word category (`Adjective`, `Noun`, `Verb`) you can change the default word list:

```php
use NavisBorealis\WonderwordsPhp\WonderWordsGenerator;
use NavisBorealis\WonderwordsPhp\Words\Adjective;

Adjective::setWordList(['customadjective1', 'customadjective2']);

echo WonderWordsGenerator::phrase(); // Output: Customadjective2 Inspection
```
also, you can reset word list to its defaults:

```php
use NavisBorealis\WonderwordsPhp\WonderWordsGenerator;
use NavisBorealis\WonderwordsPhp\Words\Adjective;

Adjective::setWordList(['customadjective1', 'customadjective2']);

echo WonderWordsGenerator::phrase(); // Output: Customadjective2 Inspection

Adjective::reset();

echo WonderWordsGenerator::phrase(); // Output: Scientific Inspection
```


### Sentences

In development...

## Credits

Wonderwords PHP is based on `wonderwordsmodule` python module and has been made possible thanks to the following works:

- [`wonderwordsmodule` for python](https://github.com/mrmaxguns/wonderwordsmodule) under
  the [MIT License](https://github.com/mrmaxguns/wonderwordsmodule/blob/master/LICENSE)
- `profanitylist.txt` from
  [RobertJGabriel/Google-profanity-words](https://github.com/RobertJGabriel/Google-profanity-words)
  under the
  [Apache-2.0 license](https://github.com/RobertJGabriel/Google-profanity-words/blob/master/LICENSE)
- [PhraseGenerator](https://github.com/samuelwilliams/PhraseGenerator) under
  the [MIT License](https://github.com/samuelwilliams/PhraseGenerator/blob/master/LICENSE)
- [word-generator](https://github.com/claudiodekker/word-generator/) under
  the [MIT license](https://github.com/claudiodekker/word-generator/blob/master/LICENSE.md)