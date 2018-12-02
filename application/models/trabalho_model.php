<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trabalho_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUltimasSubmissoesFromTrabalho($id_trabalho) {
        $query = $this->db->query(
            "SELECT t1.*, MAX(submissao_id) AS submissao_id
             FROM Trabalho_Grupo t1 INNER JOIN Grupo_Submissao t2 ON t1.grupo_id = t2.grupo_id
             WHERE trabalho_id = $id_trabalho
             GROUP BY t1.trabalho_id, t1.grupo_id");
        return $query->result();
    }
    
    public function getTrabalhosSearch($term) { 
        $sql = $this->db->query('SELECT * FROM Trabalho WHERE UCASE(tema) like "%'. mysql_real_escape_string($term) .'%" order by nome asc limit 0,10');
        return $sql ->result();
    }

    public function getRandomThemes() {
        $sql = $this->db->query('SELECT tema FROM Trabalho ORDER BY RAND() LIMIT 4');
        return $sql->result();
    }
    
    public function getTrabalho($id) {
        $query = $this->db->get_where('Trabalho',array('trabalho_id'=>$id));
        return $query->row_array();
    }

    public function getTrabalhos() {
        $query = $this->db->query("SELECT * FROM Trabalho");
        return $query->result();
    }

    public function getGruposFromTrabalho($id) {
        $query = $this->db->query(
            "SELECT DISTINCT Grupo.* 
            FROM Grupo, Trabalho_Grupo 
            WHERE Grupo.grupo_id = Trabalho_Grupo.grupo_id 
                AND Trabalho_Grupo.trabalho_id = $id 
                ORDER BY CAST(SUBSTRING(Grupo.nome,LOCATE(' ',Grupo.nome)+1) AS SIGNED)");
        return $query->result();
    }

/*    public function getAlunosFromTrabalho($id) {
        $query = $this->db->query(
            "SELECT Aluno.*
            FROM Aluno, Aluno_Disciplina
            WHERE Aluno.aluno_id = Aluno_Disciplina.aluno_id 
                AND disciplina_id
                    IN (SELECT Disciplina.disciplina_id
                        FROM Disciplina, Disciplina_Trabalho
                        WHERE Disciplina.disciplina_id = Disciplina_Trabalho.disciplina_id 
                            AND Disciplina_Trabalho.trabalho_id = $id)");
        return $query->result();
    }*/

    public function getAvaliacaoFromAlunoFromTrabalho($id_aluno, $id_trabalho) {
        $query = $this->db->query(
            "SELECT Aluno_Trabalho.avaliacao 
            FROM Aluno, Aluno_Trabalho
            WHERE Aluno.aluno_id = Aluno_Trabalho.aluno_id 
                AND Aluno.aluno_id = $id_aluno
                AND Aluno_Trabalho.trabalho_id = $id_trabalho");
        return $query->row_array();
    }

    public function getAlunosFromTrabalho($id) {
        $query = $this->db->query(
            "SELECT DISTINCT *
             FROM Aluno_Trabalho, Aluno
             WHERE Aluno.aluno_id = Aluno_Trabalho.aluno_id
                AND Aluno_Trabalho.trabalho_id = $id_trabalho");
        return $query->result();
    }

    public function getDocentesFromTrabalho($id) {
        $query = $this->db->query(
            "SELECT Docente.*
            FROM Docente, Docente_Disciplina
            WHERE Docente.docente_id = Docente_Disciplina.docente_id 
                AND disciplina_id
                    IN (SELECT Disciplina.disciplina_id
                        FROM Disciplina, Disciplina_Trabalho
                        WHERE Disciplina.disciplina_id = Disciplina_Trabalho.disciplina_id 
                            AND Disciplina_Trabalho.trabalho_id = $id)");
        return $query->result();
    }

    public function getGrupoFromAlunoFromTrabalho($id_aluno, $id_trabalho) {
        $query = $this->db->query(
            "SELECT Grupo.* 
            FROM Grupo_Aluno, Grupo, Trabalho_Grupo
            WHERE Grupo_Aluno.grupo_id = Grupo.grupo_id 
                AND Trabalho_Grupo.grupo_id = Grupo.grupo_id
                AND Grupo_Aluno.aluno_id = $id_aluno
                AND Trabalho_Grupo.trabalho_id = $id_trabalho");
            return $query->row_array();
    }

    public function getDisciplinaFromTrabalho($id) {
        $query = $this->db->query(
            "SELECT Disciplina.*
             FROM Disciplina, Disciplina_Trabalho
             WHERE Disciplina.disciplina_id = Disciplina_Trabalho.disciplina_id AND Disciplina_Trabalho.trabalho_id = $id");
        return $query->row();
    }

    public function getDisciplinaIDFromTrabalho($id) {
        $query = $this->db->query(
            "SELECT Disciplina.disciplina_id
             FROM Disciplina, Disciplina_Trabalho
             WHERE Disciplina.disciplina_id = Disciplina_Trabalho.disciplina_id AND Disciplina_Trabalho.trabalho_id = $id");
        return $query->row_array();
    }

    public function getFicheirosFromTrabalho($id_trabalho) {
        $query = $this->db->query(
            "SELECT *
             FROM Trabalho_Ficheiro, Ficheiro
             WHERE Ficheiro.ficheiro_id = Trabalho_Ficheiro.ficheiro_id
                AND Trabalho_Ficheiro.trabalho_id = $id_trabalho");
        return $query->result();
    }

    public function alunoHasGrupoInTrabalho($id_aluno, $id_trabalho) {
        $query = $this->db->query(
            "SELECT DISTINCT *
             FROM Aluno, Trabalho_Grupo, Grupo_Aluno
             WHERE Aluno.aluno_id = Grupo_Aluno.aluno_id
                AND Trabalho_Grupo.grupo_id = Grupo_Aluno.grupo_id 
                AND Aluno.aluno_id = $id_aluno
                AND Grupo_Aluno.grupo_id 
                    IN (SELECT DISTINCT Grupo.grupo_id
                        FROM Grupo, Trabalho_Grupo
                        WHERE Grupo.grupo_id = Trabalho_Grupo.grupo_id
                        AND Trabalho_Grupo.trabalho_id = $id_trabalho)");
        return $query->num_rows() === 1;
    }
    
    public function showVisibilidade($val) {
        return (($val == 1)?  "Private" : 
                (($val == 2)? "Public" : "Protected"));                               
    }

    public function showAtraso($val) {
        return (($val == 1)?  "No" : 
                (($val == 2)? "Yes" : "With Penalty"));                               
    }

    public function showTipoAvaliacao($val) {
        return (($val == 1)?  "Manual" : 
               (($val == 2)?  "SIP" : "Test Comparison"));                    
    }

    public function showLinguagem($val) {
        return (($val == 1)?  "C" : 
               (($val == 2)?  "Perl" : "Ruby")); 
    }

    public function inserir($ficheiros) {
        $data=array(
            'nome'=>$_POST['nome'],
            'datainicial'=>$_POST['datainicial'],
            'datafinal'=>$_POST['datafinal'],
            'visibilidade'=>$_POST['visibilidade'],
            'descricao'=>$_POST['descricao'],
            'tema'=>$_POST['tema'],
            'datagrupos'=>$_POST['datagrupos'],
            'datarepositorio'=>$_POST['datarepositorio'],
            'limitesubmissao'=>$_POST['limitesubmissao'],
            'atraso'=>$_POST['atraso'],
            'desconto'=>$_POST['desconto'],
            'pesonota'=>$_POST['pesonota'],
            'tipoavaliacao'=>$_POST['tipoavaliacao'] 
        );

        if (isset($data['datagrupos']))      { $data['datagrupos'] = $data['datafinal'];      }
        if (isset($data['limitesubmissao'])) { $data['limitesubmissao'] = $data['datafinal']; }
        if (isset($data['datarepositorio'])) { $data['datarepositorio'] = $data['datafinal']; }
        if (isset($data['pesonota']))        { $data['pesonota'] = "100"; }
        //if (isset($data['desconto'])) { $data['desconto'] = 0; }

        $this->db->insert('Trabalho',$data);

        $id_disciplina = $_POST['disciplina'];
        $id_trabalho = $this->db->insert_id();
        $ligacao = array(
            'disciplina_id' => $id_disciplina,
            'trabalho_id' => $id_trabalho
        );

        $this->db->insert('Disciplina_Trabalho', $ligacao);
        mkdir("./uploads/submissions/class".$id_disciplina."/work".$id_trabalho."/", 0777, true);
        mkdir("./uploads/files/class".$id_disciplina."/work".$id_trabalho."/", 0777, true);
        mkdir("./uploads/grades/class".$id_disciplina."/work".$id_trabalho."/", 0777, true);

        if(!empty($ficheiros)) {
            $origem = "uploads/files/temp/";
            $destino = "uploads/files/class".$id_disciplina."/work".$id_trabalho."/rules/";
            $regras['regrasurl'] = $destino;
            mkdir($destino, 0777, true);
            foreach ($ficheiros as $ficheiro) {
                copy($origem.$ficheiro['file_name'], $destino.$ficheiro['file_name']);
            }     

            $this->db->update('Trabalho', $regras, "trabalho_id = $id_trabalho");
            $this->criarRegras($ficheiros, $regras['regrasurl'], (int)$_POST['linguagem']);     
        }

        $alunos = $this->disciplina_model->getAlunosFromDisciplina($id_disciplina);
        foreach ($alunos as $aluno) {
            $data = array(
                'aluno_id' => $aluno->aluno_id,
                'trabalho_id' => $id_trabalho
            );
            $this->db->insert('Aluno_Trabalho',$data); 
        }

        return $id_trabalho;
    }

    public function atualizar($id_disciplina, $id_trabalho, $ficheiros) {
        $data=array(
            'trabalho_id'=>$id_trabalho,
            'nome'=>$_POST['nome'],
            'datainicial'=>$_POST['datainicial'],
            'datafinal'=>$_POST['datafinal'],
            'visibilidade'=>$_POST['visibilidade'],
            'descricao'=>$_POST['descricao'],
            'tema'=>$_POST['tema'],
            'datagrupos'=>$_POST['datagrupos'],
            'datarepositorio'=>$_POST['datarepositorio'],
            'limitesubmissao'=>$_POST['limitesubmissao'],
            'atraso'=>$_POST['atraso'],
            'desconto'=>$_POST['desconto'],
            'pesonota'=>$_POST['pesonota'],
            'tipoavaliacao'=>$_POST['tipoavaliacao'] 
        );
        $this->db->update('Trabalho', $data, "trabalho_id = $id_trabalho");

        if(empty($ficheiros)) {
            $regras['regrasurl'] = "";
            $this->db->update('Trabalho', $regras, "trabalho_id = $id_trabalho");
        }

        else {            
            $origem = "uploads/files/temp/";
            $destino = "uploads/files/class".$id_disciplina."/work".$id_trabalho."/rules/";
            $regras['regrasurl'] = $destino;
            foreach ($ficheiros as $ficheiro) {
                copy($origem.$ficheiro['file_name'], $destino.$ficheiro['file_name']);
            }           

            $this->db->update('Trabalho', $regras, "trabalho_id = $id_trabalho");
            $this->criarRegras($ficheiros, $regras['regrasurl'], (int)$_POST['linguagem']); 
        }
    }

    public function apagar($id_trabalho, $apagar) {
        $this->load->helper('recursive_helper');
        $fichs = $this->getFicheirosFromTrabalho($id_trabalho);
        foreach ($fichs as $fich) {
            $this->ficheiro_model->apagar($fich->ficheiro_id, FALSE);
        }
        $grupos = $this->getGruposFromTrabalho($id_trabalho);
        foreach ($grupos as $grupo) {
            $this->grupo_model->apagar($grupo->grupo_id, $id_trabalho, FALSE);
        }

        $disc = $this->getDisciplinaFromTrabalho($id_trabalho);
        if($apagar) {
            remove_directory("uploads/submissions/class".$disc->disciplina_id."/work".$id_trabalho);
            remove_directory("uploads/files/class".$disc->disciplina_id."/work".$id_trabalho);
            remove_directory("uploads/grades/class".$disc->disciplina_id."/work".$id_trabalho);
        }
        $this->db->delete('Disciplina_Trabalho', array('trabalho_id'=>$id_trabalho));
        $this->db->delete('Aluno_Trabalho', array('trabalho_id'=>$id_trabalho));
        $this->db->delete('Trabalho', array('trabalho_id'=>$id_trabalho));
    }

    public function downloadPautaPDF($id_trabalho) {

        $data['disciplina'] = $this->trabalho_model->getDisciplinaFromTrabalho($id_trabalho);
        $data['trabalho'] = $this->trabalho_model->getTrabalho($id_trabalho);
        $data['alunos'] = $this->disciplina_model->getSortedAlunosFromDisciplina($data['disciplina']->disciplina_id);

        $pdfName = "work".$data['trabalho']['trabalho_id'].".pdf";
        $path = "uploads/grades/class".$data['disciplina']->disciplina_id."/work".$id_trabalho."/".$pdfName;
        if(file_exists($path)) { unlink($path); }
        $pdfFilePath = FCPATH.$path;
        $data['page_title'] = $data['trabalho']['nome']." (".$data['disciplina']->anoletivo.")";

        if (file_exists($pdfFilePath) == FALSE) {
            ini_set('memory_limit','32M'); 
            $html = $this->load->view('trabalho/pautaExport', $data, true);
             
            $this->load->library('pdf');
            $pdf = $this->pdf->load();
            $pdf->SetFooter("Anywhere".'|{PAGENO}|'.date(DATE_RFC850));
            $pdf->WriteHTML($html); 
            $pdf->Output($pdfFilePath, 'F');
        }
       $this->download_model->push_file($path, $data['trabalho']['nome'].".pdf");
    }

    public function downloadPautaXML($id_trabalho) {

        $disciplina = $this->trabalho_model->getDisciplinaFromTrabalho($id_trabalho);
        $docentes   = $this->disciplina_model->getDocentesFromDisciplina($disciplina->disciplina_id);
        $trabalho   = $this->trabalho_model->getTrabalho($id_trabalho);
        $grupos     = $this->trabalho_model->getGruposFromTrabalho($id_trabalho);

        $imp = new DOMImplementation;
        $dtd = $imp->createDocumentType('grade', '', '../../grade.dtd');
        $xml = $imp->createDocument("", "", $dtd);
        $xml->encoding = 'UTF-8'; 
        $grade = $xml->createElement("grade");    

        $class = $xml->createElement("class");
        $class->setAttribute("id", $disciplina->disciplina_id); 
        $cname = $xml->createElement("cname", xml_convert($disciplina->nome));
        $class->appendChild($cname);
        $academic_year = $xml->createElement("academic_year", xml_convert($disciplina->anoletivo));
        $class->appendChild($academic_year);
        $course = $xml->createElement("course", xml_convert($disciplina->curso));
        $class->appendChild($course);        
        $institution = $xml->createElement("institution", xml_convert($disciplina->instituicao));
        $class->appendChild($institution);
        $grade->appendChild($class);

        $teachers = $xml->createElement("teachers");
        foreach($docentes as $docente) {
            $teacher = $xml->createElement("teacher");
            $teacher->setAttribute("id", $docente->docente_id);
            $tname = $xml->createElement("tname", xml_convert($docente->nome));
            $teacher->appendChild($tname);
            $tnumber = $xml->createElement("tnumber", xml_convert($docente->ndocente));
            $teacher->appendChild($tnumber);
            $temail = $xml->createElement("temail", xml_convert($docente->email));
            $teacher->appendChild($temail);
            $teachers->appendChild($teacher); 
        }
        $grade->appendChild($teachers);

        $work = $xml->createElement("work");
        $work->setAttribute("id", $trabalho['trabalho_id']);
        $wname = $xml->createElement("wname", xml_convert($trabalho['nome'])); 
        $work->appendChild($wname);
        $importance = $xml->createElement("importance", xml_convert($trabalho['pesonota'])); 
        $work->appendChild($importance);

        foreach($grupos as $grupo) {
            $workteam = $xml->createElement("workteam");
            $workteam->setAttribute("id", $grupo->grupo_id);
            $wtname = $xml->createElement("wtname", xml_convert($grupo->nome));  
            $workteam->appendChild($wtname);
            $alunos = $this->grupo_model->getAlunosFromGrupo($grupo->grupo_id);
            foreach($alunos as $aluno) {
                $member = $xml->createElement("member");
                $member->setAttribute("id", $aluno->aluno_id);
                $mname = $xml->createElement("mname", xml_convert($aluno->nome));  
                $member->appendChild($mname);
                $mnunber = $xml->createElement("mnumber", xml_convert($aluno->naluno));  
                $member->appendChild($mnunber);
                $memail = $xml->createElement("memail", xml_convert($aluno->email));  
                $member->appendChild($memail);
                $avaliacao = $this->trabalho_model->getAvaliacaoFromAlunoFromTrabalho($aluno->aluno_id, $id_trabalho);
                $evaluation = $xml->createElement("evaluation", xml_convert($avaliacao['avaliacao']));  
                $member->appendChild($evaluation);
                $workteam->appendChild($member);
            }
            $work->appendChild($workteam);
        }
        $grade->appendChild($work);
        $xml->appendChild($grade);

        $xml->formatOutput = true;
        //echo "<xmp>". $xml->saveXML() ."</xmp>";
        $file_name = $id_trabalho.".xml";
        $file_path = "uploads/grades/class".$disciplina->disciplina_id."/work".$id_trabalho."/".$file_name;
        if(file_exists($file_path)) { unlink($file_path); }
        $xml->save(FCPATH.$file_path) or die("Error");
        $this->download_model->push_file($file_path, $trabalho['nome'].".xml");
    }

    public function importarPautaXML($id_disciplina , $id_trabalho) {

        $file_path = "uploads/grades/class".$id_disciplina."/work".$id_trabalho."/grade.xml";
        libxml_use_internal_errors(true);
        $doc = new DOMDocument();
        $doc->load(FCPATH.$file_path);
        $erros = "";
        $item = 1;
        if (!$doc->validate()) {
            foreach (libxml_get_errors() as $error) {
                $erros = $erros."$item: ".$error->message.";</br>";
                $item++;
            }
            libxml_clear_errors();
        }
        else {
            $work = $doc->getElementsByTagName("work");
            $id = (int)$work->item(0)->getAttribute('id');
            if($id == $id_trabalho) {
                $members = $doc->getElementsByTagName("member");
                foreach($members as $member) {
                    $id_aluno = (int)$member->getAttribute('id');
                    $avaliacao = $member->getElementsByTagName("evaluation");
                    $this->aluno_model->avaliar2($id_aluno, $id_trabalho, $avaliacao->item(0)->nodeValue);
                }
            }
            else { $erros = $erros."$item: "."This xml file does not belong to this work</br>"; }            
        }
        return $erros;
    }

    public function criarRegras($ficheiros, $regrasurl, $ling) {
        $this->load->helper('file');

        $linguagem = $this->showLinguagem($ling)."\n";
        $path = $regrasurl."\n";
        $files = "#BEGIN TESTES\n";
        foreach($ficheiros as $ficheiro) {
            if($ficheiro['file_ext'] == ".in") {
                $files = $files .$ficheiro['file_name']."\n";
            }
        }
        $files = $files."#END TESTES";

        write_file("./".$regrasurl."/rules", $linguagem.$path.$files, "w");
    }

    public function executaRegras($id_disciplina, $id_trabalho, $tipoAvaliacao, $zipPath) {
        if($tipoAvaliacao == 2) {
            $mensagem = exec("sudo ruby eval.rb SIP $zipPath");
        }
        else {
            $rulesPath = "uploads/files/class$id_disciplina/work$id_trabalho/rules/rules";
            $mensagem = system("sudo ruby eval.rb Comparison $zipPath $rulesPath");
            echo "sudo ruby eval.rb Comparison $zipPath $rulesPath";
            echo $mensagem;
        }
        return $mensagem;
    }
}