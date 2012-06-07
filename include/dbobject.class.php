<?php 
/**
 * dbobject.class.php
 *
 * @package Clarity
 * @author Jeremy Madea <jdmadea@gmail.com> 
 * @copyright (C) 2007-2012, Jeremy Madea 
 * @filesource
 */

/**
 * Use the Database class.
 */
require_once( 'database.class.php' );

/**
 * DBObject
 *
 * Abstract base class for classes based on DB tables.
 *
 * @package Clarity
 */

abstract class DBObject {

  /**
   * members 
   * 
   * @var mixed
   * @access protected
   */
  protected $members;

  /**
   * Constructor 
   *
   * If $arg looks like an id, we try to find the database row that corresponds
   * to the id and create the object from that. If $arg is an array we use that
   * to construct the object instead. In that case, if the array does not have
   * an 'id' key, we attempt to insert the data into the database and we get
   * the insert id we were assigned. (This is the R in CRUD.)
   *
   * @param mixed $arg 
   * @access public
   * @return void
   */
  public function __construct( $arg=null )
  {
      if ( is_int( $arg ) || ctype_digit( $arg ) ) {
          // Retrieve from the database by ID.
          $this->members = Database::get_row_by_id($this->table, $arg);
      } 
      else if ( is_array( $arg ) ) {
          $this->members = $arg;
          if ( ! array_key_exists( 'id', $this->members )) {
              $this->members[ 'id' ] 
                  = Database::insert_and_get_id( $this->table, $this->members );
          }
      }
  }

  /**
   * save
   *
   * This will either Create (if necessary) or Update this object in the DB. 
   *
   * @access public
   * @return void
   */
  public function save()
  { 
      if ( is_null( $this->id )) 
          $this->create();
      else  
          $this->update(); 
  }

  /**
   * create 
   *
   * The C in CRUD. 
   * 
   * @access public
   * @return void
   */
  public function create() 
  {
      $this->id = Database::insert_and_get_id( $this->table, $this->members );
  }

  /**
   * update
   *
   * The U in CRUD.
   * 
   * @access public
   * @return void
   */
  public function update()
  {
      Database::update( $this->table, $this->members, "id='".$this->id."'");
  }

  /**
   * delete 
   *
   * The D in CRUD.
   * 
   * @param DBObject $dbo 
   * @static
   * @access public
   * @return void
   */
  public static function delete(DBObject $dbo) 
  {
      Database::delete_row_by_id( $dbo->table, $dbo->id );
  }

  /**
   * __get
   *
   * PHP 5 special function for generic read access to member variables. 
   * 
   * @param mixed $member 
   * @access private
   * @return void
   */
  private function __get( $member )
  {
      if ( is_array( $this->members ) 
        && array_key_exists( $member, $this->members ))
          return $this->members[ $member ];
  }

  /**
   * __set
   *
   * PHP 5 special function for generic write access to member variables. 
   * 
   * @param mixed $member 
   * @param mixed $value 
   * @access private
   * @return void
   */
  private function __set( $member, $value )
  {
      if ( array_key_exists( $member, $this->members ))
          return $this->members[ $member ] = $value;
  }
} 

?>
