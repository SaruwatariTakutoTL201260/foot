<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddTeams extends AbstractMigration
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
        $table = $this->table('teams')
        ->addColumn('get_team_id', 'integer', [
            'comment' => '取得ID',
            'null' => false,
            'signed' => false,
        ]);

        $table->update();
    }
}
