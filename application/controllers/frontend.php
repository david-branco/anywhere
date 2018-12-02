<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontend extends CI_Controller {

    function admin() {
        redirect(base_url()."index.php/admin/fileTree"); 
    }

    function docente() {
        $this->load->model('docente_model');
        $this->load->model('trabalho_model');
        $data['disciplinas'] = $this->docente_model->getAtiveorDisableDisciplinasFromDocente($this->session->userdata('id'), 1);
        $data['trabalhos'] = $this->docente_model->getAtiveorDisableTrabalhosFromDocente($this->session->userdata('id'), 1);
        $data['trab_eventos'] = $this->docente_model->getDatasFinaisFromDocente($this->session->userdata('id'));
        $data['pessoais'] = $this->docente_model->getEventosFromDocente($this->session->userdata('id'));
        $data['disc_eventos'] = $this->docente_model->getEventosFromDisciplinasAtivasFromDocente($this->session->userdata('id'));
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('frontend/docente', $data);
        $this->load->view('include/footer');
    }

    function aluno() {
        $this->load->model('aluno_model');
        $this->load->model('trabalho_model');
        $data['disciplinas'] = $this->aluno_model->getAtiveorDisableDisciplinasFromAluno($this->session->userdata('id'), 1);
        $data['trabalhos'] = $this->aluno_model->getAtiveorDisableTrabalhosFromAluno($this->session->userdata('id'), 1);
        $data['trab_eventos'] = $this->aluno_model->getDatasFinaisFromAluno($this->session->userdata('id'));
        $data['pessoais'] = $this->aluno_model->getEventosFromAluno($this->session->userdata('id'));
        $data['disc_eventos'] = $this->aluno_model->getEventosFromDisciplinasAtivasFromAluno($this->session->userdata('id'));
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('frontend/aluno', $data);
        $this->load->view('include/footer');      
    }

    function addDocenteQuickEvent() {
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
        $this->load->model('docente_model');
        $this->docente_model->inserirEvento($date, $evento);
        redirect(base_url()."index.php/frontend/docente");
    }

    function addAlunoQuickEvent() {
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
        $this->load->model('aluno_model');
        $this->aluno_model->inserirEvento($date, $evento);
        redirect(base_url()."index.php/frontend/aluno");
    }
}
