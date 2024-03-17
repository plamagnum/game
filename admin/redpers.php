<?php
session_start();
if ($_SESSION['uid'] == null) header("Location: index.php");
include "../connect.php";
$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".mysql_real_escape_string($_SESSION['uid'])."' LIMIT 1;"));
include "../functions.php";
    $al = mysql_fetch_assoc(mysql_query("SELECT * FROM `aligns` WHERE `align` = '".mysql_real_escape_string($user['align'])."' LIMIT 1;"));
if ($user['align']<2 || $user['align']>3) header("Location: ../index.php");

$vsego_u = mqfa1("select count(id) from `users`");

$vsego_ui = mqfa1("select count(id) from `users` where bot = 0");
$vsego_ub = mqfa1("select count(id) from `users` where bot = 1");
$blok_us = mqfa1("select count(id) from `users` where block = 1");
$phaos_us = mqfa1("select count(id) from `users` where align = 4");

?>
<link rel=stylesheet type="text/css" href="<?=IMGBASE;?>css/red.css">
     <meta content="text/html; charset=windows-1251" http-equiv=Content-type>

<center>
<INPUT TYPE="button" onClick="location.href='../a.php';" value="вернуться в админку" title="вернуться в админку">
</center>
    
<BODY leftmargin=5 topmargin=5 marginwidth=5 marginheight=5 bgcolor=transparent>

<h2>Статистика игроков</h2>
<font color="green">Всего пользователей</font>-<b><?=$vsego_u?></b><a href="redpers.php?action=showlist"><font color="olive">открыть список</font></a></td></tr>

</br>
<font color="green">игроков</font>-<b><?=$vsego_ui?></b>
<a href="redpers.php?action=users"><font color="olive">открыть список</font></a></td></tr>

</br>
<font color="green">ботов</font>-<b><?=$vsego_ub?></b></tr>
</br>

<font color="red">заблокированных</font>-<b><?=$blok_us?></b>
 <a href="redpers.php?action=bloklist"><font color="olive">открыть список</font></a></td></tr>
</br>
<font color="red">В хаосе</font>-<b><?=$phaos_us?></b>
 <a href="redpers.php?action=phaos"><font color="olive">открыть список</font></a></td></tr>
</br>

<font color="green">Поиск юзера по логину &nbsp; &nbsp; &nbsp; </font><font color="green">Поиск юзера по id</font>
<form method="post" action="redpers.php?action=poisk">
<input type="text" name="login" />
<input type="submit" value="Найти" />&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<input type="text" name="id" />
<input type="submit" value="Найти" /></form>

</HTML>
<?
echo '<p><a href="redpers.php?action=addform">Добавить игрока</a></p>';  
?>

<?

  
switch ( $_GET["action"] ) 
{ 
  case "showlist":    
    show_list(); break;
  case "bloklist":    
    blok_list(); break;  
  case "addform":      
    get_add_item_form(); break; 
  case "add":         
    add_item(); break;
  case "editform":    
    get_edit_item_form(); break; 
  case "update":      
    update_item(); break; 
  case "delete":      
    delete_item(); break;
  case "poisk":      
    poisk_list(); break;
  case "phaos":      
    phaos_item(); break;
case "users":      
    show_list_users(); break;

  
}

