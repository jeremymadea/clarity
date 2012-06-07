<?php
/**
 * upload.class.php
 *
 * @package Clarity
 * @author Jeremy Madea <jdmadea@gmail.com> 
 * @copyright (C) 2007-2012, Jeremy Madea 
 * @filesource
 */


/**
 * Upload class
 * 
 * This class is for handling uploaded files.
 *
 * @package Clarity
 */
class Upload 
{
    /**
     * directory 
     * 
     * @static
     * @var string
     * @access public
     */
    static $directory = '/tmp';

    /**
     * name 
     *
     * Name of uploaded file on the client side.
     * 
     * @var mixed
     * @access private
     */
    private $name; 

    /**
     * size 
     *
     * Size in bytes of uploaded file.
     * 
     * @var mixed
     * @access private
     */
    private $size; 

    /**
     * type 
     * 
     * MIME type of uploaded file (According to the client.)
     *
     * @var mixed
     * @access private
     */
    private $type; 

    /**
     * path 
     *
     * Path to the uploaded file after it has been accepted.
     *
     * @var mixed
     * @access private
     */
    private $path; 


    /**
     * __construct 
     *
     * Constructor
     *
     * @param Array $fileinfo 
     * @param string $prefix 
     * @access public
     * @return void
     */
    public function __construct( Array $fileinfo, $prefix='aimd' ) 
    { 

        if ( !is_array( $fileinfo ) || empty( $fileinfo )) {
            die( "ERROR: (file upload): Bad argument to constructor.");
        }

        if ( $fileinfo['error'] != UPLOAD_ERR_OK ) { 
            $message = "ERROR: (file upload): ";
            switch( $fileinfo['error'] ) {
                case UPLOAD_ERR_INI_SIZE:
                    $message .= "size exceeds upload_max_filesize directive.";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $message .= "size exceeds MAX_FILE_SIZE of form.";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $message .= "upload did not complete.";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $message .= "no file was uploaded.";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $message .= "temp directory does not exist.";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $message .= "write failed.";
                    break;

            }
            die( $message );
        }

        $this->name = $fileinfo[ 'name' ];
        $this->size = $fileinfo[ 'size' ];
        $this->type = $fileinfo[ 'type' ];
        $this->path = tempnam( self::$directory, $prefix );

        $moved = move_uploaded_file( $fileinfo[ 'tmp_name' ], $this->path );

        if ( !$moved ) die( 'ERROR: (file upload): temp file not moved.' );
    }

    /**
     * contents 
     * 
     * @access public
     * @return string The contents of the uploaded file.
     */
    public function contents()
    {
        return( file_get_contents( $this->path ));
    }

    /**
     * name 
     * 
     * @access public
     * @return string The name of provided for the uploaded file.
     */
    public function name()
    {
        return( $this->name );
    }

    /**
     * path 
     * 
     * @access public
     * @return string
     */
    public function path()
    {
        return( $this->path );
    }

    /**
     * type 
     * 
     * @access public
     * @return MIME-type The specified MIME type of the uploaded file.
     */
    public function type()
    {
        return( $this->type );
    }

    /**
     * size 
     * 
     * @access public
     * @return integer The size of the uploaded file in bytes.
     */
    public function size()
    {
        return( $this->size );
    }
}

?>
