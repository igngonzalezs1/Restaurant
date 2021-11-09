<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * GroupsFixture
 */
class GroupsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'NAME' => ['type' => 'string', 'length' => '255', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ID'], 'length' => []],
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
                'NAME' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
