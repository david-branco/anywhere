<div class ="container">
    <?php 
        if (!empty($this->session->flashdata('message'))) {
            echo "<p class='alert alert-info'>".$this->session->flashdata('message')."</p>";
        }
    ?>
  <?php echo "<h3>". $this->session->userdata('name') . "</h3>" ;?>
    <div class ="col-md-8">
        <div class ="col-md-12">
            <h4 style ="text-align: center;">Classes list</h4>
            <table class="table table-striped">  
                <thead>  
                  <tr>  
                    <th>Name</th>  
                    <th>Course</th>  
                    <th>Institution</th>  
                    <th>Academic Year</th>  
                    <th style='width:8%; text-align:center'>Tools</th>
                  </tr>  
                </thead>  
                <tbody>
                    <?php
                        foreach ($disciplinas as $row) {
                            echo "<tr>";
                            echo "<td>" . $row->nome . "</td>";
                            echo "<td>" . $row->curso . "</td>";
                            echo "<td>" . $row->instituicao . "</td>";
                            echo "<td>" . $row->anoletivo . "</td>";
                            echo "<td style='width:8%; text-align:right'>
                            <a href=\"".base_url()."index.php/disciplina/show/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
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
                    <th>Name</th>
                    <th>Theme</th>
                    <th>Final Date</th>
                    <th>Visibility</th>
                    <th style='width:8%; text-align:center'>Tools</th>
                  </tr>  
                </thead>  
                <tbody>
                    <?php
                        foreach ($trabalhos as $row) {
                            echo "<tr>";
                            echo "<td>" . $row->nome . "</td>";
                            echo "<td>" . $row->tema . "</td>";
                            echo "<td>" . $row->datafinal . "</td>";
                            echo "<td>" . $this->trabalho_model->showVisibilidade($row->visibilidade) . "</td>";
                            echo "<td style='width:8%; text-align:right'>
                            <a href=\"".base_url()."index.php/trabalho/show/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
                            </td>";
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
                data-content="<form class='form-inline' role='form' method = 'POST' action ='<?php echo base_url() . 'index.php/frontend/addAlunoQuickEvent' ?>'>
                            <div class='form-group'>
                            <input type='text' class ='form-control' name ='string' placeholder='Add a event'/>
                            </div>
                            <button type='submit' class='btn btn-sm btn-primary'>Save</button>
                            </form>
                            <div class ='row paragraph' style ='padding:0; margin:0;'>Example: Meeting at 19:00 on 21/12/2014</div>
                            ">
                Add Quick Event
            </button>
            </div>
           <div class ="row" style ="padding:0; margin: 0; margin-top: 20px;"><div id="eventCalendar"></div></div>
            <?php $cont =0; ?> 
            <script>
                $('.btn').popover({html : true});
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
                });
            </script>
            </div>
        </div>
    </div>
</div>