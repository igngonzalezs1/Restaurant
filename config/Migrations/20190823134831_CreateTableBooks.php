<?php
use Migrations\AbstractMigration;

class CreateTableBooks extends AbstractMigration
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
        $table = $this->table('books')
            ->addColumn('name', 'string', ['null' => true, 'default' => null])
            ->addColumn('sypnosis', 'string', ['null' => true, 'default' => null])
            ->addColumn('book_dir', 'string', ['null' => true, 'default' => null])
            ->addColumn('cost', 'integer', ['null' => true, 'default' => null])
            ->addColumn('dcto_percent', 'integer', ['null' => true, 'default' => null])
            ->addColumn('stock', 'integer', ['null' => true, 'default' => null])
        ->create();
    }
}
