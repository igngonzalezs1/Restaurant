<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RecipeProductsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RecipeProductsTable Test Case
 */
class RecipeProductsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RecipeProductsTable
     */
    public $RecipeProducts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.RecipeProducts',
        'app.Products',
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
        $config = TableRegistry::getTableLocator()->exists('RecipeProducts') ? [] : ['className' => RecipeProductsTable::class];
        $this->RecipeProducts = TableRegistry::getTableLocator()->get('RecipeProducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RecipeProducts);

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
