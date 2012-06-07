<?php
/**
 * error.test.php
 *
 * Tests for the Error class.
 *
 * @package Clarity
 * @subpackage tests
 * @author Jeremy Madea <jeremymadea@gmail.com> 
 * @copyright (C) 2007, Jeremy Madea 
 * @version SVN: $Id: error.test.php 7 2007-09-26 19:51:18Z jeremy $
 * @filesource
 */

/**
 * Load the class we are testing.
 */
require_once '../include/error.class.php';


/**
 * Load the unit testing framework.
 */
require_once 'test_framework.php';

/**
 * ErrorTest 
 * 
 * @uses PHPUnit
 * @package Clarity
 * @subpackage tests 
 */
class ErrorTest extends PHPUnit_TestCase
{
    /**
    * @internal
    */
    private $object;

    function __construct($name) {
       $this->PHPUnit_TestCase($name);
    }

    function setUp() {
        $this->object = new Error("This is a test.");
    }

    function testConstructor()
    {
        $this->assertTrue( is_object( $this->object ));
    }

    function testStringify() {
//        ob_flush();
        ob_start();
        echo "'", $this->object->message() , "'\n";
        $string1 = ob_get_contents();
        ob_end_clean();

        ob_start();
        echo "'", $this->object , "'\n";
        $string2 = ob_get_contents();
        ob_end_clean();

        $this->assertTrue( $string1 == $string2 );
    }

    function tearDown() {
        unset( $this->object );
    }
}

run_me( "ErrorTest" );

?>
