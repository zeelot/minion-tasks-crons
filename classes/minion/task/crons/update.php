<?php defined('SYSPATH') or die('No direct script access.');

class Minion_Task_Crons_Update extends Minion_Task {

	public function execute(array $config)
	{
		$crons = Kostache::factory('minion/task/crons/update');

		$current = $this->get_crontab();
		$start_section = $crons->start_section();
		$end_section = $crons->end_section();

		if (substr($current, -1) != "\n")
		{
			$current .= "\n";
		}

		$filename = $this->unique_filename();
		$pattern = '/^'.preg_quote($start_section).'\n(.*\n)*'.preg_quote($end_section).'$/m';

		if (preg_match($pattern, $current, $matches))
		{
			$current = preg_replace($pattern, $crons->render(), $current);
		}
		else
		{
			$current .= $crons->render();
		}

		file_put_contents($filename, $current);
		ob_start();
		system('crontab '.escapeshellarg($filename));
		$output = ob_get_clean();

		unlink($filename);

		return ($output === '');
	}

	protected function get_crontab()
	{
		ob_start();
		system('crontab -l');
		$crontab = ob_get_clean();

		return $crontab;
	}

	protected function unique_filename()
	{
		do
		{
			$unique_filename = realpath(sys_get_temp_dir()).DIRECTORY_SEPARATOR.Text::random();
		}
		while (file_exists($unique_filename));

		return $unique_filename;
	}
}