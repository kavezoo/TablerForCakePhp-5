<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Clubpresident;

use App\Controller\Clubpresident\CompetitionsUsersController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Clubpresident\CompetitionsUsersController Test Case
 *
 * @link \App\Controller\Clubpresident\CompetitionsUsersController
 */
class CompetitionsUsersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.CompetitionsUsers',
        'app.Users',
        'app.Competitions',
        'app.Subclubs',
    ];

    /**
     * Test index method
     *
     * @return void
     * @link \App\Controller\Clubpresident\CompetitionsUsersController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @link \App\Controller\Clubpresident\CompetitionsUsersController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @link \App\Controller\Clubpresident\CompetitionsUsersController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @link \App\Controller\Clubpresident\CompetitionsUsersController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @link \App\Controller\Clubpresident\CompetitionsUsersController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
