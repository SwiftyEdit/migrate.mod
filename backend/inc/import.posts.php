<?php

/* import posts */

echo '<h4>posts.sqlite</h4>';

if(isset($_POST['import_se_posts'])) {
	echo '<h5 id="import_se_posts">... start importing posts</h5>';

    $file = '../content/SQLite/posts.sqlite3';
    copy_from_sqlite_to_mysql("$file",'se_events','id');
    copy_from_sqlite_to_mysql("$file",'se_mailbox','id');
    copy_from_sqlite_to_mysql("$file",'se_posts','post_id');
    copy_from_sqlite_to_mysql("$file",'se_products','id');
	
}







echo '<form action="?tn=addons&sub=migrate.mod&a=change_db#import_se_posts" method="POST">';

echo '<p>Import Posts from posts.sqlite3</p>';
echo '<input type="submit" name="import_se_posts" value="Import Posts" class="btn btn-success">';
echo '<input type="hidden" name="csrf_token" value="'.$_SESSION['token'].'">';
echo '</form>';
