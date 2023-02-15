<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateTeamResults extends AbstractMigration
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
        $table = $this->table('team_results')
            ->addColumn('id', 'biginteger', [
                'autoIncrement' => true,
                'comment' => 'ID',
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('team_id', 'biginteger', [
                'comment' => 'チームID',
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('match_date', 'datetime', [
                'comment' => '試合日時',
                'default' => null,
                'null' => true,
            ])
            ->addColumn('mache_number', 'biginteger', [
                'comment' => '試合数',
                'null' => false,
                'signed' => false,
                'default' => 0,
            ])
            ->addColumn('rank', 'biginteger', [
                'comment' => '順位',
                'null' => false,
                'signed' => false,
                'default' => 1,
            ])
            ->addColumn('won', 'biginteger', [
                'comment' => '勝ち数',
                'null' => false,
                'signed' => false,
                'default' => 0,
            ])
            ->addColumn('lose', 'biginteger', [
                'comment' => '負け数',
                'null' => false,
                'signed' => false,
                'default' => 0,
            ])
            ->addColumn('tied', 'biginteger', [
                'comment' => '引き分け数',
                'null' => false,
                'signed' => false,
                'default' => 0,
            ])
            ->addColumn('score', 'biginteger', [
                'comment' => '得点',
                'null' => false,
                'signed' => false,
                'default' => 0,
            ])
            ->addColumn('lost_point', 'biginteger', [
                'comment' => '失点',
                'null' => false,
                'signed' => false,
                'default' => 0,
            ])
            ->addColumn('winning_points', 'biginteger', [
                'comment' => '勝ち点',
                'null' => false,
                'signed' => false,
                'default' => 0,
            ])
            ->addColumn('goals_score', 'biginteger', [
                'comment' => '得失点差',
                'null' => false,
                'signed' => false,
                'default' => 0,
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
