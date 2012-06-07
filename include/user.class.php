<?php
/**
 * user.class.php
 *
 * @package Clarity
 * @author Jeremy Madea <jdmadea@gmail.com> 
 * @copyright (C) 2007-2012, Jeremy Madea 
 * @filesource
 */

/**
 *  Require our base class.
 */
require_once( "dbobject.class.php" );

/**
 * We need to access the database.
 */
require_once( "database.class.php" );

/**
 * User login requires password utility functions. 
 */
require_once( "passwd.php" ); 

/**
 * User class
 * @package Clarity
 */  
class User extends DBObject
{
    const TABLE = 'users';             // for class methods
    protected $table = self::TABLE;    // for instance methods

    protected $members = array( 
        'id'       => null, 
        'username' => null,
        'password' => null,
        'email'    => null,
    );

    /**
     * $password 
     *
     * The user's password.
     *
     * @access private
     * @var string $password
     */
    private $password;

    /**
     * $resources 
     * 
     * @var array
     * @access private
     */
    private $resources;


    /**
     * __construct 
     * 
     * @access public
     * @return void
     */
    public function __construct( $id=null )
    {
        parent::__construct( $id );
    }

    /**
     * create_new_user 
     * 
     * @param mixed $userdata 
     * @static
     * @access public
     * @return void
     * @todo
     */
    public static function create_new_user( $userdata )
    {
        // TODO - create_new_user
    }


    /**
     * sList 
     * 
     * @static
     * @access public
     * @return void
     */
    public static function sList()
    {
        $list = array( '0' => 'All' ); 
        $rows = Database::get_cols( self::TABLE, array( 'id', 'username' ) );
        foreach ($rows as $row) {
            $list[ $row[ 'id' ] ] = $row[ 'username' ]; 
        }
        return $list;
    }

    
    /**
     * login
     *
     * @access public
     * @static
     * @param string $username
     * @param string $password
     * @return mixed Boolean false on failure, a User object on success.
     */
    public static function login( $username, $password ) 
    {
        $rows = Database::get_rows( 'users', 'username=?', array( $username ));

        $row = $rows[0];

        if ( $row && check_password( $password, $row[ 'password' ] ))
            return new User( $row['id'] );
        else 
            return false;
    }
}

?>
