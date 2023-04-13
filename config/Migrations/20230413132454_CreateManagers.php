<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateManagers extends AbstractMigration
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
        $table = $this->table('managers')
            ->addColumn('id', 'biginteger', [
                'autoIncrement' => true,
                'comment' => 'ID',
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('team_id', 'biginteger', [
                'comment' => 'チームID',
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('country_id', 'biginteger', [
                'comment' => '国ID',
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('get_couch_id', 'biginteger', [
                'comment' => '取得監督ID',
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('name', 'string', [
                'comment' => '監督名',
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
