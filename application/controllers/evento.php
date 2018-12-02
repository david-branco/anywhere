<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evento extends CI_Controller {

	public function showList() {

		$id = $this->session->userdata('id');
		$this->load->model("trabalho_model");
		$this->load->view('include/header');
        $this->load->view('include/navbar');

		if($this->session->userdata('type') == "T") {
			$this->load->model("docente_model");
			$data['pessoais'] = $this->docente_model->getEventosPassouFutFromDocente($id, ">");
			$data['disciplinas'] = $this->docente_model->getEventosPassouFutFromDisciplinasAtivasFromDocente($id, ">");
			$data['trabalhos'] = $this->docente_model->getDatasFinaisPassOuFutFromTrabalhosFromDocente($id, ">");
		}
		else {
			$this->load->model("aluno_model");
			$data['pessoais'] = $this->aluno_model->getEventosPassouFutFromAluno($id, ">");
			$data['disciplinas'] = $this->aluno_model->getEventosPassouFutFromDisciplinasAtivasFromAluno($id, ">");
			$data['trabalhos'] = $this->aluno_model->getDatasFinaisPassOuFutFromTrabalhosFromAluno($id, ">");
		}

		$data['title'] = "Next Events";
        $this->load->view("evento/showList", $data);

        if($this->session->userdata('type') == "T") {
			$data['pessoais'] = $this->docente_model->getEventosPassouFutFromDocente($id, "<");
			$data['disciplinas'] = $this->docente_model->getEventosPassouFutFromDisciplinasAtivasFromDocente($id, "<");
			$data['trabalhos'] = $this->docente_model->getDatasFinaisPassOuFutFromTrabalhosFromDocente($id, "<");
		}
		else {
			$data['pessoais'] = $this->aluno_model->getEventosPassouFutFromAluno($id, "<");
			$data['disciplinas'] = $this->aluno_model->getEventosPassouFutFromDisciplinasAtivasFromAluno($id, "<");
			$data['trabalhos'] = $this->aluno_model->getDatasFinaisPassOuFutFromTrabalhosFromAluno($id, "<");
		}

		$data['title'] = "Past Events";
		$this->load->view("evento/showList", $data);
        $this->load->view('include/footer');
	}

	public function formPersonalString() {

        $arr = explode("at", $_REQUEST['string']);
        $dates = explode("on", $arr[1]);
        $hours = explode(":", $dates[0]);
        $days = explode("/", $dates[1]);
        $hour = (int)$hours[0];
        $min = (int)$hours[1];
        $month = (int)$days[1];
        $year = (int)$days[2];
        $day = (int)$days[0];
        $date = date("Y-m-d H:i:s", mktime($hour,$min,0,$month,$day,$year));
        $evento = trim($arr[0]);

        if($this->session->userdata('type') == 'T') {
            $this->load->model("docente_model");
            $this->docente_model->inserirEvento($date, $evento);
            redirect(base_url()."index.php/frontend/docente");
        } else if($this->session->userdata('type') == 'S') {
            $this->load->model("aluno_model");
            $this->aluno_model->inserirEvento($date, $evento);
            redirect(base_url()."index.php/frontend/aluno");
        }

    }

    public function formPersonal() {

        $this->load->library("form_validation");
        $this->form_validation->set_rules("evento", "Event", "required|xss_clean");
        $this->form_validation->set_rules("dataEvento", "Date", "required|xss_clean");

        $this->load->model("evento_model");
        $id_evento = $this->uri->segment(3);
        $data = $this->evento_model->getEvento($id_evento);
        $data['title'] = "Event";
        $data['id_evento'] = $this->uri->segment(3);

        if($id_evento == FALSE) {
        	$data['evento'] = "";
        	$data['dataEvento'] = "";
        }

        if($this->form_validation->run() == FALSE) {        
            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view("evento/formPersonal", $data);
            $this->load->view('include/footer');
        }

        else {
        	if($this->session->userdata('type') == 'T') {
        		$this->load->model("docente_model");
        		if($id_evento == FALSE) { $this->docente_model->inserirEvento(set_value("dataEvento"), set_value("evento")); }
        		else { $this->docente_model->atualizarEvento(set_value("dataEvento"), set_value("evento"), $id_evento); }
        	}
        	else {
        		if($this->session->userdata('type') == 'S') {
	        		$this->load->model("aluno_model");
	        		if($id_evento == FALSE) { $this->aluno_model->inserirEvento(set_value("dataEvento"), set_value("evento")); }
        			else { $this->aluno_model->atualizarEvento(set_value("dataEvento"), set_value("evento"), $id_evento); }
        		}
        	}
            $this->session->set_flashdata('message', 'The Event was successfully saved');   
            redirect(base_url()."index.php/evento/showList");         
        }
    }

    public function formClassString() {

        $arr = explode("at", $_REQUEST['string']);
        $dates = explode("on", $arr[1]);
        $hours = explode(":", $dates[0]);
        $days = explode("/", $dates[1]);
        $hour = (int)$hours[0];
        $min = (int)$hours[1];
        $month = (int)$days[1];
        $year = (int)$days[2];
        $day = (int)$days[0];
        $date = date("Y-m-d H:i:s", mktime($hour,$min,0,$month,$day,$year));
        $evento = trim($arr[0]);
        $id = $this->uri->segment(3);

        $this->load->model("disciplina_model");
        $this->disciplina_model->inserirEvento($date, $evento, $id);
        redirect(base_url()."index.php/frontend/docente");      

    }

    public function formClass() {
        
        $this->load->library("form_validation");
        $this->form_validation->set_rules("evento", "Event", "required|xss_clean");
        $this->form_validation->set_rules("dataEvento", "Date", "required|xss_clean");

        $this->load->model("evento_model");
        $this->load->model("disciplina_model");
        $data = $this->evento_model->getEvento($this->uri->segment(4));
        $data['title'] = "Event";
        $data['id_disciplina'] = $this->uri->segment(3);
        $data['id_evento'] = $this->uri->segment(4);

        if( $data['id_evento'] == FALSE) {
        	$data['evento'] = "";
        	$data['dataEvento'] = "";
        }

        if($this->form_validation->run() == FALSE) {        
            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view("evento/formClass", $data);
            $this->load->view('include/footer');
        }

        else {       		
    		if( $data['id_evento'] == FALSE) { $this->disciplina_model->inserirEvento(set_value("dataEvento"), set_value("evento"), $data['id_disciplina']); }
    		else { $this->disciplina_model->atualizarEvento(set_value("dataEvento"), set_value("evento"),  $data['id_evento']); }

            $this->session->set_flashdata('message', 'The Event was successfully saved');   
            redirect(base_url()."index.php/evento/showList");         
        }
    }

}
