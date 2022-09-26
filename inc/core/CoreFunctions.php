<?php
/**
 * @package LibraryBookSearch
 */
namespace INC_DIR\core;

class CoreFunctions
{
    public function register()
    {
        add_action('init',array($this,'create_book_post_type'));
    }

    function create_book_post_type(){
        register_post_type('book', array(
                'labels' => array(
                    'name' => __('Book', 'library-book-search'),
                    'menu_name' => __('Books', 'library-book-search'),
                    'all_items' => __('Books', 'library-book-search'),
                    'add_new' => __('Add New Book', 'library-book-search'),
                    'singular_name' => __('Book', 'library-book-search'),
                    'add_item' => __('New Book', 'library-book-search'),
                    'add_new_item' => __('Add New Book', 'library-book-search'),
                    'edit_item' => __('Edit Book', 'library-book-search')
                ),
                'public' => true,
                'show_in_menu' => true,
                'menu_position' => 20,
                'show_ui' => true,
                'has_archive' => true,
                'hierarchical' => true,
                'menu_icon' => 'dashicons-book-alt',
                'supports' => array('title', 'page-attributes', 'editor', 'thumbnail','excerpt')
            )
        );

        register_taxonomy('book-author', array('book'), array(
            'hierarchical' => true,
            'labels' => array(
                'name' => __('Author', 'library-book-search'),
                'singular_name' => __('Author', 'library-book-search'),
                'search_items' => __('Search Author', 'library-book-search'),
                'all_items' => __('All Author', 'library-book-search'),
                'parent_item' => __('Parent Author', 'library-book-search'),
                'parent_item_colon' => __('Parent Author:', 'library-book-search'),
                'edit_item' => __('Edit Author', 'library-book-search'),
                'update_item' => __('Update Author', 'library-book-search'),
                'add_new_item' => __('Add Author', 'library-book-search'),
                'new_item_name' => __('New Author', 'library-book-search'),
                'menu_name' => __('Author', 'library-book-search'),
            ),
            'show_ui' => true,
            'query_var' => true,
            'public' => true,
            'show_admin_column' => true,
        ));

        register_taxonomy('book-publisher', array('book'), array(
            'hierarchical' => true,
            'labels' => array(
                'name' => __('Publisher', 'library-book-search'),
                'singular_name' => __('Publisher', 'library-book-search'),
                'search_items' => __('Search Publisher', 'library-book-search'),
                'all_items' => __('All Publisher', 'library-book-search'),
                'parent_item' => __('Parent Publisher', 'library-book-search'),
                'parent_item_colon' => __('Parent Publisher:', 'library-book-search'),
                'edit_item' => __('Edit Publisher', 'library-book-search'),
                'update_item' => __('Update Publisher', 'library-book-search'),
                'add_new_item' => __('Add Publisher', 'library-book-search'),
                'new_item_name' => __('New Publisher', 'library-book-search'),
                'menu_name' => __('Publisher', 'library-book-search'),
            ),
            'show_ui' => true,
            'query_var' => true,
            'public' => true,
            'show_admin_column' => true,
        ));
    }

}