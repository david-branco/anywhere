<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Submissao extends CI_Controller {

    public function index() {
        $this->load->model("submissao_model");
        $data['results'] = $this->submissao_model->getSubmissoes();
        $data['title'] = "Submissions List";
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("submissao/index", $data);
        $this->load->view('include/footer');
    }


    public function showList() {
        $id_grupo = $this->uri->segment(3);
        $this->load->model("grupo_model");
        $data['results'] = $this->grupo_model->getSubmissoesFromGrupos($id_grupo);
        $data['title'] = "Submissions List";
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('submissao/showList',$data);
        $this->load->view('include/footer');
    }

    public function form() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("file", "File", "xss_clean");
        $this->form_validation->set_rules("descricao", "Description", "descricao"); 

        $this->load->model("submissao_model");
        $this->load->model("grupo_model");
        $this->load->model("trabalho_model");
        $id_grupo = $this->uri->segment(3);
        $data['id_grupo'] = $id_grupo;        
        $data['title'] = "Submission";
        $data['descricao'] = "";
        $data['message'] = "";

        if($this->form_validation->run() == FALSE) {          
            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view("submissao/form", $data);
            $this->load->view('include/footer');
        }

        else {
            $this->load->helper('date');
            if(empty($id_grupo)) { $id_grupo = $_POST['grupo']; }
            $trabalho = $this->grupo_model->getTrabalhoFromGrupo($id_grupo);
            $disciplina = $this->trabalho_model->getDisciplinaFromTrabalho($trabalho['trabalho_id']);

            $config['upload_path'] = "./uploads/submissions/class".$disciplina->disciplina_id."/work".$trabalho['trabalho_id']."/workteam".$id_grupo."/";
            $config['allowed_types'] = 'zip|rar';
            $config['max_size'] = '10000';
            $config['overwrite'] = TRUE;

            $this->load->library('upload', $config);
            $field_name = "file";

            if (!$this->upload->do_upload($field_name)) {
                $data['message'] = $this->upload->display_errors();
                $this->load->view('include/header');
                $this->load->view('include/navbar');
                $this->load->view("submissao/form", $data);
                $this->load->view('include/footer');          
            } 

            else {
                $file = $this->upload->data();
                $timeStamp = str_replace(array("-",":"," "), "", unix_to_human(time(), TRUE, "eu"));
                rename($file['file_path'].$file['file_name'], $file['file_path'].$trabalho['trabalho_id']."-".$id_grupo."-".$timeStamp.$file['file_ext']);   
                $data['messagem'] = $this->submissao_model->inserir($disciplina->disciplina_id, $file['file_name'], $trabalho['trabalho_id'], $id_grupo, $timeStamp);
                if(empty($data['messagem'])) {
                    $this->session->set_flashdata('message', 'The Submission was successfully saved');
                    redirect(base_url()."index.php/grupo/show/".$id_grupo);  
                }
                else {                    
                    $this->load->view('include/header');
                    $this->load->view('include/navbar');
                    $this->load->view("submissao/form", $data);
                    $this->load->view('include/footer'); 
                }                         
            } 
        }
    }

    public function download() {
        $this->load->model('download_model');
        $this->load->model("submissao_model");
        $id_submissao = $this->uri->segment(3);

        $sub = $this->submissao_model->getSubmissao($id_submissao);
        $this->download_model->push_file($sub['url'], $sub['nome']);
    }

    public function downloadLatest() {
        $this->load->model('download_model');
        $this->load->model("submissao_model");
        $this->load->model("trabalho_model");
        $this->load->library('zip');
        $this->load->helper('recursive_helper');
        $id_trabalho = $this->uri->segment(3);

        $this->submissao_model->downloadLatest($id_trabalho);
    }

    public function delete() {
        $id_grupo = $this->uri->segment(3);        
        $id_submissao = $this->uri->segment(4);
        $this->load->model('submissao_model');
        $this->submissao_model->apagar($id_submissao);
        $this->session->set_flashdata('message', 'The Submission was successfully deleted');
        redirect(base_url()."index.php/submissao", "refresh");
    }    
}