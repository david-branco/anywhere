<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

    <?php
      if ($this->session->userdata('type') == 'T') {
        $this->load->view('include/navbarDocente');
      }
      elseif ($this->session->userdata('type') == 'S') { $this->load->view('include/navbarAluno'); }
      elseif ($this->session->userdata('type') == 'A') { $this->load->view('include/navbarAdmin'); }
      else { $this->load->view('include/navbarLogin.html'); }
    ?>
    
  </div><!-- /.container-fluid -->
</nav>
