<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\ORM\TableRegistry;

/**
 * Leagues seed.
 */
use App\Constant\LeagueConstant;

class LeaguesSeed extends AbstractSeed
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
        $table = $this->table('leagues');

        // モデル定義
        $model = TableRegistry::getTableLocator()->get('leagues');

        if ($model->find()->count() === 0) {
            // データが0件の場合に処理続行
            $data = [];

            foreach (LeagueConstant::LEAGUE_LIST as $key => $value) {
                $country_id = LeagueConstant::COUNTRY_ID_LIST[$key];

                $data[] = [
                    'country_id' => $country_id,
                    'name' => $value,
                    'is_deleted' => 0,
                ];
            }

            $table->insert($data)->save();
        }
    }
}
