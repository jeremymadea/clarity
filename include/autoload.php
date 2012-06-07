<?php
/**
 * autoload.php
 *
 * @package Clarity
 * @author Jeremy Madea <jdmadea@gmail.com> 
 * @copyright (C) 2007-2012, Jeremy Madea 
 * @filesource
 */

/**
 * __autoload
 *
 * Special PHP function to load a class definition when the class cannot be 
 * found. 
 *
 * This is useful as it prevents errors that are dependent on the order of 
 * requires when storing objects in the $_SESSION array.
 *
 * @param mixed $classname 
 * @return void
 */
function __autoload( $classname )
{
    // The try/catch in this function is a kludge to get around the fact that
    // we can't seem to throw an exception from __autoload and get it to be 
    // caught by the exception handler we have set. This try/catch just gives
    // us the chance to catch it ourselves and pass it off to the exception
    // handler manually. 
    try {
        $file = strtolower( $classname ) . '.class.php';
        if ( !is_includeable( $file )) {
            throw new Exception( "cannot find include file '{$file}'" );
        }
        require_once( $file );
    } catch( Exception $e ) {
        clarity_exception_handler( $e );
    }

}

/**
 * is_includeable
 *
 * Checks the ability to include the named file. 
 *
 * @param string $filename 
 * @return boolean true if includeable, false otherwise.
 */
function is_includeable( $filename )
{
    $dirs = explode( PATH_SEPARATOR, get_include_path() ); 

    foreach ( $dirs as $dir ) {
        $file = $dir . DIRECTORY_SEPARATOR . $filename;
        if ( is_file( $file ) && is_readable( $file )) return true;
    }
    return false; 
}


?>
