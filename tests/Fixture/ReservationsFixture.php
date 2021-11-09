<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReservationsFixture
 */
class ReservationsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'CREATED' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null],
        'MODIFICATE' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null],
        'USER_ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'TABLE_ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'STATUS_ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ID'], 'length' => []],
            'SYS_C008527' => ['type' => 'foreign', 'columns' => ['USER_ID'], 'references' => ['ADMIN.USERS', 'ID'], 'update' => 'setNull', 'delete' => 'noAction', 'length' => []],
            'SYS_C008526' => ['type' => 'foreign', 'columns' => ['TABLE_ID'], 'references' => ['ADMIN.TABLES', 'ID'], 'update' => 'setNull', 'delete' => 'noAction', 'length' => []],
            'SYS_C008525' => ['type' => 'foreign', 'columns' => ['STATUS_ID'], 'references' => ['ADMIN.RESERVATION_STATUS', 'ID'], 'update' => 'setNull', 'delete' => 'noAction', 'length' => []],
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
                'CREATED' => '2020-10-23 05:15:18',
                'MODIFICATE' => '2020-10-23 05:15:18',
                'USER_ID' => 1,
                'TABLE_ID' => 1,
                'STATUS_ID' => 1,
            ],
        ];
        parent::init();
    }
}
