<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacto extends CI_Controller { 

    public function email() {
    	$entidade = $this->uri->segment(3);
    	$id = $this->uri->segment(4);

        $this->load->library("form_validation");
        $this->form_validation->set_rules("nome", "Name", "letras_espacos|required|xss_clean");
        $this->form_validation->set_rules("email", "Email", "required|valid_email|xss_clean");
        $this->form_validation->set_rules("assunto", "Subject", "required|xss_clean");
        $this->form_validation->set_rules("mensagem", "Message", "required|xss_clean");
        $data['message'] = "";
        $data['title'] = "Send Email";

        if($this->form_validation->run() == FALSE) {            
            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view('contacto/email', $data);
            $this->load->view('include/footer');
        }

        else {
        	if ($entidade == "docente") {
        		$this->load->model("docente_model");
        		$destinatario = $this->docente_model->getDocente($id);
        	}
        	else {
        		$this->load->model("aluno_model");
        		$destinatario = $this->aluno_model->getAluno($id);
        	}
            $this->load->library("email");
            $this->email->set_newline("\r\n");
            $this->email->from(set_value("email"), utf8_decode(set_value("nome")));
            //$this->email->to("el2014pi@gmail.com");
            $this->email->to($destinatario['email']);
            $this->email->subject(utf8_decode(set_value("assunto")));
            $this->email->message(utf8_decode(set_value("mensagem")));
            $this->email->send();         
            
            $this->session->set_flashdata('message', 'The email was successfully sent');
            redirect(base_url()."index.php/$entidade/profile/$id", "refresh");
        }
    }

    public function convites() {
        $id_disciplina = $this->uri->segment(3);
        $this->load->library("form_validation");
        $this->form_validation->set_rules("emails", "Emails List", "required|valid_emails[emails]|xss_clean");

        $data['title'] = "Send invitations to a Class";
        $data['id_disciplina'] = $id_disciplina;

        if($this->form_validation->run() == FALSE) {            
            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view('contacto/invite', $data);
            $this->load->view('include/footer');
        }

        else {
            $this->load->model("docente_model");
            $this->load->model("disciplina_model");
            $this->load->library("email");

            $docente = $this->docente_model->getDocente($this->session->userdata('id'));
            $disciplina = $this->disciplina_model->getDisciplina($id_disciplina);

            $this->email->set_newline("\r\n");
            $emails = explode(",",set_value('emails'));
            $assunto = "An invitation to a Class";
            $mensagem = "Hi, <br/>The teacher <a href=\"http://localhost/pi/index.php/docente/profile/".$docente['docente_id']."\">".$docente['nome']."</a> 
                        sent you an invitation to the class <a href=\"http://localhost/pi/index.php/disciplina/profile/".$disciplina['disciplina_id']."\">".$disciplina['nome'].
                        "</a> from <a href=\"http://localhost/pi/\">Anywhere</a>. "
                        ."<br/><br/><b>If you want to enroll in that class use the following registration token: </b>".$disciplina['token'].".<br/><br/>"
                        ."If you do not know to which refers to this email, please ignore it.";

            $this->email->from("el2014pi@gmail.com", "Anywhere");
            $this->email->to($emails);
            $this->email->subject(utf8_decode($assunto));
            $this->email->message(utf8_decode($mensagem));
            $this->email->send();         
            $this->session->set_flashdata('message', 'The email was successfully sent');
            redirect(base_url()."index.php/disciplina/show/$id_disciplina", "refresh");           
        }
    }

    public function emailDocentes() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("nome", "Name", "letras_espacos|required|xss_clean");
        $this->form_validation->set_rules("email", "Email", "required|valid_email|xss_clean");
        $this->form_validation->set_rules("assunto", "Subject", "required|xss_clean");
        $this->form_validation->set_rules("mensagem", "Message", "required|xss_clean");

        $data['id_trabalho'] = $this->uri->segment(3);
        $data['message'] = "";
        $data['title'] = "Send Email";

        if($this->form_validation->run() == FALSE) {
            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view('contacto/emailDocentes', $data);
            $this->load->view('include/footer');
        }

        else {
            $this->load->model("trabalho_model");
            $docentes = $this->trabalho_model->getDocentesFromTrabalho($data['id_trabalho']);

            $emails = array();
            foreach($docentes as $docente) {
                array_push($emails, $docente->email);
            }

            $this->load->library("email");
            $this->email->set_newline("\r\n");
            $this->email->from(set_value("email"), utf8_decode(set_value("nome")));
            $this->email->to(array_shift($emails));
            $this->email->cc($emails);
            $this->email->subject(utf8_decode(set_value("assunto")));
            $this->email->message(utf8_decode(set_value("mensagem")));
            $this->email->send();         
            
            $this->session->set_flashdata('message', 'The email was successfully sent');
            redirect(base_url()."index.php/trabalho/profile/".$data['id_trabalho'], "refresh");
        }
    }

    public function emailDisciplina() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("assunto", "Subject", "required|xss_clean");
        $this->form_validation->set_rules("mensagem", "Message", "required|xss_clean");

        $data['id_disciplina'] = $this->uri->segment(3);
        $data['message'] = "";
        $data['title'] = "Send Email";

        if($this->form_validation->run() == FALSE) {
            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view('contacto/emailDisciplina', $data);
            $this->load->view('include/footer');
        }

        else {
            $this->load->model("disciplina_model");
            $this->load->model("docente_model");
            $alunos = $this->disciplina_model->getAlunosFromDisciplina($data['id_disciplina']);
            $docente = $this->docente_model->getDocente($this->session->userdata('id'));

            $emails = array();
            foreach($alunos as $aluno) {
                array_push($emails, $aluno->email);
            }

            $this->load->library("email");
            $this->email->set_newline("\r\n");
            $this->email->from($docente['email'], utf8_decode($docente['nome']));
            $this->email->to($emails);
            $this->email->subject(utf8_decode(set_value("assunto")));
            $this->email->message(utf8_decode(set_value("mensagem")));
            $this->email->send();         
            
            $this->session->set_flashdata('message', 'The email was successfully sent');
            redirect(base_url()."index.php/disciplina/show/".$data['id_disciplina'], "refresh");
        }
    }  
}
