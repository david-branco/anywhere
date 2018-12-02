<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function index() {
        $this->load->model("aluno_model");
        $data['results'] = $this->aluno_model->getAlunos();
        $data['title'] = "Students List";
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("aluno/index", $data);
        $this->load->view('include/footer');
    }

    public function fileTree() {
    	$this->load->helper("directory");
    	// $this->load->helper("file");
    	// $this->load->helper("download");
    	// $this->load->helper("url");

    	$data['files'] = directory_map('./uploads/');
    	$this->load->view('include/header');
        $this->load->view('include/navbar');
    	$this->load->view("admin/fileTree", $data);
    	$this->load->view('include/footer');
    }
}
