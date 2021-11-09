<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReservationStatusTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReservationStatusTable Test Case
 */
class ReservationStatusTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReservationStatusTable
     */
    public $ReservationStatus;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ReservationStatus',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ReservationStatus') ? [] : ['className' => ReservationStatusTable::class];
        $this->ReservationStatus = TableRegistry::getTableLocator()->get('ReservationStatus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReservationStatus);

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
