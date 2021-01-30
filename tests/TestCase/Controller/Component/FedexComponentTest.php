<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\FedexComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\FedexComponent Test Case
 */
class FedexComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\FedexComponent
     */
    public $Fedex;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Fedex = new FedexComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Fedex);

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
