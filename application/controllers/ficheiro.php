<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ficheiro extends CI_Controller {

    public function index() {
        $this->load->model("ficheiro_model");
        $data['results'] = $this->ficheiro_model->getFicheiros();
        $data['title'] = "Files List";
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("ficheiro/index", $data);
        $this->load->view('include/footer');
    }

    public function showList() {
        $id_trabalho = $this->uri->segment(3);
        $this->load->model("trabalho_model");
        $data['results'] = $this->trabalho_model->getFicheirosFromTrabalho($id_trabalho);
        $data['title'] = "Files List";
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('ficheiro/showList',$data);
        $this->load->view('include/footer');
    }

    public function form() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("file", "File", "xss_clean"); 
        $this->form_validation->set_rules("descricao", "Description", "descricao"); 

        $this->load->model("ficheiro_model");
        $this->load->model("trabalho_model");
        $data['id_trabalho'] = $this->uri->segment(3); 
        $data['id_ficheiro'] = $this->uri->segment(4); 
        $data['title'] = "File";

        if($data['id_ficheiro'] == FALSE) {
            $data['descricao'] = "";
        }
        else {
            $ficheiro = $this->ficheiro_model->getFicheiro($data['id_ficheiro']);
            $data['descricao'] = $ficheiro['descricao'];    
        }

        if($this->form_validation->run() == FALSE) {  
            $data['message'] = "";          
            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view("ficheiro/form", $data);
            $this->load->view('include/footer');
        }

        else {
            if(empty($data['id_trabalho'])) { $data['id_trabalho'] = $_POST['trabalho']; }
            $disciplina = $this->trabalho_model->getDisciplinaFromTrabalho($data['id_trabalho']);

            if(!$data['id_ficheiro']) {
                $config['upload_path'] = "./uploads/files/class".$disciplina->disciplina_id."/work".$data['id_trabalho']."/";
                $config['allowed_types'] = '*';
                $config['max_size'] = '10000';

                $this->load->library('upload', $config);
                $field_name = "file";

                if (!$this->upload->do_upload($field_name)) {
                    $data['message'] = $this->upload->display_errors();
                    $this->load->view('include/header');
                    $this->load->view('include/navbar');
                    $this->load->view("ficheiro/form", $data);
                    $this->load->view('include/footer');
                } 
                else { 
                    $this->ficheiro_model->inserir($disciplina->disciplina_id , $data['id_trabalho']);
                    $this->session->set_flashdata('message', 'The File was successfully saved');
                    redirect(base_url()."index.php/trabalho/show/".$data['id_trabalho']); 
                }               
            }
            else {
                if(!empty($_FILES['file']['name'])) {
                    $config['upload_path'] = "./uploads/files/class".$disciplina->disciplina_id."/work".$data['id_trabalho']."/";
                    $config['allowed_types'] = '*';
                    $config['max_size'] = '10000';

                    $this->load->library('upload', $config);
                    $field_name = "file";

                    if (!$this->upload->do_upload($field_name)) {
                        $data['message'] = $this->upload->display_errors();
                        $this->load->view('include/header');
                        $this->load->view('include/navbar');
                        $this->load->view("ficheiro/form", $data);
                        $this->load->view('include/footer');
                    }
                    else { $this->ficheiro_model->atualizar($disciplina->disciplina_id, $data['id_trabalho'], $data['id_ficheiro'], TRUE); }
                }
                else { $this->ficheiro_model->atualizar($disciplina->disciplina_id, $data['id_trabalho'], $data['id_ficheiro'], FALSE); }
                $this->session->set_flashdata('message', 'The File was successfully saved');
                redirect(base_url()."index.php/trabalho/show/".$data['id_trabalho']);        
            }
        }
    }  
     
    public function download() {
        $this->load->model('download_model');
        $this->load->model("ficheiro_model");
        $id_ficheiro = $this->uri->segment(3);

        $fich = $this->ficheiro_model->getFicheiro($id_ficheiro);
        $this->download_model->push_file($fich['url'], $fich['nome']);
    }  

    public function downloadAll() {
        $this->load->model('download_model');
        $this->load->model("ficheiro_model");
        $this->load->model("trabalho_model");
        $this->load->library('zip');
        $this->load->helper('recursive_helper');
        $id_trabalho = $this->uri->segment(3);

        $this->ficheiro_model->downloadAll($id_trabalho);
    }

    public function delete() {
        $id_trabalho = $this->uri->segment(3);        
        $id_ficheiro = $this->uri->segment(4);
        $this->load->model('ficheiro_model');
        $this->ficheiro_model->apagar($id_ficheiro,TRUE);
        $this->session->set_flashdata('message', 'The File was successfully deleted');
        if($this->session->userdata("type") == "T") { redirect(base_url()."index.php/trabalho/show/".$id_trabalho); }
        else { redirect(base_url()."index.php/ficheiro", "refresh"); } 
    }
}
