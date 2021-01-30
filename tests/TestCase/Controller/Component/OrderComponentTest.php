<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\OrderComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\OrderComponent Test Case
 */
class OrderComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\OrderComponent
     */
    public $Order;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Order = new OrderComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Order);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
