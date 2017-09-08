<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * tests for PhpMyAdmin\Relation
 *
 * @package PhpMyAdmin-test
 */
namespace PhpMyAdmin\Tests;

use PhpMyAdmin\Relation;
use PhpMyAdmin\Theme;


/**
 * Tests for PhpMyAdmin\Relation
 *
 * @package PhpMyAdmin-test
 * @group medium
 */
class RelationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @access protected
     * @return void
     */
    public function setUp()
    {
        $GLOBALS['server'] = 1;
        $GLOBALS['db'] = 'db';
        $GLOBALS['cfg']['Server']['user'] = 'root';
        $GLOBALS['cfg']['Server']['pmadb'] = 'phpmyadmin';
        $GLOBALS['cfg']['Server']['DisableIS'] = false;
        $GLOBALS['cfg']['ZeroConf'] = true;
        $_SESSION['relation'][$GLOBALS['server']] = "PMA_relation";
        $_SESSION['relation'] = array();

        $GLOBALS['pmaThemePath'] = $GLOBALS['PMA_Theme']->getPath();
        $GLOBALS['cfg']['ServerDefault'] = 0;
    }

    /**
     * Test for Relation::queryAsControlUser
     *
     * @return void
     */
    public function testPMAQueryAsControlUser()
    {
        $dbi = $this->getMockBuilder('PhpMyAdmin\DatabaseInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $dbi->expects($this->once())
            ->method('query')
            ->will($this->returnValue('executeResult1'));

        $dbi->expects($this->once())
            ->method('tryQuery')
            ->will($this->returnValue('executeResult2'));

        $GLOBALS['dbi'] = $dbi;

        $sql = "insert into PMA_bookmark A,B values(1, 2)";
        $this->assertEquals(
            'executeResult1',
            Relation::queryAsControlUser($sql)
        );
        $this->assertEquals(
            'executeResult2',
            Relation::queryAsControlUser($sql, false)
        );
    }

    /**
     * Test for Relation::getRelationsParam & Relation::getRelationsParamDiagnostic
     *
     * @return void
     */
    public function testPMAGetRelationsParam()
    {
        $relationsPara = Relation::getRelationsParam();
        $this->assertEquals(
            false,
            $relationsPara['relwork']
        );
        $this->assertEquals(
            false,
            $relationsPara['bookmarkwork']
        );
        $this->assertEquals(
            'root',
            $relationsPara['user']
        );
        $this->assertEquals(
            'phpmyadmin',
            $relationsPara['db']
        );

        $retval = Relation::getRelationsParamDiagnostic($relationsPara);
        //check $cfg['Servers'][$i]['pmadb']
        $this->assertContains(
            "\$cfg['Servers'][\$i]['pmadb']",
            $retval
        );
        $this->assertContains(
            '<strong>OK</strong>',
            $retval
        );

        //$cfg['Servers'][$i]['relation']
        $result = "\$cfg['Servers'][\$i]['pmadb']  ... </th><td class=\"right\">"
            . "<span style=\"color:green\"><strong>OK</strong></span>";
        $this->assertContains(
            $result,
            $retval
        );
        // $cfg['Servers'][$i]['relation']
        $result = "\$cfg['Servers'][\$i]['relation']  ... </th><td class=\"right\">"
            . "<span style=\"color:red\"><strong>not OK</strong></span>";
        $this->assertContains(
            $result,
            $retval
        );
        // General relation features
        $result = 'General relation features: <span style="color:red">Disabled</span>';
        $this->assertContains(
            $result,
            $retval
        );
        // $cfg['Servers'][$i]['table_info']
        $result = "\$cfg['Servers'][\$i]['table_info']  ... </th>"
            . "<td class=\"right\">"
            . "<span style=\"color:red\"><strong>not OK</strong></span>";
        $this->assertContains(
            $result,
            $retval
        );
        // Display Features:
        $result = 'Display Features: <span style="color:red">Disabled</span>';
        $this->assertContains(
            $result,
            $retval
        );

        $relationsPara['db'] = false;
        $retval = Relation::getRelationsParamDiagnostic($relationsPara);

        $result = __('General relation features');
        $this->assertContains(
            $result,
            $retval
        );
        $result = 'Configuration of pmadb… ';
        $this->assertContains(
            $result,
            $retval
        );
        $result = "<strong>not OK</strong>";
        $this->assertContains(
            $result,
            $retval
        );
    }

    /**
     * Test for Relation::getDisplayField
     *
     * @return void
     */
    public function testPMAGetDisplayField()
    {
        $db = 'information_schema';
        $table = 'CHARACTER_SETS';
        $this->assertEquals(
            'DESCRIPTION',
            Relation::getDisplayField($db, $table)
        );

        $db = 'information_schema';
        $table = 'TABLES';
        $this->assertEquals(
            'TABLE_COMMENT',
            Relation::getDisplayField($db, $table)
        );

        $db = 'information_schema';
        $table = 'PMA';
        $this->assertEquals(
            false,
            Relation::getDisplayField($db, $table)
        );

    }

    /**
     * Test for Relation::getComments
     *
     * @return void
     */
    public function testPMAGetComments()
    {
        $GLOBALS['cfg']['ServerDefault'] = 0;
        $_SESSION['relation'] = array();

        $dbi = $this->getMockBuilder('PhpMyAdmin\DatabaseInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $getColumnsResult = array(
                array(
                        'Field' => 'field1',
                        'Type' => 'int(11)',
                        'Comment' => 'Comment1'
                ),
                array(
                        'Field' => 'field2',
                        'Type' => 'text',
                        'Comment' => 'Comment1'
                )
        );
        $dbi->expects($this->any())->method('getColumns')
            ->will($this->returnValue($getColumnsResult));

        $GLOBALS['dbi'] = $dbi;

        $db = 'information_schema';
        $this->assertEquals(
            array(''),
            Relation::getComments($db)
        );

        $db = 'information_schema';
        $table = 'TABLES';
        $this->assertEquals(
            array(
                'field1' => 'Comment1',
                'field2' => 'Comment1'
            ),
            Relation::getComments($db, $table)
        );
    }

    /**
     * Test for Relation::tryUpgradeTransformations
     *
     * @return void
     */
    public function testPMATryUpgradeTransformations()
    {
        $dbi = $this->getMockBuilder('PhpMyAdmin\DatabaseInterface')
            ->disableOriginalConstructor()
            ->getMock();
        $dbi->expects($this->any())
            ->method('tryQuery')
            ->will($this->returnValue(true));
        $dbi->expects($this->any())
            ->method('numRows')
            ->will($this->returnValue(0));
        $dbi->expects($this->any())
            ->method('getError')
            ->will($this->onConsecutiveCalls(true, false));
        $GLOBALS['dbi'] = $dbi;

        $GLOBALS['cfg']['Server']['pmadb'] = 'pmadb';
        $GLOBALS['cfg']['Server']['column_info'] = 'column_info';

        // Case 1
        $actual = Relation::tryUpgradeTransformations();
        $this->assertEquals(
            false,
            $actual
        );

        // Case 2
        $actual = Relation::tryUpgradeTransformations();
        $this->assertEquals(
            true,
            $actual
        );
    }

    /**
     * Test for Relation::searchColumnInForeigners
     *
     * @return void
     */
    public function testPMASearchColumnInForeigners()
    {
        $foreigners = array(
            'value' => array(
                  'master_field' => 'value',
                  'foreign_db' => 'GSoC14',
                  'foreign_table' => 'test',
                  'foreign_field' => 'value'
            ),
            'foreign_keys_data' => array(
                0 => array(
                    'constraint' => 'ad',
                    'index_list' => array('id', 'value'),
                    'ref_db_name' => 'GSoC14',
                    'ref_table_name' => 'table_1',
                    'ref_index_list' => array('id', 'value'),
                    'on_delete' => 'CASCADE',
                    'on_update' => 'CASCADE'
                )
            )
        );

        $foreigner = Relation::searchColumnInForeigners($foreigners, 'id');
        $expected = array();
        $expected['foreign_field'] = 'id';
        $expected['foreign_db'] = 'GSoC14';
        $expected['foreign_table'] = 'table_1';
        $expected['constraint'] = 'ad';
        $expected['on_delete'] = 'CASCADE';
        $expected['on_update'] = 'CASCADE';

        $this->assertEquals(
            $expected,
            $foreigner
        );
    }
}
