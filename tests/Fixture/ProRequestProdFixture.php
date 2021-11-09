<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProRequestProdFixture
 */
class ProRequestProdFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'pro_request_prod';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'PROD_ID' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'QUANTITE' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'UNIT_ID' => ['type' => 'integer', 'length' => null, 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'PRO_REQ_ID' => ['type' => 'integer', 'length' => null, 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'STATUS_ID' => ['type' => 'integer', 'length' => null, 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
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
                'PROD_ID' => 1,
                'QUANTITE' => 1,
                'UNIT_ID' => 1,
                'PRO_REQ_ID' => 1,
                'STATUS_ID' => 1,
            ],
        ];
        parent::init();
    }
}
