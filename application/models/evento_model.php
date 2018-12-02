<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evento_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getEvento($id) {
        $query = $this->db->get_where('Evento',array('evento_id'=>$id));
        return $query->row_array();
    }
}
