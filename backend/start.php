<?php
error_reporting(E_ALL ^E_NOTICE ^E_WARNING ^E_DEPRECATED);
define('INSTALLER', TRUE);
if(!defined('SE_SECTION')) {
	die("No access");
}

use Medoo\Medoo;

if(is_file("../lib/lang/$languagePack/dict-install.php")) {
	include "../lib/lang/$languagePack/dict-install.php";
}

require SE_CONTENT.'/modules/migrate.mod/backend/inc/functions.php';
require SE_CONTENT.'/modules/migrate.mod/install/installer.php';
require SE_ROOT.'/install/php/functions.php';


echo '<h3>'.$mod['name'].' '.$mod['version'].' '.$mod['description'].'</small></h3>';

$readme = file_get_contents(SE_CONTENT."/modules/migrate.mod/README.md");

echo '<div class="card p-3">';
$Parsedown = new Parsedown();
echo $Parsedown->text($readme);
echo '</div>';