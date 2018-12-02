<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Docente extends CI_Controller {

    public function index() {
        $this->load->model("docente_model");
        $data['results'] = $this->docente_model->getDocentes();
        $data['title'] = "Teachers List";
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("docente/index", $data);
        $this->load->view('include/footer');
    }

    public function profile() {
        $this->load->model("docente_model");
        $this->load->model("aluno_model");
        $id = $this->uri->segment(3);
        $data['docente'] = $this->docente_model->getDocente($id);
        $data['temas'] = $this->docente_model->getTemasFromDocente($id);
        $data['disciplinas'] = $this->docente_model->getDisciplinasFromDocente($id);
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("docente/profile", $data);
        if(!$this->session->userdata('logged')|| $this->session->userdata('id') != $id) {
            $data['title'] = "";
            $data['receiver'] = "docente";
            $data['id'] = $id;
            $this->load->view('contacto/email', $data);
        }
        $this->load->view('include/footer');
    }

    public function show() {
        $id = $this->uri->segment(3);
        $this->load->model("docente_model");
        $this->load->model("aluno_model");
        $this->load->model("trabalho_model");
        $data = $this->docente_model->getDocente($id);
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("docente/show", $data);
        $data['title'] = "Classes List";
        $data['results'] = $this->docente_model->getDisciplinasFromDocente($id);
        $this->load->view("disciplina/showList", $data);
        $data['title'] = "Works List";
        $data['results'] = $this->docente_model->getTrabalhosFromDocente($id);
        $this->load->view("trabalho/showList", $data);
        $this->load->view('include/footer');
    }

    public function showList() {
        $id = $this->uri->segment(3);
        $this->load->model('disciplina_model');
        $data['results'] = $this->disciplina_model->getDocentesFromDisciplina($id);
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $data['title'] = "Teachers List";
        $this->load->view('docente/showList',$data);
        $this->load->view('include/footer');
    }

    public function showAlunos() {
        $id = $this->uri->segment(3);
        $this->load->model("docente_model");
        $this->load->model("disciplina_model");
        $data['title'] = "Students List";
        $data['results'] = $this->docente_model->getDisciplinasFromDocente($id);
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view("docente/showAlunos", $data);
        $this->load->view('include/footer');
    }

    public function quickRegister() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("email", "Email", "required|valid_email|email_unico[Docente.email]|xss_clean");
        $this->form_validation->set_rules("password", "Password", "min_length[4]|max_length[12]|required|xss_clean");
        $this->form_validation->set_rules("confpassword", "Password confirmation", "matches[password]|required|[xss_clean");

        $this->load->model("docente_model");
        $data['email'] = ""; 
        $data['title'] = "Teacher Registration";

        if($this->form_validation->run() == FALSE) {            
            $this->load->view('include/header');
            $this->load->view('include/navbarLogin.html');
            $this->load->view("docente/quickRegister", $data);
            $this->load->view('include/footer');
        }

        else {
            $id = $this->docente_model->registoRapido();
            $data = $this->docente_model->getDocente($id);
            $data['docente_id'] = $id;
            $data['title'] = "Teacher Registration";
            $data['message'] = "";
            $this->session->set_userdata( 
                array(
                    'id'=>$id,
                    'email'=>$_REQUEST['email'],
                    'logged' => TRUE,
                    'type'=>"T"
                    )
                );
            $this->session->set_flashdata('message', 'So far so good. Please fulfil the additional information'); 
            redirect(base_url()."index.php/docente/register/".$id);
        }
    }

    public function register() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("nome", "Full Name", "letras_espacos|required|xss_clean");
        $this->form_validation->set_rules("ndocente", "Teacher Number", "alpha_numeric|required|xss_clean");
        $this->form_validation->set_rules("website", "Website", "valid_url|xss_clean");
        $this->form_validation->set_rules("cv", "CV", "xss_clean");
        $this->form_validation->set_rules("contatos", "Contacts", "xss_clean");
        $this->form_validation->set_rules("sobre", "About", "xss_clean");
        $this->form_validation->set_rules("myAcademia", "myAcademia Profile", "alpha_dash|xss_clean");

        $this->load->model("docente_model");
        $id = $this->uri->segment(3);        
        $data = $this->docente_model->getDocente($id);
        $data['title'] = "Teacher Registration";

        if($this->form_validation->run() == FALSE) { 
            $data['message'] = "";           
            $this->load->view('include/header');
            $this->load->view('include/navbarLogin.html');
            $this->load->view("docente/register", $data);
            $this->load->view('include/footer');
        }

        else {
            if(isset($_FILES['foto']) && $_FILES['foto']['size'] > 0) {

                $config['upload_path'] = './uploads/photos/teacher/';                
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '100';
                $config['max_width']  = '1024';
                $config['max_height']  = '768';
                $config['overwrite'] = TRUE;
                $config['file_name'] = "teacherphoto".$id.".jpg";

                $this->load->library('upload', $config);
                $field_name = "foto";

                if (!$this->upload->do_upload($field_name)) {
                    $data['message'] = $this->upload->display_errors();
                    $this->load->view('include/header');
                    $this->load->view('include/navbarLogin.html');
                    $this->load->view('docente/register', $data);
                    $this->load->view('include/footer');            
                } 
            }
              
            $this->docente_model->registo($id);
            $this->session->set_flashdata('message', 'Welcome Teacher');
            $this->session->set_userdata( 
                array(
                    'name'=>$_REQUEST['nome']
                    )
                );
            redirect(base_url()."index.php/frontend/docente");      
        }
    } 

    public function form() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("nome", "Full Name", "letras_espacos|required|xss_clean");
        $this->form_validation->set_rules("password", "Password", "min_length[4]|max_length[12]|required|xss_clean");
        $this->form_validation->set_rules("confpassword", "Password confirmation", "matches[password]|required|[xss_clean");
        $this->form_validation->set_rules("ndocente", "Teacher Number", "alpha_numeric|required|xss_clean");
        $this->form_validation->set_rules("email", "Email", "required|valid_email|email_unico[Docente.email]|xss_clean");
        $this->form_validation->set_rules("website", "Website", "valid_url|xss_clean");
        $this->form_validation->set_rules("cv", "CV", "xss_clean");
        $this->form_validation->set_rules("contatos", "Contacts", "xss_clean");
        $this->form_validation->set_rules("sobre", "About", "xss_clean");
        $this->form_validation->set_rules("myAcademia", "myAcademia Profile", "alpha_dash|xss_clean");

        $this->load->model("docente_model");
        $id_docente = $this->uri->segment(3);        
        $data = $this->docente_model->getDocente($id_docente);
        $data['title'] = "Teacher";

        if ($id_docente == FALSE) {
            $data['docente_id'] = "";
            $data['password'] = "";
            $data['nome'] = "";  
            $data['ndocente'] = "";  
            $data['email'] = "";   
            $data['website'] = ""; 
            $data['cv'] = "";
            $data['contatos'] = "";
            $data['foto'] = "";
            $data['myAcademia'] = "";
        }

        if($this->form_validation->run() == FALSE) {      
            $data['message'] = "";      
            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view("docente/form", $data);
            $this->load->view('include/footer');
        }

        else {
            if(isset($_FILES['foto']) && $_FILES['foto']['size'] > 0) {

                $config['upload_path'] = './uploads/photos/teacher/';                
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '100';
                $config['max_width']  = '1024';
                $config['max_height']  = '768';
                $config['overwrite'] = TRUE;
                $config['file_name'] = "teacherphoto".$id_docente.".jpg";

                $this->load->library('upload', $config);
                $field_name = "foto";

                if (!$this->upload->do_upload($field_name)) {
                    $data['message'] = $this->upload->display_errors();
                    $this->load->view('include/header');
                    $this->load->view('include/navbar');
                    $this->load->view('docente/form', $data);
                    $this->load->view('include/footer');            
                }
            } 

            if ($id_docente == FALSE) { $id_docente = $this->docente_model->inserir(); }
            else { $this->docente_model->atualizar($id_docente); }
            $this->session->set_flashdata('message', 'The Teacher was successfully saved');                
            redirect(base_url()."index.php/docente/profile/".$id_docente);           
        }
    }

    public function delete() {
	    $id_docente = $this->uri->segment(3);        

	    $this->load->model('docente_model');
	    $this->docente_model->apagar($id_docente);
	    $this->session->set_flashdata('message', 'The Teacher was successfully deleted');
	    redirect(base_url()."index.php/docente", "refresh");
	}     
}