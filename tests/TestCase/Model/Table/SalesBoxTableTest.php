<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SalesBoxTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SalesBoxTable Test Case
 */
class SalesBoxTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SalesBoxTable
     */
    public $SalesBox;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SalesBox',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SalesBox') ? [] : ['className' => SalesBoxTable::class];
        $this->SalesBox = TableRegistry::getTableLocator()->get('SalesBox', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SalesBox);

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
