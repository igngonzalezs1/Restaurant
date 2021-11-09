<?php
use Migrations\AbstractMigration;

class CreateTableBillStates extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('bill_states')
            ->addColumn('name', 'string', ['null' => true, 'default' => null])
        ->create();
    }
}
