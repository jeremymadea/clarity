<?php
/**
 * exceptions.php
 *
 * @package Clarity
 * @subpackage exceptions
 * @author Jeremy Madea <jdmadea@gmail.com>
 * @copyright (C) 2007-2012, Jeremy Madea
 * @filesource
 */

/**
 * Uses a text view to dump plain errors. 
 */
require_once( 'textview.class.php' );

/**
 * Uses an output buffer. 
 */
require_once( 'outputbuffer.class.php' );

/**
 * clarity_exception_handler
 *
 * This is our default exception handler for uncaught exceptions.
 * 
 * @param Exception $exception
 * @return void
 */
function clarity_exception_handler( Exception $exception ) 
{
    $buf = new OutputBuffer();

    echo "Uncaught Exception: " . $exception->getMessage() . ": \n"; 
    echo $exception->getTraceAsString();
    $buf->stop();
           
    $view = new TextView( $buf->contents() );
    $view->render();
}

set_exception_handler( 'clarity_exception_handler' );


/*********************************************************************
 *
 * Custom Exceptions
 *
 ********************************************************************/

/**
 * NotAuthorizedException 
 * 
 * @uses Exception
 * @package Clarity
 * @subpackage exceptions
 */
class NotAuthorizedException extends Exception { };

/**
 * AuthFailedException 
 * 
 * @uses Exception
 * @package Clarity
 * @subpackage exceptions
 */
class AuthFailedException    extends Exception { };

/**
 * BadArgsException 
 * 
 * @uses Exception
 * @package Clarity
 * @subpackage exceptions
 */
class BadArgsException       extends Exception { };




/********************************************************************** 
 *
 * Following code commented out as it doesn't play nicely with PEAR DB.
 *

function exceptions_error_handler( $severity, $message, $filename, $lineno)
{
    throw new ErrorException( $message, 0, $severity, $filename, $lineno );
}

set_error_handler( 'exceptions_error_handler');

 **********************************************************************/

?>