function show_list()  
{ 

  $query = 'SELECT * FROM users WHERE 1'; 
 
  $res = mysql_query( $query );
  
  echo '<h2>Полный список список всех игроков и ботов</h2>'; 
    echo '<table border="1" cellpadding="2" cellspacing="0">'; 
  echo '<tr><th>ID</th><th>Логин</th><th>пароль</><th>Город</th><th>игровой город</th><th>комната</th><th>Уровень</th><th>Значек</th><th>игрок(0)бот(1)</th></tr>'; 
  while ( $item = mysql_fetch_array( $res ) ) 
  { 
    echo '<tr>'; 
    echo '<td>'.$item['id'].'</td>'; 
    echo '<td>'.$item['login'].'</td>'; 
    echo '<td>'.$item['pass'].'</td>'; 
    echo '<td>'.$item['city'].'</td>';
    echo '<td>'.$item['incity'].'</td>';
    echo '<td>'.$item['room'].'</td>';            
    echo '<td>'.$item['level'].'</td>';
    echo '<td>'.$item['align'].'</td>';
    echo '<td>'.$item['bot'].'</td>';
    echo '<td><a href="redpers.php?action=editform&id='.$item['id'].'">Ред.</a></td>'; 
    echo '<td><a href="redpers.php?action=delete&id='.$item['id'].'">Уд.</a></td>'; 
    echo '</tr>'; 
  } 
  echo '</table>';
  
} 
function show_list_users()  
{ 

  $query = 'SELECT * FROM users WHERE bot=0'; 
 
  $res = mysql_query( $query );
  
  echo '<h2>список игроков</h2>'; 
    echo '<table border="1" cellpadding="2" cellspacing="0">'; 
  echo '<tr><th>ID</th><th>Логин</th><th>пароль</><th>Город</th><th>игровой город</th><th>комната</th><th>Уровень</th><th>Значек</th><th>игрок(0)бот(1)</th></tr>'; 
  while ( $item = mysql_fetch_array( $res ) ) 
  { 
    echo '<tr>'; 
    echo '<td>'.$item['id'].'</td>'; 
    echo '<td>'.$item['login'].'</td>'; 
    echo '<td>'.$item['pass'].'</td>'; 
    echo '<td>'.$item['city'].'</td>';
    echo '<td>'.$item['incity'].'</td>';
    echo '<td>'.$item['room'].'</td>';            
    echo '<td>'.$item['level'].'</td>';
    echo '<td>'.$item['align'].'</td>';
    echo '<td>'.$item['bot'].'</td>';
    echo '<td><a href="redpers.php?action=editform&id='.$item['id'].'">Ред.</a></td>'; 
    echo '<td><a href="redpers.php?action=delete&id='.$item['id'].'">Уд.</a></td>'; 
    echo '</tr>'; 
  } 
  echo '</table>';
  
} 


function get_add_item_form() 
{ 
  echo '<h2>Добавить юзера</h2>';  
  echo '<form name="addform" action="redpers.php?action=add" method="POST">'; 
  echo '<table>'; 
  echo '<tr>'; 
  echo '<td>Логин</td>'; 
  echo '<td><input type="text" name="login" value="" /></td>'; 
  echo '</tr>';
   echo '<tr>'; 
  echo '<td>пароль</td>'; 
  echo '<td><textarea name="pass"></textarea></td>'; 
  echo '</tr>';  
  echo '<tr>'; 
  echo '<td>город</td>'; 
  echo '<td><textarea name="city"></textarea></td>'; 
  echo '</tr>'; 
  echo '<tr>'; 
  echo '<td>игровой город</td>'; 
  echo '<td><textarea name="incity"></textarea></td>'; 
  echo '</tr>';
  echo '<tr>'; 
  echo '<td>муж(1)жен(0)</td>'; 
  echo '<td><textarea name="sex"></textarea></td>'; 
  echo '</tr>'; 
  echo '<tr>'; 
  echo '<td><input type="submit" value="Сохранить"></td>'; 
  echo '<td><button type="button" onClick="history.back();">Отменить</button></td>'; 
  echo '</tr>'; 
  echo '</table>'; 
  echo '</form>'; 
}

function add_item() 
{ 
  $login = mysql_escape_string( $_POST['login'] ); 
  $city = mysql_escape_string( $_POST['city'] ); 
  $pass = mysql_escape_string( $_POST['pass'] ); 
  $incity = mysql_escape_string( $_POST['incity'] );
  $sex = mysql_escape_string( $_POST['sex'] );  
  $query = "INSERT INTO users (login, city, pass, incity,sex) VALUES ('".$login."', '".$city."','".md5($_POST['pass'])."', '".$incity."','".$sex."');"; 

  mysql_query ( $query ); 
  header( 'Location: redpers.php' );
  die();
} 


