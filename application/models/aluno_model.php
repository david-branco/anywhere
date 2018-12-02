<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aluno_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function validate_aluno( $email, $password ) {
        $this->db->from('Aluno');
        $this->db->where('email',$email );
        $this->db->where( 'password', md5($password) );
        $login = $this->db->get()->result();

        if ( is_array($login) && count($login) == 1 ) {
            $this->details = $login[0];
            $this->set_session();
            return true;
        }
        return false;
    }

    public function set_session() {
        $this->session->set_userdata( 
            array(
                'id'=>$this->details->aluno_id,
                'name'=> $this->details->nome,
                'email'=>$this->details->email,
                'logged' => TRUE,
                'type'=>"S"
                )
            );
    }

    public function getAluno($id) {
        $query = $this->db->get_where('Aluno',array('aluno_id'=>$id));
        return $query->row_array();
    }

    public function getAlunoByEmail($email) {
        $query = $this->db->get_where('Aluno',array('email'=>$email));
        return $query->row_array();
    }

    public function getAlunos() {
        $query = $this->db->query("SELECT * FROM Aluno");
        return $query->result();
    }

    public function getDisciplinasFromAluno($id) {
        $query = $this->db->query(
            "SELECT Disciplina.* 
            FROM Disciplina, Aluno_Disciplina
            WHERE Disciplina.disciplina_id = Aluno_Disciplina.disciplina_id AND aluno_id =$id");
        return $query->result();
    }

    public function inserirEvento($dataEvento, $evento) {
        $data=array(
            'dataEvento'=> $dataEvento,
            'evento'=> $evento
        );
        $this->db->insert('Evento',$data);
        
        $id_evento = $this->db->insert_id();
        $ligacao = array(
            'aluno_id' => $this->session->userdata('id'),
            'evento_id' => $id_evento
        );
        $this->db->insert('Aluno_Evento', $ligacao);
    }

        public function atualizarEvento($dataEvento, $evento, $id_evento) {
        $data=array(
            'dataEvento'=> $dataEvento,
            'evento'=> $evento
        );

        $this->db->update('Evento', $data, "evento_id = $id_evento");
    }

    public function getEventosFromAluno($id) {
        $query = $this->db->query(
            "SELECT Evento.* 
            FROM Evento, Aluno_Evento
            WHERE Evento.evento_id = Aluno_Evento.evento_id AND aluno_id =$id");
        return $query->result();
    }

    public function getEventosPassOuFutFromAluno($id, $tempo) {
        $query = $this->db->query(
            "SELECT Evento.* 
            FROM Evento, Aluno_Evento
            WHERE Evento.evento_id = Aluno_Evento.evento_id 
            AND Evento.dataEvento $tempo CURRENT_DATE() AND aluno_id =$id");
        return $query->result();
    }

    public function getEventosFromDisciplinasAtivasFromAluno($id) {
        $query = $this->db->query(
            "SELECT *
            FROM Evento, Disciplina_Evento, Disciplina
            WHERE Evento.evento_id = Disciplina_Evento.evento_id
                AND Disciplina.disciplina_id = Disciplina_Evento.disciplina_id
                AND Disciplina_Evento.disciplina_id 
                    IN  (SELECT Disciplina.disciplina_id
                        FROM Disciplina, Aluno_Disciplina
                        WHERE Disciplina.disciplina_id = Aluno_Disciplina.disciplina_id 
                        AND Aluno_Disciplina.ativa = 1 AND aluno_id = $id)");
        return $query->result();
    }

    public function getEventosPassOuFutFromDisciplinasAtivasFromAluno($id, $tempo) {
        $query = $this->db->query(
            "SELECT *
            FROM Evento, Disciplina_Evento, Disciplina
            WHERE Evento.evento_id = Disciplina_Evento.evento_id
                AND Disciplina.disciplina_id = Disciplina_Evento.disciplina_id
                AND Evento.dataEvento $tempo CURRENT_DATE()
                AND Disciplina_Evento.disciplina_id 
                    IN  (SELECT Disciplina.disciplina_id
                        FROM Disciplina, Aluno_Disciplina
                        WHERE Disciplina.disciplina_id = Aluno_Disciplina.disciplina_id 
                        AND Aluno_Disciplina.ativa = 1 AND aluno_id = $id)");
        return $query->result();
    }

    public function getDatasFinaisFromAluno($id) {
        $query = $this->db->query(
            "SELECT Trabalho.nome, Trabalho.datafinal, Trabalho.trabalho_id
            FROM Trabalho, Disciplina_Trabalho, Disciplina
            WHERE Trabalho.trabalho_id = Disciplina_Trabalho.trabalho_id
            AND Disciplina_Trabalho.disciplina_id = Disciplina.disciplina_id
            AND Disciplina.disciplina_id 
            IN( SELECT Disciplina.disciplina_id 
                FROM Disciplina, Aluno_Disciplina
                WHERE Disciplina.disciplina_id = Aluno_Disciplina.disciplina_id AND aluno_id =$id)");
        return $query->result();
    }

    public function getDatasFinaisPassOuFutFromTrabalhosFromAluno($id, $tempo) {
        $query = $this->db->query(
            "SELECT *
             FROM Trabalho, Disciplina_Trabalho, Disciplina
             WHERE Trabalho.trabalho_id = Disciplina_Trabalho.trabalho_id
                AND Disciplina_Trabalho.disciplina_id = Disciplina.disciplina_id
                AND Trabalho.datafinal $tempo CURRENT_DATE()
                AND Disciplina.disciplina_id 
                    IN( SELECT Disciplina.disciplina_id
                        FROM Disciplina, Aluno_Disciplina
                        WHERE Disciplina.disciplina_id = Aluno_Disciplina.disciplina_id
                        AND aluno_id =$id)");
        return $query->result();
    }

    public function getAtiveorDisableDisciplinasFromAluno($id, $ativa) {
        $query = $this->db->query(
            "SELECT Disciplina.* 
            FROM Disciplina, Aluno_Disciplina
            WHERE Disciplina.disciplina_id = Aluno_Disciplina.disciplina_id 
            AND Aluno_Disciplina.ativa = $ativa AND aluno_id =$id");
        return $query->result();
    }

    public function getTemasFromAluno($id) {
        $query = $this->db->query(
            "SELECT Trabalho. tema
            FROM Trabalho, Disciplina_Trabalho, Disciplina
            WHERE Trabalho.trabalho_id = Disciplina_Trabalho.trabalho_id
            AND Disciplina_Trabalho.disciplina_id = Disciplina.disciplina_id
            AND Disciplina.disciplina_id 
            IN( SELECT Disciplina.disciplina_id 
                FROM Disciplina, Aluno_Disciplina
                WHERE Disciplina.disciplina_id = Aluno_Disciplina.disciplina_id AND aluno_id =$id)");
        return $query->result();
    }

/*    public function getTrabalhosFromAluno($id) {
        $query = $this->db->query(
            "SELECT Trabalho. * 
            FROM Trabalho, Disciplina_Trabalho, Disciplina
            WHERE Trabalho.trabalho_id = Disciplina_Trabalho.trabalho_id
            AND Disciplina_Trabalho.disciplina_id = Disciplina.disciplina_id
            AND Disciplina.disciplina_id 
            IN( SELECT Disciplina.disciplina_id 
                FROM Disciplina, Aluno_Disciplina
                WHERE Disciplina.disciplina_id = Aluno_Disciplina.disciplina_id AND aluno_id =$id)");
        return $query->result();
    }*/

    public function getTrabalhosFromAluno($id) {
        $query = $this->db->query(
            "SELECT DISTINCT *
             FROM Aluno_Trabalho, Trabalho
             WHERE Trabalho.trabalho_id = Aluno_Trabalho.trabalho_id
                AND Aluno_Trabalho.aluno_id = $id");
        return $query->result();
    }

    public function getAtiveorDisableTrabalhosFromAluno($id, $ativa) {
        $query = $this->db->query(
            "SELECT Trabalho. * 
            FROM Trabalho, Disciplina_Trabalho, Disciplina
            WHERE Trabalho.trabalho_id = Disciplina_Trabalho.trabalho_id
            AND Disciplina_Trabalho.disciplina_id = Disciplina.disciplina_id
            AND Disciplina.disciplina_id 
            IN( SELECT Disciplina.disciplina_id 
                FROM Disciplina, Aluno_Disciplina
                WHERE Disciplina.disciplina_id = Aluno_Disciplina.disciplina_id 
                AND Aluno_Disciplina.ativa = $ativa AND aluno_id =$id)");
        return $query->result();
    }

    public function getGruposFromAluno($id) {
        $query = $this->db->query(
            "SELECT DISTINCT Grupo.* 
            FROM Grupo_Aluno, Grupo
            WHERE Grupo.grupo_id = Grupo_Aluno.grupo_id AND Grupo_Aluno.aluno_id = $id");
        return $query->result();
    }

    public function isAGrupoFromAluno($id_grupo, $id_aluno) {
        $query = $this->db->query(
            "SELECT *
            FROM Aluno, Grupo_Aluno
            WHERE Aluno.aluno_id = Grupo_Aluno.aluno_id
            AND Aluno.aluno_id = $id_aluno
            AND Grupo_Aluno.grupo_id = $id_grupo");
        return $query->num_rows() === 1;
    }

    public function isADisciplinaFromAluno($id_disciplina, $id_aluno) {
        $query = $this->db->query(
            "SELECT *
            FROM Aluno, Aluno_Disciplina
            WHERE Aluno.aluno_id = Aluno_Disciplina.aluno_id
            AND Aluno.aluno_id = $id_aluno
            AND Aluno_Disciplina.disciplina_id = $id_disciplina");
        return $query->num_rows() === 1;
    }

    public function isDisciplinaAtiveFromAluno($id_disciplina) {
        $id_aluno = $this->session->userdata('id');
        $query = $this->db->query(
            "SELECT Aluno_Disciplina.ativa
            FROM Aluno_Disciplina
            WHERE aluno_id = $id_aluno AND disciplina_id = $id_disciplina AND ativa = 1");
        return $query->num_rows();
    }

    public function active_disableDisciplinaFromAluno($id_disciplina) {
        $ativa = $this->isDisciplinaAtiveFromAluno($id_disciplina);
        $data = array(
            'aluno_id' => $this->session->userdata('id'),
            'disciplina_id' => $id_disciplina,
            'ativa' => abs($ativa -1)
        );
        $this->db->update('Aluno_Disciplina', $data, array('aluno_id' => $this->session->userdata('id'),
            'disciplina_id' => $id_disciplina));
    }

    public function showEstatuto($val) {
        return (($val == 1)?  "Ordinary" : 
            (($val == 2)? "Employed" : 
                (($val == 3)? "Military" : 
                    (($val == 4)? "With a Disability" : 
                        (($val == 5)? "Association Member" : 
                            (($val == 6)? "Member of Collegial Body" : "Other"))))));                               
    }

    public function avaliar($id_aluno, $trabalho_id) {
        $data = array(
            'avaliacao' => $_POST['avaliacao']
        );         
        $this->db->update('Aluno_Trabalho', $data, array('aluno_id' => $id_aluno, 'trabalho_id' => $trabalho_id));
    }

    public function avaliar2($id_aluno, $trabalho_id, $avaliacao) {
        $data = array(
            'avaliacao' => $avaliacao
        );         
        $this->db->update('Aluno_Trabalho', $data, array('aluno_id' => $id_aluno, 'trabalho_id' => $trabalho_id));
    }
    
    public function registoRapido() {
        $data=array(
            'password'=>$_POST['password'],
            'email'=>$_POST['email'],
            'nome'=>"",
            'curso'=>"",
            'instituicao'=>"",
            'naluno'=>""      
            );
        $data['password'] = md5($data['password']);
        $this->db->insert('Aluno',$data);

        return $this->db->insert_id();
    } 

    public function registo($id) {
        $data=array(
            'nome'=>$_POST['nome'],
            'naluno'=>$_POST['naluno'],
            'website'=>$_POST['website'],
            'curso'=>$_POST['curso'],
            'instituicao'=>$_POST['instituicao'],
            'estatuto'=>$_POST['estatuto'],
            'sobre'=>$_POST['sobre']
        );

        $this->load->library('upload');
        $file = $this->upload->data();
        if($file ["is_image"]) {
            $data['foto'] = "uploads/photos/student/".'studentphoto'.$id.$file['file_ext'];
        }
        
        $this->db->update('Aluno', $data, "aluno_id = $id");
    }

    public function inserir() {
        $data=array(
            'password'=>$_POST['password'],
            'nome'=>$_POST['nome'],
            'naluno'=>$_POST['naluno'],
            'email'=>$_POST['email'],
            'website'=>$_POST['website'],
            'curso'=>$_POST['curso'],
            'instituicao'=>$_POST['instituicao'],
            'estatuto'=>$_POST['estatuto'],
            'sobre'=>$_POST['sobre']
        );
        $data['password'] = md5($data['password']);

        $this->db->insert('Aluno', $data);
        $id_aluno = $this->db->insert_id();

        $ligacao = array(
            'aluno_id' => $id_aluno,
            'disciplina_id' => $_POST['disciplina']
        );
        $this->db->insert('Aluno_Disciplina', $ligacao);

        $this->load->library('upload');
        $file = $this->upload->data();
        if($file ["is_image"]) {
            $data['foto'] = "uploads/photos/student/".'studentphoto'.$id_aluno.$file['file_ext'];
            $this->db->update('Aluno', $data, "aluno_id = $id_aluno");
        }
        return $id_aluno;
    }


    public function atualizar($id) {
        $data=array(
            'aluno_id'=>$id,
            'password'=>$_POST['password'],
            'nome'=>$_POST['nome'],
            'naluno'=>$_POST['naluno'],
            'email'=>$_POST['email'],
            'website'=>$_POST['website'],
            'curso'=>$_POST['curso'],
            'instituicao'=>$_POST['instituicao'],
            'estatuto'=>$_POST['estatuto'],
            'sobre'=>$_POST['sobre']
            );

        $data['password'] = md5($data['password']);

        $this->load->library('upload');
        $file = $this->upload->data();
        if($file ["is_image"]) {
            $data['foto'] = "uploads/photos/student/".'studentphoto'.$id.$file['file_ext'];
        }

        $this->db->update('Aluno', $data, "aluno_id = $id");
    }

    public function apagar($id_aluno) {
        $aluno = $this->getAluno($id_aluno);
        if (!empty($aluno['foto'])) { unlink($aluno['foto']); }        
 
        $this->db->delete('Aluno_Evento', array('aluno_id'=>$id_aluno));
        $this->db->delete('Aluno_Disciplina', array('aluno_id'=>$id_aluno));
        $this->db->delete('Grupo_Aluno', array('aluno_id'=>$id_aluno));
        $this->db->delete('Aluno_Trabalho', array('aluno_id'=>$id_aluno));
        $this->db->delete('Aluno', array('aluno_id'=>$id_aluno));
    }
}