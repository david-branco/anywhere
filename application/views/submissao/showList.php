<div class ="container">
    <h1 style ="text-align: center;"><?php echo $title ?>
    <?php 
        if ($this->session->userdata('type') == 'S') {
            $agora = date("Y-m-d H:i:s");
            if($agora < $trabalho['limitesubmissao'] || $trabalho['atraso'] != 1) { echo "<a href=\"".base_url()."index.php/submissao/form/".$grupo['grupo_id'] ."\"><button class =\"btn btn-xs btn-success\">Add Submission</button></a>"; }
        }
    ?>
    </h1>
    <div class ="col-md-12"> 
        <?php
        if(empty($results)) { 
            echo "<h4 style='text-align:center'>There's no submissions inserted</h4>";
        }
        else {  
            echo "<td>Total Submissions: ". count($results) ."</td>";
            echo "<table class='table table-striped'>";
            echo "<thead>";  
            echo "<tr>";  
            echo "<th>Submission Date</th>";
            echo "<th>Description</th>";
            echo "<th style='width:10%; text-align:center'>Tools</th>";
            echo "</tr>";  
            echo "</thead>";  
            echo "<tbody>";
            foreach ($results as $row) {
                echo "<tr>";
                echo "<td>$row->data</td>";
                echo "<td>$row->descricao</td>";
                echo "<td style='width:10%; text-align:right'>";
                echo "<a href=\"". base_url()."index.php/submissao/download/".$row->submissao_id ."\"><button class =\"btn btn-xs btn-success\">Download</button></a>";
                if ($this->session->userdata('type') == "A") {
                    echo "<a href=\"".base_url()."index.php/submissao/delete/".$grupo['grupo_id']."/".$row->submissao_id ."\"><button class =\"btn btn-xs btn-danger\">Delete</button></a>";
                }
                echo "</td>";
                echo "</tr>"; 
            }
            echo "</tbody>";  
            echo "</table>";
        }
        ?>
    </div>
</div>