<?php


function mig_get_preferences() {
	
	global $mod;
    $mod_db = $mod['database'];

	$dbh = new PDO("sqlite:$mod_db");
	$sql = "SELECT * FROM prefs WHERE prefs_status LIKE '%active%' ";
	$prefs = $dbh->query($sql);
	$prefs = $prefs->fetch(PDO::FETCH_ASSOC);
	$dbh = null;
	
	
	
	return $prefs;
	
}

/**
 * @param $file string the sqlite database file
 * @param $table_name string table name
 * @param $id_column string the column for sorting (ascending)
 * @return void
 */

function copy_from_sqlite_to_mysql($file, $table_name, $id_column) {

    global $db_mysql;

    $dbh = new PDO("sqlite:$file");
    $sql = "SELECT * FROM $table_name ORDER BY $id_column ASC";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $get_data = $sth->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;


    $cnt_data = count($get_data);

    echo '<div class="scroll-container">';
    echo "<p>FOUND $cnt_data ROWS in $table_name</p>";

    if($cnt_data > 0) {

        $all_columns = array_keys($get_data[0]);

        for ($i = 0; $i < $cnt_data; $i++) {

            /* write into MySQL Database */

            foreach ($all_columns as $col) {
                if ($get_data[$i][$col] == '') {
                    $get_data[$i][$col] = '';
                }
                $insert[$col] = $get_data[$i][$col];
            }

            $db_mysql->insert("$table_name", $insert);
            $insert_id = $db_mysql->id();


            if ($insert_id > 0) {
                echo '<p class="alert alert-info">imported in <b>'.$table_name.'</b> Data ID: '.$insert_id.'</p>';
            } else {
                echo '<pre>' . $insert_id . '</pre>';
                echo '<pre>';
                var_dump($db_mysql->error);
                echo '</pre>';
            }
        }
    }
    echo '</div>';

}