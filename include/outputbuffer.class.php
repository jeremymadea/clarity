<?php 
/**
 * outputbuffer.class.php
 *
 * @package Clarity
 * @author Jeremy Madea <jdmadea@gmail.com>
 * @copyright (C) 2007-2012, Jeremy Madea
 * @filesource
 */


class OutputBuffer {

    /**
     * OB_STARTED
     */
    const OB_STARTED = 1; 

    /**
     * OB_STOPPED
     */
    const OB_STOPPED = 2; 

    /**
     * contents 
     * 
     * @var mixed
     * @access private
     */
    private $contents; 

    /**
     * state 
     * 
     * @var mixed
     * @access private
     */
    private $state;

    /**
     * __construct 
     * 
     * @access public
     * @return void
     */
    public function __construct() 
    {
        ob_start();
        $this->state = self::OB_STARTED;
    }

    /**
     * start 
     * 
     * @access public
     * @return void
     */
    public function start() 
    {
        if ( $this->state == OB_STOPPED )
            ob_start();
    }

    /**
     * contents 
     * 
     * @access public
     * @return void
     */
    public function contents() 
    {   
        if ( $this->state == self::OB_STARTED ) {
            $this->stop();
            $this->start();
        }
        return $this->contents; 
    }

    /**
     * stop 
     * 
     * @access public
     * @return void
     */
    public function stop() 
    {
        $this->contents .= ob_get_contents();
        ob_end_clean();
        $this->state = self::OB_STOPPED;
    }
}

?>
