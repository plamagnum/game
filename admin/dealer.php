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
    '������� ����� ���������:<small><BR>(����� �������� �� ������ � ����)</TD></TR><TR><TD align=left><INPUT TYPE=text NAME="'+name+'">'+
    '<select style="background-color:#eceddf; color:#000000;" name="timer"><option value=15>15 ���<option value=30>30 ���<option value=60>1 ���'+
    '<option value=180>3 ����<option value=360>6 �����<option value=720>12 �����<option value=1440>�����'+
    '<option value=10080>������<option value=40320>�����</select></TD><TD width=30><INPUT TYPE="submit" value=" �� "></TD></TR></FORM></TABLE></td></tr></table>';
    document.all("hint3").style.visibility = "visible";
    document.all("hint3").style.left = 100;
    document.all("hint3").style.top = 100;
    document.all(name).focus();
    Hint3Name = name;
}
function teleport(title, magic, name){
document.all("hint3").innerHTML = '<table width=100% cellspacing=1 cellpadding=0 bgcolor=CCC3AA><tr><td align=center><B>'+title+'</td><td width=20 align=right valign=top style="cursor: hand" onclick="closehint3();"><BIG><B>x</b></BIG></td></tr><tr><td colspan=2>'+
'<table width=100% cellspacing=0 cellpadding=2 bgcolor=FFF6DD><tr><td colspan=2><form action="dealer.php" method=POST><INPUT TYPE=hidden name=sd4 value="<? echo @$user['id']; ?>"> <INPUT TYPE=hidden NAME="use" value="'+magic+'">'+
'������� ����� ���������:<small><BR>(����� �������� �� ������ � ����)</TD></TR><TR><TD align=left><INPUT TYPE=text NAME="'+name+'">'+
'<select style="background-color:#eceddf; color:#000000;" name="room">'+
'<option value=0">��������� �������'+
'<option value=1">������� ��� ��������'+
'<option value=2">������� ��������'+
'<option value=3">���������� ����'+
'<option value=4">����������'+
'<option value=5">��� ������ 1'+
'<option value=6">��� ������ 2'+
'<option value=7">��� ������ 3'+
'<option value=8">�������� ���'+
'<option value=9">��������� ���'+
'<option value=10">����� �������-�����'+
'<option value=11">2 ����'+
'<option value=26">�������'+
'<option value=13">���������� �����'+
'<option value=14">�������� ���'+
'<option value=15">��� ���������'+
'<option value=16">����� ������ ��������'+
'<option value=17">��� ����'+
'<option value=18">������� ����'+
'<option value=19">������'+
'<option value=20">����������� �������'+
'<option value=21">����������� �����'+
'<option value=22">�������'+
'<option value=23">��������� ����������'+
'<option value=25">������������ �������'+
'<option value=27">�����'+
'<option value=28">������������ ������'+
'<option value=37">����'+
'<option value=31">����� ������'+
'<option value=34">��������� �������'+
'<option value=35">������� �������'+
'<option value=36">��� ������'+
'<option value=37">������� ������� �����'+
'<option value=42">������� ���������'+
'<option value=43">������� �������'+
'<option value=402">���� � ����������'+
'<option value=404">������� ����'+
'<option value=666">������'+
'<option value=667">��� "������ �����"'+
'<option value=668">����������'+
'<option value=101">��������� ���� 1'+
'<option value=49">��������� ���� 2'+
'<option value=44">VIP'+
'<option value=29">��������'+
'</select></select>'+
'</TD><TD width=30><INPUT TYPE="submit" value=" �� "></TD></TR></FORM></TABLE></td></tr></table>';
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
<table align=right><tr><td><INPUT TYPE="button" class=btn onclick="location.href='dealer.php';" value="��������" title="��������"> 
<INPUT TYPE="button" class=btn onclick="location.href='../main.php';" value="���������" title="���������"></table>
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
case "teleport": $script_name="teleport"; $magic_name="������������"; break;
case "sleep": $script_name="runmagic"; $magic_name="�������� ��������"; break;
}
if ($script_name) {print "<a onclick=\"javascript:$script_name('$magic_name','$k','target','target1') \" href='#'><img src='http://battlfight.smrtp.ru/i/magic/".$k.".gif' title='".$magic_name."'></a> ";}
}
if ($user["deal"]>0 && $user['deal']<6) {
print "<input type=button value=\"���� ������\" onclick=\"javascript:runmagic5('������ ������','givechest','target','target1') \">&nbsp;";
print "<input type=button value=\"������� ���\" onclick=\"javascript:runmagict('������� ���','takeekr','target','target1') \">&nbsp;";
}
echo "</td></tr></table>";

