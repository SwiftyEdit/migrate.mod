<?php

/**
 * migrate.mod | SwiftyEdit Addon
 * Configuration File
 */


$mod = [
    'name' => 'migrate',
    'version' => '1.1',
    'author' => "SwiftyEdit Developer Team",
    "description" => "Migrate databases - SQLite <-> MySQL",
    "database" => SE_CONTENT."/SQLite/migrate.sqlite3",
    "root" => __DIR__
];


/* acp navigation */
$modnav = [
    ['link' => 'overview', 'file' => 'start'],
    ['link' => 'change db', 'file' => 'change_db'],
    ['link' => '<i class="bi bi-arrow-right-short"></i> flatCore', 'file' => 'import_fc'],
    ['link' => '<i class="bi bi-arrow-right-short"></i> flatNews', 'file' => 'import_fn'],
    ['link' => '<i class="bi bi-arrow-right-short"></i> flatTrade', 'file' => 'import_ft', 'title' => 'import flatTrade Data'],
    ['link' => 'readme', 'file' => 'readme']
];