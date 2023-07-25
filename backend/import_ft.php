<?php

/**
 * import flatTrade Data
 *
 *  global vars
 * @var string $hidden_csrf_token
 */

error_reporting(E_ALL ^E_NOTICE ^E_WARNING ^E_DEPRECATED);

if(!defined('SE_SECTION')) {
    die("No access");
}

require SE_CONTENT.'/modules/migrate.mod/backend/inc/functions.php';

use Medoo\Medoo;

echo '<div class="subHeader">';
echo '<h3>'.$mod['name'].' '.$mod['version'].' import flatTrade Data</small></h3>';
echo '</div>';

$flatTrade_db_file = SE_CONTENT.'/modules/migrate.mod/upload/flatTrade.sqlite3';

if(!is_file($flatTrade_db_file)) {
    echo '<div class="alert alert-info">No flatTrade Database found:<br>'.$flatTrade_db_file.'</div>';
} else {

    /* connect the db */
    $db_flatTrade = new Medoo([
        'type' => 'sqlite',
        'database' => $flatTrade_db_file
    ]);

    $all_ft_entries = $db_flatTrade->select("ft_articles","*");
    $cnt_entries = count($all_ft_entries);

    echo '<h3>Found '.$cnt_entries.' entries</h3>';

    echo '<div class="row">';
    echo '<div class="col-md-8">';

    echo '<div class="scroll-container">';
    foreach($all_ft_entries as $entry) {
        echo '<h3>'.$entry['article_title'].'</h3>';
        echo $entry['article_teaser'];
        echo '<hr>';
    }
    echo '</div>';

    echo '</div>';
    echo '<div class="col-md-4">';

    echo '<form action="?tn=addons&sub=migrate.mod&a=import_ft" method="POST">';
    echo '<button type="submit" class="btn btn-primary w-100" name="import" value="import_ft">Import all entries</button>';
    echo $hidden_csrf_token;
    echo '</form>';

    if(isset($_POST['import']) && $_POST['import'] == 'import_ft') {
        foreach($all_ft_entries as $entry) {
            import_ft_data($entry);
        }
    }

    echo '</div>';
    echo '</div>';

}

function import_ft_data($data) {

    global $db_posts;

    $db_posts->insert("se_products", [
        "type" => "p",
        "status" => 2,
        "date" => $data['article_entrydate'],
        "releasedate" => $data['article_entrydate'],
        "lastedit" => $data['article_editdate'],
        "title" => $data['article_title'],
        "teaser" => $data['article_teaser'],
        "text" => $data['article_text'],
        "images" => $data['article_images'],
        "tags" => $data['article_tags'],
        "product_price_net" => $data['article_price_netto'],
        "product_unit" => $data['article_price_unit']
    ]);

    echo 'imported '.$data['article_title'].'<hr>';

}