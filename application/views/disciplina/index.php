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
                    <th></th>            
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Class Code</th>
                    <th>Academic Year</th>
                    <th>Course</th>
                    <th>Instituiton</th>
                    <th>Tools</th>              
                </tr>   
            </thead>  
            <tbody>
                <?php
                foreach ($results as $row) {
                    echo "<tr>";
                    echo "<td> <a href=\"".base_url()."index.php/trabalho/form/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-success\">Add Work</button></a></td>";
                    echo "<td>" . $row->disciplina_id . "</td>";
                    echo "<td>" . $row->nome . "</td>";
                    echo "<td>" . $row->coduc . "</td>";
                    echo "<td>" . $row->anoletivo . "</td>";
                    echo "<td>" . $row->curso . "</td>";
                    echo "<td>" . $row->instituicao . "</td>";
                    echo "<td>
                    <a href=\"".base_url()."index.php/disciplina/pauta/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-primary\">Grades</button></a>
                    <a href=\"".base_url()."index.php/disciplina/show/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                    <a href=\"".base_url()."index.php/disciplina/profile/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-primary\">Profile</button></a>
                    <a href=\"".base_url()."index.php/disciplina/form/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>
                    <a href=\"".base_url()."index.php/disciplina/delete/".$row->disciplina_id ."\" onClick=\"return confirm('Are you sure?')\"><button class =\"btn btn-xs btn-danger\">Delete</button></a>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>  
        </table>
    </div>
</div>