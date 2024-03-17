<?
session_start();
if ($_SESSION['uid'] == null) header("Location: index.php");
include "../connect.php";
$user = mysql_fetch_array(mq("SELECT * FROM `users` WHERE `id` = '{$_SESSION['uid']}' LIMIT 1;"));
$al = mysql_fetch_array(mq("SELECT * FROM `aligns` WHERE `deal` = '".$user['deal']."' LIMIT 1;"));
include "../functions.php";
if ($user['deal']== 0) die;
if ($user['battle'] != 0) { header('location: /fbattle.php');die();}
function expa ($str) {
	$array = explode(";",$str);
	for ($i = 0; $i<=count($array)-2;$i=$i+2) {
		$rarray[$array[$i]] = $array[$i+1];
	}
	return $rarray;
}
?>
<HTML>
<HEAD>
<link rel=stylesheet type="text/css" href="i/css/main.css">
<meta content="text/html; charset=windows-1251" http-equiv=Content-type>
<META Http-Equiv=Cache-Control Content="no-cache, max-age=0, must-revalidate, no-store">
<meta http-equiv=PRAGMA content=NO-CACHE>
<META Http-Equiv=Expires Content=0>
<SCRIPT>
var Hint3Name = '';
function runmagic(title, magic, name){
    document.all("hint3").innerHTML = '<table width=100% cellspacing=1 cellpadding=0 bgcolor=CCC3AA><tr><td align=center><B>'+title+'</td><td width=20 align=right valign=top style="cursor: hand" onclick="closehint3();"><BIG><B>x</b></BIG></td></tr><tr><td colspan=2>'+
    '<table width=100% cellspacing=0 cellpadding=2 bgcolor=FFF6DD><tr><td colspan=2><form action="dealer.php" method=POST><INPUT TYPE=hidden name=sd4 value="<? echo @$user['id']; ?>"> <INPUT TYPE=hidden NAME="use" value="'+magic+'">'+
    'Укажите логин персонажа:<small><BR>(можно щелкнуть по логину в чате)</TD></TR><TR><TD align=left><INPUT TYPE=text NAME="'+name+'">'+
    '<select style="background-color:#eceddf; color:#000000;" name="timer"><option value=15>15 мин<option value=30>30 мин<option value=60>1 час'+
    '<option value=180>3 часа<option value=360>6 часов<option value=720>12 часов<option value=1440>сутки'+
    '<option value=10080>неделя<option value=40320>месяц</select></TD><TD width=30><INPUT TYPE="submit" value=" »» "></TD></TR></FORM></TABLE></td></tr></table>';
    document.all("hint3").style.visibility = "visible";
    document.all("hint3").style.left = 100;
    document.all("hint3").style.top = 100;
    document.all(name).focus();
    Hint3Name = name;
}
function teleport(title, magic, name){
document.all("hint3").innerHTML = '<table width=100% cellspacing=1 cellpadding=0 bgcolor=CCC3AA><tr><td align=center><B>'+title+'</td><td width=20 align=right valign=top style="cursor: hand" onclick="closehint3();"><BIG><B>x</b></BIG></td></tr><tr><td colspan=2>'+
'<table width=100% cellspacing=0 cellpadding=2 bgcolor=FFF6DD><tr><td colspan=2><form action="dealer.php" method=POST><INPUT TYPE=hidden name=sd4 value="<? echo @$user['id']; ?>"> <INPUT TYPE=hidden NAME="use" value="'+magic+'">'+
'Укажите логин персонажа:<small><BR>(можно щелкнуть по логину в чате)</TD></TR><TR><TD align=left><INPUT TYPE=text NAME="'+name+'">'+
'<select style="background-color:#eceddf; color:#000000;" name="room">'+
'<option value=0">Секретная Комната'+
'<option value=1">Комната для новичков'+
'<option value=2">Комната перехода'+
'<option value=3">Бойцовский Клуб'+
'<option value=4">Подземелье'+
'<option value=5">Зал Воинов 1'+
'<option value=6">Зал Воинов 2'+
'<option value=7">Зал Воинов 3'+
'<option value=8">Торговый зал'+
'<option value=9">Рыцарский зал'+
'<option value=10">Башня рыцарей-магов'+
'<option value=11">2 Этаж'+
'<option value=26">Паркова'+
'<option value=13">Астральные этажи'+
'<option value=14">Огненный мир'+
'<option value=15">Зал Паладинов'+
'<option value=16">Совет Белого Братства'+
'<option value=17">Зал Тьмы'+
'<option value=18">Царство Тьмы'+
'<option value=19">Будуар'+
'<option value=20">Центральная площадь'+
'<option value=21">Страшилкина улица'+
'<option value=22">Магазин'+
'<option value=23">Ремонтная мастерская'+
'<option value=25">Комиссионный магазин'+
'<option value=27">Почта'+
'<option value=28">Регистратура кланов'+
'<option value=37">Банк'+
'<option value=31">Башня смерти'+
'<option value=34">Цветочный магазин'+
'<option value=35">Магазин Березка'+
'<option value=36">Зал Стихий'+
'<option value=37">Магазин Забытой Чести'+
'<option value=42">Лотерея Сталкеров'+
'<option value=43">Комната Знахаря'+
'<option value=402">Вход в подземелье'+
'<option value=404">Магазин Луки'+
'<option value=666">Тюрьма'+
'<option value=667">Бар "Пьяный Админ"'+
'<option value=668">Зоомагазин'+
'<option value=101">Общежитие Этаж 1'+
'<option value=49">Общежитие Этаж 2'+
'<option value=44">VIP'+
'<option value=29">Торговая'+
'</select></select>'+
'</TD><TD width=30><INPUT TYPE="submit" value=" »» "></TD></TR></FORM></TABLE></td></tr></table>';
document.all("hint3").style.visibility = "visible";
document.all("hint3").style.left = 100;
document.all("hint3").style.top = 100;
document.all(name).focus();
Hint3Name = name;
}
function closehint3(){
document.all("hint3").style.visibility="hidden";
Hint3Name='';
}
</SCRIPT>
<body leftmargin=5 topmargin=5 marginwidth=0 marginheight=0 bgcolor=transparent >
<table align=right><tr><td><INPUT TYPE="button" class=btn onclick="location.href='dealer.php';" value="Обновить" title="Обновить"> 
<INPUT TYPE="button" class=btn onclick="location.href='../main.php';" value="Вернуться" title="Вернуться"></table>
<center><img src=i/align/align_5.gif><b><?echo $user['login']?></b>[<?echo $user['level']?>]<a href=/inf.php?<?echo $user['id']?> target="_blank"><img src=i/chat/inf.gif></a></center>
</HEAD>
<?
echo "<div align=center id=hint3></div>";
$moj = expa($al['accses']);
if(!$_POST['use']){$_POST['use']=$_GET['use'];}
if(in_array($_POST['use'],array_keys($moj))) {
echo htmlspecialchars($_GET['use']);
switch($_POST['use']) {
case "devastate":
include("../magic/vip/devastate.php");
break;
case "defence":
include("../magic/vip/defence.php");
break;
case "power_hp6":
include("../magic/vip/power_hp6.php");
break;
case "blago":
include("../magic/vip/blago_admin.php");
break;
case "battack":
include("../magic/vip/battack.php");
break;
case "hidden":
include("../magic/vip/hidden.php");
break;
}
}
echo "<table>";
echo "<tr><td align=center><br>";
foreach($moj as $k => $v) {
switch($k) {
case "teleport": $script_name="teleport"; $magic_name="Телепортация"; break;
case "sleep": $script_name="runmagic"; $magic_name="Заклятие Молчания"; break;
}
if ($script_name) {print "<a onclick=\"javascript:$script_name('$magic_name','$k','target','target1') \" href='#'><img src='http://battlfight.smrtp.ru/i/magic/".$k.".gif' title='".$magic_name."'></a> ";}
}
if ($user["deal"]>0 && $user['deal']<6) {
print "<input type=button value=\"Дать сундук\" onclick=\"javascript:runmagic5('Выдать сундук','givechest','target','target1') \">&nbsp;";
print "<input type=button value=\"Забрать екр\" onclick=\"javascript:runmagict('Забрать екр','takeekr','target','target1') \">&nbsp;";
}
echo "</td></tr></table>";

