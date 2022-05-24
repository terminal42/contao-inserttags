<?php

declare(strict_types=1);

/*
 * This file is part of terminal42/contao-inserttags.
 *
 * (c) terminal42
 *
 * @license MIT
 */

$GLOBALS['TL_LANG']['XPL']['customInsertTags'] = [
    ['Evaluation tokens', 'These tokens can be used in conditional statements.'],
    ['<code>member.*</code>', 'Evaluate the current member tokens, if logged in.<br>Example: <code>member.id</code> or <code>member.firstname</code> or <code>member.groups</code>.'],
    ['<code>page.*</code>', 'Evaluate the page tokens.<br>Example: <code>page.id</code> or <code>page.trail</code>.'],
    ['Replacement tokens', 'These tokens can be used to output the data.'],
    ['<code>##member_*##</code>', 'Replace the current member tokens.'],
    ['<code>##page_*##</code>', 'Replace the current page tokens.'],
    ['', 'View the full documentation at Github. <a href="https://github.com/terminal42/contao-inserttags/blob/main/README.md" target="_blank" rel="noreferrer">View the documentation</a>.'],
];
