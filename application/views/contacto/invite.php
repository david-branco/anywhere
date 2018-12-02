<div class ="container">
    <h1 style="text-align:center"><?php echo $title ?></h1>
    <?php
        echo "<div class =\"col-md-5 col-md-offset-2\">";
        $attributes = array('class' => 'form-horizontal', 'id' => 'myform', 'role' => 'form');
        echo form_open(base_url() ."index.php/contacto/convites/".$id_disciplina, $attributes);        

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Emails List*: ", "emails", $attributes);
        $data = array(
            "name" => "emails",
            "id" => "emails",
            "class" => "form-control input-sm",
            "value" => set_value("emails"),
            "placeholder" => "Insert emails separated by commas",
            "rows" => '7'
        );
        echo "<div class=\"col-sm-8\">";
        echo form_textarea($data);
        echo "</div>";
        echo form_error("emails");
        echo "</div>";

        echo "<div class=\"form-group\">";
        echo "<div class=\"col-sm-offset-2 col-sm-10\">";
        $attributes = array('class' => 'btn btn-primary btn-sm', 'name' => "invite", 'value' => 'Send Emails');
        echo form_submit($attributes);
        echo "</div>";
        echo "</div>";
        //echo validation_errors();
        echo form_close();
        echo "</div>";
    ?> 
</div>