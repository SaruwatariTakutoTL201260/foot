<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CountriesFixture
 */
class CountriesFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'modified' => '2023-02-07 16:28:07',
                'is_deleted' => 0,
            ],
            [
                'id' => 2,
                'name' => 'testName',
                'modified' => '2023-02-07 16:28:07',
                'is_deleted' => 0,
            ],
        ];
        parent::init();
    }
}
