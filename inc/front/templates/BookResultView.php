<div id="lbs_books_result">
    <?php
    $posts_per_page = get_option('posts_per_page');
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $book_query = array(
        'posts_per_page' => $posts_per_page,
        'post_type' => 'book',
        'paged' => $paged,
        'orderby' => 'date',
        'post_status' => array('publish')
    );

    $search_key = isset($_REQUEST['lbs_book_name']) ? $_REQUEST['lbs_book_name'] : '';
    if (!empty($search_key)) {
        $book_query['s'] = $search_key;
    }

    $min_price_val = isset($_REQUEST['lbs_min_value']) ? $_REQUEST['lbs_min_value'] : '';
    $max_price_val = isset($_REQUEST['lbs_max_value']) ? $_REQUEST['lbs_max_value'] : '';

    if (!empty($min_price_val) && !empty($max_price_val)) {
        $book_query['meta_query'][] = array(
            'key' => 'lbs_price_field',
            'value' => [$min_price_val, $max_price_val],
            'compare' => 'BETWEEN',
            'type' => 'numeric',
        );
    }

    $lbs_rating_field = isset($_REQUEST['lbs_rating_field']) ? $_REQUEST['lbs_rating_field'] : '';
    if ($lbs_rating_field) {
        $book_query['meta_query'][] = array(
            'key' => 'lbs_rating_field',
            'value' => $lbs_rating_field,
            'compare' => '=',
            'type' => 'numeric',
        );
    }

    $lbs_book_publisher = isset($_REQUEST['lbs_book_publisher']) ? $_REQUEST['lbs_book_publisher'] : '';
    if ($lbs_book_publisher) {
        $book_query['tax_query'][] = array(
            'taxonomy' => 'book-publisher',
            'field' => 'term_id',
            'terms' => $lbs_book_publisher
        );
    }
    $lbs_book_author = isset($_REQUEST['lbs_book_author']) ? $_REQUEST['lbs_book_author'] : '';
    if ($lbs_book_author) {
        $book_query['tax_query'][] = array(
            'taxonomy' => 'book-author',
            'field' => 'term_id',
            'terms' => $lbs_book_author
        );
    }

    $books = new WP_Query($book_query);
    if ($books->have_posts()) {
        ?>
        <table>
            <tr>
                <td><?php _e('No', 'library-book-search') ?></td>
                <td width="250px"><?php _e('Book Name', 'library-book-search') ?></td>
                <td><?php _e('Price', 'library-book-search') ?></td>
                <td><?php _e('Author', 'library-book-search') ?></td>
                <td><?php _e('Publisher', 'library-book-search') ?></td>
                <td><?php _e('Rating', 'library-book-search') ?></td>
            </tr>
            <?php
            $index = 1;
            while ($books->have_posts()) : $books->the_post();
                $book_authors_with_link = $book_publishers_with_link = array();
                $book_author = wp_get_post_terms(get_the_ID(), 'book-author', array('fields' => 'all'));
                $book_authors = wp_list_pluck($book_author, 'name', 'term_id');
                $book_publisher = wp_get_post_terms(get_the_ID(), 'book-publisher', array('fields' => 'all'));
                $book_publishers = wp_list_pluck($book_publisher, 'name', 'term_id');
                ?>
                <tr>
                    <td><?php echo $index ?></td>
                    <td><a href="<?php the_permalink(); ?>"><?php echo get_the_title() ?></a></td>
                    <td>$<?php echo get_post_meta(get_the_ID(), 'lbs_price_field', true) ?></td>
                    <td>
                        <?php
                        foreach ($book_authors as $term_id => $book_author) {
                            $book_authors_with_link[] = '<a href="' . get_term_link($term_id) . '">' . $book_author . '</a>';
                        }
                        echo implode(',', $book_authors_with_link);
                        ?>
                    </td>
                    <td>
                        <?php
                        foreach ($book_publishers as $term_id => $book_publisher) {
                            $book_publishers_with_link[] = '<a href="' . get_term_link($term_id) . '">' . $book_publisher . '</a>';
                        }
                        echo implode(',', $book_publishers_with_link);
                        ?>
                    </td>
                    <td>
                        <?php $stars = get_post_meta(get_the_ID(), 'lbs_rating_field', true) ?>
                        <div class="stars">
                            <?php
                            for ($i = 1; $i <= $stars; $i++) {
                                ?>
                                <div class="star" title="<?php echo $i ?>"></div>
                                <?php
                            }
                            ?>
                        </div>
                    </td>
                </tr>
                <?php
                $index++;
            endwhile;
            ?>
        </table>

        <?php
        echo "<div class=\"lbs_pagination\">";
        echo paginate_links(array(
            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $books->max_num_pages
        ));
        echo "</div>";
    } else {
        echo '<p class="lbs_no_record_found"><label>' . __('No matching record founds', 'library-book-search') . '</label></p>';
    }
    wp_reset_query();
    ?>
</div>
