    <div class ="container">
    <h1 style="text-align:center"><?php echo $title ?></h1>
 
    <?php
        $this->load->helper("form");
        echo "<div class =\"col-md-5 col-md-offset-2\">";
        $attributes = array('class' => 'form-horizontal', 'id' => 'myform', 'role' => 'form');
        echo form_open_multipart(base_url() ."index.php/docente/quickRegister", $attributes);        

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Email*: ", "email", $attributes);
        $data = array(
            "name" => "email",
            "id" => "email",
            "class" => "form-control input-sm",
            "value" => set_value("email", $email),            
            "placeholder" => "Insert your Email"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("email");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Password*: ", "password", $attributes);
        $data = array(
            "name" => "password",
            "class" => "form-control input-sm",
            "id" => "password",
            "value" => set_value("password"),            
            "placeholder" => "Insert your Password"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_password($data);
        echo "</div>";
        echo form_error("password");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Confirm Password*: ", "confpassword", $attributes);
        $data = array(
            "name" => "confpassword",
            "id" => "confpassword",
            "class" => "form-control input-sm",
            "value" => set_value("confpassword"),            
            "placeholder" => "Confirm your Password"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_password($data);
        echo "</div>";
        echo form_error("confpassword");
        echo "</div>";

        echo "<div class=\"form-group\">";
        echo "<div class=\"col-sm-offset-2 col-sm-10\">";
        $attributes = array('class' => 'btn btn-primary', 'name' => "quickDocenteSubmit", 'value' => 'Continue Registration');
        echo form_submit($attributes);
        //echo validation_errors();
        echo "</div>";
        echo "</div>";
        echo form_close();
        echo "</div>";
    ?> 
</div>