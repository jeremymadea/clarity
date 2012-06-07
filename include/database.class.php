<?php
/**
 * database.class.php
 *
 * @package OCP
 * @author Jeremy Madea <jeremymadea@gmail.com>
 * @copyright 2007 
 * @version SVN: $Id: database.class.php 25 2007-11-30 10:01:23Z root $
 * @filesource
 */

/**
 * Use PEAR DB. 
 */
require_once( 'MDB2.php' );

/**
 * Application configuration includes database connection parameters. 
 */
require_once( 'config.php' );

Database::instance(array( 
    'phptype'  => $CONFIG['dbtype'],
    'username' => $CONFIG['username'],
    'password' => $CONFIG['password'],
    'hostspec' => $CONFIG['hostspec'],
    'database' => $CONFIG['database'] 
));

/**
 * Database class
 *
 * Manages the connection to the database and interaction between the 
 * application and the database. Uses a singleton design pattern.
 *
 * @package OCP
 */
final class Database 
{
    /**
     * $instance
     *
     * The single instance of the Database class. (Singleton Pattern)
     *
     * @access private
     * @var object $instance
     */
    private static $instance; 

    /**
     * $db 
     *
     * The database connection.
     *
     * @access private
     * @var mixed $db
     */
    private $db;

    /**
     * Constructor
     *
     * Creates and stores a database connection.
     *
     * @access private
     */
    private function __construct( $dsn )
    {
        $this->db =& MDB2::connect( $dsn );
        $this->db->loadModule('Extended');
        if ( PEAR::isError( $this->db ) )
            die( $db->getMessage() );
    }

    /**
     * db 
     *
     * Returns the underlying PEAR object.
     * 
     * @return DB PEAR DB connection object.
     * @access public
     */
    public function db()
    {
        return $this->db;
    }

    /**
     * instance
     *
     * Class method returns the singleton database instance.
     *
     * @access public
     * @static
     * @param string $dsn
     * @returns mixed The database instance.
     */
    public static function instance( $dsn='' ) 
    {
        if ( !isset( self::$instance ) ) {
        $class = __CLASS__;
            self::$instance = new $class( $dsn );
        }

        $db = self::$instance->db();
        if ( PEAR::isError( $db )) {
            die( $db->getMessage() . "\n" );
        }

        return self::$instance;
    }

    public static function quote( $value )
    {
        // Stripslashes
        if ( get_magic_quotes_gpc() ) {
            $value = stripslashes($value);
        }
        // Quote if not numeric
        if ( !is_numeric($value) ) {
            $value = "'" . mysql_real_escape_string($value) . "'";
        }
        return $value;
    }


    /**
     * query
     *
     * Wrapper for PEAR DB query() function. 
     * 
     * @param mixed $sql 
     * @param mixed $vals 
     * @static
     * @access public
     * @return mixed
     */
    public static function query( $sql, $vals )
    {
        $finfo = "query( {$sql}, {$vals} )";
        $db = self::$instance->db();

        $result = $db->query( $sql, $vals ); 
        if ( PEAR::isError( $result ) ) {
            die( $finfo . ": (query): " . $result->getMessage() . "\n" );
        }

        return $result;
    }

    /**
     * get_row_by_id
     *
     * Class method returns a row from a database table as an array.
     *
     * @access public
     * @static
     * @param integer $id
     * @param string $table
     * @returns array The row with the specified id from the specified table.
     */
    public static function get_row_by_id( $table, $id )
    {
        $finfo = "get_row_by_id( {$table}, {$id} )";
        $db = self::$instance->db();

        $sth = $db->prepare( "SELECT * FROM {$table} WHERE id=?" ); 
        if ( PEAR::isError( $sth ) ) {
            die( $finfo . ": (prepare): " . $sth->getMessage() . "\n" );
        }

        $result = $sth->execute( $id ); 
        if ( PEAR::isError( $result ) ) {
            die( $finfo . ": (execute): " . $result->getMessage() . "\n" );
        }

        $array = $result->fetchRow(MDB2_FETCHMODE_ASSOC); 
        if ( PEAR::isError( $array ) ) {
            die( $finfo . ": (fetchRow): " . $array->getMessage() . "\n" );
        }

        return $array;
    }

