<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'USERNAME' => ['type' => 'string', 'length' => '255', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'PASSWORD' => ['type' => 'string', 'length' => '255', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'NAME' => ['type' => 'string', 'length' => '255', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'RUT' => ['type' => 'string', 'length' => '255', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'EMAIL' => ['type' => 'string', 'length' => '255', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'GROUP_ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ID'], 'length' => []],
            'USERS_IBFK_1' => ['type' => 'foreign', 'columns' => ['GROUP_ID'], 'references' => ['ADMIN.GROUPS', 'ID'], 'update' => 'setNull', 'delete' => 'noAction', 'length' => []],
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
                'USERNAME' => 'Lorem ipsum dolor sit amet',
                'PASSWORD' => 'Lorem ipsum dolor sit amet',
                'NAME' => 'Lorem ipsum dolor sit amet',
                'RUT' => 'Lorem ipsum dolor sit amet',
                'EMAIL' => 'Lorem ipsum dolor sit amet',
                'GROUP_ID' => 1,
            ],
        ];
        parent::init();
    }
}
