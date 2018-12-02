<div class ="container">
    <?php 
        if (!empty($this->session->flashdata('message'))) {
            echo "<p class='alert alert-info'>".$this->session->flashdata('message')."</p>";
        }
    ?>
    <h1 style="text-align: center"><?php echo $nome ?>
    <a href="<?php echo base_url()."index.php/disciplina/pauta/".$disciplina_id ?>"><button class ="btn btn-xs btn-danger">Grades</button></a>
    <?php if($this->session->userdata('type') != 'S') {?>
        <a href="<?php echo base_url()."index.php/contacto/emailDisciplina/".$disciplina_id ?>"><button class ="btn btn-xs btn-info">Send Email</button></a>
    <?php } ?>     
    </h1>
    <div class ="col-md-12">
        <table class="table table-striped">  
            <thead>  
              <tr> 
                <?php if ($this->session->userdata('type') == 'A' || $this->session->userdata('type') == 'T') { echo "<th style='width:9%; text-align:center'></th>"; } ?>
                <th>Class Name</th>
                <th>Class Code</th>
                <th>Academic Year</th>
                <th>Course</th>  
                <th>Institution</th>  
                <?php 
                    if ($this->session->userdata('type') == 'A' || $this->session->userdata('type') == 'T') { 
                        echo "<th>Registration Token</th>";
                        echo "<th style='width:15%; text-align:center'>Tools</th>";
                    } 
                ?>                    
              </tr>  
            </thead>  
            <tbody>
                <?php
                    echo "<tr>";
                    if ($this->session->userdata('type') == 'A' || $this->session->userdata('type') == 'T') { 
                        echo "<td style='width:9%; text-align:left'>
                        <a href=\"".base_url()."index.php/trabalho/form/".$disciplina_id ."\"><button class =\"btn btn-xs btn-success\">Add Work</button></a>
                        <a href=\"".base_url()."index.php/evento/formClass/".$disciplina_id ."\"><button class =\"btn btn-xs btn-success\">Add Event</button></a>
                        </td>";
                    }
                    echo "<td> $nome </td>";
                    echo "<td> $coduc </td>";
                    echo "<td> $anoletivo </td>";
                    echo "<td> $curso </td>";
                    echo "<td> $instituicao </td>";
                    if ($this->session->userdata('type') == 'A' || $this->session->userdata('type') == 'T') {
                        echo "<td> $token </td>";
                    }
                    echo "<td style='width:15%; text-align:right'>";
                    if ($this->session->userdata('type') == "A") {
                        echo "<a href=\"".base_url()."index.php/disciplina/show/".$disciplina_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                        <a href=\"".base_url()."index.php/disciplina/profile/".$disciplina_id ."\"><button class =\"btn btn-xs btn-primary\">Profile</button></a>
                        <a href=\"".base_url()."index.php/disciplina/form/".$disciplina_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>
                        <a href=\"".base_url()."index.php/disciplina/delete/".$disciplina_id ."\" onClick=\"return confirm('Are you sure?')\"><button class =\"btn btn-xs btn-danger\">Delete</button></a>
                        <a href=\"".base_url()."index.php/contacto/convites/".$disciplina_id ."\"><button class =\"btn btn-xs btn-primary\">Send Invitations</button></a>";                        
                    }
                    elseif ($this->session->userdata('type') == 'T') {                         
                        echo "<a href=\"".base_url()."index.php/disciplina/form/".$disciplina_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>
                        <a href=\"".base_url()."index.php/contacto/convites/".$disciplina_id ."\"><button class =\"btn btn-xs btn-primary\">Send Invitations</button></a>";
                    }
                    echo "</td>";
                    echo "</tr>";
                ?>
            </tbody>  
        </table>
    </div>
</div>