<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProviderRequestTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProviderRequestTable Test Case
 */
class ProviderRequestTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProviderRequestTable
     */
    public $ProviderRequest;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ProviderRequest',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ProviderRequest') ? [] : ['className' => ProviderRequestTable::class];
        $this->ProviderRequest = TableRegistry::getTableLocator()->get('ProviderRequest', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProviderRequest);

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
