<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Disciplina_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function generateToken() {
        $character_array = array_merge(range('a', 'z'), range(0, 9));
        $token = "";
        for($i = 0; $i < 17; $i++) {
            $token .= $character_array[rand(0, (count($character_array) - 1))];
        }
        return $token;
    }
    
    public function getDisciplinasSearch($term) { 
        $sql = $this->db->query('SELECT * FROM Disciplina WHERE UCASE(nome) like "%'. mysql_real_escape_string($term) .'%" order by nome asc limit 0,10');
        return $sql ->result();
    }

    public function getDisciplina($id) {
        $query = $this->db->get_where('Disciplina',array('disciplina_id'=>$id));
        return $query->row_array();
    }

    public function getDisciplinaByToken($token) {
        $query = $this->db->get_where('Disciplina',array('token'=>$token));
        return $query->row_array();
    }

    public function getDisciplinas() {
        $query = $this->db->query("SELECT * FROM Disciplina");
        return $query->result();
    }

    public function getDocentesFromDisciplina($id) {
        $query = $this->db->query(
            "SELECT Docente. * 
             FROM Docente, Docente_Disciplina
             WHERE Docente.docente_id = Docente_Disciplina.docente_id AND disciplina_id = $id");
        return $query->result();
    }
    
    public function getTrabalhosFromDisciplina($id) {
        $query = $this->db->query(
            "SELECT Trabalho . * 
             FROM Trabalho, Disciplina_Trabalho
             WHERE Trabalho.trabalho_id = Disciplina_Trabalho.trabalho_id AND disciplina_id =$id");
        return $query->result();
    }
    
    public function getAlunosFromDisciplina($id) {
        $query = $this->db->query(
            "SELECT Aluno.*
             FROM Aluno, Aluno_Disciplina
             WHERE Aluno.aluno_id = Aluno_Disciplina.aluno_id AND disciplina_id = $id");
        return $query->result();
    }

    public function getSortedAlunosFromDisciplina($id) {
        $query = $this->db->query(
            "SELECT Aluno.*
            FROM Aluno, Aluno_Disciplina
            WHERE Aluno.aluno_id = Aluno_Disciplina.aluno_id AND disciplina_id = $id
            ORDER BY Aluno.nome ASC");
        return $query->result();
    }

    public function inserirEvento($dataEvento, $evento, $id_disciplina) {
        $data=array(
            'dataEvento'=> $dataEvento,
            'evento'=> $evento
        );
        $this->db->insert('Evento',$data);
        
        $id_evento = $this->db->insert_id();
        $ligacao = array(
            'disciplina_id' => $id_disciplina,
            'evento_id' => $id_evento
        );
        $this->db->insert('Disciplina_Evento', $ligacao);
    }

    public function atualizarEvento($dataEvento, $evento, $id_evento) {
        $data=array(
            'dataEvento'=> $dataEvento,
            'evento'=> $evento
        );

        $this->db->update('Evento', $data, "evento_id = $id_evento");
    }
    
    public function inserir($id_docente) {
        $data=array(
            'nome'=>$_POST['nome'],
            'coduc'=>$_POST['coduc'],
            'anoletivo'=>$_POST['anoletivo'],
            'curso'=>$_POST['curso'],
            'instituicao'=>$_POST['instituicao'],
            //'pauta'=>$_POST['pauta'],
            'token'=>$this->generateToken()
        );
        $this->db->insert('Disciplina',$data);
        
        $id_disciplina = $this->db->insert_id();
        $ligacao = array(
            'docente_id' => $id_docente,
            'disciplina_id' => $id_disciplina 
        );
        $this->db->insert('Docente_Disciplina', $ligacao);

        mkdir("./uploads/submissions/class".$id_disciplina."/", 0777, true);
        mkdir("./uploads/files/class".$id_disciplina."/", 0777, true);
        mkdir("./uploads/grades/class".$id_disciplina."/", 0777, true);

        return $id_disciplina;
    }    

    public function inserirAlunoEmDisciplina($id_aluno, $id_disciplina) {
        $data = array(
            'aluno_id' => $id_aluno,
            'disciplina_id' => $id_disciplina
        );
        $this->db->insert('Aluno_Disciplina',$data);

        $trabalhos = $this->getTrabalhosFromDisciplina($id_disciplina);
        foreach ($trabalhos as $trabalho) {
            $data = array(
                'aluno_id' => $id_aluno,
                'trabalho_id' => $trabalho->trabalho_id
            );
            $this->db->insert('Aluno_Trabalho',$data); 
        }      
    }

    public function inserirDocenteEmDisciplina($id_docente, $id_disciplina) {
        $data = array(
            'docente_id' => $id_docente,
            'disciplina_id' => $id_disciplina
        );
        $this->db->insert('Docente_Disciplina',$data);        
    }

    public function removerAlunoDeDisciplina($id_aluno, $id_disciplina) {
        $this->db->delete('Aluno_Disciplina', array('aluno_id'=>$id_aluno ,'disciplina_id'=>$id_disciplina));        
    }

    public function removerDocenteDeDisciplina($id_docente, $id_disciplina) {
        $this->db->delete('Docente_Disciplina', array('docente_id'=>$id_docente ,'disciplina_id'=>$id_disciplina));        
    }

    public function inserirAlunoLogadoEmDisciplina($id) {
        $data = array(
            'aluno_id' => $this->session->userdata('id'),
            'disciplina_id' => $id
        );
        $this->db->insert('Aluno_Disciplina',$data);        
    }

    public function inserirDocenteLogadoEmDisciplina($id) {
        $data = array(
            'docente_id' => $this->session->userdata('id'),
            'disciplina_id' => $id
        );
        $this->db->insert('Docente_Disciplina',$data);        
    }
    
    public function atualizar($id) {
        $data=array(
            'disciplina_id'=>$id,
            'nome'=>$_POST['nome'],
            'coduc'=>$_POST['coduc'],
            'anoletivo'=>$_POST['anoletivo'],
            'curso'=>$_POST['curso'],
            'instituicao'=>$_POST['instituicao'],
            //'pauta'=>$_POST['pauta']
            );
        $this->db->update('Disciplina', $data, "disciplina_id = $id");
    }

    public function apagar($id_disciplina) {
        $this->load->helper('recursive_helper');
        $trabs = $this->getTrabalhosFromDisciplina($id_disciplina);
        foreach ($trabs as $trab) {
            $this->trabalho_model->apagar($trab->trabalho_id, FALSE);
        }
        remove_directory("uploads/submissions/class".$id_disciplina);
        remove_directory("uploads/files/class".$id_disciplina);
        remove_directory("uploads/grades/class".$id_disciplina);
        $this->db->delete('Docente_Disciplina', array('disciplina_id'=>$id_disciplina));
        $this->db->delete('Aluno_Disciplina', array('disciplina_id'=>$id_disciplina));
        $this->db->delete('Disciplina_Evento', array('disciplina_id'=>$id_disciplina));
        $this->db->delete('Disciplina', array('disciplina_id'=>$id_disciplina));
    }

    public function downloadPautaPDF($id_disciplina) {

        $data['disciplina'] = $this->disciplina_model->getDisciplina($id_disciplina);
        $data['trabalhos'] = $this->disciplina_model->getTrabalhosFromDisciplina($id_disciplina);
        $data['alunos'] = $this->disciplina_model->getSortedAlunosFromDisciplina($id_disciplina);
        $pdfName = "class".$id_disciplina.".pdf";
        $path = "uploads/grades/class".$id_disciplina."/".$pdfName;
        if(file_exists($path)) { unlink($path); }
        $pdfFilePath = FCPATH.$path;
        $data['page_title'] = $data['disciplina']['nome']." (".$data['disciplina']['anoletivo'].")";

        if (file_exists($pdfFilePath) == FALSE) {
            ini_set('memory_limit','32M'); 
            $html = $this->load->view('disciplina/pautaExport', $data, true);
             
            $this->load->library('pdf');
            $pdf = $this->pdf->load();
            $pdf->SetFooter("Anywhere".'|{PAGENO}|'.date(DATE_RFC850));
            $pdf->WriteHTML($html); 
            $pdf->Output($pdfFilePath, 'F');
        }
        $this->download_model->push_file($path, $data['disciplina']['nome'].".pdf");
    }

    public function downloadPautaXML($id_disciplina) {

        $disciplina = $this->disciplina_model->getDisciplina($id_disciplina);
        $docentes   = $this->disciplina_model->getDocentesFromDisciplina($id_disciplina);
        $trabalhos  = $this->disciplina_model->getTrabalhosFromDisciplina($id_disciplina);

        $imp = new DOMImplementation;
        $dtd = $imp->createDocumentType('grade', '', '../grade.dtd');
        $xml = $imp->createDocument("", "", $dtd);
        $xml->encoding = 'UTF-8'; 
        $grade = $xml->createElement("grade");   

        $class = $xml->createElement("class");
        $class->setAttribute("id", $disciplina['disciplina_id']); 
        $cname = $xml->createElement("cname", xml_convert($disciplina['nome']));
        $class->appendChild($cname);
        $academic_year = $xml->createElement("academic_year", xml_convert($disciplina['anoletivo']));
        $class->appendChild($academic_year);
        $course = $xml->createElement("course", xml_convert($disciplina['curso']));
        $class->appendChild($course);        
        $institution = $xml->createElement("institution", xml_convert($disciplina['instituicao']));
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

        foreach($trabalhos as $trabalho) {
            $work = $xml->createElement("work");
            $work->setAttribute("id", $trabalho->trabalho_id);
            $wname = $xml->createElement("wname", xml_convert($trabalho->nome)); 
            $work->appendChild($wname);
            $importance = $xml->createElement("importance", xml_convert($trabalho->pesonota)); 
            $work->appendChild($importance);

            $grupos = $this->trabalho_model->getGruposFromTrabalho($trabalho->trabalho_id);
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
                    $avaliacao = $this->trabalho_model->getAvaliacaoFromAlunoFromTrabalho($aluno->aluno_id, $trabalho->trabalho_id);
                    if(!empty($avaliacao)) {
                        $evaluation = $xml->createElement("evaluation", xml_convert($avaliacao['avaliacao']));  
                    }
                    $member->appendChild($evaluation);
                    $workteam->appendChild($member);
                }
                $work->appendChild($workteam);
            }
            $grade->appendChild($work);
        }
        $xml->appendChild($grade);

        $xml->formatOutput = true;
        //echo "<xmp>". $xml->saveXML() ."</xmp>";
        $file_name = $id_disciplina.".xml";
        $file_path = "uploads/grades/class".$id_disciplina."/".$file_name;
        if(file_exists($file_path)) { unlink($file_path); }
        $xml->save(FCPATH.$file_path) or die("Error");
        $this->download_model->push_file($file_path, $disciplina['nome'].".xml");
    }

    public function importarPautaXML($id_disciplina) {

        $file_path = "uploads/grades/class".$id_disciplina."/grade.xml";
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
            $class = $doc->getElementsByTagName("class");
            $id = (int)$class->item(0)->getAttribute('id');
            if($id == $id_disciplina) {
                $works = $doc->getElementsByTagName("work");
                foreach($works as $work) {
                    $id_trabalho = (int)$work->getAttribute('id');
                    $members = $work->getElementsByTagName("member");
                    foreach($members as $member) {
                        $id_aluno = (int)$member->getAttribute('id');
                        $avaliacao = $member->getElementsByTagName("evaluation");
                        $this->aluno_model->avaliar2($id_aluno, $id_trabalho, $avaliacao->item(0)->nodeValue);
                    }            
                }
            }
            else { $erros = $erros."$item: "."This xml file does not belong to this class</br>"; }
        }
        return $erros;
    } 
}