<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grupo extends CI_Controller {

    public function index() {
        $this->load->model("grupo_model");
        $data['results'] = $this->grupo_model->getGrupos();
        $data['title'] = "Work Teams List";
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("grupo/index", $data);
        $this->load->view('include/footer');
    }

    public function profile() {
        $id = $this->uri->segment(3);
        $this->load->model("grupo_model");
        $data = $this->grupo_model->getGrupo($id);
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("grupo/profile", $data);
        $this->load->view('include/footer');
    }

    public function show() {
        $id_grupo = $this->uri->segment(3);
        $this->load->model("grupo_model");
        $this->load->model("trabalho_model");
        $data['grupo'] = $this->grupo_model->getGrupo($id_grupo);
        $data['trabalho'] = $this->grupo_model->getTrabalhoFromGrupo($id_grupo);
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("grupo/show", $data);
        $data['title'] = "";
        $data['id_grupo'] = $id_grupo;
        $data['results'] = $this->grupo_model->getAlunosFromGrupo($id_grupo);
        $this->load->view("grupo/alunoList", $data);
        $data['results'] = $this->grupo_model->getSubmissoesFromGrupos($id_grupo);
        $data['title'] = "Submissions List";
        $this->load->view('submissao/showList',$data);
        $this->load->view('include/footer');
    }

    public function showList() {
        $id = $this->uri->segment(3);
        $this->load->model('trabalho_model');        
        $data['results'] = $this->trabalho_model->getGruposFromTrabalho($id);
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('grupo/showList',$data);
        $this->load->view('include/footer');
    }

    public function register() {
        $id = $this->uri->segment(3);
        $this->load->model("grupo_model");
        $this->grupo_model->inscreverEmGrupo($id);
        $data = $this->grupo_model->getGrupo($id);
        $this->session->set_flashdata('message', 'Registration completed successfully');
        redirect(base_url()."index.php/grupo/show/".$data['grupo_id']);          
    }

    public function unregister() {
        $id = $this->uri->segment(3);
        $this->load->model("grupo_model");
        $this->load->model("trabalho_model");
        $this->load->model("aluno_model");
        $this->grupo_model->cancelarInscricaoEmGrupo($id);
        $data = $this->grupo_model->getTrabalhoFromGrupo($id);
        $this->session->set_flashdata('message', 'Unregistration completed successfully');
        redirect(base_url()."index.php/trabalho/show/".$data['trabalho_id']); 
    }

    public function form() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("numero", "Number of Work Teams", "required|is_natural_no_zero|xss_clean");

        $this->load->model("grupo_model");
        $this->load->model("trabalho_model");
        $data['title'] = "Work Teams";
        $data['id_trabalho'] = $this->uri->segment(3);

        if($this->form_validation->run() == FALSE) {        
            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view("grupo/form", $data);
            $this->load->view('include/footer');
        }

        else {
            if(empty($data['id_trabalho'])) { $data['id_trabalho'] = $_POST['trabalho']; } 
            $this->grupo_model->inserirGrupos($data['id_trabalho'], set_value("numero"));
            $this->session->set_flashdata('message', 'The Work Team was successfully created');   
            redirect(base_url()."index.php/trabalho/show/".$data['id_trabalho']);          
        }
    }

    public function evaluate() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("avaliacao", "evaluation", "xss_clean");

        $this->load->model("grupo_model");
        $data['title'] = "Evaluation";
        $id_grupo = $this->uri->segment(3);
        $data['id_grupo'] = $id_grupo;

        if($this->form_validation->run() == FALSE) {        
            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view("grupo/evaluate", $data);
            $this->load->view('include/footer');
        }

        else {
            $this->grupo_model->avaliar($id_grupo);
            $this->session->set_flashdata('message', 'The Work Team was successfully evaluated');   
            redirect(base_url()."index.php/grupo/show/".$id_grupo); 
        }
    }

    public function delete() {
        $id_trabalho = $this->uri->segment(3);        
        $id_grupo = $this->uri->segment(4);
        $this->load->model('grupo_model');
        $this->grupo_model->apagar($id_grupo,$id_trabalho,TRUE);
        $this->session->set_flashdata('message', 'The Work Team was successfully deleted');
        if($this->session->userdata("type") == "T") { redirect(base_url()."index.php/trabalho/show/".$id_trabalho); }
        else { redirect(base_url()."index.php/grupo", "refresh"); } 
    } 
}