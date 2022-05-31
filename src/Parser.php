<?php

declare(strict_types=1);

/*
 * This file is part of terminal42/contao-inserttags.
 *
 * (c) terminal42
 *
 * @license MIT
 */

namespace Terminal42\InsertTagsBundle;

use Contao\CoreBundle\InsertTag\InsertTagParser;
use Contao\CoreBundle\String\SimpleTokenParser;

class Parser
{
    public function __construct(
        private InsertTagParser $insertTagParser,
        private SimpleTokenParser $simpleTokenParser,
    ) {
    }

    /**
     * Parse the replacement data.
     */
    public function parse(string $replacement, array $tokens): string
    {
        $replacement = $this->stripComments($replacement);
        $replacement = $this->insertTagParser->replaceInline($replacement);
        $replacement = $this->simpleTokenParser->parse($replacement, $tokens);

        return $replacement;
    }

    /**
     * Strip the comments.
     */
    private function stripComments(string $value): string
    {
        $newValue = [];

        foreach (explode("\n", $value) as $line) {
            // Skip comments
            if (str_starts_with($line, '#')) {
                continue;
            }

            // Honor the escaped comments
            if (str_starts_with($line, '\#')) {
                $line = substr($line, 1);
            }

            $newValue[] = $line;
        }

        return implode("\n", $newValue);
    }
}
