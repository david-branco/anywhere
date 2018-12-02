<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trabalho extends CI_Controller {

    public function index() {
        $this->load->model("trabalho_model");
        $data['results'] = $this->trabalho_model->getTrabalhos();
        $data['title'] = "Works List";
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("trabalho/index", $data);
        $this->load->view('include/footer');
    }

    public function profile() {
        $id = $this->uri->segment(3);
        $this->load->model("trabalho_model");
        $this->load->model("disciplina_model");
        $this->load->model("submissao_model");
        $data['trabalho'] = $this->trabalho_model->getTrabalho($id);
        $data['submissoes'] = $this->trabalho_model->getUltimasSubmissoesFromTrabalho($id);
        $data['disciplina'] = $this->trabalho_model->getDisciplinaFromTrabalho($id);
        $data['docentes'] = $this->disciplina_model->getDocentesFromDisciplina($data['disciplina']->disciplina_id);
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("trabalho/profile", $data);
        $trab = $this->trabalho_model->getTrabalho($id);
        if ($this->trabalho_model->showVisibilidade($trab['visibilidade']) == "Private" OR $this->trabalho_model->showVisibilidade($trab['visibilidade']) == "Protected" OR $trab['datarepositorio'] > date('Y-m-d H:i:s')) {
            $data['title'] = "";
            $data['receiver'] = "docente";
            $data['id_trabalho'] = $id;
            $this->load->view('contacto/emailDocentes', $data);
        }
        $this->load->view('include/footer');
    }

    public function show() {
        $id_trabalho = $this->uri->segment(3);
        $this->load->model("trabalho_model");
        $this->load->model("aluno_model");
        $this->load->model("grupo_model");
        $data = $this->trabalho_model->getTrabalho($id_trabalho);
        $data['disciplina_id'] = $this->trabalho_model->getDisciplinaIDFromTrabalho($id_trabalho);
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("trabalho/show", $data);
        $data['trabalho'] = $this->trabalho_model->getTrabalho($id_trabalho);
        $data['results'] = $this->trabalho_model->getGruposFromTrabalho($id_trabalho);
        $this->load->view("grupo/showList", $data);
        $data['results'] = $this->trabalho_model->getFicheirosFromTrabalho($id_trabalho);
        $data['title'] = "Files List";
        $this->load->view('ficheiro/showList',$data);
        $this->load->view('include/footer');
    }

    public function showList() {
        $id = $this->uri->segment(3);
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->model("trabalho_model");

        if ($this->session->userdata('type') == 'T') {
            $this->load->model("docente_model");
            $data['results'] = $this->docente_model->getAtiveorDisableTrabalhosFromDocente($id, 1);
        }
        else {
            $this->load->model("aluno_model");
            $data['results'] = $this->aluno_model->getAtiveorDisableTrabalhosFromAluno($id, 1);
        }
        $data['title'] = "Active Works List";
        $this->load->view("trabalho/showList", $data);

        if ($this->session->userdata('type') == 'T') { $data['results'] = $this->docente_model->getAtiveorDisableTrabalhosFromDocente($id, 0); }
        else { $data['results'] = $this->aluno_model->getAtiveorDisableTrabalhosFromAluno($id, 0); }
        $data['title'] = "Disabled Works List";
        $this->load->view("trabalho/showList", $data);
        $this->load->view('include/footer');
    }

    public function form() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("nome", "Name", "required|xss_clean");
        $this->form_validation->set_rules("tema", "Topic", "required|xss_clean");
        $this->form_validation->set_rules("datainicial", "Start Date", "required|xss_clean");
        $this->form_validation->set_rules("datafinal", "Final Date", "data_depois[datainicial]|required|xss_clean");
        $this->form_validation->set_rules("datagrupos", "Group Date", "data_depois[datainicial]|data_igual_antes[datafinal]xss_clean");
        $this->form_validation->set_rules("limitesubmissao", "Submisson Limit", "data_depois[datainicial]|xss_clean");
        $this->form_validation->set_rules("visibilidade", "Visibility", "required|xss_clean");
        $this->form_validation->set_rules("descricao", "Description", "xss_clean");
        $this->form_validation->set_rules("datarepositorio", "Repository Date", "data_depois[datainicial]|xss_clean");
        $this->form_validation->set_rules("atraso", "Delay", "xss_clean");
        $this->form_validation->set_rules("desconto", "Penalization", "numeric|xss_clean");
        $this->form_validation->set_rules("pesonota", "Importance", "valor_entre_0_e_100[pesonota]|xss_clean");
        $this->form_validation->set_rules("tipoavaliacao", "Evaluation Type", "dependencia1|dependencia2|dependencia3|xss_clean");
        $this->form_validation->set_rules("linguagem", "Language", "xss_clean");

        $this->load->model("trabalho_model");
        $this->load->model("docente_model");
        $this->load->model("disciplina_model");

        $id_trabalho = $this->uri->segment(4);              
        $data = $this->trabalho_model->getTrabalho($id_trabalho);
        $data['title'] = "Work";
        $data['disciplina_id'] = $this->uri->segment(3);
        $data['message'] = ""; 
        $ficheiros = array();

        if ($id_trabalho == FALSE) {
            $data['trabalho_id'] = "";
            $data['nome'] = "";  
            $data['datainicial'] = "";  
            $data['datafinal'] = "";   
            $data['visibilidade'] = "1";
            $data['descricao'] = ""; 
            $data['tema'] = "";
            $data['datagrupos'] = "";
            $data['datarepositorio'] = "";
            $data['limitesubmissao'] = "";
            $data['atraso'] = "";
            $data['desconto'] = "";            
            $data['pesonota'] = "";            
            $data['tipoavaliacao'] = "1";                       
            $data['trabalho'] = "";                       
        }

        if($this->form_validation->run() == FALSE) {                   
            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view("trabalho/form", $data);
            $this->load->view('include/footer');
        }

        else {
            $this->load->helper('recursive_helper');

            $i = 1;
            $in = true;

            if(!empty($_FILES['inputfile1']['name'])) {
                $config['upload_path'] = "./uploads/files/temp";
                remove_directory($config['upload_path']);
                mkdir($config['upload_path'], 0777, true);
                $config['allowed_types'] = '*';
                $config['max_size'] = '10000';
                $config['overwrite'] = TRUE;
                $config['file_name'] = "t1.in";

                $this->load->library('upload', $config);

                foreach($_FILES as $field => $file) {
                    if(!empty($_FILES[$field ]['name'])) {
                        if (!$this->upload->do_upload($field)) {
                            $data['message'] = $this->upload->display_errors();
                            $this->load->view('include/header');
                            $this->load->view('include/navbar');
                            $this->load->view("trabalho/form", $data);
                            $this->load->view('include/footer'); 
                            break;         
                        }
                        else {
                            $ficheiro = $this->upload->data();
                            array_push($ficheiros, array('file_name' => $ficheiro['file_name'], 'file_ext' => $ficheiro['file_ext']));
                            $in = !$in;
                            if($in) { $config['file_name'] = "t$i.in"; }
                            else { $config['file_name'] = "t$i.out"; $i++; }
                        }
                        $this->upload->initialize($config);
                    }
                }
            }

            if(empty($data['message'])) {
                if ($id_trabalho == FALSE) { 
                    $id_trabalho = $this->trabalho_model->inserir($ficheiros);      
                }
                else {
                    $this->trabalho_model->atualizar($data['disciplina_id'], $id_trabalho, $ficheiros);                
                }
                $this->session->set_flashdata('message', 'The Work was successfully saved');
                redirect(base_url()."index.php/trabalho/show/".$id_trabalho);
            }
        }
    }

    public function pauta() {
        $this->load->model('trabalho_model');
        $this->load->model('grupo_model');
        $this->load->model('disciplina_model');

        $id_trabalho = $this->uri->segment(3);
        $data['disciplina'] = $this->trabalho_model->getDisciplinaFromTrabalho($id_trabalho);
        $data['trabalho'] = $this->trabalho_model->getTrabalho($id_trabalho);
        $data['alunos'] = $this->disciplina_model->getSortedAlunosFromDisciplina($data['disciplina']->disciplina_id);

        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("trabalho/pauta", $data);
        $this->load->view('include/footer');
    }


    public function downloadPDF() {
        $this->load->model('trabalho_model');
        $this->load->model('disciplina_model');
        $this->load->model('grupo_model');
        $this->load->model('download_model');
        $this->load->helper('recursive_helper');

        $id_trabalho = $this->uri->segment(3);
        $this->trabalho_model->downloadPautaPDF($id_trabalho);
    }

    public function downloadXML() {
        $this->load->model('trabalho_model');
        $this->load->model('disciplina_model');
        $this->load->model('download_model');
        $this->load->model('grupo_model');
        $this->load->helper('recursive_helper');
        $this->load->helper('xml');

        $id_trabalho = $this->uri->segment(3);
        $this->trabalho_model->downloadPautaXML($id_trabalho);
    }

    public function uploadXML() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("file", "File", "xss_clean");

        $this->load->model('trabalho_model');
        $this->load->model('aluno_model');
        $data['id_trabalho'] = $this->uri->segment(3);
        $disciplina = $this->trabalho_model->getDisciplinaFromTrabalho($data['id_trabalho']);
        $data['title'] = "Upload grades in XML"; 

        if($this->form_validation->run() == FALSE) {  
            $data['message'] = "";
            $data['messagedtd'] = "";          
            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view("trabalho/uploadXML", $data);
            $this->load->view('include/footer');
        }

        else {
            $config['upload_path'] = "./uploads/grades/class".$disciplina->disciplina_id."/work".$data['id_trabalho']."/";
            $config['allowed_types'] = 'xml';
            $config['max_size'] = '10000';
            $config['overwrite'] = TRUE;
            $config['file_name'] = "grade.xml";

            $this->load->library('upload', $config);
            $field_name = "file";

            if (!$this->upload->do_upload($field_name)) {
                $data['message'] = $this->upload->display_errors();
                $data['messagedtd'] = "";
                $this->load->view('include/header');
                $this->load->view('include/navbar');
                $this->load->view("trabalho/uploadXML", $data);
                $this->load->view('include/footer');
            } 
            else {
                $erros = $this->trabalho_model->importarPautaXML($disciplina->disciplina_id , $data['id_trabalho']); 
                if(!empty($erros)) {                
					$data['message'] = "";
                	$data['messagedtd'] = "The file has not passed the validation process, and the following erors emerged:</br>" .$erros;	                
	                $this->load->view('include/header');
	                $this->load->view('include/navbar');
	                $this->load->view("trabalho/uploadXML", $data);
	                $this->load->view('include/footer'); 
                }
                else {
	                $this->session->set_flashdata('message', 'The file was successfully saved');
	                redirect(base_url()."index.php/trabalho/pauta/".$data['id_trabalho']); 
                }
            }
        }
    }

    public function delete() {      
        $id_trabalho = $this->uri->segment(3);
        $this->load->model('trabalho_model');
        $this->load->model('ficheiro_model');
        $this->load->model('grupo_model');

        $this->trabalho_model->apagar($id_trabalho, TRUE);
        $this->session->set_flashdata('message', 'The Work was successfully deleted');
        redirect(base_url()."index.php/trabalho", "refresh");
    }
}

