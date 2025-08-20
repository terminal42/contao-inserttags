<?php

declare(strict_types=1);

$GLOBALS['TL_LANG']['XPL']['customInsertTags'] = [
    ['評価トークン', 'これらのトークンを条件文の中で使用できます。'],
    ['<code>member.*</code>', 'ログインしている場合に、そのメンバーのトークンを評価します。<br>例: <code>member.id</code>、<code>member.firstname</code>、<code>member.groups</code>。'],
    ['<code>page.*</code>', 'ページのトークンを評価します。<br>例: <code>page.id</code>、<code>page.trail</code>。'],
    ['置き換えのトークン', 'これらのトークンをデータの出力に使用できます。'],
    ['<code>##member_*##</code>', '現在のメンバーのトークンに置き換えます。'],
    ['<code>##page_*##</code>', '現在のページのトークンに置き換えます。'],
    ['', '完全なドキュメントはGitHubにあります。<a href="https://github.com/terminal42/contao-inserttags/blob/main/README.md" target="_blank" rel="noreferrer">ドキュメントを読む</a>。'],
];
