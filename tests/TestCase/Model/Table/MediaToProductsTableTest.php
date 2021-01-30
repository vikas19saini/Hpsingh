<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MediaToProductsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MediaToProductsTable Test Case
 */
class MediaToProductsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MediaToProductsTable
     */
    public $MediaToProducts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.media_to_products',
        'app.media',
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
        $config = TableRegistry::getTableLocator()->exists('MediaToProducts') ? [] : ['className' => MediaToProductsTable::class];
        $this->MediaToProducts = TableRegistry::getTableLocator()->get('MediaToProducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MediaToProducts);

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
