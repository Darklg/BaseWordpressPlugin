<?php
/*
Plugin Name: DK Base WordPress Plugin
Plugin URI: http://github.com/Darklg/BaseWordpressPlugin
Description: Une base de travail pour développer un plugin WordPress
Author: Darklg
Version: 1
Author URI: http://darklg.me
*/

// Le nom du plugin, tel qu'il s'affichera dans le menu
define('dk_bwp_plugin_name', 'DK Base WordPress Plugin');

// Le slugin de la page d'administration
define('dk_bwp_pageslug', 'dk_bwp-settings');

// Le niveau minimal pour administrer ce plugin
define('dk_bwp_userlevel', 'manage_options');

// Si on essaie d'appeler directement le fichier du plugin.
$dk_bwp_partfile = explode('.', basename(__FILE__));
if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], $dk_bwp_partfile[0] . '/' . $dk_bwp_partfile[0] . '.php') !== FALSE) {
    header('location: /');
    exit();
}

// Le chemin d'accès au plugin
define('dk_bwp_path', dirname(__FILE__));

// Le chemin d'accès au fichier principal du plugin
define('dk_bwp_file', __FILE__);

// L'URL d'accès au plugin
define('dk_bwp_url', str_replace(ABSPATH, (site_url() . '/'), dirname(__FILE__)));

// Le basename du plugin
define('dk_bwp_basename', str_replace(ABSPATH . 'wp-content/plugins/', '', __FILE__));

// Par souci de performance du plugin, ces fichiers ne sont chargés que depuis l'administration.
if (is_admin()) {
    // Inclusion des actions d'activation/desactivation
    include dk_bwp_path . '/includes/active_inactive.php';
}