<?php
declare(strict_types=1);

use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateMatchShedules extends AbstractMigration
{
    public $autoId = false;

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('match_shedules')
            ->addColumn('id', 'biginteger', [
                'autoIncrement' => true,
                'comment' => 'ID',
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('league_id', 'biginteger', [
                'comment' => 'リーグID',
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('home_team_id', 'biginteger', [
                'comment' => 'ホームチームID',
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('away_team_id', 'biginteger', [
                'comment' => 'アウェイチームID',
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('match_date', 'datetime', [
                'comment' => '試合日時',
                'null' => true,
            ])
            ->addColumn('home_score', 'integer', [
                'comment' => 'ホーム得点',
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('away_score', 'integer', [
                'comment' => 'アウェイ得点',
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('match_status', 'integer', [
                'comment' => '試合状況ステータス("0:試合開始前/1:試合中/2:試合終了/3:試合延期/4:試合中断")',
                'default' => 0,
                'null' => false,
                'limit' => MysqlAdapter::INT_TINY,
                'signed' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ更新日(Y-m-d H:i:s形式)',
                'default' => null,
                'null' => true,
            ])
            ->addColumn('is_deleted', 'boolean', [
                'comment' => '削除フラグ(0：有効データ / 1：削除済)',
                'default' => true,
                'null' => false,
            ]);

        $table->create();
    }
}
