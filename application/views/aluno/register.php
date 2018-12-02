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
        echo form_open_multipart(base_url() ."index.php/aluno/register/$aluno_id", $attributes);        
        
        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Full Name*: ", "nome", $attributes);
        $data = array(
            "name" => "nome",
            "class" => "form-control input-sm",
            "id" => "nome",
            "value" => set_value("nome",$nome),
            "placeholder" => "Insert your Full Name"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("nome");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Student Number*: ", "naluno", $attributes);
        $data = array(
            "name" => "naluno",
            "id" => "naluno",
            "class" => "form-control input-sm",
            "value" => set_value("naluno", $naluno),            
            "placeholder" => "Insert your Student Number"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("naluno");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Course*: ", "curso", $attributes);
        $data = array(
            "name" => "curso",
            "id" => "curso",
            "class" => "form-control input-sm",
            "value" => set_value("curso",$curso),            
            "placeholder" => "Insert your Course"
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
            "id" => "instituicao",
            "class" => "form-control input-sm",
            "value" => set_value("instituicao",$instituicao),            
            "placeholder" => "Insert your Institution"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("instituicao");
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
        echo form_label("Status: ", "estatuto", $attributes);
        $data = array(
            "1" => "Ordinary",
            "2" => "Employed",
            "3" => "Military",
            "4" => "With a Disability",
            "5" => "Association Member",
            "6" => "Member of Collegial Body",
            "7" => "Other"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_dropdown('estatuto', $data, set_value('estatuto'),'class="form-control"',$estatuto);
        echo "</div>";
        echo form_error("estatuto");
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
            "value" => set_value("foto",$foto),            
            "placeholder" => "Insert your Photo"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_upload($data);
        echo "</div>";
        echo form_error("foto");
        echo $message;
        echo "</div>";
        echo "</div>";

        echo "<div class=\"form-group\">";
        echo "<div class=\"col-sm-offset-2 col-sm-10\">";
        $attributes = array('class' => 'btn btn-primary', 'name' => "addAlunoSubmit", 'value' => 'Save ' .$title);
        echo form_submit($attributes);
        echo "</div>";
        echo "</div>";
        //echo validation_errors();
        echo form_close();
        echo "</div>";
    ?>
</div>