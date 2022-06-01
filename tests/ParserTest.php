<?php

namespace Terminal42\InsertTagsBundle\Tests;

use Contao\CoreBundle\InsertTag\InsertTagParser;
use Contao\CoreBundle\String\SimpleTokenParser;
use Terminal42\InsertTagsBundle\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testParse(string $replacement, string $expected)
    {
        $insertTagParser = $this->createPartialMock(InsertTagParser::class, ['replaceInline']);
        $insertTagParser->expects($this->once())->method('replaceInline')->willReturnCallback(static fn ($v) => $v);

        $simpleTokenParser = $this->createPartialMock(SimpleTokenParser::class, ['parse']);
        $simpleTokenParser->expects($this->once())->method('parse')->willReturnCallback(static fn ($v) => $v);

        $parser = new Parser($insertTagParser, $simpleTokenParser);

        $this->assertEquals($expected, $parser->parse($replacement, []));
    }

    public function provider(): array
    {
        return [
            'Comments stripping' => [
                '# Page ID 123 is Foobar
{if 123 in page.trail}
Foobar content
{endif}

\# This should not be stripped!
# Page ID 456 is Foobaz
{if 456 in page.trail}
Foobaz # This is not a comment
{endif}',
                '{if 123 in page.trail}
Foobar content
{endif}

# This should not be stripped!
{if 456 in page.trail}
Foobaz # This is not a comment
{endif}',
            ],
        ];
    }
}
