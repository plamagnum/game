<?php
	session_start();
	if ($_SESSION['uid'] == null) header("Location: index.php");

        include "../connect.php";
        include "functions.php";
        $user=mysql_fetch_array(mysql_query("SELECT * from users where id='".$_SESSION['uid']."'"));
        $rep=mysql_fetch_array(mysql_query("SELECT `hramreput` from users where id='".$_SESSION['uid']."'"));
        
       

        if($user['hramreput']>=1 and $user['hramreput']<100){
        if($_GET['sed']>0 && $_GET['dissolve']==1 && is_numeric($_GET['sed'])){
          $dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `owner` = '{$_SESSION['uid']}' AND `dressed` = 0  AND gift = 0 AND destinyinv = 0 AND (type = 11 OR type = 1 OR type = 2 OR type = 9 OR type = 4 OR type = 8 OR type = 22 OR type = 23 OR type = 24 OR type = 5) AND id='".(int)$_GET['sed']."'"));
            
            if(mt_rand(1,10)>5){
            
            if($dress['id']>0){
                
                $rlevel=array(4);
                if($dress['nlevel']>=1 and $dress['nlevel']<=4){$rnn=0; $rune_level=$rlevel[$rnn];}
                elseif($dress['nlevel']>=1 and $dress['nlevel']<=4){$rnn=mt_rand(0,1); $rune_level=$rlevel[$rnn];}
                else{$rnn=mt_rand(1,2); $rune_level=$rlevel[$rnn];}


                
                
                
                     $rune_align=array("Игнис ","Аква ","Аура ","Тера ");
                     $rune_lvl=array(4=>"Рота");
                    $rune_type=array("","хи","хэ","ви","во","кэ","ки","ми","си","мо","со");
                    $params=array();
                    $params[0][4]=array('mfrub=>1','mfmagp=>1','mfkrit=>5','mfdhit=>10','mfkrit=>5','mfdhit=>10','mfdmag=>10');
                    $params[1][4]=array('mfrej=>1','mfmagp=>1','mfakrit=>5','mfdhit=>10','mfakrit=>5','mfdhit=>10','mfdmag=>10');
                    $params[2][4]=array('mfkol=>1','mfmagp=>1','mfuvorot=>5','mfdhit=>10','mfuvorot=>5','mfdhit=>10','mfdmag=>10');
                    $params[3][4]=array('mfdrob=>1','mfmagp=>1','mfauvorot=>5','mfdhit=>10','mfauvorot=5','mfdhit=>10','mfdmag=>10');

                    


               $rt=mt_rand(1,10);
               $ra=mt_rand(0,3);
                $rune_name=$rune_align[$ra].$rune_lvl[$rune_level].$rune_type[$rt];
                $stroka_par=$params[$ra][$rune_level][mt_rand(0,6)];

                $pp=explode("=>", $stroka_par);
                $stroka1="`{$pp[0]}`";
                $stroka2="'{$pp[1]}'";
                $rimg="rune_{$rnn}_{$ra}_{$rt}.gif";
                if(mysql_query("INSERT INTO `inventory`
				(`owner`,`name`,`type`,
                        `massa`,`cost`,`img`,
                        `maxdur`,`isrep`,`nlevel`,
                        `magic`,{$stroka1}
				)
				VALUES
				('{$_SESSION['uid']}','{$rune_name}','60',
                                '3','','$rimg',
                                '1',0,'{$rune_level}',
                                '245',{$stroka2}
                               );")){
                    destructitem($dress['id']);
                   mysql_query("UPDATE `users` SET `hramreput`=`hramreput`+1 WHERE `id`='{$_SESSION['uid']}' ");
                 
                  echo "<font color=red><b>Предмет удачно растворен. <br>Получена {$rune_name} за {$dress['name']}</b></font>";
                                }
                                //echo mysql_error();
            }
          
        }else{
            destructitem($dress['id']);
                                    echo "<font color=red><b>Предмет растворен неудачно.</b></font>";
        }
        }
        }
       elseif($user['hramreput']>=100 and $user['hramreput']<1000){
        if($_GET['sed']>0 && $_GET['dissolve']==1 && is_numeric($_GET['sed'])){
         $dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `owner` = '{$_SESSION['uid']}' AND `dressed` = 0  AND gift = 0 AND destinyinv = 0 AND (type = 11 OR type = 1 OR type = 2 OR type = 9 OR type = 4 OR type = 8 OR type = 22 OR type = 23 OR type = 24 OR type = 5) AND id='".(int)$_GET['sed']."'"));
            
            if(mt_rand(1,10)>5){
            
            if($dress['id']>0){
                
                $rlevel=array(4,7,9);
                if($dress['nlevel']<5){$rnn=0; $rune_level=$rlevel[$rnn];}
                elseif($dress['nlevel']>=5 and $dress['nlevel']<=8){$rnn=mt_rand(0,1); $rune_level=$rlevel[$rnn];}
                else{$rnn=mt_rand(1,2); $rune_level=$rlevel[$rnn];}


                
                
                
                    $rune_align=array("Игнис ","Аква ","Аура ","Тера ");
                    $rune_lvl=array(7=>"Триа");
                    $rune_type=array("","хи","хэ","ви","во","кэ","ки","ми","си","мо","со");
                    $params=array();
                    $params[0][7]=array('ginta=>1','mfrub=>3','mfmagp=>3','mfkrit=>10','mfkrit=>10','mfdhit=>15','mfdmag=>15');
                    $params[1][7]=array('glovk=>1','mfrej=>3','mfmagp=>3','mfakrit=>10','mfakrit=>10','mfdhit=>15','mfdmag=>15');
                    $params[2][7]=array('gintel=>1','mfkol=>3','mfmagp=>3','mfuvorot=>10','mfdhit=>15','mfdmag=>15','gmana=>10');
                    $params[3][7]=array('gsila=>1','mfdrob=>3','mfmagp=>3','mfauvorot=>10','mfdhit=>15','mfdmag=>15','ghp=>10');

                    


                $rt=mt_rand(1,10);
                $ra=mt_rand(0,3);
                $rune_name=$rune_align[$ra].$rune_lvl[$rune_level].$rune_type[$rt];
                $stroka_par=$params[$ra][$rune_level][mt_rand(0,6)];

                $pp=explode("=>", $stroka_par);
                $stroka1="`{$pp[0]}`";
                $stroka2="'{$pp[1]}'";
                $rimg="rune_{$rnn}_{$ra}_{$rt}.gif";
              
                if(mysql_query("INSERT INTO `inventory`
				(`owner`,`name`,`type`,
                        `massa`,`cost`,`img`,
                        `maxdur`,`isrep`,`nlevel`,
                        `magic`,{$stroka1}
				)
				VALUES
				('{$_SESSION['uid']}','{$rune_name}','60',
                                '3','','$rimg',
                                '1',0,'{$rune_level}',
                                '245',{$stroka2}
                               );")){
                    destructitem($dress['id']);
                   mysql_query("UPDATE `users` SET `hramreput`=`hramreput`+1 WHERE `id`='{$_SESSION['uid']}' ");
                 
                  echo "<font color=red><b>Предмет удачно растворен. <br>Получена {$rune_name} за {$dress['name']}</b></font>";
                                }
                                //echo mysql_error();
            }
           // echo "gg";
        }else{
            destructitem($dress['id']);
                                    echo "<font color=red><b>Предмет растворен неудачно.</b></font>";
        }
        }
        }	

elseif($user['hramreput']>=1000){
        if($_GET['sed']>0 && $_GET['dissolve']==1 && is_numeric($_GET['sed'])){
           $dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `owner` = '{$_SESSION['uid']}' AND `dressed` = 0  AND gift = 0 AND destinyinv = 0 AND type = 60 AND id='".(int)$_GET['sed']."'"));

            
            if(mt_rand(1,10)>5){
            
            if($dress['id']>0){
                
                $rlevel=array(4,7,9);
                if($dress['nlevel']<5){$rnn=0; $rune_level=$rlevel[$rnn];}
                elseif($dress['nlevel']>=5 and $dress['nlevel']<=8){$rnn=mt_rand(0,1); $rune_level=$rlevel[$rnn];}
                else{$rnn=mt_rand(1,2); $rune_level=$rlevel[$rnn];}


                if(mt_rand(1,10000)==7777){$rune_level=99;}
                
                
                    $rune_align=array("Сагито ","Драко ","Гладо ","Сауни ");
                    $rune_lvl=array(9=>"Нона",10=>"Дека",11=>"Окта",99=>"Ундека",);
                    $rune_type=array("","хи","хэ","ви","во","кэ","ки","ми","си","мо","со");
                    
                    $params=array();
                    $params[0][9]=array('ginta=>200','mfrub=>500','mfmagp=>500','mfkrit=>1500','mfkrit=>1500','mfdhit=>2500','mfdmag=>2500');
                    $params[1][9]=array('glovk=>200','mfrej=>500','mfmagp=>500','mfakrit=>1500','mfakrit=>1500','mfdhit=>2500','mfdmag=>2500');
                    $params[2][9]=array('gintel=>200','mfkol=>500','mfmagp=>500','mfuvorot=>1500','mfdhit=>1500','mfdmag=>2500','gmana=>2000');
                    $params[3][9]=array('gsila=>200','mfdrob=>500','mfmagp=>500','mfauvorot=>1500','mfdhit=>1500','mfdmag=>2500','ghp=>2000');
                  $params[0][10]=array('ginta=>400','mfrub=>1000','mfmagp=>1000','mfkrit=>3000','mfkrit=>3000','mfdhit=>7500','mfdmag=>7500');
                    $params[1][10]=array('glovk=>400','mfrej=>1000','mfmagp=>1000','mfakrit=>3000','mfakrit=>3000','mfdhit=>7500','mfdmag=>7500');
                    $params[2][10]=array('gintel=>400','mfkol=>1000','mfmagp=>1000','mfuvorot=>3000','mfdhit=>7500','mfdmag=>7500','gmana=>10000');
                    $params[3][10]=array('gsila=>400','mfdrob=>1000','mfmagp=>1000','mfauvorot=>3000','mfdhit=>7500','mfdmag=>7500','ghp=>10000');
                   $params[0][11]=array('ginta=>400','mfrub=>1000','mfmagp=>1000','mfkrit=>3000','mfkrit=>3000','mfdhit=>7500','mfdmag=>7500');
                    $params[1][11]=array('glovk=>400','mfrej=>1000','mfmagp=>1000','mfakrit=>3000','mfakrit=>3000','mfdhit=>7500','mfdmag=>7500');
                    $params[2][11]=array('gintel=>400','mfkol=>1000','mfmagp=>1000','mfuvorot=>3000','mfdhit=>7500','mfdmag=>7500','gmana=>10000');
                    $params[3][11]=array('gsila=>400','mfdrob=>1000','mfmagp=>1000','mfauvorot=>3000','mfdhit=>7500','mfdmag=>7500','ghp=>10000');


                    $params[0][99]=array('ginta=>400','mfrub=>1000','mfmagp=>1000','mfkrit=>3000','mfkrit=>3000','mfdhit=>7500','mfdmag=>7500');
                    $params[1][99]=array('glovk=>400','mfrej=>1000','mfmagp=>1000','mfakrit=>3000','mfakrit=>3000','mfdhit=>7500','mfdmag=>7500');
                    $params[2][99]=array('gintel=>400','mfkol=>1000','mfmagp=>1000','mfuvorot=>3000','mfdhit=>7500','mfdmag=>7500','gmana=>10000');
                    $params[3][99]=array('gsila=>400','mfdrob=>1000','mfmagp=>1000','mfauvorot=>3000','mfdhit=>7500','mfdmag=>7500','ghp=>10000');
                    


                $rt=mt_rand(1,10);
                $ra=mt_rand(0,3);
                $rune_name=$rune_align[$ra].$rune_lvl[$rune_level].$rune_type[$rt];
                $stroka_par=$params[$ra][$rune_level][mt_rand(0,6)];

                $pp=explode("=>", $stroka_par);
                $stroka1="`{$pp[0]}`";
                $stroka2="'{$pp[1]}'";
                $rimg="rune_{$rnn}_{$ra}_{$rt}.gif";
              
                if(mysql_query("INSERT INTO `inventory`
				(`owner`,`name`,`type`,
                        `massa`,`cost`,`img`,
                        `maxdur`,`isrep`,`nlevel`,
                        `magic`,{$stroka1}
				)
				VALUES
				('{$_SESSION['uid']}','{$rune_name}','60',
                                '3','','$rimg',
                                '1',0,'{$rune_level}',
                                '245',{$stroka2}
                               );")){
                    destructitem($dress['id']);
                   mysql_query("UPDATE `users` SET `hramreput`=`hramreput`+1 WHERE `id`='{$_SESSION['uid']}' ");
                 
                  echo "<font color=red><b>Предмет удачно растворен. <br>Получена {$rune_name} за {$dress['name']}</b></font>";
                                }
                                //echo mysql_error();
            }
           
        }else{
            destructitem($dress['id']);
                                    echo "<font color=red><b>Предмет растворен неудачно.</b></font>";
        }
        }
        }	

?>
	<HTML><HEAD>
<script LANGUAGE='JavaScript'>
document.ondragstart = test;
//запрет на перетаскивание
document.onselectstart = test;
//запрет на выделение элементов страницы
document.oncontextmenu = test;
//запрет на выведение контекстного меню
function test() {
 return false
}
</SCRIPT>
<link rel=stylesheet type="text/css" href="i/main.css">
<meta content="text/html; charset=windows-1251" http-equiv=Content-type>
<META Http-Equiv=Cache-Control Content=no-cache>
<meta http-equiv=PRAGMA content=NO-CACHE>
<META Http-Equiv=Expires Content=0>
<script src="js/lib/jquery.js" type="text/javascript"></script>
</HEAD>




<TABLE width=100%>
<TD valign=top width=100%>
<center><font style="font-size:24px; color:#000033"><h3>Алтарь Предметов</h3></font></center>

<div align=left>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo nick3($_SESSION['uid'])?></div>
<br>
<b>Репутация: <?=$user['hramreput']?></b>
<TD nowrap valign=top>
<DIV align=right><link href="i/move/design6.css" rel="stylesheet" type="text/css"><script language="javascript" type="text/javascript">
function fastshow2 (content, eEvent ) {
var el = document.getElementById("mmoves");
eEvent = eEvent || window.event;
if( !eEvent )
return;
var o = eEvent.target || eEvent.srcElement;
if (content!='' && el.style.visibility != "visible") {el.innerHTML = '<small>'+content+'</small>';}
var x = window.event.clientX + document.documentElement.scrollLeft + document.body.scrollLeft - el.offsetWidth + 5;
var y = window.event.clientY + document.documentElement.scrollTop + document.body.scrollTop+20;
if (x + el.offsetWidth + 3 > document.body.clientWidth + document.body.scrollLeft) { x=(document.body.clientWidth + document.body.scrollLeft - el.offsetWidth - 5); if (x < 0) {x=0}; }
if (y + el.offsetHeight + 3 > document.body.clientHeight  + document.body.scrollTop) { y=(document.body.clientHeight + document.body.scrollTop - el.offsetHeight - 3); if (y < 0) {y=0}; }
if (x<0) {x=0;}
if (y<0) {y=0;}
el.style.left = x + "px";
el.style.top  = y + "px";
if (el.style.visibility != "visible") {
el.style.visibility = "visible";
}
}
function hideshow () {
document.getElementById("mmoves").style.visibility = 'hidden';
}
</script>
<table  border="0" cellpadding="0" cellspacing="0">
<tr align="right" valign="top">
<td>


</td>
<td>

<TABLE height=15 border="0" cellspacing="0" cellpadding="0">
<TR>
<TD rowspan=3 valign="bottom"><a href="?rnd=0.313154328583547"><img src="i/move/rel_1.gif" width="15" height="16" alt="Обновить" border="0" /></a></TD>
<TD colspan="3"><img src="i/move/navigatin_462.gif" width="80" height="4" /></TD>
</TR>
<TR>
<TD><IMG src="i/move/navigatin_481.gif" width="9" height="8"></TD>
<TD width=64 bgcolor=black><DIV class="MoveLine"><IMG src="i/move/wait2.gif" id="MoveLine" class="MoveLine"></DIV></TD>
<TD><IMG src="i/move/navigatin_50.gif" width="7" height="8"></TD>
</TR>
<TR>
<TD colspan="3"><IMG src="i/move/navigatin_tt1_532.gif" width="80" height="5"></TD>
</TR>
</TABLE>


<table  border="0" cellspacing="0" cellpadding="0">
<tr>
<td nowrap="nowrap" id="moveto">
<table width="100%"  border="0" cellpadding="0" cellspacing="1" >

<tr>
<td ><img src="i/move/links.gif" width="9" height="7" /></td>
<td  nowrap><a href="city.php?strah=1" onClick="return check_access();" class="menutop" title="Время перехода: 10 сек.  ">Храм знаний</a></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
<div id="mmoves" style="background-color:#FFFFCC; visibility:hidden; overflow:visible; position:absolute; border-color:#666666; border-style:solid; border-width: 1px; padding: 2px; white-space: nowrap;"></div>
<script language="javascript" type="text/javascript">
var progressEnd = 64;		// set to number of progress <span>'s.
var progressColor = '#00CC00';	// set to progress bar color
var mtime = parseInt('14');
if (!mtime || mtime<=0) {mtime=0;}
var progressInterval = Math.round(mtime*1000/progressEnd);	// set to time between updates (milli-seconds)
var is_accessible = true;
var progressAt = progressEnd;
var progressTimer;
function progress_clear() {
progressAt = 1;
is_accessible = false;
set_moveto(true);
}
function progress_update() {
progressAt++;
//if (progressAt > progressEnd) progress_clear();
if (progressAt > progressEnd) {
is_accessible = true;
if (window.solo_store && solo_store) { solo(solo_store, ""); } // go to stored
set_moveto(false);
} else {
if( !( progressAt % 2 ) )
document.getElementById('MoveLine').style.left = progressAt - 64;
progressTimer = setTimeout('progress_update()',progressInterval);
}
}
function set_moveto (val) {
document.getElementById('moveto').disabled = val;
if (document.getElementById('bmoveto')) {
document.getElementById('bmoveto').disabled = val;
}
}
function progress_stop() {
clearTimeout(progressTimer);
progress_clear();
}
function check(it) {
return is_accessible;
}
function check_access () {
return is_accessible;
}
function ch_counter_color (color) {
/*	progressColor = color;
for (var i = 1; i <= progressAt; i++) {
document.getElementById('progress'+i).style.backgroundColor = progressColor;
}*/
}
if (mtime>0) {
progress_clear();
progress_update();
}

</script>
</TD></TR>


    <td>    
        <div><font color="red"><b><?=$err?></b></font></div>
    </td>
</tr>
<tr><TD valign=top>
<div align=right><TABLE BORDER=0 WIDTH=75% CELLSPACING="1" CELLPADDING="1" BGCOLOR="transparent"></div>
<div style="background-color: transparent; font-weight: bold; padding: 0;  text-align: center; width: 100%; ">Растворение предметов</div>
<div style="background-color: transparent; cursor: pointer; padding: 0; text-align: right; vertical-align: middle; white-space: nowrap; "><IMG src="http://img.c.ru/i/misc/rune/L.gif" id="order1" onclick="ChangeOrder(1); " title="Первый параметр сортировки">&nbsp;<IMG src="http://img.c.ru/i/misc/rune/s.gif" onclick="ChangeOrder(2); " title="Поменять местами параметры сортировки">&nbsp;<IMG src="http://img.c.ru/i/misc/rune/Q.gif" id="order2" onclick="ChangeOrder(3); " title="Второй параметр сортировки">&nbsp;<IMG src="http://img.c.ru/i/misc/rune/r.gif" id="reverse" onclick="ChangeOrder(4); " title="Обратный порядок сортировки">&nbsp;<IMG src="http://img.c.ru/i/misc/rune/e.gif"  onclick="ChangeOrder(5); " title="Применить">&nbsp;<SELECT id="filter" name="filter" value="0" title="Фильтр по уровню"><OPTION value="0" selected>Все</OPTION><SCRIPT>for(var i = 1; i <= 12; i++) { document.write('<OPTION value="' + i + '">' + i + '</OPTION>'); }</SCRIPT></SELECT></div>
<?if($user['hramreput']>=1 and $user['hramreput']<100){?>
<?
$ci=0;
$data = mysql_query("SELECT * FROM `inventory` WHERE `owner` = '{$_SESSION['uid']}' AND `dressed` = 0 AND `artefact`<> 1  AND `nlevel`>=1 and `nlevel`<=4  and type<>25 and type<>0   and type<>30 and `destinyinv`<>1 and type<>188 and type<50 ORDER by `update` DESC; ");
	while($row = mysql_fetch_array($data)) {
            $ci++;
		$row['count'] = 1;
		if ($i==0) { $i = 1; $color = 'transparent';} else { $i = 0; $color = 'transparent'; }
		echo "<TR bgcolor={$color}><TD align=center style='width:150px'><IMG SRC=\"http://img.yourc.com/i/sh/{$row['img']}\" BORDER=0>";

		
		?>
		<BR><A HREF="iqtower.php?sed=<?=$row['id']?>&sid=&dissolve=1">растворить</A>

		</TD>
		<?php
		echo "<TD valign=top>";
		showitem ($row);
		echo "</TD></TR>";
	}
        if($ci==0){
            echo "<TD bgcolor=transparent align=center>";
		echo "Нет подходящих предметов.";
		echo "</TD></TR>";
        }
        //echo mysql_error();
       ?>
<?}?>
<?if($user['hramreput']>=100 and $user['hramreput']<1000){?>
<?
$ci=0;
$data = mysql_query("SELECT * FROM `inventory` WHERE `owner` = '{$_SESSION['uid']}' AND `dressed` = 0 AND `artefact`<> 1  AND `nlevel`>=5 and `nlevel`<=8  and type<>25 and type<>0   and type<>30 and `destinyinv`<>1 and type<>188 and type<50 ORDER by `update` DESC; ");
	while($row = mysql_fetch_array($data)) {
            $ci++;
		$row['count'] = 1;
		if ($i==0) { $i = 1; $color = 'transparent';} else { $i = 0; $color = 'transparent'; }
		echo "<TR bgcolor={$color}><TD align=center style='width:150px'><IMG SRC=\"http://img.yourc.com/i/sh/{$row['img']}\" BORDER=0>";

		
		?>
		<BR><A HREF="iqtower.php?sed=<?=$row['id']?>&sid=&dissolve=1">растворить</A>

		</TD>
		<?php
		echo "<TD valign=top>";
		showitem ($row);
		echo "</TD></TR>";
	}
        if($ci==0){
            echo "<TD bgcolor=transparent align=center>";
		echo "Нет подходящих предметов.";
		echo "</TD></TR>";
        }
        //echo mysql_error();
       ?>
<?}?>
<?if($user['hramreput']>=1000){?>
<?
$ci=0;
$data = mysql_query("SELECT * FROM `inventory` WHERE `owner` = '{$_SESSION['uid']}' AND `dressed` = 0 AND `artefact`<> 1  AND `nlevel`>=9  and type<>25 and type<>0   and type<>30 and `destinyinv`<>1 and type<>188 and type<50 ORDER by `update` DESC; ");
	while($row = mysql_fetch_array($data)) {
            $ci++;
		$row['count'] = 1;
		if ($i==0) { $i = 1; $color = 'transparent';} else { $i = 0; $color = 'transparent'; }
		echo "<TR bgcolor={$color}><TD align=center style='width:150px'><IMG SRC=\"http://img.yourc.com/i/sh/{$row['img']}\" BORDER=0>";

		
		?>
		<BR><A HREF="iqtower.php?sed=<?=$row['id']?>&sid=&dissolve=1">растворить</A>

		</TD>
		<?php
		echo "<TD valign=top>";
		showitem ($row);
		echo "</TD></TR>";
	}
        if($ci==0){
            echo "<TD bgcolor=transparent align=center>";
		echo "Нет подходящих предметов.";
		echo "</TD></TR>";
        }
        //echo mysql_error();
       ?>
<?}?>
</td></tr>
</TABLE>
<br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>



<div align=left><SMALL><font color=red>Внимание!</font><BR>Предметы при растворении и руны при слиянии <br>необратимо теряются.</SMALL></div>
</div>
</TABLE>
</BODY>
</HTML>