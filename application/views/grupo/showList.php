<div class ="container">
    <h1 style ="text-align: center;">Work teams list    
        <?php 
        if ($this->session->userdata('type') == 'A' || $this->session->userdata('type') == 'T') { 
            echo "<a href=\"".base_url()."index.php/grupo/form/".$trabalho_id ."\"><button class =\"btn btn-xs btn-success\">Add work teams</button></a>";
        }
        ?>
    </h1>
    <div class ="col-md-12">
        <?php
        $penalizacoes = false;
        if(empty($results)) { 
            echo "<h4 style='text-align:center'>There's no work teams inserted</h4>";
        } 
        else {
            echo "<table class='table table-striped'>";  
            echo "<thead>";  
            echo "<tr>";  
            echo "<th>Name</th>";
            echo "<th>Members</th>";
            echo "<th>Evaluation</th>";
            echo "<th style='width:28%; text-align:center'>Tools</th>";
            echo "</tr>";  
            echo "</thead>";  
            echo "<tbody>";
            if ($this->session->userdata('type') == 'S') {
                $temGrupo = $this->trabalho_model->alunoHasGrupoInTrabalho($this->session->userdata('id'), $trabalho_id);
            }
            foreach ($results as $row) {                
                $alunos = $this->grupo_model->getAlunosFromGrupo($row->grupo_id);
                $submissao = $this->grupo_model->getUltimaSubmissaoFromGrupo($row->grupo_id);
                echo "<tr>";
                echo "<td>" . $row->nome . "</td>";
                echo "<td>";
                $i = count($alunos);
                foreach($alunos as $aluno) {
                    echo $aluno->nome;
                    if($i != 1) { echo " , "; }
                    else { echo "."; }
                    $i--;
                }
                echo "</td>";
                $avaliacao = "";
                $diferentes = FALSE;
                $penalizacoes = FALSE;
                $nota_grupo = "";
                if($atraso == 3 && !empty($submissao) && $submissao['data'] > $datafinal) {
                    $nota_grupo = $row->avaliacao - ($row->avaliacao*($desconto/100));                  
                    $penalizacoes = TRUE;
                    foreach($alunos as $aluno) {
                        $avalAux = $this->trabalho_model->getAvaliacaoFromAlunoFromTrabalho($aluno->aluno_id, $trabalho_id);
                        if(!empty($avalAux)) {
	                        $avalAux = $avalAux['avaliacao'] - ($avalAux['avaliacao']*($desconto/100));
	                        $avaliacao = $avaliacao. $avalAux . ", ";
	                        if($avalAux != $nota_grupo) { $diferentes = TRUE; }
	                    }
                    }
                }
                else {
                    foreach($alunos as $aluno) {
                        $nota_grupo = $row->avaliacao;
                        $avalAux = $this->trabalho_model->getAvaliacaoFromAlunoFromTrabalho($aluno->aluno_id, $trabalho_id);
                        if(!empty($avalAux)) {
	                        $avaliacao = $avaliacao. $avalAux['avaliacao'] . ", ";
	                        if($avalAux['avaliacao'] != $nota_grupo) { $diferentes = TRUE; }
	                    }
                    }
                }
                if ($diferentes && $penalizacoes) { echo "<td>" . substr($avaliacao, 0, -2) . "     (I)</td>"; }
                elseif($penalizacoes) { echo "<td>" . $nota_grupo . "     (I)</td>"; ; }
                elseif($diferentes) { echo "<td>" . substr($avaliacao, 0, -2) . "</td>"; }
                else { echo "<td>" . $nota_grupo . "</td>"; }
                echo "<td style='width:28%; text-align:right'>";
                if ($this->session->userdata('type') != 'S') {
                ?>
                <button type ="button"
                    class ="btn btn-warning btn-xs"
                    data-container="body"
                    data-toggle="popover" data-placement="left" 
                    data-content="<form class='form-inline' role='form' method = 'POST' action ='<?php echo base_url() . 'index.php/grupo/evaluate/' . $row->grupo_id; ?>'>
                        <div class='form-group'>
                        <input type='text' class ='form-control' name ='avaliacao' id ='avaliacao' placeholder='Evaluate this group'/>
                        </div>
                        <button type='submit' class='btn btn-sm btn-primary'>Save</button>
                        </form>
                ">
                Evaluate
                </button>
                <?php
                }    
                if ($this->session->userdata('type') == "A" || $this->session->userdata('type') == 'T') {
                    $ult_sub = $this->grupo_model->getUltimaSubmissaoFromGrupo($row->grupo_id);
                    if(!empty($ult_sub)) { echo "   <a href=\"". base_url()."index.php/submissao/download/".$ult_sub['submissao_id'] ."\"><button class =\"btn btn-xs btn-success\">Download</button></a>"; }
                    echo "  <a href=\"".base_url()."index.php/grupo/show/".$row->grupo_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                    <a href=\"".base_url()."index.php/grupo/delete/".$trabalho_id."/".$row->grupo_id ."\"><button class =\"btn btn-xs btn-danger\" onClick=\"return confirm('Are you sure?')\">Delete</button></a>";
                }                            
                elseif ($this->session->userdata('type') == 'S') {
                    $autorizado = $this->aluno_model->isAGrupoFromAluno($row->grupo_id, $this->session->userdata('id'));
                    $agora = date("Y-m-d H:i:s");
                    if ($autorizado) {
                        echo "<a href=\"".base_url()."index.php/grupo/show/".$row->grupo_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>";
                        if($agora < $trabalho['limitesubmissao'] || $trabalho['atraso'] != 1) { echo " <a href=\"".base_url()."index.php/submissao/form/".$row->grupo_id ."\"><button class =\"btn btn-xs btn-success\">Add Submission</button></a>"; }
                        if($agora < $trabalho['datagrupos']) { echo " <a href=\"".base_url()."index.php/grupo/unregister/".$row->grupo_id ."\"><button class =\"btn btn-xs btn-danger\">Unregister</button></a>"; }
                    }
                    else {
                        if (!$temGrupo) {
                            if($agora < $trabalho['datagrupos']) { echo "<a href=\"".base_url()."index.php/grupo/register/".$row->grupo_id ."\"><button class =\"btn btn-xs btn-info\">Register</button></a>"; }      
                        }
                    }
                }
                echo "</td>";
                echo "</tr>"; 
            }
            echo "</tbody>";  
            echo "</table>";
            if ($this->session->userdata('type') == "A" || $this->session->userdata('type') == 'T') {
                if(count($this->trabalho_model->getUltimasSubmissoesFromTrabalho($trabalho_id)) != 0) {
                    echo "<a href=\"".base_url()."index.php/submissao/downloadLatest/".$trabalho_id ."\"><button class =\"btn btn-xs btn-success\" style='float: right;'>Download Latest Submissions</button></a>";
                }
            }
        }
        ?>
    </div>
    <?php
        if($penalizacoes) { 
            echo "Notes:</br>   I: Evaluation with penalization from delay in submission.";
            echo "</br></br>";
        }
    ?>
    <script type="text/javascript">$('.btn').popover({html : true});</script>
</div>