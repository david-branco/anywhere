<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grupo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getGrupo($id) {
        $query = $this->db->get_where('Grupo',array('grupo_id'=>$id));
        return $query->row_array();
    }

    function getGrupos() {
        $query = $this->db->query("SELECT * FROM Grupo");
        return $query->result();
    }

    function getAlunosFromGrupo($id) {
        $query = $this->db->query(
            "SELECT DISTINCT Aluno.*
             FROM Aluno, Grupo_Aluno
             WHERE Aluno.aluno_id = Grupo_Aluno.aluno_id AND grupo_id = $id");
        return $query->result();
    }

    function getTrabalhoFromGrupo($id) {
        $query = $this->db->query(
            "SELECT DISTINCT Trabalho.*   
             FROM Trabalho, Trabalho_Grupo, Grupo
             WHERE Trabalho.trabalho_id = Trabalho_Grupo.trabalho_id
                AND Grupo.grupo_id = Trabalho_Grupo.grupo_id
                AND Grupo.grupo_id 
                    IN (SELECT Grupo.grupo_id
                        FROM Grupo, Trabalho_Grupo
                        WHERE Grupo.grupo_id = Trabalho_Grupo.grupo_id
                        AND Grupo.grupo_id = $id)");
        return $query->row_array();
    }    

    public function getSubmissoesFromGrupos($id_grupo) {
        $query = $this->db->query(
            "SELECT *
             FROM Grupo_Submissao, Submissao
             WHERE Submissao.submissao_id = Grupo_Submissao.submissao_id
                AND Grupo_Submissao.grupo_id = $id_grupo");
        return $query->result();
    }

    public function getUltimaSubmissaoFromGrupo($id_grupo) {
        $query = $this->db->query(
            "SELECT *
             FROM Grupo_Submissao, Submissao
             WHERE Submissao.submissao_id = Grupo_Submissao.submissao_id
                AND Grupo_Submissao.grupo_id = $id_grupo
             ORDER BY Submissao.submissao_id DESC
             LIMIT 1");
        return $query->row_array();
    }

    public function getDisciplinaFromGrupo($id_grupo) {
        $query = $this->db->query(
            "SELECT Disciplina.*
            FROM Disciplina, Disciplina_Trabalho
            WHERE Disciplina.disciplina_id = Disciplina_Trabalho.disciplina_id 
                AND Disciplina_Trabalho.trabalho_id 
                    IN (SELECT DISTINCT Trabalho.trabalho_id   
                        FROM Trabalho, Trabalho_Grupo, Grupo
                        WHERE Trabalho.trabalho_id = Trabalho_Grupo.trabalho_id
                            AND Grupo.grupo_id = Trabalho_Grupo.grupo_id
                            AND Grupo.grupo_id 
                                IN (SELECT Grupo.grupo_id
                                    FROM Grupo, Trabalho_Grupo
                                    WHERE Grupo.grupo_id = Trabalho_Grupo.grupo_id
                                    AND Grupo.grupo_id = $id_grupo))");
        return $query->row_array();
    }

    public function inserirGrupos($id_trabalho, $totalGruposNovos) {
  
        $disc = $this->trabalho_model->getDisciplinaFromTrabalho($id_trabalho);
        $grupos = $this->trabalho_model->getGruposFromTrabalho($id_trabalho);
        $totalGruposBD = count($grupos);
        $i = 1; $j = 1;
        while($i <= $totalGruposNovos) {
            $flag = TRUE;
            foreach($grupos as $grupo) {
                if($grupo->nome == "Grupo ".$j) {
                    $flag = FALSE;
                    break;
                }
            }
            if($flag) {
                $data=array(
                    'nome'=> "Grupo ".$j
                );
                $this->db->insert('Grupo',$data);

                $id_grupo = $this->db->insert_id();

                $ligacao = array(
                    'grupo_id' => $id_grupo,
                    'trabalho_id' => $id_trabalho,
                );
                $this->db->insert('Trabalho_Grupo', $ligacao);

                mkdir("./uploads/submissions/class".$disc->disciplina_id."/work".$id_trabalho."/workteam".$id_grupo."/", 0777, true);
                $i++;
            }
            $j++;
        }
    }

    public function inscreverEmGrupo($id_grupo) {
        $data = array(
            'aluno_id' => $this->session->userdata('id'),
            'grupo_id' => $id_grupo,
        );

        $this->db->insert('Grupo_Aluno', $data); 
    }

    public function cancelarInscricaoEmGrupo($id_grupo) {
        $data = array(
            'aluno_id' => $this->session->userdata('id'),
            'grupo_id' => $id_grupo,
        );

        $this->db->delete('Grupo_Aluno', $data); 
    }

    public function avaliar($id_grupo) {
        $data = array(
            'avaliacao' => $_POST['avaliacao']
        );
        $this->db->update('Grupo', $data, "grupo_id = $id_grupo");

        $alunos['alunos'] = $this->getAlunosFromGrupo($id_grupo);
        $trabalho = $this->getTrabalhoFromGrupo($id_grupo);
        foreach($alunos['alunos'] as $aluno) {
            $data = array(
                'avaliacao' => $_POST['avaliacao']
            );         
           $this->db->update('Aluno_Trabalho', $data, array('aluno_id' => $aluno->aluno_id, 'trabalho_id' => $trabalho['trabalho_id']));
        }
    }

    public function apagar($id_grupo,$id_trabalho,$apagar) {
        $this->load->helper('recursive_helper');
        $grupo = $this->getGrupo($id_grupo);
        $disc = $this->getDisciplinaFromGrupo($id_grupo);
        if($apagar) { remove_directory("uploads/submissions/class".$disc['disciplina_id']."/work".$id_trabalho."/workteam".$id_grupo); }
        $this->db->delete('Trabalho_Grupo', array('grupo_id'=>$id_grupo));
        $this->db->delete('Grupo_Aluno', array('grupo_id'=>$id_grupo));
        $this->db->delete('Grupo_Submissao', array('grupo_id'=>$id_grupo));
        $this->db->delete('Grupo', array('grupo_id'=>$id_grupo));
    }
}
