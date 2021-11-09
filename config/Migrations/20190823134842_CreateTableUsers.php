<?php
use Migrations\AbstractMigration;

class CreateTableUsers extends AbstractMigration
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
        $table = $this->table('users')
            ->addColumn('name', 'string', ['null' => true, 'default' => null])
            ->addColumn('password', 'string', ['null' => true, 'default' => null])
            ->addColumn('email', 'string', ['null' => true, 'default' => null])
        ->create();
    }
}
