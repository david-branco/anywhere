<div class ="container">
    <h1 style="text-align:center"><?php echo $title ?></h1>

    <?php        
        echo "<div class =\"col-md-5 col-md-offset-2\">";
        $attributes = array('class' => 'form-horizontal', 'id' => 'myform', 'role' => 'form');
        echo form_open(base_url() ."index.php/disciplina/unenroll/".$tipo_user, $attributes);
   
        if ($this->session->userdata('type') == 'A') {
            echo "<div class=\"form-group\">";
            $attributes = array('class' => 'col-sm-4 control-label');
            echo form_label("User: ", "id_user", $attributes);

            if($tipo_user == "1") {
                $docentes = $this->docente_model->getDocentes();
                foreach($docentes as $docente) {
                    $data[$docente->docente_id] = "ID: " .$docente->docente_id . "  - Name: ". $docente->nome;
                }
            }
            else {
                $alunos = $this->aluno_model->getAlunos();
                foreach($alunos as $aluno) {
                    $data[$aluno->aluno_id] = "ID: " .$aluno->aluno_id . "  - Name: ". $aluno->nome;
                }                
            }

            echo "<div class=\"col-sm-8\">";
            echo form_dropdown('id_user', $data, $id_user , 'class="form-control input-sm"');
            echo "</div>";
            echo form_error("id_user");
            echo "</div>";     
        }

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Class Token*: ", "token", $attributes);
        $data = array(
            "name" => "token",
            "id" => "token",
            "class" => "form-control input-sm",
            "value" => set_value("token"),
            "placeholder" => "Insert Class Token"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("token");
        echo "</div>";

        echo "<div class=\"form-group\">";
        echo "<div class=\"col-sm-offset-2 col-sm-10\">";
        $attributes = array('class' => 'btn btn-primary', 'name' => "unenrollSubmit", 'value' => 'Unenroll');
        echo form_submit($attributes);
        echo "</div>";
        echo "</div>";
        //echo validation_errors();
        if (!empty($message)) {
            echo "<p class='alert alert-danger'>".$message."</p>";
        }
        echo form_close();
        echo "</div>";
    ?> 
</div>