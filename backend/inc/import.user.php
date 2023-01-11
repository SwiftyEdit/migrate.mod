<?php

/* import user */

echo '<h4>user.sqlite</h4>';

if(isset($_POST['import_se_user'])) {

	echo '<h5 id="import_se_user">... start importing user</h5>';

    $file = '../content/SQLite/user.sqlite3';
    copy_from_sqlite_to_mysql("$file",'se_groups','group_id');
    copy_from_sqlite_to_mysql("$file",'se_tokens','token_id');
    copy_from_sqlite_to_mysql("$file",'se_user','user_id');

}



echo '<form action="?tn=addons&sub=migrate.mod&a=change_db#import_se_user" method="POST">';

echo '<p>Import User from user.sqlite3</p>';
echo '<input type="submit" name="import_se_user" value="Import User" class="btn btn-success">';
echo '<input type="hidden" name="csrf_token" value="'.$_SESSION['token'].'">';
echo '</form>';