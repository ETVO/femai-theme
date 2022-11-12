<?php
/**
 * Index template
 * 
 * @package WordPress
 * @subpackage CF-Theme
 */


$empreendimentos_page = get_permalink(get_theme_mod('empreendimentos_page'));

// Redirect to the defined page for Empreendimentos
header("Location: $empreendimentos_page");