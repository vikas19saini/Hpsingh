<?php
namespace AbandonedCart\Test\TestCase\View\Helper;

use AbandonedCart\View\Helper\CartHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * AbandonedCart\View\Helper\CartHelper Test Case
 */
class CartHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \AbandonedCart\View\Helper\CartHelper
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
        $view = new View();
        $this->Cart = new CartHelper($view);
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
