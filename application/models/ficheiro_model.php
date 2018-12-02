<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ficheiro_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getFicheiro($id) {
        $query = $this->db->get_where('Ficheiro',array('ficheiro_id'=>$id));
        return $query->row_array();
    }

    public function getFicheiros() {
        $query = $this->db->query("SELECT * FROM Ficheiro");
        return $query->result();
    }

    public function getTrabalhoFromFicheiro($id) {
        $query = $this->db->query(
            "SELECT DISTINCT Trabalho.*   
             FROM Trabalho, Trabalho_Ficheiro, Ficheiro
             WHERE Trabalho.trabalho_id = Trabalho_Ficheiro.trabalho_id
                AND Ficheiro.ficheiro_id = Trabalho_Ficheiro.ficheiro_id
                AND Ficheiro.ficheiro_id 
                    IN (SELECT Ficheiro.ficheiro_id
                        FROM Ficheiro, Trabalho_Ficheiro
                        WHERE Ficheiro.ficheiro_id = Trabalho_Ficheiro.ficheiro_id
                        AND Ficheiro.ficheiro_id = $id)");
        return $query->row_array();
    }

    public function inserir($disciplina_id, $id_trabalho) {
        $file = $this->upload->data();

        $data=array(
            'nome'=>$file['file_name'],
            'url'=> "uploads/files/class".$disciplina_id."/work".$id_trabalho."/".$file['file_name'],
            'descricao' => $_POST['descricao']
            );
        $this->db->insert('Ficheiro',$data);

        $id_ficheiro = $this->db->insert_id();
        $ligacao = array(
                'trabalho_id' => $id_trabalho,
                'ficheiro_id' => $id_ficheiro,
            );
        $this->db->insert('Trabalho_Ficheiro', $ligacao);
    }

    public function atualizar($disciplina_id, $trabalho_id, $id_ficheiro, $upload) {
        $data=array(
            "descricao" => $_POST['descricao']
        );

        if($upload) {
            $fich = $this->getFicheiro($id_ficheiro);
            unlink($fich['url']);
            $file = $this->upload->data();
            $data['nome'] = $file['file_name'];
            $data['url'] = "uploads/files/class".$disciplina_id."/work".$trabalho_id."/".$file['file_name'];
        }
        $this->db->update('Ficheiro', $data, "ficheiro_id = $id_ficheiro");
    }

    public function apagar($id_ficheiro, $apagar) {
        $fich = $this->getFicheiro($id_ficheiro);
        if($apagar) { unlink($fich['url']); }
        $this->db->delete('Trabalho_Ficheiro', array('ficheiro_id'=>$id_ficheiro));
        $this->db->delete('Ficheiro', array('ficheiro_id'=>$id_ficheiro));
    }

    public function downloadAll($id_trabalho) {
        $data['ficheiros'] = $this->trabalho_model->getFicheirosFromTrabalho($id_trabalho);
        $disc = $this->trabalho_model->getDisciplinaFromTrabalho($id_trabalho);
        $trab = $this->trabalho_model->getTrabalho($id_trabalho);

        $pasta = "uploads/files/class".$disc->disciplina_id."/work".$id_trabalho."/temp/";
        remove_directory($pasta);
        mkdir($pasta, 0777, true);
        foreach($data['ficheiros'] as $ficheiro) {
            $ficheiro = $this->getFicheiro($ficheiro->ficheiro_id);
            copy($ficheiro['url'], $pasta.$ficheiro['nome']);
            $this->zip->read_file($pasta.$ficheiro['nome']);
        }

        $this->zip->download("Files from ".$trab['nome'].".zip");
    }
}
