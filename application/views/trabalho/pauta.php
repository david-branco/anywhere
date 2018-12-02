<div class ="container">
    <a href="<?php echo base_url()."index.php/trabalho/show/".$trabalho['trabalho_id'] ?>"><button class ="btn btn-xs btn-primary">Show Work</button></a>
    <?php 
        if (!empty($this->session->flashdata('message'))) {
            echo "<p class='alert alert-info'>".$this->session->flashdata('message')."</p>";
        }
    ?>
    <a href="<?php echo base_url()."index.php/trabalho/downloadPDF/".$trabalho['trabalho_id'] ?>"><button class ="btn btn-xs btn-success">Download PDF</button></a>
    <a href="<?php echo base_url()."index.php/trabalho/downloadXML/".$trabalho['trabalho_id'] ?>"><button class ="btn btn-xs btn-success">Download XML</button></a>
    <a href="<?php echo base_url()."index.php/trabalho/uploadXML/".$trabalho['trabalho_id'] ?>"><button class ="btn btn-xs btn-info">Upload XML</button></a>
    <h1 style="text-align: center"><?php echo $disciplina->nome." - ".$disciplina->anoletivo ?></h1>
    <h3 style="text-align: center"><?php echo $disciplina->curso." - ".$disciplina->instituicao ?></h1>
    <h2 style="text-align: center"><?php echo $trabalho['nome']."<br/><br/>" ?></h1>
    <div class ="col-md-14">
        <table class="table table-bordered">
            <thead>  
              <tr>
                <th>Name</th>                  
                <th>Number</th>   
                <th>Work Team</th>   
                <th>Evaluation</th> 
              </tr>  
            </thead>
            <tbody>
                <?php
                    $penalizacoes = false;
                	foreach($alunos as $aluno) {
                		echo "<tr>";
	                		$avaliacao = $this->trabalho_model->getAvaliacaoFromAlunoFromTrabalho($aluno->aluno_id, $trabalho['trabalho_id']);
                            $grupo = $this->trabalho_model->getGrupoFromAlunoFromTrabalho($aluno->aluno_id, $trabalho['trabalho_id']);
                            if(!empty($grupo)) { $submissao = $this->grupo_model->getUltimaSubmissaoFromGrupo($grupo['grupo_id']); }
                            else { $submissao = array(); }
	                		echo "<td>" . $aluno->nome . "</td>";
	                		echo "<td>" . $aluno->naluno . "</td>";
                            if(!empty($grupo['nome'] )) {
	                		 echo "<td>" . $grupo['nome'] . "</td>";
                            }
                            else { echo "<td></td>"; }
	                		if(!empty($avaliacao)) {
                                if($trabalho['atraso'] == 3 && !empty($submissao) && $submissao['data'] > $trabalho['datafinal']) {
                                    $penalizacoes = true; 
                                    $nota = $avaliacao['avaliacao'] - ($avaliacao['avaliacao']*($trabalho['desconto']/100));
                                    echo "<td>". $nota ."  (I)</td>";
                                }
                                else { echo "<td>".$avaliacao['avaliacao']."</td>"; }
                            }
                            else { echo "<td></td>"; }
	                	echo "</tr>";
                	}                
                ?>
            </tbody>  
        </table>
        <?php
            if($penalizacoes) { 
                echo "Notes:</br>   I: Evaluation with penalization from delay in submission.";
                echo "</br></br>";
            }
        ?>
    </div>
</div>