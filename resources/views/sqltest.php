テーブル『users』
<br/>
<?php
    // ユーザー名やパスワードなどは、
    // 後ほど紹介する docker-compose.yml と併せて適宜変更してください
    $dsn = 'pgsql:dbname=sampledb;host=myapp-db';
    $db = new PDO($dsn, 'sample-user', 'hi2mi4i6');

    $sql = 'SELECT * FROM users order by id';
    echo '<pre>';
    foreach ($db->query($sql) as $row) {
      var_dump($row);
    }
    echo '</pre>';
?>

	<br/>
	<br/>

テーブル『memos』
<br/>

<?php
    $sql = 'SELECT * FROM memos order by tag_id, user_id, id';
    echo '<pre>';
    foreach ($db->query($sql) as $row) {
      var_dump($row);
    }
    echo '</pre>';
?>

<br/>
<br/>

テーブル『tags』
<br/>

<?php
$sql = 'SELECT * FROM tags order by user_id, id';
echo '<pre>';
foreach ($db->query($sql) as $row) {
var_dump($row);
}
echo '</pre>';

$db = null;
?>
