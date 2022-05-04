<?php

$GLOBALS['TL_LANG']['XPL']['customInsertTags'] = [
    ['View the full documentation at Github. <a href="https://github.com/terminal42/contao-inserttags/blob/main/README.md" target="_blank" rel="noreferrer">View the documentation</a>.'],
    ['page.*', 'Access the page properties. Example: <code>page.id</code> or <code>page.trail</code>.'],
    ['request.*', 'Access the current request properties. Example: <code>request.query.get(\'foobar\')</code>.'],
    ['tag.*', 'Access the tag chunks. Example: the <code>{{custom::my-tag::foo::bar}}</code> insert tag produces <code>tag.0</code> and <code>tag.1</code> as <code>foo</code> and <code>bar</code> respectively.'],
    ['user.*', 'Access the current user properties. Example: <code>user.id</code> or <code>user.firstname</code> or <code>user.groups</code>.'],
];

