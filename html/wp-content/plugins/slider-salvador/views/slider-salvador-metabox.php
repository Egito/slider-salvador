<?php
$slider_link = get_post_meta($post->ID, 'slider-salvador-link', true);
$slider_link = isset($slider_link) ? esc_html($slider_link) : '';
$slider_url = get_post_meta($post->ID, 'slider-salvador-url', true);
$slider_url = isset($slider_url) ? esc_url($slider_url) : '';
?>
<table class="form-table slider-salvador-metabox">
    <input type="hidden" name="slider-salvador-nonce" value="<?php echo wp_create_nonce("slider-salvador-nonce"); ?>">
    <tr>
        <th><label for="slider-salvador-link">Link Text</label></th>
        <td>
            <input type="text" class="regular-text link-text" name="slider-salvador-link" id="slider-salvador-link" value="<?php echo $slider_link; ?>" required>
        </td>
    </tr>
    <tr>
        <th><label for="slider-salvador-url">Link URL</label></th>
        <td>
            <input type="url" class="regular-text link-url" name="slider-salvador-url" id="slider-salvador-url" value="<?php echo $slider_url; ?>" required>
        </td>
    </tr>
</table>