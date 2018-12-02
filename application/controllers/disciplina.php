<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Disciplina extends CI_Controller {

    public function index() {
        $this->load->model("disciplina_model");
        $data['results'] = $this->disciplina_model->getDisciplinas();
        $data['title'] = "Classes List";
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("disciplina/index", $data);
        $this->load->view('include/footer');
    }

    public function profile() {
        $id = $this->uri->segment(3);
        $this->load->model("disciplina_model");
        $data['disciplina'] = $this->disciplina_model->getDisciplina($id);
        $data['works'] = $this->disciplina_model->getTrabalhosFromDisciplina($id);
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("disciplina/profile", $data);
        $this->load->view('include/footer');
    }

    public function show() {
        $id = $this->uri->segment(3);        
        $this->load->model("disciplina_model");
        $this->load->model("trabalho_model");
        $this->load->model("docente_model");
        $this->load->model("aluno_model");
        $data = $this->disciplina_model->getDisciplina($id);
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("disciplina/show", $data); 
        $data['title'] = "Teachers list";
        $data['results'] = $this->disciplina_model->getDocentesFromDisciplina($id);
        $this->load->view("docente/showList", $data);       
        $data['title'] = "Works List";
        $data['results'] = $this->disciplina_model->getTrabalhosFromDisciplina($id);
        $this->load->view("trabalho/showList", $data);
        $data['title'] = "Students list";
        $data['results'] = $this->disciplina_model->getAlunosFromDisciplina($id);
        $this->load->view("aluno/showList", $data);
        $data['title'] = "";
        $this->load->view('include/footer');
    }

    public function showList() {        
        $id = $this->uri->segment(3);
        $this->load->view('include/header');
        $this->load->view('include/navbar');

        if ($this->session->userdata('type') == 'T') {
            $this->load->model("docente_model");
            $data['results'] = $this->docente_model->getAtiveorDisableDisciplinasFromDocente($id, 1);
        }
        else {
            $this->load->model("aluno_model");
            $data['results'] = $this->aluno_model->getAtiveorDisableDisciplinasFromAluno($id, 1);
        }
        $data['title'] = "Active Classes List";
        $this->load->view("disciplina/showList", $data);

        if ($this->session->userdata('type') == 'T') { $data['results'] = $this->docente_model->getAtiveorDisableDisciplinasFromDocente($id, 0); }
        else { $data['results'] = $this->aluno_model->getAtiveorDisableDisciplinasFromAluno($id, 0); }
        $data['title'] = "Disabled Classes List";
        $this->load->view("disciplina/showList", $data);
        $this->load->view('include/footer');
    }

    public function active_disable() {
        $id_disciplina = $this->uri->segment(3);
        if($this->session->userdata('type') == 'T') {
            $this->load->model("docente_model");
            $this->docente_model->active_disableDisciplinaFromDocente($id_disciplina);
        }
        if($this->session->userdata('type') == 'S') {
            $this->load->model("aluno_model");
            $this->aluno_model->active_disableDisciplinaFromAluno($id_disciplina);
        }
        redirect(base_url()."index.php/disciplina/showList/".$this->session->userdata('id'));
    }

    public function enroll() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("token", "Class Token", "token_valido|required|xss_clean");

        $this->load->model("disciplina_model");
        $this->load->model("aluno_model");
        $this->load->model("docente_model");
        $data['title'] = "Enroll in a Class";
        $data['id_user'] = "";
        $data['tipo_user'] = $this->uri->segment(3);
        $tipo_user = $this->uri->segment(3); 

        if($this->form_validation->run() == FALSE) {
            $data['message'] = "";          
            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view("disciplina/enroll", $data);
            $this->load->view('include/footer');
        }

        else {
            $disc = $this->disciplina_model->getDisciplinaByToken(set_value("token"));        
            if($this->session->userdata("type") == "A") { $id_user = $_POST['id_user']; }
            else { $id_user = $this->session->userdata("id"); }            

            if($this->session->userdata("type") == "S" || $tipo_user == "2") {
                if($this->aluno_model->isADisciplinaFromAluno($disc['disciplina_id'], $id_user)) {
                    $data['message'] = "The student is already enrolled in this class";  
                    $this->load->view('include/header');
                    $this->load->view('include/navbar');
                    $this->load->view("disciplina/enroll", $data);
                    $this->load->view('include/footer');
                }
                else {
                	if($tipo_user == FALSE) { $this->disciplina_model->inserirAlunoLogadoEmDisciplina($disc['disciplina_id']); }
                	else { $this->disciplina_model->inserirAlunoEmDisciplina($id_user, $disc['disciplina_id']); }
                    $this->session->set_flashdata('message', 'The Student was enrolled successfully');
                    redirect(base_url()."index.php/disciplina/show/".$disc['disciplina_id']);   
                }
            }
            else {
               if($this->docente_model->isADisciplinaFromDocente($disc['disciplina_id'], $id_user)) {
                    $data['message'] = "The teacher is already enrolled in this class";  
                    $this->load->view('include/header');
                    $this->load->view('include/navbar');
                    $this->load->view("disciplina/enroll", $data);
                    $this->load->view('include/footer');
                }
                else {
                    if($tipo_user == FALSE) { $this->disciplina_model->inserirDocenteLogadoEmDisciplina($disc['disciplina_id']); }
                    else { $this->disciplina_model->inserirDocenteEmDisciplina($id_user, $disc['disciplina_id']); } 
                    $this->session->set_flashdata('message', 'The Teacher was enrolled successfully');
                    redirect(base_url()."index.php/disciplina/show/".$disc['disciplina_id']);  
                } 
            }            
        }
    }

    public function unenroll() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("token", "Class Token", "token_valido|required|xss_clean");

        $this->load->model("disciplina_model");
        $this->load->model("aluno_model");
        $this->load->model("docente_model");
        $data['title'] = "Enroll in a Class";
        $data['id_user'] = "";
        $data['tipo_user'] = $this->uri->segment(3);
        $tipo_user = $this->uri->segment(3); 

        if($this->form_validation->run() == FALSE) {
            $data['message'] = "";          
            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view("disciplina/unenroll", $data);
            $this->load->view('include/footer');
        }

        else {
            $disc = $this->disciplina_model->getDisciplinaByToken(set_value("token"));        
            $id_user = $_POST['id_user'];            

            if($tipo_user == "2") {
                if(!$this->aluno_model->isADisciplinaFromAluno($disc['disciplina_id'], $id_user)) {
                    $data['message'] = "The student is not enrolled in this class";  
                    $this->load->view('include/header');
                    $this->load->view('include/navbar');
                    $this->load->view("disciplina/unenroll", $data);
                    $this->load->view('include/footer');
                }
                else {
                    $this->disciplina_model->removerAlunoDeDisciplina($id_user, $disc['disciplina_id']);
                    $this->session->set_flashdata('message', 'The Student was unenrolled successfully');
                    redirect(base_url()."index.php/disciplina/show/".$disc['disciplina_id']);   
                }
            }
            else {
               if(!$this->docente_model->isADisciplinaFromDocente($disc['disciplina_id'], $id_user)) {
                    $data['message'] = "The teacher is not enrolled in this class";  
                    $this->load->view('include/header');
                    $this->load->view('include/navbar');
                    $this->load->view("disciplina/unenroll", $data);
                    $this->load->view('include/footer');
                }
                else {
                    $this->disciplina_model->removerDocenteDeDisciplina($id_user, $disc['disciplina_id']);
                    $this->session->set_flashdata('message', 'The Teacher was unenrolled successfully');
                    redirect(base_url()."index.php/disciplina/show/".$disc['disciplina_id']);  
                } 
            }            
        }
    }

    public function form() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("nome", "Name", "alfanumericos_hifen_espacos|required|xss_clean");
        $this->form_validation->set_rules("coduc", "Class Code", "alfanumericos_hifen_espacos|required|xss_clean");
        $this->form_validation->set_rules("anoletivo", "Academic Year", "required|xss_clean");
        $this->form_validation->set_rules("curso", "Course", "alfanumericos_hifen_espacos|required|xss_clean");
        $this->form_validation->set_rules("instituicao", "Institution", "alfanumericos_hifen_espacos|required|xss_clean");

        $this->load->model("disciplina_model");
        $this->load->model("docente_model");
        $id = $this->uri->segment(3);        
        $data = $this->disciplina_model->getDisciplina($id);
        $data['title'] = "Class";
        $data['docente_id'] = "";

        if ($id == FALSE) {
            $data['disciplina_id'] = "";
            $data['nome'] = "";  
            $data['coduc'] = "";  
            $data['anoletivo'] = "";   
            $data['curso'] = ""; 
            $data['instituicao'] = "";
            $data['pauta'] = "";
        }

        if($this->form_validation->run() == FALSE) {         
            $this->load->view("include/header");
            $this->load->view('include/navbar');
            $this->load->view("disciplina/form", $data);
            $this->load->view("include/footer");
        }

        else {
            if ($id == FALSE) {
                if ($this->session->userdata('type') == 'A') {
                    $id_disciplina = $this->disciplina_model->inserir($_POST['docente']);  
                }
                else {
                    $id_disciplina = $this->disciplina_model->inserir($this->session->userdata("id"));  
                }
            }
            else {
                $this->disciplina_model->atualizar($id);
                $id_disciplina = $id;
            }
            $this->session->set_flashdata('message', 'The Class was successfully saved');
            redirect(base_url()."index.php/disciplina/show/".$id_disciplina);          
        }
    }

    public function pauta() {
        $this->load->model('disciplina_model');
        $this->load->model('trabalho_model');
        $this->load->model('grupo_model');

        $id_disciplina = $this->uri->segment(3);
        $data['disciplina'] = $this->disciplina_model->getDisciplina($id_disciplina);
        $data['trabalhos'] = $this->disciplina_model->getTrabalhosFromDisciplina($id_disciplina);
        $data['alunos'] = $this->disciplina_model->getSortedAlunosFromDisciplina($id_disciplina);

        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("disciplina/pauta", $data);
        $this->load->view('include/footer');
    }

    public function downloadPDF() {
        $this->load->model('disciplina_model');
        $this->load->model('trabalho_model');
        $this->load->model('grupo_model');
        $this->load->model('download_model');
        $this->load->helper('recursive_helper');

        $id_disciplina = $this->uri->segment(3);
        $this->disciplina_model->downloadPautaPDF($id_disciplina);
    }

    public function downloadXML() {
        $this->load->model('disciplina_model');
        $this->load->model('trabalho_model');
        $this->load->model('grupo_model');
        $this->load->model('download_model');
        $this->load->helper('recursive_helper');
        $this->load->helper('xml');

        $id_disciplina = $this->uri->segment(3);
        $this->disciplina_model->downloadPautaXML($id_disciplina);
    }

    public function uploadXML() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("file", "File", "xss_clean");

        $this->load->model('disciplina_model');
        $this->load->model('trabalho_model');
        $this->load->model('aluno_model');
        $data['id_disciplina'] = $this->uri->segment(3);
        $data['title'] = "Upload grades in XML"; 

        if($this->form_validation->run() == FALSE) {  
            $data['message'] = "";
            $data['messagedtd'] = "";          
            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view("disciplina/uploadXML", $data);
            $this->load->view('include/footer');
        }

        else {
            $config['upload_path'] = "./uploads/grades/class".$data['id_disciplina']."/";
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
                $this->load->view("disciplina/uploadXML", $data);
                $this->load->view('include/footer');
            } 
            else {
                $erros = $this->disciplina_model->importarPautaXML($data['id_disciplina']); 
                if(!empty($erros)) {                
                    $data['message'] = "";
                    $data['messagedtd'] = "The file has not passed the validation process, and the following erors emerged:</br>" .$erros;                  
                    $this->load->view('include/header');
                    $this->load->view('include/navbar');
                    $this->load->view("disciplina/uploadXML", $data);
                    $this->load->view('include/footer'); 
                }
                else {
                    $this->session->set_flashdata('message', 'The file was successfully saved');
                    redirect(base_url()."index.php/disciplina/pauta/".$data['id_disciplina']); 
                }
            }
        }
    }

    public function delete() {      
        $id_disciplina = $this->uri->segment(3);
        $this->load->model('disciplina_model');
        $this->load->model('trabalho_model');
        $this->load->model('ficheiro_model');
        $this->load->model('grupo_model');

        $this->disciplina_model->apagar($id_disciplina);
        $this->session->set_flashdata('message', 'The Class was successfully saved');
        redirect(base_url()."index.php/disciplina"); 
    }
}
