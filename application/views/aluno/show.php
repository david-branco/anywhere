<div class ="container">
    <?php 
        if (!empty($this->session->flashdata('message'))) {
            echo "<p class='alert alert-info'>".$this->session->flashdata('message')."</p>";
        }
    ?>
    <h1 style="text-align: center"><?php echo $nome ?></h1>
        <div class ="col-md-14">
            <table class="table table-striped">  
                <thead>  
                  <tr> 
                    <th>Photo</th> 
                    <th>Name</th>                  
                    <th>Student Number</th>   
                    <th>Course</th>
                    <th>Institution</th>
                    <th>Status</th> 
                    <th>Email</th> 
                    <th>Website</th>
                    <th>Tools</th>                      
                  </tr>  
                </thead>  
                <tbody>
                    <?php
                        echo "<tr>";
                        if (empty($foto)) {
                            echo "<td> <img border=\"0\" src=\" " .base_url()."uploads/photos/defaultphoto.png\" alt=\"User Default Photo\" width=\"40\" height=\"30\"/> </td>";     
                        }
                        else {
                            echo "<td> <img border=\"0\" src=\" " . base_url() . $foto . "\" alt=\"Student Photo\" width=\"40\" height=\"30\"/> </td>";                     
                        }
                        echo "<td> $nome </td>";
                        echo "<td> $naluno </td>";
                        echo "<td> $curso </td>";
                        echo "<td> $instituicao </td>";
                        echo "<td>" . $this->aluno_model->showEstatuto($aluno_id) . "</td>";
                        echo "<td> $email </td>";
                        echo "<td> $website </td>";
                        if ($this->session->userdata('type') == "A") {
                            echo "<td>
                            <a href=\"".base_url()."index.php/aluno/show/".$aluno_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                            <a href=\"".base_url()."index.php/aluno/profile/".$aluno_id ."\"><button class =\"btn btn-xs btn-primary\">Profile</button></a>
                            <a href=\"".base_url()."index.php/aluno/form/".$aluno_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>
                            <a href=\"".base_url()."index.php/aluno/delete/".$aluno_id ."\" onClick=\"return confirm('Are you sure?')\"><button class =\"btn btn-xs btn-danger\">Delete</button></a>
                            </td>"; 
                        }
                        elseif ($this->session->userdata('type') == 'T') {                      
                            echo "<td><a href=\"".base_url()."index.php/aluno/profile/".$aluno_id ."\"><button class =\"btn btn-xs btn-primary\">Profile</button></a></td>"; 
                        }
                        elseif ($this->session->userdata('id') == $aluno_id) {                      
                            echo "<td>
                            <a href=\"".base_url()."index.php/aluno/form/".$aluno_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>
                            </td>"; 
                        }
                        else { echo "<td><a href=\"".base_url()."index.php/aluno/profile/".$aluno_id ."\"><button class =\"btn btn-xs btn-primary\">Profile</button></a></td>"; }
                        echo "</tr>";
                    ?>
                </tbody>  
            </table>
        </div>
</div>

