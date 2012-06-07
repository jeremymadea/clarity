<?php
/**
 * passwd.test.php
 *
 * Tests for the password utilities.
 *
 * @package Clarity
 * @subpackage tests
 * @author Jeremy Madea <jdmadea@gmail.com> 
 * @copyright (C) 2007, Jeremy Madea 
 * @filesource
 */

/**
 * File containing the functions we are testing. 
 */
require_once '../include/passwd.php';

/**
 * Use our testing framework. 
 */
require_once 'test_framework.php';

/**
 * PasswdTest 
 * 
 * @uses PHPUnit
 * @package Clarity
 * @subpackage tests 
 */
class PasswdTest extends PHPUnit_TestCase
{
    private $password;

    function __construct($name) 
    {
       $this->PHPUnit_TestCase($name);
    }

    function setUp() 
    {
        $this->password = "this_is_a_password";
    }

    function tearDown() 
    {
    }

    function testLengthCorrect() 
    {
        $e1 = encrypt_password( $this->password );
        $this->assertTrue( strlen($e1) === 48 );
    }

    function testUniqueSalts() 
    {
        $e1 = encrypt_password( $this->password );
        $e2 = encrypt_password( $this->password );
        $this->assertTrue( $e1 != $e2 );
    }

    function testCheckPasswd() 
    {
        $e1 = encrypt_password( $this->password );
        $this->assertTrue( check_password( $this->password, $e1 ));
    }
}

run_me( "PasswdTest" );

?>
