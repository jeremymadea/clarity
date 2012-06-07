<?php
/**
 * textview.class.php
 *
 * @package Clarity
 * @author Jeremy Madea <jdmadea@gmail.com>
 * @copyright (C) 2007-2012, Jeremy Madea 
 * @filesource
 */

/**
 * Require the interface which we will implement.
 */
require_once( 'view.interface.php' );

/**
 * TextView class
 *
 * Presents a plain text file to the client.
 *
 * @package Clarity
 */
class TextView implements ViewInterface
{
    const VIEWDIR = 'views/';
    const VIEWEXT = '.view.php';

    private $text;

    /**
     * __construct 
     * 
     * Constructor
     *
     * @param $text
     * @access public
     * @return void
     */
    public function __construct( $text )
    {   
        $this->text = $text;
    }

    /**
     * render 
     * 
     * @access public
     * @return void
     */
    public function render() 
    {
        header( 'Content-Type: text/plain');
        echo $this->text;
    }
}

?>
