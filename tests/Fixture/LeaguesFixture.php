<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LeaguesFixture
 */
class LeaguesFixture extends TestFixture
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
                'country_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'modified' => '2023-02-13 14:42:49',
                'is_deleted' => 0,
            ],
            [
                'id' => 2,
                'country_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'modified' => '2023-02-13 14:42:49',
                'is_deleted' => 0,
            ],
            [
                'id' => 3,
                'country_id' => 2,
                'name' => 'testName',
                'modified' => '2023-02-13 14:42:49',
                'is_deleted' => 0,
            ],
        ];
        parent::init();
    }
}
