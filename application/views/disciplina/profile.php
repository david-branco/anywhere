<div class ="container">
    <h1 style="text-align: center"><?php echo $disciplina['nome']; ?></h1>
    <div class ="col-md-12">
        <div class ="row paragraph" style ="padding: 0; margin: 0;"><div class ="bold">Academic year: </div><?php echo $disciplina['anoletivo']; ?></div>
        <div class ="row paragraph" style ="padding: 0; margin: 0;"><div class ="bold">Institution: </div><?php echo $disciplina['instituicao']; ?></div>
        <div class ="row paragraph" style ="padding: 0; margin: 0;"><div class ="bold">Course: </div><?php echo $disciplina['curso']; ?></div>
        <div class="row" style ="margin: 0; padding: 0;">
                <h3>Works</h3>
                <hr class ="style-eight">
                <?php 
                    foreach ($works as $work) {
                ?>
                        <div class="row" style ="margin: 0; padding: 0;">
                            <div class ="col-md-10" style ="padding-left: 0; padding-right:0 ">
                                <p title ="<?php echo $work->nome; ?>" class ="paragraph"><?php echo $work->nome . 
                                " - <div class =\"bold\">" . $work->tema . "</div>"; ?></p>
                            </div>
                            <div class ="col-md-2">
                                <a href="<?php echo base_url() . "index.php/trabalho/profile/" . $work->trabalho_id ?>"><button class ="btn pull-right btn-xs btn-info">Show</button></a>
                            </div>
                        </div>
                <?php
                    }
                ?>
            </div>
    </div>
</div>