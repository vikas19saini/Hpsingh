<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TagsToProductsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TagsToProductsTable Test Case
 */
class TagsToProductsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TagsToProductsTable
     */
    public $TagsToProducts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tags_to_products',
        'app.tags',
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
        $config = TableRegistry::getTableLocator()->exists('TagsToProducts') ? [] : ['className' => TagsToProductsTable::class];
        $this->TagsToProducts = TableRegistry::getTableLocator()->get('TagsToProducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TagsToProducts);

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
