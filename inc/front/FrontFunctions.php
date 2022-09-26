<?php
/**
 * @package LibraryBookSearch
 */
namespace INC_DIR\front;


class FrontFunctions
{

    public function register()
    {
        add_shortcode('book_search',array($this,'lbs_books_search'));
    }
    public function lbs_books_search(){
        ob_start();
        echo '<div id="lbs_books_search_wrapper">';
        include_once LBS_PLUGIN_NAME_DIR.'/inc/front/templates/BookSearchView.php';
        include_once LBS_PLUGIN_NAME_DIR.'/inc/front/templates/BookResultView.php';
        echo '</div>';
        return ob_get_clean();
    }
}