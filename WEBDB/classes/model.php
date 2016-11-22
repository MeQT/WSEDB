<?php
class Model
{
	// Einträge als zweidimensionales Array
	private static $entries = array(
			array("title"=>"Eintrag 1", "content"=>"Ich bin der erste Eintrag."),
			array("title"=>"Eintrag 2", "content"=>"Ich bin der ewige Zweite!"),
			array("title"=>"Eintrag 3", "content"=>"Na dann bin ich die Nummer drei.")
	);

	// Gibt alle Eintäge zurück
	public static function getEntries()
	{
		return self::$entries;
	}

	// Gibt einen bestimmten Eintrag zurück
	public static function getEntry($id)
	{
		if(array_key_exists($id, self::$entries))
		{
			return self::$entries[$id];
		}
		else
		{
			return null;
		}
	}
}
?>