<div class ="container">
    <a href="<?php echo base_url()."index.php/disciplina/show/".$disciplina['disciplina_id'] ?>"><button class ="btn btn-xs btn-primary">Show Class</button></a>
    <?php 
        if (!empty($this->session->flashdata('message'))) {
            echo "<p class='alert alert-info'>".$this->session->flashdata('message')."</p>";
        }
    ?>
    <a href="<?php echo base_url()."index.php/disciplina/downloadPDF/".$disciplina['disciplina_id'] ?>"><button class ="btn btn-xs btn-success">Download PDF</button></a>
    <a href="<?php echo base_url()."index.php/disciplina/downloadXML/".$disciplina['disciplina_id'] ?>"><button class ="btn btn-xs btn-success">Download XML</button></a>
    <a href="<?php echo base_url()."index.php/disciplina/uploadXML/".$disciplina['disciplina_id'] ?>"><button class ="btn btn-xs btn-info">Upload XML</button></a>
    <h1 style="text-align: center"><?php echo $disciplina['nome']." - ".$disciplina['anoletivo'] ?></h1>
    <h3 style="text-align: center"><?php echo $disciplina['curso']." - ".$disciplina['instituicao'] ?></h1>
    <div class ="col-md-14">
        <table class="table table-bordered"> 
            <thead>  
              <tr>
                <th>Name</th>                  
                <th>Number</th>
                <?php foreach($trabalhos as $trabalho) { echo "<th>".$trabalho->nome." (".$trabalho->pesonota."%)</th>"; } ?>   
                <th>Final Evaluation</th> 
              </tr>  
            </thead>
            <tbody>
                <?php
                    $penalizacoes = false;
                    foreach($alunos as $aluno) {
                    $total = 0;
                    echo "<tr>";
                        echo "<td>" . $aluno->nome . "</td>";
                        echo "<td>" . $aluno->naluno . "</td>";
                        foreach($trabalhos as $trabalho) {
                            $avaliacao = $this->trabalho_model->getAvaliacaoFromAlunoFromTrabalho($aluno->aluno_id, $trabalho->trabalho_id);
                            $grupo = $this->trabalho_model->getGrupoFromAlunoFromTrabalho($aluno->aluno_id, $trabalho->trabalho_id);
                            if(!empty($grupo)) { $submissao = $this->grupo_model->getUltimaSubmissaoFromGrupo($grupo['grupo_id']); }
                            else { $submissao = array(); }
                            if(!empty($avaliacao)) {
                                if($trabalho->atraso == 3 && !empty($submissao) && $submissao['data'] > $trabalho->datafinal) { 
                                    $penalizacoes = true; 
                                    $nota = $avaliacao['avaliacao'] - ($avaliacao['avaliacao']*($trabalho->desconto/100));
                                    $total += ($trabalho->pesonota)/100 * $nota;
                                    echo "<td align=\"center\">". $nota ."  (I)</td>";
                                }
                                else {
                                    echo "<td align=\"center\">" . $avaliacao['avaliacao'] . "</td>";
                                    $total += ($trabalho->pesonota)/100 * $avaliacao['avaliacao'];
                                }
                            }
                            else { echo "<td></td>"; }
                        }
                        echo "<td align=\"center\">" . $total . "</td>";
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

