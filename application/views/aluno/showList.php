<div class ="container">
    <h1 style ="text-align: center;"><?php echo $title ?></h1>
    <div class ="col-md-12">
        <?php
            if(empty($results)) { 
                echo "<h4 style='text-align:center'>There's no students enrolled</h4>";
            }
            else {
                echo "<td>Total students: ". count($results) ."</td>"; 
                echo "<table class='table table-striped'>";  
                echo "<thead>";  
                echo "<tr>";  
                echo "<th>Foto</th>";
                echo "<th>Name</th>";
                echo "<th>Email</th>";
                echo "<th>Course</th>";
                echo "<th>Instituiton</th>";
                echo "<th style='width:15%; text-align:center'>Tools</th>";               
                echo "</tr>";  
                echo "</thead>";  
                echo "<tbody>";
                foreach ($results as $row) {
                    echo "<tr>";
                    if (empty($row->foto)) {
                        echo "<td> <img border=\"0\" src=\" " .base_url()."uploads/photos/defaultphoto.png\" alt=\"User Default Photo\" width=\"40\" height=\"30\"/> </td>";     
                    }
                    else {
                        echo "<td> <img border=\"0\" src=\" " . base_url() . $row->foto . "\" alt=\"Student Photo\" width=\"40\" height=\"30\"/> </td>";                     
                    }
                    echo "<td>" . $row->nome . "</td>";
                    echo "<td>" . $row->email . "</td>";
                    echo "<td>" . $row->curso . "</td>";
                    echo "<td>" . $row->instituicao . "</td>";
                    echo "<td  style='width:13%; text-align:right'>";
                    echo "<a href=\"".base_url()."index.php/aluno/show/".$row->aluno_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a> ";
                    if ($this->session->userdata('type') == "A") {
                        echo "<a href=\"".base_url()."index.php/aluno/profile/".$row->aluno_id ."\"><button class =\"btn btn-xs btn-primary\">Profile</button></a>
                        <a href=\"".base_url()."index.php/aluno/form/".$row->aluno_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>
                        <a href=\"".base_url()."index.php/aluno/delete/".$row->aluno_id ."\"><button class =\"btn btn-xs btn-danger\" onClick=\"return confirm('Are you sure?')\">Delete</button></a>";
                    }
                    elseif ($this->session->userdata('type') == "S" && $this->session->userdata('id') == $row->aluno_id) {                      
                        echo "<a href=\"".base_url()."index.php/aluno/form/".$row->aluno_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>"; 
                    }
                    else { echo "<a href=\"".base_url()."index.php/aluno/profile/".$row->aluno_id ."\"><button class =\"btn btn-xs btn-primary\">Profile</button></a>"; } 
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";  
                echo "</table>";
            }
        ?>
</div>
</div>