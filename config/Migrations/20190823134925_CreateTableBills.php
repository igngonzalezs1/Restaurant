<?php
use Migrations\AbstractMigration;

class CreateTableBills extends AbstractMigration
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
        $table = $this->table('bills')
            ->addColumn('name', 'string', ['null' => true, 'default' => null])
            ->addColumn('password', 'string', ['null' => true, 'default' => null])
            ->addColumn('email', 'string', ['null' => true, 'default' => null])
            ->addColumn('user_id', 'integer', ['null' => true, 'default' => null])
            ->addColumn('bill_state_id', 'integer', ['null' => true, 'default' => null])

            ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
            ->addForeignKey('bill_state_id', 'bill_states', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])

        ->create();
    }
}
