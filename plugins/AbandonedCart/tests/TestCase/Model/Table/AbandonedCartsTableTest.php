<?php
namespace AbandonedCart\Test\TestCase\Model\Table;

use AbandonedCart\Model\Table\AbandonedCartsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AbandonedCart\Model\Table\AbandonedCartsTable Test Case
 */
class AbandonedCartsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \AbandonedCart\Model\Table\AbandonedCartsTable
     */
    public $AbandonedCarts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.abandoned_cart.abandoned_carts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AbandonedCarts') ? [] : ['className' => AbandonedCartsTable::class];
        $this->AbandonedCarts = TableRegistry::getTableLocator()->get('AbandonedCarts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AbandonedCarts);

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
