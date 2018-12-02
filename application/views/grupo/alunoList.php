<div class ="container">
    <h1 style ="text-align: center;"><?php echo $title ?></h1>
    <div class ="col-md-12">

        <?php
            if(empty($results)) { 
                echo "<h4 style='text-align:center'>There's no students enrolled</h4>";
            }
            else {
                echo "<table class='table table-striped'>";  
                echo "<thead>";  
                echo "<tr>";  
                echo "<th>Foto</th>";
                echo "<th>Name</th>";
                echo "<th>Email</th>";
                echo "<th>Course</th>";
                echo "<th>Instituiton</th>";
                echo "<th>Evaluation</th>";
                echo "<th style='width:20%; text-align:center'>Tools</th>";                
                echo "</tr>";  
                echo "</thead>";  
                echo "<tbody>";
                $penalizacoes = false;
                foreach ($results as $row) {
                	$avaliacao = $this->trabalho_model->getAvaliacaoFromAlunoFromTrabalho($row->aluno_id, $trabalho['trabalho_id']);                   
                    $submissao = $this->grupo_model->getUltimaSubmissaoFromGrupo($id_grupo);
                    echo "<tr>";
                    if (empty($row->foto)) {
                        echo "<td> <img border=\"0\" src=\" " .base_url()."uploads/photos/defaultphoto.png\" alt=\"User Default Photo\" width=\"40\" height=\"30\"/> </td>";     
                    }
                    else {
                        echo "<td> <img border=\"0\" src=\" " . base_url() . $row->foto . "\" alt=\"Student Photo\" width=\"40\" height=\"30\"/> </td>";                     
                    }
                    echo "<td>" . $row->nome . "</td>";
                    echo "<td>" . $row->email . "</td>";
                    echo "<td>" . $row->curso . "</td>";
                    echo "<td>" . $row->instituicao . "</td>";
                    if(!empty($avaliacao)) {
                        if($trabalho['atraso'] == 3 && !empty($submissao) && $submissao['data'] > $trabalho['datafinal']) {
                            $penalizacoes = true; 
                            $nota = $avaliacao['avaliacao'] - ($avaliacao['avaliacao']*($trabalho['desconto']/100));
                            echo "<td>". $nota ."  (I)</td>";
                        }
                        else { echo "<td>".$avaliacao['avaliacao']."</td>"; }
                    }
                    else { echo "<td></td>"; }
                    echo "<td style='width:20%; text-align:right'>";
                    if($this->session->userdata('type') != 'S') { ?>
                       <button type ="button"
                class ="btn btn-warning btn-xs"
                data-container="body"
                data-toggle="popover" data-placement="left" 
                data-content="<form class='form-inline' role='form' method = 'POST' action ='<?php echo base_url() . 'index.php/aluno/evaluate/'.$row->aluno_id.'/'.$trabalho['trabalho_id'] ?>'>
                            <div class='form-group'>
                            <input type='text' class ='form-control' name ='avaliacao' id ='avaliacao' placeholder='Evaluate this Student'/>
                            </div>
                            <button type='submit' class='btn btn-sm btn-primary'>Save</button>
                            </form>
                            ">
                Evaluate
            </button>
                    <?php
                    }
                    echo "<a href=\"".base_url()."index.php/aluno/show/".$row->aluno_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                    <a href=\"".base_url()."index.php/aluno/profile/".$row->aluno_id ."\"><button class =\"btn btn-xs btn-primary\">Profile</button></a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";  
                echo "</table>";
                if($penalizacoes) { 
                    echo "Notes:</br>   I: Evaluation with penalization from delay in submission.";
                    echo "</br></br>";
                }
            }
        ?>
        <script type="text/javascript">$('.btn').popover({html : true});</script>
</div>
</div>