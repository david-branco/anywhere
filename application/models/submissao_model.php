<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Submissao_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getSubmissao($id) {
        $query = $this->db->get_where('Submissao',array('submissao_id'=>$id));
        return $query->row_array();
    }
    
    public function getSubmissoes() {
        $query = $this->db->query("SELECT * FROM Submissao");
        return $query->result();
    }

    public function getGrupoFromSubmissao($id) {
        $query = $this->db->query(
            "SELECT DISTINCT Grupo.*   
             FROM Grupo, Grupo_Submissao, Submissao
             WHERE Grupo.grupo_id = Grupo_Submissao.grupo_id
                AND Submissao.submissao_id = Grupo_Submissao.submissao_id
                AND Submissao.submissao_id 
                    IN (SELECT Submissao.submissao_id
                        FROM Submissao, Grupo_Submissao
                        WHERE Submissao.submissao_id = Grupo_Submissao.submissao_id
                        AND Submissao.submissao_id = $id)");
        return $query->row_array();
    }

    public function inserir($id_disciplina, $nomeAntigo, $id_trabalho, $id_grupo, $timeStamp) {

        if(empty($id_grupo)) { $id_grupo = $_POST['trabalho']; }

        $file = $this->upload->data();
        $pasta_grupo = "uploads/submissions/class".$id_disciplina."/work".$id_trabalho."/workteam".$id_grupo."/";
        $nome_ficheiro = $id_trabalho."-".$id_grupo."-".$timeStamp;

        $data=array(
            'nome' => $nomeAntigo,
            'tamanho' =>  $file['file_size'],
            'url' => $pasta_grupo.$nome_ficheiro.$file['file_ext'],
            'data' => $timeStamp,
            'descricao' => $_POST['descricao']
        );
        $this->db->insert('Submissao',$data);

        $id_submissao = $this->db->insert_id();
        $ligacao = array(
                'grupo_id' => $id_grupo,
                'submissao_id' => $id_submissao,
        );
        $this->db->insert('Grupo_Submissao', $ligacao);

        mkdir($pasta_grupo.$nome_ficheiro."/", 0777, true);
        $this->load->library('unzip');
        $this->unzip->extract($data['url'], $pasta_grupo.$nome_ficheiro);

        $trabalho = $this->trabalho_model->getTrabalho($id_trabalho);
        $mensagem = "";
        if($trabalho['tipoavaliacao'] > 1) { $mensagem = $this->trabalho_model->executaRegras($id_disciplina, $id_trabalho, $trabalho['tipoavaliacao'], $data['url']); }        
        return $mensagem;
    }

    public function downloadLatest($id_trabalho) {
        $data['subs'] = $this->trabalho_model->getUltimasSubmissoesFromTrabalho($id_trabalho);
        $disc = $this->trabalho_model->getDisciplinaFromTrabalho($id_trabalho);
        $trab = $this->trabalho_model->getTrabalho($id_trabalho);

        $pasta = "uploads/submissions/class".$disc->disciplina_id."/work".$id_trabalho."/temp/";
        remove_directory($pasta);
        mkdir($pasta, 0777, true);
        foreach($data['subs'] as $subs) {
            $sub = $this->getSubmissao($subs->submissao_id);
            copy($sub['url'], $pasta.$sub['nome']);
            $this->zip->read_file($pasta.$sub['nome']);
        }
        //$this->zip->archive($pasta.$trab['nome'].".zip");
        /*$string = strtolower($string);
        $string = str_replace(' ', '_', $string);
        $string = preg_replace('/[^a-z0-9_]/i', '', $string);*/

        $this->zip->download($trab['nome'].".zip");
    }

    public function apagar($id_submissao) {
        $this->load->helper('recursive_helper');
        $submissao = $this->getSubmissao($id_submissao);
        unlink($submissao['url']);
        remove_directory(current(explode('.',$submissao['url'])));
 
        $this->db->delete('Grupo_Submissao', array('submissao_id'=>$id_submissao));
        $this->db->delete('Submissao', array('submissao_id'=>$id_submissao));
    }
}