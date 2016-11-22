<?php
class Controller
{
	private $request = null;
	private $template = '';
	private $view = null;

	/**
	 * Konstruktor erstellt den Controller
	 * 
	 * @param Array $request
	 */
	public function __construct($request)
	{
		$this->view = new View();
		$this->request = $request;
		$this->template = !empty($request['view']) ? $request['view'] : 'default';
	}

	// Methode zum Anzeigen des Contents
	public function display()
	{
		$innerView = new View();
		switch($this->template)
		{
			case 'entry':
				$innerView->setTemplate('entry');
				$entryid = $this->request['id'];
				$entry = Model::getEntry($entryid);
				$innerView->assign('title', $entry['title']);
				$innerView->assign('content', $entry['content']);
				break;

			case 'default':
			default:
				$entries = Model::getEntries();
				$innerView->setTemplate('default');
				$innerView->assign('entries', $entries);
		}
		$this->view->setTemplate('testimeter');
		$this->view->assign('testimeter_title', 'Der Titel des Testimeters');
		$this->view->assign('testimeter_footer', 'Ein Testimeter von und mit MVC');
		$this->view->assign('testimeter_content', $innerView->loadTemplate());
		return $this->view->loadTemplate();
	}
}
?>
