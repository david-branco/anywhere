    <a class="navbar-brand" href="<?php echo base_url();?>index.php/frontend/aluno">Anywhere</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile<b class="caret" style ="border-top-color: white !important; border-bottom-color: white !important;"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url()."index.php/aluno/profile/".$this->session->userdata("id")?>">Show Profile</a></li>
            <li><a href="<?php echo base_url()."index.php/aluno/form/".$this->session->userdata("id")?>">Edit Profile</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Classes<b class="caret" style ="border-top-color: white !important; border-bottom-color: white !important;"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url()."index.php/disciplina/enroll"?>">Enroll Class</a></li>            
            <li><a href="<?php echo base_url()."index.php/disciplina/showList/".$this->session->userdata("id")?>">Show Classes</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Works<b class="caret" style ="border-top-color: white !important; border-bottom-color: white !important;"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url()."index.php/trabalho/showList/1/".$this->session->userdata("id")?>">Show Works</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Events<b class="caret" style ="border-top-color: white !important; border-bottom-color: white !important;"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url()."index.php/evento/formPersonal" ?>">Add Personal Event</a></li>
            <li><a href="<?php echo base_url()."index.php/evento/showList" ?>">Show Events</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo base_url()."index.php/login/signout"?>">Logout</a></li>
      </ul>
    </div>
    <div id ="bar"></div>