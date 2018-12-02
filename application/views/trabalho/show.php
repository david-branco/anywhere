<div class ="container">
    <a href="<?php echo base_url()."index.php/disciplina/show/".$disciplina_id['disciplina_id'] ?>"><button class ="btn btn-xs btn-primary">Show Class</button></a>
    <?php 
        if (!empty($this->session->flashdata('message'))) {
            echo "<p class='alert alert-info'>".$this->session->flashdata('message')."</p>";
        }
    ?>
    <h1 style="text-align: center"><?php echo $nome?>
    <a href="<?php echo base_url()."index.php/trabalho/pauta/".$trabalho_id ?>"><button class ="btn btn-xs btn-danger">Grades</button></a>
    </h1>
    <div class ="col-md-14">
        <table class="table table-striped">  
            <thead>  
              <tr>
                <?php if ($this->session->userdata('type') == 'A' || $this->session->userdata('type') == 'T') { echo "<th></th>"; } ?> 
                <th>Name</th>                  
                <th>Topic</th>   
                <th>Description</th> 
                <th>Visibility</th> 
                <th>Start Date</th>
                <th>Final Date</th>                      
                <th>Group Date</th>  
                <th>Repository Date</th>  
                <th>Submisson Limit</th>  
                <th>Delay?</th> 
                <?php if ($atraso != 1) { echo "<th>Penalization</th>"; } ?>                
                <th>Importance</th>
                <th>Evaluation Type</th>
                <?php if ($this->session->userdata('type') == 'A' || $this->session->userdata('type') == 'A' || $this->session->userdata('type') == 'T') { echo "<th>Tools</th>"; } ?>
              </tr>  
            </thead>
            <tbody>
                <?php
                    echo "<tr>";
                    if ($this->session->userdata('type') == 'A' || $this->session->userdata('type') == 'T') { 
                        echo "<td> 
                            <a href=\"".base_url()."index.php/ficheiro/form/".$trabalho_id ."\"><button class =\"btn btn-xs btn-success\">Add File</button></a>
                        </td>";                    
                    }
                    echo "<td> $nome </td>";
                    echo "<td> $tema </td>";
                    echo "<td> $descricao </td>";
                    echo "<td>" . $this->trabalho_model->showVisibilidade($visibilidade) . "</td>";
                    echo "<td> $datainicial </td>";
                    echo "<td> $datafinal </td>";
                    echo "<td> $datagrupos </td>";
                    echo "<td> $datarepositorio </td>";
                    echo "<td> $limitesubmissao </td>";
                    echo "<td>" . $this->trabalho_model->showAtraso($atraso) . "</td>";
                    if ($atraso != 1) { echo "<td> $desconto %</td>"; }
                    echo "<td> $pesonota %</td>";
                    echo "<td>" .$this->trabalho_model->showTipoAvaliacao($tipoavaliacao) ."</td>";
                    echo "<td>";
                    if ($this->session->userdata('type') == "A") {
                        echo "<a href=\"".base_url()."index.php/trabalho/profile/".$trabalho_id ."\"><button class =\"btn btn-xs btn-primary\">Profile</button></a>
                        <a href=\"".base_url()."index.php/trabalho/form/".$disciplina_id['disciplina_id']. "/" .$trabalho_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>
                        <a href=\"".base_url()."index.php/trabalho/delete/".$trabalho_id ."\"><button class =\"btn btn-xs btn-danger\" onClick=\"return confirm('Are you sure?')\">Delete</button></a>";
                    }
                    elseif ($this->session->userdata('type') == 'T') {                        
                        echo "<a href=\"".base_url()."index.php/trabalho/form/" .$disciplina_id['disciplina_id']. "/" .$trabalho_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>";
                    }
                    echo "</td>";
                    echo "</tr>";
                ?>
            </tbody>  
        </table>
    </div>
</div>