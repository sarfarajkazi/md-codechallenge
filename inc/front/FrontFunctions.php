<?php
/**
 * @package LibraryBookSearch
 */

namespace INC_DIR\front;


class FrontFunctions
{

    public function register()
    {
        add_shortcode('book_search', array($this, 'lbs_books_search'));
        add_action('wp_ajax_lbs_fetch_search_result', array($this, 'lbs_fetch_search_result'));
    }

    public function lbs_fetch_search_result()
    {
        $response = array(
            'feedback' => __('There was a problem when trying to fetch state.', '7x-codegreene'),
        );
        $data = json_decode(stripslashes($_REQUEST['search_data']), true);

        if (!wp_verify_nonce($_REQUEST['_wpnonce'], 'lbs-nonce')) {
            wp_send_json_error($response);
        }
        parse_str($_REQUEST['search_data'], $_REQUEST);
        ob_start();
        include_once LBS_PLUGIN_NAME_DIR . '/inc/front/templates/BookResultView.php';
        $html = ob_get_clean();
        wp_send_json_success(array('html' => $html));
    }

    public function lbs_books_search()
    {
        ob_start();
        echo '<div id="lbs_books_search_wrapper">';
        include_once LBS_PLUGIN_NAME_DIR . '/inc/front/templates/BookSearchView.php';
        include_once LBS_PLUGIN_NAME_DIR . '/inc/front/templates/BookResultView.php';
        echo '</div>';
        return ob_get_clean();
    }
}