<?php
/*
Plugin Name: Custom Radio Player
Description: Plugin para añadir un reproductor de radio y gestionar la programación.
Version: 1.0
Author: Santiago Avilez
Author URI: https://santiagoavilez.com
Plugin URI: https://github.com/santiagoavilez/amcumbre.com
*/

// Asegúrate de que WordPress cargue el plugin correctamente.
defined('ABSPATH') or die('No script kiddies please!');

// Incluye archivos para la funcionalidad del reproductor y CPT.
require_once(plugin_dir_path(__FILE__) . 'includes/custom-cpt.php');
require_once(plugin_dir_path(__FILE__) . 'includes/shortcodes.php');
