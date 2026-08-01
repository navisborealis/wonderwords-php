# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.2.0] - 2026-08-01

### Added
- Added 5 new word dictionaries: `Adverb`, `Name`, `Animal`, `Color`, and `TechTerm`.
- Added proxy methods to `WonderWordsGenerator` for easy access to new categories: `adverb()`, `firstName()`, `lastName()`, `name()`, `animal()`, `color()`, and `techTerm()`.
- Upgraded `WonderWordsSentence` to generate richer sentences using Adjectives and Adverbs.
- Added new keywords to `composer.json` for better discoverability.

### Changed
- **BREAKING (Behavior)**: `WonderWordsSentence::bareBoneSentence()` and `simpleSentence()` now include Adjectives and Adverbs by default, changing the total word count of the generated sentences.

## [1.1.2] - 2026-08-01

### Changed
- **Metadata**: Updated `composer.json` description and keywords to improve package discoverability on Packagist.

## [1.1.1] - 2026-08-01

### Fixed
- **CI**: Fixed GitHub Actions workflow by updating runner environment and resolving composer dependencies for older PHP versions.

## [1.1.0] - 2026-08-01

### Added
- **Profanity Filtering**: Added `Profanity` class with `isProfanity()` and `filterProfanity()` methods to dynamically check strings and clean arrays against a curated list of profanity.
- **Advanced Filtering**: Added an `$options` array parameter to `Words::randomWord()` and `Words::randomWords()` allowing filtering by `starts_with`, `ends_with`, `word_min_length`, `word_max_length`, and custom `regex`.
- **Structured Sentences**: Added `WonderWordsSentence` class capable of generating grammatically correct sentences (`bareBoneSentence()` and `simpleSentence()`), complete with automatic vowel-aware articles and 3rd-person singular present tense verbs.
- **Documentation**: Expanded `README.md` with complete usage examples, a Table of Contents, and an improved introduction.
- **Community Guidelines**: Added `CONTRIBUTING.md` outlining procedures for submitting pull requests, running tests, and fixing code style.

### Changed
- **PHPDoc Standards**: Updated docblocks across the entire codebase to strictly adhere to PSR-5 standards.
- **Testing**: Improved the PHPUnit test suite to explicitly cover boundary conditions (e.g., negative integers, bounds checking) and all newly added filtering/sentence logic.

### Fixed
- **Validation**: Added validation to `WonderWordsGenerator::phrase()` and `Words::randomWords()` to properly throw `InvalidArgumentException` when negative or zero counts are requested, rather than failing silently or causing unexpected array behavior.

## [1.0.0] - 2023-11-08

### Added
- **Initial Release**: Initial PHP port of the `wonderwordsmodule` package, providing random generation of Adjectives, Nouns, Verbs, and basic two-word Phrases.
