<div class ="container">
  <?php echo "<h3>". $this->session->userdata('name') . "</h3>" ;?>
  <h4 style ="text-align: center;">Active classes</h4>
  <div class ="col-md-12">
    <?php
    if(empty($disciplinas)) { 
        echo "<h4 style='text-align:center'>There's no classes inserted</h4>";
    } 
    else {
      echo "<table class='table table-striped'>";  
      echo "<thead>";  
      echo "<tr>";  
      echo "<th>Name</th>";  
      echo "<th>Course</th>";  
      echo "<th>Institution</th>";  
      echo "<th>Academic Year</th>";  
      echo "<th>Tools</th>";
      echo "</tr>";  
      echo "</thead>";  
      echo "<tbody>";
      foreach ($disciplinas as $row) {
        echo "<tr>";
        echo "<td>" . $row->nome . "</td>";
        echo "<td>" . $row->curso . "</td>";
        echo "<td>" . $row->instituicao . "</td>";
        echo "<td>" . $row->anoletivo . "</td>";
        echo "<td>
        <a href=\"".base_url()."index.php/disciplina/show/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
        <a href=\"".base_url()."index.php/disciplina/form/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>
        </td>";
        echo "</tr>";
    }
    echo "</tbody>";  
    echo "</table>";
}
?>
</div>
<h4 style ="text-align: center;">Active works</h4>
<div class ="col-md-12">
    <?php
    if(empty($trabalhos)) { 
        echo "<h4 style='text-align:center'>There's no works inserted</h4>";
    }
    else {
        echo "<table class='table table-striped'>";  
        echo "<thead>";  
        echo "<tr>";  
        echo "<th>Name</th>";
        echo "<th>Theme</th>";
        echo "<th>Final Date</th>";
        echo "<th>Visibility</th>";
        echo "<th>Tools</th>";
        echo "</tr>";  
        echo "</thead>";  
        echo "<tbody>";
        foreach ($trabalhos as $row) {
            echo "<tr>";
            echo "<td>" . $row->nome . "</td>";
            echo "<td>" . $row->tema . "</td>";
            echo "<td>" . $row->datafinal . "</td>";
            echo "<td>" . $row->visibilidade . "</td>";
            echo "<td>
            <a href=\"".base_url()."index.php/trabalho/show/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-info\">Show</button></a>
            <a href=\"".base_url()."index.php/trabalho/form/".$row->trabalho_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>
            </td>";
            echo "</tr>";
        }
        echo "</tbody>";  
        echo "</table>";
    }
    ?>
</div>
<div class="g4">
    <h2 class="h4">No cache</h2>
    <p class="demoDesc">The plugin only calls once to the json file, so it has to contain all events. After that call, the plugin will filter the results</p>
    <div id="eventCalendarNoCache"></div>
    <script>
    $(document).ready(function() {
        $("#eventCalendarNoCache").eventCalendar({
            eventsjson: '<?php echo base_url('assets/events.json.php') ?>',
            cacheJson: false
        });
    });
    </script>
</div>                
</div>