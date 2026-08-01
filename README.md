[![Github Tests Action Status](https://github.com/navisborealis/wonderwords-php/actions/workflows/unit-tests.yml/badge.svg)](https://github.com/navisborealis/wonderwords-php/actions/workflows/unit-tests.yml)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/navisborealis/wonderwords-php.svg)](https://packagist.org/packages/navisborealis/wonderwords-php)
[![Total Downloads](https://img.shields.io/packagist/dt/navisborealis/wonderwords-php.svg)](https://packagist.org/packages/navisborealis/wonderwords-php)

# Wonderwords PHP

Generate random words, phrases, and grammatically correct sentences in PHP. Perfect for seeding databases with realistic test data, generating unique memorable usernames, or building randomized bots.

## Table of Contents
- [Installation](#installation)
- [Usage](#usage)
  - [Phrases](#phrases)
  - [Words](#words)
  - [Sentences](#sentences)
  - [Profanity Filtering](#profanity-filtering)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Installation

To install the package, run the following command:
```bash 
composer require navisborealis/wonderwords-php
```

## Usage

Generate:
- words - adjectives, nouns or verbs
- phrases - 1+ adjective and 1+ noun, like `Blushing Inspection`
- sentences - this feature is still in development

### Phrases

The phrase structure is `adjective noun`. You can change:
- string separator, default ` `,
- number of adjectives and nouns, default `1`,
- function used to modify the letters case, default `ucwords()`.

To use custom words, see [Changing default word list](#changing-default-word-list).

```php
phrase(
        string $separator = ' ',
        int $numAdjectives = 1,
        int $numNouns = 1,
        callable $stringCaseFunction = null)
```

#### Two-word phrase 

```php
use NavisBorealis\WonderwordsPhp\WonderWordsGenerator;

echo WonderWordsGenerator::phrase(); // Output: Blushing Inspection
```

#### Custom separator

```php
use NavisBorealis\WonderwordsPhp\WonderWordsGenerator;

echo WonderWordsGenerator::phrase('-'); // Output: Blushing-Inspection
```

#### Change adjective and noun count

```php
use NavisBorealis\WonderwordsPhp\WonderWordsGenerator;

echo WonderWordsGenerator::phrase(' ', 2, 3); // Output: Receptive Weary Disease Motive Vegetarian
```

#### Custom casing function

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

Generate one word per category (`Adjective`, `Noun`, `Verb`):

```php
use NavisBorealis\WonderwordsPhp\Words\Adjective;

echo Adjective::randomWord(); // Output: various
```

Or generate multiple words:

```php
use NavisBorealis\WonderwordsPhp\Words\Adjective;

$words = Adjective::randomWords(5); // ["innate", "noiseless", "screeching", "sloppy", "squeamish"]
```

#### Changing default word list

Change the default word list per category:

```php
use NavisBorealis\WonderwordsPhp\WonderWordsGenerator;
use NavisBorealis\WonderwordsPhp\Words\Adjective;

Adjective::setWordList(['customadjective1', 'customadjective2']);

echo WonderWordsGenerator::phrase(); // Output: Customadjective2 Inspection
```
Reset the word list:

```php
use NavisBorealis\WonderwordsPhp\WonderWordsGenerator;
use NavisBorealis\WonderwordsPhp\Words\Adjective;

Adjective::setWordList(['customadjective1', 'customadjective2']);

echo WonderWordsGenerator::phrase(); // Output: Customadjective2 Inspection

Adjective::reset();

echo WonderWordsGenerator::phrase(); // Output: Scientific Inspection
```

#### Advanced Filtering

Filter words by length, starting/ending letters, or regex. Pass an options array to `randomWord()` or `randomWords()`:

```php
use NavisBorealis\WonderwordsPhp\Words\Noun;

// Generate a 5-letter noun starting with 'a' and ending with 'e'
echo Noun::randomWord([
    'starts_with' => 'a',
    'ends_with' => 'e',
    'word_min_length' => 5,
    'word_max_length' => 5
]); // Output: apple

// Generate 3 words matching a custom regex
$words = Noun::randomWords(3, [
    'regex' => '/^b.*y$/'
]); // Output: ["blueberry", "butterfly", "balcony"]
```

### Sentences

Use `WonderWordsSentence` to generate sentences with random nouns and verbs.

```php
use NavisBorealis\WonderwordsPhp\WonderWordsSentence;

// Example: "A dog eats an apple."
echo WonderWordsSentence::simpleSentence(); 

// Example: "The cat runs."
echo WonderWordsSentence::bareBoneSentence();
```

You can also pass filtering options (just like `randomWord`) directly into sentence generators:

```php
// Generate a sentence where the nouns start with 'a' and the verb is exactly 3 letters long
echo WonderWordsSentence::simpleSentence(
    ['starts_with' => 'a'], 
    ['word_min_length' => 3, 'word_max_length' => 3]
);
```

### Profanity Filtering

Check strings for profanity or filter out profane words from arrays:

```php
use NavisBorealis\WonderwordsPhp\Words\Profanity;

// Check a specific string
$isBad = Profanity::isProfanity("piss"); // true

// Filter an array of words
$cleanArray = Profanity::filterProfanity(['apple', 'orange', 'piss']);
// Output: ['apple', 'orange']
```

## Credits

Wonderwords PHP ports the Python `wonderwordsmodule` and uses these projects:

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

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change. Please make sure to update tests as appropriate.

See [CONTRIBUTING.md](CONTRIBUTING.md) for details on running the test suite and code style fixer.

## License

[MIT](https://choosealicense.com/licenses/mit/)