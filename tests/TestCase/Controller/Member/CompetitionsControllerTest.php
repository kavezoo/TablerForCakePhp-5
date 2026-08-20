<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Member;

use App\Controller\Member\CompetitionsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Member\CompetitionsController Test Case
 *
 * @link \App\Controller\Member\CompetitionsController
 */
class CompetitionsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Competitions',
        'app.Cities',
        'app.Staffs',
        'app.Subclubs',
        'app.Users',
        'app.CompetitionsUsers',
    ];

    /**
     * Test index method
     *
     * @return void
     * @link \App\Controller\Member\CompetitionsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @link \App\Controller\Member\CompetitionsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @link \App\Controller\Member\CompetitionsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @link \App\Controller\Member\CompetitionsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @link \App\Controller\Member\CompetitionsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
