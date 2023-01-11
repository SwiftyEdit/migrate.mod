<?php

use Medoo\Medoo;
$alert = '';

$db_import_content = new Medoo([
    'type' => 'sqlite',
    'database' => $fc_content_file
]);

$get_pages = $db_import_content->select("fc_pages", "*");
$cnt_pages = count($get_pages);

$alert .= '<h3>Importing '.$cnt_pages.' Pages</h3>';

foreach($get_pages as $page) {
    $db_content->insert("se_pages", [
        "page_hits" => $page['page_hits'],
        "page_priority" => $page['page_priority'],
        "page_language" => $page['page_language'],
        "page_linkname" => $page['page_linkname'],
        "page_permalink" => $page['page_permalink'],
        "page_permalink_short" => $page['page_permalink_short'],
        "page_permalink_short_cnt" => $page['page_permalink_short_cnt'],
        "page_target" => $page['page_target'],
        "page_type_of_use" => $page['page_type_of_use'],
        "page_redirect" => $page['page_redirect'],
        "page_redirect_code" => $page['page_redirect_code'],
        "page_funnel_uri" => $page['page_funnel_uri'],
        "page_classes" => $page['page_classes'],
        "page_hash" => $page['page_hash'],
        "page_psw" => $page['page_psw'],
        "page_title" => $page['page_title'],
        "page_status" => $page['page_status'],
        "page_usergroup" => $page['page_usergroup'],
        "page_content" => $page['page_content'],
        "page_sort" => $page['page_sort'],
        "page_lastedit" => $page['page_lastedit'],
        "page_lastedit_from" => $page['page_lastedit_from'],
        "page_meta_author" => $page['page_meta_author'],
        "page_meta_date" => $page['page_meta_date'],
        "page_meta_keywords" => $page['page_meta_keywords'],
        "page_meta_description" => $page['page_meta_description'],
        "page_meta_robots" => $page['page_meta_robots'],
        "page_favicon" => $page['page_favicon'],
        "page_thumbnail" => $page['page_thumbnail'],
        "page_template" => $page['page_template'],
        "page_template_layout" => $page['page_template_layout'],
        "page_template_stylesheet" => $page['page_template_stylesheet'],
        "page_template_values" => $page['page_template_values'],
        "page_modul" => $page['page_modul'],
        "page_modul_query" => $page['page_modul_query'],
        "page_addon_string" => $page['page_addon_string'],
        "page_posts_categories" => $page['page_post_categories'],
        "page_posts_types" => $page['page_post_types'],
        "page_authorized_users" => $page['page_authorized_users'],
        "page_version" => $page['page_version'],
        "page_version_date" => $page['page_version_date'],
        "page_labels" => $page['page_labels'],
        "page_categories" => $page['page_categories'],
        "page_comments" => $page['page_comments']
    ]);

    $last_id = $db_content->id();
    if($last_id > 0) {
        $alert .= '<p>IMPORTET '.$page['page_title'].' in ID: '.$last_id.'</p>';
    } else {
        $alert .= '<p>FAILED '.$page['page_title'].'</p>';
        $alert .= var_dump($db_content->errorInfo,true);
    }
}

$get_snippets = $db_import_content->select("fc_textlib", "*");
$cnt_snippets = count($get_snippets);

$alert .= '<h3>Importing '.$cnt_snippets.' Snippets</h3>';

foreach($get_snippets as $snippet) {
    $db_content->insert("se_snippets", [
        "snippet_type" => $snippet['textlib_type'],
        "snippet_shortcode" => $snippet['textlib_shortcode'],
        "snippet_name" => $snippet['textlib_name'],
        "snippet_title" => $snippet['textlib_title'],
        "snippet_content" => $snippet['textlib_content'],
        "snippet_teaser" => $snippet['textlib_teaser'],
        "snippet_keywords" => $snippet['textlib_keywords'],
        "snippet_classes" => $snippet['textlib_classes'],
        "snippet_permalink" => $snippet['textlib_permalink'],
        "snippet_permalink_name" => $snippet['textlib_permalink_name'],
        "snippet_permalink_title" => $snippet['textlib_permalink_title'],
        "snippet_permalink_classes" => $snippet['textlib_permalink_classes'],
        "snippet_images" => $snippet['textlib_images'],
        "snippet_groups" => $snippet['textlib_groups'],
        "snippet_labels" => $snippet['textlib_labels'],
        "snippet_template" => $snippet['textlib_template'],
        "snippet_theme" => $snippet['textlib_theme'],
        "snippet_notes" => $snippet['textlib_notes'],
        "snippet_lastedit" => $snippet['textlib_lastedit'],
        "snippet_lastedit_from" => $snippet['textlib_lastedit_from'],
        "snippet_lang" => $snippet['textlib_lang'],
        "snippet_status" => $snippet['textlib_status'],
        "snippet_priority" => $snippet['textlib_priority']
    ]);

    $last_snippet_id = $db_content->id();
    if($last_snippet_id > 0) {
        $alert .= '<p>IMPORTET '.$snippet['textlib_name'].' in ID: '.$last_snippet_id.'</p>';
    } else {
        $alert .= '<p>FAILED '.$snippet['textlib_name'].'</p>';
        $alert .= var_dump($db_content->errorInfo,true);
    }
}

$get_categories = $db_import_content->select("fc_categories", "*");
$cnt_categories = count($get_categories);
$alert .= '<h3>Importing '.$cnt_categories.' Categories</h3>';

foreach($get_categories as $category) {
    $db_content->insert("se_categories", [
        "cat_lang" => $category['cat_lang'],
        "cat_name" => $category['cat_name'],
        "cat_name_clean" => $category['cat_name_clean'],
        "cat_hash" => $category['cat_hash'],
        "cat_description" => $category['cat_description'],
        "cat_thumbnail" => $category['cat_thumbnail'],
        "cat_sort" => $category['cat_sort'],
        "cat_counter" => $category['cat_counter']
    ]);

    $last_cat_id = $db_content->id();
    if($last_cat_id > 0) {
        $alert .= '<p>IMPORTET '.$category['cat_name'].' in ID: '.$last_cat_id.'</p>';
    } else {
        $alert .= '<p>FAILED '.$category['cat_name'].'</p>';
        $alert .= var_dump($db_content->errorInfo,true);
    }
}


echo '<div class="card p-3 mt-3">';
echo '<h4>PROZESSING CONTENT FILE</h4>';
echo '<div class="scroll-container">';
echo $alert;
echo '</div>';
echo '</div>';