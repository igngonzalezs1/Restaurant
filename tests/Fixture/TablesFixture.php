<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TablesFixture
 */
class TablesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'PERSON_QUANTITY' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'NAME' => ['type' => 'string', 'length' => '255', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'DESCRIPTION' => ['type' => 'string', 'length' => '255', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TABLE_STATUS_ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ID'], 'length' => []],
            'SYS_C008519' => ['type' => 'foreign', 'columns' => ['TABLE_STATUS_ID'], 'references' => ['ADMIN.TABLE_STATUS', 'ID'], 'update' => 'setNull', 'delete' => 'noAction', 'length' => []],
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
                'PERSON_QUANTITY' => 1,
                'NAME' => 'Lorem ipsum dolor sit amet',
                'DESCRIPTION' => 'Lorem ipsum dolor sit amet',
                'TABLE_STATUS_ID' => 1,
            ],
        ];
        parent::init();
    }
}
