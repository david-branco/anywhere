<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends CI_Controller {

    public function index() {
        $this->home();
    }

    public function home() {
        $data['title'] = "Homepage";
        $this->load->view("header_view", $data);
        $this->load->view("homepage_view", $data);
        $this->load->view("footer_view");
    }
}