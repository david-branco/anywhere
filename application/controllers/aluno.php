<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aluno extends CI_Controller {

    public function index() {
        $this->load->model("aluno_model");
        $data['results'] = $this->aluno_model->getAlunos();
        $data['title'] = "Student";
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("aluno/index", $data);
        $this->load->view('include/footer');
    }

    public function profile() {
        $id = $this->uri->segment(3);
        $this->load->model("aluno_model");
        $this->load->model("docente_model");
        $this->load->model("trabalho_model");
        $data['aluno'] = $this->aluno_model->getAluno($id);
        $data['disciplinas'] = $this->aluno_model->getDisciplinasFromAluno($id);
        $data['temas'] = $this->aluno_model->getTemasFromAluno($id);
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("aluno/profile", $data);
        $data['title'] = "";
        $data['receiver'] = "aluno";
        $data['id'] = $id;
        $this->load->view('contacto/email', $data);
        $this->load->view('include/footer');
    }

    public function show() {
        $id = $this->uri->segment(3);
        $this->load->model("aluno_model");
        $this->load->model("trabalho_model");
        $this->load->model("docente_model");
        $data = $this->aluno_model->getAluno($id);
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("aluno/show", $data);
        $data['results'] = $this->aluno_model->getDisciplinasFromAluno($id);
        $data['title'] = "Classes List";
        $this->load->view("disciplina/showList", $data);
        $data['title'] = "Works List";
        $data['results'] = $this->aluno_model->getTrabalhosFromAluno($id);
        $this->load->view("trabalho/showList", $data);
        $this->load->view('include/footer');
    }

    public function showList() {
        $id = $this->uri->segment(3);
        $this->load->model('docente_model');
        $data['results'] = $this->docente_model->getAlunosFromDocente($id);
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $data['title'] = "";
        $this->load->view('aluno/showList',$data);
        $this->load->view('include/footer');
    }

    public function quickRegister() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("email", "Email", "required|valid_email|email_unico[Aluno.email]|xss_clean");
        $this->form_validation->set_rules("password", "Password", "min_length[4]|max_length[12]|required|xss_clean");
        $this->form_validation->set_rules("confpassword", "Password confirmation", "matches[password]|required|[xss_clean");
        $this->form_validation->set_rules("token", "Class Registration Token", "token_valido|required|xss_clean");

        $this->load->model("aluno_model");
        $this->load->model("disciplina_model");
        $data['email'] = ""; 
        $data['title'] = "Student Registration";

        if($this->form_validation->run() == FALSE) {            
            $this->load->view('include/header');
            $this->load->view('include/navbarLogin.html');
            $this->load->view("aluno/quickRegister", $data);
            $this->load->view('include/footer');
        }

        else {
            $id = $this->aluno_model->registoRapido();
            $data = $this->disciplina_model->getDisciplinaByToken(set_value("token"));
            $this->disciplina_model->inserirAlunoEmDisciplina($id, $data['disciplina_id']);
            $data = $this->aluno_model->getAluno($id);
            $data['aluno_id'] = $id;
            $data['title'] = "Student Registration";
            $data['message'] = "";
            $this->session->set_userdata( 
                array(
                'id'=>$id,
                'email'=>$_REQUEST['email'],
                'logged' => TRUE,
                'type'=>"S"
                )
            );
            $this->session->set_flashdata('message', 'So far so good. Please fulfil the additional information'); 
            redirect(base_url()."index.php/aluno/register/".$id);
        }
    }

    public function register() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("nome", "Full Name", "letras_espacos|required|xss_clean");
        $this->form_validation->set_rules("naluno", "Student Number", "alpha_numeric|required|xss_clean");
        $this->form_validation->set_rules("website", "Website", "valid_url|xss_clean");
        $this->form_validation->set_rules("curso", "Course", "alfanumericos_hifen_espacos|required|xss_clean");
        $this->form_validation->set_rules("instituicao", "Institution", "alfanumericos_hifen_espacos|required|xss_clean");
        $this->form_validation->set_rules("sobre", "About", "xss_clean");
        $this->form_validation->set_rules("estatuto", "Status", "xss_clean");

        $this->load->model("aluno_model");
        $id = $this->uri->segment(3);        
        $data = $this->aluno_model->getAluno($id);
        $data['title'] = "Student Registration";

        if($this->form_validation->run() == FALSE) {   
            $data['message'] = "";         
            $this->load->view('include/header');
            $this->load->view('include/navbarLogin.html');
            $this->load->view("aluno/register", $data);
            $this->load->view('include/footer');
        }

        else {
            if(isset($_FILES['foto']) && $_FILES['foto']['size'] > 0) {

                $config['upload_path'] = './uploads/photos/student/';               
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '100';
                $config['max_width']  = '1024';
                $config['max_height']  = '768';
                $config['overwrite'] = TRUE;
                $config['file_name'] = "studentphoto".$id.".jpg";

                $this->load->library('upload', $config);
                $field_name = "foto";

                if (!$this->upload->do_upload($field_name)) {
                    $data['message'] = $this->upload->display_errors();
                    $this->load->view('include/header');
                    $this->load->view('include/navbarLogin.html');
                    $this->load->view('aluno/register', $data);
                    $this->load->view('include/footer');            
                }
            } 

            $this->aluno_model->registo($id);
            $this->session->set_flashdata('message', 'Welcome student');
            $this->session->set_userdata( 
                array(
                    'name'=>$_REQUEST['nome']
                )
            );
            redirect(base_url()."index.php/frontend/aluno");         
        }
    }

    public function form() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("nome", "Full Name", "letras_espacos|required|xss_clean");
        $this->form_validation->set_rules("password", "Password", "min_length[4]|max_length[12]|required|xss_clean");
        $this->form_validation->set_rules("confpassword", "Password confirmation", "matches[password]|required|[xss_clean");
        $this->form_validation->set_rules("naluno", "Student Number", "alpha_numeric|required|xss_clean");
        $this->form_validation->set_rules("email", "Email", "required|valid_email|email_unico[Aluno.email]|xss_clean");
        $this->form_validation->set_rules("website", "Website", "valid_url|xss_clean");
        $this->form_validation->set_rules("curso", "Course", "alfanumericos_hifen_espacos|required|xss_clean");
        $this->form_validation->set_rules("instituicao", "Institution", "alfanumericos_hifen_espacos|required|xss_clean");
        $this->form_validation->set_rules("sobre", "About", "xss_clean");
        $this->form_validation->set_rules("estatuto", "Status", "xss_clean");

        $this->load->model("aluno_model");
        $this->load->model("disciplina_model");
        $id_aluno = $this->uri->segment(3);        
        $data = $this->aluno_model->getAluno($id_aluno);
        $data['title'] = "Student";
        $data['disciplina_id'] = "";        

        if ($id_aluno == FALSE) {
            $data['aluno_id'] = "";
            $data['password'] = "";
            $data['nome'] = "";  
            $data['naluno'] = "";  
            $data['email'] = "";   
            $data['curso'] = "";
            $data['website'] = ""; 
            $data['instituicao'] = "";
            $data['estatuto'] = 1;
            $data['foto'] = "";
            $data['sobre'] = "";
        }

        if($this->form_validation->run() == FALSE) {  
            $data['message'] = "";          
            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view("aluno/form", $data);
            $this->load->view('include/footer');
        }

        else {
            if(isset($_FILES['foto']) && $_FILES['foto']['size'] > 0) {

                $config['upload_path'] = './uploads/photos/student/'; 
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '100';
                $config['max_width']  = '1024';
                $config['max_height']  = '768';
                $config['overwrite'] = TRUE;
                $config['file_name'] = "studentphoto".$id_aluno.".jpg";

                $this->load->library('upload', $config);
                $field_name = "foto";

                if (!$this->upload->do_upload($field_name)) {
                    $data['message'] = $this->upload->display_errors();
                    $this->load->view('include/header');
                    $this->load->view('include/navbar');
                    $this->load->view('aluno/form', $data);
                    $this->load->view('include/footer');            
                } 
            }          
            if ($id_aluno == FALSE) { $id_aluno = $this->aluno_model->inserir(); }
            else { $this->aluno_model->atualizar($id_aluno); }
            $this->session->set_flashdata('message', 'The Student was successfully saved');               
            redirect(base_url()."index.php/aluno/profile/".$id_aluno);           
        }
    }

    public function evaluate() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("avaliacao", "evaluation", "xss_clean");

        $this->load->model("aluno_model");
        $this->load->model("trabalho_model");
        $data['title'] = "Evaluation";
        $data['id_aluno'] = $this->uri->segment(3);
        $data['id_trabalho'] = $this->uri->segment(4);

        if($this->form_validation->run() == FALSE) {        
            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view("aluno/evaluate", $data);
            $this->load->view('include/footer');
        }

        else {
            $this->aluno_model->avaliar($data['id_aluno'], $data['id_trabalho']);
            $this->session->set_flashdata('message', 'The Work Member was successfully evaluated');   
            $grupo = $this->trabalho_model->getGrupoFromAlunoFromTrabalho($data['id_aluno'], $data['id_trabalho']);
            redirect(base_url()."index.php/grupo/show/".$grupo['grupo_id']); 
        }
    }

    public function delete() {
        $id_aluno = $this->uri->segment(3);        

        $this->load->model('aluno_model');
        $this->aluno_model->apagar($id_aluno);
        $this->session->set_flashdata('message', 'The Student was successfully deleted');
        redirect(base_url()."index.php/aluno", "refresh");
    }   
}
