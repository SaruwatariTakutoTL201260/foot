<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreatePlayers extends AbstractMigration
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
        $table = $this->table('players')
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
            ->addColumn('name', 'string', [
                'comment' => '選手名',
                'default' => 'NoDataPlayer',
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('english_name', 'string', [
                'comment' => '英語表記名',
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('age', 'biginteger', [
                'comment' => '年齢',
                'null' => false,
                'signed' => false,
                'default' => 0,
            ])
            ->addColumn('number', 'biginteger', [
                'comment' => '背番号',
                'null' => true,
                'signed' => false,
                'default' => null,
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
