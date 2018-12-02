<div class ="container">  
    <h1 style ="text-align: center;"><?php echo $title ?></h1>

    <?php        
        echo "<div class =\"col-md-5 col-md-offset-2\">";
        $attributes = array('class' => 'form-inline', 'id' => 'myform', 'role' => 'form');
        echo form_open_multipart(base_url() ."index.php/grupo/evaluate/".$grupo['grupo_id'], $attributes);        

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Evaluation: ", "avaliacao", $attributes);
        $data = array(
            "name" => "avaliacao",
            "id" => "avaliacao",
            "class" => "form-control input-sm",
            "value" => set_value("avaliacao"),
            "placeholder" => "Evaluate the Work Team"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("avaliacao");
        echo "</div>";

        echo "<div class=\"form-group\">";
        echo "<div class=\"col-sm-offset-2 col-sm-10\">";
        $attributes = array('class' => 'btn btn-success', 'name' => "evaluate", 'value' => 'Evaluate');
        echo form_submit($attributes);
        echo "</div>";
        echo "</div>";
        //echo validation_errors();
        echo form_close();
        echo "</div>";
    ?> 
</div>