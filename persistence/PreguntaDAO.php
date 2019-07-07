<?php
class PreguntaDAO{
	private $idPregunta;
	private $pregunta;

	function PreguntaDAO($pIdPregunta = "", $pPregunta = ""){
		$this -> idPregunta = $pIdPregunta;
		$this -> pregunta = $pPregunta;
	}

	function insert(){
		return "insert into Pregunta(pregunta)
				values('" . $this -> pregunta . "')";
	}

	function update(){
		return "update Pregunta set 
				pregunta = '" . $this -> pregunta . "'	
				where idPregunta = '" . $this -> idPregunta . "'";
	}

	function select() {
		return "select idPregunta, pregunta
				from Pregunta
				where idPregunta = '" . $this -> idPregunta . "'";
	}

	function selectAll() {
		return "select idPregunta, pregunta
				from Pregunta";
	}

	function selectAllOrder($orden, $dir){
		return "select idPregunta, pregunta
				from Pregunta
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idPregunta, pregunta
				from Pregunta
				where pregunta like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Pregunta
				where idPregunta = '" . $this -> idPregunta . "'";
	}
	//Get 20 at least
	function getRandomQuestions(){
	    return "select *
                from Pregunta
                order by rand()
                limit 20";
	}
	
	function getNextAuto(){
	    return "select AUTO_INCREMENT from INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA = 'sie26' and TABLE_NAME = 'Pregunta'";
	}
}
?>
