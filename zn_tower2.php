<?php

session_start();
if ($_SESSION['uid'] == null) header("Location: index.php");
include "connect.php";
include "functions.php";
$znTowerLevel = mysql_result(mysql_query("SELECT reputation FROM zn_tower WHERE user_id = " . $_SESSION['uid']), 0, 0);
$user=mysql_fetch_array(mysql_query("SELECT * from users where id='".$_SESSION['uid']."'"));
if($user['room'] != '9002'){
    header('location: city.php');
}

if ($_GET['sed']>0 && $_GET['dissolve']==1 && is_numeric($_GET['sed'])) {
    if ($znTowerLevel < 100) {
        $levelCond = "AND `nlevel`<='5' ";
    } elseif ($znTowerLevel < 1000) {
        $levelCond = "AND `nlevel`<='7' ";
    } elseif ($znTowerLevel < 10000) {
        $levelCond = "AND `nlevel`<='9' ";
    }
    $dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `owner` = '{$_SESSION['uid']}' AND `type` = 60 AND id='".(int)$_GET['sed']."'"));
    if (mt_rand(1,10)<=3) {
        if ($dress['id']>0) {
            $rlevel=array(4,7,9);
            if ($dress['nlevel']<7) {
                $rnn=0; $rune_level=$rlevel[$rnn];
            } elseif($dress['nlevel']<9) { 
                $rnn=mt_rand(0,1); $rune_level=$rlevel[$rnn];
            } else { 
                $rnn=mt_rand(1,2); $rune_level=$rlevel[$rnn];
            }
            if(mt_rand(1,30)==30) {
                $rune_level=99;
            }
            $rune_align=array("Игнис ","Аква ","Аура ","Тера ");
            $rune_lvl=array(4=>"Рота", 7=>"Триа", 9=>"Квад", 99=>"Уни");
            $rune_type=array("","хи","хэ","ви","во","кэ","ки","ми","си","мо","со");
            $rune_for =array("","Серьги","Ожерелье","Кольцо","Перчатки","Поножи","Обувь","Шлем","Наручи","Броня","Пояс");
            $params=array();
            $params[0][4]=array('mfrub=>1','mfmagp=>1','mfkrit=>25','mfdhit=>2','mfkrit=>25','mfdhit=>2','mfdmag=>2');
            $params[1][4]=array('mfrej=>1','mfmagp=>1','mfakrit=>25','mfdhit=>2','mfakrit=>25','mfdhit=>2','mfdmag=>2');
            $params[2][4]=array('mfkol=>1','mfmagp=>1','mfuvorot=>25','mfdhit=>2','mfuvorot=>25','mfdhit=>2','mfdmag=>2');
            $params[3][4]=array('mfdrob=>1','mfmagp=>1','mfauvorot=>25','mfdhit=>2','mfauvorot=25','mfdhit=>2','mfdmag=>2');
            $params[0][7]=array('ginta=>1','mfrub=>3','mfmagp=>3','mfkrit=>50','mfkrit=>50','mfdhit=>10','mfdmag=>10');
            $params[1][7]=array('glovk=>1','mfrej=>3','mfmagp=>3','mfakrit=>50','mfakrit=>50','mfdhit=>10','mfdmag=>10');
            $params[2][7]=array('gintel=>1','mfkol=>3','mfuvorot=>50','mfuvorot=>50','mfdhit=>10','mfdmag=>10','gmana=>150');
            $params[3][7]=array('gsila=>1','mfdrob=>3','mfauvorot=>50','mfauvorot=>50','mfdhit=>10','mfdmag=>10','ghp=>100');
            $params[0][9]=array('ginta=>2','mfrub=>5','mfmagp=>5','mfkrit=>75','mfkrit=>75','mfdhit=>15','mfdmag=>15');
            $params[1][9]=array('glovk=>2','mfrej=>5','mfmagp=>5','mfakrit=>75','mfakrit=>75','mfdhit=>15','mfdmag=>15');
            $params[2][9]=array('gintel=>2','mfkol=>5','mfuvorot=>75','mfuvorot=>75','mfdhit=>15','mfdmag=>15','gmana=>300');
            $params[3][9]=array('gsila=>2','mfdrob=>5','mfauvorot=>75','mfauvorot=>75','mfdhit=>15','mfdmag=>15','ghp=>200');
            $params[0][99]=array('ginta=>5','mfrub=>10','mfmagp=>10','mfkrit=>150','mfkrit=>150','mfdhit=>20','mfdmag=>20');
            $params[1][99]=array('glovk=>5','mfrej=>10','mfmagp=>10','mfakrit=>150','mfakrit=>150','mfdhit=>20','mfdmag=>20');
            $params[2][99]=array('gintel=>5','mfkol=>10','mfuvorot=>150','mfuvorot=>150','mfdhit=>20','mfdmag=>20','gmana=>500');
            $params[3][99]=array('gsila=>5','mfdrob=>10','mfauvorot=>150','mfauvorot=>150','mfdhit=>20','mfdmag=>20','ghp=>400');
            $rt=mt_rand(1,10);
            $ra=mt_rand(0,3);
            $rune_name=$rune_align[$ra].$rune_lvl[$rune_level].$rune_type[$rt];
            $stroka_par=$params[$ra][$rune_level][mt_rand(0,6)];
            $pp=explode("=>", $stroka_par);
            $stroka1="`{$pp[0]}`";
            $stroka2="'{$pp[1]}'";
            $rimg="rune_{$rnn}_{$ra}_{$rt}.gif";
            if($rune_level==99){$rimg="rune_super_1.gif";$rune_name=$rune_align[$ra].$rune_lvl[$rune_level].$rune_type[$rt];$rune_level=9;}
            if (mysql_query("
                INSERT INTO `inventory` 
                (
                    `owner`,
                    `name`,
                    `type`,
                    `massa`,
                    `cost`,
                    `img`,
                    `maxdur`,
                    `isrep`,
                    `nlevel`,
                    `magic`,
                    `opisan`,
                    {$stroka1}
                )
                VALUES
                (
                    '{$_SESSION['uid']}',
                    '{$rune_name}',
                    '60',
                    '1',
                    '',
                    '$rimg',
                    '1',
                    0,
                    '{$rune_level}',
                    '245',
                    'Этой руной можно улучшить предмет (".$rune_for[$rt].")',
                    {$stroka2}
                );
            ")) {
                destructitem($dress['id']);
                mysql_query("UPDATE zn_tower SET reputation = reputation + 1 WHERE user_id = " . $_SESSION['uid']);
                echo "<font color=red><b>Предмет удачно растворен. <br>Получена {$rune_name} за {$dress['name']}</b></font>";
            }
        }
    } else {
        destructitem($dress['id']);
        echo "<font color=red><b>Предмет растворен неудачно.</b></font>";
    }
}

?>
	
<HTML>
    
<HEAD>
    <?php if ($user['align'] != 2.5) { ?>
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
    <?php } ?>
    <link rel=stylesheet type="text/css" href="i/css/main.css">
    <meta content="text/html; charset=windows-1251" http-equiv=Content-type>
    <META Http-Equiv=Cache-Control Content=no-cache>
    <meta http-equiv=PRAGMA content=NO-CACHE>
    <META Http-Equiv=Expires Content=0>
    <script src="i/js/lib/jquery.js" type="text/javascript"></script>
</HEAD>

<body bgcolor=transparent style="background-image: url(i/zntower/iqtower_in.png);background-repeat:no-repeat;background-position:top right">

    <div id=hint4 class=ahint></div>
    <TABLE width=100%>
        <TR>
            <TD valign=top width=100%>
                <center>
                    <font style="font-size:24px; color:#000033">
                        <h3>Алтарь Рун.</h3>
                    </font>
                </center>
            </TD>
            <TD nowrap valign=top>
                <BR>
                <DIV align=right>
                    <INPUT style="font-size:12px;" type='button' onClick="location='zn_tower.php'" value=Обновить>
                    <INPUT style="font-size:12px;" type='button' onClick="location='city.php?got=1&level9000'" value=Вернуться>
                </DIV>
            </TD>
        </TR>
        <?php
            $last_visit = mysql_result(mysql_query("SELECT last_visit FROM zn_tower WHERE user_id = " . $_SESSION['uid']), 0, 0);
            $tflv = time() - $last_visit;
            if ($tflv < 1*2) {
        ?>
        <tr>
            <td>    
                <div>
                    <font color="red">
                        <b>Вы можете посетить Алтарь предметов через <?php echo secs2hrs(1*2 - $tflv) ?></b>
                    </font>
                </div>
            </td>
        </tr>
        <?php  } else { ?>
        <tr>
            <td>    
                <div>
                    <font color="red">
                        <b><?=$err?></b>
                    </font>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <TABLE BORDER=0 WIDTH=75% CELLSPACING="1" CELLPADDING="2" BGCOLOR="transparent">
                    <?php
                        $ci=0;
                        $data = mysql_query("SELECT * FROM `inventory` WHERE `owner` = '{$_SESSION['uid']}' AND `type` = 60 ORDER by `update` DESC; ");
                        while ($row = mysql_fetch_array($data)) {
                            $ci++;
                            $row['count'] = 1;
                            if ($i==0) { 
                                $i = 1; $color = 'transparent';
                            } else { 
                                $i = 0; $color = 'transparent'; 
                            }
                    ?>
                    <TR bgcolor=<?php echo $color ?>>
                        <TD align=center style='width:150px'>
                            <IMG SRC="/i/sh/<?php echo $row['img'] ?>" BORDER=0>
                            <BR>
                            <A HREF="zn_tower2.php?sed=<?=$row['id']?>&sid=&dissolve=1">растворить</A>
                        </TD>
                        <TD valign=top><?php showitem ($row); ?></TD>
                    </TR>
                    <?php 
                        }
                        if($ci==0){
                            echo "<TR bgcolor=\"transparent\"><TD valign=top>";
                                echo "У вас нет подходящих предметов для расплавления.";
                            echo "</TD></TR>";
                        }
                    ?>
                </TABLE>
            </td>
        </tr>
        <?php } ?>
    </TABLE>
    
</BODY>

</HTML>