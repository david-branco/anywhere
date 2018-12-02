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
        echo form_open_multipart(base_url() ."index.php/submissao/form/$id_grupo", $attributes); 

        if ($this->session->userdata('type') == 'A') {
            echo "<div class=\"form-group\">";
            $attributes = array('class' => 'col-sm-4 control-label');
            echo form_label("Work Team: ", "grupo", $attributes);

            $grupos = $this->grupo_model->getGrupos();
            foreach($grupos as $grup) {
                $data[$grup->grupo_id] = "ID: " .$grup->grupo_id . "  - Name: ". $grup->nome;
            }

            echo "<div class=\"col-sm-8\">";
            echo form_dropdown('grupo', $data, $id_grupo , 'class="form-control input-sm"');
            echo "</div>";
            echo form_error("grupo");
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
        echo form_label("Choose Files*: ", "file", $attributes);
        $data = array(
            "name" => "file",
            "id" => "file",
            "class" => "form-control input-sm",
            "value" => set_value("file"),            
            "placeholder" => "Select Files"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_upload($data);
        echo "</div>";
        echo form_error("file");
        echo $message;
        echo "</div>";        

        echo "<div class=\"form-group\">";
        echo "<div class=\"col-sm-offset-2 col-sm-10\">";
        $attributes = array('class' => 'btn btn-primary', 'name' => "addSubmissaoSubmit", 'value' => 'Save ' .$title);
        echo form_submit($attributes);
        echo "</div>";
        echo "</div>";
        //echo validation_errors();
        if (!empty($messagem)) {
            echo "<p class='alert alert-danger'>".$messagem."</p>";
        }
        echo form_close();
        echo "</div>";
    ?> 
</div>