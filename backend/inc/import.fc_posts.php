<?php
use Medoo\Medoo;
$alert = '';


$db_import_posts = new Medoo([
    'type' => 'sqlite',
    'database' => $fc_posts_file
]);

$get_posts = $db_import_posts->select("fc_posts", "*");
$cnt_posts = count($get_posts);

foreach($get_posts as $post) {

    if($post['post_type'] == 'e') {

        $db_posts->insert("se_events", [
            "date" => $post['post_date'],
            "releasedate" => $post['post_releasedate'],
            "title" => $post['post_title'],
            "teaser" => $post['post_teaser'],
            "text" => $post['post_text'],
            "images" => $post['post_images'],
            "event_lang" => $post['post_lang'],
            "lastedit" => $post['post_lastedit'],
            "lastedit_from" => $post['post_lastedit_from'],
            "tags" => $post['post_tags'],
            "labels" => $post['post_labels'],
            "categories" => $post['post_categories'],
            "comments" => $post['post_comments'],
            "slug" => $post['post_slug'],
            "rss" => $post['post_rss'],
            "rss_url" => $post['post_rss_url'],
            "author" => $post['post_author'],
            "meta_title" => $post['post_meta_title'],
            "meta_description" => $post['post_meta_description'],
            "status" => $post['post_status'],
            "priority" => $post['post_priority'],
            "fixed" => $post['post_fixed'],
            "hits" => $post['post_hits'],
            "event_startdate" => $post['post_event_startdate'],
            "event_enddate" => $post['post_event_enddate'],
            "event_zip" => $post['post_event_zip'],
            "event_city" => $post['post_event_city'],
            "event_street" => $post['post_event_street'],
            "event_street_nbr" => $post['post_event_street_nbr'],
            "event_price_note" => $post['post_event_price_note'],
            "event_guestlist" => $post['post_event_guestlist'],
            "event_guestlist_public_nbr" => $post['post_event_guestlist_public_nbr'],
            "event_guestlist_limit" => $post['post_event_guestlist_limit']
        ]);

    }

    if($post['post_type'] == 'p') {

        $db_posts->insert("se_products", [
            "date" => $post['post_date'],
            "lastedit" => $post['post_lastedit'],
            "lastedit_from" => $post['post_lastedit_from'],
            "status" => $post['post_status'],
            "priority" => $post['post_priority'],
            "fixed" => $post['post_fixed'],
            "hits" => $post['post_hits'],
            "releasedate" => $post['post_releasedate'],
            "title" => $post['post_title'],
            "teaser" => $post['post_teaser'],
            "text" => $post['post_text'],
            "product_lang" => $post['post_lang'],
            "author" => $post['post_author'],
            "tags" => $post['post_tags'],
            "labels" => $post['post_labels'],
            "slug" => $post['post_slug'],
            "rss" => $post['post_rss'],
            "rss_url" => $post['post_rss_url'],
            "meta_title" => $post['post_meta_title'],
            "meta_description" => $post['post_meta_description'],
            "product_number" => $post['post_product_number'],
            "product_manufacturer" => $post['post_product_manufacturer'],
            "product_supplier" => $post['post_product_supplier'],
            "product_tax" => $post['post_product_tax'],
            "product_price_net_purchasing" => $post['post_product_price_net_purchasing'],
            "product_price_addition" => $post['post_product_price_addition'],
            "product_price_net" => $post['post_product_price_net'],
            "product_features" => $post['post_product_features'],
            "product_price_label" => $post['post_product_price_label'],
            "product_textlib_price" => $post['post_product_textlib_price'],
            "product_textlib_content" => $post['post_product_textlib_content'],
            "product_currency" => $post['post_product_currency'],
            "product_unit" => $post['post_product_unit'],
            "product_amount" => $post['post_product_amount']
        ]);

    }

    if($post['post_type'] == 'm' OR $post['post_type'] == 'i' OR $post['post_type'] == 'f' OR $post['post_type'] == 'g' OR $post['post_type'] == 'v' OR $post['post_type'] == 'l') {

        $db_posts->insert("se_posts", [
            "post_type" => $post['post_type'],
            "post_date" => $post['post_date'],
            "post_releasedate" => $post['post_releasedate'],
            "post_lastedit" => $post['post_lastedit'],
            "post_lastedit_from" => $post['post_lastedit_from'],
            "post_title" => $post['post_title'],
            "post_teaser" => $post['post_teaser'],
            "post_text" => $post['post_text'],
            "post_images" => $post['post_images'],
            "post_tags" => $post['post_tags'],
            "post_link" => $post['post_link'],
            "post_link_hits" => $post['post_link_hits'],
            "post_video_url" => $post['post_video_url'],
            "post_categories" => $post['post_categories'],
            "post_comments" => $post['post_comments'],
            "post_author" => $post['post_author'],
            "post_source" => $post['post_source'],
            "post_status" => $post['post_status'],
            "post_rss" => $post['post_rss'],
            "post_rss_url" => $post['post_rss_url'],
            "post_lang" => $post['post_lang'],
            "post_slug" => $post['post_slug'],
            "post_priority" => $post['post_priority'],
            "post_fixed" => $post['post_fixed'],
            "post_hits" => $post['post_hits'],
            "post_votings" => $post['post_votings'],
            "post_labels" => $post['post_labels'],
            "post_attachments" => $post['post_attachments'],
            "post_template_values" => $post['post_template_values'],
            "post_meta_title" => $post['post_meta_title'],
            "post_meta_description" => $post['post_meta_description'],
            "post_file_attachment" => $post['post_file_attachment'],
            "post_file_attachment_hits" => $post['post_file_attachment_hits'],
            "post_file_attachment_external" => $post['post_file_attachment_external'],
            "post_file_license" => $post['post_file_license'],
            "post_file_version" => $post['post_file_version']
        ]);

    }

    $last_post_id = $db_posts->id();
    if($last_post_id > 0) {
        $alert .= '<p>IMPORTET '.$post['post_title'].' Type: '.$post['post_type'].' in ID: '.$last_post_id.'</p>';
    } else {
        $alert .= '<p>FAILED '.$category['cat_name'].'</p>';
        $alert .= var_dump($db_content->errorInfo,true);
    }


}

$alert .= '<h3>Importing '.$cnt_pages.' Pages</h3>';

echo '<div class="card p-3 mt-3">';
echo '<h4>PROZESSING POSTS FILE</h4>';
echo '<div class="scroll-container">';
echo $alert;
echo '</div>';
echo '</div>';