<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SaleRequestStatusFixture
 */
class SaleRequestStatusFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'sale_request_status';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'CODE' => ['type' => 'string', 'length' => '255', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
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
                'CODE' => 'Lorem ipsum dolor sit amet',
                'NAME' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
