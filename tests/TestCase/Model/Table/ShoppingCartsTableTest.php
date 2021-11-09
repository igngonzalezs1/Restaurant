<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ShoppingCartsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ShoppingCartsTable Test Case
 */
class ShoppingCartsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ShoppingCartsTable
     */
    public $ShoppingCarts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ShoppingCarts',
        'app.Books',
        'app.Bills',
        'app.Users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ShoppingCarts') ? [] : ['className' => ShoppingCartsTable::class];
        $this->ShoppingCarts = TableRegistry::getTableLocator()->get('ShoppingCarts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ShoppingCarts);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
