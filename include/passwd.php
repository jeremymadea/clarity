<?php
/**
 * passwd.php
 *
 * Contains utility functions for working with passwords.
 *
 * @package Clarity
 * @subpackage utility
 * @author Jeremy Madea <jdmadea@gmail.com> 
 * @copyright (C) 2007-2012, Jeremy Madea 
 * @filesource
 */

/**
 * new_salt 
 * 
 * @access public
 * @return string A string suitable for use as a salt.
 */
function new_salt() 
{ 
    return substr( md5( uniqid( rand(), true )), -8 ); 
}

/**
 * encrypt_password
 *
 * Takes a plaintext password and a salt and returns the encrypted password.
 *
 * @param string $plaintext the plaintext password.
 * @param string $salt the salt.
 * @returns string the encrypted password.
 */
function encrypt_password( $plaintext, $salt='' ) 
{ 
    if ($salt === '') $salt = new_salt();
    return sha1( $plaintext . $salt ) . $salt; 
}

/**
 * check_password
 *
 * Takes a plaintext password and an encrypted password. Returns true if they
 * match and false otherwise. This is done by encrypting the plaintext password
 * and checking that it equals the provided encrypted password.
 *
 * @param string $plaintext a plaintext password.
 * @param string $encrypted an encrypted password.
 * @returns boolean true if passwords match, false otherwise.
 */
function check_password( $plaintext, $encrypted )
{
    $salt = substr( $encrypted, -8 );
    return encrypt_password( $plaintext, $salt ) === $encrypted ? true : false;
}

?>
