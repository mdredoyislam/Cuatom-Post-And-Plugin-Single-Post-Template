<?php
/*
Plugin Name: Cuatom Post Demo
Plugin URI: https://redoyit.com/
Description: Demo Plugin for various TinyMCE Related Tasks
Version: 5.3
Requires at least: 5.8
Requires PHP: 5.6.20
Author: Md. Redoy Islam
Author URI: https://redoyit.com/wordpress-plugins/
License: GPLv2 or later
Text Domain: custompostdemo
Domain Path: /languages
*/
function cptd_load_textdomain(){
    load_plugin_textdomain('custompostdemo', false, dirname(__FILE__) . '/languages');
}
add_action("plugins_loaded", "cptd_load_textdomain");

function cptd_register_cpt_recipe(){
    $labels = array(
        'name' => __('Recipes', 'custompostdemo'),
        'singular_name' => __('Recipe', 'custompostdemo'),
        'all_items' => __('My Recipes', 'custompostdemo'),
        'add_new' => __('New Recipe', 'custompostdemo'),
    );
    $args = array(
        'label' => __('Recipes', 'custompostdemo'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
        'taxonomies' => array('category'),
    );
    register_post_type('recipe', $args);
}
add_action('init', 'cptd_register_cpt_recipe');

function cptd_recipe_template($file){
    global $post;
    if('recipe' == $post->post_type){
        $file_path = plugin_dir_path(__FILE__).'cpt-templates/single-recipe.php';
        $file = $file_path;
    }
    return $file;
}
add_filter('single_template', 'cptd_recipe_template');