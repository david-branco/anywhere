<div class ="container">
    <h1 style ="text-align: center;">List of <?php echo $title ?></h1>
    <div class ="col-md-12">
        <?php
            if(empty($pessoais) && empty($disciplinas) && empty($trabalhos)) { 
                echo "<h4 style='text-align:center'>There's no $title inserted</h4>";
            } 
            else {
                echo "<table class='table table-striped'>";  
                    echo "<thead>";  
                        echo "<tr>";
                        echo "<th>Category</th>";
                        echo "<th>Date</th>";
                        echo "<th>Event</th>";
                        echo "<th>Class</th>";
                        echo "<th>Tools</th>";  
                        echo "</tr>";  
                    echo "</thead>";  
                    echo "<tbody>";
                        foreach ($pessoais as $pessoal) {
                            echo "<tr>";
                            echo "<td style =\"color: red\"> Personal </td>";
                            echo "<td>" . $pessoal->dataEvento . "</td>";
                            echo "<td>" . $pessoal->evento . "</td>";
                            echo "<td></td>";
                            echo "<td><a href=\"".base_url()."index.php/evento/formPersonal/".$pessoal->evento_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a></td>";
                            echo "</tr>"; 
                        }
                        foreach ($disciplinas as $disciplina) {
                            echo "<tr>";
                            echo "<td style =\"color: blue\"> Classes </td>";
                            echo "<td>" . $disciplina->dataEvento . "</td>";
                            echo "<td>" . $disciplina->evento . "</td>";
                            echo "<td>" . $disciplina->nome . "</td>";                            
                            if($this->session->userdata('type') != "S") {
                                echo "<td><a href=\"".base_url()."index.php/evento/formClass/".$disciplina->disciplina_id."/".$disciplina->evento_id."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a></td>";
                            }
                            else { echo "<td></td>"; }
                            echo "</tr>"; 
                        }
                        foreach ($trabalhos as $trabalho) {
                            $trab = $this->trabalho_model->getTrabalho($trabalho->trabalho_id);                         
                            echo "<tr>";
                            echo "<td style =\"color: green\"> Works </td>";
                            echo "<td>" . $trabalho->datafinal . "</td>";
                            echo "<td> Final Date: " . $trab['nome'] . "</td>";
                            echo "<td>" . $trabalho->nome . "</td>"; 
                            echo "<td></td>";                           
                            echo "</tr>"; 
                        }
                    echo "</tbody>";  
                echo "</table>";
            }
        ?>
    </div>
</div>