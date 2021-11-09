<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProviderProductsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProviderProductsTable Test Case
 */
class ProviderProductsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProviderProductsTable
     */
    public $ProviderProducts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ProviderProducts',
        'app.Products',
        'app.Providers',
        'app.UnitsOfWeights',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ProviderProducts') ? [] : ['className' => ProviderProductsTable::class];
        $this->ProviderProducts = TableRegistry::getTableLocator()->get('ProviderProducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProviderProducts);

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
     * Test beforeSave method
     *
     * @return void
     */
    public function testBeforeSave()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
