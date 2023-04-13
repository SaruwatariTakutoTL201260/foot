<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ManagersFixture
 */
class ManagersFixture extends TestFixture
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
                'team_id' => 1,
                'country_id' => 1,
                'get_couch_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'english_name' => 'Lorem ipsum dolor sit amet',
                'age' => 1,
                'modified' => '2023-04-13 22:37:44',
                'is_deleted' => 0,
            ],
        ];
        parent::init();
    }
}
