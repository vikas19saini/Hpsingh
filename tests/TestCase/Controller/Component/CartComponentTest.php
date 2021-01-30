<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\CartComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\CartComponent Test Case
 */
class CartComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\CartComponent
     */
    public $Cart;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Cart = new CartComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cart);

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
