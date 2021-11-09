<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProRequestProdTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProRequestProdTable Test Case
 */
class ProRequestProdTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProRequestProdTable
     */
    public $ProRequestProd;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ProRequestProd',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ProRequestProd') ? [] : ['className' => ProRequestProdTable::class];
        $this->ProRequestProd = TableRegistry::getTableLocator()->get('ProRequestProd', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProRequestProd);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
