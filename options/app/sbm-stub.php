<?php

// Get the directories of this theme and the currently activated theme
$k2sbm_theme_path = get_theme_root() . DIRECTORY_SEPARATOR . get_option('template');
$k2sbm_k2_path = dirname(dirname(dirname(__FILE__)));

// Correct the paths
if(DIRECTORY_SEPARATOR != '/') {
	$k2sbm_theme_path = str_replace(DIRECTORY_SEPARATOR, '/', $k2sbm_theme_path);
	$k2sbm_k2_path = str_replace(DIRECTORY_SEPARATOR, '/', $k2sbm_k2_path);
}

// Is this K2?
if($k2sbm_theme_path == $k2sbm_k2_path) {
	// We only want this function to be exposed if this is K2
	function k2sbm_load() {
		// Only include SBM if no other plugin is installed for handling sidebars
		if(!function_exists('register_sidebar')) {
			require(dirname(__FILE__) . '/sbm.php');
			k2sbm::wp_bootstrap();
		}
	}

	// DON'T do this if we're activating another plugin
	// A mess may be caused
	if(!(basename($_SERVER['SCRIPT_FILENAME']) == 'plugins.php' and $_GET['action'] == 'activate')) {
		add_action('plugins_loaded', 'k2sbm_load', 1);
	}
}

?>
