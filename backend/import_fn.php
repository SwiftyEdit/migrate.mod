<?php

error_reporting(E_ALL ^E_NOTICE ^E_WARNING ^E_DEPRECATED);

/**
 * upload and import flatCore sqlite files
 * @var $mod defined in info.inc.php
 */

if(!defined('SE_SECTION')) {
    die("No access");
}

require SE_CONTENT.'/modules/migrate.mod/backend/inc/functions.php';

use Medoo\Medoo;

echo '<div class="subHeader">';
echo '<h3>'.$mod['name'].' '.$mod['version'].' import flatNews Data</small></h3>';
echo '</div>';

$flatNews_db_file = SE_CONTENT.'/modules/migrate.mod/upload/flatNews.sqlite3';

if(!is_file($flatNews_db_file)) {
    echo '<div class="alert alert-info">No flatNews Database found:<br>'.$flatNews_db_file.'</div>';
} else {

    /* connect the db */
    $db_flatNews = new Medoo([
        'type' => 'sqlite',
        'database' => $flatNews_db_file
    ]);

    $all_fn_entries = $db_flatNews->select("fc_news","*");
    $cnt_entries = count($all_fn_entries);

    echo '<h3>Found '.$cnt_entries.' entries</h3>';
    echo '<div class="row">';
    echo '<div class="col-md-8">';
    echo '<div class="scroll-container">';
    // loop
    echo '<table class="table table-sm">';
    foreach($all_fn_entries as $entry) {
        echo '<tr>';
        echo '<td>'.date("Y.m.d H:i",$entry['news_date']).'</td>';
        echo '<td>'.$entry['news_type'].'</td>';
        echo '<td>'.$entry['news_title'].'</td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '</div>';
    echo '</div>';
    echo '<div class="col-md-4">';
    echo '<form action="?tn=addons&sub=migrate.mod&a=import_fn" method="POST">';
    echo '<button type="submit" class="btn btn-primary w-100" name="import" value="import_fn">Import all entries</button>';
    echo $hidden_csrf_token;
    echo '</form>';

    if(isset($_POST['import']) && $_POST['import'] == 'import_fn') {
        foreach($all_fn_entries as $entry) {
            import_fn_data($entry);
        }
    }

    echo '</div>';
    echo '</div>';
}



function import_fn_data($data) {

    global $db_posts;

    if($data['news_type'] == 'message') {
        $data['news_type'] = 'm';
    }
    if($data['news_type'] == 'link') {
        $data['news_type'] = 'l';
    }
    if($data['news_type'] == 'video') {
        $data['news_type'] = 'v';
    }
    if($data['news_type'] == 'image') {
        $data['news_type'] = 'i';
    }


    $db_posts->insert("se_posts", [
        "post_type" => $data['news_type'],
        "post_date" => $data['news_date'],
        "post_releasedate" => $data['news_releasedate'],
        "post_lastedit" => $data['news_releasedate'],
        "post_title" => $data['news_title'],
        "post_teaser" => $data['news_teaser'],
        "post_text" => $data['news_text'],
        "post_images" => $data['news_images'],
        "post_tags" => $data['news_tags'],
        "post_link" => $data['news_link'],
        "post_video_url" => $data['news_video_url'],
        "post_author" => $data['news_author'],
        "post_status" => 1,
        "post_lang" => $data['news_lang'],
        "post_slug" => $data['news_slug'],
        "post_priority" => (int) $data['news_priority'],
        "post_fixed" => (int) $data['news_fixed'],
        "post_hits" => (int) $data['news_hits'],
        "post_meta_title" => $data['news_title'],
        "post_meta_description" => $data['news_teaser']
    ]);

    echo 'imported '.$data['news_title'].'<hr>';

}