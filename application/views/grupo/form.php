<div class ="container">  
    <?php 
        if (!empty($this->session->flashdata('message'))) {
            echo "<p class='alert alert-info'>".$this->session->flashdata('message')."</p>";
        }
    ?>  
    <h1 style ="text-align: center;"><?php echo $title ?></h1>

    <?php        
        echo "<div class =\"col-md-5 col-md-offset-2\">";
        $attributes = array('class' => 'form-horizontal', 'id' => 'myform', 'role' => 'form');
        echo form_open_multipart(base_url() ."index.php/grupo/form/$id_trabalho", $attributes);        

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
        echo form_label("Number of Work Teams*: ", "numero", $attributes);
        $data = array(
            "name" => "numero",
            "id" => "numero",
            "class" => "form-control input-sm",
            "value" => set_value("numero"),
            "placeholder" => "Insert the number of Work Teams"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("numero");
        echo "</div>";

        echo "<div class=\"form-group\">";
        echo "<div class=\"col-sm-offset-2 col-sm-10\">";
        $attributes = array('class' => 'btn btn-primary', 'name' => "addGruposSubmit", 'value' => 'Create ' .$title);
        echo form_submit($attributes);
        echo "</div>";
        echo "</div>";
        //echo validation_errors();
        echo form_close();
        echo "</div>";
    ?> 
</div>