function get_edit_item_form() 
{ 
  echo '<h2>Редактор юзеров</h2>'; 
  $query = 'SELECT * FROM users WHERE id='.intval($_GET['id']);

  $res = mysql_query( $query ); 
  $item = mysql_fetch_array( $res ); 
  echo '<form name="editform" action="redpers.php?action=update&id='. htmlspecialchars($_GET['id']).'" method="POST">'; 
  echo '<table>'; 
  echo '<tr>'; 
  echo '<td>Логин</td>'; 
  echo '<td><input type="text" name="login" value="'.$item['login'].'"></td>'; 
  echo '</tr>';
echo '<tr>'; 
  echo '<td>Опыт</td>'; 
  echo '<td><input type="text" name="exp" value="'.$item['exp'].'"></td>'; 
  echo '</tr>';
  echo '<tr>'; 
  echo '<td>Город</td>'; 
  echo '<td><textarea name="city">'.$item['city'].'</textarea></td>'; 
  echo '</tr>'; 
echo '<tr>'; 
  echo '<td>Игровой Город</td>'; 
  echo '<td><textarea name="incity">'.$item['incity'].'</textarea></td>'; 
  echo '</tr>';
  echo '<td>значек</td>'; 
  echo '<td><textarea name="align">'.$item['align'].'</textarea></td>'; 
  echo '</tr>';
  echo '<td>комната</td>'; 
  echo '<td><textarea name="room">'.$item['room'].'</textarea></td>'; 
  echo '</tr>';
  echo '<td>уровень</td>'; 
  echo '<td><textarea name="level">'.$item['level'].'</textarea></td>'; 
  echo '</tr>';
  echo '<td>игрок(0)бот(1)</td>'; 
  echo '<td><textarea name="bot">'.$item['bot'].'</textarea></td>'; 
  echo '</tr>';
  echo '<td>Пол(жен(0)муж(1))</td>'; 
  echo '<td><textarea name="sex">'.$item['sex'].'</textarea></td>'; 
  echo '</tr>';
echo '<tr>'; 
  echo '<td>сила</td>'; 
  echo '<td><textarea name="sila">'.$item['sila'].'</textarea></td>'; 
  echo '</tr>';  
echo '<tr>'; 
  echo '<td>ловкость</td>'; 
  echo '<td><textarea name="lovk">'.$item['lovk'].'</textarea></td>'; 
  echo '</tr>';  
echo '<tr>'; 
  echo '<td>интуиция</td>'; 
  echo '<td><textarea name="inta">'.$item['inta'].'</textarea></td>'; 
  echo '</tr>';  
echo '<tr>'; 
  echo '<td>выносливость</td>'; 
  echo '<td><textarea name="vinos">'.$item['vinos'].'</textarea></td>'; 
  echo '</tr>'; 
echo '<tr>'; 
  echo '<td>интеллект</td>'; 
  echo '<td><textarea name="intel">'.$item['intel'].'</textarea></td>'; 
  echo '</tr>';   
echo '<tr>'; 
  echo '<td>мудрость</td>'; 
  echo '<td><textarea name="mudra">'.$item['mudra'].'</textarea></td>'; 
  echo '</tr>';
echo '<tr>'; 
  echo '<td>креды</td>'; 
  echo '<td><textarea name="money">'.$item['money'].'</textarea></td>'; 
  echo '</tr>';     
echo '<tr>'; 
  echo '<td>екры</td>'; 
  echo '<td><textarea name="ekr">'.$item['ekr'].'</textarea></td>'; 
  echo '</tr>';                                          
  echo '<tr>'; 
  echo '<td><input type="submit" value="Сохранить"></td>'; 
  echo '<td><button type="button" onClick="history.back();">Отменить</button></td>'; 
  echo '</tr>'; 
  echo '</table>'; 
  echo '</form>'; 


} 

function update_item() 
{ 
  $login = mysql_escape_string( $_POST['login'] );
  $exp = mysql_escape_string( $_POST['exp'] );
  $city = mysql_escape_string( $_POST['city'] ); 
  $incity = mysql_escape_string( $_POST['incity'] );
  $align = mysql_escape_string( $_POST['align'] );
  $room = mysql_escape_string( $_POST['room'] );
  $level = mysql_escape_string( $_POST['level'] );
  $bot = mysql_escape_string( $_POST['bot'] );
  $sex = mysql_escape_string( $_POST['sex'] );
$sila = mysql_escape_string( $_POST['sila'] );
$lovk = mysql_escape_string( $_POST['lovk'] ); 
$inta = mysql_escape_string( $_POST['inta'] ); 
$vinos = mysql_escape_string( $_POST['vinos'] );
$intel = mysql_escape_string( $_POST['intel'] );
$mudra = mysql_escape_string( $_POST['mudra'] );
$money = mysql_escape_string( $_POST['money'] );
$ekr = mysql_escape_string( $_POST['ekr'] );                              
  $query = "UPDATE users SET login='".$login."',exp='".$exp."',city='".$city."',incity='".$incity."',align='".$align."',room='".$room."',level='".$level."',bot='".$bot."',sex='".$sex."',sila='".$sila."',lovk='".$lovk."',inta='".$inta."',vinos='".$vinos."',intel='".$intel."',mudra='".$mudra."',money='".$money."',ekr='".$ekr."'   
            WHERE id=".intval($_GET['id']);

  mysql_query ( $query ); 
$i = $_GET['id'];
mysql_query("INSERT INTO `online` (`id` ,`date` ,`room`)VALUES ('".$i."', '".time()."', '".$room."');"); 
   
  header( 'Location: redpers.php' );
  die();
} 

