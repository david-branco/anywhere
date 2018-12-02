<div class ="container-fluid" style ="padding: 15px;">
    <?php 
        if (!empty($this->session->flashdata('message'))) {
            echo "<p class='alert alert-info'>".$this->session->flashdata('message')."</p>";
        }
    ?>
    <div class ="row well" style ="padding-bottom: 10px; padding-top: 10px;">
        <div class ="col-md-12" style ="padding: 0">
            <div class ="col-md-3" style ="padding-top: 20px; padding-bottom: 5px;">
                <?php
                if (empty($aluno['foto'])) { ?>
                    <img border="0" src="<?php echo base_url() . "uploads/photos/defaultphoto.png" ?>" alt="Student Photo" width="200" height="110"/>
                <?php } else { ?>
                    <img border="0" src="<?php echo base_url() . $aluno['foto'] ?>" alt="Student Photo" width="200" height="110"/>                     
                <?php } ?>
            </div>
            <div class ="col-md-5" style ="padding-top: 20px; padding-bottom: 5px;">
                <div class ="row" style ="padding: 0; margin: 0"><h3 style ="margin: 0"><?php echo $aluno['nome'];?></h3></div>
                <div class ="row" style ="padding: 0; margin: 0; margin-top: 3px"><p class ="paragraph" style ="margin: 0"><?php echo $aluno['instituicao'];?></p></div>
                <div class ="row" style ="padding: 0; margin: 0; margin-top: 3px"><p class ="paragraph" style ="margin: 0"><?php echo $aluno['curso'];?></p></div>
                <div class ="row" style ="padding: 0; margin: 0; margin-top: 3px"><p class ="paragraph" style ="margin: 0"><?php echo $aluno['email'];?></p></div>
                <div class ="row" style ="padding: 0; margin: 0; margin-top: 3px"><p class ="paragraph" style ="margin: 0"><?php echo $aluno['website'];?></p></div>
            </div>
        </div>
    </div>
    <div class ="row">
        <div class ="col-md-7 col-md-offset-1">
            <div class="row" style ="margin: 0; padding: 0;">
                <h3>About</h3>
                <hr class ="style-eight">
                <p class ="paragraph" style ="margin: 0"><?php echo $aluno['sobre'];?></p>
            </div>
            <div class="row" style ="margin: 0; padding: 0;">
                <h3>Classes list</h3>
                <hr class ="style-eight">
                <?php 
                    foreach ($disciplinas as $disciplina) {
                ?>
                        <div class="row" style ="margin: 0; padding: 0;">
                            <div class ="col-md-10" style ="padding-left: 0; padding-right:0 ">
                                <p title ="<?php echo $disciplina->nome; ?>" class ="paragraph"><?php echo $disciplina->nome . 
                                " - <div class =\"bold\">" . $disciplina->instituicao . "</div> - " . $disciplina->curso; ?></p>
                            </div>
                            <div class ="col-md-2">
                                <a href="<?php echo base_url() . "index.php/disciplina/profile/" . $disciplina->disciplina_id; ?>"><button class ="btn pull-right btn-xs btn-info">Show</button></a>
                            </div>
                        </div>
                <?php
                    }
                ?>
            </div>
            <div class="row" style ="margin: 0; padding: 0;">
                <h3>Contact me</h3>
                <hr class ="style-eight">
            </div>
        </div>
        <div class ="col-md-2 col-md-offset-1">
            <h3>Themes<small> developed works</small></h3>
            <hr class ="style-eight">
            <?php foreach ($temas as $tema) { ?>
                <div class="row" style ="margin: 0; padding: 0;">
                    <a href="<?php echo base_url() . "index.php/frontpage/search?search=" . $tema->tema; ?>"><p class ="tag" style="background-color: #402A07;"><?php echo $tema->tema ?></p></a>
                </div>
            <?php } ?>
        </div>
    </div>   
</div>