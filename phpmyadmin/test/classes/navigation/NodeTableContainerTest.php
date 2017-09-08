<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Tests for PhpMyAdmin\Navigation\Nodes\NodeTableContainer class
 *
 * @package PhpMyAdmin-test
 */

use PhpMyAdmin\Navigation\NodeFactory;
use PhpMyAdmin\Theme;

require_once 'test/PMATestCase.php';

/**
 * Tests for PhpMyAdmin\Navigation\Nodes\NodeTableContainer class
 *
 * @package PhpMyAdmin-test
 */
class NodeTableContainerTest extends PMATestCase
{
    /**
     * SetUp for test cases
     *
     * @return void
     */
    public function setup()
    {
        $GLOBALS['server'] = 0;
        $GLOBALS['cfg']['NavigationTreeEnableGrouping'] = true;
        $GLOBALS['cfg']['NavigationTreeDbSeparator'] = '_';
        $GLOBALS['cfg']['NavigationTreeTableSeparator'] = '__';
        $GLOBALS['cfg']['NavigationTreeTableLevel'] = 1;
    }


    /**
     * Test for __construct
     *
     * @return void
     */
    public function testConstructor()
    {
        $parent = NodeFactory::getInstance('NodeTableContainer');
        $this->assertArrayHasKey(
            'text',
            $parent->links
        );
        $this->assertContains(
            'db_structure.php',
            $parent->links['text']
        );
        $this->assertEquals('tables', $parent->real_name);
        $this->assertContains('tableContainer', $parent->classes);
    }
}
