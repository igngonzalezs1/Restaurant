<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProviderProductsFixture
 */
class ProviderProductsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'QUANTITE' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'ACTIVE' => ['type' => 'string', 'length' => '1', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'PRICE' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'PROVIDER_ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'PRODUCT_ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'UNIT_ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'SYS_C008523' => ['type' => 'foreign', 'columns' => ['UNIT_ID'], 'references' => ['ADMIN.UNITS_OF_WEIGHTS', 'ID'], 'update' => 'setNull', 'delete' => 'noAction', 'length' => []],
            'SYS_C008522' => ['type' => 'foreign', 'columns' => ['PROVIDER_ID'], 'references' => ['ADMIN.PROVIDERS', 'ID'], 'update' => 'setNull', 'delete' => 'noAction', 'length' => []],
            'SYS_C008521' => ['type' => 'foreign', 'columns' => ['PRODUCT_ID'], 'references' => ['ADMIN.PRODUCTS', 'ID'], 'update' => 'setNull', 'delete' => 'noAction', 'length' => []],
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
                'QUANTITE' => 1,
                'ACTIVE' => 'L',
                'PRICE' => 1,
                'PROVIDER_ID' => 1,
                'PRODUCT_ID' => 1,
                'UNIT_ID' => 1,
            ],
        ];
        parent::init();
    }
}
