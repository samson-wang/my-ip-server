<?php

parse_str($_SERVER['QUERY_STRING']);
$mysqli = new mysqli("localhost", "user", "pswd", "db");
if (!isset($ak) or empty($ak)) {
    echo '<head>52 Minchao!</head>';
    return;
}
$result = $mysqli->query("SELECT * from IPRecord where akey=\"".$ak."\"");
$row = $result->fetch_assoc();
if (!$row) {
    echo '<head>52 Minchao!</head>';
    return;
}

if ($m == 'up' && $_SERVER["REMOTE_ADDR"] != $row["url"]) {
    $q = "update IPRecord set url='".$_SERVER['REMOTE_ADDR']."' where akey='$ak'";
    $result = $mysqli->query($q);
    
    $row = $result->fetch_assoc();
    echo '</br>update</br>';
    var_dump($row);
} elseif ($m == 'show') {
    $row['your ip:'] = $_SERVER['REMOTE_ADDR'];
    echo json_encode($row);
} elseif ($m == 'home') {
    echo '<a href="http://'.$row["url"].':8811"/>Click here</a>';
}

