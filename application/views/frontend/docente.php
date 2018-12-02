<div class ="container">
    <?php 
        if (!empty($this->session->flashdata('message'))) {
            echo "<p class='alert alert-info'>".$this->session->flashdata('message')."</p>";
        }
    ?>
  <?php echo "<h3>". $this->session->userdata('name') . "</h3>" ;?>
    <div class ="col-md-8">
        <h4 style ="text-align: center;">Active classes</h4>
        <div class ="col-md-12">
            <table class="table table-striped">  
                <thead>  
                  <tr>  
                    <th></th>
                    <th>Name</th>  
                    <th>Course</th>  
                    <th>Institution</th>  
                    <th>Academic Year</th>  
                    <th style='width:14%; text-align:center'>Tools</th>
                  </tr>  
                </thead>  
                <tbody>
                    <?php
                        foreach ($disciplinas as $row) {
                            echo "<tr>";
                            echo "<td>
                            <a href=\"".base_url()."index.php/trabalho/form/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-success\">Add Work</button></a>
                            </td>";
                            echo "<td>" . $row->nome . "</td>";
                            echo "<td>" . $row->curso . "</td>";
                            echo "<td>" . $row->instituicao . "</td>";
                            echo "<td>" . $row->anoletivo . "</td>";
                            echo "<td style='width:14%; text-align:right'>
                            <a href=\"".base_url()."index.php/disciplina/show/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                            <a href=\"".base_url()."index.php/disciplina/form/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>
                            </td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>  
            </table>
        </div>
        <h4 style ="text-align: center;">Active works</h4>
        <div class ="col-md-12">
            <table class="table table-striped">  
                <thead>  
                  <tr>  
                    <th></th>
                    <th>Name</th>
                    <th>Theme</th>
                    <th>Final Date</th>
                    <th>Visibility</th>
                    <th style='width:14%; text-align:center'>Tools</th>
                  </tr>  
                </thead>  
                <tbody>
                    <?php
                        foreach ($trabalhos as $row) {
                            echo "<tr>";
                            echo "<td> 
                            <a href=\"".base_url()."index.php/ficheiro/form/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-success\">Add File</button></a>
                            </td>";
                            echo "<td>" . $row->nome . "</td>";
                            echo "<td>" . $row->tema . "</td>";
                            echo "<td>" . $row->datafinal . "</td>";
                            echo "<td>" . $this->trabalho_model->showVisibilidade($row->visibilidade) . "</td>";
                            $disciplina = $this->trabalho_model->getDisciplinaFromTrabalho($row->trabalho_id);
                            if ($this->session->userdata('type') == 'T') {  
                                echo "<td style='width:14%; text-align:right'>
                                <a href=\"".base_url()."index.php/trabalho/show/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                                <a href=\"".base_url()."index.php/trabalho/form/" .$disciplina->disciplina_id. "/" .$row->trabalho_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>
                                </td>";
                            }
                            echo "</tr>";
                        }
                    ?>
                </tbody>  
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="g4">
            <div class ="row" style ="padding:0; margin: 0">
            <button type ="button"
                class ="btn btn-danger btn-block"
                data-container="body"
                data-toggle="popover" data-placement="left" 
                data-content="<form class='form-inline' role='form' method = 'POST' action ='<?php echo base_url() . 'index.php/evento/formPersonalString/' ?>'>
                            <div class='form-group'>
                            <input type='text' class ='form-control' name ='string' placeholder='Add a event'/>
                            </div>
                            <button type='submit' class='btn btn-sm btn-primary'>Save</button>
                            </form>
                            <div class ='row paragraph' style ='padding:0; margin:0;'>Example: Meeting at 19:00 on 21/12/2014</div>
                            ">
                Add Personal Event
            </button>
            <button type ="button"
                class ="btn btn-danger btn-block"
                data-container="body"
                data-toggle="popover" data-placement="left" 
                data-content="<form class='form-inline' role='form' method = 'POST' name ='classForm'>
                            <div class='form-group'>
                            <select id='disciplina_select' class ='form-control'>
                            <div class='col-sm-8'>
                            <?php
                                foreach ($disciplinas as $row) {
                            ?>
                                <option value='<?php echo $row->disciplina_id ?>'><?php echo substr($row->nome,0,30); ?></option>
                            <?php } ?>
                            </div>
                            </select>
                            </div>
                            <div class='form-group'>
                            <input type='text' class ='form-control' name ='string' placeholder='Add a event'/>
                            </div>
                            <div class ='row paragraph' style ='padding:0; margin:0;'>Example: Meeting at 19:00 on 21/12/2014</div>
                            <button type='button' class ='btn btn-primary pull-right' onclick ='submitForm();'>Save event</button>
                            </div></div></form>
                            ">
                Add Class Event
            </button>
            </div>
            <div class ="row" style ="padding:0; margin: 0; margin-top: 20px;"><div id="eventCalendar"></div></div>
            <?php $cont =0; ?> 
            <script>
                $('.btn').popover({html : true});
                function submitForm() {
                    var selects = document.getElementById("disciplina_select");
                    var val = selects.options[selects.selectedIndex].value;
                    document.classForm.action = "<?php echo base_url() . 'index.php/evento/formClassString/';?>" + val;
                    document.classForm.submit();
                }
                $(document).ready(function() {
                    $("#eventCalendar").eventCalendar({
                        jsonDateFormat: 'human',
                        jsonData: [
                            <?php
                                foreach ($trab_eventos as $trab) {
                                    if ($cont ==0)
                                        echo "{\"date\":\"" . $trab->datafinal . "\",\"type\":\" Work\",\"title\":\"" . $trab->nome .  "\"}";
                                    else
                                        echo ",{\"date\":\"" . $trab->datafinal . "\",\"type\":\" Work\",\"title\":\"" . $trab->nome . "\"}";
                                    $cont =1;
                                }
                            ?>
                            <?php
                                foreach ($pessoais as $pessoal) {
                                    if ($cont ==0)
                                        echo "{\"date\":\"" . $pessoal->dataEvento . "\",\"type\":\" Work\",\"title\":\"" . $pessoal->evento .  "\"}";
                                    else
                                        echo ",{\"date\":\"" . $pessoal->dataEvento . "\",\"type\":\" Work\",\"title\":\"" . $pessoal->evento . "\"}";
                                    $cont =1;
                                }
                            ?>
                            <?php
                                foreach ($disc_eventos as $disc) {
                                    if ($cont ==0)
                                        echo "{\"date\":\"" . $disc->dataEvento . "\" ,\"type\":\" Work\",\"title\":\"" . "[".$disc->nome."] ".$disc->evento .  "\"}";
                                    else
                                        echo ",{\"date\":\"" . $disc->dataEvento . "\",\"type\":\" Work\",\"title\":\"" . "[".$disc->nome."] ".$disc->evento .  "\"}";
                                    $cont =1;
                                }
                            ?>
                        ]
                    });
                    $("#dataEvento").datepicker({
                        changeMonth: true,
                        changeYear: true,
                        minDate: 0,
                        dateFormat: 'yy-mm-dd'
                    });
                });
            </script>
            </div>
        </div>
    </div>
</div>