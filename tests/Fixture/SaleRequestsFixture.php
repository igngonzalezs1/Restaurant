<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SaleRequestsFixture
 */
class SaleRequestsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'PRICE_TOTAL' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'OBSERVATIONS' => ['type' => 'string', 'length' => '255', 'null' => true, 'default' => 'NULL', 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'CANCELATIONS' => ['type' => 'string', 'length' => '255', 'null' => true, 'default' => 'NULL', 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'CREATED' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null],
        'MODIFICATE' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null],
        'RESER_ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'RECIPE_ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'STATUS_ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'QUANTITY' => ['type' => 'integer', 'length' => '30', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ID'], 'length' => []],
            'SYS_C008530' => ['type' => 'foreign', 'columns' => ['STATUS_ID'], 'references' => ['ADMIN.SALE_REQUEST_STATUS', 'ID'], 'update' => 'setNull', 'delete' => 'noAction', 'length' => []],
            'SYS_C008529' => ['type' => 'foreign', 'columns' => ['RESER_ID'], 'references' => ['ADMIN.RESERVATIONS', 'ID'], 'update' => 'setNull', 'delete' => 'noAction', 'length' => []],
            'SYS_C008528' => ['type' => 'foreign', 'columns' => ['RECIPE_ID'], 'references' => ['ADMIN.RECIPES', 'ID'], 'update' => 'setNull', 'delete' => 'noAction', 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'ID' => 1,
                'PRICE_TOTAL' => 1,
                'OBSERVATIONS' => 'Lorem ipsum dolor sit amet',
                'CANCELATIONS' => 'Lorem ipsum dolor sit amet',
                'CREATED' => '2020-10-25 05:41:17',
                'MODIFICATE' => '2020-10-25 05:41:17',
                'RESER_ID' => 1,
                'RECIPE_ID' => 1,
                'STATUS_ID' => 1,
                'QUANTITY' => 1,
            ],
        ];
        parent::init();
    }
}
