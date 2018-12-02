<div class ="container">
    <?php 
        if (!empty($this->session->flashdata('message'))) {
            echo "<p class='alert alert-info'>".$this->session->flashdata('message')."</p>";
        }
    ?>
    <h1 style="text-align: center"><?php echo $nome ?></h1>
        <div class ="col-md-12">
            <table class="table table-striped">  
                <thead>  
                  <tr>
                    <th>Photo</th> 
                    <th>Name</th>
                    <th>Teacher Number</th>
                    <th>Email</th>
                    <th>Website</th>  
                    <th>myAcademia</th>  
                    <th>Contacts</th>
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
                            echo "<td> <img border=\"0\" src=\" " . base_url() . $foto . "\" alt=\"Teacher Photo\" width=\"40\" height=\"30\"/> </td>";                     
                        }
                        echo "<td> $nome </td>";
                        echo "<td> $ndocente </td>";
                        echo "<td> $email </td>";
                        echo "<td> $website </td>";
                        echo "<td> $myAcademia </td>";
                        echo "<td> $contatos </td>";
                        echo "<td>";
                        if ($this->session->userdata('type') == "A") {
                            echo "<a href=\"".base_url()."index.php/docente/profile/".$docente_id ."\"><button class =\"btn btn-xs btn-primary\">Profile</button></a>
                            <a href=\"".base_url()."index.php/docente/form/".$docente_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>
                            <a href=\"".base_url()."index.php/docente/delete/".$docente_id ."\" onClick=\"return confirm('Are you sure?')\"><button class =\"btn btn-xs btn-danger\">Delete</button></a>";
                        }
                        elseif ($this->session->userdata('type') == "T" && $this->session->userdata('id') == $docente_id) {                      
                            echo "<a href=\"".base_url()."index.php/docente/form/".$docente_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>"; 
                        }
                        else { echo "<a href=\"".base_url()."index.php/docente/profile/".$docente_id ."\"><button class =\"btn btn-xs btn-primary\">Profile</button></a>";  }
                        echo "</td>";
                        echo "</tr>";
                    ?>
                </tbody>  
            </table>
        </div>
</div>