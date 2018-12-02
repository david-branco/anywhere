<?php 

	class Docente_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function validate_docente( $email, $password ) {
        $this->db->from('Docente');
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
                'id'=>$this->details->docente_id,
                'name'=> $this->details->nome,
                'email'=>$this->details->email,
                'logged' => TRUE,
                'type'=>"T"
            )
        );
    }

    public function getDocentes() {
        $query = $this->db->query("SELECT * FROM Docente");
        return $query->result();
    }

    public function getDocente($id) {
        $query = $this->db->get_where('Docente',array('docente_id'=>$id));
        return $query->row_array();
    }

    public function getDisciplinasFromDocente($id) {
        $query = $this->db->query(
            "SELECT Disciplina . * 
            FROM Disciplina, Docente_Disciplina
            WHERE Disciplina.disciplina_id = Docente_Disciplina.disciplina_id 
            AND Docente_Disciplina.ativa = 1 AND docente_id =$id");
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
            'docente_id' => $this->session->userdata('id'),
            'evento_id' => $id_evento
        );
        $this->db->insert('Docente_Evento', $ligacao);
    }

    public function atualizarEvento($dataEvento, $evento, $id_evento) {
        $data=array(
            'dataEvento'=> $dataEvento,
            'evento'=> $evento
        );

        $this->db->update('Evento', $data, "evento_id = $id_evento");
    }

    public function getEventosFromDocente($id) {
        $query = $this->db->query(
            "SELECT Evento.* 
            FROM Evento, Docente_Evento
            WHERE Evento.evento_id = Docente_Evento.evento_id AND docente_id =$id");
        return $query->result();
    }

    public function getEventosPassOuFutFromDocente($id, $tempo) {
        $query = $this->db->query(
            "SELECT Evento.* 
            FROM Evento, Docente_Evento
            WHERE Evento.evento_id = Docente_Evento.evento_id 
            AND Evento.dataEvento $tempo CURRENT_DATE() AND docente_id =$id");
        return $query->result();
    }

    public function getEventosFromDisciplinasAtivasFromDocente($id) {
        $query = $this->db->query(
            "SELECT *
            FROM Evento, Disciplina_Evento, Disciplina
            WHERE Evento.evento_id = Disciplina_Evento.evento_id
                AND Disciplina.disciplina_id = Disciplina_Evento.disciplina_id
                AND Disciplina_Evento.disciplina_id 
                    IN  (SELECT Disciplina.disciplina_id
                        FROM Disciplina, Docente_Disciplina
                        WHERE Disciplina.disciplina_id = Docente_Disciplina.disciplina_id 
                        AND Docente_Disciplina.ativa = 1 AND docente_id = $id)");
        return $query->result();
    }

    public function getEventosPassOuFutFromDisciplinasAtivasFromDocente($id, $tempo) {
        $query = $this->db->query(
            "SELECT *
            FROM Evento, Disciplina_Evento, Disciplina
            WHERE Evento.evento_id = Disciplina_Evento.evento_id
                AND Disciplina.disciplina_id = Disciplina_Evento.disciplina_id
                AND Evento.dataEvento $tempo CURRENT_DATE()
                AND Disciplina_Evento.disciplina_id 
                    IN  (SELECT Disciplina.disciplina_id
                        FROM Disciplina, Docente_Disciplina
                        WHERE Disciplina.disciplina_id = Docente_Disciplina.disciplina_id 
                        AND Docente_Disciplina.ativa = 1 AND docente_id = $id)");
        return $query->result();
    }

    public function getDatasFinaisFromDocente($id) {
        $query = $this->db->query(
            "SELECT Trabalho.nome, Trabalho.datafinal, Trabalho.trabalho_id 
             FROM Trabalho, Disciplina_Trabalho, Disciplina
             WHERE Trabalho.trabalho_id = Disciplina_Trabalho.trabalho_id
                AND Disciplina_Trabalho.disciplina_id = Disciplina.disciplina_id
                AND Disciplina.disciplina_id 
                    IN( SELECT Disciplina.disciplina_id
                        FROM Disciplina, Docente_Disciplina
                        WHERE Disciplina.disciplina_id = Docente_Disciplina.disciplina_id
                        AND docente_id =$id)");
        return $query->result();
    }

    public function getDatasFinaisPassOuFutFromTrabalhosFromDocente($id, $tempo) {
        $query = $this->db->query(
            "SELECT Trabalho.datafinal, Trabalho.trabalho_id, Disciplina.nome
             FROM Trabalho, Disciplina_Trabalho, Disciplina
             WHERE Trabalho.trabalho_id = Disciplina_Trabalho.trabalho_id
                AND Disciplina_Trabalho.disciplina_id = Disciplina.disciplina_id
                AND Trabalho.datafinal $tempo CURRENT_DATE()
                AND Disciplina.disciplina_id 
                    IN( SELECT Disciplina.disciplina_id
                        FROM Disciplina, Docente_Disciplina
                        WHERE Disciplina.disciplina_id = Docente_Disciplina.disciplina_id
                        AND docente_id =$id)");
        return $query->result();
    }

    public function getDocentesSearch($term) { 
        $sql = $this->db->query('SELECT * FROM Docente WHERE UCASE(nome) like "%'. mysql_real_escape_string($term) .'%" order by nome asc limit 0,10');
        return $sql ->result();
    }

    public function getTemasFromDocente($id) {
        $query = $this->db->query(
            "SELECT Trabalho . tema 
             FROM Trabalho, Disciplina_Trabalho, Disciplina
             WHERE Trabalho.trabalho_id = Disciplina_Trabalho.trabalho_id
                AND Disciplina_Trabalho.disciplina_id = Disciplina.disciplina_id
                AND Disciplina.disciplina_id 
                    IN( SELECT Disciplina.disciplina_id
                        FROM Disciplina, Docente_Disciplina
                        WHERE Disciplina.disciplina_id = Docente_Disciplina.disciplina_id
                        AND docente_id =$id)");
        return $query->result();
    }

    public function getRandomTeachers() {
        $sql = $this->db->query('SELECT nome,docente_id FROM Docente ORDER BY RAND() LIMIT 4');
        return $sql->result();
    }    

    public function getAtiveorDisableDisciplinasFromDocente($id, $ativa) {
        $query = $this->db->query(
            "SELECT Disciplina . * 
            FROM Disciplina, Docente_Disciplina
            WHERE Disciplina.disciplina_id = Docente_Disciplina.disciplina_id 
            AND Docente_Disciplina.ativa = $ativa AND docente_id =$id");
        return $query->result();
    }

    public function getTrabalhosFromDocente($id) {
        $query = $this->db->query(
            "SELECT Trabalho . * 
             FROM Trabalho, Disciplina_Trabalho, Disciplina
             WHERE Trabalho.trabalho_id = Disciplina_Trabalho.trabalho_id
                AND Disciplina_Trabalho.disciplina_id = Disciplina.disciplina_id
                AND Disciplina.disciplina_id 
                    IN( SELECT Disciplina.disciplina_id
                        FROM Disciplina, Docente_Disciplina
                        WHERE Disciplina.disciplina_id = Docente_Disciplina.disciplina_id
                        AND docente_id =$id)");
        return $query->result();
    }

    public function getAtiveorDisableTrabalhosFromDocente($id, $ativa) {
        $query = $this->db->query(
            "SELECT Trabalho . * 
             FROM Trabalho, Disciplina_Trabalho, Disciplina
             WHERE Trabalho.trabalho_id = Disciplina_Trabalho.trabalho_id
                AND Disciplina_Trabalho.disciplina_id = Disciplina.disciplina_id
                AND Disciplina.disciplina_id 
                    IN( SELECT Disciplina.disciplina_id
                        FROM Disciplina, Docente_Disciplina
                        WHERE Disciplina.disciplina_id = Docente_Disciplina.disciplina_id
                        AND Docente_Disciplina.ativa = $ativa AND docente_id =$id)");
        return $query->result();
    }

    public function getAlunosFromDocente($id) {
        $query = $this->db->query(
            "SELECT DISTINCT Aluno.*
             FROM Aluno, Aluno_Disciplina, Disciplina
             WHERE Aluno.aluno_id = Aluno_Disciplina.aluno_id
                AND Aluno_Disciplina.disciplina_id = Disciplina.disciplina_id
                AND Disciplina.disciplina_id 
                    IN (SELECT Disciplina.disciplina_id 
                        FROM Disciplina, Docente_Disciplina
                        WHERE Disciplina.disciplina_id = Docente_Disciplina.disciplina_id 
                            AND Docente_Disciplina.docente_id =$id)");
        return $query->result();
    }

    public function isADisciplinaFromDocente($id_disciplina, $id_docente) {
        $query = $this->db->query(
            "SELECT *
             FROM Disciplina, Docente_Disciplina
             WHERE Disciplina.disciplina_id = Docente_Disciplina.disciplina_id
                AND Disciplina.disciplina_id = $id_disciplina
                AND Docente_Disciplina.docente_id = $id_docente");
        return $query->num_rows() === 1;
    }

    public function isATrabalhoFromDocente($id_trabalho, $id_docente) {
        $query = $this->db->query(
            "SELECT * 
             FROM Trabalho, Disciplina_Trabalho, Disciplina
             WHERE Trabalho.trabalho_id = Disciplina_Trabalho.trabalho_id
                AND Disciplina_Trabalho.disciplina_id = Disciplina.disciplina_id
                AND Trabalho.trabalho_id = $id_trabalho
                AND Disciplina.disciplina_id
                    IN(SELECT Disciplina.disciplina_id 
                    FROM Disciplina, Docente_Disciplina
                    WHERE Disciplina.disciplina_id = Docente_Disciplina.disciplina_id 
                        AND Docente_Disciplina.docente_id =$id_docente)");
        return $query->num_rows() === 1;
    }

    public function isDisciplinaAtiveFromDocente($id_disciplina) {
        $id_docente = $this->session->userdata('id');
        $query = $this->db->query(
            "SELECT Docente_Disciplina.ativa
            FROM Docente_Disciplina
            WHERE docente_id = $id_docente AND disciplina_id = $id_disciplina AND ativa = 1");
        return $query->num_rows();
    }

    public function active_disableDisciplinaFromDocente($id_disciplina) {
        $ativa = $this->isDisciplinaAtiveFromDocente($id_disciplina);
        $data = array(
            'docente_id' => $this->session->userdata('id'),
            'disciplina_id' => $id_disciplina,
            'ativa' => abs($ativa -1)
        );
        $this->db->update('Docente_Disciplina', $data, array('docente_id' => $this->session->userdata('id'),
            'disciplina_id' => $id_disciplina));
    }

    public function registoRapido() {
        $data=array(
            'password'=>$_POST['password'],
            'email'=>$_POST['email'],
            'nome'=>"",
            'ndocente'=>"",
            'sobre'=>"",
            'myAcademia'=>""
        );
        $data['password'] = md5($data['password']);
        $this->db->insert('Docente',$data);

        return $this->db->insert_id();
    }

    public function registo($id) {
        $data=array(
            'nome'=>$_POST['nome'],
            'ndocente'=>$_POST['ndocente'],
            'website'=>$_POST['website'],
            'cv'=>$_POST['cv'],
            'contatos'=>$_POST['contatos'],
            'sobre'=>$_POST['sobre'],
            'myAcademia'=>$_POST['myAcademia']
        );

        $this->load->library('upload');
        $file = $this->upload->data();
        if($file ["is_image"]) {
            $data['foto'] = "uploads/photos/teacher/". $file['file_name'];
        }
        
        $this->db->update('Docente', $data, "docente_id = $id");
    }

    public function inserir() {
        $data=array(
            'docente_id'=>$id,
            'password'=>$_POST['password'],
            'nome'=>$_POST['nome'],
            'ndocente'=>$_POST['ndocente'],
            'email'=>$_POST['email'],
            'website'=>$_POST['website'],
            'cv'=>$_POST['cv'],
            'contatos'=>$_POST['contatos'],
            'sobre'=>$_POST['sobre'],
            'myAcademia'=>$_POST['myAcademia']
        );

        $data['password'] = md5($data['password']);

        $this->load->library('upload');
        $file = $this->upload->data();
        if($file ["is_image"]) {
            $data['foto'] = "uploads/photos/teacher/". $file['file_name'];
        }
        
        $this->db->insert('Docente', $data);
        return $this->db->insert_id();
    }

    public function atualizar($id) {
        $data=array(
            'docente_id'=>$id,
            'password'=>$_POST['password'],
            'nome'=>$_POST['nome'],
            'ndocente'=>$_POST['ndocente'],
            'email'=>$_POST['email'],
            'website'=>$_POST['website'],
            'cv'=>$_POST['cv'],
            'contatos'=>$_POST['contatos'],
            'sobre'=>$_POST['sobre'],
            'myAcademia'=>$_POST['myAcademia']
        );

        $data['password'] = md5($data['password']);

        $this->load->library('upload');
        $file = $this->upload->data();
        if($file ["is_image"]) {
            $data['foto'] = "uploads/photos/teacher/". $file['file_name'];
        }
        
        $this->db->update('Docente', $data, "docente_id = $id");
    }

    public function apagar($id_docente) {
        $docente = $this->getDocente($id_docente);
        if (!empty($docente['foto'])) { unlink($docente['foto']); }
 
        $this->db->delete('Docente_Evento', array('docente_id'=>$id_docente));
        $this->db->delete('Docente_Disciplina', array('docente_id'=>$id_docente));
        $this->db->delete('Docente', array('docente_id'=>$id_docente));
    }  
}