<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\PayuComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\PayuComponent Test Case
 */
class PayuComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\PayuComponent
     */
    public $Payu;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Payu = new PayuComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Payu);

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
