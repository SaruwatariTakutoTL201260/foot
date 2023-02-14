<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCountries extends AbstractMigration
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
        $table = $this->table('countries')
            ->addColumn('id', 'biginteger', [
                'autoIncrement' => true,
                'comment' => 'ID',
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('name', 'string', [
                'comment' => '国名',
                'default' => null,
                'limit' => 255,
                'null' => false,
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
