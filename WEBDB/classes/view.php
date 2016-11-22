<?php
class View
{
	//Pfad zum Template
	private $path = 'templates';
	// Name des Templates
	private $template = 'default';

	//Enthält die Variabeln, die in das Template eingebetet werden sollen
	private $_ = array();

	/**
	 * Ordnet eine Variable einem bestimmten Schlüssel zu
	 * 
	 * @param String $key Schlüssel
	 * @param String $value Variable
	 */
	public function assign($key, $value)
	{
		$this->_[$key] = $value;
	}

	/**
	 * Setzt den Namen des Templates
	 * 
	 * @param string $template
	 */
	public function setTemplate($template = 'default')
	{
		$this->template = $template;
	}

	/**
	 * Template-File laden und zurückgeben
	 * 
	 * @return string Output
	 */
	public function loadTemplate()
	{
		$tpl = $this->template;
		// Pfad zum Template erstellen & überprüfen ob das Template existiert
		$file = $this-> path . DIRECTORY_SEPARATOR . $tpl . '.php';
		$exists = file_exists($file);

		if($exists)
		{
			// Output des Scriptes wird in einen Buffer gespeichert, d.h. nicht gleich ausgegeben
			ob_start();
			
			//Template-File wird eingebunden und dessen Ausgabe in $output gespeichert
			include $file;
			$output = ob_get_contents();
			ob_end_clean();
			
			// Output zurückgeben
			return $output;
		}
		else
		{			
			return 'could not find template';
		}
	}
}
?>
