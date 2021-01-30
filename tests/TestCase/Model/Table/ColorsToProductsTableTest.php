<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ColorsToProductsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ColorsToProductsTable Test Case
 */
class ColorsToProductsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ColorsToProductsTable
     */
    public $ColorsToProducts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.colors_to_products',
        'app.colors',
        'app.products'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ColorsToProducts') ? [] : ['className' => ColorsToProductsTable::class];
        $this->ColorsToProducts = TableRegistry::getTableLocator()->get('ColorsToProducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ColorsToProducts);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
