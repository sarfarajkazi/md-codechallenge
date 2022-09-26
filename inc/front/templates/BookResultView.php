<div id="lbs_books_result">
    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $books = new WP_Query(array(
        'posts_per_page' => 2,
        'post_type' => 'book',
        'paged' => $paged,
        'orderby' => 'date',
        'post_status' => array('publish')
    ));
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
                    <td><?php echo get_post_meta(get_the_ID(), 'lbs_rating_field', true) ?></td>
                </tr>
                <?php
                $index++;
            endwhile;
            ?>
        </table>

        <?php
        echo "<div class=\"lbs_pagination\">";
        $big = 999999999;
        echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $books->max_num_pages
        ));
        echo "</nav>";
    }
    wp_reset_query();
    ?>
</div>
