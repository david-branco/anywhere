<div class ="container">
    <h1 style="text-align: center"><?php echo $title ?></h1>
    <div class ="col-md-12">         
        <?php 
        if(empty($results)) { 
            echo "<h4 style='text-align:center'>There's no works inserted</h4>";
        }
        else {
            echo "<table class='table table-striped'>";  
            echo "<thead>"; 
            echo "<tr>";
            if ($this->session->userdata('type') == 'A' || $this->session->userdata('type') == 'T') { echo "<th style='width:8%; text-align:center'></th>"; } 
            echo "<th>Name</th>";
            echo "<th>Theme</th>";
            echo "<th>Final Date</th>";
            echo "<th>Visibility</th>";
            echo "<th style='width:20%; text-align:center'>Tools</th>";
            echo "</tr>";  
            echo "</thead>";  
            echo "<tbody>";
            foreach ($results as $row) {
                echo "<tr>";                
                if ($this->session->userdata('type') == 'A') {
                    echo "<td style='width:8%; text-align:left'>";
                    echo "<a href=\"".base_url()."index.php/ficheiro/form/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-success\">Add File</button></a>";
                }
                if ($this->session->userdata('type') == 'T') { 
                    $autorizado = $this->docente_model->isATrabalhoFromDocente($row->trabalho_id, $this->session->userdata('id'));
                    if ($autorizado) {
                        echo "<td style='width:8%; text-align:left'>";
                        echo "<a href=\"".base_url()."index.php/ficheiro/form/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-success\">Add File</button></a>";
                    }
                    else { echo "<td>"; }
                }
                echo "</td>";
                echo "<td>" . $row->nome . "</td>";
                echo "<td>" . $row->tema . "</td>";
                echo "<td>" . $row->datafinal . "</td>";
                echo "<td>" . $this->trabalho_model->showVisibilidade($row->visibilidade) . "</td>";
                $disciplina = $this->trabalho_model->getDisciplinaFromTrabalho($row->trabalho_id);
                echo "<td style='width:20%; text-align:right'>";
                if ($this->session->userdata('type') == "A") {
                    echo "<a href=\"".base_url()."index.php/trabalho/show/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                    <a href=\"".base_url()."index.php/trabalho/profile/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-primary\">Profile</button></a>
                    <a href=\"".base_url()."index.php/trabalho/form/".$disciplina->disciplina_id. "/" .$row->trabalho_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>
                    <a href=\"".base_url()."index.php/trabalho/delete/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-danger\" onClick=\"return confirm('Are you sure?')\">Delete</button></a>
                    <a href=\"".base_url()."index.php/trabalho/pauta/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-danger\">Grades</button></a>";
                }
                elseif ($this->session->userdata('type') == 'T') { 
                    $autorizado = $this->docente_model->isADisciplinaFromDocente($disciplina->disciplina_id, $this->session->userdata('id'));
                    if ($autorizado) {                                
                        echo "<a href=\"".base_url()."index.php/trabalho/show/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                        <a href=\"".base_url()."index.php/trabalho/form/" .$disciplina->disciplina_id. "/" .$row->trabalho_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>
                        <a href=\"".base_url()."index.php/trabalho/pauta/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-danger\">Grades</button></a>";
                    }
                    else { echo "  <a href=\"".base_url()."index.php/trabalho/profile/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-primary\">Profile</button></a>"; }
                }
                elseif ($this->session->userdata('type') == 'S') {
                    $autorizado = $this->aluno_model->isADisciplinaFromAluno($disciplina->disciplina_id, $this->session->userdata('id'));
                    if ($autorizado) {
                        echo "<a href=\"".base_url()."index.php/trabalho/show/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                        <a href=\"".base_url()."index.php/trabalho/pauta/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-danger\">Grades</button></a>";
                    }
                    else { echo "  <a href=\"".base_url()."index.php/trabalho/profile/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-primary\">Profile</button></a>"; }
                }                
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";  
            echo "</table>";
        }
        ?>
    </div>
</div>