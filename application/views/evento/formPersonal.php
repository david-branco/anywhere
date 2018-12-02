<div class ="container">   
    <h1 style ="text-align: center;"><?php echo $title ?></h1>
    <script>
        $(document).ready(function() {
            $("#dataEvento").datetimepicker({
                format: 'yyyy-mm-dd hh:ii',
                autoclose: true,
                todayBtn: true,
                pickerPosition: "bottom-left",
            });
        });
    </script>

    <?php        
        echo "<div class =\"col-md-5 col-md-offset-2\">";
        $attributes = array('class' => 'form-horizontal', 'id' => 'myform', 'role' => 'form');
        echo form_open_multipart(base_url() ."index.php/evento/formPersonal/$id_evento", $attributes);        

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Event*: ", "evento", $attributes);
        $data = array(
            "name" => "evento",
            "id" => "evento",
            "class" => "form-control input-sm",
            "value" => set_value("evento",$evento),
            "placeholder" => "Insert the Event"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("evento");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Date*: ", "dataEvento", $attributes);
        $data = array(
            "name" => "dataEvento",
            "id" => "dataEvento",
            "class" => "form-control input-sm",
            "value" => set_value("dataEvento",$dataEvento),            
            "placeholder" => "Insert Date to the Event"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("dataEvento");
        echo "</div>";

        echo "<div class=\"form-group\">";
        echo "<div class=\"col-sm-offset-2 col-sm-10\">";
        $attributes = array('class' => 'btn btn-primary', 'name' => "editEventPersonal", 'value' => 'Save ' .$title);
        echo form_submit($attributes);
        echo "</div>";
        echo "</div>";
        //echo validation_errors();
        echo form_close();
        echo "</div>";
    ?> 
</div>