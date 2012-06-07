<?php
/**
 * test_framework.php
 *
 * Common code used by unit tests.
 *
 * @package Clarity
 * @subpackage tests
 * @author Jeremy Madea <jdmadea@gmail.com> 
 * @copyright (C) 2007, Jeremy Madea 
 * @filesource
 */

/**
 * Our tests are all based on PHPUnit. 
 */
require_once 'PHPUnit.php';

/**
 * run_me()
 *
 * Runs a test.
 *
 * @param string $testname
 */
function run_me( $testname ) 
{
#    if ( defined( 'TESTING' ))
#    {
        echo "\n********** $testname **********\n";
        $suite = new PHPUnit_TestSuite( $testname );
        $result = PHPUnit::run( $suite );
        echo $result->toString();
        echo "\n";
#    }
}
               

?>
