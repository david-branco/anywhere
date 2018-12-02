<?php if (!defined('BASEPATH')) die();
class Frontpage extends Main_Controller {

   public function index()
	{
		$str["container"] = "no";
		$this->load->view('include/header');
      	$this->load->view('include/navbarLogin.html');
      	$this->load->view('frontpage');
      	$this->load->view('include/footer');
	}

    public function search () {
        $term = $_REQUEST['search'];
        $filter ="";
        if (!empty($_REQUEST['filter']))
            $filter = $_REQUEST['filter'];            
        $data['term'] = $term;
        $this->load->model("docente_model");
        $this->load->model("disciplina_model");
        $this->load->model("trabalho_model");
        $data['teachers'] = $this->docente_model->getRandomTeachers();
        $data['temas'] = $this->trabalho_model->getRandomThemes();
        if ($filter == "teacher") {
            $data['docentes'] = $this->docente_model->getDocentesSearch($term);                
        } else if ($filter == "class") {
            $data['disciplinas'] = $this->disciplina_model->getDisciplinasSearch($term);
        } else if ($filter == "work") {
            $data['trabalhos'] = $this->trabalho_model->getTrabalhosSearch($term);
        } else {            
            $data['docentes'] = $this->docente_model->getDocentesSearch($term);                
            $data['disciplinas'] = $this->disciplina_model->getDisciplinasSearch($term);     
            $data['trabalhos'] = $this->trabalho_model->getTrabalhosSearch($term);
        }
        $this->load->view('include/header');
        if($this->session->userdata("logged")) { $this->load->view('include/navbar'); }
        else { $this->load->view('include/navbarLogin.html'); }
        $this->load->view('search',$data);
        $this->load->view('include/footer');

    }

	public function livesearch() {

        if ( !isset($_GET['term']) )
            exit;
        $term = $_REQUEST['term'];
        $term = strtoupper($term);
        $data = array();
        $this->load->model("docente_model");
        $rows = $this->docente_model->getDocentesSearch($term);
        foreach( $rows as $row ) {
            $data[] = array(
                'label' => $row->nome . ', ' . $row->email,
                'value' => 'T#' . $row->docente_id);
        }

        $this->load->model("disciplina_model");
        $rows = $this->disciplina_model->getDisciplinasSearch($term);
        foreach( $rows as $row ) {
            $data[] = array(
                'label' => $row->nome,
                'value' => 'C#' . $row->disciplina_id);
        }

        $this->load->model("trabalho_model");
        $rows = $this->trabalho_model->getTrabalhosSearch($term);
        foreach( $rows as $row ) {
            $data[] = array(
                'label' => $row->nome,
                'value' => 'W#' . $row->trabalho_id);
        }

        echo json_encode($data);
        flush();
    }
   
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
