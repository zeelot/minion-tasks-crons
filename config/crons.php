<?php defined('SYSPATH') or die('No direct script access.');

return array(
	/**
	 * This needs to be unique in order to replace the crons for this app alone.
	 * The unique name is used as a separator in the crons file to allow minion
	 * to detect the section to replace. I've defaulted it to APPPATH because
	 * that will be unique to a specific deployment of an app. However, if you
	 * alter your deploy scripts to use a different path, make sure to clean up
	 * your crons!
	 */
	'unique_name' => APPPATH,
);