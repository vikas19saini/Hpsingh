<?php
namespace AbandonedCart\Test\TestCase\Model\Table;

use AbandonedCart\Model\Table\SessionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AbandonedCart\Model\Table\SessionsTable Test Case
 */
class SessionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \AbandonedCart\Model\Table\SessionsTable
     */
    public $Sessions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.abandoned_cart.sessions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Sessions') ? [] : ['className' => SessionsTable::class];
        $this->Sessions = TableRegistry::getTableLocator()->get('Sessions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Sessions);

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
