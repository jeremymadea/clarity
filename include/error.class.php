<?php
/**
 * error.class.php
 *
 * @package Clarity
 * @author Jeremy Madea <jdmadea@gmail.com> 
 * @copyright (C) 2007-2012, Jeremy Madea 
 * @filesource
 */

/**
 * Error 
 * 
 * @package Clarity
 */
class Error 
{
    /**
     * file 
     * 
     * @var string
     * @access private
     */
    private $file;

    /**
     * line 
     * 
     * @var string
     * @access private
     */
    private $line; 

    /**
     * func 
     * 
     * @var string
     * @access private
     */
    private $func; 

    /**
     * mesg 
     * 
     * @var string
     * @access private
     */
    private $mesg;

    /**
     * Constructor
     *
     * @param string $mesg 
     * @param string $file 
     * @param string $line 
     * @param string $func 
     * @access public
     * @return void
     */
    public function __construct( $mesg='Error', $file='', $line='', $func='' )
    {
        $this->file = $file;
        $this->line = $line;
        $this->mesg = $mesg;
        $this->func = $func;
    }

    /**
     * message 
     * 
     * @access public
     * @return void
     */
    public function message()
    {
        $string = '';
        if ( !empty( $this->file ))
            $string .= $this->file;
        if ( !empty( $this->line ))
            $string .= ':' . $this->line; 
        if ( !empty( $this->func ))
            $string .= ' (' . $this->func . '): ';
        $string .= $this->mesg;
        return $string;
    }

    /**
     * __toString 
     *
     * PHP5 special function for overriding this object's string representation.
     * 
     * @access public
     * @return void
     */
    public function __toString()
    {
        return $this->message();
    }
}

?>
