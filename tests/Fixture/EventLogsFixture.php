<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EventLogsFixture
 */
class EventLogsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'user_id' => 'b4a2296e-67de-4184-962e-e8d2b4e6dc72',
                'entity_id' => 'Lorem ipsum dolor sit amet',
                'actor_role' => 'Lorem ipsum dolor sit amet',
                'module' => 'Lorem ipsum dolor sit amet',
                'action' => 'Lorem ipsum dolor sit amet',
                'entity' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'url' => 'Lorem ipsum dolor sit amet',
                'http_method' => 'Lorem ip',
                'ip' => 'Lorem ipsum dolor sit amet',
                'user_agent' => 'Lorem ipsum dolor sit amet',
                'request_data' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created' => '2026-08-19 12:51:34',
            ],
        ];
        parent::init();
    }
}
