<div class ="container">
    <h1 style="text-align: center"><?php echo $title ?></h1>
    <div class ="col-md-12">
        <?php
        if(empty($results)) { 
            echo "<h4 style='text-align:center'>There's no classes inserted</h4>";
        } 
        else {
            echo "<table class='table table-striped'>";  
            echo "<thead>";  
            echo "<tr>";  
            if ($this->session->userdata('type') == 'A' || $this->session->userdata('type') == 'T') { echo "<th style='width:9%; text-align:center'></th>"; }
            echo "<th>Name</th>";  
            echo "<th>Course</th>";  
            echo "<th>Institution</th>";  
            echo "<th>Academic Year</th>";  
            echo "<th style='width:20%; text-align:center'>Tools</th>";
            echo "</tr>";  
            echo "</thead>";  
            echo "<tbody>";
            foreach ($results as $row) {
                echo "<tr>";                
                if ($this->session->userdata('type') == 'A') {
                    echo "<td style='width:9%; text-align:left'>"; 
                    echo "<a href=\"".base_url()."index.php/trabalho/form/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-success\">Add Work</button></a>
                    <a href=\"".base_url()."index.php/evento/formClass/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-success\">Add Work</button></a>";
                }
                elseif ($this->session->userdata('type') == 'T') { 
                    $autorizado = $this->docente_model->isADisciplinaFromDocente($row->disciplina_id, $this->session->userdata('id'));
                    if ($autorizado) {
                        echo "<td style='width:9%; text-align:left'>";
                        echo "<a href=\"".base_url()."index.php/trabalho/form/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-success\">Add Work</button></a>
                        <a href=\"".base_url()."index.php/evento/formClass/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-success\">Add Event</button></a>";
                    }
                    else { echo "<td>"; }
                }
                echo "</td>";
                echo "<td>" . $row->nome . "</td>";
                echo "<td>" . $row->curso . "</td>";
                echo "<td>" . $row->instituicao . "</td>";
                echo "<td>" . $row->anoletivo . "</td>";
                echo "<td style='width:20%; text-align:right'>";
                if ($this->session->userdata('type') == "A") {
                    echo "<a href=\"".base_url()."index.php/disciplina/show/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                    <a href=\"".base_url()."index.php/disciplina/profile/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-primary\">Profile</button></a>
                    <a href=\"".base_url()."index.php/disciplina/form/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>
                    <a href=\"".base_url()."index.php/disciplina/delete/".$row->disciplina_id ."\" onClick=\"return confirm('Are you sure?')\"><button class =\"btn btn-xs btn-danger\">Delete</button></a>
                    <a href=\"".base_url()."index.php/disciplina/pauta/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-primary\">Grades</button></a>";                        
                }
                elseif ($this->session->userdata('type') == 'T' && $autorizado) {                        
                    $ativa = $this->docente_model->isDisciplinaAtiveFromDocente($row->disciplina_id);                         
                    if($ativa) {
                        echo "<a href=\"".base_url()."index.php/disciplina/show/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                        <a href=\"".base_url()."index.php/disciplina/form/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>
                        <a href=\"".base_url()."index.php/disciplina/pauta/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-danger\">Grades</button></a>
                        <a href=\"".base_url()."index.php/disciplina/active_disable/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-success\">Disable</button></a>";
                    }
                    else { 
                        echo "<a href=\"".base_url()."index.php/disciplina/show/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                        <a href=\"".base_url()."index.php/disciplina/form/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>
                        <a href=\"".base_url()."index.php/disciplina/pauta/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-danger\">Grades</button></a>
                        <a href=\"".base_url()."index.php/disciplina/active_disable/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-success\">Enable</button></a>"; 
                    }
                }
                elseif ($this->session->userdata('type') == 'S') {
                    $autorizado = $this->aluno_model->isADisciplinaFromAluno($row->disciplina_id, $this->session->userdata('id'));
                    if ($autorizado) {
                        $ativa = $this->aluno_model->isDisciplinaAtiveFromAluno($row->disciplina_id);                         
                        if($ativa) {
                            echo "<a href=\"".base_url()."index.php/disciplina/show/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                            <a href=\"".base_url()."index.php/disciplina/pauta/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-danger\">Grades</button></a>
                            <a href=\"".base_url()."index.php/disciplina/active_disable/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-success\">Disable</button></a>";   
                        }
                        else {
                            echo "<a href=\"".base_url()."index.php/disciplina/show/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                            <a href=\"".base_url()."index.php/disciplina/pauta/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-danger\">Grades</button></a>
                            <a href=\"".base_url()."index.php/disciplina/active_disable/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-success\">Enable</button></a>";  
                        }                         
                    }                        
                }
                else { echo "  <a href=\"".base_url()."index.php/disciplina/profile/".$row->disciplina_id."\"><button class =\"btn btn-xs btn-primary\">Profile</button></a>"; }
                echo "</td>";
                echo "</tr>";
            }

            echo "</tbody>";  
            echo "</table>";
        }
        ?>
    </div>
</div>
