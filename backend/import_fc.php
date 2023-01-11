<?php

error_reporting(E_ALL ^E_NOTICE ^E_WARNING ^E_DEPRECATED);

/**
 * upload and import flatCore sqlite files
 * @var $mod defined in info.inc.php
 */

error_reporting(E_ALL & ~E_NOTICE);
if(!defined('SE_SECTION')) {
    die("No access");
}

$fc_content_file = $mod['root'].'/upload/content.sqlite3';
$fc_posts_file = $mod['root'].'/upload/posts.sqlite3';
$fc_user_file = $mod['root'].'/upload/user.sqlite3';

require SE_CONTENT.'/modules/migrate.mod/backend/inc/functions.php';

use Medoo\Medoo;

if(isset($_POST["Upload"])) {

    $upload_dir = $mod['root'].'/upload/';
    $upload_file = $upload_dir . basename($_FILES["fileToUpload"]["name"]);

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $upload_file)) {
        echo '<div class="alert alert-success">Upload complete</div>';
    } else {
        echo '<div class="alerd alert-danger">Upload failed</div>';
    }

}

echo '<h3>'.$mod['name'].' '.$mod['version'].' import flatCore Data</small></h3>';

echo '<div class="row mb-4">';
echo '<div class="col-8">';

echo '<div class="card p-3">';
echo '<h4>Uploaded flatCore files</h4>';

echo '<table class="table">';

if(file_exists($fc_content_file)) {
    echo '<tr class="text-bg-success">';
    echo '<td>Import Content</td>';
    echo '<td class="text-end"><a class="btn btn-default" href="?tn=addons&sub=migrate.mod&a=import_fc&import=content">Start</a></td>';
    echo '</tr>';
} else {
    echo '<tr class="text-bg-info"><td>No flatCore Content file found</td><td></td></tr>';
}

if(file_exists($fc_user_file)) {
    echo '<tr class="text-bg-success">';
    echo '<td>Import User<br>User and User Groups</td>';
    echo '<td class="text-end"><a class="btn btn-default" href="?tn=addons&sub=migrate.mod&a=import_fc&import=user">Start</a></td>';
    echo '</tr>';
} else {
    echo '<tr class="text-bg-info"><td>No flatCore User file found</td><td></td></tr>';
}

if(file_exists($fc_posts_file)) {
    echo '<tr class="text-bg-success">';
    echo '<td>Import Posts</td>';
    echo '<td class="text-end"><a class="btn btn-default" href="?tn=addons&sub=migrate.mod&a=import_fc&import=posts">Start</a></td>';
    echo '</tr>';
} else {
    echo '<tr class="text-bg-info"><td>No flatCore Posts file found</td><td></td></tr>';
}

echo '</table>';

echo '</div>';

echo '</div>';
echo '<div class="col-4">';

echo '<div class="card p-3">';
echo '<form action="?tn=addons&sub=migrate.mod&a=import_fc" method="post" enctype="multipart/form-data">';
echo '<p>Select file to upload (content.sqlite3 / posts.sqlite3 / user.sqlite3)</p>';
echo '<input type="file" class="form-control" name="fileToUpload" id="fileToUpload">';
echo '<input type="submit" class="btn btn-default m-1" value="upload_fc_file" name="Upload">';
echo '<input type="hidden" name="csrf_token" value="'.$_SESSION['token'].'">';
echo '</form>';
echo '</div>';

echo '</div>';
echo '</div>';

/* start importing user */

if(isset($_GET['import']) && $_GET['import'] == 'user') {
    include 'inc/import.fc_user.php';
}

/* start importing contents */

if(isset($_GET['import']) && $_GET['import'] == 'content') {
    include 'inc/import.fc_content.php';
}

/* start importing posts */

if(isset($_GET['import']) && $_GET['import'] == 'posts') {
    include 'inc/import.fc_posts.php';
}

