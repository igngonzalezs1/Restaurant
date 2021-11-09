<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SalesBoxFixture
 */
class SalesBoxFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'sales_box';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'TOTAL_PRICE' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'COMMENTARY' => ['type' => 'string', 'length' => '255', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'ENTRY' => ['type' => 'string', 'length' => '1', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'RESERVATION_ID' => ['type' => 'integer', 'length' => null, 'null' => true, 'default' => 'NULL
', 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'CREATED' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => null, 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ID'], 'length' => []],
            'SYS_C008518' => ['type' => 'foreign', 'columns' => ['RESERVATION_ID'], 'references' => ['ADMIN.RESERVATIONS', 'ID'], 'update' => 'setNull', 'delete' => 'noAction', 'length' => []],
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
                'TOTAL_PRICE' => 1,
                'COMMENTARY' => 'Lorem ipsum dolor sit amet',
                'ENTRY' => 'L',
                'RESERVATION_ID' => 1,
                'CREATED' => '2020-11-01 23:57:49',
            ],
        ];
        parent::init();
    }
}
