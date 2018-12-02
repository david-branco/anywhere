<div class ="container">
    <h1 style="text-align:center"><?php echo $title ?></h1>
    <?php
        echo "<div class =\"col-md-5 col-md-offset-2\">";
        $attributes = array('class' => 'form-horizontal', 'id' => 'myform', 'role' => 'form');
        echo form_open(base_url() ."index.php/contacto/email/".$receiver."/".$id, $attributes);        

        if($this->session->userdata('logged')) {
            if($this->session->userdata('type') == "T") {
                $entidade = $this->docente_model->getDocente($this->session->userdata('id'));
            }
            else { $entidade = $this->aluno_model->getAluno($this->session->userdata('id')); }


            echo "<div class=\"form-group\">";
            $attributes = array('class' => 'col-sm-4 control-label');
            echo form_label("Name*: ", "nome", $attributes);
            $data = array(
                "name" => "nome",
                "id" => "nome",
                "class" => "form-control input-sm",
                "value" => $entidade['nome'],
                "placeholder" => "Insert your name"
            );
            echo "<div class=\"col-sm-8\">";
            echo form_input($data);
            echo "</div>";
            echo form_error("nome");
            echo "</div>";

            echo "<div class=\"form-group\">";
            $attributes = array('class' => 'col-sm-4 control-label');
            echo form_label("Email*: ", "email", $attributes);
            $data = array(
                "name" => "email",
                "id" => "email",
                "class" => "form-control input-sm",
                "value" => $entidade['email'],
                "placeholder" => "Insert your email"
            );
            echo "<div class=\"col-sm-8\">";
            echo form_input($data);
            echo "</div>";
            echo form_error("email");
            echo "</div>";
        }

        else {
            echo "<div class=\"form-group\">";
            $attributes = array('class' => 'col-sm-4 control-label');
            echo form_label("Name*: ", "nome", $attributes);
            $data = array(
                "name" => "nome",
                "id" => "nome",
                "class" => "form-control input-sm",
                "value" => set_value("nome"),
                "placeholder" => "Insert your name"
            );
            echo "<div class=\"col-sm-8\">";
            echo form_input($data);
            echo "</div>";
            echo form_error("nome");
            echo "</div>";

            echo "<div class=\"form-group\">";
            $attributes = array('class' => 'col-sm-4 control-label');
            echo form_label("Email*: ", "email", $attributes);
            $data = array(
                "name" => "email",
                "id" => "email",
                "class" => "form-control input-sm",
                "value" => set_value("email"),
                "placeholder" => "Insert your email"
            );
            echo "<div class=\"col-sm-8\">";
            echo form_input($data);
            echo "</div>";
            echo form_error("email");
            echo "</div>";
        }

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Subject*: ", "assunto", $attributes);
        $data = array(
            "name" => "assunto",
            "id" => "assunto",
            "class" => "form-control input-sm",
            "value" => set_value("assunto"),
            "placeholder" => "Insert the email subject"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("token");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Message*: ", "mensagem", $attributes);
        $data = array(
            "name" => "mensagem",
            "id" => "mensagem",
            "class" => "form-control input-sm",
            "value" => set_value("mensagem"),
            "placeholder" => "Insert your Message"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_textarea($data);
        echo "</div>";
        echo form_error("mensagem");
        echo "</div>";

        echo "<div class=\"form-group\">";
        echo "<div class=\"col-sm-offset-2 col-sm-10\">";
        $attributes = array('class' => 'btn btn-primary btn-sm', 'name' => "contact", 'value' => 'Send Email');
        echo form_submit($attributes);
        echo "</div>";
        echo "</div>";
        //echo validation_errors();
        echo form_close();
        echo "</div>";
    ?> 
</div>