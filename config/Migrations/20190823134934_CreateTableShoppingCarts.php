<?php
use Migrations\AbstractMigration;

class CreateTableShoppingCarts extends AbstractMigration
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
        $table = $this->table('shopping_carts')
            ->addColumn('cost', 'string', ['null' => true, 'default' => null])
            
            ->addColumn('book_id', 'integer', ['null' => true, 'default' => null])
            ->addColumn('bill_id', 'integer', ['null' => true, 'default' => null])
            ->addColumn('user_id', 'integer', ['null' => true, 'default' => null])

            ->addForeignKey('book_id', 'books', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
            ->addForeignKey('bill_id', 'bills', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
            ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])

        ->create();
    }
}
