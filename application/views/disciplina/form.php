<div class ="container">
    <h1 style="text-align:center"><?php echo $title ?></h1>

    <?php        
        echo "<div class =\"col-md-5 col-md-offset-2\">";
        $attributes = array('class' => 'form-horizontal', 'id' => 'myform', 'role' => 'form');
        echo form_open_multipart(base_url() ."index.php/disciplina/form/$disciplina_id", $attributes);        

        if ($this->session->userdata('type') == 'A' & empty($disciplina_id)) {
            echo "<div class=\"form-group\">";
            $attributes = array('class' => 'col-sm-4 control-label');
            echo form_label("Teacher: ", "docente", $attributes);

            $docentes = $this->docente_model->getDocentes();
            foreach($docentes as $doc) {
                $data[$doc->docente_id] = "ID: " .$doc->docente_id . "  - Name: ". $doc->nome;
            }

            echo "<div class=\"col-sm-8\">";
            echo form_dropdown('docente', $data, $docente_id , 'class="form-control input-sm"');
            echo "</div>";
            echo form_error("docente");
            echo "</div>";     
        }

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Name*: ", "nome", $attributes);
        $data = array(
            "name" => "nome",
            "id" => "nome",
            "class" => "form-control input-sm",
            "value" => set_value("nome", $nome),
            "placeholder" => "Insert Class Name"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("nome");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Class Code*: ", "coduc", $attributes);
        $data = array(
            "name" => "coduc",
            "id" => "coduc",
            "class" => "form-control input-sm",
            "value" => set_value("coduc", $coduc),            
            "placeholder" => "Insert Class Code"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("coduc");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Academic Year*: ", "anoletivo", $attributes);
        $data = array(
            "name" => "anoletivo",
            "id" => "anoletivo",
            "class" => "form-control input-sm",
            "value" => set_value("anoletivo", $anoletivo),            
            "placeholder" => "Insert Academic Year"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("anoletivo");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Course*: ", "curso", $attributes);
        $data = array(
            "name" => "curso",
            "id" => "curso",
            "class" => "form-control input-sm",
            "value" => set_value("curso",$curso),            
            "placeholder" => "Insert Course"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("curso");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Institution*: ", "instituicao", $attributes);
        $data = array(
            "name" => "instituicao",
            "class" => "form-control input-sm",
            "id" => "instituicao",
            "value" => set_value("instituicao",$instituicao),            
            "placeholder" => "Insert Institution"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("instituicao");
        echo "</div>";

        echo "<div class=\"form-group\">";
        echo "<div class=\"col-sm-offset-2 col-sm-10\">";
        $attributes = array('class' => 'btn btn-primary', 'name' => "addDisciplinaSubmit", 'value' => 'Save ' .$title);
        echo form_submit($attributes);
        echo "</div>";
        echo "</div>";
        //echo validation_errors();
        echo form_close();
        echo "</div>";
    ?> 
</div>