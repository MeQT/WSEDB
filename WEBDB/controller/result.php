<?php
require_once 'nav.php';
require_once 'core/database.php';

class result extends controller {
	private $db;
	public function __construct() {
		session_start();		
	}
	public function getResults() {
		//session_start();
		unset($_SESSION['sum']);
		unset($_SESSION['surveyID']);
		$this->db = new DB();		
		if (isset($_POST['surveyID'])) {
			$_SESSION['sum'] = 0;
			$_SESSION['surveyID'] = $_POST['surveyID'];
			$this->view('/survey/result',$this->db->getResultAnswers($_POST['surveyID']));
		}		
	}
	
	public function nextQuestion() {
		$this->db = new DB();
		if (isset($_SESSION['surveyID'])) {
			if ($_SESSION['sum'] < count($this->db->getResultAnswers($_SESSION['surveyID']))) {
				$_SESSION['sum']++;
			}		
			
			$this->view('/survey/result',$this->db->getResultAnswers($_SESSION['surveyID']));
		}
	}
}
