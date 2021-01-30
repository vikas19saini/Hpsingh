<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RedirectionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RedirectionTable Test Case
 */
class RedirectionTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RedirectionTable
     */
    public $Redirection;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.redirection'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Redirection') ? [] : ['className' => RedirectionTable::class];
        $this->Redirection = TableRegistry::getTableLocator()->get('Redirection', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Redirection);

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
}
