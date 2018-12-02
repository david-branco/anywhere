<?php
    echo "<h2>Submetido com Sucesso !</h2><br/>";
    echo "Keyname: ".$_POST['keyname']."<br/>";
    echo "Title: ".$_POST['title']."<br/>";
    echo "Subtitle: ".$_POST['subtitle']."<br/>";
    echo "Course: ".$_POST['course']."<br/>";
    echo "Class: ".$_POST['class']."<br/>";
    echo "SDate: ".$_POST['sdate']."<br/>";
    echo "EDate: ".$_POST['edate']."<br/><br/>";

    echo "Supervisor<br/>";
    echo "Name: ".$_POST['sName']."<br/>";
    echo "Email: ".$_POST['sEmail']."<br/>";
    echo "Webpage: ".$_POST['sWebpage']."<br/><br/>";
    
    echo "Workteam<br/>";
    echo "Name: ".$_POST['wName']."<br/>";
    echo "Email: ".$_POST['wEmail']."<br/>";
    echo "Webpage: ".$_POST['wWebpage']."<br/><br/>";
    
    echo "Abstract: ".$_POST['abstract']."<br/><br/>";
    
    echo "Files : <br/>";
    $no_files = 0;
	
	foreach($_FILES as $file) {
    
    	if($file['error'] > 0 && $no_files > 0){
        	print "ERROR : " . $file['error'];
    	}
    	else {
        	if(file_exists("uploads/".$file['name']) && $no_files >0) {
            	print "<p> Ficheiro existe no repositorio</p>";
        	}
        	else {
            move_uploaded_file($file['tmp_name'],"uploads/".$file['name']);
            echo $file['name']."<br/>";
        	}
    	}
    $no_files++;
	}

?>