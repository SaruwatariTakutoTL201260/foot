<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreatePlayerRecords extends AbstractMigration
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
        $table = $this->table('player_records')
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
            ->addColumn('team_id', 'biginteger', [
                'comment' => 'チームID',
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('player_id', 'biginteger', [
                'comment' => '選手登録ID',
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('goal', 'integer', [
                'comment' => 'ゴール数',
                'default' => 0,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('assist', 'integer', [
                'comment' => 'アシスト数',
                'default' => 0,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('match_date', 'datetime', [
                'comment' => '試合開始日時',
                'default' => null,
                'null' => true,
            ])
            ->addColumn('yellow_card', 'integer', [
                'comment' => 'イエローカード枚数',
                'default' => 0,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('red_card', 'integer', [
                'comment' => 'レッドカード枚数',
                'default' => 0,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('is_injured', 'boolean', [
                'comment' => '怪我フラグ(0：怪我なし / 1：負傷中)',
                'default' => true,
                'null' => false,
            ])
            ->addColumn('is_suspension', 'boolean', [
                'comment' => '出場停止フラグ(0：出場可能 / 1：出場停止)',
                'default' => true,
                'null' => false,
            ])
            ->addColumn('remark', 'text', [
                'comment' => '説明',
                'default' => null,
                'null' => true,
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