    /**
     * delete_row_by_id
     *
     * Class method deletes a row specified by id from a database table.
     *
     * @access public
     * @static
     * @param integer $id
     * @param string $table
     * @returns boolean True on success, false otherwise. 
     */
    public static function delete_row_by_id( $table, $id )
    {
        $finfo = "delete_row_by_id( {$table}, {$id} )";
        $db = self::$instance->db();

        $sth = $db->prepare( "DELETE FROM {$table} WHERE id=?" ); 
        if ( PEAR::isError( $sth ) ) {
            die( $finfo . ": (prepare): " . $sth->getMessage() . "\n" );
        }

        $result = $sth->execute( $id ); 
        if ( PEAR::isError( $result ) ) {
            die( $finfo . ": (execute): " . $result->getMessage() . "\n" );
        }
 
        return( $result == MDB2_OK ? true : false );
    }

    /**
     * last_insert_id
     *
     * Class method returns the last insert id. 
     *
     * @access public
     * @static
     * @return void
     */
    public static function last_insert_id()
    {
        $finfo = "last_insert_id()";
        $db = self::$instance->db();
        $result  = $db->queryOne( 'SELECT LAST_INSERT_ID();' );
        if ( PEAR::isError( $result )){
            die( $finfo . ": (queryOne): " . $result->getMessage() . "\n" );
        }
        return( $result );
    }

    /**
     * insert
     *
     * Class method to insert the data in an associative array into a 
     * specified table. The array keys are the field names and the values 
     * are the values to be stored in those fields.
     *
     * @access public
     * @static
     * @param string $table 
     * @param array $assoc 
     * @return true
     */
    public static function insert( $table, $assoc )
    {
        $finfo = "insert({$table}, {$assoc})";
        $db = self::$instance->db();
        $result = $db->autoExecute( $table, $assoc );
        if ( PEAR::isError( $result )) {
            print_r( $assoc );
            die( $finfo . ": (autoExecute): " . $result->getMessage() . "\n" );
        }
        return( true );
    }

    /**
     * insert_and_get_id
     *
     * Class method to insert the data in an associative array into a 
     * specified table and return the id assigned to the inserted row. The 
     * array keys are the field names and the values are the values to be 
     * stored in those fields.
     *
     * @param mixed $table 
     * @param mixed $assoc 
     * @static
     * @access public
     * @return integer
     */
    public static function insert_and_get_id( $table, $assoc )
    {
//print_r($assoc);
        $finfo = "insert_and_get_id({$table}, {$assoc})";
        self::insert( $table, $assoc );
        return self::last_insert_id();
    }

    /**
     * update
     *
     * Class method to update the data in an associative array into a 
     * specified table. The array keys are the field names and the 
     * values are the values to be stored in those fields.
     *
     * @param string $table 
     * @param array $assoc 
     * @param string $where 
     * @static
     * @access public
     * @return true
     */
    public static function update( $table, $assoc, $where )
    {
        $finfo = "update({$table}, {$assoc}, {$where})";
        $db = self::$instance->db();

        $result 
            = $db->autoExecute( $table, $assoc, MDB2_AUTOQUERY_UPDATE, $where );

        if ( PEAR::isError( $result )) {
            die( $finfo . ": (autoExecute): " . $result->getMessage() . "\n" );
        }
        return( true );
    }

    public static function set( $table, $col, $val, $wcol, $wval )
    {
        $db = self::$instance->db();

        $where = "{$wcol}=" . $db->quote($wval); 
        return( self::update( $table, array( $col => $val ), $where) ); 
    }

    /**
     * get_rows 
     *
     * Gets complete rows (SELECT *) from the database. A where clause may be
     * supplied as the second argument. Additionally, the where clause may 
     * contain placeholders in which case the third argument must be an array
     * of values to fill those placeholders. Returns an array of associative
     * arrays.
     *
     * @param mixed $table 
     * @param mixed $where 
     * @param Array $vals 
     * @static
     * @access public
     * @return array of arrays.
     */
    public static function get_rows( $table, $where=null, Array $vals=array() )
    {
        $finfo = "get_rows({$table}, {$where}, {$vals})"; 

        $sql = "SELECT * FROM {$table}"; 

        if ( !is_null( $where )) {
            $sql .= " WHERE {$where}";
        }
        $peardb = self::$instance->db();
        $rows   = $peardb->extended->getAll( $sql, null, $vals, 
                                                   null, MDB2_FETCHMODE_ASSOC );

        if ( PEAR::isError( $rows )) {
            die( $finfo . ": (getAll): " . $rows->getMessage() . "\n" );
        }

        return( $rows );
    }

