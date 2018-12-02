<div class ="container">
    <?php 
        if (!empty($this->session->flashdata('message'))) {
            echo "<p class='alert alert-info'>".$this->session->flashdata('message')."</p>";
        }
    ?>
    <h1 style ="text-align: center;"><?php echo $title ?></h1>
    <div class ="col-md-12">
        <table class="table table-striped">  
            <thead>  
                <tr>            
                    <th>Photo</th>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Website</th>
                    <th>CV</th>
                    <th>Teacher Number</th>
                    <th>Other Contacts</th>
                    <th>myAcademia Profile</th>
                    <th>Tools</th>              
                </tr>   
            </thead>  
            <tbody>
                <?php
                foreach ($results as $row) {
                    echo "<tr>";
                    if (empty($row->foto)) {
                        echo "<td> <img border=\"0\" src=\" " .base_url()."uploads/photos/defaultphoto.png\" alt=\"User Default Photo\" width=\"40\" height=\"30\"/> </td>";     
                    }
                    else {
                        echo "<td> <img border=\"0\" src=\" " . base_url() . $row->foto . "\" alt=\"Teacher Photo\" width=\"40\" height=\"30\"/> </td>";                     
                    }
                    echo "<td>" . $row->docente_id . "</td>";
                    echo "<td>" . $row->nome . "</td>";
                    echo "<td>" . $row->password . "</td>";
                    echo "<td>" . $row->email . "</td>";
                    echo "<td>" . $row->website . "</td>";
                    echo "<td>" . $row->cv . "</td>";
                    echo "<td>" . $row->ndocente . "</td>";
                    echo "<td>" . $row->contatos . "</td>";
                    echo "<td>" . $row->myAcademia . "</td>";
                    echo "<td>
                    <a href=\"".base_url()."index.php/docente/show/".$row->docente_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                    <a href=\"".base_url()."index.php/docente/profile/".$row->docente_id ."\"><button class =\"btn btn-xs btn-primary\">Profile</button></a>
                    <a href=\"".base_url()."index.php/docente/form/".$row->docente_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>
                    <a href=\"".base_url()."index.php/docente/delete/".$row->docente_id ."\"><button class =\"btn btn-xs btn-danger\" onClick=\"return confirm('Are you sure?')\">Delete</button></a>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>  
        </table>
    </div>
</div>