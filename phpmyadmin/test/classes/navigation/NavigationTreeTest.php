<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Test for PhpMyAdmin\Navigation\NavigationTree class
 *
 * @package PhpMyAdmin-test
 */

/*
 * we must set $GLOBALS['server'] here
 * since 'check_user_privileges.lib.php' will use it globally
 */
use PhpMyAdmin\Navigation\NavigationTree;
use PhpMyAdmin\Theme;

$GLOBALS['server'] = 0;
$GLOBALS['cfg']['Server']['DisableIS'] = false;

require_once 'libraries/check_user_privileges.lib.php';
require_once 'test/PMATestCase.php';

/**
 * Tests for PhpMyAdmin\Navigation\NavigationTree class
 *
 * @package PhpMyAdmin-test
 */
class NavigationTreeTest extends PMATestCase
{
    /**
     * @var NavigationTree
     */
    protected $object;

    /**
     * Sets up the fixture.
     *
     * @access protected
     * @return void
     */
    protected function setUp()
    {
        $GLOBALS['server'] = 1;
        $GLOBALS['PMA_Config'] = new PhpMyAdmin\Config();
        $GLOBALS['PMA_Config']->enableBc();
        $GLOBALS['cfg']['Server']['host'] = 'localhost';
        $GLOBALS['cfg']['Server']['user'] = 'root';
        $GLOBALS['cfg']['Server']['pmadb'] = '';
        $GLOBALS['cfg']['Server']['DisableIS'] = false;
        $GLOBALS['cfg']['NavigationTreeEnableGrouping'] = true;
        $GLOBALS['cfg']['ShowDatabasesNavigationAsTree']  = true;

        $GLOBALS['pmaThemeImage'] = 'image';
        $GLOBALS['db'] = 'db';

        $this->object = new PhpMyAdmin\Navigation\NavigationTree();
    }

    /**
     * Tears down the fixture.
     *
     * @access protected
     * @return void
     */
    protected function tearDown()
    {
        unset($this->object);
    }

    /**
     * Very basic rendering test.
     *
     * @return void
     */
    public function testRenderState()
    {
        $result = $this->object->renderState();
        $this->assertContains('pma_quick_warp', $result);
    }

    /**
     * Very basic path rendering test.
     *
     * @return void
     */
    public function testRenderPath()
    {
        $result = $this->object->renderPath();
        $this->assertContains('list_container', $result);
    }

    /**
     * Very basic select rendering test.
     *
     * @return void
     */
    public function testRenderDbSelect()
    {
        $result = $this->object->renderDbSelect();
        $this->assertContains('pma_navigation_select_database', $result);
    }
}
