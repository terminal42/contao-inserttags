<?php

declare(strict_types=1);

namespace Terminal42\InsertTagsBundle\Tests\Migration;

use Contao\TestCase\ContaoTestCase;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\AbstractSchemaManager;
use PHPUnit\Framework\MockObject\MockObject;
use Terminal42\InsertTagsBundle\Migration\DuplicateRecordsMigration;

class DuplicateRecordsMigrationTest extends ContaoTestCase
{
    public function testShouldRunSuccess(): void
    {
        $schemaManager = $this->createConfiguredMock(AbstractSchemaManager::class, [
            'tablesExist' => true,
        ]);

        $migration = $this->createMigration(
            ['createSchemaManager', 'fetchOne'],
            function ($mock) use ($schemaManager): void {
                $mock
                    ->expects($this->once())
                    ->method('createSchemaManager')
                    ->willReturn($schemaManager)
                ;

                $mock
                    ->expects($this->once())
                    ->method('fetchOne')
                    ->willReturn(1)
                ;
            },
        );

        $this->assertTrue($migration->shouldRun());
    }

    public function testShouldRunNoTables(): void
    {
        $schemaManager = $this->createConfiguredMock(AbstractSchemaManager::class, [
            'tablesExist' => false,
        ]);

        $migration = $this->createMigration(
            ['createSchemaManager'],
            function (MockObject $mock) use ($schemaManager): void {
                $mock
                    ->expects($this->once())
                    ->method('createSchemaManager')
                    ->willReturn($schemaManager)
                ;
            },
        );

        $this->assertFalse($migration->shouldRun());
    }

    public function testShouldRunNoRecords(): void
    {
        $schemaManager = $this->createConfiguredMock(AbstractSchemaManager::class, [
            'tablesExist' => true,
        ]);

        $migration = $this->createMigration(
            ['createSchemaManager', 'fetchOne'],
            function (MockObject $mock) use ($schemaManager): void {
                $mock
                    ->expects($this->once())
                    ->method('createSchemaManager')
                    ->willReturn($schemaManager)
                ;

                $mock
                    ->expects($this->once())
                    ->method('fetchOne')
                    ->willReturn(0)
                ;
            },
        );

        $this->assertFalse($migration->shouldRun());
    }

    /**
     * @dataProvider provider
     */
    public function testRun(string $tag, array $tagRecords, array $externalRecords, string $replacement): void
    {
        $migration = $this->createMigration(
            ['fetchFirstColumn', 'fetchAllAssociative', 'fetchOne', 'delete', 'insert'],
            function (MockObject $mock) use ($tag, $tagRecords, $externalRecords, $replacement): void {
                $mock
                    ->expects($this->once())
                    ->method('fetchFirstColumn')
                    ->willReturn([$tag])
                ;

                $mock
                    ->expects($this->once())
                    ->method('fetchAllAssociative')
                    ->willReturn($tagRecords)
                ;

                $mock
                    ->expects($this->exactly(\count($externalRecords)))
                    ->method('fetchOne')
                    ->willReturnOnConsecutiveCalls(...array_values($externalRecords))
                ;

                $mock
                    ->expects($this->once())
                    ->method('delete')
                    ->with('tl_inserttags', ['tag' => $tag])
                ;

                $mock
                    ->expects($this->once())
                    ->method('insert')
                    ->with('tl_inserttags', [
                        'tstamp' => time(),
                        'tag' => $tag,
                        'replacement' => $replacement,
                        'disableRTE' => true,
                    ])
                ;
            },
        );

        $this->assertTrue($migration->run()->isSuccessful());
    }

    public static function provider(): iterable
    {
        return [
            'Page limits' => [
                'foobar',
                [
                    [
                        'replacement' => 'Replacement 1x',
                        'limitpages' => '1',
                        'pages' => [10, 11],
                        'includesubpages' => '1',
                        'protected' => '',
                        'groups' => [],
                    ],
                    [
                        'replacement' => 'Replacement 2x',
                        'limitpages' => '1',
                        'pages' => [20, 21],
                        'includesubpages' => '',
                        'protected' => '',
                        'groups' => [],
                    ],
                ],
                [
                    'Page 10', 'Page 11',
                    'Page 20', 'Page 21',
                ],
                '# Page ID 10 is Page 10
# Page ID 11 is Page 11
{if 10 in page.trail or 11 in page.trail}
Replacement 1x
{endif}

# Page ID 20 is Page 20
# Page ID 21 is Page 21
{if page.id == 20 or page.id == 21}
Replacement 2x
{endif}',
            ],

            'Member groups limits' => [
                'foobar',
                [
                    [
                        'replacement' => 'Replacement 1x',
                        'limitpages' => '',
                        'pages' => [],
                        'includesubpages' => '',
                        'protected' => '1',
                        'groups' => [10, 11],
                    ],
                    [
                        'replacement' => 'Replacement 2x',
                        'limitpages' => '',
                        'pages' => [],
                        'includesubpages' => '',
                        'protected' => '2',
                        'groups' => [20, 21],
                    ],
                ],
                [
                    'Group 10', 'Group 11',
                    'Group 20', 'Group 21',
                ],
                '# Member group ID 10 is Group 10
# Member group ID 11 is Group 11
{if member and (10 in member.groups or 11 in member.groups)}
Replacement 1x
{endif}

# Member group ID 20 is Group 20
# Member group ID 21 is Group 21
{if member and (20 in member.groups or 21 in member.groups)}
Replacement 2x
{endif}',
            ],

            'Pages and member groups limits' => [
                'foobar',
                [
                    [
                        'replacement' => 'Replacement 1x',
                        'limitpages' => '1',
                        'pages' => [10, 11],
                        'includesubpages' => '1',
                        'protected' => '1',
                        'groups' => [10, 11],
                    ],
                    [
                        'replacement' => 'Replacement 2x',
                        'limitpages' => '1',
                        'pages' => [20, 21],
                        'includesubpages' => '',
                        'protected' => '2',
                        'groups' => [20, 21],
                    ],
                ],
                [
                    'Page 10', 'Page 11', 'Group 10', 'Group 11',
                    'Page 20', 'Page 21', 'Group 20', 'Group 21',
                ],
                '# Page ID 10 is Page 10
# Page ID 11 is Page 11
# Member group ID 10 is Group 10
# Member group ID 11 is Group 11
{if member and (10 in member.groups or 11 in member.groups) and (10 in page.trail or 11 in page.trail)}
Replacement 1x
{endif}

# Page ID 20 is Page 20
# Page ID 21 is Page 21
# Member group ID 20 is Group 20
# Member group ID 21 is Group 21
{if member and (20 in member.groups or 21 in member.groups) and (page.id == 20 or page.id == 21)}
Replacement 2x
{endif}',
            ],
        ];
    }

    private function createMigration(array $connectionMethods, callable $connectionCallback): DuplicateRecordsMigration
    {
        $connectionMock = $this->createPartialMock(Connection::class, $connectionMethods);
        $connectionCallback($connectionMock);

        return new DuplicateRecordsMigration($connectionMock, $this->mockContaoFramework());
    }
}
