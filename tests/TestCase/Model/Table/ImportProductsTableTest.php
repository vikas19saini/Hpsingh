<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ImportProductsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ImportProductsTable Test Case
 */
class ImportProductsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ImportProductsTable
     */
    public $ImportProducts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.import_products'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ImportProducts') ? [] : ['className' => ImportProductsTable::class];
        $this->ImportProducts = TableRegistry::getTableLocator()->get('ImportProducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ImportProducts);

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
     * Test afterDelete method
     *
     * @return void
     */
    public function testAfterDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test deleteAllFiles method
     *
     * @return void
     */
    public function testDeleteAllFiles()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
