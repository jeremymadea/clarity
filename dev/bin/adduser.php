#!/usr/bin/php
<?php
require_once( 'clarity/database.class.php' );
require_once( 'clarity/passwd.php' );

$username = $argv[ 1 ];
$password = $argv[ 2 ];
$email    = $argv[ 3 ] || '';

$enc_pass = encrypt_password( $password );

$values = array( 
    'username' => $username, 
    'password' => $enc_pass,
    'email'    => $email,
);

$id = Database::insert_and_get_id( 'users', $values );

echo "User {$username} inserted with id {$id}\n";


?>
