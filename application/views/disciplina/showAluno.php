<div class ="container">
    <?php
        if(empty($results)) { 
            echo "<h4 style='text-align:center'>There's no classes inserted</h4>";
        }
        else {
            foreach ($results as $row) {
                echo "<h2 style=\"text-align: center\">Students of ".$row->nome."</h2>";
                echo "<div class =\"container\">";
                    echo "<div class =\"col-md-12\">";
                        echo "<table class=\"table table-striped\">";  
                            echo "<thead>";  
                                echo "<tr>";  
                                echo "<th>Foto</th>";
                                echo "<th>Name</th>";
                                echo "<th>Email</th>";
                                echo "<th>Course</th>";
                                echo "<th>Instituiton</th>";
                                echo "<th>Tools</th>";
                                echo "</tr>";  
                            echo "</thead>"; 
                            echo "<tbody>";              
                                $alunos = $this->disciplina_model->getAlunosFromDisciplina($row->disciplina_id); 
                                foreach ($alunos as $row2) {
                                    echo "<tr>";
                                    echo "<td>" . $row2->foto . "</td>";
                                    echo "<td>" . $row2->nome . "</td>";
                                    echo "<td>" . $row2->email . "</td>";
                                    echo "<td>" . $row2->curso . "</td>";
                                    echo "<td>" . $row2->instituicao . "</td>";
                                    echo "<td>
                                    <a href=\"".base_url()."index.php/aluno/show/".$row2->aluno_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                                    </td>";
                                    echo "</tr>";
                                }
                            echo "</tbody>"; 
                        echo "</table>";
                    echo "</div>";
                echo "</div>";
            }
        } 
    ?>
</div>
                