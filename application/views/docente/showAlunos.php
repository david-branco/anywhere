<div class ="container">
    <?php
        foreach ($results as $row) {
            echo "<h2 style=\"text-align: center\">Students of ".$row->nome.
            "	<a href=\"".base_url()."index.php/disciplina/pauta/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-info\">Grades</button></a>
            <a href=\"".base_url()."index.php/contacto/emailDisciplina/".$row->disciplina_id ."\"><button class =\"btn btn-xs btn-danger\">Send Email</button></a>
			</h2>";
            $alunos['results'] = $this->disciplina_model->getAlunosFromDisciplina($row->disciplina_id); 
            $alunos['title'] = "";
            $this->load->view('aluno/showList', $alunos);
        } 
    ?>
</div>
                