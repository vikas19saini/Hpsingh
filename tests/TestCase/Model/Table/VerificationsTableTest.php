<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VerificationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VerificationsTable Test Case
 */
class VerificationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VerificationsTable
     */
    public $Verifications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.verifications'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Verifications') ? [] : ['className' => VerificationsTable::class];
        $this->Verifications = TableRegistry::getTableLocator()->get('Verifications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Verifications);

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