function delete_item() 
{ 
  $query = "DELETE FROM users WHERE id=".intval($_GET['id']);
  mysql_query ( $query ); 
 header( 'Location: redpers.php' );
  die();
} 
function blok_list() 
{ 
   $query = 'SELECT * FROM users WHERE block=1'; 
 
  $res = mysql_query( $query );

  echo '<h2>заблоченные</h2>'; 
    echo '<table border="1" cellpadding="2" cellspacing="0">'; 
  echo '<tr><th>ID</th><th>Логин</th><th>пароль</><th>Город</th><th>игровой город</th><th>комната</th><th>Уровень</th><th>Значек</th><th>игрок(0)бот(1)</th></tr>'; 
  while ( $item = mysql_fetch_array( $res ) ) 
  { 
    echo '<tr>'; 
    echo '<td>'.$item['id'].'</td>'; 
    echo '<td>'.$item['login'].'</td>'; 
    echo '<td>'.$item['pass'].'</td>'; 
    echo '<td>'.$item['city'].'</td>';
    echo '<td>'.$item['incity'].'</td>';
    echo '<td>'.$item['room'].'</td>';            
    echo '<td>'.$item['level'].'</td>';
    echo '<td>'.$item['align'].'</td>';
    echo '<td>'.$item['bot'].'</td>';
    echo '<td><a href="redpers.php?action=editform&id='.$item['id'].'">Ред.</a></td>'; 
    echo '<td><a href="redpers.php?action=delete&id='.$item['id'].'">Уд.</a></td>'; 
    echo '</tr>'; 
  } 
  echo '</table>';
  echo '<td><button type="button" onClick="history.back();">назад</button></td>'; 
} 

function phaos_item()  
{ 

  $query = 'SELECT * FROM users WHERE align=4'; 
 
  $res = mysql_query( $query );
  
  echo '<h2>Список хаосников</h2>'; 
    echo '<table border="1" cellpadding="2" cellspacing="0">'; 
  echo '<tr><th>ID</th><th>Логин</th><th>пароль</><th>Город</th><th>игровой город</th><th>комната</th><th>Уровень</th><th>Значек</th><th>игрок(0)бот(1)</th></tr>'; 
  while ( $item = mysql_fetch_array( $res ) ) 
  { 
    echo '<tr>'; 
    echo '<td>'.$item['id'].'</td>'; 
    echo '<td>'.$item['login'].'</td>'; 
    echo '<td>'.$item['pass'].'</td>'; 
    echo '<td>'.$item['city'].'</td>';
    echo '<td>'.$item['incity'].'</td>';
    echo '<td>'.$item['room'].'</td>';            
    echo '<td>'.$item['level'].'</td>';
    echo '<td>'.$item['align'].'</td>';
    echo '<td>'.$item['bot'].'</td>';
    echo '<td><a href="redpers.php?action=editform&id='.$item['id'].'">Ред.</a></td>'; 
    echo '<td><a href="redpers.php?action=delete&id='.$item['id'].'">Уд.</a></td>'; 
    echo '</tr>'; 
  } 
  echo '</table>';
} 

function poisk_list()  
{ 

  $query = 'SELECT * from `users` where `login`="' . mysql_real_escape_string($_POST['login']) . '"  or `id`="' . mysql_real_escape_string($_POST['id']) . '"  LIMIT 1'; 
 
  $res = mysql_query( $query );
   
    echo '<table border="1" cellpadding="2" cellspacing="0">'; 
  echo '<tr><th>ID</th><th>Логин</th><th>пароль</><th>Город</th><th>игровой город</th><th>комната</th><th>Уровень</th><th>Значек</th><th>игрок(0)бот(1)</th></tr>'; 
  while ( $item = mysql_fetch_array( $res ) ) 
  { 
    echo '<tr>'; 
    echo '<td>'.$item['id'].'</td>'; 
    echo '<td>'.$item['login'].'</td>'; 
    echo '<td>'.$item['pass'].'</td>'; 
    echo '<td>'.$item['city'].'</td>';
    echo '<td>'.$item['incity'].'</td>';
    echo '<td>'.$item['room'].'</td>';            
    echo '<td>'.$item['level'].'</td>';
    echo '<td>'.$item['align'].'</td>';
    echo '<td>'.$item['bot'].'</td>';
    echo '<td><a href="redpers.php?action=editform&id='.$item['id'].'">Ред.</a></td>'; 
    echo '<td><a href="redpers.php?action=delete&id='.$item['id'].'">Уд.</a></td>'; 
    echo '</tr>'; 
  }   
  echo '</table>';  
} 



?>



<INPUT TYPE=button value="Вернуться" style='width: 95px' onclick="location.href='redpers.php'">
     
