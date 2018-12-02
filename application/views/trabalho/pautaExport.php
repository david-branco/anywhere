<!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="">
   <meta name="keywords" content="">
   <meta name="author" content="">

   <title>Anywhere</title>
   
   <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
   <link href="<?php echo base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
   <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">
   <link href="<?php echo base_url('assets/css/navbarCustom.css') ?>" rel="stylesheet">
   <link href="<?php echo base_url('assets/css/jquery-ui.css') ?>" rel="stylesheet">
   <link href="<?php echo base_url('assets/css/frontpage.css') ?>" rel="stylesheet">
   <link href="<?php echo base_url('assets/css/eventCalendar.css') ?>" rel="stylesheet">
   <link href="<?php echo base_url('assets/css/eventCalendar_theme_responsive.css') ?>" rel="stylesheet">
   <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC:800' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
   <script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/jquery-ui.js') ?>"></script>
   <script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/1.3.1/lodash.min.js"></script>
   <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/jquery.eventCalendar.js') ?>"></script>
</head>
<body>

<div class ="container">
    <h1 style="text-align: center"><?php echo $disciplina->nome." - ".$disciplina->anoletivo ?></h1>
    <h3 style="text-align: center"><?php echo $disciplina->curso." - ".$disciplina->instituicao ?></h1>
    <h2 style="text-align: center"><?php echo $trabalho['nome']."<br/><br/>" ?></h1>
    <div class ="col-md-14">
        <table class="table table-bordered">
            <thead>  
              <tr>
                <th width="45%">Name</th>                  
                <th width="15%">Number</th>   
                <th width="15%">Work Team</th>   
                <th width="20%">Evaluation</th> 
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
                      echo "<td width='45%'>" . $aluno->nome . "</td>";
                      echo "<td width='15%'>" . $aluno->naluno . "</td>";
                            if(!empty($grupo['nome'] )) {
                       echo "<td width='15%'>" . $grupo['nome'] . "</td>";
                            }
                            else { echo "<td width='15%'></td>"; }
                      if(!empty($avaliacao)) {
                                if($trabalho['atraso'] == 3 && !empty($submissao) && $submissao['data'] > $trabalho['datafinal']) {
                                    $penalizacoes = true; 
                                    $nota = $avaliacao['avaliacao'] - ($avaliacao['avaliacao']*($trabalho['desconto']/100));
                                    echo "<td width='20%'>". $nota ."  (I)</td>";
                                }
                                else { echo "<td width='20%'>".$avaliacao['avaliacao']."</td>"; }
                            }
                            else { echo "<td width='20%'></td>"; }
                    echo "</tr>";
                  }                
                ?>
            </tbody>  
        </table>
        <?php
            if($penalizacoes) {
                echo "<h5 style='text-align:left'>Notes:</h5></br>";
                echo "<h6 style='text-align:left'>I: Evaluation with penalization from delay in submission.</h6>";
                echo "</br></br>";
            }
        ?>
    </div>
</div>
</body>
</html>