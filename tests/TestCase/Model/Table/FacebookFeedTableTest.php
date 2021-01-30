<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FacebookFeedTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FacebookFeedTable Test Case
 */
class FacebookFeedTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FacebookFeedTable
     */
    public $FacebookFeed;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.facebook_feed'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FacebookFeed') ? [] : ['className' => FacebookFeedTable::class];
        $this->FacebookFeed = TableRegistry::getTableLocator()->get('FacebookFeed', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FacebookFeed);

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
