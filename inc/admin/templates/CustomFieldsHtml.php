<?php
global $post;
$price = get_post_meta($post->ID,'lbs_price_field',true);
$ratings = get_post_meta($post->ID,'lbs_rating_field',true);
?>
<div class="wrap">
    <table class="form-table" id="tbl_images">
        <tr>
            <th><label for="lbs_price_field"><?php esc_html_e("Price", "rts"); ?></label></th>
            <td>
                <input type="number" name="lbs_price_field" id="lbs_price_field" value="<?php echo !empty($price)?$price:'0' ?>"/>
            </td>
        </tr>
        <tr>
            <th><label for="lbs_rating_field"><?php esc_html_e("Ratings", "rts"); ?></label></th>
            <td>
                <select name="lbs_rating_field" id="lbs_rating_field" class="postbox">
                    <option value="">Select rating...</option>
                    <?php
                    for($i=1;$i<=5;$i++){
                        ?>
                        <option value="<?php echo $i ?>" <?php echo ($i==$ratings)?'selected':'' ?>><?php echo $i ?></option>
                    <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
</div>
