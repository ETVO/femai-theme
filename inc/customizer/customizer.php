<?php

/**
 * Customizer controls and options
 * 
 * @package WordPress
 */

use Kirki\Util\Helper;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

// Do not proceed if Kirki does not exist.
if (!class_exists('Kirki')) {
	return;
}

Kirki::add_config(
	'theme_options_config',
	[
		'option_type' => 'theme_mod',
		'capability'  => 'manage_options',
	]
);

/**
 * Add a panel
 */
$panel_id = 'theme_options';
new \Kirki\Panel(
	$panel_id,
	[
		'priority'    => 10,
		'title'       => __('Opções Femai'),
	]
);

$sections = [
	'rodape'            => 'Rodapé',
	'home'            	=> 'Home',
	'about'             => 'A Femai',
	'blog'             	=> 'Blog',
	'empreendimentos'   => 'Empreendimentos',
	'contato'           => 'Contato',
	'forms'   			=> 'Formulários do site',
];

$section_title_class = 'customize-section-title';

/**
 * Add all sections
 */
foreach ($sections as $section_id => $title) {
	$section_args = [
		'title' => $title,
		'panel' => $panel_id
	];

	new \Kirki\Section(
		$section_id,
		$section_args
	);
}


/** ----- Rodapé ----- */

$section = 'rodape';

new \Kirki\Field\Image(
	[
		'settings'  => 'footer_logo',
		'label'     => esc_html__('Logo Rodapé'),
		'section'   => $section,
		'default'   => '',
	]
);

new \Kirki\Field\Generic(
	[
		'settings'    => 'contato_title',
		'section'     => $section,
		'default'   => 'Contatos',
		'choices'     => [
			'element' => 'h3',
			'class'   => $section_title_class,
		],
	]
);

new \Kirki\Field\Text(
	[
		'settings' => 'info_phone',
		'label'    => __('Telefone'),
		'section'  => $section,
	]
);

new \Kirki\Field\Text(
	[
		'settings' => 'info_whatsapp',
		'label'    => __('WhatsApp'),
		'section'  => $section,
	]
);

new \Kirki\Field\Editor(
	[
		'settings' => 'info_address',
		'label'    => __('Endereço'),
		'section'  => $section,
	]
);

new \Kirki\Field\Generic(
	[
		'settings'    => 'redes_title',
		'section'     => $section,
		'default'   => 'Redes Sociais',
		'choices'     => [
			'element' => 'h3',
			'class'   => $section_title_class,
		],
	]
);

new \Kirki\Field\Repeater(
	[
		'settings'    => 'social_icons',
		'label'       => __('Ícones Redes Sociais'),
		'section'     => $section,
		'button_label' => esc_html__('Adicionar nova'),
		'row_label' => [
			'type'  => 'field',
			'value' => __('Ícone'),
			'field' => 'icon',
		],
		'default'     => [
			[
				'icon' => 'facebook',
				'url'  => 'https://www.facebook.com/',
			],
			[
				'icon' => 'instagram',
				'url'  => 'https://www.instagram.com/',
			],
		],
		'fields'      => [
			'icon' => [
				'type' => 'text',
				'label' => __('Ícone'),
				'description' => __('Utilize os ícones do') . ' Bootstrap Icons',
			],
			'url'  => [
				'type' => 'text',
				'label' => __('Link'),
			],
		],
	]
);




/** ----- Rodapé ----- */

$section = 'home';

new \Kirki\Field\Generic(
	[
		'settings'    => 'sbpe_title',
		'section'     => $section,
		'default'   => 'SBPE',
		'choices'     => [
			'element' => 'h3',
			'class'   => $section_title_class,
		],
	]
);

new \Kirki\Field\Editor(
	[
		'settings' => 'sbpe_text',
		'label'    => __('Texto SBPE'),
		'section'  => $section,
	]
);


/** ----- Sobre Nós ----- */

$section = 'about';


new \Kirki\Field\Generic(
	[
		'settings'    => 'quem_somos_title',
		'section'     => $section,
		'default'   => 'Quem Somos',
		'choices'     => [
			'element' => 'h3',
			'class'   => $section_title_class,
		],
	]
);

new \Kirki\Field\Editor(
	[
		'settings' => 'quem_somos',
		'label'    => __('Quem Somos'),
		'section'  => $section,
	]
);

new \Kirki\Field\Generic(
	[
		'settings'    => 'diferenciais_title',
		'section'     => $section,
		'default'   => 'Diferenciais',
		'choices'     => [
			'element' => 'h3',
			'class'   => $section_title_class,
		],
	]
);


new \Kirki\Field\Repeater(
	[
		'settings'    => 'diferenciais_lista',
		'label'       => __('Diferenciais'),
		'section'     => $section,
		'button_label' => esc_html__('Adicionar novo'),
		'row_label' => [
			'type'  => 'field',
			'value' => __('Diferencial'),
			'field' => 'desc',
		],
		'default'     => [],
		'fields'      => [
			'icon' => [
				'type' => 'text',
				'label' => __('Ícone'),
				'description' => __('Utilize os ícones do') . ' Bootstrap Icons',
			],
			'desc'  => [
				'type' => 'text',
				'label' => __('Descrição'),
			],
		],
	]
);

new \Kirki\Field\Image(
	[
		'settings'  => 'diferenciais_image',
		'label'     => esc_html__('Imagem'),
		'section'   => $section,
		'default'   => '',
	]
);



/** ----- Contato ----- */

$section = 'contato';

new \Kirki\Field\Generic(
	[
		'settings'    => 'local_title',
		'section'     => $section,
		'default'   => 'Localização',
		'choices'     => [
			'element' => 'h3',
			'class'   => $section_title_class,
		],
	]
);

new \Kirki\Field\Image(
	[
		'settings'  => 'contato_logo',
		'label'     => esc_html__('Logo'),
		'section'   => $section,
		'default'   => '',
	]
);

new \Kirki\Field\Editor(
	[
		'settings' => 'contato_address',
		'label'    => __('Endereço'),
		'section'  => $section,
	]
);



/** ----- Empreendimentos ----- */

$section = 'empreendimentos';

new \Kirki\Field\Dropdown_Pages(
	[
		'settings' => 'empreendimentos_page',
		'label'    => __('Página de Empreendimentos'),
		'section'  => $section,
	]
);


/** ----- Formulários ----- */

$section = 'forms';

new \Kirki\Field\Text(
	[
		'settings' => 'form_simple',
		'label'    => __('Shortcode do Formulário simples'),
		'section'  => $section,
	]
);

new \Kirki\Field\Text(
	[
		'settings' => 'form_multiple',
		'label'    => __('Shortcode do Formulário múltiplo'),
		'section'  => $section,
	]
);


/** ----- Blog ----- */

$section = 'blog';

new \Kirki\Field\Image(
	[
		'settings'  => 'blog_heading_image',
		'label'     => esc_html__('Imagem de fundo Cabeçalho'),
		'section'   => $section,
		'default'   => '',
	]
);
new \Kirki\Field\Text(
	[
		'settings' => 'blog_heading_title',
		'label'    => __('Título do Cabeçalho'),
		'section'  => $section,
	]
);