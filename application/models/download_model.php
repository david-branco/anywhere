<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Download_model  extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function push_file($path, $name) {

        if(is_file($path)) {
            if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off'); } 
        }

        $this->load->helper('file');
        $mime = get_mime_by_extension($path);

        header('Pragma: public');    
        header('Expires: 0');         
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($path)).' GMT');
        header('Cache-Control: private',false);
        header('Content-Type: '.$mime); 
        header('Content-Disposition: attachment; filename="'.basename($name).'"'); 
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: '.filesize($path)); 
        header('Connection: close');
        readfile($path);
        exit();
    }
}
