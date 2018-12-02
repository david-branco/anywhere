<div class ="container">
    <h1 style ="text-align: center;"><?php echo $nome?></h1>
    <div class ="col-md-12">
        <table class="table table-striped">  
            <thead>  
              <tr>  
                <th>Name</th>
              </tr>  
            </thead>  
            <tbody>
                <?php
                    echo "<tr>";
                    echo "<td>" . $nome . "</td>";
                    echo "</tr>";
                ?>
            </tbody>  
        </table>
    </div>
</div>