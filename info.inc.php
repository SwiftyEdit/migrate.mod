<?php

/**
 * cookies | flatCore Modul
 * Configuration File
 */


$mod = [
    'name' => 'migrate',
    'version' => '0.1',
    'author' => "SwiftyEdit Developer Team",
    "description" => "Migrate databases - SQLite <-> MySQL",
    "database" => SE_CONTENT."/SQLite/migrate.sqlite3",
    "root" => __DIR__
];


/* acp navigation */
$modnav = [
    ['link' => 'overview', 'file' => 'start'],
    ['link' => 'change db', 'file' => 'change_db'],
    ['link' => 'import fC', 'file' => 'import_fc'],
    ['link' => 'readme', 'file' => 'readme']
];