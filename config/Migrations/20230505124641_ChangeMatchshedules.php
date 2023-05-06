<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class ChangeMatchshedules extends AbstractMigration
{
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
            ->changeColumn('is_deleted', 'boolean', [
                'default' => false,
            ])
            ->addColumn('get_id', 'biginteger', [
                'comment' => '取得id',
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('referee_id', 'biginteger', [
                'comment' => '審判id',
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('studium_id', 'biginteger', [
                'comment' => 'スタジアムid',
                'null' => true,
                'signed' => false,
            ]);

        $table->update();
    }
}
