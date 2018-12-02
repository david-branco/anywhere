<div class ="container">
    <?php 
        if (!empty($this->session->flashdata('message'))) {
            echo "<p class='alert alert-info'>".$this->session->flashdata('message')."</p>";
        }
    ?>
    <h1 style="text-align: center"><?php echo $trabalho['nome']; ?></h1>
    <div class ="col-md-12">
        <div class ="row paragraph" style ="padding: 0; margin: 0;"><div class ="bold">Theme: </div><?php echo $trabalho['tema']; ?></div>
        <div class ="row paragraph" style ="padding: 0; margin: 0;"><div class ="bold">Description: </div><?php echo $trabalho['descricao']; ?></div>
        <div class ="row paragraph" style ="padding: 0; margin: 0;"><div class ="bold">Initial date: </div><?php echo $trabalho['datainicial']; ?></div>
        <div class ="row paragraph" style ="padding: 0; margin: 0;"><div class ="bold">Repository: </div><?php echo $this->trabalho_model->showVisibilidade($trabalho['visibilidade']);?></div>
        <div class ="row paragraph" style ="padding: 0; margin: 0;"><div class ="bold">Class: </div><?php echo $disciplina->nome;?></div>
        <div class ="row paragraph" style ="padding: 0; margin: 0;"><div class ="bold">Teachers: </div></div>
        <?php foreach ($docentes as $docente) { ?>
                <div class="row" style ="margin: 0; padding: 0;">
                    <a href="<?php echo base_url(). "index.php/docente/profile/". $docente->docente_id ?>"><p class ="paragraph"><?php echo $docente->nome ?></p></a>
                </div>
            <?php } ?>
        <div class ="row" style ="padding: 0; margin: 0;">
            <?php if ($this->trabalho_model->showVisibilidade($trabalho['visibilidade']) == "Public" AND $trabalho['datarepositorio'] <= date('Y-m-d H:i:s') ) { ?> 
                <h3>Submissions</h3>
                <hr class ="style-eight">
                <?php
                    foreach ($submissoes as $submissao) {
                        $sub = $this->submissao_model->getSubmissao($submissao->submissao_id);
                ?>
                        <div class="row" style ="margin: 0; padding: 0; padding-top: 5px;">
                            <div class ="col-md-8" style ="padding-left: 0; padding-right:0 ">
                                <p title ="<?php echo $disciplina->nome; ?>" class ="paragraph"><?php echo $sub['nome']; ?></p>
                            </div>
                            <div class ="col-md-2">
                                <button class ="btn pull-right btn-xs btn-info">Inspect</button>
                            </div>
                            <div class ="col-md-2" style ="padding-left: 2px;">
                                <a href ="<?php echo base_url() . $sub['url'] ?>"><button class ="btn btn-xs btn-success">Download</button></a>
                            </div>
                        </div>
                <?php
                    }
                ?>
            <?php } else { ?>
                <h4>The submissions are private. For more details contact the teaching team.</h4>
                <div class="row" style ="margin: 0; padding: 0;">
                    <h3>Contact Teachers</h3>
                    <hr class ="style-eight">
                </div>
            <?php } ?>
        </div>
    </div>
</div>