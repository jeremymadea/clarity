<?php
/**
 * molecule.test.php
 *
 * Tests for the Molecule class.
 *
 * @package Clarity
 * @subpackage tests
 * @author Jeremy Madea <jeremymadea@gmail.com> 
 * @copyright (C) 2007, Jeremy Madea 
 * @version SVN: $Id: htmlutil.test.php 7 2007-09-26 19:51:18Z jeremy $
 * @filesource
 */

/**
 * File containing the functions we are testing. 
 */
require_once '../include/htmlutil.php';

/**
 * Use our testing framework. 
 */
require_once 'test_framework.php';

/**
 * HTMLUtilTest 
 * 
 * @uses PHPUnit
 * @package Clarity
 * @subpackage tests 
 */
class HTMLUtilTest extends PHPUnit_TestCase
{
    private $password;

    function __construct($name) 
    {
       $this->PHPUnit_TestCase($name);
    }

    function setUp() 
    {
        $this->html = array(
            select( "foo",array( "bar"=>"baz","baz"=>"qux"),"baz","myid")
        );
        $this->expect = array( 
            "<select id='myid' name='foo'><option value=\"bar\">baz</option>" .
            "<option value=\"baz\" selected=\"selected\">qux</option></select>"
        );
    }

    function tearDown() 
    {
    }

    function testSelect() 
    {
        $this->assertTrue( $this->html[0] == $this->expect[0] );
    }
}

run_me( "HTMLUtilTest" );

?>
