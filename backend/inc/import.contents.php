<?php

/* import pages, preferences */

echo '<h4>content.sqlite</h4>';

if(isset($_POST['import_content'])) {
    $file = '../content/SQLite/content.sqlite3';
    copy_from_sqlite_to_mysql("$file",'se_addons','addon_id');
    copy_from_sqlite_to_mysql("$file",'se_carts','cart_id');
    copy_from_sqlite_to_mysql("$file",'se_categories','cat_id');
    copy_from_sqlite_to_mysql("$file",'se_comments','comment_id');
    copy_from_sqlite_to_mysql("$file",'se_feeds','feed_id');
    copy_from_sqlite_to_mysql("$file",'se_labels','label_id');
    copy_from_sqlite_to_mysql("$file",'se_logs','id');
    copy_from_sqlite_to_mysql("$file",'se_media','media_id');
    copy_from_sqlite_to_mysql("$file",'se_options','option_id');
    copy_from_sqlite_to_mysql("$file",'se_orders','id');

    copy_from_sqlite_to_mysql("$file",'se_pages','page_id');
    copy_from_sqlite_to_mysql("$file",'se_pages_cache','page_id');
    copy_from_sqlite_to_mysql("$file",'se_snippets','snippet_id');
    copy_from_sqlite_to_mysql("$file",'se_themes','theme_id');
}


echo '<form action="?tn=addons&sub=migrate.mod&a=change_db#import_content" method="POST">';

echo '<p>Import Data from content.sqlite3</p>';
echo '<input type="submit" name="import_content" value="Import Content" class="btn btn-success">';
echo '<input type="hidden" name="csrf_token" value="'.$_SESSION['token'].'">';
echo '</form>';
