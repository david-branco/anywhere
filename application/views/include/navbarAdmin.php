    <a class="navbar-brand" href="<?php echo base_url();?>index.php/frontend/admin">Anywhere</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Teachers<b class="caret" style ="border-top-color: white !important; border-bottom-color: white !important;"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url()."index.php/docente/form"?>">New Teacher</a></li>
            <li><a href="<?php echo base_url()."index.php/docente/index"?>">Teachers List</a></li>           
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Students<b class="caret" style ="border-top-color: white !important; border-bottom-color: white !important;"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url()."index.php/aluno/form"?>">New Student</a></li>
            <li><a href="<?php echo base_url()."index.php/aluno/index"?>">Students List</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Classes<b class="caret" style ="border-top-color: white !important; border-bottom-color: white !important;"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url()."index.php/disciplina/form"?>">New Class</a></li>
            <li><a href="<?php echo base_url()."index.php/disciplina/index"?>">Classes List</a></li>
            <li><a href="<?php echo base_url()."index.php/disciplina/enroll/1"?>">Enroll Teacher</a></li>
            <li><a href="<?php echo base_url()."index.php/disciplina/unenroll/1"?>">Unenroll Teacher</a></li>
            <li><a href="<?php echo base_url()."index.php/disciplina/enroll/2"?>">Enroll Student</a></li>
            <li><a href="<?php echo base_url()."index.php/disciplina/unenroll/2"?>">Unenroll Student</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Works<b class="caret" style ="border-top-color: white !important; border-bottom-color: white !important;"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url()."index.php/trabalho/form"?>">New Work</a></li>
            <li><a href="<?php echo base_url()."index.php/trabalho/index"?>">Works List</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Work Teams<b class="caret" style ="border-top-color: white !important; border-bottom-color: white !important;"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url()."index.php/grupo/form"?>">New Work Team</a></li>
            <li><a href="<?php echo base_url()."index.php/grupo/index"?>">Work Teams List</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Submissions<b class="caret" style ="border-top-color: white !important; border-bottom-color: white !important;"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url()."index.php/submissao/form"?>">New Submission</a></li>
            <li><a href="<?php echo base_url()."index.php/submissao/index"?>">Submissions List</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Files<b class="caret" style ="border-top-color: white !important; border-bottom-color: white !important;"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url()."index.php/ficheiro/form"?>">New File</a></li>
            <li><a href="<?php echo base_url()."index.php/ficheiro/index"?>">Files List</a></li>
          </ul>
        </li>       
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo base_url()."index.php/login/signout"?>">Logout</a></li>
      </ul>
    </div>
    <div id ="bar"></div>