if($user['deal']> 0){
############# �������� � �������� ������ �����  #################
if (isset($_SESSION['bankid'])){
$bank_alhimik = mysql_fetch_array(mysql_query("SELECT * FROM `bank` WHERE `id` = ".$_SESSION['bankid']." LIMIT 1;"));	
}

############## ����������� ����� ################################
echo '<TR><TD style="text-align: left; ">';
echo "<br><h4>��������� ������</h4>";
If (isset($_SESSION['bankid'])){echo "����: <FONT COLOR=#339900>".$bank_alhimik['ekr']."</font> ���.";}
echo "<form method=post action=\"dealer.php\"><b>��������� ���� �� ���� </b>
<table><tr> <td>������� ����� </td>
<td><input type='text' name='ekr' value=''></td>
<td> ����� ����� <input type='text' name='bank' value=''></td>
<td> ��� ��������� <input type='text' name='tonick' value=''></td><td>";
If (isset($_SESSION['bankid'])){ echo"<input type=submit name='putekr' value='���������'>";}else{echo "<font color=red>��������������� � �����!</font>";}
echo "</td></tr></table></form>";
echo "<br><form method=post action=\"dealer.php\"><b>��������� ����� / ����� ����� </b>
<table><tr><td>����� </td><td><input type='text' name='charlogin' value=''></td>
<td> ����� ����� <input type='text' name='charbank' value=''></td>
<td><input type=submit name='checkbank' value='���������'></td></tr>
</table></form>
</TD></TR>";

############## ���������� ��� #####################################
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

mysql_query("INSERT INTO `delo`(`id` , `author` ,`pers`, `text`, `type`, `date`) VALUES ('','0','".mysql_real_escape_string($tonick['id'])."','�������� ".mysql_real_escape_string($_POST['ekr'])." ��� �� ���� �".mysql_real_escape_string($_POST['bank'])." �� ������ ".$user['login']."',1,'".time()."');");
$us = mysql_fetch_array(mysql_query("select `id` from `online` WHERE `date` >= ".(time()-60)." AND `id` = '".$tonick['id']."' LIMIT 1;"));

if($us[0]){
addchp ('<font color=red>��������!</font> �� ��� ���� �'.$_POST['bank'].' ���������� '.$_POST['ekr'].' ���. �� ������ '.$user['login'].'  ','{[]}'.$_POST['tonick'].'{[]}');
}else{
mysql_query("INSERT INTO `telegraph` (`owner`,`date`,`text`) values ('".$tonick['id']."','','".'<font color=red>��������!</font> �� ��� ���� �'.mysql_real_escape_string($_POST['bank']).' ���������� '.mysql_real_escape_string($_POST['ekr']).' ���. �� ������ '.mysql_real_escape_string($user['login']).'  '."');");
}

mysql_query("UPDATE `bank` set `ekr` = ekr-'".mysql_real_escape_string($_POST['ekr'])."' WHERE `id` = '".mysql_real_escape_string($_SESSION['bankid'])."' LIMIT 1;");

print "<b><font color=red>������� ��������� {$_POST['ekr']} ���. �� ���� {$_POST['bank']} ��������� {$_POST['tonick']}!</font></b>";

}else{
print "<b><font color=red>��������� ������!</font></b>";
}
}else{print "<b><font color=red>�� �� ������ ���������� ��������� {$_POST['tonick']} ����!</font></b>";}
}else{print "<b><font color=red>���� ����� {$_POST['bank']} �� ����������� ��������� {$_POST['tonick']}!</font></b>";}
}else{print "<b><font color=red>� ��� ������������ ���. �� �����!</font></b>";}
}else{print "<b><font color=red>������� �����, ����� ����� � ��� ���������!</font></b>";}
}

