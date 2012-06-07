<?php
/**
 * view.class.php
 *
 * @package Clarity
 * @author Jeremy Madea <jdmadea@gmail.com>
 * @copyright (C) 2007-2012, Jeremy Madea 
 * @filesource
 */

/**
 * Require the view interface which we will implement. 
 */
require_once( 'view.interface.php' );

/**
 * View class
 *
 * Used to represent the presentation layer of an action.
 *
 * @package Clarity
 */
class View implements ViewInterface
{
    const VIEWDIR = 'views/';
    const VIEWEXT = '.view.php';

    /**
     * template 
     * 
     * @var mixed
     * @access private
     */
    private $template;

    /**
     * prefix 
     * 
     * Array of views to render before rendering ourself.
     *
     * @var array
     * @access private
     */
    private $prefix = array();

    /**
     * suffix 
     *
     * Array of views to render after rendering ourself.
     * 
     * @var array
     * @access private
     */
    private $suffix = array();

    /**
     * __construct 
     *
     * Constructor
     * 
     * @param mixed $action 
     * @access public
     * @return void
     */
    public function __construct( $view, $prefix=array(), $suffix=array() )
    {
        $this->template = self::VIEWDIR . $view . self::VIEWEXT;
        $this->prefix   = $prefix;
        $this->suffix   = $suffix;
    }

    /**
     * render 
     *
     * Sends output to the client.
     * 
     * @access public
     * @return void
     */
    public function render() 
    {
        foreach ( $this->prefix as $view )
            $view->render();

        require( $this->template );

        foreach ( $this->suffix as $view )
            $view->render();
    }

}

?>
