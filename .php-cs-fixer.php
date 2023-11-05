<?php

$header = <<<'EOF'
This file is part of the WonderWordsPHP package.

(c) Piotr Grabski-Gradziński <piotr.gradzinski@navisborealis.io>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/tests')
;

$config = (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules(array(
        '@Symfony' => true,
        'header_comment' => array('header' => $header),
        'array_syntax' => array('syntax' => 'short'),
    ))
    ->setFinder($finder)
;

return $config;