if ($_POST['checkbank']) {
if ($_POST['charlogin']) {
$tonick = mysql_fetch_array(mysql_query("SELECT login,id FROM `users` WHERE `login` = '".mysql_real_escape_string($_POST['charlogin'])."' LIMIT 1;"));
$bankdb = mysql_query("SELECT owner,id FROM `bank` WHERE `owner` = '".mysql_real_escape_string($tonick['id'])."'");
print "��������� {$_POST['charlogin']} ����������� �����: <br>";
while ($bank=mysql_fetch_array($bankdb)) {
print "� {$bank['id']} <br>";
}
}
else if  ($_POST['charbank']) {
$bank = mysql_fetch_array(mysql_query("SELECT owner,id FROM `bank` WHERE `id` = '".mysql_real_escape_string($_POST['charbank'])." 'LIMIT 1;"));
$tonick = mysql_fetch_array(mysql_query("SELECT login,id FROM `users` WHERE `id` = '".mysql_real_escape_string($bank['owner'])."' LIMIT 1;"));
print "���� � {$_POST['charbank']} ����������� ��������� {$tonick['login']} <br>";
}		
}
}
##### Silver Account #####
echo "<form method=post><fieldset style='border:2px dashed #656565;'><legend style='color: green; font-weight: bold;'>Silver Account</legend>
<table><tr><td>�����</td><td><input type='text' name='login' value='".$_POST['login']."'></td></tr>
<tr><td>���������</td><td><select name='silver'>
<option value='604800'>������</option>		
<option value='2629743'>�����</option>
<option value='0'>�����</option>";					
echo "</select></td></tr>
<tr><td><input type=submit value='���������'></td></tr></table>";
echo "</fieldset></form>";				
if (isset($_POST['login']) && isset($_POST['silver'])) {
$target_user_tel=mysql_fetch_array(mq("SELECT `id`,`vip`,`ekr` FROM `users` WHERE `login` = '".$_POST['login']."';"));
if ($_POST['silver']==604800){
//���� ��� ������� ����
$skolko = '������';
//���� �� ������
$cost = '50';
}elseif ($_POST['silver']==2629743){
//���� ��� ������� ����
$skolko = '�����';
//���� �� �����
$cost = '150';
}elseif ($_POST['silver']==0){
//���� ��� ������� ����
$skolko = '�����';
//���� �� �����
$cost = '600';
}
if ($target_user_tel['ekr']<$cost){
echo"� ��������� ������������ ������������ ��� ������ ��������";
}elseif ($target_user_tel['vip']!=0){
echo"� ��������� ��� �������� VIP Account";
}elseif (!empty($target_user_tel['id'])){
mq("UPDATE `users` SET `vip` = '1', `ekr`=`ekr`-'$cost' WHERE `id` = '".$target_user_tel['id']."' LIMIT 1;");
if($_POST['silver']!=0){
mq("INSERT INTO `effects` (`owner`,`name`,`time`,`type`) values ('".$target_user_tel['id']."','Silver Account',".(time()+$_POST['silver']).",70);");
}
mq("INSERT INTO `delo`(`id` , `author` ,`pers`, `text`, `type`, `date`) VALUES ('','0','".$target_user_tel['id']."','����� Silver Account � ������� ".$user['login']." �� ���� $skolko.',1,'".time()."');");
}else{
echo"<font color=red>�� ��� ������ �������� ".$_POST['login']."!</font><br>";	
}
}
##### Gold Account #####
echo "<form method=post><fieldset style='border:2px dashed #656565;'><legend style='color: green; font-weight: bold;'>Gold Account</legend>
<table><tr><td>�����</td><td><input type='text' name='login' value='".$_POST['login']."'></td></tr>
<tr><td>���������</td><td><select name='Gold'>
<option value='604800'>������</option>		
<option value='2629743'>�����</option>
<option value='0'>�����</option>";					
echo "</select></td></tr>
<tr><td><input type=submit value='���������'></td></tr></table>";
echo "</fieldset></form>";				
if (isset($_POST['login']) && isset($_POST['Gold'])) {
$target_user_tel=mysql_fetch_array(mq("SELECT `id`,`vip`,`ekr` FROM `users` WHERE `login` = '".$_POST['login']."';"));
if ($_POST['Gold']==604800){
//���� ��� ������� ����
$skolko = '������';
//���� �� ������
$cost = '100';
}elseif ($_POST['Gold']==2629743){
//���� ��� ������� ����
$skolko = '�����';
//���� �� �����
$cost = '250';
}elseif ($_POST['Gold']==0){
//���� ��� ������� ����
$skolko = '�����';
//���� �� �����
$cost = '800';
}
if ($target_user_tel['ekr']<$cost){
echo"� ��������� ������������ ������������ ��� ������ ��������";
}elseif ($target_user_tel['vip']!=0){
echo"� ��������� ��� �������� VIP Account";
}elseif (!empty($target_user_tel['id'])){
mq("UPDATE `users` SET `vip` = '2', `ekr`=`ekr`-'$cost' WHERE `id` = '".$target_user_tel['id']."' LIMIT 1;");
if($_POST['Gold']!=0){
mq("INSERT INTO `effects` (`owner`,`name`,`time`,`type`) values ('".$target_user_tel['id']."','Gold Account',".(time()+$_POST['Gold']).",70);");
}
mq("INSERT INTO `delo`(`id` , `author` ,`pers`, `text`, `type`, `date`) VALUES ('','0','".$target_user_tel['id']."','����� Gold Account � ������� ".$user['login']." �� ���� $skolko.',1,'".time()."');");
}else{
echo"<font color=red>�� ��� ������ �������� ".$_POST['login']."!</font><br>";	
}
}
##### Platinum Account #####
echo "<form method=post><fieldset style='border:2px dashed #656565;'><legend style='color: green; font-weight: bold;'>Platinum Account</legend>
<table><tr><td>�����</td><td><input type='text' name='login' value='".$_POST['login']."'></td></tr>
<tr><td>���������</td><td><select name='Platinum'>
<option value='604800'>������</option>		
<option value='2629743'>�����</option>
<option value='0'>�����</option>";					
echo "</select></td></tr>
<tr><td><input type=submit value='���������'></td></tr></table>";
echo "</fieldset></form>";				
if (isset($_POST['login']) && isset($_POST['Platinum'])) {
$target_user_tel=mysql_fetch_array(mq("SELECT `id`,`vip`,`ekr` FROM `users` WHERE `login` = '".$_POST['login']."';"));
if ($_POST['Platinum']==604800){
//���� ��� ������� ����
$skolko = '������';
//���� �� ������
$cost = '150';
}elseif ($_POST['Platinum']==2629743){
//���� ��� ������� ����
$skolko = '�����';
//���� �� �����
$cost = '350';
}elseif ($_POST['Platinum']==0){
//���� ��� ������� ����
$skolko = '�����';
//���� �� �����
$cost = '1000';
}
if ($target_user_tel['ekr']<$cost){
echo"� ��������� ������������ ������������ ��� ������ ��������";
}elseif ($target_user_tel['vip']!=0){
echo"� ��������� ��� �������� VIP Account";
}elseif (!empty($target_user_tel['id'])){
mq("UPDATE `users` SET `vip` = '3', `ekr`=`ekr`-'$cost' WHERE `id` = '".$target_user_tel['id']."' LIMIT 1;");
if($_POST['Platinum']!=0){
mq("INSERT INTO `effects` (`owner`,`name`,`time`,`type`) values ('".$target_user_tel['id']."','Platinum Account',".(time()+$_POST['Platinum']).",70);");
}
mq("INSERT INTO `delo`(`id` , `author` ,`pers`, `text`, `type`, `date`) VALUES ('','0','".$target_user_tel['id']."','����� Platinum Account � ������� ".$user['login']." �� ���� $skolko.',1,'".time()."');");
}else{
echo"<font color=red>�� ��� ������ �������� ".$_POST['login']."!</font><br>";	
}
}
?>
</html>