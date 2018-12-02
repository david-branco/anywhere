<div class ="container">
    <a href="<?php echo base_url()."index.php/trabalho/show/".$trabalho['trabalho_id'] ?>"><button class ="btn btn-xs btn-primary">Show Work</button></a>
    <?php 
        if (!empty($this->session->flashdata('message'))) {
            echo "<p class='alert alert-info'>".$this->session->flashdata('message')."</p>";
        }
    ?>
    <h1 style ="text-align: center;"><?php echo $grupo['nome'] ."<small> from ". $trabalho['nome'] . "</small>"?>
    <?php
        if ($this->session->userdata('type') == 'A') {
            echo "<a href=\"".base_url()."index.php/submissao/form/".$grupo['grupo_id'] ."\"><button class =\"btn btn-xs btn-success\">Add Submission</button></a>
                  <a href=\"".base_url()."index.php/grupo/delete/".$trabalho['trabalho_id']."/".$grupo['grupo_id'] ."\"><button class =\"btn btn-xs btn-danger\" onClick=\"return confirm('Are you sure?')\">Delete</button></a>";                        
        }
        elseif ($this->session->userdata('type') == 'T') {
            ?>
            <button type ="button"
                    class ="btn btn-warning btn-xs"
                    data-container="body"
                    data-toggle="popover" data-placement="bottom" 
                    data-content="<form class='form-inline' role='form' method = 'POST' action ='<?php echo base_url() . 'index.php/grupo/evaluate/' . $grupo['grupo_id']; ?>'>
                        <div class='form-group'>
                        <input type='text' class ='form-control' name ='avaliacao' id ='avaliacao' placeholder='Evaluate this group'/>
                        </div>
                        <button type='submit' class='btn btn-sm btn-primary'>Save</button>
                        </form>
                ">
                Evaluate
                </button>
            <?php
            echo "<a href=\"".base_url()."index.php/grupo/delete/".$trabalho['trabalho_id']."/".$grupo['grupo_id'] ."\"><button class =\"btn btn-xs btn-danger\" onClick=\"return confirm('Are you sure?')\">Delete</button></a>";
        } 
        elseif ($this->session->userdata('type') == 'S') {
            $agora = date("Y-m-d H:i:s");
            if($agora < $trabalho['datagrupos']) { echo "<a href=\"".base_url()."index.php/grupo/unregister/".$grupo['grupo_id'] ."\"><button class =\"btn btn-xs btn-danger\">Unregister</button></a>"; }
        }
    ?>
    </h1>
</div>