<div class ="container">
    <h1 style ="text-align: center;"><?php echo $title ?></h1>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('descricao');
        });
    </script>    
    <?php        
        echo "<div class =\"col-md-5 col-md-offset-2\">";
        $attributes = array('class' => 'form-horizontal', 'id' => 'myform', 'role' => 'form');
        echo form_open_multipart(base_url() ."index.php/ficheiro/form/$id_trabalho/$id_ficheiro", $attributes); 

        if ($this->session->userdata('type') == 'A') {
            echo "<div class=\"form-group\">";
            $attributes = array('class' => 'col-sm-4 control-label');
            echo form_label("Work: ", "trabalho", $attributes);

            $trabalhos = $this->trabalho_model->getTrabalhos();
            foreach($trabalhos as $trab) {
                $data[$trab->trabalho_id] = "ID: " .$trab->trabalho_id . "  - Name: ". $trab->nome;
            }

            echo "<div class=\"col-sm-8\">";
            echo form_dropdown('trabalho', $data, $id_trabalho , 'class="form-control input-sm"');
            echo "</div>";
            echo form_error("trabalho");
            echo "</div>";     
        }

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Description: ", "descricao", $attributes);
        $data = array(
            "name" => "descricao",
            "id" => "descricao",
            "class" => "form-control input-sm",
            "value" => set_value("descricao", $descricao),
            "placeholder" => "Insert a description of the file",
            "rows" => '6'
        );
        echo "<div class=\"col-sm-8\">";
        echo form_textarea($data);
        echo "</div>";
        echo form_error("descricao");
        echo "</div>";
        
        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Choose File*: ", "file", $attributes);
        $data = array(
            "name" => "file",
            "id" => "file",
            "class" => "form-control input-sm",
            "value" => set_value("file"),            
            "placeholder" => "Select File"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_upload($data);
        echo "</div>";
        echo form_error("file");
        echo $message;
        echo "</div>";        

        echo "<div class=\"form-group\">";
        echo "<div class=\"col-sm-offset-2 col-sm-10\">";
        $attributes = array('class' => 'btn btn-primary', 'name' => "addFicheiroSubmit", 'value' => 'Save File');
        echo form_submit($attributes);
        echo "</div>";
        echo "</div>";
        //echo validation_errors();
        echo form_close();
        echo "</div>";
    ?> 
</div>