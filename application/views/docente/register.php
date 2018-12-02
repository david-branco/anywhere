<div class ="container">
    <?php 
        if (!empty($this->session->flashdata('message'))) {
            echo "<p class='alert alert-info'>".$this->session->flashdata('message')."</p>";
        }
    ?>
    <h1 style="text-align:center"><?php echo $title ?></h1>
    <script>
        $(document).ready(function() {
            $("button").click(function() {
                $( "#maisopcoes" ).slideToggle( "slow" );
            });
            CKEDITOR.replace('sobre');
        });
    </script>
 
    <?php        
        if(!empty(validation_errors())) {
    ?>
        <script>
            $(document).ready(function() {
                $("#maisopcoes").slideToggle("slow");
            });
        </script>
    <?php
        }        
        echo "<div class =\"col-md-5 col-md-offset-2\">";
        $attributes = array('class' => 'form-horizontal', 'id' => 'myform', 'role' => 'form');
        echo form_open_multipart(base_url() ."index.php/docente/register/$docente_id", $attributes);        

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Full Name*: ", "nome", $attributes);
        $data = array(
            "name" => "nome",
            "class" => "form-control input-sm",
            "id" => "nome",
            "value" => set_value("nome", $nome),
            "placeholder" => "Insert your Full Name"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("nome");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Teacher Number*: ", "ndocente", $attributes);
        $data = array(
            "name" => "ndocente",
            "id" => "ndocente",
            "class" => "form-control input-sm",
            "value" => set_value("ndocente", $ndocente),            
            "placeholder" => "Insert your Teacher Number"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("ndocente");
        echo "</div>";

        echo "<button class ='btn btn-xs btn-warning maisOpcoes' type='button'>More Options</button></a>";
        echo "<div id=\"maisopcoes\">";
        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Website: ", "website", $attributes);
        $data = array(
            "name" => "website",
            "id" => "website",
            "class" => "form-control input-sm",
            "value" => set_value("website", $website),            
            "placeholder" => "Insert your Website"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("website");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("CV: ", "cv", $attributes);
        $data = array(
            "name" => "cv",
            "id" => "cv",
            "class" => "form-control input-sm",
            "value" => set_value("cv",$cv),            
            "placeholder" => "Insert your Curriculum Vitae"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("cv");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Contacts: ", "contatos", $attributes);
        $data = array(
            "name" => "contatos",
            "id" => "contatos",
            "class" => "form-control input-sm",
            "value" => set_value("contatos",$contatos),            
            "placeholder" => "Insert your Other Contacts"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("contatos");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("myAcademia profile: ", "myAcademia", $attributes);
        $data = array(
            "name" => "myAcademia",
            "id" => "myAcademia",
            "class" => "form-control input-sm",
            "value" => set_value("myAcademia", $myAcademia),
            "placeholder" => "Insert your myAcademia profile"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("myAcademia");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("About: ", "sobre", $attributes);
        $data = array(
            "name" => "sobre",
            "id" => "sobre",
            "class" => "form-control input-sm",
            "value" => set_value("sobre", $sobre),
            "placeholder" => "Insert some information about yourself"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_textarea($data);
        echo "</div>";
        echo form_error("sobre");
        echo "</div>";    

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Choose Photo: ", "foto", $attributes);
        $data = array(
            "name" => "foto",
            "id" => "foto",
            "class" => "form-control input-sm",
            "value" => set_value("foto", $foto),            
            "placeholder" => "Insert your Photo"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_upload($data);
        echo "</div>";
        echo form_error("foto");
        echo "</div>";
        echo "</div>";

        echo "<div class=\"form-group\">";
        echo "<div class=\"col-sm-offset-2 col-sm-10\">";
        $attributes = array('class' => 'btn btn-primary', 'name' => "addDocenteSubmit", 'value' => 'Save ' .$title);
        echo form_submit($attributes);
        //echo validation_errors();
        echo "</div>";
        echo "</div>";
        echo $message;
        echo form_close();
        echo "</div>";
    ?> 
</div>