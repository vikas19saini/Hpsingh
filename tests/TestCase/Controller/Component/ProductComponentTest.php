<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\ProductComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\ProductComponent Test Case
 */
class ProductComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\ProductComponent
     */
    public $Product;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Product = new ProductComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Product);

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