    /**
     * delete
     *
     * Deletes rows from the specified table in the database. A where clause 
     * may (and usually should) be provided. 
     *
     * @param mixed $table 
     * @param string $where 
     * @static
     * @access public
     * @return void
     */
    public static function delete ( $table, $where=null )
    {
        $finfo = "delete({$table}, {$where})"; 

        $peardb = self::$instance->db();

        $rows = $peardb->autoExecute( $table, array(), MDB2_AUTOQUERY_DELETE, $where );

        if ( PEAR::isError( $rows )) {
            die( $finfo . ": (query): " . $rows->getMessage() . "\n" );
        }
        return true;
    }


    /**
     * get_column
     *
     * Gets a single column from a database table. A where clause may be
     * supplied as the third argument. Additionally, the where clause may 
     * contain placeholders in which case the third argument must be an array
     * of values to fill those placeholders. Returns an array of strings.
     *
     * @param mixed $table 
     * @param mixed $col 
     * @param mixed $where 
     * @param Array $vals 
     * @static
     * @access public
     * @return array
     */
    public static function get_column( $table, $col, $where=null, 
                                       Array $vals=array() )
    {
        $finfo = "get_column( {$table}, {$col}, {$where}, {$vals} )"; 

        $sql = "SELECT {$col} FROM {$table}"; 
        if ( !is_null( $where )) {
            $sql .= " WHERE {$where}";
        }
        $peardb = self::$instance->db();
        $rows   = $peardb->getCol( $sql, null, $vals, null, $col );

        if ( PEAR::isError( $rows )) {
            die( $finfo . ": (getCol): " . $rows->getMessage() . "\n" );
        }

        return( $rows );
    }

    /**
     * get_cols
     *
     * Gets columns from a database table. A where clause may be
     * supplied as the third argument. Additionally, the where clause may 
     * contain placeholders in which case the third argument must be an array
     * of values to fill those placeholders. Returns an array of associative 
     * array where the keys are the column names and the values are the values
     * stored in the database.
     *
     * @param mixed $table 
     * @param Array $columns 
     * @param mixed $where 
     * @param Array $vals 
     * @static
     * @access public
     * @return array
     */
    public static function get_cols( $table, Array $columns, $where=null, 
                                     Array $vals=array() )
    {
        $finfo = "get_cols( {$table}, {$columns}, {$where}, {$vals} )"; 

        $cols = '`' . join( '`,`', $columns) . '`' ;

        $sql = "SELECT {$cols} FROM {$table}"; 
        if ( !is_null( $where )) {
            $sql .= " WHERE {$where}";
        }
        $peardb = self::$instance->db();
        $rows   = $peardb->getAll( $sql, null, $vals, 
                                         null, MDB2_FETCHMODE_ASSOC );

        if ( PEAR::isError( $rows )) {
            die( $finfo . ": (getAll):[{$sql}] " . $rows->getMessage() . "\n" );
        }

        return( $rows );
    }

    /**
     * id_exists
     *
     * Returns true if the supplied id exists in the supplied table. False
     * otherwise.
     *
     * @param string $table 
     * @param integer $id 
     * @static
     * @access public
     * @return boolean
     */
    public static function id_exists( $table, $id )
    {
        $finfo = "id_exists( {$table}, {$id} )";
        $sql = "SELECT COUNT(*) FROM {$table} WHERE id=?";

        $peardb = self::$instance->db();
        $result = $peardb->getOne( $sql, null, array( $id ) );

        if ( PEAR::isError( $result )) {
            die( $finfo . ": (getOne): " . $result->getMessage() . "\n" );
        }

        return( $result == 1 );
    }

    /**
     * row_count
     *
     * Returns the number of rows in the specified table that match a supplied 
     * where clause. The where clause may contain placeholders in which case 
     * the third argument must be an array of values to fill them.
     * 
     * @param mixed $table 
     * @param mixed $where 
     * @param Array $vals 
     * @static
     * @access public
     * @return integer
     */
    public static function row_count( $table, $where, Array $vals=array() )
    {
        $finfo = "row_count( {$table}, {$where} )";
        $sql = "SELECT COUNT(*) FROM {$table} WHERE {$where}";

        $peardb = self::$instance->db();
        $result = $peardb->getOne( $sql, null, $vals );

        if ( PEAR::isError( $result )) {
            die( $finfo . ": (getOne): " . $result->getMessage() . "\n" );
        }

        return( $result );
    }

}

?>
