<?php
/*
Plugin Name: BaseWordpressPlugin
Plugin URI: http://github.com/Darklg/BaseWordpressPlugin
Description: FrameWork de plugin pour WordPress
Author: Darklg
Version: 1
Author URI: http://darklg.me
*/


class BaseWordpressPlugin {
	
	private $options = array();

	function __construct() {
		
		// Recuperation des options
		$this->set_options();
		
		// Lancement des fonctions publiques
		$this->plugin_hooks();
		
		// Lancement des fonctions spécifiques à l'admin
		if(is_admin()){
			$this->admin_hooks();
		}
	}
	
	private function set_options(){
		$this->options = array(
			'plugin_name' => 'BaseWordpressPlugin',
			'plugin_userlevel' => 'manage_options',
			'plugin_menutype' => 'index.php',
			'plugin_pageslug' => 'basewordpressplugin-settings',
			'plugin_dir' => str_replace(ABSPATH,(site_url().'/'),dirname(__FILE__)),
			'plugin_basename' => str_replace(ABSPATH.'wp-content/plugins/','',__FILE__)
		);
	}
	
	private function plugin_hooks(){
		register_activation_hook(__FILE__, array(&$this, 'plugin_activation'));
		register_deactivation_hook(__FILE__, array(&$this, 'plugin_desactivation'));
		register_uninstall_hook(__FILE__, array(&$this, 'plugin_uninstall'));
	}
	
	private function admin_hooks(){
		add_action( 'admin_menu', array(&$this, 'admin_menu'));
		add_action( 'admin_head', array(&$this, 'admin_css_js'));
	}
	
	// Lancé à l'activation du plugin
	private function plugin_activation() {

	}

	// Lancé à la désactivation du plugin
	private function plugin_desactivation() {

	}
	// Lancé à la désinstallation du plugin
	private function plugin_uninstall() {

	}
	
	// Ajout de JS & CSS
    public function admin_css_js() {
		// Function en public car bug interne à WP
		if(isset($_GET['page']) && $_GET['page'] == $this->options['plugin_pageslug']){
        	echo "<link rel='stylesheet' type='text/css' href='".$this->options['plugin_dir']. '/css/style.css'."' />\n";
        	echo "<script src='".$this->options['plugin_dir']. '/js/events.js'."'></script>\n";
		}
    }

	// Ajout d'un lien dans le menu
	function admin_menu() {
	    add_submenu_page(
			$this->options['plugin_menutype'],
            $this->options['plugin_name'] . ' Settings', // Title de la page
            $this->options['plugin_name'], // Titre du menu
            $this->options['plugin_userlevel'], // Niveau minimal
            $this->options['plugin_pageslug'], // Slug de la page
            array(&$this, 'admin_settings') // Fonction appelée
	    );
	}
	
	// Page d'administration du plugin
	function admin_settings(){
		$content = '';
	    // Le contenu, page d'administration du plugin, ou autre, va ici.
		$content .= '<div class="wrap"><h2>'.$this->options['plugin_name'].'</h2>';
	    if(isset($_POST['plugin_ok'])){
	        // update, etc.
	        $content .= '<p>ok</p>';
	    }
		$content .= '<form action="" method="post">
            <ul>
                <li><input class="button-primary" name="plugin_ok" value="Update" type="submit" /></li>
            </ul>
        </form>';
	    $content .= '</div>';
		echo $content;
	}
}


new BaseWordpressPlugin();
