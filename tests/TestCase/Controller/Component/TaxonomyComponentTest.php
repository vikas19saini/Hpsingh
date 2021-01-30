<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\TaxonomyComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\TaxonomyComponent Test Case
 */
class TaxonomyComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\TaxonomyComponent
     */
    public $Taxonomy;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Taxonomy = new TaxonomyComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Taxonomy);

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
