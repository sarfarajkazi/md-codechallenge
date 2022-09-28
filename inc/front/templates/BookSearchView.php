<div id="lbs_books_search">
    <div class="lbs_books_search_head">
        <h3><?php _e('Book Search', 'library-book-search') ?></h3>
    </div>

    <form method="get" name="lbs_search_form" id="lbs_search_form">

        <div class="lbs_books_search_body">
            <table id="lbs_search_form">
                <tr>
                    <td><label for="lbs_book_name"><?php _e('Book name', 'library-book-search') ?></label></td>
                    <td><input type="text" name="lbs_book_name" id="lbs_book_name"
                               value="<?php echo isset($_REQUEST['lbs_book_name']) ? $_REQUEST['lbs_book_name'] : '' ?>"/>
                    </td>

                    <td><label for="lbs_book_author"><?php _e('Author', 'library-book-search') ?></label></td>
                    <td>
                        <select name="lbs_book_author" id="lbs_book_author" class="lbs_select">
                            <option value=""><?php _e('Select author', 'library-book-search') ?></option>
                            <?php
                            $authors = get_terms(
                                array(
                                    'taxonomy' => 'book-author',
                                    'hide_empty' => false,
                                )
                            );
                            if ($authors) {
                                $search_author = isset($_REQUEST['lbs_book_author']) ? $_REQUEST['lbs_book_author'] : '';
                                foreach ($authors as $author) {
                                    ?>
                                    <option value="<?php echo $author->term_id ?>" <?php echo ($author->term_id == $search_author) ? 'selected' : '' ?> ><?php echo $author->name ?></option>
                                    <?php
                                }
                            }

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="lbs_book_publisher"><?php _e('Publisher', 'library-book-search') ?></label></td>
                    <td>
                        <select name="lbs_book_publisher" id="lbs_book_publisher" class="lbs_select">
                            <option value=""><?php _e('Select publisher', 'library-book-search') ?></option>
                            <?php
                            $publishers = get_terms(
                                array(
                                    'taxonomy' => 'book-publisher',
                                    'hide_empty' => false,
                                )
                            );
                            if ($publishers) {
                                $search_publisher = isset($_REQUEST['lbs_book_publisher']) ? $_REQUEST['lbs_book_publisher'] : '';
                                foreach ($publishers as $publisher) {
                                    ?>
                                    <option value="<?php echo $publisher->term_id ?>" <?php echo ($publisher->term_id == $search_publisher) ? 'selected' : '' ?> ><?php echo $publisher->name ?></option>
                                    <?php
                                }
                            }

                            ?>
                        </select>
                    </td>
                    <td><label for="lbs_rating_field"><?php _e('Rating', 'library-book-search') ?></label></td>
                    <td>
                        <select name="lbs_rating_field" id="lbs_rating_field" class="lbs_select">
                            <option value=""><?php _e('Select rating', 'library-book-search') ?></option>
                            <?php
                            $search_rating = isset($_REQUEST['lbs_rating_field']) ? $_REQUEST['lbs_rating_field'] : '';
                            for ($i = 1; $i <= 5; $i++) {
                                ?>
                                <option value="<?php echo $i ?>" <?php echo ($i == $search_rating) ? 'selected' : '' ?> ><?php echo $i ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="lbs_book_price"><?php _e('Price', 'library-book-search') ?></label></td>
                    <td colspan="3">
                        <?php
                        global $wpdb;
                        $start_range = $min_price = $wpdb->get_var("SELECT min(meta_value + 0) FROM {$wpdb->posts} LEFT JOIN {$wpdb->postmeta} ON {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id WHERE meta_key ='lbs_price_field'");

                        $end_range = $max_price = $wpdb->get_var("SELECT max(meta_value + 0) FROM {$wpdb->posts} LEFT JOIN {$wpdb->postmeta} ON {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id WHERE meta_key ='lbs_price_field'");

                        if (isset($_REQUEST['lbs_min_value'])) {
                            $start_range = $_REQUEST['lbs_min_value'];
                        }

                        if (isset($_REQUEST['lbs_min_value'])) {
                            $end_range = $_REQUEST['lbs_max_value'];
                        }

                        ?>
                        <div id="slider-range"></div>
                        <input type="hidden" data-start="<?php echo $start_range ?>" name="lbs_min_value"
                               id="lbs_min_value" value="<?php echo $min_price ?>">
                        <input type="hidden" data-end="<?php echo $end_range ?>" name="lbs_max_value" id="lbs_max_value"
                               value="<?php echo $max_price ?>">
                        <label class="start">
                            <small><strong>Min:</strong> <span id="slider-range-value1"></span></small>
                        </label>
                        <label class="end">
                            <small><strong>Max:</strong> <span id="slider-range-value2"></span></small>
                        </label>
                    </td>

                </tr>
            </table>

        </div>
        <div class="lbs_books_search_footer">
            <button type="submit" id="book_search_btn"><?php _e('Search', 'library-book-search') ?></button>
        </div>
    </form>

</div>