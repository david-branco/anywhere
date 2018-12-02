<div class ="container">
    <?php 
        if (!empty($this->session->flashdata('message'))) {
            echo "<p class='alert alert-info'>".$this->session->flashdata('message')."</p>";
        }
    ?>
    <h1 style ="text-align: center;"><?php echo $title ?></h1>
    <div class ="col-md-12">
        <table class="table table-striped">  
            <thead>  
                <tr>            
                    <th>#ID</th>
                    <th>Name</th>           
                    <th>Description</th>           
                    <th>Url</th>                   
                    <th>Tools</th>           
                </tr>   
            </thead>  
            <tbody>
                <?php
                foreach ($results as $row) {
                    $trab = $this->ficheiro_model->getTrabalhoFromFicheiro($row->ficheiro_id);
                    echo "<tr>";
                    echo "<td>" . $row->ficheiro_id . "</td>";
                    echo "<td>" . $row->nome . "</td>";
                    echo "<td>" . $row->descricao . "</td>";
                    echo "<td>" . $row->url. "</td>";
                    echo "<td>
                    <a href=\"". base_url()."index.php/ficheiro/download/".$row->ficheiro_id ."\"><button class =\"btn btn-xs btn-success\">Download</button></a>
                    <a href=\"".base_url()."index.php/ficheiro/delete/".$trab['trabalho_id']."/".$row->ficheiro_id ."\"><button class =\"btn btn-xs btn-danger\" onClick=\"return confirm('Are you sure?')\">Delete</button></a>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>  
        </table>
    </div>
</div>