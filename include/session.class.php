<?php
/**
 * session.class.php
 *
 * @package Clarity
 * @author Jeremy Madea <jdmadea@gmail.com> 
 * @copyright (C) 2007-2012, Jeremy Madea 
 * @filesource
 */

/**
 * Autoloading of classes is helpful when using sessions. 
 */
require_once( 'autoload.php' );

/**
 * Session class
 * @package Clarity
 */
final class Session 
{

   /**
    * id 
    * 
    * @static
    * @var mixed
    * @access private
    */
   private static $id;

    /**
     * $instance 
     * @static
     * @var object $instance
     * @access private
     */
    private static $instance; 

    /**
     * __construct
     *
     * Constructor
     *
     * @access private
     */
    private function __construct()
    {
        session_start();
        self::$id = session_id();
    }

    /**
     * destroy
     *
     * Destroy the session.
     *
     * @access public
     */
    public function destroy()
    {
        foreach (array_keys( $_SESSION ) as $key) {
            $_SESSION[ $key ] = null;
        }
        session_destroy();
    }

    /**
     * reset 
     *
     * Resets the session.
     * 
     * @access public
     * @return void
     */
    public function reset()
    {
        $_SESSION = array( 'userid' => $_SESSION['userid'] );
    }

    /**
     * instance
     *
     * Returns singleton instance of Session class.
     *
     * @access public
     * @returns Session Singleton instance of Session class.
     */
    public static function instance() 
    {
        if (!isset(self::$instance)) {
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    }

    /**
     * authenticated 
     *
     * Returns true if this session has been authenticated. False otherwise. 
     * 
     * @access public
     * @return boolean
     */
    public function authenticated()
    {
        
        return( isset( $this->userid ) );
    }

    /**
     * __get
     *
     * Overloads member retrieval. 
     *
     * @access public 
     * @param string $key 
     * @return mixed The session variable's value.
     */
    public function __get( $key )
    {
        return ( $_SESSION[ $key ] );
    }

    /**
     * __set
     *
     * Overloads member setting.
     *
     * @access public
     * @param string $key
     * @param mixed $val
     * @return mixed The newly set value ($val).
     */
    public function __set( $key, $val )
    {
        return ( $_SESSION[ $key ] = $val );
    }

    /**
     * __isset 
     *
     * Overloads isset() checking for members. 
     * 
     * @param string $key 
     * @access public
     * @return void
     */
    public function __isset( $key )
    {
        return isset( $_SESSION[ $key ] );
    }

    /**
     * __destruct
     *
     * Overloads the object destructor. 
     *
     * @access public
     */
    public function __destruct()
    {
        session_write_close();
    }

    /**
     * __clone
     *
     * Overloads object cloning. This is a singleton class so cloning results
     * in an error.
     *
     * @access public
     */
    public function __clone()
    {
        trigger_error(__CLASS__ . ' cannot be cloned.', E_USER_ERROR);
    }
}

Session::instance();

?>
