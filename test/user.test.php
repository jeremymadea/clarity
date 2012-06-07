<?php
/**
 * user.test.php
 *
 * Tests for the User class.
 *
 * @package Clarity
 * @subpackage tests
 * @author Jeremy Madea <jdmadea@gmail.com> 
 * @copyright (C) 2007, Jeremy Madea 
 * @filesource
 */

/**
 * Load the class we are testing.
 */
require_once '../include/user.class.php';


/**
 * Load the unit testing framework.
 */
require_once 'test_framework.php';

/**
 * UserTest 
 * 
 * @uses PHPUnit
 * @package Clarity
 * @subpackage tests 
 */
class UserTest extends PHPUnit_TestCase
{
    private $object;

    function __construct($name) {
       $this->PHPUnit_TestCase($name);
    }

    function setUp() {
        $this->object = new User();
        $this->admin  = new User( 1 );
    }

    function testConstructor()
    {
        $this->assertTrue( is_object( $this->object ));
    }

    function testDBObject()
    {
        $passed = true; 
        $passed &= ( $this->admin->id       == '1' );
        $passed &= ( $this->admin->username == 'admin' );
        $this->assertTrue( $passed );
    }

    function tearDown() {
        unset( $this->object );
    }
}

run_me( "UserTest" );

?>
