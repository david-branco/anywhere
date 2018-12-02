<div class ="container">
    <h1 style ="text-align: center;">
        <?php 
        echo $title ." ";
        if ($this->session->userdata('type') == 'A' || $this->session->userdata('type') == 'T') { 
            echo "<a href=\"".base_url()."index.php/ficheiro/form/".$trabalho_id ."\"><button class =\"btn btn-xs btn-success\">Add File</button></a>";
        }
        ?>
    </h1>
    <div class ="col-md-12">
        <?php
        if(empty($results)) { 
            echo "<h4 style='text-align:center'>There's no files inserted</h4>";
        }
        else {
            echo "<td>Total files: ". count($results) ."</td>";  
            echo "<table class='table table-striped'>";
            echo "<thead>";  
            echo "<tr>";  
            echo "<th>Name</th>";
            echo "<th>Description</th>";
            echo "<th style='width:20%; text-align:center'>Tools</th>";
            echo "</tr>";  
            echo "</thead>";  
            echo "<tbody>";
            foreach ($results as $row) {
                echo "<tr>";
                echo "<td>$row->nome</td>";
                echo "<td>$row->descricao</td>";
                echo "<td style='width:20%; text-align:right'>";
                echo "<a href=\"". base_url()."index.php/ficheiro/download/".$row->ficheiro_id ."\"><button class =\"btn btn-xs btn-success\">Download</button></a>";
                if ($this->session->userdata('type') == "A" || $this->session->userdata('type') == "T") {
                    echo "  <a href=\"".base_url()."index.php/ficheiro/form/".$trabalho_id."/".$row->ficheiro_id ."\"><button class =\"btn btn-xs btn-warning\">Edit</button></a>  
                    <a href=\"".base_url()."index.php/ficheiro/delete/".$trabalho_id."/".$row->ficheiro_id ."\" onClick=\"return confirm('Are you sure?')\"><button class =\"btn btn-xs btn-danger\">Delete</button></a>";
                }
                echo "</td>";
                echo "</tr>"; 
            }                
            echo "</tbody>";  
            echo "</table>";
            echo "<a href=\"".base_url()."index.php/ficheiro/downloadAll/".$trabalho_id ."\"><button class =\"btn btn-xs btn-success\" style='float: right;'>Download All Files</button></a></br></br>";
        }
        ?>
    </div>
</div>