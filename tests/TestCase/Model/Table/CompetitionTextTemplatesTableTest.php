<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CompetitionTextTemplatesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CompetitionTextTemplatesTable Test Case
 */
class CompetitionTextTemplatesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CompetitionTextTemplatesTable
     */
    protected $CompetitionTextTemplates;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.CompetitionTextTemplates',
        'app.Countries',
        'app.Competitions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CompetitionTextTemplates') ? [] : ['className' => CompetitionTextTemplatesTable::class];
        $this->CompetitionTextTemplates = $this->getTableLocator()->get('CompetitionTextTemplates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CompetitionTextTemplates);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\CompetitionTextTemplatesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\CompetitionTextTemplatesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
