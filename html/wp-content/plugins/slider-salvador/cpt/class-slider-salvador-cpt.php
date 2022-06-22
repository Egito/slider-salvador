<?php

class Slider_Salvador_Post_Type
{
    function __construct()
    {
        add_action('init', array($this, 'slider_cpt'));
        add_action('add_meta_boxes', array($this, 'slider_cpt_metabox'));
        add_action('save_post', array($this, 'slider_cpt_save'), 10, 2);
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
    public function slider_cpt_metabox()
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

    public function slider_cpt_save($post_id)
    {
        // testar se o formulario é o mesmo que esta com nossos dados
        if (isset($_POST['slider-salvador-nonce'])) {
            if (!wp_verify_nonce($_POST['slider-salvador-nonce'], 'slider-salvador-nonce')) {
                return;
            }
        }
        // testar autosave do sistema
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        // testar capacidades do usuario (estamos no cpt correto? e o usuario pode alterar?)
        if (isset($_POST['post_type']) && $_POST['post_type'] === 'slider-salvador') {
            if (!current_user_can('edit_page', $post_id)) {
                return;
            } elseif (!current_user_can('edit_post', $post_id)) {
                return;
            }
        }
        if (isset($_POST['action']) && $_POST['action'] == 'editpost') {
            $old_text = get_metadata('post', $post_id, 'slider-salvador-link', true);
            $new_text = sanitize_text_field($_POST['slider-salvador-link']);
            $old_url = get_metadata('post', $post_id, 'slider-salvador-url', true);
            $new_url = esc_url_raw($_POST['slider-salvador-url']);

            $new_text = empty($new_text) ? 'Add some text' : $new_text;
            $new_url = empty($new_url) ? 'Add some URL' : $new_url;

            update_metadata('post', $post_id, 'slider-salvador-link', $new_text, $old_text);
            update_metadata('post', $post_id, 'slider-salvador-url', $new_url, $old_url);
        }
    }
}
