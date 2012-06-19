<?php defined('SYSPATH') or die('No direct script access.');

class View_Minion_Task_Crons_Update extends Kostache {

	public function start_section()
	{
		$name = Kohana::$config->load('crons.unique_name');
		return '## START '.$name.' CRONS';
	}

	public function end_section()
	{
		$name = Kohana::$config->load('crons.unique_name');
		return '## END '.$name.' CRONS';
	}
}