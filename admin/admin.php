<?php

/* OPTIONS PAGE(S)
--------------------------------------------------------------- */

// Add options page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => 'Theme options',
        'menu_title'    => 'Theme options',
        'menu_slug'     => 'options',
        'capability'    => 'edit_pages',
        'redirect'      => true,
        'position'      => 2,
        'update_button' => 'Update',
        'updated_message' => 'All good.',
        'icon_url'      => 'dashicons-info'
    ));
}

/* POST TYPE(S)
--------------------------------------------------------------- */

// Register post types
function register_custom_post_types()
{
    $post_types = ["sample"];

    foreach ($post_types as $post_type) {
        include_once(__DIR__ . '/post-types/' . $post_type . '.php');
    }
}
add_action('init', 'register_custom_post_types');

// Add custom landing page taxonomy
function register_custom_taxonomy()
{
    register_taxonomy(
        'sample',
        array('post', 'page'),
        array(
            'label' => 'Sample Taxonomies',
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_admin_column' => true,
            'hierarchical' => true,
        )
    );
}
add_action('init', 'register_custom_taxonomy');

/* BLOCK(S)
--------------------------------------------------------------- */

// Register blocks
function register_acf_blocks()
{
    $blocks = ["sample"];

    foreach ($blocks as $block) {
        register_block_type(__DIR__ . '/blocks/' . $block);
    }
}
add_action('init', 'register_acf_blocks');

// Register custom block category
function register_block_category($categories, $post)
{
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'sample-category',
                'title' => 'Sample',
            ),
        )
    );
}
add_filter('block_categories_all', 'register_block_category', 10, 2);
