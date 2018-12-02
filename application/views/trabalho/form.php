<div class ="container">
    <h1 style ="text-align: center;"><?php echo $title ?></h1>
    <script>
        $(document).ready(function() {
            $("#datainicial, #datafinal, #datagrupos, #datarepositorio, #datarepositorio, #limitesubmissao").datetimepicker({
                format: 'yyyy-mm-dd hh:ii',
                autoclose: true,
                todayBtn: true,
                pickerPosition: "bottom-left",
            });
            $(".maisOpcoes").click(function() {
                $("#maisopcoes").slideToggle("slow");
            });
            $(".maisUploads2").click(function() {
                $("#maisuploads2").slideToggle("slow");
            });
            $(".maisUploads3").click(function() {
            	$('.maisUploads2').toggle();           		
                $("#maisuploads3").slideToggle("slow");
            });
            $(".maisUploads4").click(function() {
            	$('.maisUploads3').toggle();           		
                $("#maisuploads4").slideToggle("slow");
            });
            $(".maisUploads5").click(function() {
            	$('.maisUploads4').toggle();           		
                $("#maisuploads5").slideToggle("slow");
            });
            $('.atraso').on('change', function() {
                if (this.value == '3') {
                    $("#mostrarDesconto").show();
                }
                else {
                    $("#mostrarDesconto").hide();
                }
            });
            $('.tipoAvaliacao').on('change', function() {
                if (this.value == '3') {
                    $("#mostrarComparacao").show();
                }
                else {
                    $("#mostrarComparacao").hide();
                }
            });             
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
        echo form_open_multipart(base_url() ."index.php/trabalho/form/".$disciplina_id."/".$trabalho_id, $attributes);        

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Class: ", "disciplina", $attributes);

        if ($this->session->userdata('type') == 'A' && empty($disciplina_id)) {
            $disciplinas = $this->disciplina_model->getDisciplinas();
            foreach($disciplinas as $disc) {
                $data[$disc->disciplina_id] = "ID: " .$disc->disciplina_id . "  - Name: ". $disc->nome;
            }
        }
        else {
            if(empty($disciplina_id)) {
                $disciplinas = $this->docente_model->getDisciplinasFromDocente($this->session->userdata("id"), 1);
                foreach($disciplinas as $disc) {
                    $data[$disc->disciplina_id] = $disc->nome;
                }
            }
            else {
                $disc = $this->disciplina_model->getDisciplina($disciplina_id);
                $data = array(
                    $disc["disciplina_id"] => $disc["nome"]
                );
            }
        }

        echo "<div class=\"col-sm-8\">";
        echo form_dropdown('disciplina', $data, $disciplina_id , 'class="form-control input-sm"');
        echo "</div>";
        echo form_error("disciplina");
        echo "</div>";


        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Name*: ", "nome", $attributes);
        $data = array(
            "name" => "nome",
            "id" => "nome",
            "class" => "form-control input-sm",
            "value" => set_value("nome", $nome),
            "placeholder" => "Insert the Work Name"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("nome");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Topic*: ", "tema", $attributes);
        $data = array(
            "name" => "tema",
            "class" => "form-control input-sm",
            "id" => "tema",
            "value" => set_value("tema",$tema),            
            "placeholder" => "Insert the Topic of the Work"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("tema");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Start Date*: ", "datainicial", $attributes);
        $data = array(
            "name" => "datainicial",
            "id" => "datainicial",
            "class" => "form-control input-sm",
            "value" => set_value("datainicial",$datainicial),            
            "placeholder" => "Insert the Start Date"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("datainicial");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Final Date*: ", "datafinal", $attributes);
        $data = array(
            "name" => "datafinal",
            "id" => "datafinal",
            "class" => "form-control input-sm",
            "value" => set_value("datafinal",$datafinal),            
            "placeholder" => "Insert the Final Date"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("datafinal");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Visibility*: ", "visibilidade", $attributes);
        $data = array(
            "1" => "Private",
            "2" => "Public",
            "3" => "Protected"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_dropdown('visibilidade', $data, set_value('visibilidade'), 'class="form-control input-sm"');
        echo "</div>";
        echo form_error("visibilidade");
        echo "</div>";

        echo "<button class ='btn btn-xs btn-warning maisOpcoes' type='button'>More Options</button></a>";
        echo "<div id=\"maisopcoes\">";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Group Date: ", "datagrupos", $attributes);
        $data = array(
            "name" => "datagrupos",
            "id" => "datagrupos",
            "class" => "form-control input-sm",
            "value" => set_value("datagrupos",$datagrupos),            
            "placeholder" => "Insert the limit Date to form Group"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("datagrupos");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Submisson Limit: ", "limitesubmissao", $attributes);
        $data = array(
            "name" => "limitesubmissao",
            "id" => "limitesubmissao",
            "class" => "form-control input-sm",
            "value" => set_value("limitesubmissao",$limitesubmissao),            
            "placeholder" => "Insert limit Date to send a submission"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("limitesubmissao");
        echo "</div>";
        
        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Description: ", "descricao", $attributes);
        $data = array(
            "name" => "descricao",
            "id" => "descricao",
            "class" => "form-control input-sm",
            "value" => set_value("descricao",$descricao),            
            "placeholder" => "Insert a Description about the Work"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("descricao");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Repository Date: ", "datarepositorio", $attributes);
        $data = array(
            "name" => "datarepositorio",
            "id" => "datarepositorio",
            "class" => "form-control input-sm",
            "value" => set_value("datarepositorio",$datarepositorio),            
            "placeholder" => "Insert the Repository Date"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("datarepositorio");
        echo "</div>";

        echo "<div class='form-group'>";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Delay: ", "atraso", $attributes);
        $data = array(
            "1" => "No",
            "2" => "Yes",
            "3" => "With Penalty"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_dropdown('atraso', $data, set_value('atraso'), 'class="form-control input-sm atraso"');
        echo "</div>";
        echo form_error("atraso");
        echo "</div>";

        echo "<div id ='mostrarDesconto'>";
            echo "<div class='form-group'>";
            $attributes = array('class' => 'col-sm-4 control-label');
            echo form_label("Penalization (in %):", "desconto", $attributes);
            $data = array(
                "name" => "desconto",
                "id" => "desconto",
                "class" => "form-control input-sm",
                "value" => set_value("desconto", $desconto),            
                "placeholder" => "Insert Penalization"
            );
            echo "<div class=\"col-sm-8\">";
            echo form_input($data);
            echo "</div>";
            echo form_error("desconto");
            echo "</div>";
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Importance (in %): ", "pesonota", $attributes);
        $data = array(
            "name" => "pesonota",
            "id" => "pesonota",
            "class" => "form-control input-sm",
            "value" => set_value("pesonota", $pesonota),            
            "placeholder" => "Insert the Importante on final grade"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_input($data);
        echo "</div>";
        echo form_error("pesonota");
        echo "</div>";

        echo "<div class=\"form-group\">";
        $attributes = array('class' => 'col-sm-4 control-label');
        echo form_label("Evaluation Type: ", "tipoavaliacao", $attributes);
        $data = array(
            "1" => "Manual",
            "2" => "SIP",
            "3" => "Test Comparison"
        );
        echo "<div class=\"col-sm-8\">";
        echo form_dropdown('tipoavaliacao', $data, set_value('tipoavaliacao'), 'class="form-control input-sm tipoAvaliacao"');
        echo "</div>";
        echo form_error("tipoavaliacao");
        echo "</div>";

        echo "<div id ='mostrarComparacao'>";
            echo "<div class=\"form-group\">";
            $attributes = array('class' => 'col-sm-4 control-label');
            echo form_label("Programming Language: ", "linguagem", $attributes);
            $data = array(
                "1" => "C",
                "2" => "Perl",
                "3" => "Ruby"
            );
            echo "<div class=\"col-sm-8\">";
            echo form_dropdown('linguagem', $data, set_value('linguagem'), 'class="form-control input-sm"');
            echo "</div>";
            echo form_error("linguagem");
            echo "</div>";

            echo "<fieldset class='scheduler-border'>";
            echo "<legend class=\'scheduler-border\'>Files</legend>";
            echo "<div class=\"form-group\">";
            $attributes = array('class' => 'col-sm-4 control-label');
            echo form_label("Input File: ", "inputfile1", $attributes);
            $data = array(
                "name" => "inputfile1",
                "id" => "inputfile1",
                "class" => "form-control input-sm",
                "value" => set_value("inputfile1"),            
                "placeholder" => "Select the Input File"
            );
            echo "<div class=\"col-sm-8\">";
            echo form_upload($data);
            echo "</div>";
            echo form_error("inputfile1");
            echo $message;
            echo "</div>";

            echo "<div class=\"form-group\">";
            $attributes = array('class' => 'col-sm-4 control-label');
            echo form_label("Output File: ", "outputfile1", $attributes);
            $data = array(
                "name" => "outputfile1",
                "id" => "outputfile1",
                "class" => "form-control input-sm",
                "value" => set_value("outputfile1"),            
                "placeholder" => "Select the Output File"
            );
            echo "<div class=\"col-sm-8\">";
            echo form_upload($data);
            echo "</div>";
            echo form_error("outputfile1");
            echo $message;
            echo "</div>";

            echo "<button class ='btn btn-xs btn-success maisUploads2' type='button'>More Upload Fields</button></a>";
            echo "<div id='maisuploads2'>";
    	        echo "<div class=\"form-group\">";
    	        $attributes = array('class' => 'col-sm-4 control-label');
    	        echo form_label("Input File: ", "inputfile2", $attributes);
    	        $data = array(
    	            "name" => "inputfile2",
    	            "id" => "inputfile2",
    	            "class" => "form-control input-sm",
    	            "value" => set_value("inputfile2"),            
    	            "placeholder" => "Select the Input File"
    	        );
    	        echo "<div class=\"col-sm-8\">";
    	        echo form_upload($data);
    	        echo "</div>";
    	        echo form_error("inputfile2");
    	        echo $message;
    	        echo "</div>";

    	        echo "<div class=\"form-group\">";
    	        $attributes = array('class' => 'col-sm-4 control-label');
    	        echo form_label("Output File: ", "outputfile2", $attributes);
    	        $data = array(
    	            "name" => "outputfile2",
    	            "id" => "outputfile2",
    	            "class" => "form-control input-sm",
    	            "value" => set_value("outputfile2"),            
    	            "placeholder" => "Select the Output File"
    	        );
    	        echo "<div class=\"col-sm-8\">";
    	        echo form_upload($data);
    	        echo "</div>";
    	        echo form_error("outputfile2");
    	        echo $message;
    	        echo "</div>";

    	        echo "<button class ='btn btn-xs btn-success maisUploads3' type='button'>More Upload Fields</button></a>";
    	        echo "<div id='maisuploads3'>";
    		        echo "<div class=\"form-group\">";
    		        $attributes = array('class' => 'col-sm-4 control-label');
    		        echo form_label("Input File: ", "inputfile3", $attributes);
    		        $data = array(
    		            "name" => "inputfile3",
    		            "id" => "inputfile3",
    		            "class" => "form-control input-sm",
    		            "value" => set_value("inputfile3"),            
    		            "placeholder" => "Select the Input File"
    		        );
    		        echo "<div class=\"col-sm-8\">";
    		        echo form_upload($data);
    		        echo "</div>";
    		        echo form_error("inputfile3");
    		        echo $message;
    		        echo "</div>";

    		        echo "<div class=\"form-group\">";
    		        $attributes = array('class' => 'col-sm-4 control-label');
    		        echo form_label("Output File: ", "outputfile3", $attributes);
    		        $data = array(
    		            "name" => "outputfile3",
    		            "id" => "outputfile3",
    		            "class" => "form-control input-sm",
    		            "value" => set_value("outputfile3"),            
    		            "placeholder" => "Select the Output File"
    		        );
    		        echo "<div class=\"col-sm-8\">";
    		        echo form_upload($data);
    		        echo "</div>";
    		        echo form_error("outputfile3");
    		        echo $message;
    		        echo "</div>";		    

    			    echo "<button class ='btn btn-xs btn-success maisUploads4' type='button'>More Upload Fields</button></a>";
    		        echo "<div id='maisuploads4'>";
    			        echo "<div class=\"form-group\">";
    			        $attributes = array('class' => 'col-sm-4 control-label');
    			        echo form_label("Input File: ", "inputfile4", $attributes);
    			        $data = array(
    			            "name" => "inputfile4",
    			            "id" => "inputfile4",
    			            "class" => "form-control input-sm",
    			            "value" => set_value("inputfile4"),            
    			            "placeholder" => "Select the Input File"
    			        );
    			        echo "<div class=\"col-sm-8\">";
    			        echo form_upload($data);
    			        echo "</div>";
    			        echo form_error("inputfile4");
    			        echo $message;
    			        echo "</div>";

    			        echo "<div class=\"form-group\">";
    			        $attributes = array('class' => 'col-sm-4 control-label');
    			        echo form_label("Output File: ", "outputfile4", $attributes);
    			        $data = array(
    			            "name" => "outputfile4",
    			            "id" => "outputfile4",
    			            "class" => "form-control input-sm",
    			            "value" => set_value("outputfile4"),            
    			            "placeholder" => "Select the Output File"
    			        );
    			        echo "<div class=\"col-sm-8\">";
    			        echo form_upload($data);
    			        echo "</div>";
    			        echo form_error("outputfile4");
    			        echo $message;
    			        echo "</div>";

    			        echo "<button class ='btn btn-xs btn-success maisUploads5' type='button'>More Upload Fields</button></a>";
    			        echo "<div id='maisuploads5'>";
    				        echo "<div class=\"form-group\">";
    				        $attributes = array('class' => 'col-sm-4 control-label');
    				        echo form_label("Input File: ", "inputfile5", $attributes);
    				        $data = array(
    				            "name" => "inputfile5",
    				            "id" => "inputfile5",
    				            "class" => "form-control input-sm",
    				            "value" => set_value("inputfile5"),            
    				            "placeholder" => "Select the Input File"
    				        );
    				        echo "<div class=\"col-sm-8\">";
    				        echo form_upload($data);
    				        echo "</div>";
    				        echo form_error("inputfile5");
    				        echo $message;
    				        echo "</div>";

    				        echo "<div class=\"form-group\">";
    				        $attributes = array('class' => 'col-sm-4 control-label');
    				        echo form_label("Output File: ", "outputfile5", $attributes);
    				        $data = array(
    				            "name" => "outputfile5",
    				            "id" => "outputfile5",
    				            "class" => "form-control input-sm",
    				            "value" => set_value("outputfile5"),            
    				            "placeholder" => "Select the Output File"
    				        );
    				        echo "<div class=\"col-sm-8\">";
    				        echo form_upload($data);
    				        echo "</div>";
    				        echo form_error("outputfile5");
    				        echo $message;
    				        echo "</div>";
    				    echo "</div>";
    			    echo "</div>";
    			echo "</div>";
    	    echo "</div>";  
    		echo "</fieldset>";
            echo "</div>"; 
        echo "</div>";        

        echo "<div class=\"form-group\">";
        echo "<div class=\"col-sm-offset-2 col-sm-10\">";
        $attributes = array('class' => 'btn btn-sm btn-primary', 'name' => "addTrabalhoSubmit", 'value' => 'Save ' .$title);
        echo form_submit($attributes);
        echo "</div>";
        echo "</div>";
        //echo validation_errors();
        echo form_close();
        echo "</div>";
    ?>  
</div>