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
                    <th>Topic</th>           
                    <th>Start Date</th>           
                    <th>Final Date</th>           
                    <th>Group Date</th>           
                    <th>Submission Limit</th>           
                    <th>Repository Date</th>           
                    <th>Description</th>           
                    <th>Visibility</th>           
                    <th>Delay</th>           
                    <th>Penalization</th>           
                    <th>Importance</th>
                    <th>Evaluation Type</th>           
                    <th>Tools</th>           
                </tr>   
            </thead>  
            <tbody>
                <?php
                foreach ($results as $row) {
                    $disciplina = $this->trabalho_model->getDisciplinaFromTrabalho($row->trabalho_id);
                    echo "<tr>";
                    echo "<td>" . $row->trabalho_id . "</td>";
                    echo "<td>" . $row->nome . "</td>";
                    echo "<td>" . $row->tema . "</td>";
                    echo "<td>" . $row->datainicial . "</td>";
                    echo "<td>" . $row->datafinal . "</td>";
                    echo "<td>" . $row->datagrupos . "</td>";
                    echo "<td>" . $row->limitesubmissao . "</td>";
                    echo "<td>" . $row->datarepositorio . "</td>";
                    echo "<td>" . $row->descricao . "</td>";
                    echo "<td>" . $this->trabalho_model->showVisibilidade($row->visibilidade) . "</td>";
                    echo "<td>" . $this->trabalho_model->showAtraso($row->atraso) . "</td>";
                    echo "<td>" . $row->desconto . "</td>";
                    echo "<td>" . $row->pesonota . "</td>";
                    echo "<td>" .$this->trabalho_model->showTipoAvaliacao($row->tipoavaliacao) ."</td>";
                    echo "<td>
                    <a href=\"".base_url()."index.php/trabalho/pauta/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-primary\">Grades</button></a>
                    <a href=\"".base_url()."index.php/trabalho/show/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                    <a href=\"".base_url()."index.php/trabalho/profile/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-primary\">Profile</button></a>
                    <a href=\"".base_url()."index.php/trabalho/form/".$disciplina->disciplina_id. "/" .$row->trabalho_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>
                    <a href=\"".base_url()."index.php/trabalho/delete/".$row->trabalho_id."\"><button class =\"btn btn-xs btn-danger\" onClick=\"return confirm('Are you sure?')\">Delete</button></a>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>  
        </table>
    </div>
</div>