<div class ="container">
    <h1 style ="text-align: center;"><?php echo $title ?></h1>
    
    <?php        
        echo "<div class =\"col-md-5 col-md-offset-2\">";
        $attributes = array('class' => 'form-horizontal', 'id' => 'myform', 'role' => 'form');
        echo form_open_multipart(base_url() ."index.php/trabalho/uploadXML/$id_trabalho", $attributes); 
        
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
        $attributes = array('class' => 'btn btn-primary', 'name' => "upFichXMLtrab", 'value' => 'Save File');
        echo form_submit($attributes);
        echo "</div>";
        echo "</div>";
        //echo validation_errors();
        if (!empty($messagedtd)) {
            echo "<p class='alert alert-danger'>".$messagedtd."</p>";
        }
        echo form_close();
        echo "</div>";
    ?> 
</div>