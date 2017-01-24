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
		unset($_SESSION['questionNumber']);
		unset($_SESSION['questionText']);
		unset($_SESSION['answerText']);
		unset($_SESSION['personSum']);
		$this->db = new DB();		
		if (isset($_POST['surveyID'])) {
			$_SESSION['sum'] = 0;
			$_SESSION['surveyID'] = $_POST['surveyID'];
			$_SESSION['questionNumber'] = 0;
			$_SESSION['questionText'] = $this->db->getResultQuestions($_SESSION['surveyID'])[$_SESSION['questionNumber']];
			$_SESSION['answerText'] = $this->db->getAnswerText($_SESSION['surveyID']);
			$_SESSION['personSum'] = $this->db->getAttendencesQuestions($_SESSION['surveyID'], $this->db->getQuestionIDs($_SESSION['surveyID'])[$_SESSION['questionNumber']]);
			$this->view('/survey/result',$this->db->getResultAnswers($_SESSION['surveyID']));
		}		
	}
	
	public function nextQuestion() {
		$this->db = new DB();
		if (isset($_SESSION['surveyID'])) {
			if ($_SESSION['questionNumber'] < count($this->db->getResultAnswers($_SESSION['surveyID']))-1) {
				$_SESSION['questionNumber']++;
				$_SESSION['questionText'] = $this->db->getResultQuestions($_SESSION['surveyID'])[$_SESSION['questionNumber']];				
			}		
			
			$this->view('/survey/result',$this->db->getResultAnswers($_SESSION['surveyID']));
		}
	}
}
