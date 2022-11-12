<?php
/**
 * Register Empreendimentos Custom Post Type
 * 
 * @package WordPress
 */
    
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class CPT_Empreendimentos {
    protected $slug;

    /**
     * Construct class
     * 
     * @since 1.0
     */
    public function __construct(string $slug = 'empreendimento')
    {
        $this->set_slug($slug);

        $this->register_cpt();
    }

    /**
     * Register custom post type
     *
     * @since 1.0
     */
    public function register_cpt()
    {

        $slug = $this->get_slug();
        $args = $this->get_args();

        register_post_type($slug, $args);
    }

    /**
     * Set slug of custom post type
     *
     * @param string $slug
     * @since 1.0
     */
    protected function set_slug(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug of custom post type
     *
     * @return string
     * @since 1.0
     */
    public function get_slug(): string
    {
        return $this->slug;
    }

    /**
     * Get custom post type *transform* array of arguments
     *
     * @return array
     * @since 1.0
     */
    public function get_args(): array
    {
        $slug = $this->get_slug();

        $labels = array(
            'name'                          => __('Empreendimentos'),
            'singular_name'                 => __('Empreendimento'),
            'menu_name'                     => __('Empreendimentos'),
            'name_admin_bar'                => __('Empreendimento'),
            'add_new'                       => __('Adicionar Novo'),
            'add_new_item'                  => __('Adicionar novo empreendimentos'),
            'new_item'                      => __('Novo empreendimento'),
            'edit_item'                     => __('Editar empreendimento'),
            'view_item'                     => __('Ver empreendimento'),
            'view_items'                    => __('Ver empreendimentos'),
            'all_items'                     => __('Todos os empreendimentos'),
            'search_items'                  => __('Pesquisar empreendimento'),
            'parent_items'                  => __('Empreendimentos superiores'),
            'parent_item_colon'             => __('Empreendimentos superiores:'),
            'not_found'                     => __('Nenhum empreendimento encontrado'),
            'not_found_in_trash'            => __('Nenhum empreendimento encontrado na lixeira'),
            'featured_image'                => __('Imagem em destaque'),
            'set_featured_image'            => __('Definir imagem em destaque'),
            'remove_featured_image'         => __('Remover imagem em destaque'),
            'use_featured_image'            => __('Usar como imagem em destaque'),
            'archives'                      => __('Catálogo de empreendimentos'),
            'insert_into_item'              => __('Inserir em empreendimento'),
            'uploaded_to_this_item'         => __('Carregado neste empreendimento'),
            'filter_items_list'             => __('Filtrar empreendimentos'),
            'items_list_navigation'         => __('Navegação por empreendimentos'),
            'items_list'                    => __('Lista de empreendimentos'),
            'items_published'               => __('Empreendimento publicado'),
            'items_published_protectedly'   => __('Empreendimento publicado em privado'),
            'item_reverted_to_draft'        => __('Empreendimento revertido a rascunho'),
            'item_updated'                  => __('Empreendimento atualizado'),
        );

        $supports = array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'custom-fields',
            'revisions',
            'page-attributes'
        );

        $args = array(
            'label'                 => __('Empreendimentos'),
            'labels'                => $labels,
            'description'           => __('Empreendimentos'),
            'public'                => true,
            'show_in_rest'          => true,
            'hierarchical'          => false,
            'menu_position'         => 31,
            'menu_icon'             => 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#f0f6fc99" class="bi bi-house-door-fill" viewBox="0 0 16 16">
            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
          </svg>'),
            'capability_type'       => 'page',
            'supports'              => $supports,
            'has_archive'           => true,
            'rewrite'               => array('slug' => $slug, 'with_front' => false),
        );

        return $args;
    }
}

require_once 'meta-empreendimentos.php';

new CPT_Empreendimentos();