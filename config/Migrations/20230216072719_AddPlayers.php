<?php
declare(strict_types=1);

use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class AddPlayers extends AbstractMigration
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
        $table = $this->table('players')
        ->addColumn('position_status', 'integer', [
            'comment' => 'ポジションステータス("0:GK/1:DF/2:MF/3:FW")',
            'default' => 0,
            'null' => false,
            'limit' => MysqlAdapter::INT_TINY,
            'signed' => true,
        ]);

        $table->update();
    }
}
