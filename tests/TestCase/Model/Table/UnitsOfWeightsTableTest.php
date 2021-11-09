<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UnitsOfWeightsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UnitsOfWeightsTable Test Case
 */
class UnitsOfWeightsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UnitsOfWeightsTable
     */
    public $UnitsOfWeights;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('UnitsOfWeights') ? [] : ['className' => UnitsOfWeightsTable::class];
        $this->UnitsOfWeights = TableRegistry::getTableLocator()->get('UnitsOfWeights', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UnitsOfWeights);

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
