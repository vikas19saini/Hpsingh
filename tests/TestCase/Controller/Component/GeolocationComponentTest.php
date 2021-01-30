<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\GeolocationComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\GeolocationComponent Test Case
 */
class GeolocationComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\GeolocationComponent
     */
    public $Geolocation;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Geolocation = new GeolocationComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Geolocation);

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