if($user['deal']> 0){
############# Проверка и открытие данных счета  #################
if (isset($_SESSION['bankid'])){
$bank_alhimik = mysql_fetch_array(mysql_query("SELECT * FROM `bank` WHERE `id` = ".$_SESSION['bankid']." LIMIT 1;"));	
}

############## Экоанизация формы ################################
echo '<TR><TD style="text-align: left; ">';
echo "<br><h4>Дилерская панель</h4>";
If (isset($_SESSION['bankid'])){echo "Банк: <FONT COLOR=#339900>".$bank_alhimik['ekr']."</font> екр.";}
echo "<form method=post action=\"dealer.php\"><b>Зачислить екры на счет </b>
<table><tr> <td>Введите сумму </td>
<td><input type='text' name='ekr' value=''></td>
<td> Номер счета <input type='text' name='bank' value=''></td>
<td> Ник персонажа <input type='text' name='tonick' value=''></td><td>";
If (isset($_SESSION['bankid'])){ echo"<input type=submit name='putekr' value='Зачислить'>";}else{echo "<font color=red>Авторизируйтесь в Банке!</font>";}
echo "</td></tr></table></form>";
echo "<br><form method=post action=\"dealer.php\"><b>Проверить логин / номер счета </b>
<table><tr><td>Логин </td><td><input type='text' name='charlogin' value=''></td>
<td> Номер счета <input type='text' name='charbank' value=''></td>
<td><input type=submit name='checkbank' value='Проверить'></td></tr>
</table></form>
</TD></TR>";

############## Зачисление екр #####################################
if ($_POST['putekr'] and isset($_SESSION['bankid'])){
if (isset($_POST['ekr']) and isset($_POST['bank']) and isset($_POST['tonick'])) {
If ($_POST['ekr']<=$bank_alhimik['ekr'] and $_POST['ekr']>0){
$tonick = mysql_fetch_array(mysql_query("SELECT login,id, align FROM `users` WHERE `login` = '".mysql_real_escape_string($_POST['tonick'])."' LIMIT 1;"));
$bank = mysql_fetch_array(mysql_query("SELECT owner,id FROM `bank` WHERE `id` = '".mysql_real_escape_string($_POST['bank'])."' LIMIT 1;"));
if  (ereg("auto-",$user['login']) || ereg("auto-",$user['login'])) {
$botfull=$user['login'];
list($bot, $botlogin) = explode("-", $user['login']);
$botnick = mysql_fetch_array(mysql_query("SELECT login,id FROM `users` WHERE `login` = '".mysql_real_escape_string($botlogin)."' LIMIT 1;"));
$user['login']=$botnick['login'];
$user['id']=$botnick['id'];
}

if ($bank['owner'] && $tonick['id'] && $bank['owner'] == $tonick['id']) {
If ($user['deal']> 0 or (($user['align']==5.99 or $user['align']==5.5) and (($tonick['align']>1 and $tonick['align']<2) or ($tonick['align']>3 and $tonick['align']<4) or ($tonick['align']>5 and $tonick['align']<6)))){
$_POST['ekr'] = round($_POST['ekr'],2);
if (mysql_query("UPDATE `bank` set `ekr` = ekr+'".mysql_real_escape_string($_POST['ekr'])."' WHERE `id` = '".mysql_real_escape_string($_POST['bank'])."' LIMIT 1;")) {
if ($bot && $botlogin) {
mysql_query("INSERT INTO `dilerdelo` (dilerid,dilername,bank,owner,ekr) values ('".mysql_real_escape_string($_SESSION['uid'])."','".$botfull."','".mysql_real_escape_string($_POST['bank'])."','".mysql_real_escape_string($_POST['tonick'])."','".mysql_real_escape_string($_POST['ekr'])."');");
mysql_query("INSERT INTO `dilerdelo` (dilerid,dilername,bank,owner,ekr) values ('".mysql_real_escape_string($user['id'])."','".$botfull."','".mysql_real_escape_string($_POST['bank'])."','".mysql_real_escape_string($_POST['tonick'])."','".mysql_real_escape_string($_POST['ekr'])."');");
}else{
mysql_query("INSERT INTO `dilerdelo` (dilerid,dilername,bank,owner,ekr) values ('".mysql_real_escape_string($user['id'])."','".mysql_real_escape_string($user['login'])."','".mysql_real_escape_string($_POST['bank'])."','".mysql_real_escape_string($_POST['tonick'])."','".mysql_real_escape_string($_POST['ekr'])."');");
}

mysql_query("INSERT INTO `delo`(`id` , `author` ,`pers`, `text`, `type`, `date`) VALUES ('','0','".mysql_real_escape_string($tonick['id'])."','Получено ".mysql_real_escape_string($_POST['ekr'])." екр на счет №".mysql_real_escape_string($_POST['bank'])." от дилера ".$user['login']."',1,'".time()."');");
$us = mysql_fetch_array(mysql_query("select `id` from `online` WHERE `date` >= ".(time()-60)." AND `id` = '".$tonick['id']."' LIMIT 1;"));

if($us[0]){
addchp ('<font color=red>Внимание!</font> На ваш счет №'.$_POST['bank'].' переведено '.$_POST['ekr'].' екр. от дилера '.$user['login'].'  ','{[]}'.$_POST['tonick'].'{[]}');
}else{
mysql_query("INSERT INTO `telegraph` (`owner`,`date`,`text`) values ('".$tonick['id']."','','".'<font color=red>Внимание!</font> На ваш счет №'.mysql_real_escape_string($_POST['bank']).' переведено '.mysql_real_escape_string($_POST['ekr']).' екр. от дилера '.mysql_real_escape_string($user['login']).'  '."');");
}

mysql_query("UPDATE `bank` set `ekr` = ekr-'".mysql_real_escape_string($_POST['ekr'])."' WHERE `id` = '".mysql_real_escape_string($_SESSION['bankid'])."' LIMIT 1;");

print "<b><font color=red>Успешно зачислено {$_POST['ekr']} екр. на счет {$_POST['bank']} персонажа {$_POST['tonick']}!</font></b>";

}else{
print "<b><font color=red>Произошла ошибка!</font></b>";
}
}else{print "<b><font color=red>Вы не можете передавать персонажу {$_POST['tonick']} екры!</font></b>";}
}else{print "<b><font color=red>Счет номер {$_POST['bank']} не принадлежит персонажу {$_POST['tonick']}!</font></b>";}
}else{print "<b><font color=red>У Вас недостаточно екр. на счете!</font></b>";}
}else{print "<b><font color=red>Введите сумму, номер счета и ник персонажа!</font></b>";}
}

if ($_POST['checkbank']) {
if ($_POST['charlogin']) {
$tonick = mysql_fetch_array(mysql_query("SELECT login,id FROM `users` WHERE `login` = '".mysql_real_escape_string($_POST['charlogin'])."' LIMIT 1;"));
$bankdb = mysql_query("SELECT owner,id FROM `bank` WHERE `owner` = '".mysql_real_escape_string($tonick['id'])."'");
print "Персонажу {$_POST['charlogin']} принадлежат счета: <br>";
while ($bank=mysql_fetch_array($bankdb)) {
print "№ {$bank['id']} <br>";
}
}
else if  ($_POST['charbank']) {
$bank = mysql_fetch_array(mysql_query("SELECT owner,id FROM `bank` WHERE `id` = '".mysql_real_escape_string($_POST['charbank'])." 'LIMIT 1;"));
$tonick = mysql_fetch_array(mysql_query("SELECT login,id FROM `users` WHERE `id` = '".mysql_real_escape_string($bank['owner'])."' LIMIT 1;"));
print "Счет № {$_POST['charbank']} принадлежит персонажу {$tonick['login']} <br>";
}		
}
}
##### Silver Account #####
echo "<form method=post><fieldset style='border:2px dashed #656565;'><legend style='color: green; font-weight: bold;'>Silver Account</legend>
<table><tr><td>Логин</td><td><input type='text' name='login' value='".$_POST['login']."'></td></tr>
<tr><td>Должность</td><td><select name='silver'>
<option value='604800'>Неделя</option>		
<option value='2629743'>Месяц</option>
<option value='0'>Вечно</option>";					
echo "</select></td></tr>
<tr><td><input type=submit value='Присвоить'></td></tr></table>";
echo "</fieldset></form>";				
if (isset($_POST['login']) && isset($_POST['silver'])) {
$target_user_tel=mysql_fetch_array(mq("SELECT `id`,`vip`,`ekr` FROM `users` WHERE `login` = '".$_POST['login']."';"));
if ($_POST['silver']==604800){
//Срок для личного дела
$skolko = 'Неделю';
//Цена на неделю
$cost = '50';
}elseif ($_POST['silver']==2629743){
//Срок для личного дела
$skolko = 'Месяц';
//Цена на месяц
$cost = '150';
}elseif ($_POST['silver']==0){
//Срок для личного дела
$skolko = 'Вечно';
//Цена на вечно
$cost = '600';
}
if ($target_user_tel['ekr']<$cost){
echo"У персонажа недостаточно еврокредитов для данной операции";
}elseif ($target_user_tel['vip']!=0){
echo"У персонажа уже имееться VIP Account";
}elseif (!empty($target_user_tel['id'])){
mq("UPDATE `users` SET `vip` = '1', `ekr`=`ekr`-'$cost' WHERE `id` = '".$target_user_tel['id']."' LIMIT 1;");
if($_POST['silver']!=0){
mq("INSERT INTO `effects` (`owner`,`name`,`time`,`type`) values ('".$target_user_tel['id']."','Silver Account',".(time()+$_POST['silver']).",70);");
}
mq("INSERT INTO `delo`(`id` , `author` ,`pers`, `text`, `type`, `date`) VALUES ('','0','".$target_user_tel['id']."','Купил Silver Account у диллера ".$user['login']." на срок $skolko.',1,'".time()."');");
}else{
echo"<font color=red>Не был найден персонаж ".$_POST['login']."!</font><br>";	
}
}
##### Gold Account #####
echo "<form method=post><fieldset style='border:2px dashed #656565;'><legend style='color: green; font-weight: bold;'>Gold Account</legend>
<table><tr><td>Логин</td><td><input type='text' name='login' value='".$_POST['login']."'></td></tr>
<tr><td>Должность</td><td><select name='Gold'>
<option value='604800'>Неделя</option>		
<option value='2629743'>Месяц</option>
<option value='0'>Вечно</option>";					
echo "</select></td></tr>
<tr><td><input type=submit value='Присвоить'></td></tr></table>";
echo "</fieldset></form>";				
if (isset($_POST['login']) && isset($_POST['Gold'])) {
$target_user_tel=mysql_fetch_array(mq("SELECT `id`,`vip`,`ekr` FROM `users` WHERE `login` = '".$_POST['login']."';"));
if ($_POST['Gold']==604800){
//Срок для личного дела
$skolko = 'Неделю';
//Цена на неделю
$cost = '100';
}elseif ($_POST['Gold']==2629743){
//Срок для личного дела
$skolko = 'Месяц';
//Цена на месяц
$cost = '250';
}elseif ($_POST['Gold']==0){
//Срок для личного дела
$skolko = 'Вечно';
//Цена на вечно
$cost = '800';
}
if ($target_user_tel['ekr']<$cost){
echo"У персонажа недостаточно еврокредитов для данной операции";
}elseif ($target_user_tel['vip']!=0){
echo"У персонажа уже имееться VIP Account";
}elseif (!empty($target_user_tel['id'])){
mq("UPDATE `users` SET `vip` = '2', `ekr`=`ekr`-'$cost' WHERE `id` = '".$target_user_tel['id']."' LIMIT 1;");
if($_POST['Gold']!=0){
mq("INSERT INTO `effects` (`owner`,`name`,`time`,`type`) values ('".$target_user_tel['id']."','Gold Account',".(time()+$_POST['Gold']).",70);");
}
mq("INSERT INTO `delo`(`id` , `author` ,`pers`, `text`, `type`, `date`) VALUES ('','0','".$target_user_tel['id']."','Купил Gold Account у диллера ".$user['login']." на срок $skolko.',1,'".time()."');");
}else{
echo"<font color=red>Не был найден персонаж ".$_POST['login']."!</font><br>";	
}
}
##### Platinum Account #####
echo "<form method=post><fieldset style='border:2px dashed #656565;'><legend style='color: green; font-weight: bold;'>Platinum Account</legend>
<table><tr><td>Логин</td><td><input type='text' name='login' value='".$_POST['login']."'></td></tr>
<tr><td>Должность</td><td><select name='Platinum'>
<option value='604800'>Неделя</option>		
<option value='2629743'>Месяц</option>
<option value='0'>Вечно</option>";					
echo "</select></td></tr>
<tr><td><input type=submit value='Присвоить'></td></tr></table>";
echo "</fieldset></form>";				
if (isset($_POST['login']) && isset($_POST['Platinum'])) {
$target_user_tel=mysql_fetch_array(mq("SELECT `id`,`vip`,`ekr` FROM `users` WHERE `login` = '".$_POST['login']."';"));
if ($_POST['Platinum']==604800){
//Срок для личного дела
$skolko = 'Неделю';
//Цена на неделю
$cost = '150';
}elseif ($_POST['Platinum']==2629743){
//Срок для личного дела
$skolko = 'Месяц';
//Цена на месяц
$cost = '350';
}elseif ($_POST['Platinum']==0){
//Срок для личного дела
$skolko = 'Вечно';
//Цена на вечно
$cost = '1000';
}
if ($target_user_tel['ekr']<$cost){
echo"У персонажа недостаточно еврокредитов для данной операции";
}elseif ($target_user_tel['vip']!=0){
echo"У персонажа уже имееться VIP Account";
}elseif (!empty($target_user_tel['id'])){
mq("UPDATE `users` SET `vip` = '3', `ekr`=`ekr`-'$cost' WHERE `id` = '".$target_user_tel['id']."' LIMIT 1;");
if($_POST['Platinum']!=0){
mq("INSERT INTO `effects` (`owner`,`name`,`time`,`type`) values ('".$target_user_tel['id']."','Platinum Account',".(time()+$_POST['Platinum']).",70);");
}
mq("INSERT INTO `delo`(`id` , `author` ,`pers`, `text`, `type`, `date`) VALUES ('','0','".$target_user_tel['id']."','Купил Platinum Account у диллера ".$user['login']." на срок $skolko.',1,'".time()."');");
}else{
echo"<font color=red>Не был найден персонаж ".$_POST['login']."!</font><br>";	
}
}
?>
</html>