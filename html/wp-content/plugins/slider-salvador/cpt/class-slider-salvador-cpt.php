<?php

class Slider_Salvador_Post_Type
{
    function __construct()
    {
        add_action('init', array($this, 'slider_cpt'));
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
    }

    public function slider_cpt()
    {
        register_post_type('slider-salvador', array(
            'label' => 'Slider',
            'description' => 'Sliders',
            'labels' => array(
                'name' => 'Sliders',
                'singular_name' => 'Slider'
            ),
            'public' => true,
            'supports' => array(
                'title', 'editor', 'thumbnail'
            ),
            'hierarchical' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'menu_position' => 5,
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'show_in_rest' => false, // editor de blocos ativo ou nao
            'menu_icon' => 'dashicons-format-gallery',
            //            'register_meta_box_cb' => array($this, 'add_meta_boxes'), // registro de meta box -> campos complementares do post customizado
        ));
    }
    public function add_meta_boxes()
    {
        add_meta_box(
            'slider-salvador-meta-box',
            'Links Options',
            array($this, 'add_inner_meta_boxes'),
            'slider-salvador',
            'normal',
            'high',
        );
    }

    public function add_inner_meta_boxes($post)
    {
        require_once(SS_PATH . 'views/slider-salvador-metabox.php');
    }
}
