<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubclubsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubclubsTable Test Case
 */
class SubclubsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SubclubsTable
     */
    protected $Subclubs;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Subclubs',
        'app.Clubs',
        'app.Competitions',
        'app.CompetitionsUsers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Subclubs') ? [] : ['className' => SubclubsTable::class];
        $this->Subclubs = $this->getTableLocator()->get('Subclubs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Subclubs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\SubclubsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\SubclubsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
