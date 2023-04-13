<?php
declare(strict_types=1);

use App\Constant\CountryConstant;
use Migrations\AbstractSeed;
use Cake\ORM\TableRegistry;

/**
 * Countries seed.
 */
use App\Constant\LeagueConstant;

class CountriesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
        ];

        // テーブル設定
        $table = $this->table('countries');

        // モデル定義
        $model = TableRegistry::getTableLocator()->get('countries');

        if ($model->find()->count() === 0) {
            // データが0件の場合に処理続行
            $data = [];

            foreach (CountryConstant::COUNTRY_ENGLISH_LIST as $value) {
                $data[] = [
                    'name' => $value,
                    'is_deleted' => 0,
                ];
            }            
        }

        $table->insert($data)->save();
    }
}
