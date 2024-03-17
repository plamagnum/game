<?php
/*---спам------*/
function my_strtolower($string)
{
    $str = strtolower($string);
    if (strtolower('Ц') != 'ц') {
        $string = strtr($string, 'АБВГДЕЁЖЗИЙКЛМНОРПСТУФХЦЧШЩЪЬЫЭЮЯ', 'абвгдеёжзийклмнорпстуфхцчшщъьыэюя');
        $string = strtr($string, 'QWERTYUIOPASDFGHJKLZXCVBNM', 'qwertyuiopasdfghjklzxcvbnm');
    }
    return $string;
}

if (isset($_POST['spam_text']) && $_POST['spam_text'] != '') {
    mysql_query('INSERT INTO `spam_text` (`text`) VALUES ("' . mysql_real_escape_string(my_strtolower($_POST['spam_text'])) . '")');
    $user->error = '<b style="color:red">Готово</b>';

}
if (isset($_GET['del_t']) && is_numeric($_GET['del_t'])) {
    mysql_query('DELETE FROM `spam_text` WHERE `id`="' . $_GET['del_t'] . '"');
    header("Location: a.php#tab2");
    echo  '<b style="color:red">Готово</b>';
}
/*---------*/
echo '<h4>Панель управления фильтром спама</h4>';
echo '<form method="post" action="">
	Плохое слово <input type="text" name="spam_text" maxlength="20" />&nbsp;<input type="submit" value="Добавить плохое слово" name="turn_submit" /><br />
	<br clear="all" />
	<b>Фильтр:</b><br />';
$bads = mysql_query('SELECT * FROM `spam_text` ORDER by `id` DESC');
while ($badswords = mysql_fetch_array($bads)) {
    echo $badswords['text'] . "<a href='?pal&p=13&del_t=" . $badswords['id'] . "'>X</a>, ";
}
?>
