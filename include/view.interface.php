<?php
/**
 * view.interface.php
 *
 * @package Clarity
 * @author Jeremy Madea <jdmadea@gmail.com> 
 * @copyright (C) 2007-2012, Jeremy Madea 
 * @filesource
 */


/**
* ViewInterface
* @package Clarity
*/
interface ViewInterface 
{
    /**
     * render 
     *
     * Sends output to the client.
     *
     * @access public
     * @return void
     */
    public function render();
}

?>
