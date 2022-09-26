<?php
/**
 * @package LibraryBookSearch
 */

namespace INC_DIR\admin;


class CustomFields
{
    public function register()
    {
        add_action('add_meta_boxes', array($this, 'lbs_add_additional_fields'));
        add_action( 'save_post', array($this, 'lbs_save_additional_fields' ), 99, 2 );

    }

    function lbs_add_additional_fields()
    {
        $screens = ['book'];
        foreach ($screens as $screen) {
            add_meta_box(
                'lbs_cpt_meta_boxes',
                'Additional fields',
                array($this, 'lbs_custom_box_html'),
                $screen,
                'advanced',
                'high'
            );
        }
    }

    function lbs_custom_box_html($post)
    {
       include_once LBS_PLUGIN_NAME_DIR.'/inc/admin/templates/CustomFieldsHtml.php';
    }
    function lbs_save_additional_fields($post_id){

        if ( array_key_exists( 'lbs_price_field', $_POST ) ) {
            update_post_meta(
                $post_id,
                'lbs_price_field',
                $_POST['lbs_price_field']
            );
        }

        if ( array_key_exists( 'lbs_rating_field', $_POST ) ) {
            update_post_meta(
                $post_id,
                'lbs_rating_field',
                $_POST['lbs_rating_field']
            );
        }
    }
}