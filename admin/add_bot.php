<?php
	session_start();
	if ($_SESSION['uid'] == null) header("Location: index.php");
	include "../connect.php";	
	$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$_SESSION['uid']}' LIMIT 1;"));
	if ($user['align']=="2.5") {

?>
<form method=post action="add_bot.php">
<b>Добавление ботов</b>
<table>

<tr><td>Бот да \ нет</td><td>
  <select name="bot">
    <option value="1">да</option>
	<option value="0">Нет</option>
  </select>
<tr><td>Имя Бота</td><td>
<input name="name" type="text" />
<tr><td>Левел</td><td>
<input name="level" type="text" />
<tr><td>Статов</td><td>
<input name="stats" type="text" />
<tr><td>Мастерство</td><td>
<input name="master" type="text" />

<tr><td>Сила</td><td>
<input name="sila" type="text" />
<tr><td>Ловкость</td><td>
<input name="lovk" type="text" />
<tr><td>Интуиция</td><td>
<input name="inta" type="text" />
<tr><td>Выносливость</td><td>
<input name="vinos" type="text" />

<tr><td>Хп</td><td>
<input name="hp" type="text" />

<tr><td>Образ</td><td>
<input name="shadow" type="text" />

</table>
<INPUT TYPE="submit" value=" Добавить бота ">
</form>

<?

 if ($_POST['name']) {
 $psw = '(010203)';
	if (mysql_query("insert into `users` (login,level,stats,master,pass,room,bot,hp,maxhp,money,sila,lovk,inta,vinos,shadow) values ('".$_POST['name']."','".$_POST['level']."','".$_POST['stats']."','".$_POST['master']."','".md5($psw)."','22','".$_POST['bot']."','".$_POST['hp']."','".$_POST['hp']."','10000','".$_POST['sila']."','".$_POST['lovk']."','".$_POST['inta']."','".$_POST['vinos']."','".$_POST['shadow']."');"))
	{
	echo "OK";
	}
else { echo mysql_error();}
 
 }

////////////////////////////////////////////////////////////////////
?>
<form method=post action="add_bot.php">
<b>Вставка образа</b>
<table>

<tr><td>Имя Бота</td><td>
<input name="names" type="text" />
<tr><td>Образ</td><td>
<input name="shadow" type="text" />
</table>
<INPUT TYPE="submit" value=" Добавить бота ">
</form>

<?

 if ($_POST['names']) {
 
	if (mysql_query("UPDATE `users` SET `shadow`='".$_POST['shadow']."' WHERE `login`='".$_POST['names']."'")) 
	{
	echo "OK";
	}
else { echo "NO";}
 
 }
}
?>