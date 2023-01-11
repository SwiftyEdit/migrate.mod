<?php
use Medoo\Medoo;
$alert = '';


$db_import_user = new Medoo([
    'type' => 'sqlite',
    'database' => $fc_user_file
]);

$get_user_data = $db_import_user->select("fc_user", "*");

foreach($get_user_data as $user) {
    $db_user->insert("se_user", [
        "user_nick" => $user['user_nick'],
        "user_mail" => $user['user_mail'],
        "user_class" => $user['user_class'],
        "user_psw_hash" => $user['user_psw_hash'],
        "user_verified" => $user['user_verified'],
        "user_registerdate" => $user['user_registerdate'],
        "user_drm" => $user['user_drm']
    ]);

    $last_user_id = $db_user->id();
    if($last_user_id > 0) {
        $alert .= '<p>IMPORTET '.$user['user_nick'].' in ID: '.$last_user_id.'</p>';
    } else {
        $alert .= '<p>FAILED '.$user['user_nick'].'</p>';
        $alert .= var_dump($db_content->errorInfo,true);
    }

}

$get_user_groups = $db_import_user->select("fc_groups", "*");

foreach($get_user_groups as $group) {
    $db_user->insert("se_groups", [
        "group_name" => $group['group_name'],
        "group_description" => $group['group_description'],
        "group_user" => $group['group_user']
    ]);

    $last_group_id = $db_user->id();
    if($last_group_id > 0) {
        $alert .= '<p>IMPORTET '.$group['group_name'].' in ID: '.$last_group_id.'</p>';
    } else {
        $alert .= '<p>FAILED '.$group['group_name'].'</p>';
        $alert .= var_dump($db_content->errorInfo,true);
    }
}

echo '<div class="card p-3 mt-3">';
echo '<h4>PROZESSING USER FILE</h4>';
echo '<div class="scroll-container">';
echo $alert;
echo '</div>';
echo '</div>';