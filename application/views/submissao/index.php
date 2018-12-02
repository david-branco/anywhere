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
                    <th>Size(KB)</th>           
                    <th>Url</th>           
                    <th>Description</th>           
                    <th>Date</th>           
                    <th>Tools</th>           
                </tr>   
            </thead>  
            <tbody>
                <?php
                foreach ($results as $row) {
                    $grupo = $this->submissao_model->getGrupoFromSubmissao($row->submissao_id);
                    echo "<tr>";
                    echo "<td>" . $row->submissao_id . "</td>";
                    echo "<td>" . $row->nome . "</td>";
                    echo "<td>" . $row->tamanho . "</td>";
                    echo "<td>" . $row->url . "</td>";
                    echo "<td>" . $row->descricao . "</td>";
                    echo "<td>" . $row->data . "</td>";
                    echo "<td>
                    <a href=\"". base_url()."index.php/submissao/download/".$row->submissao_id ."\"><button class =\"btn btn-xs btn-success\">Download</button></a>
                    <a href=\"".base_url()."index.php/submissao/delete/".$grupo['grupo_id']."/".$row->submissao_id ."\"><button class =\"btn btn-xs btn-danger\">Delete</button></a>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>  
        </table>
    </div>
</div>