<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\PaypalComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\PaypalComponent Test Case
 */
class PaypalComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\PaypalComponent
     */
    public $Paypal;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Paypal = new PaypalComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Paypal);

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
