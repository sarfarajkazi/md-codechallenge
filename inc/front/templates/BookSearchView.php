<div id="lbs_books_search">
    <div class="lbs_books_search_head">
        <h3><?php _e('Book Search', 'library-book-search') ?></h3>
    </div>
    <div class="lbs_books_search_body">
        <table id="lbs_search_form">
            <tr>
                <td><label for="lbs_book_name"><?php _e('Book name', 'library-book-search') ?></label></td>
                <td><input type="text" name="book_name" id="lbs_book_name"/></td>

                <td><label for="lbs_book_author"><?php _e('Author', 'library-book-search') ?></label></td>
                <td>
                    <input type="text" name="lbs_book_author" id="lbs_book_author"/>
                </td>
            </tr>
            <tr>
                <td><label for="lbs_book_publisher"><?php _e('Publisher', 'library-book-search') ?></label></td>
                <td>
                    <select name="lbs_book_publisher" id="lbs_book_publisher" class="lbs_select">
                        <?php
                        $authors = get_terms(
                            array(
                                'taxonomy' => 'book-publisher',
                                'hide_empty' => false,
                            )
                        );
                        if ($authors) {
                            foreach ($authors as $author) {
                                ?>
                                <option <?php echo $author->term_id ?>><?php echo $author->name ?></option>
                                <?php
                            }
                        }

                        ?>
                    </select>
                </td>
                <td><label for="lbs_rating_field"><?php _e('Rating', 'library-book-search') ?></label></td>
                <td>
                    <select name="lbs_rating_field" id="lbs_rating_field" class="lbs_select">
                        <option value="">Select rating...</option>
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
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
                    $min_price =  $wpdb->get_var("SELECT min(meta_value + 0) FROM {$wpdb->posts} LEFT JOIN {$wpdb->postmeta} ON {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id WHERE meta_key ='lbs_price_field'");

                    $max_price = $wpdb->get_var("SELECT max(meta_value + 0) FROM {$wpdb->posts} LEFT JOIN {$wpdb->postmeta} ON {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id WHERE meta_key ='lbs_price_field'");

                    ?>
                    <div id="slider-range"></div>
                    <input type="hidden" name="lbs-min-value" id="lbs-min-value" value="<?php echo $min_price ?>">
                    <input type="hidden" name="lbs-max-value" id="lbs-max-value" value="<?php echo $max_price ?>">
                    <label class="start">
                    <strong>Min:</strong> <span id="slider-range-value1"></span>
                    </label>
                    <label class="end">
                    <strong>Max:</strong> <span id="slider-range-value2"></span>
                    </label>
                </td>

            </tr>
        </table>

    </div>
    <div class="lbs_books_search_footer">
        <button type="button" id="book_search_btn"><?php _e('Search', 'library-book-search') ?></button>
    </div>
</div>