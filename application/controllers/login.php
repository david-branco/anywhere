<?php if (!defined('BASEPATH')) die();

class Login extends CI_Controller {


	function signin() {
  
      $this->load->model('docente_model');
      $this->load->model('aluno_model');
      $this->load->model('admin_model');
      $email = $this->input->post('email');
      $pass  = $this->input->post('password');

      $this->admin_model->limparQuickRegisters();

      if( $email && $pass && $this->docente_model->validate_docente($email,$pass)) {
        redirect('/index.php/frontend/docente');
      } else if( $email && $pass && $this->aluno_model->validate_aluno($email,$pass)) {
        redirect('/index.php/frontend/aluno');
      } else if($email && $pass && $this->admin_model->validate_admin($email,$pass)) {
        redirect('/index.php/frontend/admin');
      } else {
        redirect('/');
      }
  	}

  function signout() {
  
    $newdata = array(
      'id'   =>'',
      'name'  =>'',
      'email'     => '',
      'logged' => FALSE,
      'type' => "0",
    );
    $this->session->unset_userdata($newdata);
    $this->session->sess_destroy();
    redirect("/");
  }
}

?>