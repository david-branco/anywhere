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
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Work ID</th>
                    <th>Work Name</th>
                    <th>Classe ID</th>
                    <th>Classe Name</th>
                    <th>Tools</th>            
                </tr>   
            </thead>  
            <tbody>
                <?php
                foreach ($results as $row) {
                    $trab = $this->grupo_model->getTrabalhoFromGrupo($row->grupo_id);
                    $disc = $this->grupo_model->getDisciplinaFromGrupo($row->grupo_id);
                    echo "<tr>";
                    echo "<td>" . $row->grupo_id . "</td>";
                    echo "<td>" . $row->nome . "</td>";
                    echo "<td>" . $trab['trabalho_id']. "</td>";
                    echo "<td>" . $trab['nome']. "</td>";
                    echo "<td>" . $disc['disciplina_id']. "</td>";
                    echo "<td>" . $disc['nome']. "</td>";
                    echo "<td>
                    <a href=\"".base_url()."index.php/grupo/show/".$row->grupo_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                    <a href=\"".base_url()."index.php/grupo/delete/".$trab['trabalho_id']."/".$row->grupo_id ."\" onClick=\"return confirm('Are you sure?')\"><button class =\"btn btn-xs btn-danger\" onClick=\"return confirm('Are you sure?')\">Delete</button></a>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>  
        </table>
    </div>
</div>