<?php
//ob_start("ob_gzhandler");
testgoden();
if (@$_GET['usehrefmagic']) {
		usemagic($_GET['usehrefmagic'],$_POST['target']);
	}

if($user && ($user['room']<=101 &&$user['room']>=105) && $user['room']!=777){
	$efff=mysql_query("SELECT * FROM `obshaga_effects` where `owner`='".$_SESSION['uid']."'");
	while($effects=mysql_fetch_array($efff)){
		$ttime=$effects['time']+time();
		mysql_query("update `effects` set `time`='".$ttime."' where `id`='".$effects['id_e']."' and `owner`='".$effects['owner']."'");
		mysql_query("delete from `obshaga_effects` where `id_e`='".$effects['id_e']."' and `owner`='".$effects['owner']."'");
	}

	mysql_query("UPDATE `obchaga` SET son=0 WHERE owner='".$user['id']."'");
}

/* @var $data <type> */
$data2 = mysql_query("SELECT `id`, `fullhptime`, `hp`, `maxhp` FROM `users` WHERE `hp` < `maxhp` AND `battle` = 0;");
	while($user0 = mysql_fetch_array($data2)) {
	//if($user[3]<=60){$user[1]}
	if(((((time()-$user0[1])/60)*($user0[3]/60))<1) && ($user0[3]<=60)){$add=1;}else{$add=(((time()-$user0[1])/60)*($user0[3]/60));}
		if($user0[3]<150){$add=floor(((time()-$user0[1])/10)*($user0[3]/30)); $ooo=floor((time()-$user0[1])/10);}else{
		$ooo=floor((time()-$user0[1])/60);
		}
               
		if ($ooo>0)
                //if ($user[3]-$user[2] > 0)
		{
			mysql_query("UPDATE `users` SET `hp` = `hp`+{$add}, `fullhptime` = ".time()." WHERE  `hp` < `maxhp` AND `id` = '".$user0[0]."' LIMIT 1;");
		}
	}
	$data2 = mysql_query("SELECT `id`, `fullmptime`, `mana`, `maxmana` FROM `users` WHERE `mana` < `maxmana` AND `battle` = 0;");
	while($user0 = mysql_fetch_array($data2)) {
	//if($user[3]<=60){$user[1]}
	if(((((time()-$user0[1])/60)*($user0[3]/60))<1) && ($user0[3]<=60)){$add=1;}else{$add=(((time()-$user0[1])/60)*($user0[3]/60));}
		if ((time()-$user0[1])/60 > 0)
        	//if ($user[3]-$user[2] > 0)
		{
			mysql_query("UPDATE `users` SET `mana` = `mana`+{$add}, `fullmptime` = ".time()." WHERE  `mp` < `maxmana` AND `id` = '".$user0[0]."' LIMIT 1;");
		}
	}
        
	mysql_query("UPDATE `users` SET `hp` = `maxhp`, `fullhptime` = ".time()." WHERE  `hp` > `maxhp` AND `battle` = 0;");
	mysql_query("UPDATE `users` SET `mana` = `maxmana`, `fullmptime` = ".time()." WHERE  (`mana` > `maxmana` OR `fullmptime` = 0) AND `battle` = 0;");
   
if(!function_exists("format_string")) {
function format_string(&$string)
   {
 $string=str_replace("\\r\n","<BR>",$string);
 $string = addslashes(preg_replace(array('/\s+/','/,+/','/\-+/','/\0/s','/%00/'), array(' ',',','-',' ',' '),trim(stripcslashes($string))));
 $string=str_replace("<BR>","\\r\n",$string);
   return $string;
   }}
array_walk($_REQUEST,"format_string");
array_walk($_POST,"format_string");
array_walk($_GET,"format_string");
	if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
						{
						$ip=$_SERVER['HTTP_CLIENT_IP'];
						}
					elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
						{
						$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
						}
					else
						{
						$ip=$_SERVER['REMOTE_ADDR'];
						}
	if($ip == '92.38.225.160' OR ($user['block'] == 1)) {
		die("Персонаж заблокирован!");
	}
	function stripslashes_deep ($text) {
			while(strstr($text, "\\")){
			$text=stripslashes($text);
			}
			return $text;
		}
function addchp ($text,$who,$room=0) {
			global $user;
			if ($room==0) {
				$room = $user['room'];
			}
			$fp = fopen ("tmpdisk/chat.txt","a"); //открытие
			flock ($fp,LOCK_EX); //БЛОКИРОВКА ФАЙЛА
			fputs($fp ,":[".time()."]:[{$who}]:[".($text)."]:[".$room."]\r\n"); //работа с файлом
			fflush ($fp); //ОЧИЩЕНИЕ ФАЙЛОВОГО БУФЕРА И ЗАПИСЬ В ФАЙЛ
			flock ($fp,LOCK_UN); //СНЯТИЕ БЛОКИРОВКИ
			fclose ($fp); //закрытие
}

function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}

function time_left($time){
$time=$time-time();
$days=floor($time/86400);
$chas=floor(($time-($days*86400))/3600);
$mins=floor(($time-(($chas*3600)+($days*86400)))/60);
$sec=floor(($time-(($mins*60)+($chas*3600)+($days*86400)))%60);
return (($chas<10)?"0".$chas:$chas).":".(($mins<10)?"0".$mins:$mins).":".(($sec<10)?"0".$sec:$sec);
}


function close_dangling_tags($html){
  #put all opened tags into an array
  preg_match_all("#<([a-z]+)( .*)?(?!/)>#iU",$html,$result);
  $openedtags=$result[1];

  #put all closed tags into an array
  preg_match_all("#</([a-z]+)>#iU",$html,$result);
  $closedtags=$result[1];
  $len_opened = count($openedtags);
  # all tags are closed
  if(count($closedtags) == $len_opened){
    return $html;
  }

  $openedtags = array_reverse($openedtags);
  # close tags
  for($i=0;$i < $len_opened;$i++) {
    if (!in_array($openedtags[$i],$closedtags)){
      $html .= '</'.$openedtags[$i].'>';
    } else {
      unset($closedtags[array_search($openedtags[$i],$closedtags)]);
    }
  }
  return $html;
}
	if ((int)$user['id']!=111)
	mysql_query("UPDATE `online` SET `real_time` = ".time()." WHERE `id` = {$user['id']};");

	define('_BOTSEPARATOR_',10000000);

	$exptable = array(
						/*   stat,umen,vinos,hp,kred, level, up,peredachi,osobennosti*/
						"0" => array (0,0,0,0,0,20,0,0),
						"20" => array (1,0,0,0,0,45,0,0),
						"45" => array (1,0,0,1,0,75,0,0),
						"75" => array (1,0,0,2,0,110,0,0),
						"110" => array (3,1,1,4,1,160,0,1),
						"160" => array (1,0,0,0,0,215,0,0),
						"215" => array (1,0,0,1,0,280,0,0),
						"280" => array (1,0,0,2,0,350,0,0),
						"350" => array (1,0,0,4,0,410,0,0),
						"410" => array (3,1,1,8,1,530,0,1),
						"530" => array (1,0,0,0,0,670,0,0),
						"670" => array (1,0,0,2,0,830,0,0),
						"830" => array (1,0,0,4,0,950,0,0),
						"950" => array (1,0,0,8,0,1100,0,0),
						"1100" => array (1,0,0,12,0,1300,0,0),
						"1300" => array (3,1,1,16,1,1450,0,1),
						"1450" => array (1,0,0,1,0,1650,0,0),
						"1650" => array (1,0,0,5,0,1850,0,0),
						"1850" => array (1,0,0,10,0,2050,0,0),
						"2050" => array (1,0,0,15,0,2200,0,0),
						"2200" => array (1,0,0,20,0,2500,0,0),
						"2500" => array (5,1,1,25,1,2900,200,1),
						"2900" => array (1,0,0,3,0,3350,0,0),
						"3350" => array (1,0,0,10,0,3800,0,0),
						"3800" => array (1,0,0,15,0,4200,0,0),
						"4200" => array (1,0,0,20,0,4600,0,0),
						"4600" => array (1,0,0,25,0,5000,0,0),
						"5000" => array (3,1,1,40,1,6000,200,1),
						"6000" => array (1,0,0,6,0,7000,0,0),
						"7000" => array (1,0,0,20,0,8000,0,0),
						"8000" => array (1,0,0,30,0,9000,0,0),
						"9000" => array (1,0,0,40,0,10000,0,0),
						"10000" => array (1,0,0,40,0,11000,0,0),
						"11000" => array (1,0,0,40,0,12000,0,0),
						"12000" => array (1,0,0,50,0,12500,0,0),
						"12500" => array (3,1,1,80,1,14000,200,1),
						"14000" => array (1,0,0,9,0,15500,0,0),
						"15500" => array (1,0,0,25,0,17000,0,0),
						"17000" => array (1,0,0,45,0,19000,0,0),
						"19000" => array (1,0,0,45,0,21000,0,0),
						"21000" => array (1,0,0,45,0,23000,0,0),
						"23000" => array (1,0,0,55,0,27000,0,0),
						"27000" => array (1,0,0,45,0,30000,0,0),
						"30000" => array (5,1,1,90,1,60000,200,1),
						"60000" => array (1,0,0,1,0,75000,0,0),
						"75000" => array (1,0,0,350,0,150000,0,0),
						"150000" => array (1,0,0,150,0,175000,0,0),
						"175000" => array (1,0,0,50,0,200000,0,0),
						"200000" => array (1,0,0,100,0,225000,0,0),
						"225000" => array (1,0,0,50,0,250000,0,0),
						"250000" => array (1,0,0,100,0,260000,0,0),
						"260000" => array (1,0,0,50,0,280000,0,0),
						"280000" => array (1,0,0,100,0,300000,0,0),
						"300000" => array (5,1,1,700,1,1500000,200,1),
						"1500000" => array (1,0,0,500,0,1750000,0,0),
						"1750000" => array (1,0,0,200,0,2000000,0,0),
						"2000000" => array (1,0,0,300,0,2175000,0,0),
						"2175000" => array (1,0,0,100,0,2300000,0,0),
						"2300000" => array (1,0,0,100,0,2400000,0,0),
						"2400000" => array (1,0,0,1,0,2500000,0,0),
						"2500000" => array (1,0,0,200,0,2600000,0,0),
						"2600000" => array (1,0,0,100,0,2800000,0,0),
						"2800000" => array (1,0,0,200,0,3000000,0,0),
						"3000000" => array (7,1,2,1000,1,6000000,200,1),
						"6000000" => array (1,0,0,1,0,6500000,0,0),
						"6500000" => array (1,0,0,200,0,7500000,0,0),
						"7500000" => array (1,0,0,1,0,8500000,0,0),
						"8500000" => array (1,0,0,250,0,9000000,0,0),
						"9000000" => array (1,0,0,400,0,9250000,0,0),
						"9250000" => array (1,0,0,50,0,9500000,0,0),
						"9500000" => array (1,0,0,400,0,9750000,0,0),
						"9750000" => array (1,0,0,350,0,9900000,0,0),
						"9900000" => array (1,0,0,500,0,10000000,0,0),
						"10000000" => array (9,1,3,2000,1,13000000,200,1),
						"13000000" => array (2,0,0,200,0,14000000,0,0),
						"14000000" => array (2,0,0,200,0,15000000,0,0),
						"15000000" => array (2,0,0,200,0,16000000,0,0),
						"16000000" => array (2,0,0,200,0,17000000,0,0),
						"17000000" => array (2,0,0,200,0,17500000,0,0),
						"17500000" => array (2,0,0,200,0,18000000,0,0),
						"18000000" => array (2,0,0,200,0,19000000,0,0),
						"19000000" => array (2,0,0,200,0,19500000,0,0),
						"19500000" => array (2,0,0,200,0,20000000,0,0),
						"20000000" => array (2,0,0,200,0,30000000,0,0),
                        "30000000" => array (2,0,0,250,0,32000000,0,0),
                        "32000000" => array (2,0,0,1,0,34000000,0,0),
                        "34000000" => array (2,0,0,250,0,35000000,0,0),
                        "35000000" => array (2,0,0,250,0,36000000,0,0),
                        "36000000" => array (2,0,0,250,0,38000000,0,0),
                        "38000000" => array (2,0,0,100,0,40000000,0,0),
                        "40000000" => array (2,0,0,150,0,42000000,0,0),
                        "42000000" => array (2,0,0,200,0,44000000,0,0),
                        "44000000" => array (2,0,0,250,0,45000000,0,0),
                        "45000000" => array (2,0,0,300,0,46000000,0,0),
                        "46000000" => array (2,0,0,100,0,48000000,0,0),
                        "48000000" => array (2,0,0,200,0,50000000,0,0),
                        "50000000" => array (2,0,0,300,0,52000000,200,1),
                        "52000000" => array (10,1,5,1500,1,55000000,0,0),
                        "55000000" => array (1,0,1,500,0,60000000,0,0),
                        "60000000" => array (1,0,1,700,0,65000000,0,0),
                        "65000000" => array (1,0,1,400,0,70000000,0,0),
                        "70000000" => array (1,0,1,450,0,75000000,0,0),
                        "75000000" => array (1,0,1,300,0,80000000,0,0),
                        "80000000" => array (1,0,1,350,0,85000000,0,0),
                        "85000000" => array (1,0,1,400,0,90000000,0,0),
                        "90000000" => array (1,0,1,450,0,95000000,0,0),
                        "95000000" => array (15,0,0,1600,0,100000000,0,0)
				);

if($user)
	while ($user['exp'] >= $user['nextup'] && !$user['in_tower']) {
		mysql_query("UPDATE `users` SET `nextup` = ".$exptable[$user['nextup']][5].",`stats` = stats+".$exptable[$user['nextup']][0].",
					`master` = `master`+".$exptable[$user['nextup']][1].", `vinos` = `vinos`+".$exptable[$user['nextup']][2].",
                                        `maxhp` = `maxhp`+".($exptable[$user['nextup']][2]*6).",
					`money` = `money`+'".$exptable[$user['nextup']][3]."',`level` = `level`+".$exptable[$user['nextup']][4].",`peredachi`=".$exptable[$user['nextup']][6].",`osobennosti` = `osobennosti`+'".$exptable[$user['nextup']][7]."'
				     WHERE `id` = '{$user['id']}'");
                

//echo mysql_error();
		//$exptable
		if($exptable[$user['nextup']][4]) {if($user['sex']==0){$aa="ла";}addch("<img src=http://img.yourc.com/i/magic/1x1.gif><font color=\"Black\"><font color=red><b>Внимание!</b></font> Персонаж <B>{$user['login']}</B> достиг".$aa." уровня ".($user['level']+1)."</font>");}


                $tempt = array_keys($exptable);
                if(!empty($user["refer"]) && $exptable[$user['nextup']][52]==$tempt[52])
                 {
//                  $lgns=mysql_fetch_array(mysql_query("SELECT `login` FROM `users` WHERE `id`='$data[refer]'"));
                    mysql_query("UPDATE `users` SET `money`=`money`+80 WHERE `id`='$user[refer]'");


	$us = mysql_fetch_array(mysql_query("select `id` from `online` WHERE `incity`='".$_SESSION['incity']."' and `date` >= ".(time()-60)." AND `id` = '{$user['refer']}' LIMIT 1;"));
         if($us[0]){
	addchp ('<font color=red>Внимание!</font> <font color=\"Black\">Персонаж <B>'.$user['login'].'</B> перешел на '.($user['level']+1).' уровень. Вам перечислено 80 кр.</font>   ','{[]}'.nick7 ($user['refer']).'{[]}');
	} else {
	   	  mysql_query("INSERT INTO `telegraph` (`owner`,`date`,`text`) values ('".$user['refer']."','','".'<font color=red>Внимание!</font> <font color=\"Black\">Персонаж <B>'.$user['login'].'</B> перешел на '.($user['level']+1).' уровень. Вам перечислено 80 кр.</font> '."');");
	}
                 }

		$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$_SESSION['uid']}' LIMIT 1;"));
	}
	$klan = mysql_fetch_array(mysql_query("SELECT * FROM `clans` WHERE `name` = '{$user['klan']}' LIMIT 1;"));
//тут табла опыта для клана
	$klanexptable = array(
						/*level, up*/
						"0" => array (0,500000),
						"500000" => array (1,2000000),
						"2000000" => array (1,5500000),
						"5500000" => array (1,10500000),
						"10500000" => array (1,20500000),
						"20500000" => array (1,30500000),
						"30500000" => array (1,40500000),
						"40500000" => array (1,55000000),
						"55000000" => array (1,75000000),
						"75000000" => array (1,95000000),
						"95000000" => array (1,110000000)
						);
	if ($klan['clanexp'] >= $klan['needexp']) {
		mysql_query("UPDATE `clans` SET `needexp` = ".$klanexptable[$klan['needexp']][1].",`clanlevel` = `clanlevel`+".$klanexptable[$klan['needexp']][0]."
					WHERE `name` = '{$user['klan']}'");
}
	$rooms = array ("Секретная Комната",
            "Комната для новичков","Комната перехода","Бойцовский Клуб","Подземелье","Зал Воинов 1",
            "Зал Воинов 2","Зал Воинов 3","Торговый зал","Рыцарский зал","Башня рыцарей-магов",
            "2 Этаж","Таверна","Астральные этажи","Огненный мир","Зал Паладинов",
            "Совет Белого Братства","Зал Тьмы","Царство Тьмы","Будуар","Центральная площадь",
            "Храм Знаний","Магазин","Ремонтная мастерская","Новогодняя елка","Комиссионный магазин",
            "Парк развлечений","Почта","Регистратура кланов","Банк","Суд",
            "Башня смерти","Готический замок","Лабиринт хаоса","Цветочный магазин","Магазин Березка",
            "Зал Стихий","Готический замок - приемная","Готический замок - арсенал","Готический замок - внутренний двор","Готический замок - мастерские",
            "Готический замок - комнаты отдыха","Лотерея","Комната Знахаря",
            "200"=> "Турнир",
            "201"=> "Большая торговая улица",
            "258"=> "Портал",
            "203"=> "Турнир",
            "204"=> "Храм Темных деяний",
            "401"=> "Врата Ада",
// БС
"501" => "Восточная Крыша",
"502" => "Бойница",
"503" => "Келья 3",
"504" => "Келья 2",
"505" => "Западная Крыша 2",
"506" => "Келья 4",
"507" => "Келья 1",
"508" => "Служебная комната",
"509" => "Зал Отдыха 2",
"510" => "Западная Крыша 1",
"511" => "Выход на Крышу",
"512" => "Зал Статуй 2",
"513" => "Храм",
"514" => "Восточная комната",
"515" => "Зал Отдыха 1",
"516" => "Старый Зал 2",
"517" => "Старый Зал 1",
"518" => "Красный Зал 3",
"519" => "Зал Статуй 1",
"520" => "Зал Статуй 3",
"521" => "Трапезная 3",
"522" => "Зал Ожиданий",
"523" => "Оружейная",
"524" => "Красный Зал-Окна",
"525" => "Красный Зал",
"526" => "Гостинная",
"527" => "Трапезная 1",
"528" => "Внутренний Двор",
"529" => "Внутр.Двор-Вход",
"530" => "Желтый Коридор",
"531" => "Мраморный Зал 1",
"532" => "Красный Зал 2",
"533" => "Библиотека 1",
"534" => "Трапезная 2",
"535" => "Проход Внутр. Двора",
"536" => "Комната с Камином",
"537" => "Библиотека 3",
"538" => "Выход из Мрам.Зала",
"539" => "Красный Зал-Коридор",
"540" => "Лестница в Подвал 1",
"541" => "Южный Внутр. Двор",
"542" => "Трапезная 4",
"543" => "Мраморный Зал 3",
"544" => "Мраморный Зал 2",
"545" => "Картинная Галерея 1",
"546" => "Лестница в Подвал 2",
"547" => "Проход Внутр. Двора 2",
"548" => "Внутр.Двор-Выход",
"549" => "Библиотека 2",
"550" => "Картинная Галерея 3",
"551" => "Картинная Галерея 2",
"552" => "Лестница в Подвал 3",
"553" => "Терасса",
"554" => "Оранжерея",
"555" => "Зал Ораторов",
"556" => "Лестница в Подвал 4",
"557" => "Темная Комната",
"558" => "Винный Погреб",
"559" => "Комната в Подвале",
"560" => "Подвал",
"402" => "Вход в подземелье",
"404" => "Магазин Луки",
"403" => "Подземелье",
"405" => "Вход в Башню",
"666" => "Тюрьма",
"667" => "Бар \"Пьяный Админ\" ",
"668" => "Зоомагазин",
"2001" => "Маленькая Скамейка",
"2002" => "Средняя Скамейка",
"2003" => "Большая Скамейка",
"2004" => "Храм Бракосочетание",
"2005" => "Касса",
"1097" => "Аукцион",
"1300" => "Новогодняя Елка",
"202" => "Алтарь предметов",
"21112" => "Алтарь Рун",
"888" => "Зоомагазин",
"457" => "Вип Зал",
"2006" => "Вип Касса",
"4545" => "Книжный магазин",
"69" => "Стелла выбора",
"3081" => "Аукцион",  
"406" => "Вход в Бездну",
"407" => "Бездна",
"655" => "Храм Знаний",
//Общага 
"101" => "Общежитие 1 Этаж",
"102" => "Общежитие 2 Этаж",
"103" => "Общежитие 3 Этаж",
"104" => "Общежитие Вип Этаж",
"105" => "Общежитие"
);

	header("Cache-Control: no-cache");

function nick_p ($user) {
	$id = $user['id'];
	?>
<span id="HP" style="font-size:10px"></span>&nbsp;<img src="http://img.yourc.com/i/misc/bk_life_loose.gif" alt="Уровень жизни" name="HP1" width="1" height="8" id="HP1"><img src="http://img.yourc.com/i/misc/bk_life_loose.gif" alt="Уровень жизни" name="HP2" width="1" height="8" id="HP2"><span style="width:1px; height:10px"></span><img src="http://img.yourc.com/i/herz.gif" width="10" height="9" alt="Уровень жизни">
<? }
// nick
function nick ($user) {
	$id = $user['id'];
$effect = mysql_fetch_array(mysql_query("SELECT `time` FROM `effects` WHERE `owner` = '{$id}' and `type` = '1022' LIMIT 1;"));
    if($effect) {
        $user['level'] = '??';
        $user['login'] = '</a><b><i>невидимка</i></b>';
        $user['align'] = '0';
        $user['klan'] = '';
		$user['id'] = '';
		$user['hp'] = '??';
		$user['maxhp'] = '??';
		$user['mana'] = '??';
		$user['maxmana'] = '??';
    }

	?>
	<img src="http://img.yourc.com/i/align_<?echo ($user['align']>0 ? $user['align']:"0");?>.gif"><?php if ($user['klan'] <> '') { echo '<img title="'.$user['klan'].'" src="http://img.yourc.com/i/klan/'.$user['klan'].'.gif">'; } ?><B><?=$user['login']?></B> [<?=$user['level']?>]<a href=inf.php?<?=$user['id']?> target=_blank><img src=http://img.yourc.com/i/inf.gif WIDTH=12 HEIGHT=11 ALT="Инф. о <?=$user['login']?>"></a>
<span id="HP" style="font-size:10px"></span>&nbsp;<img src="http://img.yourc.com/i/misc/bk_life_loose.gif" alt="Уровень жизни" name="HP1" width="1" height="8" id="HP1"><img src="http://img.yourc.com/i/misc/bk_life_loose.gif" alt="Уровень жизни" name="HP2" width="1" height="8" id="HP2"><span style="width:1px; height:10px"></span><img src="http://img.yourc.com/i/herz.gif" width="10" height="9" alt="Уровень жизни">
<? }


function nick99 ($id) {
       $user = mysql_fetch_array(mysql_query("SELECT fullhptime,fullmptime,hp,id,battle,level,maxhp,maxmana,mana FROM `users` WHERE `id` = '".$id."' LIMIT 1;"));
	$id = $user['id'];
	if(!$user['battle']){
		mysql_query("UPDATE `users` SET `hp` = '0' WHERE  `hp` < '0' AND `id` = '".$id."' LIMIT 1;");
		mysql_query("UPDATE `users` SET `mana` = '0' WHERE  `mana` < '0' AND `id` = '".$id."' LIMIT 1;");


	$owntravmadb = mysql_query("SELECT * FROM `effects` WHERE `time` <= ".time()." AND `owner` = ".$id.";");
	while ($owntravma = mysql_fetch_array($owntravmadb)) {
///путы от магии свободы
if($owntravma['type']==22){ $magictime=time()+(365*60*1440); mysql_query("INSERT INTO `effects` (`owner`,`name`,`time`,`type`) values ('".$id."','Путы','$magictime',10);");
mysql_query("UPDATE `users` SET `spellfreedom` ='0' WHERE  `id` = '".$id."' LIMIT 1;");
}
/////
		mysql_query("DELETE FROM `effects` WHERE `id` = '".$owntravma['id']."' LIMIT 1;");
if($owntravma['type']==21){
		mysql_query("UPDATE `users` SET  `prison`='0', `room`='20' WHERE `id` = ".$owntravma['owner']." LIMIT 1;");
		mysql_query("UPDATE `online` SET  `room`='20' WHERE `id` = ".$owntravma['owner']." LIMIT 1;");
}
if($owntravma['type']==11 or $owntravma['type']==12 or $owntravma['type']==13 or $owntravma['type']==14){
		mysql_query("UPDATE `users` SET `sila`=`sila`+'".$owntravma['sila']."', `lovk`=`lovk`+'".$owntravma['lovk']."', `inta`=`inta`+'".$owntravma['inta']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==188){
		mysql_query("UPDATE `users` SET `sila`=`sila`-'".$owntravma['sila']."', `lovk`=`lovk`-'".$owntravma['lovk']."', `inta`=`inta`-'".$owntravma['inta']."', `intel`=`intel`-'".$owntravma['intel']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эликсира <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==215){
						mysql_query("UPDATE `users` set
						`sila` =`sila` - ".$owntravma['gsila'].",
						`lovk` =`lovk` - ".$owntravma['glovk'].",
						`inta` =`inta` - ".$owntravma['ginta'].",
						`intel` =`intel` - ".$owntravma['gintel'].",
						`mfkrit` =`mfkrit` - ".$owntravma['mfkrit'].",
						`mfakrit` =`mfakrit` - ".$owntravma['mfakrit'].",
						`mfuvorot` =`mfuvorot` - ".$owntravma['mfuvorot'].",
						`mfauvorot` =`mfauvorot` - ".$owntravma['mfauvorot'].",
						`minu` =`minu` - ".$owntravma['minu'].",
						`maxu` =`maxu` - ".$owntravma['maxu'].",
						`mfdhit` =`mfdhit` - ".$owntravma['mfdhit'].",
						`mfhitp` =`mfhitp` - ".$owntravma['mfhitp']."
						WHERE `id` = ".$user['id']."");

	mysql_query("DELETE FROM `effects` WHERE `owner` = ".$user['id']." AND `name`='".$uses_zel['name']."' ");
		addchp('<font color=red>Внимание!</font> Закончилось действие эликсира <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==900){
		mysql_query("UPDATE `users` SET `sila`=`sila`-'".$owntravma['sila']."', `lovk`=`lovk`-'".$owntravma['lovk']."', `inta`=`inta`-'".$owntravma['inta']."', `intel`=`intel`-'".$owntravma['intel']."', `hp`=`hp`-'".$owntravma['hp']."', `maxhp`=`maxhp`-'".$owntravma['hp']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==901){
		mysql_query("UPDATE `users` SET `hp`=`hp`-'".$owntravma['hp']."', `maxhp`=`maxhp`-'".$owntravma['hp']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==303){
		mysql_query("UPDATE `users` SET `hp`=`hp`-'".$owntravma['hp']."', `maxhp`=`maxhp`-'".$owntravma['hp']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==304){
		mysql_query("UPDATE `users` SET `buter`=`buter`-'".$owntravma['buter']."',`hp`=`hp`-'".$owntravma['hp']."', `maxhp`=`maxhp`-'".$owntravma['hp']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие еды <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==314){
		mysql_query("UPDATE `users` SET `buter`=`buter`-'".$owntravma['buter']."',`hp`=`hp`-'".$owntravma['hp']."', `maxhp`=`maxhp`-'".$owntravma['hp']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие еды <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==315){
		mysql_query("UPDATE `users` SET `buter`=`buter`-'".$owntravma['buter']."',`hp`=`hp`-'".$owntravma['hp']."', `maxhp`=`maxhp`-'".$owntravma['hp']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие еды <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==316){
		mysql_query("UPDATE `users` SET `buter`=`buter`-'".$owntravma['buter']."',`hp`=`hp`-'".$owntravma['hp']."', `maxhp`=`maxhp`-'".$owntravma['hp']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие еды <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==305){
		mysql_query("UPDATE `users` SET `myhitp`=`myhitp`-'".$owntravma['myhitp']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие еды <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');

}
if($owntravma['type']==306){
		mysql_query("UPDATE `users` SET `mymagp`=`mymagp`-'".$owntravma['mymagp']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие еды <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');

}
if($owntravma['type']==311){
		mysql_query("UPDATE `users` SET `mfair`=`mfair`-'".$owntravma['mfair']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==2202){
		mysql_query("UPDATE `users` SET `shadowinterval`=`shadowinterval`-'".$owntravma['shadowinterval']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		}


if($owntravma['type']==312){
		mysql_query("UPDATE `users` SET `mfwater`=`mfwater`-'".$owntravma['mfwater']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');

}
if($owntravma['type']==313){
		mysql_query("UPDATE `users` SET `mfearth`=`mfearth`-'".$owntravma['mfearth']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');

}
if($owntravma['type']==8888){
		
        mysql_query("UPDATE `users` SET  `incity`='capitalcity', teleporting='1' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		mysql_query("UPDATE `online` SET `city`='capitalcity' where `id`='".$owntravma['owner']."' LIMIT 1;");
        echo("<script>top.window.location=http://capitalcity.yourc.com/enter.php?id='".$owntravma['owner']."';</script>");
		session_destroy();
							die();
						 }							


if($owntravma['type']==9){
		mysql_query("UPDATE `users` SET `intel`=`intel`-'".$owntravma['intel']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==9999){
		mysql_query("UPDATE `users` SET `lovk`=`lovk`-'".$owntravma['lovk']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==99799){
		mysql_query("UPDATE `users` SET `mana`=`mana`-'".$owntravma['mana']."',`maxmana`=`maxmana`-'".$owntravma['mana']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');

}
if($owntravma['type']==99){
		mysql_query("UPDATE `users` SET `inta`=`inta`-'".$owntravma['inta']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==99999){
		mysql_query("UPDATE `users` SET `intel`=`intel`-'".$owntravma['intel']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==999){
		mysql_query("UPDATE `users` SET `sila`=`sila`-'".$owntravma['sila']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==750){
		mysql_query("UPDATE `users` SET `mffire`=`mffire`-'".$owntravma['mffire']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');


}
if($owntravma['type']==300){
		mysql_query("UPDATE `users` SET `mydhit`=`mydhit`-'".$owntravma['mydhit']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');

}
if($owntravma['type']==317){
		mysql_query("UPDATE `users` SET `mydhit`=`mydhit`-'".$owntravma['mydhit']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');

}
if($owntravma['type']==3030){
		mysql_query("UPDATE `users` SET `poxod`='1' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');

}
if($owntravma['type']==301){
		mysql_query("UPDATE `users` SET `mydmag`=`mydmag`-'".$owntravma['mydmag']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==9871){
		mysql_query("UPDATE `users` SET `fast`=`fast`-'".$owntravma['fast']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==171717){
		mysql_query("UPDATE `users` SET `slot11`='1' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
addchp('<font color=red>Внимание!</font> Закончилось действие изучение книги <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==171718){
		mysql_query("UPDATE `users` SET `slot12`='1' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
addchp('<font color=red>Внимание!</font> Закончилось действие изучение книги <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==171719){
		mysql_query("UPDATE `users` SET `slot13`='1' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
addchp('<font color=red>Внимание!</font> Закончилось действие изучение книги <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==858585){
		mysql_query("UPDATE `users` SET `smenanikazveru`='0' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
addchp('<font color=red>Внимание!</font> Закончилось действие действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==171720){
		mysql_query("UPDATE `users` SET `slot14`='1' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
addchp('<font color=red>Внимание!</font> Закончилось действие изучение книги<b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==66766){
		mysql_query("UPDATE `users` SET `bonusexp`=0 WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
		addchp('<font color=red>Внимание!</font> Закончилось действие эффекта <b>'.$owntravma['name'].'</b>', '{[]}'.nick7($owntravma['owner']).'{[]}');
}
if($owntravma['type']==1022){
		mysql_query("UPDATE `users` SET  `invis`='0' WHERE `id` = ".$owntravma['owner']." LIMIT 1;");
}elseif($owntravma['type']==1022 && $user['battle']>0){
		mysql_query("UPDATE `users` SET  `invis`='0' WHERE `id` = ".$owntravma['owner']." LIMIT 1;");
//		addlog($user['battle'],"<span class=sysdate>".date("H:i")."</span> Закончилось действие эффекта <b>"невидимость"</b> для <b>".$owntravma['owner']."</b><BR>");
}
if($owntravma['type']==4){
mysql_query("UPDATE `users` SET `align`='0' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
}
	}
if($user['maxhp']<=100){
		if ((time()-$user['fullhptime'])/60 >= 1)
		{
			mysql_query("UPDATE `users` SET `hp` = `hp`+((".time()."-`fullhptime`)/60)*(`maxhp`/10), `fullhptime` = ".time()." WHERE  `hp` < `maxhp` AND `id` = '".mysql_real_escape_string($id)."' LIMIT 1;");
                      $user69 = mysql_fetch_array(mysql_query("SELECT hp,maxhp FROM `users` WHERE `id` = '".mysql_real_escape_string($id)."' LIMIT 1;"));
                      $hz = floor(($user69['hp']/($user69['maxhp']/100))*10);
			mysql_query("UPDATE `users` SET `s_duh` = '".$hz."' WHERE `id` = '".mysql_real_escape_string($id)."' LIMIT 1;");

                    }
                 }else{
			mysql_query("UPDATE `users` SET `hp` = `hp`+((".time()."-`fullhptime`)/60)*(`maxhp`/10), `fullhptime` = ".time()." WHERE  `hp` < `maxhp` AND `id` = '".mysql_real_escape_string($id)."' LIMIT 1;");
                        $user69 = mysql_fetch_array(mysql_query("SELECT hp,maxhp FROM `users` WHERE `id` = '".mysql_real_escape_string($id)."' LIMIT 1;"));
                        $hz = floor(($user69['hp']/($user69['maxhp']/100))*10);
			mysql_query("UPDATE `users` SET `s_duh`='".$hz."' WHERE `id` = '".mysql_real_escape_string($id)."' LIMIT 1;");

                }
        if($user['maxmana']<=100){
		if ((time()-$user['fullmptime'])/60 >= 1)
		{
			mysql_query("UPDATE `users` SET `mana` = `mana`+((".time()."-`fullmptime`)/60)*(`maxmana`/10), `fullmptime` = ".time()." WHERE  `mana` < `maxmana` AND `id` = '".mysql_real_escape_string($id)."' LIMIT 1;");
                    }
                 }else{
			mysql_query("UPDATE `users` SET `mana` = `mana`+((".time()."-`fullmptime`)/60)*(`maxmana`/10), `fullmptime` = ".time()." WHERE  `mana` < `maxmana` AND `id` = '".mysql_real_escape_string($id)."' LIMIT 1;");
                }
		mysql_query("UPDATE `users` SET `hp` = `maxhp`, `fullhptime` = ".time().", s_duh='1000'  WHERE  `hp` > `maxhp` AND `id` = '".mysql_real_escape_string($id)."' LIMIT 1;");
		mysql_query("UPDATE `users` SET `mana` = `maxmana`, `fullmptime` = ".time()." WHERE  `mana` > `maxmana` AND `id` = '".mysql_real_escape_string($id)."' LIMIT 1;");
    


}
}



// nick
function nick2 ($id) {
	if($id > _BOTSEPARATOR_) {
		$bots = mysql_fetch_array(mysql_query ('SELECT * FROM `bots` WHERE `id` = '.$id.' LIMIT 1;'));
		$id=$bots['prototype'];
		$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
		$user['login'] = $bots['name'];
		$user['hp'] = $bots['hp'];
		$user['id'] = $bots['id'];
	} else {
		$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
	}

	if($user[0]) {
	$effect = mysql_fetch_array(mysql_query("SELECT `time` FROM `effects` WHERE `owner` = '{$id}' and `type` = '1022' LIMIT 1;"));
    if($effect) {
        $user['level'] = '??';
        $user['login'] = '</a><b><i>невидимка</i></b>';
        $user['align'] = '0';
        $user['klan'] = '';
		$user['id'] = '';
		$user['hp'] = '??';
		$user['maxhp'] = '??';
		$user['mana'] = '??';
		$user['maxmana'] = '??';
    }
	?>
	

<img src="http://img.yourc.com/i/align_<?echo ($user['align']>0 ? $user['align']:"0");?>.gif"><?php if ($user['klan'] <> '') { echo '<img title="'.$user['klan'].'" src="http://img.yourc.com/i/klan/'.$user['klan'].'.gif">'; }if($user['deal']>0){echo"<img src=\"http://img.yourc.com/i/deal.gif\">";}?><B><?=$user['login']?></B> [<?=$user['level']?>]<a href=http://oldcity.yourc.com/inf.php?<?=$user['id']?> target=_blank><img src=http://img.yourc.com/i/inf.gif WIDTH=12 HEIGHT=11 ALT="Инф. о <?=$user['login']?>"></a>


<?
	return 1;
	}
}

// nick
function nick4 ($id,$st) {
	if($id > _BOTSEPARATOR_) {
		$bots = mysql_fetch_array(mysql_query ('SELECT * FROM `bots` WHERE `id` = '.$id.' LIMIT 1;'));
		$id=$bots['prototype'];
		$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
		$user['login'] = $bots['name'];
		$user['hp'] = $bots['hp'];
		$user['id'] = $bots['id'];
	} else {
		$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
	}

	if($user[0]) {
	$effect = mysql_fetch_array(mysql_query("SELECT `time` FROM `effects` WHERE `owner` = '{$id}' and `type` = '1022' LIMIT 1;"));
    if($effect) {
        $user['level'] = '??';
        $user['login'] = '</a><b><i>невидимка</i></b>';
        $user['align'] = '0';
        $user['klan'] = '';
		$user['id'] = '';
		$user['hp'] = '??';
		$user['maxhp'] = '??';
		$user['mana'] = '??';
		$user['maxmana'] = '??';
    }
		return "<span onclick=\"top.AddTo('".$user['login']."')\" oncontextmenu=\"return OpenMenu(event,".$user['level'].")\" class={$st}>".$user['login']."</span> [".$user['hp']."/".$user['maxhp']."]";
	}
}

// nick
function nick7 ($id) {
	if($id > _BOTSEPARATOR_) {
		$bots = mysql_fetch_array(mysql_query ('SELECT * FROM `bots` WHERE `id` = '.$id.' LIMIT 1;'));
		$id=$bots['prototype'];
		$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
		$user['login'] = $bots['name'];
		$user['hp'] = $bots['hp'];
		$user['id'] = $bots['id'];
	} else {
		$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
	}
	if($user[0]) {
	$effect = mysql_fetch_array(mysql_query("SELECT `time` FROM `effects` WHERE `owner` = '{$id}' and `type` = '1022' LIMIT 1;"));
    if($effect) {
        $user['level'] = '??';
        $user['login'] = '</a><b><i>невидимка</i></b>';
        $user['align'] = '0';
        $user['klan'] = '';
		$user['id'] = '';
		$user['hp'] = '??';
		$user['maxhp'] = '??';
		$user['mana'] = '??';
		$user['maxmana'] = '??';
    }
		return $user['login'];
	}
}

// nick
function nick5_1 ($id,$st) {
	if($id > _BOTSEPARATOR_) {
		$bots = mysql_fetch_array(mysql_query ('SELECT * FROM `bots` WHERE `id` = '.$id.' LIMIT 1;'));
		$id=$bots['prototype'];
		$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
		$user['login'] = $bots['name'];
		$user['hp'] = $bots['hp'];
		$user['id'] = $bots['id'];
	} else {
		$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
	}

	if($user[0]) {
	$effect = mysql_fetch_array(mysql_query("SELECT `time` FROM `effects` WHERE `owner` = '{$id}' and `type` = '1022' LIMIT 1;"));
    if($effect) {
        $user['level'] = '??';
        $user['login'] = '</a><b><i>невидимка</i></b>';
        $user['align'] = '0';
        $user['klan'] = '';
		$user['id'] = '';
		$user['hp'] = '??';
		$user['maxhp'] = '??';
		$user['mana'] = '??';
		$user['maxmana'] = '??';
    }
	$align=($user['align']>0 ? $user['align']:"0");
	if ($user['klan'] <> '') {
		$klan = "<img title=\"".$user['klan']."\" src=\"http://img.yourc.com/i/klan/".$user['klan'].".gif\">";
		}
	$userb="<img src=\"http://img.yourc.com/i/align_".$align.".gif\">".$klan.$user['login']." [".$user['level']."]<a href=inf.php?".$user['id']." target=_blank><IMG SRC=\"http://img.yourc.com/i/inf.gif\" WIDTH=12 HEIGHT=11 ALT=\"Инф. о ".$user['login']."\"></a>";
		return "<span class={$st}>".$userb."</span>";
	}
}
// nick
function nick5 ($id,$st) {
	if($id > _BOTSEPARATOR_) {
		$bots = mysql_fetch_array(mysql_query ('SELECT * FROM `bots` WHERE `id` = '.$id.' LIMIT 1;'));
		$id=$bots['prototype'];
		$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
		$user['login'] = $bots['name'];
		$user['hp'] = $bots['hp'];
		$user['id'] = $bots['id'];
	} else {
		$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
	}

	if($user[0]) {
	$effect = mysql_fetch_array(mysql_query("SELECT `time` FROM `effects` WHERE `owner` = '{$id}' and `type` = '1022' LIMIT 1;"));
    if($effect) {
        $user['level'] = '??';
        $user['login'] = '</a><b><i>невидимка</i></b>';
        $user['align'] = '0';
        $user['klan'] = '';
		$user['id'] = '';
		$user['hp'] = '??';
		$user['maxhp'] = '??';
		$user['mana'] = '??';
		$user['maxmana'] = '??';
    }
		return "<span class={$st}>".$user['login']."</span>";
	}
}

// nick
function nick6 ($id) {
	if($id > _BOTSEPARATOR_) {
		$bots = mysql_fetch_array(mysql_query ('SELECT * FROM `bots` WHERE `id` = '.$id.' LIMIT 1;'));
		$id=$bots['prototype'];
		$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
		$user['login'] = $bots['name'];
		$user['hp'] = $bots['hp'];
		$user['id'] = $bots['id'];
	} else {
		$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
	}


	if($user[0]) {
	$effect = mysql_fetch_array(mysql_query("SELECT `time` FROM `effects` WHERE `owner` = '{$id}' and `type` = '1022' LIMIT 1;"));
    if($effect) {
        $user['level'] = '??';
        $user['login'] = '</a><b><i>невидимка</i></b>';
        $user['align'] = '0';
        $user['klan'] = '';
		$user['id'] = '';
		$user['hp'] = '??';
		$user['maxhp'] = '??';
		$user['mana'] = '??';
		$user['maxmana'] = '??';
    }
		return "".$user['login']."</b> [".$user['level']."111]  <a href=inf.php?".$user['id']." target=_blank><img src=http://img.yourc.com/i/inf.gif WIDTH=12 HEIGHT=11 ALT=\"Инф. о ".$user['login']."\"></a><B>";
	}
}
// nick3
function nick3 ($id) {
	if($id > _BOTSEPARATOR_) {
		$bots = mysql_fetch_array(mysql_query ('SELECT * FROM `bots` WHERE `id` = '.$id.' LIMIT 1;'));
		$id=$bots['prototype'];
		$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
		$user['login'] = $bots['name'];
		$user['hp'] = $bots['hp'];
		$user['id'] = $bots['id'];
	} else {
		$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
	}


	if($user[0]) {
	$effect = mysql_fetch_array(mysql_query("SELECT `time` FROM `effects` WHERE `owner` = '{$id}' and `type` = '1022' LIMIT 1;"));
    if($effect) {
        $user['level'] = '??';
        $user['login'] = '</a><b><i>невидимка</i></b>';
        $user['align'] = '0';
        $user['klan'] = '';
		$user['id'] = '';
		$user['hp'] = '??';
		$user['maxhp'] = '??';
		$user['mana'] = '??';
		$user['maxmana'] = '??';
    }
		$mm .= "<img src=\"http://img.yourc.com/i/align_".($user['align']>0 ? $user['align']:"0").".gif\">";
		if ($user['klan'] <> '') {
			$mm .= '<img title="'.$user['klan'].'" src="http://img.yourc.com/i/klan/'.$user['klan'].'.gif">'; }
			$mm .= "<B>{$user['login']}</B> [{$user['level']}]<a href=inf.php?{$user['id']} target=_blank><img src=http://img.yourc.com/i/inf.gif WIDTH=12 HEIGHT=11 ALT=\"Инф. о {$user['login']}\"></a>";
	}
	return $mm;
}

function setHPpodzem($hp,$maxhp,$battle) {
		if ( $hp < $maxhp*0.33 ) {
			$polosa = 'i/1red.gif';
		}
		elseif ( $hp < $maxhp*0.66 ) {
			$polosa = 'i/1yellow.gif';
		}
		else {
			$polosa = 'i/1green.gif';
		}
		$rr = "<div ";
		if (!$battle) {
			$rr .= ' id=HP ';
		}
		$rr .= "><IMG SRC='{$polosa}' WIDTH=";
		$rr .= (150*($hp/$maxhp));
		$rr .= ' HEIGHT=10 ALT="Уровень жизни" name=HP1><img src=http://img.c.ru/i/1silver.gif WIDTH=';
		$rr .= (150-150*($hp/$maxhp));
		$rr .= ' HEIGHT=10 ALT="Уровень жизни" name=HP2>';
		$rr .= '<b style="font-size:11px"> '.$hp.'/'.$maxhp.'</b></div>';
		return $rr;
}
// полоска НР
function setHP($hp,$maxhp,$battle) {
		if ( $hp < $maxhp*0.33 ) {
			$polosa = 'i/1red.gif';
		}
		elseif ( $hp < $maxhp*0.66 ) {
			$polosa = 'i/1yellow.gif';
		}
		else {
			$polosa = 'i/1green.gif';
		}
		$rr = "<div style=\"position:absolute; left:-1px; top:-7px;\"";
		if (!$battle) {
			$rr .= ' id=HP ';
		}
		$rr .= "><IMG SRC='{$polosa}' WIDTH=";
		$rr .= (122*($hp/$maxhp));
		$rr .= ' HEIGHT=9 ALT="Уровень жизни"><img src=http://img.c.ru/i/1silver.gif WIDTH=';
		$rr .= (122-122*($hp/$maxhp));
		$rr .= ' HEIGHT=9 ALT="Уровень жизни">';
		$rr .= '</div>';
		$rr .= '<div style="position:absolute; left:5px; top:-7px; color:#FFFFFF;"><b>'.$hp.'/'.$maxhp.'</b></div>';
		return $rr;
}
function setHP2($hp,$maxhp,$battle) {
		if ( $hp < $maxhp*0.33 ) {
			$polosa = 'i/1red.gif';
		}
		elseif ( $hp < $maxhp*0.66 ) {
			$polosa = 'i/1yellow.gif';
		}
		else {
			$polosa = 'i/1green.gif';
		}

		$rr = "<IMG SRC='{$polosa}' WIDTH=";
		$rr .= (120*($hp/$maxhp));
		$rr .= ' HEIGHT=9 ALT="Уровень жизни"><img src=http://img.c.ru/i/1silver.gif WIDTH=';
		$rr .= (120-120*($hp/$maxhp));
		$rr .= ' HEIGHT=9 ALT="Уровень жизни">';

		$rr .= '<div style="position: absolute; left: 5; z-index: 1; font-weight: bold; color:#FFFFFF;"><b>'.$hp.'/'.$maxhp.'</b></div>';
		return $rr;
}

function setMP($mp,$maxmp,$battle) {
		$rr = "<div style='position:absolute; left:-1px; top:5px; color:#FFFFFF;'";
		if (!$battle) {
			$rr .= ' id=MP ';
		}
		$rr .= "><IMG SRC='i/1blue.gif' WIDTH=";
		$rr .= (120*($mp/$maxmp));
		$rr .= ' HEIGHT=9 ALT="Уровень маны"><img src=http://img.c.ru/i/1silver.gif WIDTH=';
		$rr .= (120-120*($mp/$maxmp));
		$rr .= ' HEIGHT=9 ALT="Уровень маны">';
		$rr .= '</div>';
		$rr .= '<div style="position:absolute; left:5px; top:5px; color:#FFFFFF;"><b>'.$mp.'/'.$maxmp.'</b></div>';
		return $rr;
}
function setMP2($mp,$maxmp,$battle) {

		$rr = "<IMG SRC='i/1blue.gif' WIDTH=";
		$rr .= (120*($mp/$maxmp));
		$rr .= ' HEIGHT=9 ALT="Уровень маны"><img src=http://img.c.ru/i/1silver.gif WIDTH=';
		$rr .= (120-120*($mp/$maxmp));
		$rr .= ' HEIGHT=9 ALT="Уровень маны">';

		$rr .= '<div style=\'position: absolute; left: 5; z-index: 1; font-weight: bold; color: #80FFFF\'><b>'.$mp.'/'.$maxmp.'</b></div>';
		return $rr;
}
function echoscroll($slot) {
		global $user;
		if ($user['battle']) {
			$script = 'fbattle';
		} else {
			$script = 'main';
		}
		if ($user[$slot] > 0) {
			$row['id'] = $user[$slot];
			
            $dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user[$slot]}' LIMIT 1;"));
			
            if ($dress['magic']) {
				$magic = magicinf ($dress['magic']);
				echo "<a  onclick=\"";
				if($magic['targeted']==1) {
					echo "okno('Введите название предмета', '".$script.".php?use={$row['id']}', 'target'); ";
				}else
				if($magic['targeted']==2) {
					echo "findlogin('Введите имя персонажа', '".$script.".php?use={$row['id']}', 'target'); ";
				}else
				if($magic['targeted']==4) {
					echo "note('Запрос', '".$script.".php?use={$row['id']}', 'target'); ";
				}elseif($magic['targeted']==5) {
				 echo "teleport('Введите название города', 'main.php?edit=1&use={$row['id']}', 'target')";
                }elseif($magic['targeted']==6) {
				echo "zamok('Замок для рюкзака', 'main.php?edit=1&use={$row['id']}', 'target')";
                }elseif($magic['targeted']==7) {
				echo "zapiski('Запрос', 'main.php?edit=1&use={$row['id']}', 'target')";
               
                 }else {
					echo "if(confirm('Использовать сейчас?')) { window.location='".$script.".php?use=".$row['id']."';}";
				}
				echo "\"href='#'>";
			}
			echo '<img src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=40 title="'.$dress['name'].'  Долговечность: '.$dress['duration'].'/'.$dress['maxdur'].'"  Долговечность: '.$dress['duration'].'/'.$dress['maxdur'].'" height=25 alt="Использовать  '.$dress['name']."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].'"></a>';
		    } else { echo "<img src=http://img.yourc.com/i/w13.gif width=40 height=25  alt='пустой слот магия'>"; }
}
 


function echokarman($karman1) {
		global $user;
		if ($user['battle']) {
			$script = 'fbattle';
		} else {
			$script = 'main';
		}
		if ($user[$karman1] > 0) {
			$row['id'] = $user[$karman1];
			
            $dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user[$karman1]}' LIMIT 1;"));
			
            if ($dress['magic']) {
				$magic = magicinf ($dress['magic']);
				echo "<a  onclick=\"";
				if($magic['targeted']==1) {
					echo "okno('Введите название предмета', '".$script.".php?use={$row['id']}', 'target'); ";
				}else
				if($magic['targeted']==2) {
					echo "findlogin('Введите имя персонажа', '".$script.".php?use={$row['id']}', 'target'); ";
				}else
				if($magic['targeted']==4) {
					echo "note('Запрос', '".$script.".php?use={$row['id']}', 'target'); ";
				}elseif($magic['targeted']==5) {
				echo "teleport('Введите название города', 'main.php?edit=1&use={$row['id']}', 'target')";
                }elseif($magic['targeted']==6) {
				echo "zamok('Замок для рюкзака', 'main.php?edit=1&use={$row['id']}', 'target')";
                }elseif($magic['targeted']==7) {
				echo "zapiski('Запрос', 'main.php?edit=1&use={$row['id']}', 'target')";
               
                }else {
					echo "if(confirm('Использовать сейчас?')) { window.location='".$script.".php?use=".$row['id']."';}";
				}
				echo "\"href='#'>";
			}
			echo '<img src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=40 title="'.$dress['name'].'  Долговечность: '.$dress['duration'].'/'.$dress['maxdur'].'"  Долговечность: '.$dress['duration'].'/'.$dress['maxdur'].'" height=20 alt="Использовать  '.$dress['name']."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].'"></a>';
		    } else { echo "<img src=http://img.yourc.com/i/w15.gif width=40 height=20  alt='Пустой слот карман'>"; }
}
















// ссылка на магию
function showhrefmagic($dress, $inf=0) {
			global $user;
			
			if($inf==0){
				//$magic = magicinf ($dress['includemagic']);
				$magic = magicinf ($dress['magic']);
				echo "<a  onclick=\"";
				if($magic['targeted']==1) {
					echo "okno('Введите название предмета', '?usehrefmagic={$dress['id']}', 'target')";
				}elseif($magic['targeted']==2) {
					echo "findlogin('".$magic['name']."', '?usehrefmagic={$dress['id']}', 'target')";
				}else
				if($magic['targeted']==4) {
					echo "note('Запрос', '?usehrefmagic={$row['id']}', 'target'); ";
				}elseif($magic['targeted']==5) {
				echo "teleport('Введите название города', 'main.php?edit=1&use={$row['id']}', 'target')";
                }elseif($magic['targeted']==6) {
				echo "zamok('Замок для рюкзака', 'main.php?edit=1&use={$row['id']}', 'target')";
                }elseif($magic['targeted']==7) {
				echo "zapiski('Запрос', 'main.php?edit=1&use={$row['id']}', 'target')";
               
                 }else {
					echo "if (confirm('Использовать сейчас?')) window.location='?usehrefmagic=".$dress['id']."';";
				}
				echo "\"href='#'>";
}
				
				echo "<img style='background-image:url(http://img.yourc.com/i/blink.gif);' src='http://img.yourc.com/i/sh/{$dress['img']}' title=\"<b>".$dress['name']."</b><br>\nДолговечность: ".$dress['duration']."/".$dress['maxdur']."".(($dress['ghp']>0)?"<br>\nУровень жизни: +{$dress['ghp']} (HP)":"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"").(($dress['minu']>0)?"<br>\nУрон: {$dress['minu']}-{$dress['maxu']}":"").(($dress['text']!=null)?"<br>\nНа оружии выгравировано '{$dress['text']}'":"")."<br>\nВстроена магия: ".$magic['name']."\" alt=\"<b>".$dress['name']."</b><br>\nДолговечность: ".$dress['duration']."/".$dress['maxdur']."".(($dress['ghp']>0)?"<br>\nУровень жизни: +{$dress['ghp']} (HP)":"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"").(($dress['minu']>0)?"<br>\nУрон: {$dress['minu']}-{$dress['maxu']}":"").(($dress['text']!=null)?"<br>\nНа оружии выгравировано '{$dress['text']}'":"")."<br>\nВстроена магия: ".$magic['name']."\"><BR>";
}


// показать перса в инфе
function showpersout($id,$pas = 0,$battle = 0,$me = 0,$show_pr = 0) {
	global $mysql, $rooms;





	if($id > _BOTSEPARATOR_) {
		$bots = mysql_fetch_array(mysql_query ('SELECT * FROM `bots` WHERE `id` = '.$id.' LIMIT 1;'));
		$id=$bots['prototype'];
		$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
		$user['login'] = $bots['name'];
		$user['hp'] = $bots['hp'];
		$user['id'] = $bots['id'];
	    $user['mp'] = $bots['mp'];
      } else {
	$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
	}


if($user['zver_id']>0){
if($user['battle']>0){
$nb = mysql_fetch_array(mysql_query("SELECT id_person FROM `person_on` WHERE id_person= '".$user['id']."';"));
}
$zver=mysql_fetch_array(mysql_query("SELECT shadow,login,level,vid,sitost FROM `users` WHERE `id` = '".mysql_real_escape_string($user['zver_id'])."' LIMIT 1;"));
if($nb && $zver['sitost']>=1){
$balalaika=1;
if($zver['vid']==1){$user['sila'] = $user['sila']+$zver['level']; $engnah="demon";$rus_n = 'Демоническая Сила';$rus_n2 = 'Сила';} //Чертяка
if($zver['vid']==2){$user['lovk'] = $user['lovk']+$zver['level']; $engnah="cat";$rus_n = 'Кошачья Ловкость';$rus_n2 = 'Ловкость';} //Кошка
if($zver['vid']==3){$user['inta'] = $user['inta']+$zver['level']; $engnah="owl";$rus_n = 'Интуиция Совы';$rus_n2 = 'Интуиция';} //Сова
if($zver['vid']==4){$user['hp'] += $zver['level']*6; $user['maxhp'] += $zver['level']*6; $engnah="dog"; $rus_n = 'Преданность Пса'; $rus_n2 = 'Выносливость';} //Собака
if($zver['vid']==5){$user['intel'] = $user['intel']+$zver['level']; $engnah="wisp";$rus_n = 'Сила Стихий';$rus_n2 = 'Mощности магии стихий';} //Светляк

}
}
?>
	<CENTER>
<? if(!$battle){?>
	<A HREF="javascript:top.AddToPrivate('<?=$user['login']?>', top.CtrlPress)" target=refreshed><img src="http://img.yourc.com/i/lock.gif" width=20 height=15></A><?if($user['align']>0){echo"<img src=\"http://img.yourc.com/i/align_".$user['align'].".gif\">";} if ($user['klan'] <> '') { echo '<img title="'.$user['klan'].'" src="http://img.yourc.com/i/klan/'.$user['klan'].'.gif">'; }if($user['deal']>0){ echo"<img src=\"http://img.yourc.com/i/deal.gif\">"; } ?><B><?=$user['login']?></B> [<?=$user['level']?>]<a href=inf.php?<?=$user['id']?> target=_blank><img src=http://img.yourc.com/i/inf.gif WIDTH=12 HEIGHT=11 ALT="Инф. о <?=$user['login']?>"></a>
	<?}
		if ($user['block']) {
			echo "<BR><FONT class=private>Персонаж заблокирован!</font>";
		}
		if ($user['prison']) {
			echo "<BR><FONT class=private>Персонаж в заточении!</font>";
		}
		if ($user['bar']) {
			echo "<BR><FONT class=private>Пьянствует в баре!</font>";
		}
	//echo setHP($user['hp'],$user['maxhp'],$battle);
	if ($user['maxmana']) {
		//echo setMP($user['mana'],$user['maxmana'],$battle);
	}
	?>

	<TABLE cellspacing=0 cellpadding=0 style="	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #FFFFFF;
	border-right-color: #666666;
	border-bottom-color: #666666;
	border-left-color: #FFFFFF;
	padding: 2px;">

<TR>
<TD>
<TABLE border=0 cellSpacing=1 cellPadding=0 width="100%" >
<TBODY>
<TR vAlign=top>
<TD>
<TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
<TBODY>

<TR><TD style="BACKGROUND-IMAGE:none">
<?php
	$invis = mysql_fetch_array(mysql_query("SELECT `time` FROM `effects` WHERE `owner` = '{$id}' and `type` = '1022' LIMIT 1;"));
    if(($battle && $invis && $user['id'] != $_SESSION['uid'])) {// or ($user['bot']>0)

		$user['level'] = '??';
        $user['login'] = '</a><b><i>невидимка</i></b>';
        $user['align'] = '0';
        $user['klan'] = '';
		$user['id'] = '';
		$user['hp'] = '??';
		$user['maxhp'] = '??';
		$user['mana'] = '??';
		$user['maxmana'] = '??';
		$user['sila'] ='??';
		$user['lovk'] ='??';
		$user['inta'] ='??';
		$user['vinos'] ='??';



$showme = $user['id'];
if ($user['helm'] >=0) {
echo '<img src="http://img.yourc.com/i/helm.gif" width=60 height=60>';
}
?>
</TD></TR>

<TR><TD style="BACKGROUND-IMAGE:none">
<?php
if ($user['naruchi'] >=0) {
			echo '<img src="http://img.yourc.com/i/naruchi.gif" width=60 height=40>';
		}
?></TD></TR>

<TR><TD style="BACKGROUND-IMAGE: none">
<?php
if ($user['weap'] >=0) {
			echo '<img src="http://img.yourc.com/i/weap.gif" width=60 height=60>';
		}
	?></TD></TR>

<TR><TD style="BACKGROUND-IMAGE: none">
<?php
if ($user['bron'] >=0) {
			echo '<img src="http://img.yourc.com/i/bron.gif" width=60 height=80>';
		}
	?></TD></TR>

<TR><TD style="BACKGROUND-IMAGE: none">
<?php
if ($user['belt'] >=0) {
			echo '<img src="http://img.yourc.com/i/belt.gif" width=60 height=40>';
		}
}else{	?>
<?php
if ($user['helm'] > 0 && ($user['bot']==0)) {
$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['helm']}' LIMIT 1;"));
if ($dress['includemagicdex'] or $dress['magic']>0 && (!$pas OR ($battle AND $me))) {
showhrefmagic($dress, $me);
} else {
if($dress['artefact']!=0 or $dress['ecost']>0){$art="&a=1";}else{$art="";}
if (@!$dress['count']){
				echo '<a href="/library.php?id='.$dress['prototype'].$art.'" target=_blank><img  '.((($dress['maxdur']-2)<=$dress['duration'] && !$pas)?" style='background-image:url(http://img.yourc.com/i/blink.gif);' ":"").' src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=60 title="';
				}else{
				echo '<a href="/library.php?id='.$dress['id'].$art.'" target=_blank><img  '.((($dress['maxdur']-2)<=$dress['duration'] && !$pas)?" style='background-image:url(http://img.yourc.com/i/blink.gif);' ":"").' src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=60 title="';
				}
				
				if($dress['magic']>0){$magic = magicinf ($dress['magic']);}
                echo "<b>".$dress['name']."</b>"
			.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
			.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
			.(($dress['text']!=null)?"\r\n<br/>На шлеме выгравировано '{$dress['text']}'":"")
			.(($dress['magic']>0)?"\r\n<br/>Встроена магия: {$magic['name']}":"")
			."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].'" ></a>';
}}else{
echo '<img src="http://img.yourc.com/i/w9.gif" width=60 height=60 alt="Пустой слот шлем" >';
}
?>
</TD></TR>

<TR><TD style="BACKGROUND-IMAGE:none">
<?php
		if ($user['naruchi'] > 0 && ($user['bot']==0)) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['naruchi']}' LIMIT 1;"));
			if ($dress['includemagicdex'] or $dress['magic']>0 && (!$pas OR ($battle AND $me))) {
				showhrefmagic($dress, $me);
			} else {
				if($dress['artefact']!=0 or $dress['ecost']>0){$art="&a=1";}else{$art="";}
				if (@!$dress['count']){
				echo '<a href="/library.php?id='.$dress['prototype'].$art.'" target=_blank><img  '.((($dress['maxdur']-2)<=$dress['duration'] && !$pas)?" style='background-image:url(http://img.yourc.com/i/blink.gif);' ":"").' src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=40 title="';
				}else{
				echo '<a href="/library.php?id='.$dress['id'].$art.'" target=_blank><img  '.((($dress['maxdur']-2)<=$dress['duration'] && !$pas)?" style='background-image:url(http://img.yourc.com/i/blink.gif);' ":"").' src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=40 title="';
				}
				if($dress['magic']>0){$magic = magicinf ($dress['magic']);}
              echo "<b>".$dress['name']."</b>"
			.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
			.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
			.(($dress['text']!=null)?"\r\n<br/>На наручах выгравировано '{$dress['text']}'":"")
			.(($dress['magic']>0)?"\r\n<br/>Встроена магия: {$magic['name']}":"")."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].'" ></a>';
			}
		}
		else
		{
			echo '<img src="http://img.yourc.com/i/w18.gif" width=60 height=40 alt="Пустой слот наручи" >';
		}

?></TD></TR>

<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['weap'] > 0 && ($user['bot']==0)) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['weap']}' LIMIT 1;"));
			if ($dress['includemagicdex'] or $dress['magic']>0 && (!$pas OR ($battle AND $me))) {
				showhrefmagic($dress, $me);
			} else {
				if($dress['artefact']!=0 or $dress['ecost']>0){$art="&a=1";}else{$art="";}
				echo '<a href="/library.php?id='.$dress['prototype'].$art.'" target=_blank><img  '.((($dress['maxdur']-2)<=$dress['duration'] && $dress['duration'] > 2 && !$pas)?" style='background-image:url(http://img.yourc.com/i/blink.gif);' ":"").' src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=60 title="'
				."<b>".$dress['name']."</b>"

				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			    .(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				.(($dress['minu']>0)?"\r\n<br/>Урон: {$dress['minu']}-{$dress['maxu']}":"")
				."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['text']!=null)?"\r\n<br/>На лезвии выгравирована надпись '{$dress['text']}'":"")
				.'" alt="'.$dress['name']."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				.(($dress['minu']>0)?"\r\n<br/>Урон: {$dress['minu']}-{$dress['maxu']}":"")

				.(($dress['text']!=null)?"\r\n<br/>На лезвии выгравирована надпись '{$dress['text']}'":"").'" ></a>';

			}
		}
		else
		{
			echo '<img src="http://img.yourc.com/i/w3.gif" width=60 height=60 alt="Пустой слот оружие" >';
		}
	?></TD></TR>

<TR><TD style="BACKGROUND-IMAGE: none">
<?php


	$robas = mysql_fetch_array(@mysql_query("SELECT * FROM `inventory` WHERE   `type` = 27 AND `id` = '{$user['rybax']}' LIMIT 1;"));

		$brons = mysql_fetch_array(@mysql_query("SELECT * FROM `inventory` WHERE  `type` = 4 AND `id` = '{$user['bron']}' LIMIT 1;"));

			$plaws = mysql_fetch_array(@mysql_query("SELECT * FROM `inventory` WHERE  `type` = 28 AND `id` = '{$user['plaw']}' LIMIT 1;"));

	$ro1=$robas["dressed"];
	$br1=$brons["dressed"];
	$pl1=$plaws["dressed"];

	//print "$ro1||$br||$pl1";
		if ( $ro1=='1' && $br1!='1' && $pl1!='1') {
			if ($user['rybax'] > 0 && ($user['bot']==0)) {
			$dress = @mysql_fetch_array(@mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['rybax']}' LIMIT 1;"));
			if ($dress['includemagicdex'] or $dress['magic']>0 && (!$pas OR ($battle AND $me))) {
				showhrefmagic($dress, $me);
			} else {
				if($dress['artefact']!=0 or $dress['ecost']>0){$art="&a=1";}else{$art="";}
				echo '<a href="/library.php?id='.$dress['prototype'].$art.'" target=_blank><img  '.((($dress['maxdur']-2)<=$dress['duration'] && $dress['duration'] > 2 && !$pas)?" style='background-image:url(i/blink.gif);' ":"").' src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=80 title="'
				."<b>".$dress['name']."</b>"

				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['text']!=null)?"\r\n<br/>На одежде вышито '{$dress['text']}'":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($incmagic['max'])?"	Встроено заклятие <img src=\"http://img.yourc.com/i/magic/".$incmagic['img']."\" alt=\"".$incmagic['name']."\"> ".$incmagic['cur']." шт.	<BR>":"")
				.'" alt="'.$dress['name']."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur']."".""
				.(($dress['text']!=null)?"\r\n<br/>На одежде вышито '{$dress['text']}'":"").'" ></a>';
			}
		}
		else
		{
			echo '<img src="http://img.yourc.com/i/w4.gif" width=60 height=80 alt="Пустой слот Броня" >';
		}
		}
		///////конец рубах/////
	elseif (($ro1!= '1' AND $br1!= '1' AND $pl1!='1')  OR
	($ro1 = '1' AND $br1= '1' AND $pl1!='1') OR
	 ($ro1!= '1' AND $br1 = '1' AND $pl1!='1') ) {


			if ($user['bron'] > 0 && ($user['bot']==0)) {
			$dress = @mysql_fetch_array(@mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['bron']}' LIMIT 1;"));

			if ($dress['includemagicdex'] or $dress['magic']>0 && (!$pas OR ($battle AND $me))) {
				showhrefmagic($dress, $me);

			} else


			{

				if($dress['artefact']!=0 or $dress['ecost']>0){$art="&a=1";}else{$art="";}
				echo '<a href="/library.php?id='.$dress['prototype'].$art.'" target=_blank><img  '.((($dress['maxdur']-2)<=$dress['duration'] && $dress['duration'] > 2 && !$pas)?
				" style='background-image:url(http://img.yourc.com/i/blink.gif);' ":"").' src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=80
				 title="'."<b>".$dress['name']."</b>"

				 .(($dress['ghp']>0)?            "\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['text']!=null)?"\r\n<br/>На одежде вышито '{$dress['text']}'":"")
				 .(($robas['dressed']!=0)?"\r\n<br/>\r\n<br/><b>{$robas['name']}</b>":"")
				 .(($robas['dressed']!=0)?"\r\n<br/>Долговечность: {$robas['duration']}/{$robas['maxdur']}":"")
				 .(($incmagic['max'])?"	Встроено заклятие <img src=\"http://img.yourc.com/i/magic/".$incmagic['img']."\"
				  alt=\"".$incmagic['name']."\"> ".$incmagic['cur']." шт.	<BR>":"").'"
				  alt="'.$dress['name']."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				  .(($dress['ghp']>0)?  "\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				   ."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur']."".""
				  .(($dress['text']!=null)?"\r\n<br/>На одежде вышито '{$dress['text']}'":"").'"


				  ></a>';
			}
		}
		else
		{
			echo '<img src="http://img.yourc.com/i/w4.gif" width=60 height=80 alt="Пустой слот броня" >';
		}

		}
		/////ПЛАЩ!!!!////
		if (($ro1!= '1' AND $br1!= '1' AND $pl1=='1')  OR
		($ro1='1' AND $br1!= '1' AND $pl1=='1') OR
	 ($ro1!=='1' AND $br1=='1' AND $pl1=='1') OR
	($ro1=='1' AND $br1=='1' AND $pl1=='1') )
	  {
			if ($user['plaw'] > 0 && ($user['bot']==0)) {
			$dress = @mysql_fetch_array(@mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['plaw']}' LIMIT 1;"));
			if ($dress['includemagicdex'] or $dress['magic']>0 && (!$pas OR ($battle AND $me))) {
				showhrefmagic($dress, $me);
			} else {
				if($dress['artefact']!=0 or $dress['ecost']>0){$art="&a=1";}else{$art="";}
				echo '<a href="/library.php?id='.$dress['prototype'].$art.'" target=_blank><img '
				.((($dress['maxdur']-2)<=$dress['duration'] && $dress['duration'] > 2 && !$pas)?" style='background-image:url(http://img.yourc.com/i/blink.gif);' ":"").' src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=80 title="'
				."<b>".$dress['name']."</b>"

				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur']."".""
				.(($dress['text']!=null)?"\r\n<br/>На одежде вышито '{$dress['text']}'":"")
				.(($brons['dressed']!=0)?"\r\n<br/>\r\n<br/><b>{$brons['name']}</b>":"")

				.(($brons['ghp']>0)?"\r\n<br/>Уровень жизни: +{$brons['ghp']} (HP)":"")
				.(($brons['bron1']!=0)?"\r\n<br/>Броня головы: {$brons['bron11']}-{$brons['bron1']} (".(((($brons['bron11']-1)!=0)?($brons['bron11']-1)."+":""))."d".(1+$brons['bron1']-$brons['bron11']).")":"")
			.(($brons['bron2']!=0)?"\r\n<br/>Броня корпуса: {$brons['bron22']}-{$brons['bron2']} (".(((($brons['bron22']-1)!=0)?($brons['bron22']-1)."+":""))."d".(1+$brons['bron2']-$brons['bron22']).")":"")
			.(($brons['bron3']!=0)?"\r\n<br/>Броня пояса: {$brons['bron33']}-{$brons['bron3']} (".(((($brons['bron33']-1)!=0)?($brons['bron33']-1)."+":""))."d".(1+$brons['bron3']-$brons['bron33']).")":"")
			.(($brons['bron4']!=0)?"\r\n<br/>Броня ног: {$brons['bron44']}-{$brons['bron4']} (".(((($brons['bron44']-1)!=0)?($brons['bron44']-1)."+":""))."d".(1+$brons['bron4']-$brons['bron44']).")":"")
			.(($brons['dressed']!=0)?"\r\n<br/>Долговечность: {$brons['duration']}/{$brons['maxdur']}":"")
				.(($brons['text']!=null)?"\r\n<br/>На одежде вышито '{$brons['text']}'":"")
				.(($robas['dressed']!=0)?"\r\n<br/>\r\n<br/><b>{$robas['name']}</b>":"")
				.(($robas['ghp']>0)?"\r\n<br/>Уровень жизни: +{$robas['ghp']} (HP)":"")
				.(($robas['bron1']!=0)?"\r\n<br/>Броня головы: {$robas['bron11']}-{$robas['bron1']} (".(((($robas['bron11']-1)!=0)?($robas['bron11']-1)."+":""))."d".(1+$robas['bron1']-$robas['bron11']).")":"")
			.(($robas['bron2']!=0)?"\r\n<br/>Броня корпуса: {$robas['bron22']}-{$robas['bron2']} (".(((($robas['bron22']-1)!=0)?($robas['bron22']-1)."+":""))."d".(1+$robas['bron2']-$robas['bron22']).")":"")
			.(($robas['bron3']!=0)?"\r\n<br/>Броня пояса: {$robas['bron33']}-{$robas['bron3']} (".(((($robas['bron33']-1)!=0)?($robas['bron33']-1)."+":""))."d".(1+$robas['bron3']-$robas['bron33']).")":"")
			.(($robas['bron4']!=0)?"\r\n<br/>Броня ног: {$robas['bron44']}-{$robas['bron4']} (".(((($robas['bron44']-1)!=0)?($robas['bron44']-1)."+":""))."d".(1+$robas['bron4']-$robas['bron44']).")":"")
			.(($robas['dressed']!=0)?"\r\n<br/>Долговечность: {$robas['duration']}/{$robas['maxdur']}":"").'" ></a>';
			}
		}

		else
		{
			echo '<img src="http://img.yourc.com/i/w4.gif" width=60 height=80 alt="Пустой слот плащ" >';
		}


		}
	?></TD></TR>

<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['belt'] > 0 && ($user['bot']==0)) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['belt']}' LIMIT 1;"));
			if ($dress['includemagicdex'] or $dress['magic']>0 && (!$pas OR ($battle AND $me))) {
				showhrefmagic($dress, $me);
			} else {
				if($dress['artefact']!=0 or $dress['ecost']>0){$art="&a=1";}else{$art="";}
				echo '<a href="/library.php?id='.$dress['prototype'].$art.'" target=_blank><img  '.((($dress['maxdur']-2)<=$dress['duration'] && !$pas)?" style='background-image:url(http://img.yourc.com/i/blink.gif);' ":"").' src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=40 title="'
				."<b>".$dress['name']."</b>"

				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				.(($dress['text']!=null)?"\r\n<br/>На поясе выгравировано '{$dress['text']}'":"")
				."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur']
				.'" alt="'.$dress['name'].""
				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['text']!=null)?"\r\n<br/>На поясе выгравировано '{$dress['text']}'":"").'" ></a>';
			}
		}
		else
		{
			echo '<img src="http://img.yourc.com/i/w5.gif" width=60 height=40 alt="Пустой слот пояс" >';
		}}
	?></TD></TR>
</TBODY></TABLE>
</TD>

<TD>
<TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
<TR>
<TD height=20 vAlign=middle>
<table cellspacing="0" cellpadding="0" style='line-height: 1'>


<?

if($battle!='0' or $user['id']==1){?> <tr><td nowrap style="font-size:9px" style="position: relative">
<?
if($user['id']==1){
	$vrag_b = mysql_fetch_array(mysql_query("SELECT `hp` FROM `bots` WHERE  `prototype` = 1 LIMIT 1 ;"));
if($vrag_b){$user['hp']=$vrag_b['hp'];}

}
echo setHP2($user['hp'],$user['maxhp'],$battle);

print"</td>
</tr>";}else{
?>
<?$gbb=getBrowser(); if($gbb['name']=='Internet Explorer') {$leftbind=5;} else {$leftbind=73;}?>

<tr><td nowrap style="font-size:9px" style="position: relative">
<table cellspacing="0" cellpadding="0" style='line-height: 1'><td nowrap style="font-size:9px" style="position: relative"><SPAN id="HP" style='position: absolute; left: <?=$leftbind?>; z-index: 1; font-weight: bold; color: #FFFFFF'></SPAN><img src="http://img.yourc.com/i/misc/bk_life_loose.gif" alt="Уровень жизни" name="HP1" width="1" height="9" id="HP1"><img src="http://img.yourc.com/i/misc/bk_life_loose.gif" alt="Уровень жизни" name="HP2" width="1" height="9" id="HP2"></td></table>
</td>
</tr>


<?

}
if(!$pas or $battle!=0){
if($battle!='0'){
if($user['maxmana']){ ?> 
<tr><td nowrap height=10 style="font-size:9px" style="position: relative">
<?
echo setMP2($user['mana'],$user['maxmana'],$battle);
print"</td></tr>";}
}else{
if($user['maxmana']){ ?> 
<tr>
<td nowrap style="font-size:9px" style="position: relative"><SPAN id="MP" style='position: absolute; left: <?=$leftbind?>; z-index: 1; font-weight: bold; color: #80FFFF'></SPAN><img src="http://img.c.ru/i/misc/bk_life_loose.gif" alt="Уровень Маны" name="MP1" width="1" height="9" id="MP1"><img src="http://img.c.ru/i/misc/bk_life_loose.gif" alt="Уровень Маны" name="MP2" width="1" height="9" id="MP2"><span style="width:1px; height:10px"></span></td>
</tr>
<?/*
echo setMP2($user['mana'],$user['maxmana'],$battle);
print"</td></tr>";*/
}

}}
/////Убрав коммент , будет показвать ману в инвеф
/*
if($battle!='1'){
if($user['maxmana']){ ?>
<tr><td nowrap height=10 style="font-size:9px" style="position: relative">
<?

echo setMP2($user['mana'],$user['maxmana'],$battle);
print"</td>
</tr>";}
}else{
if($user['maxmana']){ ?>
<tr><td nowrap style="font-size:9px" style="position: relative">
<?
echo setMP2($user['mana'],$user['maxmana'],$battle);
print"</td>
</tr>";}
}
*/
$zver=mysql_fetch_array(mysql_query("SELECT shadow,login,level FROM `users` WHERE `id` = '".mysql_real_escape_string($user['zver_id'])."' LIMIT 1;"));

?>

</table>
</TD></TR>
<TR><TD height=220 vAlign=top width=120 align=left>
<DIV style="Z-INDEX: 1; POSITION: relative; WIDTH: 120px; HEIGHT: 220px" bgcolor="black">
<?
$strtxt = "<b>".$user['login']."</b><br>";
$strtxt .= "Сила: ".$user['sila']."<BR>";
$strtxt .= "Ловкость: ".$user['lovk']."<BR>";
$strtxt .= "Интуиция: ".$user['inta']."<BR>";
$strtxt .= "Выносливость: ".$user['vinos']."<BR>";
if ($user['level'] > 3) {
$strtxt .= "Интеллект: ".$user['intel']."<BR>";
}
if ($user['level'] > 6) {
$strtxt .= "Мудрость: ".$user['mudra']."<BR>";
}
if ($user['level'] > 9) {
$strtxt .= "Духовность: ".$user['spirit']."<BR>";
}
if ($user['level'] > 12) {
$strtxt .= "Воля: ".$user['will']."<BR>";
}
if ($user['level'] > 15) {
$strtxt .= "Свобода духа: ".$user['freedom']."<BR>";
}
if ($user['level'] > 18) {
$strtxt .= "Божественность: ".$user['god']."<BR>";
}

if(!$pas && !$battle){
if($zver){
?>
<div style="position:absolute; left:80px; top:145px; width:40px; height:73px; z-index:2">
<a href="zver_inv.php">
<IMG border=0  width=40 height=73 src='http://img.yourc.com/i/shadow/<?print"".$zver['shadow']."";?>' onmouseout='ghideshow();'  onmouseover='gfastshow("<?=$zver['login']?> [<?=$zver['level']?>] (Перейти к настройкам)");'>
</a></div
<? }?>
<a href="/main.php?edit=1"><IMG border=0 src="http://img.yourc.com/i/shadow/<?=$user['sex']?>/<?print"".$user['shadow']."";?>" width=120 height=218 onmouseout='ghideshow();'  onmouseover='gfastshow("<?=$user['login']?> (Перейти в \"Инвентарь\")");' ></a>
<?
$ch_eff1 = mysql_query ('SELECT * FROM `effects` WHERE  `owner` = '.$_SESSION['uid'].' and (`type`=188 or `type`=9998 or `type`=1000 or `type`=9 or `type`=99 or `type`=999 or `type`=9999 or `type`=99999 or `type`=99799 or `type`=9871 or `type`=901 or `type`=900 or `type`=750 or `type`=395 or  `type`=300 or `type`=301 or `type`=303 or `type`=304 or `type`=305 or `type`=306 or `type`=308 or `type`=311 or `type`=312 or `type`=313 or `type`=314 or `type`=315 or `type`=316 or `type`=317 or `type`=66766 or `type`=171717 or `type`=171718 or `type`=171719 or `type`=171720 or `type`=201 or `type`=202 or `type`=1022)');
$i=0;
while($ch_eff = mysql_fetch_array($ch_eff1)){
$i++;
				switch ($i) {
					case '1':$left=0;$top=0;break;
					case '2':$left=40;$top=0;break;
					case '3':$left=80;$top=0;break;
					case '4':$left=0;$top=25;break;
					case '5':$left=40;$top=25;break;
					case '6':$left=80;$top=25;break;
					case '7':$left=0;$top=50;break;
					case '8':$left=40;$top=50;break;
					case '9':$left=80;$top=50;break;
					case '10':$left=0;$top=75;break;
					case '11':$left=40;$top=75;break;
					case '12':$left=80;$top=75;break;
				}
$inf_el = mysql_fetch_array(mysql_query ('SELECT img FROM `shop_cap` WHERE `name` = \''.$ch_eff['name'].'\';'));
if($ch_eff['type']==395){$inf_el['img']='defender.gif'; $opp='награда'; $chas=60; $chastxt="час.";}elseif($ch_eff['type']==303){$inf_el['img']='power_hp6.gif'; $opp='заклятие';  $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==304){$inf_el['img']='food_l5_eng.gif'; $opp='еда'; $chas=1;  $chastxt="мин.";}elseif($ch_eff['type']==305){$inf_el['img']='ruba1.gif'; $opp='еда'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==306){$inf_el['img']='apple.gif'; $opp='еда'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==314){$inf_el['img']='hleb1.gif'; $opp='еда'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==315){$inf_el['img']='standart_food.gif'; $opp='еда'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==316){$inf_el['img']='tortik1.gif'; $opp='еда'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==301){$inf_el['img']='spell_godprotect.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==300){$inf_el['img']='spell_godprotect10.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==308){$inf_el['img']='pot_base_100_master.gif'; $opp='эликсир'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==311){$inf_el['img']='spell_powerup3.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==312){$inf_el['img']='spell_powerup2.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==313){$inf_el['img']='spell_powerup4.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==9){$inf_el['img']='spell_stat_intel.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==99){$inf_el['img']='spell_godstat_inst.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==999){$inf_el['img']='spell_godstat_str.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==317){$inf_el['img']='pot_base_200_alldmg2.gif'; $opp='эликсир'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==9999){$inf_el['img']='spell_godstat_dex.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==99999){$inf_el['img']='invoke_spell_godintel100.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==99799){$inf_el['img']='invoke_spell_godmana100.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==9871){$inf_el['img']='invoke_movespeed_dungeon60_15.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==171717){$inf_el['img']='tz.gif'; $opp='книга'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==171718){$inf_el['img']='tz.gif'; $opp='книга'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==171719){$inf_el['img']='tz.gif'; $opp='книга'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==171720){$inf_el['img']='tz.gif'; $opp='книга'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==66766){$inf_el['img']='wis_light_shield.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==901){$inf_el['img']='power_hp5.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==900){$eff_image='blago_admin.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==750){$inf_el['img']='spell_powerup1.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==9998){$eff_image='blago_admin.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==201){$inf_el['img']='spell_protect10.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==202){$inf_el['img']='spell_powerup10.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==1022){$inf_el['img']='hidden.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}else{$opp='эликсир'; $chas=1; $chastxt="мин.";}

if($inf_el['img']!=""){$eff_image=$inf_el['img'];} else {
if($ch_eff['name']=="Снадобье Великана"){$inf_el['img']="pot_base_200_bot3.gif";}
if($ch_eff['name']=="Снадобье Змеи"){$inf_el['img']="pot_base_200_bot2.gif";}
if($ch_eff['name']=="Снадобье Предчувствия"){$inf_el['img']="pot_base_200_bot1.gif";}
if($ch_eff['name']=="Снадобье Разума"){$inf_el['img']="pot_base_200_bot4.gif";}
if($ch_eff['name']=="Нектар Могущества"){$eff_image="pot_base_50_str2.gif";}
if($ch_eff['name']=="Нектар Стремительности"){$eff_image="pot_base_50_dex2.gif";}
if($ch_eff['name']=="Нектар Прозрения"){$eff_image="pot_base_50_inst2.gif";}
if($ch_eff['name']=="Нектар Разума"){$eff_image="pot_base_50_intel2.gif";}
if($ch_eff['name']=="Защита от магии"){$eff_image="spell_protect_mag.gif";}
if($ch_eff['name']=="Новогодний Зелье"){$eff_image="pot_base_0_strup.gif";}
if($ch_eff['name']=="Новогоднее Зелье"){$eff_image="pot_base_0_strup.gif";}
if($ch_eff['name']=="Благословение звезд"){$eff_image="blago_admin.gif";}
if($ch_eff['name']=="Благословение Ангела"){$eff_image="blago_admin.gif";}
if($ch_eff['name']=="Холодный разум"){$eff_image="spell_stat_intel.gif";}
if($ch_eff['name']=="Жажда Жизни +5"){$eff_image="power_hp5.gif";}
if($ch_eff['name']=="Огненное Усиление"){$eff_image="spell_powerup1.gif";}
if($ch_eff['name']=="Сила Великана"){$eff_image="spell_godstat_str.gif";}
if($ch_eff['name']=="Скорость Змеи"){$eff_image="spell_godstat_dex.gif";}
if($ch_eff['name']=="Предчувствие"){$eff_image="spell_godstat_inst.gif";}
if($ch_eff['name']=="Ледяной Интеллек"){$eff_image="invoke_spell_godintel100.gif";}
if($ch_eff['name']=="Мудрость Веков"){$eff_image="invoke_spell_godmana100.gif";}
if($ch_eff['name']=="Мягкая Посыупь"){$eff_image="invoke_movespeed_dungeon60_15.gif";}
if($ch_eff['name']=="Неуязвимость Оружию"){$eff_image="spell_godprotect10.gif";}
if($ch_eff['name']=="Неуязвимость Стихиям"){$eff_image="spell_godprotect.gif";}
if($ch_eff['name']=="Жажда Жизни +6"){$eff_image="power_hp6.gif";}
if($ch_eff['name']=="Бутерброд -The Best Friend-"){$eff_image="food_l5_eng.gif";}
if($ch_eff['name']=="Жесткая Рыба"){$eff_image="ruba1.gif";}
if($ch_eff['name']=="Яблоко Раздора"){$eff_image="apple.gif";}
if($ch_eff['name']=="Снадобье Забытых Мастеров"){$eff_image="pot_base_100_master.gif";}
if($ch_eff['name']=="Воздушное усилиение"){$eff_image="spell_powerup3.gif";}
if($ch_eff['name']=="Водное усиление"){$eff_image="spell_powerup2.gif";}
if($ch_eff['name']=="Земное усиление"){$eff_image="spell_powerup4.gif";}
if($ch_eff['name']=="Хлеб с мясом"){$eff_image="hleb1.gif";}
if($ch_eff['name']=="Бутерброд"){$eff_image="standart_food.gif";}
if($ch_eff['name']=="Тортик"){$eff_image="tortik1.gif";}
if($ch_eff['name']=="Зелье Каменной Стойкости"){$eff_image="pot_base_200_alldmg2.gif";}
if($ch_eff['name']=="Тайный том 1"){$eff_image="tz.gif";}
if($ch_eff['name']=="Тайный том 2"){$eff_image="tz.gif";}
if($ch_eff['name']=="Тайный том 3"){$eff_image="tz.gif";}
if($ch_eff['name']=="Тайный том 4"){$eff_image="tz.gif";}
if($ch_eff['name']=="Право на Опыт"){$eff_image="wis_light_shield.gif";}
}
 ?>	<div style="position:absolute; left:<?=$left?>px; top:<?=$top?>px; width:120px; height:220px; z-index:2"><IMG width=40 height=25 src='http://img.yourc.com/i/misc/icon_<?=$eff_image?>' onmouseout='ghideshow();' onmouseover='gfastshow("<B><? echo $ch_eff['name'];?></B> (<?=$opp?>)<BR> осталось <? echo ceil(($ch_eff['time']-time())/60/$chas);?> <?=$chastxt?>")';> </div>

<?}
}elseif($show_pr){
if($zver){
?>
<div style="position:absolute; left:80px; top:145px; width:40px; height:73px; z-index:2">
<a href="zver_inv.php">
<IMG width=40 height=73 src='http://img.yourc.com/i/shadow/<?print"".$zver['shadow']."";?>' onmouseout='ghideshow();'  onmouseover='gfastshow("<?=$zver['login']?> [<?=$zver['level']?>] (Перейти к настройкам)");'>
</a></div>
<? }?>
<IMG border=0 src="http://img.yourc.com/i/shadow/<?=$user['sex']?>/<?print"".$user['shadow']."";?>" width=120 height=218 alt="<?=$strtxt?>"'>
<!--<IMG border=0 src="http://img.yourc.com/i/shadow/<?=$user['sex']?>/<?print"".$user['shadow']."";?>" width=120 height=218 onmouseout='ghideshow();'  onmouseover='gfastshow("<?=$strtxt?>");'>-->
<?
$ch_eff1 = mysql_query ('SELECT * FROM `effects` WHERE  `owner` = '.$_SESSION['uid'].' and (`type`=188 or `type`=9998 or `type`=1000 or `type`=9 or `type`=99 or `type`=999 or `type`=9999 or `type`=99999 or `type`=99799 or `type`=9871 or `type`=901 or `type`=900 or `type`=750 or `type`=395 or  `type`=300 or `type`=301 or `type`=303 or `type`=304 or `type`=305 or `type`=306 or `type`=308 or `type`=311 or `type`=312 or `type`=313 or `type`=314 or `type`=315 or `type`=316 or `type`=317 or `type`=66766 or `type`=171717 or `type`=171718 or `type`=171719 or `type`=171720 or `type`=201 or `type`=202 or `type`=1022)');
$i=0;
while($ch_eff = mysql_fetch_array($ch_eff1)){
$i++;
				switch ($i) {
					case '1':$left=0;$top=0;break;
					case '2':$left=40;$top=0;break;
					case '3':$left=80;$top=0;break;
					case '4':$left=0;$top=25;break;
					case '5':$left=40;$top=25;break;
					case '6':$left=80;$top=25;break;
					case '7':$left=0;$top=50;break;
					case '8':$left=40;$top=50;break;
					case '9':$left=80;$top=50;break;
					case '10':$left=0;$top=75;break;
					case '11':$left=40;$top=75;break;
					case '12':$left=80;$top=75;break;
				}
$inf_el = mysql_fetch_array(mysql_query ('SELECT img FROM `shop_cap` WHERE `name` = \''.$ch_eff['name'].'\';'));
if($ch_eff['type']==395){$inf_el['img']='defender.gif'; $opp='награда'; $chas=60; $chastxt="час.";}elseif($ch_eff['type']==303){$inf_el['img']='power_hp6.gif'; $opp='заклятие';  $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==304){$inf_el['img']='food_l5_eng.gif'; $opp='еда'; $chas=1;  $chastxt="мин.";}elseif($ch_eff['type']==305){$inf_el['img']='ruba1.gif'; $opp='еда'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==306){$inf_el['img']='apple.gif'; $opp='еда'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==314){$inf_el['img']='hleb1.gif'; $opp='еда'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==315){$inf_el['img']='standart_food.gif'; $opp='еда'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==316){$inf_el['img']='tortik1.gif'; $opp='еда'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==301){$inf_el['img']='spell_godprotect.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==300){$inf_el['img']='spell_godprotect10.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==308){$inf_el['img']='pot_base_100_master.gif'; $opp='эликсир'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==311){$inf_el['img']='spell_powerup3.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==312){$inf_el['img']='spell_powerup2.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==313){$inf_el['img']='spell_powerup4.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==9){$inf_el['img']='spell_stat_intel.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==99){$inf_el['img']='spell_godstat_inst.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==999){$inf_el['img']='spell_godstat_str.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==317){$inf_el['img']='pot_base_200_alldmg2.gif'; $opp='эликсир'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==9999){$inf_el['img']='spell_godstat_dex.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==99999){$inf_el['img']='invoke_spell_godintel100.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==99799){$inf_el['img']='invoke_spell_godmana100.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==9871){$inf_el['img']='invoke_movespeed_dungeon60_15.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==171717){$inf_el['img']='tz.gif'; $opp='книга'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==171718){$inf_el['img']='tz.gif'; $opp='книга'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==171719){$inf_el['img']='tz.gif'; $opp='книга'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==171720){$inf_el['img']='tz.gif'; $opp='книга'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==66766){$inf_el['img']='wis_light_shield.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==901){$inf_el['img']='power_hp5.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==900){$eff_image='blago_admin.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==750){$inf_el['img']='spell_powerup1.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==9998){$eff_image='blago_admin.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==201){$inf_el['img']='spell_protect10.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==202){$inf_el['img']='spell_powerup10.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==1022){$inf_el['img']='hidden.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}else{$opp='эликсир'; $chas=1; $chastxt="мин.";}

if($inf_el['img']!=""){$eff_image=$inf_el['img'];} else {
if($ch_eff['name']=="Снадобье Великана"){$inf_el['img']="pot_base_200_bot3.gif";}
if($ch_eff['name']=="Снадобье Змеи"){$inf_el['img']="pot_base_200_bot2.gif";}
if($ch_eff['name']=="Снадобье Предчувствия"){$inf_el['img']="pot_base_200_bot1.gif";}
if($ch_eff['name']=="Снадобье Разума"){$inf_el['img']="pot_base_200_bot4.gif";}
if($ch_eff['name']=="Нектар Могущества"){$eff_image="pot_base_50_str2.gif";}
if($ch_eff['name']=="Нектар Стремительности"){$eff_image="pot_base_50_dex2.gif";}
if($ch_eff['name']=="Нектар Прозрения"){$eff_image="pot_base_50_inst2.gif";}
if($ch_eff['name']=="Нектар Разума"){$eff_image="pot_base_50_intel2.gif";}
if($ch_eff['name']=="Защита от магии"){$eff_image="spell_protect_mag.gif";}
if($ch_eff['name']=="Новогодний Зелье"){$eff_image="pot_base_0_strup.gif";}
if($ch_eff['name']=="Новогоднее Зелье"){$eff_image="pot_base_0_strup.gif";}
if($ch_eff['name']=="Благословение звезд"){$eff_image="blago_admin.gif";}
if($ch_eff['name']=="Благословение Ангела"){$eff_image="blago_admin.gif";}
if($ch_eff['name']=="Холодный разум"){$eff_image="spell_stat_intel.gif";}
if($ch_eff['name']=="Жажда Жизни +5"){$eff_image="power_hp5.gif";}
if($ch_eff['name']=="Огненное Усиление"){$eff_image="spell_powerup1.gif";}
if($ch_eff['name']=="Сила Великана"){$eff_image="spell_godstat_str.gif";}
if($ch_eff['name']=="Скорость Змеи"){$eff_image="spell_godstat_dex.gif";}
if($ch_eff['name']=="Предчувствие"){$eff_image="spell_godstat_inst.gif";}
if($ch_eff['name']=="Ледяной Интеллек"){$eff_image="invoke_spell_godintel100.gif";}
if($ch_eff['name']=="Мудрость Веков"){$eff_image="invoke_spell_godmana100.gif";}
if($ch_eff['name']=="Мягкая Посыупь"){$eff_image="invoke_movespeed_dungeon60_15.gif";}
if($ch_eff['name']=="Неуязвимость Оружию"){$eff_image="spell_godprotect10.gif";}
if($ch_eff['name']=="Неуязвимость Стихиям"){$eff_image="spell_godprotect.gif";}
if($ch_eff['name']=="Жажда Жизни +6"){$eff_image="power_hp6.gif";}
if($ch_eff['name']=="Бутерброд -The Best Friend-"){$eff_image="food_l5_eng.gif";}
if($ch_eff['name']=="Жесткая Рыба"){$eff_image="ruba1.gif";}
if($ch_eff['name']=="Жесткая Рыба"){$eff_image="ruba1.gif";}
if($ch_eff['name']=="Яблоко Раздора"){$eff_image="apple.gif";}
if($ch_eff['name']=="Снадобье Забытых Мастеров"){$eff_image="pot_base_100_master.gif";}
if($ch_eff['name']=="Воздушное усилиение"){$eff_image="spell_powerup3.gif";}
if($ch_eff['name']=="Водное усиление"){$eff_image="spell_powerup2.gif";}
if($ch_eff['name']=="Земное усиление"){$eff_image="spell_powerup4.gif";}
if($ch_eff['name']=="Хлеб с мясом"){$eff_image="hleb1.gif";}
if($ch_eff['name']=="Бутерброд"){$eff_image="standart_food.gif";}
if($ch_eff['name']=="Тортик"){$eff_image="tortik1.gif";}
if($ch_eff['name']=="Зелье Каменной Стойкости"){$eff_image="pot_base_200_alldmg2.gif";}
if($ch_eff['name']=="Тайный том 1"){$eff_image="tz.gif";}
if($ch_eff['name']=="Тайный том 2"){$eff_image="tz.gif";}
if($ch_eff['name']=="Тайный том 3"){$eff_image="tz.gif";}
if($ch_eff['name']=="Тайный том 4"){$eff_image="tz.gif";}
if($ch_eff['name']=="Право на Опыт"){$eff_image="wis_light_shield.gif";}
}
 ?>	<div style="position:absolute; left:<?=$left?>px; top:<?=$top?>px; width:120px; height:220px; z-index:2"><IMG width=40 height=25 src='http://img.yourc.com/i/misc/icon_<?=$inf_el['img']?>' onmouseout='ghideshow();' onmouseover='gfastshow("<B><? echo $ch_eff['name'];?></B> (<?=$opp?>)<BR> еще <? echo ceil(($ch_eff['time']-time())/60/$chas);?> <?=$chastxt?>")';> </div>
<?}
$ch_priem1 = mysql_query ('SELECT pr_name,author FROM `person_on` WHERE (`battle`=0 or `battle`='.$user['battle'].') and ((`id_person` = '.$_SESSION['uid'].' and `pr_active`=2) or (`id_paladin`='.$_SESSION['uid'].' and `id_person` = 0 and `hodov`>0))');

while($ch_priem = mysql_fetch_array($ch_priem1)){
$i++;
				switch ($i) {
					case '1':$left=0;$top=0;break;
					case '2':$left=40;$top=0;break;
					case '3':$left=80;$top=0;break;
					case '4':$left=0;$top=25;break;
					case '5':$left=40;$top=25;break;
					case '6':$left=80;$top=25;break;
					case '7':$left=0;$top=50;break;
					case '8':$left=40;$top=50;break;
					case '9':$left=80;$top=50;break;
					case '10':$left=0;$top=75;break;
					case '11':$left=40;$top=75;break;
					case '12':$left=80;$top=75;break;
				}
$inf_priem = mysql_fetch_array(mysql_query ('SELECT name,opisan FROM `priem` WHERE `priem` = \''.$ch_priem['pr_name'].'\';'));
if($ch_priem['author']>0){$effe='эффект';}else{$effe='прием';}
 ?>
<div style="position:absolute; left:<?=$left?>px; top:<?=$top?>px; width:120px; height:220px; z-index:2"> 		<IMG width=40 height=25 src='i/priem/<?=$ch_priem['pr_name']?>.gif' onmouseout='hideshow();' onmouseover='fastshow("<B><? echo $inf_priem['name'];?></B> (<?=$effe?>)<BR><BR> <? echo $inf_priem['opisan'];?>")';> </div>
<?
}

if($balalaika==1){


$i++; 

				switch ($i) {

					case '1':$left=0;$top=0;break;

					case '2':$left=40;$top=0;break;

					case '3':$left=80;$top=0;break;

					case '4':$left=0;$top=25;break;

					case '5':$left=40;$top=25;break;

					case '6':$left=80;$top=25;break;

					case '7':$left=0;$top=50;break;

					case '8':$left=40;$top=50;break;

					case '9':$left=80;$top=50;break;

					case '10':$left=0;$top=75;break;

					case '11':$left=40;$top=75;break;

					case '12':$left=80;$top=75;break;
					
					case '13':$left=0;$top=100;break;

					case '14':$left=40;$top=100;break;

					case '15':$left=80;$top=100;break;

					case '16':$left=0;$top=125;break;

					case '17':$left=40;$top=125;break;

					case '18':$left=80;$top=125;break;
					
					case '19':$left=0;$top=150;break;
					
					case '20':$left=40;$top=150;break;

					case '21':$left=80;$top=150;break;
					
					case '22':$left=0;$top=175;break;

					case '23':$left=40;$top=175;break;

					case '24':$left=80;$top=175;break;

					case '25':$left=0;$top=200;break;

					case '26':$left=40;$top=200;break;

					case '27':$left=80;$top=200;break;

				}

 ?>	

<div style="position:absolute; left:<?=$left?>px; top:<?=$top?>px; width:120px; height:218px; z-index:2"> 		<IMG width=40 height=25 src="http://img.yourc.com/i/misc/ico_pet_<?=$engnah?>.gif" onmouseout='hideshow();' onmouseover='fastshow("<B><? echo $rus_n;?></B> (заклятье)<BR><BR> <? echo $rus_n2;?> +<? echo $zver['level'];?>")';> </div>

<?


}
}elseif($zver){
?>
<div style="position:absolute; left:80px; top:145px; width:40px; height:73px; z-index:2">
<IMG width=40 height=73 src='http://img.yourc.com/i/shadow/<?print"".$zver['shadow']."";?>' alt="<?print"".$zver['login']."";?> [<?print"".$zver['level']."";?>]">
</div>
<IMG border=0 src="http://img.yourc.com/i/shadow/<?=$user['sex']?>/<?print"".$user['shadow']."";?>" width=120 height=218>
<?}elseif($battle && $invis){?>
<IMG border=0 src="http://img.yourc.com/i/shadow/invis.gif" width=120 height=218 onmouseout='ghideshow();'  onmouseover='gfastshow("<?=$strtxt?>");'>
<?}elseif($battle){
if($zver){
?>
<div style="position:absolute; left:60px; top:118px; width:120px; height:220px; z-index:2">
<a href="zver_inv.php">
<IMG width=40 height=73 src='http://img.yourc.com/i/shadow/<?print"".$zver['shadow']."";?>' alt="alt="<?print"".$zver['login']."";?> [<?print"".$zver['level']."";?>] (Перейтик настройкам)">
</a></div>
<? }?>
<IMG border=0 src="http://img.yourc.com/i/shadow/<?=$user['sex']?>/<?print"".$user['shadow']."";?>" width=120 height=218 onmouseout='ghideshow();'  onmouseover='gfastshow("<?=$strtxt?>");'>
<?}else{?>

<IMG border=0 src="http://img.yourc.com/i/shadow/<?=$user['sex']?>/<?print"".$user['shadow']."";?>" width=120 height=218>
<?}?>
<DIV style="Z-INDEX: 2; POSITION: absolute; WIDTH: 120px; HEIGHT: 220px; TOP: 0px; LEFT: 0px"></DIV></DIV></TD></TR>
<TR><TD>
<?
if($battle )
{
?>
						<table width="120" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td width="40" height="20">
<?
			echokarman('karman1'); 
	?>
<td width="40" height="20"><img src="http://img.yourc.com//i/w15.gif" /></td>
<td width="40" height="20">
<?
			echokarman('karman2'); 
	?>


<tr>
						  <td width="40" height="20"><img src="http://img.yourc.com/i/w20.gif" /></td>
						  <td width="40" height="20"><img src="http://img.yourc.com/i/w20.gif" /></td>
						  <td width="40" height="20"><img src="http://img.yourc.com/i/w20.gif" /></td>
						</tr>
					  </table>






<?
}
elseif(!$battle)
{
?>
	<table width="120" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td width="40" height="20">
<?
			echokarman('karman1'); 
	?>
<td width="40" height="20"><img src="http://img.yourc.com//i/w15.gif" /></td>
<td width="40" height="20">
<?
			echokarman('karman2'); 
	?>


<tr>
						  <td width="40" height="20"><img src="http://img.yourc.com/i/w20.gif" /></td>
						  <td width="40" height="20"><img src="http://img.yourc.com/i/w20.gif" /></td>
						  <td width="40" height="20"><img src="http://img.yourc.com/i/w20.gif" /></td>
						</tr>
					  </table>
<?}?>
</TD></TR></TABLE></TD>
<TD><TABLE border=0 cellSpacing=0 cellPadding=0 width="100%"><TBODY>
<TR><TD style="BACKGROUND-IMAGE: none">

<?php
    if($battle && $invis && $user['id'] != $_SESSION['uid']) {
		if ($user['sergi'] >= 0) {

			echo '<img src="http://img.yourc.com/i/serg.gif" width=60 height=20>';
		}
	?></TD></TR>
<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['kulon'] >= 0) {

			echo '<img src="http://img.yourc.com/i/ojur.gif" width=60 height=20>';
		}
	?></TD></TR>

<TR><TD><TABLE border=0 cellSpacing=0 cellPadding=0>
<TBODY> <TR>
<TD style="BACKGROUND-IMAGE: none"><?php
		if ($user['r1'] >= 0) {
			echo '<img src="http://img.yourc.com/i/ring.gif" width=20 height=20>';
		}
	?></td>
<TD style="BACKGROUND-IMAGE: none"><?php
		if ($user['r2'] >= 0) {
			echo '<img src="http://img.yourc.com/i/ring.gif" width=20 height=20>';
		}
	?></td>
<TD style="BACKGROUND-IMAGE: none"><?php
		if ($user['r3'] >= 0) {
			echo '<img src="http://img.yourc.com/i/ring.gif" width=20 height=20>';
		}
	?></td>
</TR></TBODY></TABLE></TD></TR>
<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['perchi'] >= 0) {
			echo '<img src="http://img.yourc.com/i/perchi.gif" width=60 height=40>';
		}
	?></TD></TR>
<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['shit'] >= 0) {
			echo '<img src="http://img.yourc.com/i/shit.gif" width=60 height=60>';
		}
	?></TD></TR>
<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['leg'] >= 0) {
			echo '<img src="http://img.yourc.com/i/leg.gif" width=60 height=80>';
		}
	?></TD></TR>
<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['boots'] >= 0) {
			echo '<img src="http://img.yourc.com/i/boots.gif" width=60 height=40>';
		}
		}else{?>
<?php
		if ($user['sergi'] > 0 && ($user['bot']==0)) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['sergi']}' LIMIT 1;"));
			if ($dress['includemagicdex'] or $dress['magic']>0 && (!$pas OR ($battle AND $me))) {
				showhrefmagic($dress, $me);
			} else {
				if($dress['artefact']!=0 or $dress['ecost']>0){$art="&a=1";}else{$art="";}
				echo '<a href="/library.php?id='.$dress['prototype'].$art.'" target=_blank><img '.((($dress['maxdur']-2)<=$dress['duration'] && $dress['duration'] > 2 && !$pas)?" style='background-image:url(http://img.yourc.com/i/blink.gif);' ":"").' src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=20 title="'
				."<b>".$dress['name']."</b>"

				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['text']!=null)?"\r\n<br/>На серьгах выгравировано '{$dress['text']}'":"")
				.'" alt="'."<b>".$dress['name']."</b>"
				."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				.(($dress['text']!=null)?"\r\n<br/>На серьгах выгравировано '{$dress['text']}'":"").'" ></a>';
			}
		}
		else
		{
			echo '<img src="http://img.yourc.com/i/w1.gif" width=60 height=20 alt="Пустой слот серьги" >';
		}
	?></TD></TR>
<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['kulon'] > 0 && ($user['bot']==0)) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['kulon']}' LIMIT 1;"));
			if ($dress['includemagicdex'] or $dress['magic']>0 && (!$pas OR ($battle AND $me))) {
				showhrefmagic($dress, $me);
			} else {
				if($dress['artefact']!=0 or $dress['ecost']>0){$art="&a=1";}else{$art="";}
				echo '<a href="/library.php?id='.$dress['prototype'].$art.'" target=_blank><img  '.((($dress['maxdur']-2)==$dress['duration'] && $dress['duration'] > 2 && !$pas)?" style='background-image:url(http://img.yourc.com/i/blink.gif);' ":"").' src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=20 title="'
				."<b>".$dress['name']."</b>"

				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['text']!=null)?"\r\n<br/>На ожерелье выгравировано '{$dress['text']}'":"")
				.'" alt="'."<b>".$dress['name']."</b>"."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				.(($dress['text']!=null)?"\r\n<br/>На ожерелье выгравировано '{$dress['text']}'":"").'" ></a>';
			}
		}
		else
		{
			echo '<img src="http://img.yourc.com/i/w2.gif" width=60 height=20 alt="Пустой слот ожерелье" >';
		}
	?></TD></TR>

<TR><TD><TABLE border=0 cellSpacing=0 cellPadding=0>
<TBODY> <TR>
<TD style="BACKGROUND-IMAGE: none"><?php
		if ($user['r1'] > 0 && ($user['bot']==0)) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['r1']}' LIMIT 1;"));
			if ($dress['includemagicdex'] or $dress['magic']>0 && (!$pas OR ($battle AND $me))) {
				showhrefmagic($dress, $me);
			} else {
				if($dress['artefact']!=0 or $dress['ecost']>0){$art="&a=1";}else{$art="";}
				echo '<a href="/library.php?id='.$dress['prototype'].$art.'" target=_blank><img  '.((($dress['maxdur']-2)<=$dress['duration'] && $dress['duration'] > 2 && !$pas)?" style='background-image:url(i/blink.gif);' ":"").' src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=20 height=20 title="'
				."<b>".$dress['name']."</b>"

				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['text']!=null)?"\r\n<br/>На кольце выгравировано '{$dress['text']}'":"")
				.'" alt="'.$dress['name']."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				.(($dress['text']!=null)?"\r\n<br/>На кольце выгравировано '{$dress['text']}'":"").'" ></a>';
			}
		}
		else
		{
			echo '<img src="http://img.yourc.com/i/w6.gif" width=20 height=20 alt="Пустой слот кольцо" >';
		}
	?></td>
<TD style="BACKGROUND-IMAGE: none"><?php
		if ($user['r2'] > 0 && ($user['bot']==0)) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['r2']}' LIMIT 1;"));
			if ($dress['includemagicdex'] or $dress['magic']>0 && (!$pas OR ($battle AND $me))) {
				showhrefmagic($dress, $me);
			} else {
				if($dress['artefact']!=0 or $dress['ecost']>0){$art="&a=1";}else{$art="";}
				echo '<a href="/library.php?id='.$dress['prototype'].$art.'" target=_blank><img  '.((($dress['maxdur']-2)<=$dress['duration'] && $dress['duration'] > 2 && !$pas)?" style='background-image:url(i/blink.gif);' ":"").' src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=20 height=20 title="'
				."<b>".$dress['name']."</b>"
								.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""

				.(($dress['text']!=null)?"\r\n<br/>На кольце выгравировано '{$dress['text']}'":"")
				.'" alt="'.$dress['name']."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				.(($dress['text']!=null)?"\r\n<br/>На кольце выгравировано '{$dress['text']}'":"").'" ></a>';
			}
		}
		else
		{
			echo '<img src="http://img.yourc.com/i/w6.gif" width=20 height=20 alt="Пустой слот кольцо" >';
		}
	?></td>
<TD style="BACKGROUND-IMAGE: none"><?php
		if ($user['r3'] > 0 && ($user['bot']==0)) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['r3']}' LIMIT 1;"));
			if ($dress['includemagicdex'] or $dress['magic']>0 && (!$pas OR ($battle AND $me))) {
				showhrefmagic($dress, $me);
			} else {
				if($dress['artefact']!=0 or $dress['ecost']>0){$art="&a=1";}else{$art="";}
				echo '<a href="/library.php?id='.$dress['prototype'].$art.'" target=_blank><img  '.((($dress['maxdur']-2)<=$dress['duration'] && $dress['duration'] > 2 && !$pas)?" style='background-image:url(i/blink.gif);' ":"").' src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=20 height=20 title="'
				."<b>".$dress['name']."</b>"

				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['text']!=null)?"\r\n<br/>На кольце выгравировано '{$dress['text']}'":"")
				.'" alt="'.$dress['name']."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				.(($dress['text']!=null)?"\r\n<br/>На кольце выгравировано '{$dress['text']}'":"").'" ></a>';
			}
		}
		else
		{
			echo '<img src="http://img.yourc.com/i/w6.gif" width=20 height=20 alt="Пустой слот кольцо" >';
		}
	?></td>
</TR></TBODY></TABLE></TD></TR>
<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['perchi'] > 0 && ($user['bot']==0)) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['perchi']}' LIMIT 1;"));
			if ($dress['includemagicdex'] or $dress['magic']>0 && (!$pas OR ($battle AND $me))) {
				showhrefmagic($dress, $me);
			} else {
				if($dress['artefact']!=0 or $dress['ecost']>0){$art="&a=1";}else{$art="";}
				echo '<a href="/library.php?id='.$dress['prototype'].$art.'" target=_blank><img  '.((($dress['maxdur']-2)<=$dress['duration'] && $dress['duration'] > 2 && !$pas)?" style='background-image:url(i/blink.gif);' ":"").' src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=40 title="'
				."<b>".$dress['name']."</b>"

				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['text']!=null)?"\r\n<br/>На перчатках выгравировано '{$dress['text']}'":"")
				.'" alt="'."<b>".$dress['name']."</b>"."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				.(($dress['text']!=null)?"\r\n<br/>На перчатках выгравировано '{$dress['text']}'":"").'" ></a>';
			}
		}
		else
		{
			echo '<img src="http://img.yourc.com/i/w11.gif" width=60 height=40 alt="Пустой слот перчатки" >';
		}
	?></TD></TR>
<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['shit'] > 0 && ($user['bot']==0)) {
			if($user['weap']==$user['shit']){
				$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['shit']}' LIMIT 1;"));
				if ($dress['includemagicdex'] or $dress['magic']>0 && (!$pas OR ($battle AND $me))) {
					showhrefmagic($dress, $me);
				} else {
					if($dress['artefact']!=0 or $dress['ecost']>0){$art="&a=1";}else{$art="";}
				echo '<a href="/library.php?id='.$dress['prototype'].$art.'" target=_blank><img  '.((($dress['maxdur']-2)<=$dress['duration'] && $dress['duration'] > 2 && !$pas)?" style='background-image:url(http://img.yourc.com/i/blink.gif);' ":"").' src="http://img.yourc.com/i/w3.gif" width=60 height=60 title="'
					."<b>".$dress['name']."</b>"

					.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
					.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
					.(($dress['minu']>0)?"\r\n<br/>Урон: {$dress['minu']}-{$dress['maxu']}":"")
					."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
					.(($dress['text']!=null)?"\r\n<br/>На щите выгравировано '{$dress['text']}'":"")
					.'" alt="'.$dress['name']."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
					.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
					.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
					.(($dress['text']!=null)?"\r\n<br/>На щите выгравировано '{$dress['text']}'":"").'" >';
				}
			}else{
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['shit']}' LIMIT 1;"));
			if ($dress['includemagicdex'] or $dress['magic']>0 && (!$pas OR ($battle AND $me))) {
				showhrefmagic($dress, $me);
			} else {
				if($dress['artefact']!=0 or $dress['ecost']>0){$art="&a=1";}else{$art="";}
				echo '<a href="/library.php?id='.$dress['prototype'].$art.'" target=_blank><img  '.((($dress['maxdur']-2)<=$dress['duration'] && $dress['duration'] > 2 && !$pas)?" style='background-image:url(i/blink.gif);' ":"").' src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=60 title="'
				."<b>".$dress['name']."</b>"

				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				.(($dress['minu']>0)?"\r\n<br/>Урон: {$dress['minu']}-{$dress['maxu']}":"")
				."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['text']!=null)?"\r\n<br/>На щите выгравировано '{$dress['text']}'":"")
				.'" alt="'.$dress['name']."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				.(($dress['text']!=null)?"\r\n<br/>На щите выгравировано '{$dress['text']}'":"").'" ></a>';
			}
			}
		}
		else
		{
			echo '<img src="http://img.yourc.com/i/w10.gif" width=60 height=60 alt="Пустой слот щит" >';
		}
	?></TD></TR>
<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['leg'] > 0 && ($user['bot']==0)) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['leg']}' LIMIT 1;"));
			if ($dress['includemagicdex'] or $dress['magic']>0 && (!$pas OR ($battle AND $me))) {
				showhrefmagic($dress, $me);
			} else {
				if($dress['artefact']!=0 or $dress['ecost']>0){$art="&a=1";}else{$art="";}
				echo '<a href="/library.php?id='.$dress['prototype'].$art.'" target=_blank><img  '.((($dress['maxdur']-2)<=$dress['duration'] && $dress['duration'] > 2 && !$pas)?" style='background-image:url(http://img.yourc.com/i/blink.gif);' ":"").' src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=80 title="'
				."<b>".$dress['name']."</b>"

				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['text']!=null)?"\r\n<br/>На поножах выгравировано '{$dress['text']}'":"")
				.'" alt="'.$dress['name']."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				.(($dress['text']!=null)?"\r\n<br/>На поножах выгравировано '{$dress['text']}'":"").'" ></a>';
			}
		}
		else
		{
			echo '<img src="http://img.yourc.com/i/w19.gif" width=60 height=80 alt="Пустой слот поножи" >';
		}
	?></TD></TR>
<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['boots'] > 0 && ($user['bot']==0)) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['boots']}' LIMIT 1;"));
			if ($dress['includemagicdex'] or $dress['magic']>0 && (!$pas OR ($battle AND $me))) {
				showhrefmagic($dress, $me);
			} else {
				if($dress['artefact']!=0 or $dress['ecost']>0){$art="&a=1";}else{$art="";}
				if (@!$dress['count']){
				echo '<a href="/library.php?id='.$dress['prototype'].$art.'" target=_blank><img  '.((($dress['maxdur']-2)<=$dress['duration'] && $dress['duration'] > 2 && !$pas)?" style='background-image:url(http://img.yourc.com/i/blink.gif);' ":"").' src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=40 title="';
				}else{
				echo '<a href="/library.php?id='.$dress['id'].$art.'" target=_blank><img  '.((($dress['maxdur']-2)<=$dress['duration'] && $dress['duration'] > 2 && !$pas)?" style='background-image:url(http://img.yourc.com/i/blink.gif);' ":"").' src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=40 title="';
				}
				if($dress['magic']>0){$magic = magicinf ($dress['magic']);}
  echo "<b>".$dress['name']."</b>"
                  	.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")

				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
			.(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['text']!=null)?"\r\n<br/>На ботинках выгравировано '{$dress['text']}'":"")
				.'" alt="'.$dress['name']."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].""
				.(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +{$dress['ghp']} (HP)":"")
				.(($dress['bron1']!=0)?"\r\n<br/>Броня головы: {$dress['bron11']}-{$dress['bron1']} (".(((($dress['bron11']-1)!=0)?($dress['bron11']-1)."+":""))."d".(1+$dress['bron1']-$dress['bron11']).")":"")
			.(($dress['bron2']!=0)?"\r\n<br/>Броня корпуса: {$dress['bron22']}-{$dress['bron2']} (".(((($dress['bron22']-1)!=0)?($dress['bron22']-1)."+":""))."d".(1+$dress['bron2']-$dress['bron22']).")":"")
			.(($dress['bron3']!=0)?"\r\n<br/>Броня пояса: {$dress['bron33']}-{$dress['bron3']} (".(((($dress['bron33']-1)!=0)?($dress['bron33']-1)."+":""))."d".(1+$dress['bron3']-$dress['bron33']).")":"")
			.(($dress['bron4']!=0)?"\r\n<br/>Броня ног: {$dress['bron44']}-{$dress['bron4']} (".(((($dress['bron44']-1)!=0)?($dress['bron44']-1)."+":""))."d".(1+$dress['bron4']-$dress['bron44']).")":"")
                  .(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +{$dress['gmana']}":"")
				.(($dress['magic']>0)?"\r\n<br/>Встроена магия: {$magic['name']}":"")
				.(($dress['text']!=null)?"\r\n<br/>На ботинках выгравировано '{$dress['text']}'":"").'" ></a>';
			}
		}
		else
		{
			echo '<img src="http://img.yourc.com/i/w12.gif" width=60 height=40 alt="Пустой слот обувь" >';
		}}
		?></TD></TR>

</TBODY></TABLE></TD></TR>


<? if (!$pas && !$battle && ($user['m1'] > 0 or $user['m2'] > 0 or $user['m3'] > 0 or $user['m4'] > 0 or $user['m5'] > 0 or $user['m6'] > 0 or $user['m7'] > 0 or $user['m8'] > 0 or $user['m9'] > 0 or $user['m10'] > 0 or $user['m11'] > 0 or $user['m12'] > 0 )) {?>

<TR>
	<TD colspan=3>
	<?
			echoscroll('m1'); echoscroll('m2'); echoscroll('m3'); echoscroll('m4'); echoscroll('m5');echoscroll('m6');

	?>
	</TD>
</TR>
<TR>
	<TD colspan=3>
	<?
		echoscroll('m7'); echoscroll('m8'); echoscroll('m9'); echoscroll('m10'); echoscroll('m11');echoscroll('m12');
	?>
	</TD>
</TR>
<? }?>

</TBODY></TABLE></TD></TR>
<TR><TD></TD>
<?


		$data = mysql_fetch_array(mysql_query("select * from `online` WHERE `date` >= ".(time()-60)." AND `id` = ".$user['id'].";"));


	?></A>
</TABLE>
</CENTER><CENTER>

<TABLE cellPadding=0 cellSpacing=0 width="100%">
        <TBODY>
		  <?
	if(!$battle){
?>
        <? if ($pas){ ?><TR>
		<?
		switch($user['incity']){
		case 'capitalcity': $city='Capital City'; break;
		case 'angelscity': $city='Angels City'; break;
        case 'demonscity': $city='Demons City'; break;
        case 'devilscity': $city='Devils City'; break;
        case 'oldcity':    $city='Old City'; break;
        case 'dungeon': $city='Abandonedplain'; break;
	    case 'emeraldscity': $city='Emeralds City'; break;	
        case 'suncity': $city='Sun City'; break;	
        }
		?>

          <TD align=middle colSpan=2><B><?=$city?></B></TD></TR>
        <TR>
          <TD colSpan=2>
		  <SMALL>
<?php
$online = mysql_fetch_array(mysql_query('SELECT u.* ,o.date,u.* ,o.real_time FROM `users` as u, `online` as o WHERE u.`id` = o.`id` AND u.`id` = \''.$user['id'].'\' LIMIT 1;'));

if ($data['id'] != null or ($user['id'] == 1 && vrag=="on")) {
				if($data['room'] > 500 && $data['room'] < 561) {
					$rrm = 'Башня смерти, участвует в турнире';
				}
				elseif($user['id']=="1") {
				$rrm="Центральная площадь";
				$vrag_b = mysql_fetch_array(mysql_query("SELECT `battle` FROM `bots` WHERE  `prototype` = 1 LIMIT 1 ;"));
                                $user['battle']=$vrag_b['battle'];
				}
				elseif($user['align']=="2.5" ) {
					$rrm= ;
               
                }
                
					
                 elseif($user['room']==406){
					$labirint_loc=mysql_fetch_array(mysql_query("SELECT `name` from labirint where `user_id`='".$user['id']."'"));
					$rrm=$labirint_loc[0];
					if($rrm=="Канализация 1 этаж"){$rrm="Канализация 1 этаж";}
					if($rrm=="Канализация 2 этаж"){$rrm="Канализация 2 этаж";}
				}
				elseif($user['room']==403){
					$labirint_loc=mysql_fetch_array(mysql_query("SELECT `name` from labirint where `user_id`='".$user['id']."'"));
					$rrm=$labirint_loc[0];
					if($rrm=="Пещера тысячи проклятий"){$rrm="Пещера тысячи проклятий";}
					if($rrm=="Пещера тысячи проклятий 2-Этаж"){$rrm="Пещера тысячи проклятий 2-Этаж";}
					if($rrm=="Пещера тысячи проклятий 3-Этаж"){$rrm="Пещера тысячи проклятий 3-Этаж";}
				}		
				
                else {
					
                 $rrm = $rooms[$data['room']];
				}
			
              echo '<center>Персонаж сейчас находится в клубе.</center><center><B>'.$rrm.'</B></center>';
			} else
			{

function getDateInterval($pointDate)
{
   $pointNow = time(); // получили метку текущего времени

   $times = array('year' => 60*60*24*365, 'month' =>60*60*24*31, 'week' =>60*60*24*7, 'day' => 60*60*24, 'hour' => 60*60, 'minute' => 60);

   $pointInterval = $pointDate > $pointNow ? $pointDate - $pointNow : $pointNow - $pointDate; // получили метку разности двух дат

   $returnDate = array(); // создаём пока пустой массив возвращаемой даты

   $returnDate['year'] = floor($pointInterval / $times['year']); // высчитываем годы
   $pointInterval = $pointInterval % $times['year']; // находим остаток

   $returnDate['month'] = floor($pointInterval / $times['month']); // высчитываем месяцы
   $pointInterval = $pointInterval % $times['month']; // находим остаток

   $returnDate['week'] = floor($pointInterval / $times['week']); // высчитываем недели
   $pointInterval = $pointInterval % $times['week']; // находим остаток

   $returnDate['day'] = floor($pointInterval / $times['day']); // высчитываем дни
   $pointInterval = $pointInterval % $times['day']; // находим остаток

   $returnDate['hour'] = floor($pointInterval / $times['hour']); // высчитываем часы
   $pointInterval = $pointInterval % $times['hour']; // находим остаток

   $returnDate['minute'] = floor($pointInterval / $times['minute']); // высчитываем минуты
   $pointInterval = $pointInterval % $times['minute']; // находим остаток


   return $returnDate;

}

$date = getDateInterval($online['date']);

function year_text($days) { # склонение слова "год"
	$s=substr($days,strlen($days)-1,1);
	if (strlen($days)>=2) {
		if (substr($days,strlen($days)-2,1)=='1') {return $days." лет ";$ok=true;}
	}if (!$ok) {
        if ($days==0){return "";}
	elseif ($s==0 or $s>=5) {return $days." лет ";}
	elseif ($s==1) {return $days." год ";}
	elseif ($s>=2 && $s<=4) {return $days." года ";}
	}
}
function month_text($days) { # склонение слова "месяц"
	$s=substr($days,strlen($days)-1,1);
	if (strlen($days)>=2) {
		if (substr($days,strlen($days)-2,1)=='1') {return $days." месяцев ";$ok=true;}
	}if (!$ok) {
        if ($days==0){return "";}
	elseif ($s==0 or $s>=5) {return $days." месяцев ";}
	elseif ($s==1) {return $days." месяц ";}
	elseif ($s>=2 && $s<=4) {return $days." месяца ";}
	}
}
function week_text($days) { # склонение слова "неделя"
	$s=substr($days,strlen($days)-1,1);
	if (strlen($days)>=2) {
		if (substr($days,strlen($days)-2,1)=='1') {return $days." недель ";$ok=true;}
	}if (!$ok) {
        if ($days==0){return "";}
	elseif ($s==0 or $s>=5) {return $days." недель ";}
	elseif ($s==1) {return $days." неделю ";}
	elseif ($s>=2 && $s<=4) {return $days." недели ";}
	}
}
function days_text($days) { # склонение слова "дней"
	$s=substr($days,strlen($days)-1,1);
	if (strlen($days)>=2) {
		if (substr($days,strlen($days)-2,1)=='1') {return $days." дней ";$ok=true;}
	}if (!$ok) {
        if ($days==0){return "";}
	elseif ($s==0 or $s>=5) {return $days." дней ";}
	elseif ($s==1) {return $days." день ";}
	elseif ($s>=2 && $s<=4) {return $days." дня ";}
	}
}
function hour_text($days) { # склонение слова "час"
	$s=substr($days,strlen($days)-1,1);
	if (strlen($days)>=2) {
		if (substr($days,strlen($days)-2,1)=='1') {return $days." часов ";$ok=true;}
	}if (!$ok) {
        if ($days==0){return "";}
	elseif ($s==0 or $s>=5) {return $days." часов ";}
	elseif ($s==1) {return $days." час ";}
	elseif ($s>=2 && $s<=4) {return $days." часа ";}
	}
}
function minute_text($days) { # склонение слова "минута"
	$s=substr($days,strlen($days)-1,1);
	if (strlen($days)>=2) {
		if (substr($days,strlen($days)-2,1)=='1') {return $days." минут ";$ok=true;}
	}if (!$ok) {
        if ($days==0){return "1 минуту";}
	elseif ($s==0 or $s>=5) {return $days." минут ";}
	elseif ($s==1) {return $days." минуту ";}
	elseif ($s>=2 && $s<=4) {return $days." минуты ";}
	}
}
$year = year_text($date['year']);
$month = month_text($date['month']);
$week = week_text($date['week']);
$days = days_text($date['day']);
$hour = hour_text($date['hour']);
$minute = minute_text($date['minute']);



if ($days>0 or $week>0 or $month>0 or $year>0){$minute="";}
if ($week>0 or $month>0 or $year>0){$hour="";}
if ($month>0 or $year>0){$week="";}

if($user['align']>2 && $user['align']<3 or $user['id']=="1"){echo"<center>Персонаж не в клубе</center>";}elseif($user['bot']=="1"){echo"<center> </center>";}elseif($user['invis']==1) {echo"<center>Персонаж не в клубе</center>";}

else{
				echo "<center>Персонаж не в клубе, но был тут:</center><center>".date("Y.m.d H:i", $online['date'])."<IMG src=\"http://img.c.ru/i/clok3_2.png\" alt=\"Время сервера\"></center>";
echo"<center>(".$year.$month.$week.$days.$hour.$minute." назад)</center>";
				}
			    }
               
                ?><?
			if ($user['battle'] > 0) {
				echo '<center>Персонаж сейчас в <a target=_blank href="logs.php?log=',$user['battle'],'">поединке</a></center>';
			}
			?></CENTER></SMALL></TD></TR><?  }


			?>
			</TBODY></TABLE></CENTER>


</TD>
	<TD valign=top <?=(!$pas?"style='width:350px;'":"")?>>
<table><tr><td><BR>
<?if($pas){
$user11 = mysql_query("SELECT gsila,glovk,ginta,gintel FROM `inventory` WHERE dressed = 1 AND owner = {$user['id']} ");
        while($user12 = mysql_fetch_array($user11)){
$sil=$sil+$user12['gsila'];
$lov=$lov+$user12['glovk'];
$int=$int+$user12['ginta'];
$intel=$intel+$user12['gintel'];
}
$user22 = mysql_query("SELECT sila,lovk,inta,intel FROM `effects` WHERE owner = {$user['id']} ");
        while($user33 = mysql_fetch_array($user22)){
if($user33['sila']>0){$sil=$sil+$user33['sila']; $cv_s="<FONT color=#000000>"; $cv_s2="</FONT>";}
if($user33['lovk']>0){$lov=$lov+$user33['lovk']; $cv_l="<FONT color=#000000>"; $cv_l2="</FONT>";}
if($user33['inta']>0){$int=$int+$user33['inta']; $cv_i="<FONT color=#000000>"; $cv_i2="</FONT>";}
if($user33['intel']>0){$intel=$intel+$user33['intel']; $cv_i="<FONT color=#000000>"; $cv_i2="</FONT>";}
}

$sil2 = $user['sila']-$sil;
$lov2 = $user['lovk']-$lov;
$int2 = $user['inta']-$int;
$intel2 = $user['intel']-$intel;

if($sil>0){if($sil2==0){$sil1=0.001;}else{$sil1=$sil2;}$stepen_s=floor(10*($sil/$sil1));if($stepen_s>9){$stepen_s=9;}}else{$stepen_s=0;}$cv_s="<FONT color=#00".$stepen_s."000>"; $cv_s2="</FONT>";
if($lov>0){if($lov2==0){$lov1=0.001;}else{$lov1=$lov2;}$stepen_l=floor(10*($lov/$lov1));if($stepen_l>9){$stepen_l=9;}}else{$stepen_l=0;}$cv_l="<FONT color=#00".$stepen_l."000>"; $cv_l2="</FONT>";
if($int>0){if($int2==0){$int1=0.001;}else{$int1=$int2;}$stepen_i=floor(10*($int/$int1));if($stepen_i>9){$stepen_i=9;}}else{$stepen_i=0;}$cv_i="<FONT color=#00".$stepen_i."000>"; $cv_i2="</FONT>";
if($intel>0){if($intel2==0){$intel1=0.001;}else{$intel1=$intel2;}$stepen_iq=floor(10*($intel/$intel1));if($stepen_iq>9){$stepen_iq=9;}}else{$stepen_iq=0;}$cv_iq="<FONT color=#00".$stepen_iq."000>"; $cv_iq2="</FONT>";


if($sil>0){$ss = "<small>(".$sil2." + ".$sil.")</small>";}
if($lov>0){$sl = "<small>(".$lov2." + ".$lov.")</small>";}
if($int>0){$si = "<small>(".$int2." + ".$int.")</small>";}
if($intel>0){$sii = "<small>(".$intel2." + ".$intel.")</small>";}
?>


Сила: <?=$cv_s?><b><?=$user['sila']?></b><?=$cv_s2?> <?=$ss?><BR>
Ловкость: <?=$cv_l?><b><?=$user['lovk']?></b><?=$cv_l2?> <?=$sl?><BR>
Интуиция: <?=$cv_i?><b><?=$user['inta']?></b><?=$cv_i2?> <?=$si?><BR>
Выносливость: <b><?=$user['vinos']?></b><BR>
<?php
if ($user['level'] > 3) {
?>
Интеллект: <?=$cv_iq?><b><?=$user['intel']?></b><?=$cv_iq2?> <?=$sii?><BR>
<?php
}
if ($user['level'] > 6) {
?>
Мудрость: <b><?=$user['mudra']?></b><BR>
<?php
}
if ($user['level'] > 9) {
?>
Духовность: <b><?=$user['spirit']?></b><BR>
<?php
}
if ($user['level'] > 12) {
?>
Воля: <b><?=$user['will']?></b><BR>
<?php
}
if ($user['level'] > 15) {
?>
Свобода духа: <b><?=$user['freedom']?></b><BR>
<?php
}
if ($user['level'] > 18) {
?>
Божественность: <b><?=$user['god']?></b><BR>
<?php
}
}else{

?>
Сила: <?=$user['sila']?><BR>
Ловкость: <?=$user['lovk']?><BR>
Интуиция: <?=$user['inta']?><BR>
Выносливость: <?=$user['vinos']?><BR>
<?php
if ($user['level'] > 3) {
?>
Интеллект: <?=$user['intel']?><BR>
<?php
}
if ($user['level'] > 6) {
?>
Мудрость: <?=$user['mudra']?><BR>
<?php
}
if ($user['level'] > 9) {
?>
Духовность: <?=$user['spirit']?><BR>
<?php
}
if ($user['level'] > 12) {
?>
Воля: <?=$user['will']?><BR>
<?php
}
if ($user['level'] > 15) {
?>
Свобода духа: <?=$user['freedom']?><BR>
<?php
}
if ($user['level'] > 18) {
?>
Божественность: <?=$user['god']?><BR>
<?php
}





}
if (!$pas && (($user['stats'] > 0) OR ($user['master'] > 0))) {
?>
&nbsp;<a href="umenie.php">+ Способности</a>
<?
}
?>

<?php
if ($pas){
?><HR><?
if ($_SESSION['uid'] == $id) {
?>
<small>Опыт: <b><?=$user['exp']?> </b> <a href='/exp.php' target=_blank> (<?=$user['nextup']?>)</a><BR></small>
<?}?>
<small>Уровень: <?=$user['level']?><BR></small>
<?if ($user['otnoshenie']) {
echo"";}?>
<?
if ($user['showmyinfo']) {
echo"<small>Побед: {$user['win']}<BR></small>
<small>Поражений: {$user['lose']}<BR></small>
<small>Ничьих: {$user['nich']}<BR></small>";}


}else{




if ($_SESSION['uid'] == $id) {
?>
<BR><BR>
Опыт: <b><?=$user['exp']?> </b> <a href='/exp.php' target=_blank> (<?=$user['nextup']?>)</a><BR>
<?}?>
Уровень: <?=$user['level']?><BR>
Побед: <?=$user['win']?><BR>
Поражений: <?=$user['lose']?><BR>
Ничьих: <?=$user['nich']?><BR>
<?
}
if (!$pas) {
?>
Деньги: <b><?=$user['money']?></b> кр.<BR>
Еврокредиты: <b><?=$user['ekr']?></b> екр.<BR>
<?if($user['level']>=4) {?>
Передачи: <?=$user['peredachi']?> <BR>
<?}?>


<?php
}
if($user['klan'] && !$pas) {
	echo "Клан: {$user['klan']}<BR>";
} elseif($user['klan']) {
	echo "<small>Клан: <a href='/claninf.php?".close_dangling_tags($user['klan'])."' target=_blank>".close_dangling_tags($user['klan'])."</a> - ".close_dangling_tags($user['status'])."<BR></small>";
} elseif($user['align'] > 0) {
	if (($user['align'] > 1) && ($user['align'] < 2)) { echo "<small><b>Паладинский орден</B> - <b>{$user['status']}</b><BR></small>"; }
	if (($user['align'] > 3) && ($user['align'] < 4)) { echo "<small><b>Армада</B> - <b>{$user['status']}</b><BR></small>"; }
	if (($user['align'] == 3)) { echo "<small><b>Темное братство</B><BR>"; }
	if (($user['align'] == 2)) { echo "<small><b>Нейтральное братство</B><BR>"; }
	if (($user['align'] == 7.01)) { echo "<small><b>Орден Очищения Стихий - Мастер Очищения Огня</B><BR></small>"; }
	if (($user['align'] == 7.02)) { echo "<small><b>Орден Очищения Стихий - Мастер Очищения Воды</B><BR></small>"; }
	if (($user['align'] == 7.03)) { echo "<small><b>Орден Очищения Стихий - Мастер Очищения Воздуха</B><BR></small>"; }
	if (($user['align'] == 7.04)) { echo "<small><b>Орден Очищения Стихий - Мастер Очищения Земли</B><BR></small>"; }
}

if ($pas) {
$date1 = explode(" ", $user['borntime']);
$date2 = explode("-", $date1[0]);
$date3 = "".$date2[2].".".$date2[1].".".$date2[0]."".$date2[3]."";
?>
<small>Место рождения:   <b><?=$user['borncity']?></b><BR></small>
<?if ($user['secondgraj']) {
echo"<small>Второе гражданство:<b> {$user['secondgraj']}</b><BR></small>";}?>
<?if ($user['bejenec']) {
echo"<small>Беженец из:<b> {$user['bejenec']}</b><BR></small>";}?>
<?if ($user['icq1']) {
echo"<small>ICQ:<b> {$user['icq1']}</b> <img src=http://img.yourc.com/i/icq.gif title=ICQ></small>";}?> 
<?if ($user['skype1']) {
echo"<small>Skype:<b> {$user['skype1']}</b> <img src=http://img.yourc.com/i/skype1.gif title=Skype><BR></small>";}?>
<?if ($user['sms']) {
echo"<marquee>{$user['sms']}</marquee><BR>";}?>
<?if ($user['otnoshenie']) {
echo"<small>День рождения персонажа: до начала времен...<BR></small>";}?>
<?
if ($user['showmyinfo']) {
echo"<small>День рождения персонажа: {$user['borntime']}<BR></small>";}?>
<?
//if ($user['namehistory']) {
if ($user['loginhistory']) {
echo "<small>История имен: ";
$log_his=explode(";",$user['loginhistory']);
$c=count($log_his);
foreach($log_his as $login){
$c=$c-1;
$log_date=explode("||",$login);
echo "\"{$log_date[0]}\" до <i>{$log_date[1]}</i>";
if($c>=1){echo "<br>";}
}
echo "</small><br>";
}?>
<hr>
<?

	if($user['palcom'] && $pas) {
		echo "Сообщение от паладинов:<BR><FONT class=private>";
		echo stripslashes($user['palcom'])."</font>";
	}
	$effect = mysql_fetch_array(mysql_query("SELECT `time`,`type` FROM `effects` WHERE `owner` = '{$user['id']}' and (`type` = '4' or `type` = '21') LIMIT 1;"));
	if ($effect['time']) {
		$eff=$effect['time'];
		$tt=time();
		$time_still=$eff-$tt;
		$tmp = floor($time_still/2592000);
	$id=0;
	if ($tmp > 0) {
		$id++;
		if ($id<3) {$out .= $tmp." мес. ";}
		$time_still = $time_still-$tmp*2592000;
	}
	$tmp = floor($time_still/604800);
	if ($tmp > 0) {
		$id++;
		if ($id<3) {$out .= $tmp." нед. ";}
		$time_still = $time_still-$tmp*604800;
	}
	$tmp = floor($time_still/86400);
	if ($tmp > 0) {
		$id++;
		if ($id<3) {$out .= $tmp." дн. ";}
		$time_still = $time_still-$tmp*86400;
	}
	$tmp = floor($time_still/3600);
	if ($tmp > 0) {
		$id++;
		if ($id<3) {$out .= $tmp." ч. ";}
		$time_still = $time_still-$tmp*3600;
	}
	$tmp = floor($time_still/60);
	if ($tmp > 0) {
		$id++;
		if ($id<3) {$out .= $tmp." мин. ";}
	}
if ($effect['type']=='21') {
		echo "<br>В заточении еще <i>$out</i>";
}else{		echo "<br>Хаос еще <i>$out</i>";}
	}
}


?>
</td></tr></table><?}
else {
?>
</table>
 <?
}
}

function showitem ($row,$i) {
	if((($row['maxdur'] <= ($row['duration'])) OR ($row['dategoden'] && $row['dategoden'] <= time())))
	{
		destructitem($row['id']);
	}
	$magic = magicinf ($row['magic']);
	$incmagic = mysql_fetch_array(mysql_query('SELECT * FROM `magic` WHERE `id` = \''.$row['includemagic'].'\' LIMIT 1;'));
	$incmagic['name'] = $row['includemagicname'];
	$incmagic['cur'] = $row['includemagicdex'];
	$incmagic['max'] = $row['includemagicmax'];
	if(!$magic){
		$magic['chanse'] = $incmagic['chanse'];
		$magic['time'] = $incmagic['time'];
		$magic['targeted'] = $incmagic['targeted'];
	}
	global $user;

	$zetons = mysql_fetch_array(mysql_query("SELECT koll FROM `inventory` WHERE `type`='200' and `name`='Жетон' and owner='".$user["id"]."'"));
	$ser_zetons = mysql_fetch_array(mysql_query("SELECT koll FROM `inventory` WHERE `type`='200' and `name`='Серебрянный Жетон' and owner='".$user["id"]."'"));
	$zol_zeton = mysql_fetch_array(mysql_query("SELECT koll FROM `inventory` WHERE `type`='200' and `name`='Золотой Жетон' and owner='".$user["id"]."'"));
	$xrustal = mysql_fetch_array(mysql_query("SELECT koll FROM `inventory` WHERE `type`='200' and `name`='Хрусталь' and owner='".$user["id"]."'"));
    $almaz = mysql_fetch_array(mysql_query("SELECT koll FROM `inventory` WHERE `type`='200' and `name`='Алмаз' and owner='".$user["id"]."'"));
    $mox = mysql_fetch_array(mysql_query("SELECT koll FROM `inventory` WHERE `type`='200' and `name`='Пещерный Мох' and owner='".$user["id"]."'"));
    $braga = mysql_fetch_array(mysql_query("SELECT koll FROM `inventory` WHERE `type`='200' and `name`='Брага' and owner='".$user["id"]."'"));
    $bur = mysql_fetch_array(mysql_query("SELECT koll FROM `inventory` WHERE `type`='200' and `name`='Бур' and owner='".$user["id"]."'"));
    $costi = mysql_fetch_array(mysql_query("SELECT koll FROM `inventory` WHERE `type`='200' and `name`='Кости' and owner='".$user["id"]."'"));
    $autvais = mysql_fetch_array(mysql_query("SELECT koll FROM `inventory` WHERE `type`='200' and `name`='Аутвайс' and owner='".$user["id"]."'"));
    $kamen = mysql_fetch_array(mysql_query("SELECT koll FROM `inventory` WHERE `type`='200' and `name`='Драконий Камень' and owner='".$user["id"]."'"));
    $granit = mysql_fetch_array(mysql_query("SELECT koll FROM `inventory` WHERE `type`='200' and `name`='Гранит' and owner='".$user["id"]."'"));
    $cvetok = mysql_fetch_array(mysql_query("SELECT koll FROM `inventory` WHERE `type`='200' and `name`='Подгорный Эдельвейс' and owner='".$user["id"]."'"));
    $klik = mysql_fetch_array(mysql_query("SELECT koll FROM `inventory` WHERE `type`='200' and `name`='Клык Проклятья Глубин' and owner='".$user["id"]."'"));
    $amulet = mysql_fetch_array(mysql_query("SELECT koll FROM `inventory` WHERE `type`='200' and `name`='Амулет Пустынника' and owner='".$user["id"]."'"));
    $zelie = mysql_fetch_array(mysql_query("SELECT koll FROM `inventory` WHERE `type`='200' and `name`='Зелье Пустынника' and owner='".$user["id"]."'"));
    $trapio = mysql_fetch_array(mysql_query("SELECT koll FROM `inventory` WHERE `type`='200' and `name`='Тряпье' and owner='".$user["id"]."'"));


// if shop
	if (@!$row['count']) {
	if ($i==0) { $i = 1; $color = 'transparent'; } else { $i = 0; $color = 'transparent'; }
		echo "<TR bgcolor='".$color."'><TD bgcolor='".$color."' align=center width=100>";
		if ($incmagic['max']) {
			echo "<img src='mg2.php?p=".($incmagic['cur']/$incmagic['max']*100)."&i={$row['img']}' style=\"filter:shadow(color=red, direction=90, strength=3);\"><BR>";//<img ".((($row['maxdur']-2)<=$row['duration']  && $dress['duration'] > 2)?" style='background-image:url(http://img.yourc.com/i/blink.gif);' ":"")." src='http://img.yourc.com/i/sh/{$row['img']}' style=\"margin:0px,0px,-100000%,0px;\"><BR>
		} else {
			if($row['type']!=25 and $row['type']!=29 and  $row['type']!=2 and $row['type']!=23 and $row['type']!=5 and $row['type']!=22 and $row['type']!=1 and $row['type']!=11 and $row['type']!=9){

				$size = getimagesize("http://img.yourc.com/i/sh/".$row['img']);
				$st_=" width:{$size[0]}px; height:{$sizeх[1]}px;";
				}
				else{$st_="";}
			echo "<span style=\"position:relative; {$st_} vertical-align : bottom\"><img ".((($row['maxdur']-2)<=$row['duration']  && $dress['duration'] > 2)?" style='background-image:url(http://img.yourc.com/i/blink.gif);' ":"")." src='http://img.yourc.com/i/sh/{$row['img']}'>";if($row['koll']>1){echo "<small style=\"background-color: transparent; position: absolute; right: 1; bottom: 4;\"><B>x{$row['koll']}</B></small>";}echo "</span><BR>";
		}
            if (($user['sila'] >= $row['nsila']) &&
			($user['lovk'] >= $row['nlovk']) &&
			($user['inta'] >= $row['ninta']) &&
			($user['vinos'] >= $row['nvinos']) &&
			($user['intel'] >= $row['nintel']) &&
			($user['mudra'] >= $row['nmudra']) &&
			($user['level'] >= $row['nlevel']) &&
			(((int)$user['align'] == $row['nalign']) OR ($row['nalign'] == 0)) &&
			($user['noj'] >= $row['nnoj']) &&
			($user['topor'] >= $row['ntopor']) &&
			($user['dubina'] >= $row['ndubina']) &&
			($user['mec'] >= $row['nmech']) &&
			($user['posoh'] >= $row['nposoh']) &&
			($user['mfire'] >= $row['nfire']) &&
			($user['mwater'] >= $row['nwater']) &&
			($user['mair'] >= $row['nair']) &&
			($user['mearth'] >= $row['nearth']) &&
			($user['mlight'] >= $row['nlight']) &&
			($user['mgray'] >= $row['ngray']) &&
			($user['mdark'] >= $row['ndark']) &&
			($row['type'] <=29 OR ($row['type']==50) OR ($row['type']==30))&&
			($row['needident'] == 0)
			)
		{
			if (($row['type']==25) OR ($row['type']==29) OR ($row['magic']) OR ($incmagic['cur']) OR ($row['type']==30)) {
				
				echo "<a  onclick=\"";
				if($magic['id']==43) {
					echo "okno('Название встраиваемого свитка', 'main.php?edit=1&use={$row['id']}', 'target')";
				}elseif($magic['targeted']==1) {
					echo "okno('Введите название предмета', 'main.php?edit=1&use={$row['id']}', 'target')";
				}elseif($magic['targeted']==2) {
					echo "findlogin('Введите имя персонажа', 'main.php?edit=1&use={$row['id']}', 'target')";
				}elseif($magic['targeted']==3) {
					echo "oknos('Введите имя зверя', 'main.php?edit=1&use={$row['id']}', 'target')";
				}elseif($magic['targeted']==4) {
					echo "note('Запрос', 'main.php?edit=1&use={$row['id']}', 'target')";
				}elseif($magic['targeted']==5) {
				echo "teleport('Введите название города', 'main.php?edit=1&use={$row['id']}', 'target')";
                }elseif($magic['targeted']==6) {
				echo "zamok('Замок для рюкзака', 'main.php?edit=1&use={$row['id']}', 'target')";
                }elseif($magic['targeted']==7) {
				echo "zapiski('Запрос', 'main.php?edit=1&use={$row['id']}', 'target')";
               
                 }else {
					echo "useElicMb('Использовать сейчас?', '', 0, '', '".$row['img']."', '".$row['name']."', 'main.php?edit=1&use=".$row['id']."');";
				}
				echo "\"href='#'>исп-ть</a><BR> ";

			}
			if (($row['type']!=50) && ($row['type']!=12) && ($row['type']!=30)) echo "<a href='?edit=1&dress={$row['id']}'>надеть</a> ";
		    
           }
		    elseif (($row['type']==50) OR ($row['type']==25) OR ($row['type']==29) OR ($row['type']==30) OR ($row['magic']) OR ($incmagic['cur'])) {
			
			echo "<a  onclick=\"";
			if($magic['id']==43) {
				echo "okno('Название встраиваемого свитка', 'main.php?edit=1&use={$row['id']}', 'target')";
			}elseif($magic['targeted']==1) {
				echo "okno('Введите название предмета', 'main.php?edit=1&use={$row['id']}', 'target')";
			}elseif($magic['targeted']==2) {
				echo "findlogin('Введите имя персонажа', 'main.php?edit=1&use={$row['id']}', 'target')";
			}elseif($magic['targeted']==3) {
				echo "oknos('Введите имя зверя', 'main.php?edit=1&use={$row['id']}', 'target')";
			}elseif($magic['targeted']==4) {
				echo "note('Запрос', 'main.php?edit=1&use={$row['id']}', 'target')";
			}elseif($magic['targeted']==5) {
				echo "teleport('Введите название города', 'main.php?edit=1&use={$row['id']}', 'target')";
                }elseif($magic['targeted']==6) {
				echo "zamok('Замок для рюкзака', 'main.php?edit=1&use={$row['id']}', 'target')";
                }elseif($magic['targeted']==7) {
				echo "zapiski('Запрос', 'main.php?edit=1&use={$row['id']}', 'target')";
               
            }else {
				echo "useElicMb('Использовать сейчас?', '', 0, '', '".$row['img']."', '".$row['name']."', 'main.php?edit=1&use=".$row['id']."');";
			}
			echo "\"href='#'>исп-ть</a><BR> ";
		}elseif ($row['res']>0) {
		echo "<a  onclick=\"oknores('Введите колличество', '?edit=1&res={$row['id']}', 'target')\" href='#'>Сдать</a><BR> ";		
		}
		?>
		<? if($row['koll']>=1){?><A HREF="main.php?edit=1&stack=<?=$row['name']?>"><IMG SRC="i/stack.gif" WIDTH=13 HEIGHT=13 BORDER=0 ALT="Собрать"></A><? }?>
		<? if($row['koll']>1){?><A HREF="javascript:unstack('<?=$row['img']?>', '<?=$row['id']?>', '<?=$row['name']?>', '<?=$row['img']?>')"><IMG SRC="i/unstack.gif" WIDTH=13 HEIGHT=13 BORDER=0 ALT="Разделить"></A><? }?>
		<A HREF="javascript:drop('<?=$row['img']?>', '<?=$row['id']?>', '<?=$row['name']?>', '<?=$row['img']?>')"><IMG SRC="i/clear.gif" WIDTH=13 HEIGHT=13 BORDER=0 ALT="Выбросить предмет"></A>
		<?
		echo "</TD>
		<td>";
	}



     // показывает в инвентаре
	// end if shop
if ($row['destinyinv']>0) {

		if($row['artefact']!=0 or $row['ecost']>0){$art="&a=1";}//else{$art="";}
		elseif($row['podzem']!=0){$art="&a=2";}else{$art="";}
		if (!$row['count']){
		echo "<a href=\"/library.php?id={$row['prototype']}{$art}\" target=_blank>{$row['name']}</a>  <a href=# onclick=\"top.insItem({$row['id']});\">[в чат]</a> <img src=\"http://img.yourc.com/i/align_{$row['nalign']}.gif\"> (Масса: {$row['massa']})<img src=\"http://img.yourc.com/i/klan/{$row['clan']}.gif\"><img src=\"http://img.yourc.com/i/destiny{$row['destinyinv']}.gif\" alt=\"Этот предмет связан с Вами общей судьбой. Вы не можете передать его кому-либо еще.\"><img src='http://img.yourc.com/i/artefact{$row['artefact']}.gif' title='Артефакт'>".(($row['present'])?' <IMG SRC="http://img.yourc.com/i/podarok.gif" WIDTH="16" HEIGHT="18" BORDER=0 TITLE="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще." ALT="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще.">':"")."<BR>";
		}else{
		echo "<a href=\"/library.php?id={$row['id']}{$art}\" target=_blank>{$row['name']}</a> <a href=# onclick=\"top.insItem({$row['id']});\">[в чат]</a> <img src=\"http://img.yourc.com/i/align_{$row['nalign']}.gif\"> (Масса: {$row['massa']})<img src=\"http://img.yourc.com/i/klan/{$row['clan']}.gif\"><img src=\"http://img.yourc.com/i/destiny{$row['destinyinv']}.gif\" alt=\"Этот предмет связан с Вами общей судьбой. Вы не можете передать его кому-либо еще.\"><img src='http://img.yourc.com/i/artefact{$row['artefact']}.gif' title='Артефакт'>".(($row['present'])?' <IMG SRC="http://img.yourc.com/i/podarok.gif" WIDTH="16" HEIGHT="18" BORDER=0 TITLE="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще." ALT="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще.">':"")."<BR>";
		}
	}
// конец инвентаря
// Показывает в Березке 
elseif ($row['destiny']>0) {
		if($row['artefact']!=0 or $row['ecost']>0){$art="&a=1";}else{$art="";}
		if (@!$row['count']){
		echo "<a href=\"/library.php?id={$row['prototype']}{$art}\" target=_blank>{$row['name']}</a>  <a href=# onclick=\"top.insItem({$row['id']});\"></a><img src=http://img.yourc.com/i/align_{$row['nalign']}.gif>(Масса: {$row['massa']})<img src=\"http://img.yourc.com/i/klan/{$row['clan']}.gif\"><img src=\"http://img.yourc.com/i/destiny{$row['destiny']}.gif\" alt=\"Этот предмет будет связан с Вами общей судьбой. Вы не сможете передать его кому-либо еще.\"><img src=\"http://img.yourc.com/i/artefact{$row['artefact']}.gif\">".(($row['present'])?' <IMG SRC="http://img.yourc.com/i/podarok.gif" WIDTH="16" HEIGHT="18" BORDER=0 TITLE="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще." ALT="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще.">':"")."<BR>";
		}else{
		echo "<a href=\"/library.php?id={$row['id']}{$art}\" target=_blank>{$row['name']}</a> <a href=# onclick=\"top.insItem({$row['id']});\"></a><img src=http://img.yourc.com/i/align_{$row['nalign']}.gif>(Масса: {$row['massa']})<img src=\"http://img.yourc.com/i/klan/{$row['clan']}.gif\"><img src=\"http://img.yourc.com/i/destiny{$row['destiny']}.gif\" alt=\"Этот предмет будет связан с Вами общей судьбой. Вы не сможете передать его кому-либо еще.\"><img src=\"http://img.yourc.com/i/artefact{$row['artefact']}.gif\">".(($row['present'])?' <IMG SRC="http://img.yourc.com/i/podarok.gif" WIDTH="16" HEIGHT="18" BORDER=0 TITLE="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще." ALT="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще.">':"")."<BR>";
		}
	}else{
	// Показывает в магазине
    if($row['artefact']!=0 or $row['ecost']>0){$art="&a=1";}else{$art="";}
	if (@!$row['count']){
		echo "<a href=\"/library.php?id={$row['prototype']}{$art}\" target=_blank>{$row['name']}</a> <a href=# onclick=\"top.insItem({$row['id']});\">[в чат]</a>";if($row['koll']>'1'){echo "<b>(x{$row['koll']})</b>";}echo "</a>";print"<img src=http://img.yourc.com/i/align_{$row['nalign']}.gif>(Масса: {$row['massa']}) ".(($row['present'])?'<IMG SRC="http://img.yourc.com/i/podarok.gif" WIDTH="16" HEIGHT="18" BORDER=0 TITLE="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще." ALT="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще."> ':"")."<BR>";
		}else{
		echo "<a href=\"/library.php?id={$row['id']}{$art}\" target=_blank>{$row['name']}</a> <a href=# onclick=\"top.insItem({$row['id']});\"></a>";if($row['koll']>'1'){echo "<b>(x{$row['koll']})</b>";}echo "</a>";print"<img src=http://img.yourc.com/i/align_{$row['nalign']}.gif>(Масса: {$row['massa']})".(($row['present'])?'   <IMG SRC="http://img.yourc.com/i/podarok.gif" WIDTH="16" HEIGHT="18" BORDER=0 TITLE="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще." ALT="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще.">':"")."<BR>";
	    }
}
    if($row['setsale']>0) { echo "<b>Цена: {$row['setsale']} кр.</b> &nbsp; &nbsp; <br>"; }else{
	if($row['ecost']>0) { echo "<b>Цена: {$row['ecost']} екр.</b> &nbsp; &nbsp;"; }
    if($row['cost']>0 and $row['podzem']>0) { echo " "; }
	else{
    if($row['cost']>0) { echo "<b>Цена: {$row['cost']} кр.</b> &nbsp; &nbsp; "; }
	}
}

if(@$row['count']) {
			echo "<small>(количество: {$row['count']})</small><BR>";
		}
//РЕСЫ и ЖЕТОНЫ
if($row['zeton']>0)
	{
		if($row['zeton']>$zetons['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
		$font_e="</font>";
		
		echo "Требуется предмет: {$font_s}<b>[Жетон]x{$row['zeton']}</b>{$font_e}<BR>";
	}
if($row['ser_zeton']>0)
	{
		if($row['ser_zeton']>$ser_zetons['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
		$font_e="</font>";
	
		echo "Требуется предмет: {$font_s}<b>[Серебрянный Жетон]x{$row['ser_zeton']}</b>{$font_e}<BR>";
	}

if($row['xrustal']>0)
{
if($row['xrustal']>$xrustal['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
	    $font_e="</font>";
		echo "Требуется предмет: {$font_s}<b>[Хрусталь]x{$row['xrustal']}</b>{$font_e} ,";
}
if($row['mox']>0)
{
if($row['mox']>$mox['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
	    $font_e="</font>";
	     echo " {$font_s}<b>[Пещерный Мох]x{$row['mox']}</b>{$font_e} ,";
	}
if($row['braga']>0)
{
if($row['braga']>$braga['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
	    $font_e="</font>";
	     echo " {$font_s}<b>[Брага]x{$row['braga']}</b>{$font_e} ,";
	}
if($row['almaz']>0)
{
if($row['almaz']>$almaz['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
	    $font_e="</font>";
	     echo " {$font_s}<b>[Алмаз]x{$row['almaz']}</b>{$font_e} ,";
	}
if($row['bur']>0)
{
if($row['bur']>$bur['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
	    $font_e="</font>";
	     echo " {$font_s}<b>[Бур]x{$row['bur']}</b>{$font_e} ,";
	}
if($row['costi']>0)
{
if($row['costi']>$costi['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
	    $font_e="</font>";
	     echo " {$font_s}<b>[Кости]x{$row['costi']}</b>{$font_e} ,";
	}
if($row['autvais']>0)
{
if($row['autvais']>$autvais['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
	    $font_e="</font>";
	     echo " {$font_s}<b>[Аутвайс]x{$row['autvais']}</b>{$font_e} ,";
	}
if($row['kamen']>0)
{
if($row['kamen']>$kamen['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
	    $font_e="</font>";
	     echo " {$font_s}<b>[Драконий Камень]x{$row['kamen']}</b>{$font_e} ,";
	}
if($row['granit']>0)
{
if($row['granit']>$granit['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
	    $font_e="</font>";
	     echo " {$font_s}<b>[Гранит]x{$row['granit']}</b>{$font_e} ,";
	}
if($row['cvetok']>0)
{
if($row['cvetok']>$cvetok['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
	    $font_e="</font>";
	     echo " {$font_s}<b>[Подгорный Эдельвейс]x{$row['cvetok']}</b>{$font_e} ,";
	}
if($row['klik']>0)
{
if($row['klik']>$klik['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
	    $font_e="</font>";
	     echo " {$font_s}<b>[Клык Проклятья Глубин]x{$row['klik']}</b>{$font_e} ,";
	}
if($row['amulet']>0)
{
if($row['amulet']>$amulet['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
	    $font_e="</font>";
	     echo " {$font_s}<b>[Амулет Пустынника]x{$row['amulet']}</b>{$font_e} ,";
	}
if($row['zelie']>0)
{
if($row['zelie']>$zelie['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
	    $font_e="</font>";
	     echo " {$font_s}<b>[Зелье Пустынника]x{$row['zelie']}</b>{$font_e} ,";
	}
if($row['trapio']>0)
{
if($row['trapio']>$trapio['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
	    $font_e="</font><BR>";
	     echo " {$font_s}<b>[Тряпье]x{$row['trapio']}</b>{$font_e}";
	}

if($row['zol_zeton']>0)
	{
		if($row['zol_zeton']>$zol_zetons['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
		$font_e="</font>";
	
		echo "Требуется предмет: {$font_s}<b>[Золотой Жетон]x{$row['zol_zeton']}</b>{$font_e} <br>";
	}
			
if($row['predmet']!=''){echo "<font style='font-size:12px; color:#000;'><b></b> ".$row['predmet']." <b>x".$row['predmet_koll']."</b></font><BR>";}
//if($row['type']!=200){
		echo "Долговечность: {$row['duration']}/{$row['maxdur']}<BR>";

if (!$row['needident']) {
echo (($magic['chanse'])?"Вероятность срабатывания: ".$magic['chanse']."%<BR>":"")."
 ".(($row['mtime'])?"Продолжительность действия магии: {$row['mtime']}<BR>":"")."		
        



        ".(($row['goden'])?"Срок годности: {$row['goden']} дн. ".((!$row['count'])?"(до ".date("Y.m.d H:i",$row['dategoden']).")":"")."<BR>":"")."
        
        ".(($row['zaderjka'])?"Задержка использования: {$row['zaderjka']}<BR>":"")."
       
        ".(($magic['time'])?"Продолжительность действия магии: ".$magic['time']." мин.<BR>":"")."
		".(($row['nsila'] OR $row['nlovk'] OR $row['ninta'] OR $row['nvinos'] OR $row['nlevel'] OR $row['nintel'] OR $row['nmudra'] OR $row['nnoj'] OR $row['ntopor'] OR $row['ndubina'] OR $row['nmech'] OR $row['nposoh'] OR $row['nfire'] OR $row['nwater'] OR $row['nair'] OR $row['nearth'] OR $row['nearth'] OR $row['nlight'] OR $row['ngray'] OR $row['ndark'])?"<b>Требуется минимальное:</b><BR>":"")."
		".(($row['nlevel']>0)?"• ".(($row['nlevel'] > $user['level'])?"<font color=red>":"")."Уровень: {$row['nlevel']}</font><BR>":"")."
		".(($row['nsila']>0)?"• ".(($row['nsila'] > $user['sila'])?"<font color=red>":"")."Сила: {$row['nsila']}</font><BR>":"")."
		".(($row['nlovk']>0)?"• ".(($row['nlovk'] > $user['lovk'])?"<font color=red>":"")."Ловкость: {$row['nlovk']}</font><BR>":"")."
		".(($row['ninta']>0)?"• ".(($row['ninta'] > $user['inta'])?"<font color=red>":"")."Интуиция: {$row['ninta']}</font><BR>":"")."
		".(($row['nvinos']>0)?"• ".(($row['nvinos'] > $user['vinos'])?"<font color=red>":"")."Выносливость: {$row['nvinos']}</font><BR>":"")."
		".(($row['nintel']>0)?"• ".(($row['nintel'] > $user['intel'])?"<font color=red>":"")."Интеллект: {$row['nintel']}</font><BR>":"")."
		".(($row['nmudra']>0)?"• ".(($row['nmudra'] > $user['mudra'])?"<font color=red>":"")."Мудрость: {$row['nmudra']}</font><BR>":"")."
		".(($row['nnoj']>0)?"• ".(($row['nnoj'] > $user['noj'])?"<font color=red>":"")."Мастерство владения ножами и кастетами: {$row['nnoj']}</font><BR>":"")."
		".(($row['ntopor']>0)?"• ".(($row['ntopor'] > $user['topor'])?"<font color=red>":"")."Мастерство владения топорами и секирами: {$row['ntopor']}</font><BR>":"")."
		".(($row['ndubina']>0)?"• ".(($row['ndubina'] > $user['dubina'])?"<font color=red>":"")."Мастерство владения дубинами и булавами: {$row['ndubina']}</font><BR>":"")."
		".(($row['nmech']>0)?"• ".(($row['nmech'] > $user['mec'])?"<font color=red>":"")."Мастерство владения мечами: {$row['nmech']}</font><BR>":"")."
		".(($row['nposoh']>0)?"• ".(($row['nposoh'] > $user['posoh'])?"<font color=red>":"")."Мастерство владения посохами: {$row['nposoh']}</font><BR>":"")."
		".(($row['nfire']>0)?"• ".(($row['nfire'] > $user['mfire'])?"<font color=red>":"")."Мастерство владения стихией Огня: {$row['nfire']}</font><BR>":"")."
		".(($row['nwater']>0)?"• ".(($row['nwater'] > $user['mwater'])?"<font color=red>":"")."Мастерство владения стихией Воды: {$row['nwater']}</font><BR>":"")."
		".(($row['nair']>0)?"• ".(($row['nair'] > $user['mair'])?"<font color=red>":"")."Мастерство владения стихией Воздуха: {$row['nair']}</font><BR>":"")."
		".(($row['nearth']>0)?"• ".(($row['nearth'] > $user['mearth'])?"<font color=red>":"")."Мастерство владения стихией Земли: {$row['nearth']}</font><BR>":"")."
		".(($row['nlight']>0)?"• ".(($row['nlight'] > $user['mlight'])?"<font color=red>":"")."Мастерство владения магией Света: {$row['nlight']}</font><BR>":"")."
		".(($row['ngray']>0)?"• ".(($row['ngray'] > $user['mgray'])?"<font color=red>":"")."Мастерство владения серой магией: {$row['ngray']}</font><BR>":"")."
		".(($row['ndark']>0)?"• ".(($row['ndark'] > $user['mdark'])?"<font color=red>":"")."Мастерство владения магией Тьмы: {$row['ndark']}</font><BR>":"")."
        ".(($row['mfhitp'] OR $row['mfmagp'] OR $row['mfpodav'] OR $row['attacka'] OR $row['add_stats'] OR $row['gsila'] OR $row['mfdhit'] OR $row['mfdmag']  OR $row['mfkritpow']  OR $row['mfantikritpow'] OR $row['mfparir']  OR $row['mfshieldblock'] OR $row['mfcontr']  OR $row['mfrub'] OR $row['mfkol']  OR $row['mfdrob'] OR $row['mfrej'] OR $row['mfkrit'] OR $row['mfakrit']  OR $row['mfuvorot'] OR $row['mfauvorot']  OR $row['glovk'] OR $row['ghp'] OR $row['gmana'] OR $row['ginta'] OR $row['gintel'] OR $row['gnoj'] OR $row['gtopor'] OR $row['gdubina'] OR $row['gmech']  OR $row['gposoh'] OR $row['gfire'] OR $row['gwater'] OR $row['gair'] OR $row['gearth'] OR $row['gearth'] OR $row['glight'] OR $row['ggray'] OR $row['gdark'] OR $row['bron1'] OR $row['bron2'] OR $row['bron3'] OR $row['bron4'] OR $row['givebuter'])?"<b>Действует на:</b><BR>":"")."
		".(($row['deistvie'])?"<b>Действует на:</b><BR>• ".$row['deistvie']."<BR> ":"")."
		
       
		
        ".(($row['givebuter'])?"•Уровень жизниь (HP): ".(($row['givebuter']>0)?"+":"")."{$row['givebuter']}<BR>":"")."
		".(($row['gsila'])?"• Сила: ".(($row['gsila']>0)?"+":"")."{$row['gsila']}<BR>":"")."
		".(($row['glovk'])?"• Ловкость: ".(($row['glovk']>0)?"+":"")."{$row['glovk']}<BR>":"")."
		".(($row['ginta'])?"• Интуиция: ".(($row['ginta']>0)?"+":"")."{$row['ginta']}<BR>":"")."
		".(($row['gintel'])?"• Интеллект: ".(($row['gintel']>0)?"+":"")."{$row['gintel']}<BR>":"")."
		".(($row['ghp'])?"• Уровень жизни: +{$row['ghp']}<BR>":"")."
		".(($row['gmana'])?"• Уровень маны: +{$row['gmana']}<BR>":"")."
		".(($row['mfkrit'])?"• Мф. критических ударов: ".(($row['mfkrit']>0)?"+":"")."{$row['mfkrit']}%<BR>":"")."
		".(($row['mfakrit'])?"• Мф. против крит. ударов: ".(($row['mfakrit']>0)?"+":"")."{$row['mfakrit']}%<BR>":"")."
		".(($row['mfkritpow'])?"• Мф. мощности крит. удара: ".(($row['mfkritpow']>0)?"+":"")."{$row['mfkritpow']}%<BR>":"")."
		".(($row['mfantikritpow'])?"• Мф. против мощ. крит. удара: ".(($row['mfantikritpow']>0)?"+":"")."{$row['mfantikritpow']}%<BR>":"")."
		".(($row['mfparir'])?"• Мф. парирования: ".(($row['mfparir']>0)?"+":"")."{$row['mfparir']}%<BR>":"")."
		".(($row['mfshieldblock'])?"• Мф. блока щитом: ".(($row['mfshieldblock']>0)?"+":"")."{$row['mfshieldblock']}%<BR>":"")."
		".(($row['mfcontr'])?"• Мф. контрудара: ".(($row['mfcontr']>0)?"+":"")."{$row['mfcontr']}%<BR>":"")."
		".(($row['mfuvorot'])?"• Мф. увертливости: ".(($row['mfuvorot']>0)?"+":"")."{$row['mfuvorot']}%<BR>":"")."
		".(($row['mfauvorot'])?"• Мф. против увертлив.: ".(($row['mfauvorot']>0)?"+":"")."{$row['mfauvorot']}%<BR>":"")."
		".(($row['gnoj'])?"• Мастерство владения ножами и кастетами: +{$row['gnoj']}<BR>":"")."
		".(($row['gtopor'])?"• Мастерство владения топорами и секирами: +{$row['gtopor']}<BR>":"")."
		".(($row['gdubina'])?"• Мастерство владения дубинами и булавами: +{$row['gdubina']}<BR>":"")."
		".(($row['gmech'])?"• Мастерство владения мечами: +{$row['gmech']}<BR>":"")."
		".(($row['gposoh'])?"• Мастерство владения посохами: +{$row['gposoh']}<BR>":"")."
		".(($row['gfire'])?"• Мастерство владения стихией Огня: +{$row['gfire']}<BR>":"")."
		".(($row['gwater'])?"• Мастерство владения стихией Воды: +{$row['gwater']}<BR>":"")."
		".(($row['gair'])?"• Мастерство владения стихией Воздуха: +{$row['gair']}<BR>":"")."
		".(($row['gearth'])?"• Мастерство владения стихией Земли: +{$row['gearth']}<BR>":"")."
		".(($row['glight'])?"• Мастерство владения магией Света: +{$row['glight']}<BR>":"")."
		".(($row['ggray'])?"• Мастерство владения серой магией: +{$row['ggray']}<BR>":"")."
	    ".(($row['gdark'])?"• Мастерство владения магией Тьмы: +{$row['gdark']}<BR>":"").""
       
     
         .(($row['bron1']!=0)?"• Броня головы: {$row['bron11']}-{$row['bron1']} (".(((($row['bron11']-1)!=0)?($row['bron11']-1)."+":""))."d".(1+$row['bron1']-$row['bron11']).")<br>":"")."
		".(($row['bron2']!=0)?"• Броня корпуса: {$row['bron22']}-{$row['bron2']} (".(((($row['bron22']-1)!=0)?($row['bron22']-1)."+":""))."d".(1+$row['bron2']-$row['bron22']).")<br>":"")."
		".(($row['bron3']!=0)?"• Броня пояса: {$row['bron33']}-{$row['bron3']} (".(((($row['bron33']-1)!=0)?($row['bron33']-1)."+":""))."d".(1+$row['bron3']-$row['bron33']).")<br>":"")."
		".(($row['bron4']!=0)?"• Броня ног: {$row['bron44']}-{$row['bron4']} (".(((($row['bron44']-1)!=0)?($row['bron44']-1)."+":""))."d".(1+$row['bron4']-$row['bron44']).")<br>":"")."

		".(($row['add_stats'] && !$row['count'])?"• Количество увеличений: {$row['add_stats']}<BR>
		• Сила: {$row['gsila']}<a href=\"upd.php?id=".($row['id'])."&p=1\"><img src=\"http://img.yourc.com/i/up.gif\" alt=\"\"></a><br>
		• Ловкость: {$row['glovk']}<a href=\"upd.php?id=".($row['id'])."&p=2\"><img src=\"http://img.yourc.com/i/up.gif\" alt=\"\"></a><br>
		• Интуиция: {$row['ginta']}<a href=\"upd.php?id=".($row['id'])."&p=3\"><img src=\"http://img.yourc.com/i/up.gif\" alt=\"\"></a><br>
		• Интеллект: {$row['gintel']}<a href=\"upd.php?id=".($row['id'])."&p=4\"><img src=\"http://img.yourc.com/i/up.gif\" alt=\"\"></a><br>
		":"")."
		".(($row['add_stats'] && $row['count'])?"• Количество увеличений: {$row['add_stats']}<BR>":"")."
        ".(($row['attacka'])?"• Дополнительный удар: +{$row['attacka']}<BR>":"")."
		".(($row['mfdhit'])?"• Защита от урона: ".(($row['mfdhit']>0)?"+":"")."{$row['mfdhit']}%<BR>":"")."
		".(($row['mfdmag'])?"• Защита от магии: ".(($row['mfdmag']>0)?"+":"")."{$row['mfdmag']}%<BR>":"")."
		".(($row['mfdfire'])?"• Защита от магии Огня: ".(($row['mfdfire']>0)?"+":"")."{$row['mfdfire']}%<BR>":"")."
        ".(($row['mfdair'])?"• Защита от магии Воздуха: ".(($row['mfdair']>0)?"+":"")."{$row['mfdair']}%<BR>":"")."
        ".(($row['mfdwater'])?"• Защита от магии Воды: ".(($row['mfdwater']>0)?"+":"")."{$row['mfdwater']}%<BR>":"")."
        ".(($row['mfdearth'])?"• Защита от магии Земли: ".(($row['mfdearth']>0)?"+":"")."{$row['mfdearth']}%<BR>":"")."
        ".(($row['mffire'])?"• Мф. мощности урона Огня: ".(($row['mffire']>0)?"+":"")."{$row['mffire']}%<BR>":"")."
        ".(($row['mfair'])?"• Мф. мощности урона Воздуха: ".(($row['mfair']>0)?"+":"")."{$row['mfair']}%<BR>":"")."
        ".(($row['mfwater'])?"• Мф. мощности урона Воды: ".(($row['mfwater']>0)?"+":"")."{$row['mfwater']}%<BR>":"")."
        ".(($row['mfearth'])?"• Мф. мощности урона Земли: ".(($row['mfearth']>0)?"+":"")."{$row['mfearth']}%<BR>":"")."
        ".(($row['mfhitp'])?"• Мф. мощности урона: ".(($row['mfhitp']>0)?"+":"")."{$row['mfhitp']}%<BR>":"")."
		".(($row['mfmagp'])?"• Мф. мощности магии стихий: ".(($row['mfmagp']>0)?"+":"")."{$row['mfmagp']}%<BR>":"")."
		".(($row['mfpodav'])?"• Мф. подавления защиты от магии: ".(($row['mfpodav']>0)?"+":"")."{$row['mfpodav']}%<BR>":"")."
		".(($row['mfrub'])?"• Мф. мощности рубящго урона: ".(($row['mfrub']>0)?"+":"")."{$row['mfrub']}%<BR>":"")."
		".(($row['mfkol'])?"• Мф. мощности колющего урона: ".(($row['mfkol']>0)?"+":"")."{$row['mfkol']}%<BR>":"")."
		".(($row['mfdrob'])?"• Мф. мощности дробящего урона: ".(($row['mfdrob']>0)?"+":"")."{$row['mfdrob']}%<BR>":"")."
		".(($row['mfrej'])?"•  Мф. мощности режущего урона: ".(($row['mfrej']>0)?"+":"")."{$row['mfrej']}%<BR>":"")."
		".(($row['gmeshok'])?"• Увеличивает рюкзак: +{$row['gmeshok']}<BR>":"")."
		".(($row['letters'])?"Количество символов: ".($row['letters'])."</div>":"")."
		".(($row['letter'])?"На бумаге записан текст:<div style='background-color:FAF0E6;'><font color=green>".date("Y.m.d H:i")."</font> ".nl2br($row['letter'])."</div>":"")."
		
		".(($row['minu'] OR $row['maxu'] OR $row['mfproboi'] OR $row['mfruburon'] OR $row['mfrejuron'])?"<b>Свойства предмета:</b><BR>":"")."
        
       
        ".(($row['minu'])?"• Минимальное наносимое повреждение: {$row['minu']}<BR>":"")."
		".(($row['maxu'])?"• Максимальное наносимое повреждение: {$row['maxu']}<BR>":"")."
        ".(($row['mfproboi'])?"• Мф. пробоя брони: ".(($row['mfproboi']>0)?"+":"")."{$row['mfproboi']}%<BR>":"")."
        ".(($row['mfruburon'])?"• Мф. мощности рубящего урона: ".(($row['mfruburon']>0)?"+":"")."{$row['mfruburon']}%<BR>":"")."
        ".(($row['mfrejuron'])?"• Мф. мощности режущего урона: ".(($row['mfrejuron']>0)?"+":"")."{$row['mfrejuron']}%<BR>":"")."
       	".(($row['k_kach']>0 or $row['r_kach']>0 or $row['d_kach']>0 or $row['z_kach']>0)?"<b>Особенности:</b><br />":"")."
         ".(($row['k_kach']>0)?"• Колющие атаки:":"")."
         ".(($row['k_kach']==10)?" Редки<br />":"")."
		 ".(($row['k_kach']==30)?" Малы<br />":"")."
		 ".(($row['k_kach']==50)?" Временами<br />":"")."
		 ".(($row['k_kach']==70)?" Часты<br />":"")."
         ".(($row['r_kach']>0)?"• Рубящие атаки:":"")."
         ".(($row['r_kach']==10)?" Редки<br />":"")."
		 ".(($row['r_kach']==30)?" Малы<br />":"")."
		 ".(($row['r_kach']==50)?" Временами<br />":"")."
		 ".(($row['r_kach']==70)?" Часты<br />":"")."
         ".(($row['d_kach']>0)?"• Дробящие атаки:":"")."
         ".(($row['d_kach']==10)?" Редки<br />":"")."
		 ".(($row['d_kach']==30)?" Малы<br />":"")."
		 ".(($row['d_kach']==50)?" Временами<br />":"")."
		 ".(($row['d_kach']==70)?" Часты<br />":"")."
         ".(($row['z_kach']>0)?"• Режущие атаки:":"")."
         ".(($row['z_kach']==10)?" Редки<br />":"")."
		 ".(($row['z_kach']==30)?" Малы<br />":"")."
		 ".(($row['z_kach']==50)?" Временами<br />":"")."
		 ".(($row['z_kach']==70)?" Часты<br />":"")."
		 
		".(($row['complect_id']>0)?"Часть комплекта: ".echoComplect($row['complect_id'])."<BR>":"")."   
		
        ".((($row['type'] == 25 &&  $row['show']==1))?"<font color=maroon>:</font> ".$magic['name']."<BR>":"")."
		".((($row['type'] == 29 &&  $row['show']==1))?"<font color=maroon>:</font> ".$magic['name']."<BR>":"")."
		
        ".((($row['type'] == 188 &&  $row['show']==1))?"<font color=maroon>:</font> ".$magic['name']."<BR>":"")."
		".(($row['text'])?"<b>На ручке выгравирована надпись:</b><br>".$row['text']."<BR>":"")."
	   
		".(($incmagic['max'])?"	Встроено заклятие <img src=\"http://img.yourc.com/i/magic/".$incmagic['img']."\" alt=\"".$incmagic['name']."\"> ".$incmagic['cur']." шт.	<BR>":"")."
		".(($row['type']==27)?"<small><b>Описание:</b><BR><font color=maroon>Одевается под броню</font></small><BR>":"")."
		".(($row['type']==28)?"<small><b>Описание:</b><BR><font color=maroon>Одевается поверх брони</font></small><BR>":"")."
		 ".(($row['second'])?"<small><b>Описание:</b><BR><font style='font-size:11px; color:#990000'>Второе оружие</font></small><BR>":"")."
        
         

        
        ".(($row['dvur'])?"<small><b>Описание:</b><BR><font color=maroon>Двуручное оружие</font></small><BR>":"")."
		
        
        ".(($row['opisan'])?"<small><b>Описание:</b><BR>".$row['opisan']."</small><BR>":"")."
        ".(($row['podzem'])?"<small><font color=maroon>Предмет из подземелья</font></small><BR>":"")."
		
        ".(($row['magic']>0 && $row['show']==1)?"\r\n<br/><font style='font-size:11px; color:#990000'>Встроена магия:</font> {$magic['name']} <img src=\"http://img.yourc.com/i/magic/".$magic['img']."\" alt=\"".$magic['name']."\"><BR>":"")."
        ".((!$row['isrep'])?"<small><font color=maroon>Предмет не подлежит ремонту</font></small><BR>":"");
        
		
       }
       else { echo "<font color=maroon><B>Свойства предмета не идентифицированы</B></font><BR>"; }
                
                if($row['made']){
                        switch($row['made']){
                        case 'capitalcity': $made='Capital City'; break;
                        case 'angelscity': $made='Angels City'; break;
                        case 'demonscity': $made='Demons City'; break;
                        case 'devilscity': $made='Devils City'; break;
                        case 'oldcity': $made='Old City'; break;
                        case 'dungeon': $made='Abandonedplain'; break;
                        case 'emeraldscity': $made='Emeralds City'; break;
                        case 'suncity': $made='Sun City'; break;	
}  
                }
                else {
                     switch($_SESSION['incity']){
                     case 'capitalcity':$made='Capital City'; break;
                     case 'angelscity': $made='Angels City'; break;
                     case 'demonscity': $made='Demons City'; break;
                     case 'devilscity': $made='Devils City'; break;
                     case 'oldcity': $made='Old City'; break;
                     case 'dungeon': $made='Abandonedplain'; break;
                     case 'emeraldscity': $made='Emeralds City'; break;
                     case 'suncity': $made='Sun City'; break;	
}
                }
		echo "<small>Сделано в ".$made."</small></td></TR>";
}
function showitem_lib ($row, $show_img=TRUE) {

	$magic = magicinf ($row['magic']);
	$incmagic = mysql_fetch_array(mysql_query('SELECT * FROM `magic` WHERE `id` = \''.$row['includemagic'].'\' LIMIT 1;'));
	$incmagic['name'] = $row['includemagicname'];
	$incmagic['cur'] = $row['includemagicdex'];
	$incmagic['max'] = $row['includemagicmax'];
	if(!$magic){
		$magic['chanse'] = $incmagic['chanse'];
		$magic['time'] = $incmagic['time'];
		$magic['targeted'] = $incmagic['targeted'];
	}
//////////Инфо про предмет Лайбери
if ($row['destinyinv']>0) {

		if($row['artefact']!=0 or $row['ecost']>0){$art="&a=1";}//else{$art="";}
		elseif($row['podzem']!=0){$art="&a=2";}else{$art="";}
		if (@!$row['count']){
		echo "<a href=\"/library.php?id={$row['prototype']}{$art}\" target=_blank>{$row['name']}</a><img src=http://img.yourc.com/i/align_{$row['nalign']}.gif> (Масса: {$row['massa']})<img src=http://img.yourc.com/i/klan/{$row['clan']}.gif><img src=http://img.yourc.com/i/destiny{$row['destinyinv']}.gif alt=\"Этот предмет связан с Вами общей судьбой. Вы не можете передать его кому-либо еще.\"><img src='i/artefact{$row['artefact']}.gif' title='Артефакт'>".(($row['present'])?' <IMG SRC="http://img.yourc.com/i/podarok.gif" WIDTH="16" HEIGHT="18" BORDER=0 TITLE="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще." ALT="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще.">':"")."<BR>";
		}else{echo "<a href=\"/library.php?id={$row['id']}{$art}\" target=_blank>{$row['name']}</a><img src=http://img.yourc.com/i/align_{$row['nalign']}.gif> (Масса: {$row['massa']})<img src=http://img.yourc.com/i/klan/{$row['clan']}.gif><img src=http://img.yourc.com/i/destiny{$row['destinyinv']}.gif alt=\"Этот предмет связан с Вами общей судьбой. Вы не можете передать его кому-либо еще.\"><img src='i/artefact{$row['artefact']}.gif' title='Артефакт'>".(($row['present'])?' <IMG SRC="http://img.yourc.com/i/podarok.gif" WIDTH="16" HEIGHT="18" BORDER=0 TITLE="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще." ALT="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще.">':"")."<BR>";
		}
	}
elseif ($row['destiny']>0) {
		if($row['artefact']!=0 or $row['ecost']>0){$art="&a=1";}else{$art="";}
		if (@!$row['count']){
		echo "<a href=\"/library.php?id={$row['prototype']}{$art}\" target=_blank>{$row['name']}</a><img src=http://img.yourc.com/i/align_{$row['nalign']}.gif> (Масса: {$row['massa']})<img src=http://img.yourc.com/i/klan/{$row['clan']}.gif><img src=http://img.yourc.com/i/destiny{$row['destiny']}.gif alt=\"Этот предмет будет связан с Вами общей судьбой. Вы не сможете передать его кому-либо еще.\"><img src=http://img.yourc.com/i/artefact{$row['artefact']}.gif>".(($row['present'])?' <IMG SRC="http://img.yourc.com/i/podarok.gif" WIDTH="16" HEIGHT="18" BORDER=0 TITLE="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще." ALT="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще.">':"")."<BR>";
		}else{echo "<a href=\"/library.php?id={$row['id']}{$art}\" target=_blank>{$row['name']}</a><img src=http://img.yourc.com/i/align_{$row['nalign']}.gif> (Масса: {$row['massa']})<img src=http://img.yourc.com/i/klan/{$row['clan']}.gif><img src=http://img.yourc.com/i/destiny{$row['destiny']}.gif alt=\"Этот предмет будет связан с Вами общей судьбой. Вы не сможете передать его кому-либо еще.\"><img src=http://img.yourc.com/i/artefact{$row['artefact']}.gif>".(($row['present'])?' <IMG SRC="http://img.yourc.com/i/podarok.gif" WIDTH="16" HEIGHT="18" BORDER=0 TITLE="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще." ALT="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще.">':"")."<BR>";
		}
	}else{
	if($row['artefact']!=0 or $row['ecost']>0){$art="&a=1";}else{$art="";}
	if (@!$row['count']){
		echo "<a href=\"/library.php?id={$row['prototype']}{$art}\" target=_blank>{$row['name']}</a>";if($row['koll']>'0'){echo " <b>(x{$row['koll']})</b>";}print"<img src=http://img.yourc.com/i/align_{$row['nalign']}.gif> (Масса: {$row['massa']})<img src=http://img.yourc.com/i/klan/{$row['clan']}.gif><img src=http://img.yourc.com/i/destiny{$row['destiny']}.gif><img src=http://img.yourc.com/i/artefact{$row['artefact']}.gif>".(($row['present'])?' <IMG SRC="http://img.yourc.com/i/podarok.gif" WIDTH="16" HEIGHT="18" BORDER=0 TITLE="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще." ALT="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще.">':"")."<BR>";
		}else{
		echo "<a href=\"/library.php?id={$row['id']}{$art}\" target=_blank>{$row['name']}</a>";if($row['koll']>'0'){echo " <b>(x{$row['koll']})</b>";}print"<img src=http://img.yourc.com/i/align_{$row['nalign']}.gif> (Масса: {$row['massa']})<img src=http://img.yourc.com/i/klan/{$row['clan']}.gif><img src=http://img.yourc.com/i/destiny{$row['destiny']}.gif><img src=http://img.yourc.com/i/artefact{$row['artefact']}.gif>".(($row['present'])?' <IMG SRC="http://img.yourc.com/i/podarok.gif" WIDTH="16" HEIGHT="18" BORDER=0 TITLE="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще." ALT="Этот предмет вам подарил '.$row['present'].'. Вы не сможете передать этот предмет кому-либо еще.">':"")."<BR>";
		}
}

	if($row['ecost']>0) { echo "<b>Цена: {$row['ecost']} екр.</b> &nbsp; &nbsp; <br>"; } elseif($row['cost']>0) { echo "<b>Цена: {$row['cost']} кр.</b> &nbsp; &nbsp; <br>"; }

     if($row['zeton']>0)
	{
		if($row['zeton']>$zetons['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
		$font_e="</font>";
		echo "<b>Цена: ".number_format(round($row['cost'],2), 2, '.', '')." кр.</b> &nbsp; <br>";
		echo "Требуется предмет: <b>[Жетон]x{$row['zeton']}</b> <br>";
	}
elseif($row['ser_zeton']>0)
	{
		if($row['ser_zeton']>$ser_zetons['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
		$font_e="</font>";
		echo "<b>Цена: ".number_format(round($row['cost'],2), 2, '.', '')." кр.</b> &nbsp; <br>";
		echo "Требуется предмет: <b>[Серебрянный Жетон]x{$row['ser_zeton']}</b> <br>";
	}
elseif($row['zol_zeton']>0)
	{
		if($row['zol_zeton']>$zol_zetons['koll']){$font_s="<font color=\"red\">";}else{$font_s="<font color=\"black\">";}
		$font_e="</font>";
		echo "<b>Цена: ".number_format(round($row['cost'],2), 2, '.', '')." кр.</b> &nbsp; <br>";
		echo "Требуется предмет: <b>[Золотой Жетон]x{$row['zol_zeton']}</b> <br>";
	}
		

//if($row['type']!=200){
		echo "Долговечность: {$row['duration']}/{$row['maxdur']}<BR>";
//}

if (!$row['needident']) {
		  echo (($magic['chanse'] && $row['show']==1)?"Вероятность срабатывания: ".$magic['chanse']."%<BR>":"")."
		".(($magic['time'])?"Продолжительность действия магии: ".$magic['time']." мин.<BR>":"")."
		".(($row['goden'])?"Срок годности: ".time_left($row['dategoden'])." ".((!$row['count'])?"(до ".date("Y.m.d H:i",$row['dategoden']).")":"")."<BR>":"")."
		".(($row['nsila'] OR $row['nlovk'] OR $row['ninta'] OR $row['nvinos'] OR $row['nlevel'] OR $row['nintel'] OR $row['nmudra'] OR $row['nnoj'] OR $row['ntopor'] OR $row['ndubina'] OR $row['nmech'] OR $row['nposoh'] OR $row['nfire'] OR $row['nwater'] OR $row['nair'] OR $row['nearth'] OR $row['nearth'] OR $row['nlight'] OR $row['ngray'] OR $row['ndark'])?"<b>Требуется минимальное:</b><BR>":"")."
		".(($row['nlevel']>0)?"• Уровень: {$row['nlevel']}</font><BR>":"")."
		".(($row['nsila']>0)?"• Сила: {$row['nsila']}</font><BR>":"")."
		".(($row['nlovk']>0)?"• Ловкость: {$row['nlovk']}</font><BR>":"")."
		".(($row['ninta']>0)?"• Интуиция: {$row['ninta']}</font><BR>":"")."
		".(($row['nvinos']>0)?"• Выносливость: {$row['nvinos']}</font><BR>":"")."
		".(($row['nintel']>0)?"• Интеллект: {$row['nintel']}</font><BR>":"")."
		".(($row['nmudra']>0)?"• Мудрость: {$row['nmudra']}</font><BR>":"")."
		".(($row['nnoj']>0)?"• Мастерство владения ножами и кастетами: {$row['nnoj']}</font><BR>":"")."
		".(($row['ntopor']>0)?"• Мастерство владения топорами и секирами: {$row['ntopor']}</font><BR>":"")."
		".(($row['ndubina']>0)?"• Мастерство владения дубинами и булавами: {$row['ndubina']}</font><BR>":"")."
		".(($row['nmech']>0)?"• Мастерство владения мечами: {$row['nmech']}</font><BR>":"")."
		".(($row['nposoh']>0)?"• Мастерство владения посохами: {$row['nposoh']}</font><BR>":"")."
		".(($row['nfire']>0)?"• Мастерство владения стихией Огня: {$row['nfire']}</font><BR>":"")."
		".(($row['nwater']>0)?"• Мастерство владения стихией Воды: {$row['nwater']}</font><BR>":"")."
		".(($row['nair']>0)?"• Мастерство владения стихией Воздуха: {$row['nair']}</font><BR>":"")."
		".(($row['nearth']>0)?"• Мастерство владения стихией Земли: {$row['nearth']}</font><BR>":"")."
		".(($row['nlight']>0)?"• Мастерство владения магией Света: {$row['nlight']}</font><BR>":"")."
		".(($row['ngray']>0)?"• Мастерство владения серой магией: {$row['ngray']}</font><BR>":"")."
		".(($row['ndark']>0)?"• Мастерство владения магией Тьмы: {$row['ndark']}</font><BR>":"")."
        
		
        ".(($row['gmeshok'] OR $row['honor'] OR $row['mfhitp'] OR $row['mfmagp'] OR $row['attacka'] OR $row['add_stats'] OR $row['mfpodav'] OR $row['gsila'] OR $row['mfdhit'] OR $row['mfdmag']  OR $row['mfkritpow']  OR $row['mfantikritpow'] OR $row['mfparir']  OR $row['mfshieldblock'] OR $row['mfcontr']  OR $row['mfrub'] OR $row['mfkol']  OR $row['mfdrob'] OR $row['mfrej'] OR $row['mfkrit'] OR $row['mfakrit']  OR $row['mfuvorot'] OR $row['mfauvorot']  OR $row['glovk'] OR $row['ghp'] OR $row['gmana'] OR $row['ginta'] OR $row['gintel'] OR $row['gnoj'] OR $row['gtopor'] OR $row['gdubina'] OR $row['gmech'] OR $row['gposoh'] OR $row['gfire'] OR $row['gwater'] OR $row['gair'] OR $row['gearth'] OR $row['gearth'] OR $row['glight'] OR $row['ggray'] OR $row['gdark'] OR $row['minu'] OR $row['maxu'] OR $row['bron1'] OR $row['bron2'] OR $row['bron3'] OR $row['bron4'])?"<b>Действует на:</b><BR>":"")."
	    ".(($row['deistvie'] && $row['show']==1)?"<b>Действует на:</b><BR>• ".$row['deistvie']."<BR> ":"")."
        ".(($row['minu'])?"• Минимальное наносимое повреждение: {$row['minu']}<BR>":"")."
		".(($row['maxu'])?"• Максимальное наносимое повреждение: {$row['maxu']}<BR>":"")."
		".(($row['gsila'])?"• Сила: ".(($row['gsila']>0)?"+":"")."{$row['gsila']}<BR>":"")."
		".(($row['glovk'])?"• Ловкость: ".(($row['glovk']>0)?"+":"")."{$row['glovk']}<BR>":"")."
		".(($row['ginta'])?"• Интуиция: ".(($row['ginta']>0)?"+":"")."{$row['ginta']}<BR>":"")."
		".(($row['gintel'])?"• Интеллект: ".(($row['gintel']>0)?"+":"")."{$row['gintel']}<BR>":"")."
		".(($row['ghp'])?"• Уровень жизни: +{$row['ghp']}<BR>":"")."
		".(($row['gmana'])?"• Уровень маны: +{$row['gmana']}<BR>":"")."
		".(($row['mfkrit'])?"• Мф. критических ударов: ".(($row['mfkrit']>0)?"+":"")."{$row['mfkrit']}%<BR>":"")."
		".(($row['mfakrit'])?"• Мф. против крит. ударов: ".(($row['mfakrit']>0)?"+":"")."{$row['mfakrit']}%<BR>":"")."
		".(($row['mfkritpow'])?"• Мф. мощности критического. удара: ".(($row['mfkritpow']>0)?"+":"")."{$row['mfkritpow']}%<BR>":"")."
		".(($row['mfantikritpow'])?"• Мф. против мощ. крит. удара: ".(($row['mfantikritpow']>0)?"+":"")."{$row['mfantikritpow']}%<BR>":"")."
		".(($row['mfparir'])?"• Мф. парирования: ".(($row['mfparir']>0)?"+":"")."{$row['mfparir']}%<BR>":"")."
		".(($row['mfshieldblock'])?"• Мф. блока щитом: ".(($row['mfshieldblock']>0)?"+":"")."{$row['mfshieldblock']}%<BR>":"")."
		".(($row['mfcontr'])?"• Мф. контрудара: ".(($row['mfcontr']>0)?"+":"")."{$row['mfcontr']}%<BR>":"")."
		".(($row['mfuvorot'])?"• Мф. увертливости: ".(($row['mfuvorot']>0)?"+":"")."{$row['mfuvorot']}%<BR>":"")."
		".(($row['mfauvorot'])?"• Мф. против увертывания: ".(($row['mfauvorot']>0)?"+":"")."{$row['mfauvorot']}%<BR>":"")."
		".(($row['gnoj'])?"• Мастерство владения ножами и кастетами: +{$row['gnoj']}<BR>":"")."
		".(($row['gtopor'])?"• Мастерство владения топорами и секирами: +{$row['gtopor']}<BR>":"")."
		".(($row['gdubina'])?"• Мастерство владения дубинами и булавами: +{$row['gdubina']}<BR>":"")."
		".(($row['gmech'])?"• Мастерство владения мечами: +{$row['gmech']}<BR>":"")."
		".(($row['gposoh'])?"• Мастерство владения посохами: +{$row['gposoh']}<BR>":"")."
		".(($row['gfire'])?"• Мастерство владения стихией Огня: +{$row['gfire']}<BR>":"")."
		".(($row['gwater'])?"• Мастерство владения стихией Воды: +{$row['gwater']}<BR>":"")."
		".(($row['gair'])?"• Мастерство владения стихией Воздуха: +{$row['gair']}<BR>":"")."
		".(($row['gearth'])?"• Мастерство владения стихией Земли: +{$row['gearth']}<BR>":"")."
		".(($row['glight'])?"• Мастерство владения магией Света: +{$row['glight']}<BR>":"")."
		".(($row['ggray'])?"• Мастерство владения серой магией: +{$row['ggray']}<BR>":"")."
		".(($row['gdark'])?"• Мастерство владения магией Тьмы: +{$row['gdark']}<BR>":"").""
               
         .(($row['bron1']!=0)?"• Броня головы: {$row['bron11']}-{$row['bron1']} (".(((($row['bron11']-1)!=0)?($row['bron11']-1)."+":""))."d".(1+$row['bron1']-$row['bron11']).")<br>":"")."
		".(($row['bron2']!=0)?"• Броня корпуса: {$row['bron22']}-{$row['bron2']} (".(((($row['bron22']-1)!=0)?($row['bron22']-1)."+":""))."d".(1+$row['bron2']-$row['bron22']).")<br>":"")."
		".(($row['bron3']!=0)?"• Броня пояса: {$row['bron33']}-{$row['bron3']} (".(((($row['bron33']-1)!=0)?($row['bron33']-1)."+":""))."d".(1+$row['bron3']-$row['bron33']).")<br>":"")."
		".(($row['bron4']!=0)?"• Броня ног: {$row['bron44']}-{$row['bron4']} (".(((($row['bron44']-1)!=0)?($row['bron44']-1)."+":""))."d".(1+$row['bron4']-$row['bron44']).")<br>":"")."

		".(($row['add_stats'])?"• Количество увеличений: {$row['add_stats']}<BR>":"")."
        ".(($row['attacka'])?"• Дополнительный удар: +{$row['attacka']}<BR>":"")."
		".(($row['mfdhit'])?"• Защита от урона: ".(($row['mfdhit']>0)?"+":"")."{$row['mfdhit']}%<BR>":"")."
		".(($row['mfdmag'])?"• Защита от магии: ".(($row['mfdmag']>0)?"+":"")."{$row['mfdmag']}%<BR>":"")."
		".(($row['mfdfire'])?"• Защита от магии Огня: ".(($row['mfdfire']>0)?"+":"")."{$row['mfdfire']}%<BR>":"")."
        ".(($row['mfdair'])?"• Защита от магии Воздуха: ".(($row['mfdair']>0)?"+":"")."{$row['mfdair']}%<BR>":"")."
        ".(($row['mfdwater'])?"• Защита от магии Воды: ".(($row['mfdwater']>0)?"+":"")."{$row['mfdwater']}%<BR>":"")."
        ".(($row['mfdearth'])?"• Защита от магии Земли: ".(($row['mfdearth']>0)?"+":"")."{$row['mfdearth']}%<BR>":"")."
        ".(($row['mffire'])?"• Мф. мощности урона Огня: ".(($row['mffire']>0)?"+":"")."{$row['mffire']}%<BR>":"")."
        ".(($row['mfair'])?"• Мф. мощности урона Воздуха: ".(($row['mfair']>0)?"+":"")."{$row['mfair']}%<BR>":"")."
        ".(($row['mfwater'])?"• Мф. мощности урона Воды: ".(($row['mfwater']>0)?"+":"")."{$row['mfwater']}%<BR>":"")."
        ".(($row['mfearth'])?"• Мф. мощности урона Земли: ".(($row['mfearth']>0)?"+":"")."{$row['mfearth']}%<BR>":"")."
        ".(($row['mfhitp'])?"• Мф. мощности урона: ".(($row['mfhitp']>0)?"+":"")."{$row['mfhitp']}%<BR>":"")."
		".(($row['mfmagp'])?"• Мф. мощности магии: ".(($row['mfmagp']>0)?"+":"")."{$row['mfmagp']}%<BR>":"")."
		".(($row['mfpodav'])?"• Мф. подавления защиты от магии: ".(($row['mfpodav']>0)?"+":"")."{$row['mfpodav']}%<BR>":"")."
		".(($row['mfrub'])?"• Мф. мощности рубящго урона: ".(($row['mfrub']>0)?"+":"")."{$row['mfrub']}%<BR>":"")."
		".(($row['mfkol'])?"• Мф. мощности колющего урона: ".(($row['mfkol']>0)?"+":"")."{$row['mfkol']}%<BR>":"")."
		".(($row['mfdrob'])?"• Мф. мощности дробящего урона: ".(($row['mfdrob']>0)?"+":"")."{$row['mfdrob']}%<BR>":"")."
		".(($row['mfrej'])?"•  Мф. мощности режущего урона: ".(($row['mfrej']>0)?"+":"")."{$row['mfrej']}%<BR>":"")."
		".(($row['gmeshok'])?"• Увеличивает рюкзак: +{$row['gmeshok']}<BR>":"")."
		".(($row['letter'])?"Количество символов: ".strlen($row['letter'])."</div>":"")."
		".(($row['letter'])?"На бумаге записан текст:<div style='background-color:FAF0E6;'> ".nl2br($row['letter'])."</div>":"")."
		
        ".((($row['type'] == 25))?"<font color=maroon>Наложены заклятия:</font> ".$magic['name']."<BR>":"")."
		".((($row['type'] == 29))?"<font color=maroon>Наложены заклятия:</font> ".$magic['name']."<BR>":"")."
        ".(($row['text'])?"На ручке выгравирована надпись:<center>".$row['text']."</center><BR>":"")."
	
		".(($incmagic['max'])?"	Встроено заклятие <img src=\"http://img.yourc.com/i/magic/".$incmagic['img']."\" alt=\"".$incmagic['name']."\"> ".$incmagic['cur']." шт.	<BR>":"")."
		".(($row['podzem'])?"<br><font style='font-size:11px; color:#990000'>Предмет из подземелья</font><BR>":"")."
		".(($row['honor'])?"<font style='font-size:11px; color:#990000'>Предмет забытой чести</font><BR>":"")."
	    ".(($row['sh']==1)?"<i>Особенности:</i><BR>• Колющие атаки: Регулярны<BR>• Режущие атаки: Ничтожно редки<BR>• Рубящие атаки:  Ничтожно редки<BR>• Ледяные атаки: Ничтожно редки<BR>":"")."
        
		".(($row['dvur'])?"<font style='font-size:11px; color:#990000'>двуручное оружие</font><BR>":"")."
		".(($row['opisan'])?"<small>".$row['opisan']."</small><BR>":"")."
        ".((!$row['isrep'])?"<small><font color=maroon>Предмет не подлежит ремонту</font></small><BR>":"");

		}
		else { echo "<font color=maroon><B>Свойства предмета не идентифицированы</B></font><BR>"; }
	
		if($show_img) echo "</td><td><img src='http://img.yourc.com/i/sh/{$row['img']}'></td></TR>";
}

// magic
function magicinf ($id) {
	return mysql_fetch_array(mysql_query("SELECT * FROM `magic` WHERE `id` = '{$id}' LIMIT 1;"));
}

// показать перса в инфе
function showpersinv($id) {
	global $mysql, $ermg;
	$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".mysql_real_escape_string($id)."' LIMIT 1;"));
?>
	<CENTER>
	<img src="http://img.yourc.com/i/align_<?echo ($user['align']>0 ? $user['align']:"0");?>.gif"><?php if ($user['klan'] <> '') { echo '<img src="http://img.yourc.com/i/klan/'.$user['klan'].'.gif">'; }if($user['deal']>0){ echo"<img src=\"http://img.yourc.com/i/deal.gif\">"; } ?><B><?=$user['login']?></B> [<?=$user['level']?>]<a href=inf.php?<?=$user['id']?> target=_blank><img src=http://img.yourc.com/i/inf.gif WIDTH=12 HEIGHT=11 ALT="Инф. о <?=$user['login']?>"></a>
	<?
	//echo setHP($user['hp'],$user['maxhp'],$battle);
	if ($user['maxmana']) {
		//echo setMP($user['mana'],$user['maxmana'],$battle);
	}
	?>
<TABLE cellspacing=0 cellpadding=0 style="	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #FFFFFF;
	border-right-color: #666666;
	border-bottom-color: #666666;
	border-left-color: #FFFFFF;
	padding: 2px;">

<TR>
<TD>
<TABLE border=0 cellSpacing=1 cellPadding=0 width="100%">
<TBODY>
<TR vAlign=top>
<TD>
<TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
<TBODY>

<TR><TD style="BACKGROUND-IMAGE:none">
<?php
		if ($user['helm'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['helm']}' LIMIT 1;"));
                        if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(8);
                            destructitem($dress['id']);
                        }
			$mess="Снять ".$dress['name']."".(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress['ghp']:"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress['gmana']:"")."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].(($dress['text']!=null)?"\r\n<br/>На шлеме выгравировано ".$dress['text']:"");
			echo '<a href="?edit=1&drop=8"><img title="'.$mess.'" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=60></a>';
		}
		else{
			$mess='Пустой слот шлем';
			echo '<img title="'.$mess.'" src="http://img.yourc.com/i/w9.gif" width=60 height=60>';
		}
	?></TD></TR>

<TR><TD style="BACKGROUND-IMAGE:none">
<?php
		if ($user['naruchi'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['naruchi']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(22);
                            destructitem($dress['id']);
                        }
                        $mess="Снять ".$dress['name']."".(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress['ghp']:"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress['gmana']:"")."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].(($dress['text']!=null)?"\r\n<br/>На наручах выгравировано ".$dress['text']:"");
			echo '<a href="?edit=1&drop=22"><img title="'.$mess.'" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=40></a>';
		}
		else{
			$mess='Пустой слот наручи';
			echo '<img title="'.$mess.'" src="http://img.yourc.com/i/w18.gif" width=60 height=40>';
		}
	?></TD></TR>

<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['weap'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['weap']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(3);
                            destructitem($dress['id']);
                        }
                        $mess="Снять ".$dress['name']."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur']."".(($dress['minu']>0)?"\r\n<br/>Урон: {$dress['minu']}-{$dress['maxu']}":"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress['gmana']:"").(($dress['text']!=null)?"\r\n<br/>На оружии выгравировано ".$dress['text']:"");
			echo '<a href="?edit=1&drop=3"><img src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=60 title="'.$mess.'"></a>';
		}
		else{
			$mess='Пустой слот оружие';
			echo '<img title="'.$mess.'" src="http://img.yourc.com/i/w3.gif" width=60 height=60 >';
		}
	?></TD></TR>

<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		/////РУБАЩКИ////////////////////////////////////////////////////////////
		$roba = mysql_fetch_array(@mysql_query("SELECT * FROM `inventory` WHERE `owner` = '{$_SESSION['uid']}' AND `type` = 27 AND `id` = '{$user['rybax']}' LIMIT 1;"));

		$bron = mysql_fetch_array(@mysql_query("SELECT * FROM `inventory` WHERE `owner` = '{$_SESSION['uid']}' AND `type` = 4 AND `id` = '{$user['bron']}' LIMIT 1;"));

			$plaw = mysql_fetch_array(@mysql_query("SELECT * FROM `inventory` WHERE `owner` = '{$_SESSION['uid']}' AND `type` = 28 AND `id` = '{$user['plaw']}' LIMIT 1;"));

		//echo "$roba1|| hihi";
	$bro1=$bron["dressed"];
	$rob1=$roba["dressed"];
	$pla1=$plaw["dressed"];
	//print "$bro1||$rob1||$paw1";
		if ( $rob1== '1' AND $bro1!='1'AND $pla1!='1') {
		////rubaxa////

			if ($user['rybax'] > 0 ) {
			$dress = @mysql_fetch_array(@mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['rybax']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(27);
                            destructitem($dress['id']);
                        }

                        $mess="Снять ".$dress['name']."".(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress['ghp']:"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress['gmana']:"")."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].(($dress['text']!=null)?"\r\n<br/>На поясе вышито ".$dress['text']:"");
			echo '<a href="?edit=1&drop=27"><img title="'.$mess.'"  src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=80></a>';
		}
		else{
			$mess='Пустой слот броня';
			echo '<img title="'.$mess.'" src="http://img.yourc.com/i/w4.gif" width=60 height=80>';
		}
		}


		if (($rob1!= '1' AND $bro1!= '1' AND $pla1!='1')  OR ($rob1= '1' AND $bro1== '1' AND $pla1!='1') OR
	 ($rob1!= '1' AND $bro1 = '1' AND $pla1!='1') ) {



		if ($user['bron'] > 0 ) {
			$dress = @mysql_fetch_array(@mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['bron']}' LIMIT 1;"));
						$dress_rub = @mysql_fetch_array(@mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['rybax']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(4);
                            destructitem($dress['id']);
                        }
                        if((($dress_rub['maxdur'] <= ($dress_rub['duration'])) OR ($dress_rub['dategoden']>0 && $dress_rub['dategoden'] <= time())))
                        {
                            dropitem(27);
                            destructitem($dress_rub['id']);
                        }
                                                $mess="Снять ".$dress['name']."".(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress['ghp']:"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress['gmana']:"")."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].(($dress['text']!=null)?"\r\n<br/>На поясе вышито ".$dress['text']:"");
			if($user['rybax'] > 0 ){$mess.="\r\n<br/>-------------\r\n<br/>".$dress_rub['name']."".(($dress_rub['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress_rub['ghp']:"").(($dress_rub['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress_rub['gmana']:"")."\r\n<br/>Долговечность: ".$dress_rub['duration']."/".$dress_rub['maxdur'].(($dress_rub['text']!=null)?"\r\n<br/>На поясе вышито ".$dress_rub['text']:"");}

			echo '<a href="?edit=1&drop=4"><img title="'.$mess.'" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=80></a>';
		}
		else{
			$mess='Пустой слот броня';
			echo '<img title="'.$mess.'" src="http://img.yourc.com/i/w4.gif" width=60 height=80>';
		}

		}

		elseif (($rob1!= '1' AND $bro1!= '1' AND $pla1=='1')  OR
		($rob1=='1' AND $bro1!=='1' AND $pla1=='1') OR
	 ($rob1!='1' AND $bro1=='1' AND $pla1=='1')  OR
	 ($rob1=='1' AND $bro1=='1' AND $pla1=='1'))
	  {
		if ($user['plaw'] > 0 ) {
			$dress = @mysql_fetch_array(@mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['plaw']}' LIMIT 1;"));
			$dress_bro = @mysql_fetch_array(@mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['bron']}' LIMIT 1;"));
			$dress_rub = @mysql_fetch_array(@mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['rybax']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(28);
                            destructitem($dress['id']);
                        }
                        if((($dress_bro['maxdur'] <= ($dress_bro['duration'])) OR ($dress_bro['dategoden']>0 && $dress_bro['dategoden'] <= time())))
                        {
                            dropitem(4);
                            destructitem($dress_bro['id']);
                        }
                        if((($dress_rub['maxdur'] <= ($dress_rub['duration'])) OR ($dress_rub['dategoden']>0 && $dress_rub['dategoden'] <= time())))
                        {
                            dropitem(27);
                            destructitem($dress_rub['id']);
                        }
                        $mess="Снять ".$dress['name']."".(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress['ghp']:"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress['gmana']:"")."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].(($dress['text']!=null)?"\r\n<br/>На поясе вышито ".$dress['text']:"");
			if($user['bron'] > 0 ){$mess.="\r\n<br/>-------------\r\n<br/>".$dress_bro['name']."".(($dress_bro['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress_bro['ghp']:"").(($dress_bro['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress_bro['gmana']:"")."\r\n<br/>Долговечность: ".$dress_bro['duration']."/".$dress_bro['maxdur'].(($dress_bro['text']!=null)?"\r\n<br/>На поясе вышито ".$dress_bro['text']:"");}

			if($user['rybax'] > 0 ){$mess.="\r\n<br/>-------------\r\n<br/>".$dress_rub['name']."".(($dress_rub['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress_rub['ghp']:"").(($dress_rub['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress_rub['gmana']:"")."\r\n<br/>Долговечность: ".$dress_rub['duration']."/".$dress_rub['maxdur'].(($dress_rub['text']!=null)?"\r\n<br/>На поясе вышито ".$dress_rub['text']:"");}
			echo '<a href="?edit=1&drop=28"><img title="'.$mess.'" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=80></a>';
		}
		else{
			$mess='Пустой слот броня';
			echo '<img title="'.$mess.'" src="http://img.yourc.com/i/w4.gif" width=60 height=80>';
		}
		}
	?></TD></TR>

<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['belt'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['belt']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(23);
                            destructitem($dress['id']);
                        }
                        $mess="Снять ".$dress['name']."".(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress['ghp']:"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress['gmana']:"")."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].(($dress['text']!=null)?"\r\n<br/>На поясе вышито ".$dress['text']:"");
			echo '<a href="?edit=1&drop=23"><img title="'.$mess.'" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=40></a>';
		}
		else{
			$mess='Пустой слот пояс';
			echo '<img title="'.$mess.'" src="http://img.yourc.com/i/w5.gif" width=60 height=40>';
		}
	?></TD></TR>
</TBODY></TABLE>
</TD>

<TD>
<TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
<TR>
<TD height=20 vAlign=middle>
<table cellspacing="0" cellpadding="0" style='line-height: 1'>
<tr>
<td nowrap style="font-size:9px" style="position: relative">
<?$gbb=getBrowser(); if($gbb['name']=='Internet Explorer') {$leftbind=5;} else {$leftbind=70;}?>
<table cellspacing="0" cellpadding="0" style='line-height: 1'><td nowrap style="font-size:9px" style="position: relative"><SPAN id="HP" style='position: absolute; left: <?=$leftbind?>; z-index: 100; font-weight: bold; color: #FFFFFF'></SPAN><img src="http://img.yourc.com/i/misc/bk_life_loose.gif" alt="Уровень жизни" name="HP1" width="1" height="9" id="HP1"><img src="http://img.yourc.com/i/misc/bk_life_loose.gif" alt="Уровень жизни" name="HP2" width="1" height="9" id="HP2"></td></table></td>
</tr>

<?if($user['maxmana']>0) {?>
<tr>
<td nowrap style="font-size:9px" style="position: relative">
<SPAN id="MP" style='position: absolute; left: <?=$leftbind?>; z-index: 1; font-weight: bold; color: #80FFFF'></SPAN><img src="http://img.yourc.com/i/misc/bk_life_loose.gif" alt="Уровень Маны" name="MP1" width="1" height="9" id="MP1"><img src="http://img.yourc.com/i/misc/bk_life_loose.gif" alt="Уровень Маны" name="MP2" width="1" height="9" id="MP2"><span style="width:1px; height:10px"></span></td>
</tr>
<?}?>

</table>
</TD></TR>
<TR><TD height=220 vAlign=top width=120 align=left>
<?
$zver=mysql_fetch_array(mysql_query("SELECT shadow,login,level FROM `users` WHERE `id` = '".mysql_real_escape_string($user['zver_id'])."' LIMIT 1;"));
if($zver){
if($ermg){$otsttop=203;}else{$otsttop=187;}
?>
<div style="position:absolute; left:145px; top:<?=$otsttop?>px; width:40px; height:73px; z-index:2">
<a href="zver_inv.php">
<IMG width=40 height=73 src='http://img.yourc.com/i/shadow/<?print"".$zver['shadow']."";?>' onmouseout='ghideshow();'  onmouseover='gfastshow("<?=$zver['login']?> [<?=$zver['level']?>] (Перейти к настройкам)");'>
</a></div>
<? }?>
<DIV style="Z-INDEX: 1; POSITION: relative; WIDTH: 120px; HEIGHT: 220px" bgcolor="black">
<IMG border=0 src="http://img.yourc.com/i/shadow/<?=$user['sex']?>/<?print"".$user['shadow']."";?>" width=120 height=218>
<?
$ch_eff1 = mysql_query ('SELECT * FROM `effects` WHERE  `owner` = '.$_SESSION['uid'].' and (`type`=188 or `type`=9998 or `type`=1000 or `type`=9 or `type`=99 or `type`=999 or `type`=9999 or `type`=99999 or `type`=99799 or `type`=9871 or `type`=901 or `type`=900 or `type`=750 or `type`=395 or  `type`=300 or `type`=301 or `type`=303 or `type`=304 or `type`=305 or `type`=306 or `type`=308 or `type`=311 or `type`=312 or `type`=313 or `type`=314 or `type`=315 or `type`=316 or `type`=317 or `type`=66766 or `type`=171717 or `type`=171718 or `type`=171719 or `type`=171720 or `type`=201 or `type`=202 or `type`=1022)');
$i=0;
while($ch_eff = mysql_fetch_array($ch_eff1)){
$i++;
				switch ($i) {
					case '1':$left=0;$top=0;break;
					case '2':$left=40;$top=0;break;
					case '3':$left=80;$top=0;break;
					case '4':$left=0;$top=25;break;
					case '5':$left=40;$top=25;break;
					case '6':$left=80;$top=25;break;
					case '7':$left=0;$top=50;break;
					case '8':$left=40;$top=50;break;
					case '9':$left=80;$top=50;break;
					case '10':$left=0;$top=75;break;
					case '11':$left=40;$top=75;break;
					case '12':$left=80;$top=75;break;
				}
$inf_el = mysql_fetch_array(mysql_query ('SELECT img FROM `shop_cap` WHERE `name` = \''.$ch_eff['name'].'\';'));
if($ch_eff['type']==395){$inf_el['img']='defender.gif'; $opp='награда'; $chas=60; $chastxt="час.";}elseif($ch_eff['type']==303){$inf_el['img']='power_hp6.gif'; $opp='заклятие';  $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==304){$inf_el['img']='food_l5_eng.gif'; $opp='еда'; $chas=1;  $chastxt="мин.";}elseif($ch_eff['type']==305){$inf_el['img']='ruba1.gif'; $opp='еда'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==306){$inf_el['img']='apple.gif'; $opp='еда'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==314){$inf_el['img']='hleb1.gif'; $opp='еда'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==315){$inf_el['img']='standart_food.gif'; $opp='еда'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==316){$inf_el['img']='tortik1.gif'; $opp='еда'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==301){$inf_el['img']='spell_godprotect.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==300){$inf_el['img']='spell_godprotect10.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==308){$inf_el['img']='pot_base_100_master.gif'; $opp='эликсир'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==311){$inf_el['img']='spell_powerup3.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==312){$inf_el['img']='spell_powerup2.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==313){$inf_el['img']='spell_powerup4.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==9){$inf_el['img']='spell_stat_intel.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==99){$inf_el['img']='spell_godstat_inst.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==999){$inf_el['img']='spell_godstat_str.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==317){$inf_el['img']='pot_base_200_alldmg2.gif'; $opp='эликсир'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==9999){$inf_el['img']='spell_godstat_dex.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==99999){$inf_el['img']='invoke_spell_godintel100.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==99799){$inf_el['img']='invoke_spell_godmana100.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==9871){$inf_el['img']='invoke_movespeed_dungeon60_15.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==171717){$inf_el['img']='tz.gif'; $opp='книга'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==171718){$inf_el['img']='tz.gif'; $opp='книга'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==171719){$inf_el['img']='tz.gif'; $opp='книга'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==171720){$inf_el['img']='tz.gif'; $opp='книга'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==66766){$inf_el['img']='wis_light_shield.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==901){$inf_el['img']='power_hp5.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==900){$eff_image='blago_admin.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==750){$inf_el['img']='spell_powerup1.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}
elseif($ch_eff['type']==9998){$eff_image='blago_admin.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==201){$inf_el['img']='spell_protect10.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==202){$inf_el['img']='spell_powerup10.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}elseif($ch_eff['type']==1022){$inf_el['img']='hidden.gif'; $opp='заклятие'; $chas=1; $chastxt="мин.";}else{$opp='эликсир'; $chas=1; $chastxt="мин.";}

if($inf_el['img']!=""){$eff_image=$inf_el['img'];} else {
if($ch_eff['name']=="Снадобье Великана"){$inf_el['img']="pot_base_200_bot3.gif";}
if($ch_eff['name']=="Снадобье Змеи"){$inf_el['img']="pot_base_200_bot2.gif";}
if($ch_eff['name']=="Снадобье Предчувствия"){$inf_el['img']="pot_base_200_bot1.gif";}
if($ch_eff['name']=="Снадобье Разума"){$inf_el['img']="pot_base_200_bot4.gif";}
if($ch_eff['name']=="Нектар Могущества"){$eff_image="pot_base_50_str2.gif";}
if($ch_eff['name']=="Нектар Стремительности"){$eff_image="pot_base_50_dex2.gif";}
if($ch_eff['name']=="Нектар Прозрения"){$eff_image="pot_base_50_inst2.gif";}
if($ch_eff['name']=="Нектар Разума"){$eff_image="pot_base_50_intel2.gif";}
if($ch_eff['name']=="Защита от магии"){$eff_image="spell_protect_mag.gif";}
if($ch_eff['name']=="Новогодний Зелье"){$eff_image="pot_base_0_strup.gif";}
if($ch_eff['name']=="Новогоднее Зелье"){$eff_image="pot_base_0_strup.gif";}
if($ch_eff['name']=="Благословение звезд"){$eff_image="blago_admin.gif";}
if($ch_eff['name']=="Благословение Ангела"){$eff_image="blago_admin.gif";}
if($ch_eff['name']=="Холодный разум"){$eff_image="spell_stat_intel.gif";}
if($ch_eff['name']=="Жажда Жизни +5"){$eff_image="power_hp5.gif";}
if($ch_eff['name']=="Огненное Усиление"){$eff_image="spell_powerup1.gif";}
if($ch_eff['name']=="Сила Великана"){$eff_image="spell_godstat_str.gif";}
if($ch_eff['name']=="Скорость Змеи"){$eff_image="spell_godstat_dex.gif";}
if($ch_eff['name']=="Предчувствие"){$eff_image="spell_godstat_inst.gif";}
if($ch_eff['name']=="Ледяной Интеллек"){$eff_image="invoke_spell_godintel100.gif";}
if($ch_eff['name']=="Мудрость Веков"){$eff_image="invoke_spell_godmana100.gif";}
if($ch_eff['name']=="Мягкая Посыупь"){$eff_image="invoke_movespeed_dungeon60_15.gif";}
if($ch_eff['name']=="Неуязвимость Оружию"){$eff_image="spell_godprotect10.gif";}
if($ch_eff['name']=="Неуязвимость Стихиям"){$eff_image="spell_godprotect.gif";}
if($ch_eff['name']=="Жажда Жизни +6"){$eff_image="power_hp6.gif";}
if($ch_eff['name']=="Бутерброд -The Best Friend-"){$eff_image="food_l5_eng.gif";}
if($ch_eff['name']=="Жесткая Рыба"){$eff_image="ruba1.gif";}
if($ch_eff['name']=="Яблоко Раздора"){$eff_image="apple.gif";}
if($ch_eff['name']=="Снадобье Забытых Мастеров"){$eff_image="pot_base_100_master.gif";}
if($ch_eff['name']=="Воздушное усилиение"){$eff_image="spell_powerup3.gif";}
if($ch_eff['name']=="Водное усиление"){$eff_image="spell_powerup2.gif";}
if($ch_eff['name']=="Земное усиление"){$eff_image="spell_powerup4.gif";}
if($ch_eff['name']=="Хлеб с мясом"){$eff_image="hleb1.gif";}
if($ch_eff['name']=="Бутерброд"){$eff_image="standart_food.gif";}
if($ch_eff['name']=="Тортик"){$eff_image="tortik1.gif";}
if($ch_eff['name']=="Зелье Каменной Стойкости"){$eff_image="pot_base_200_alldmg2.gif";}
if($ch_eff['name']=="Тайный том 1"){$eff_image="tz.gif";}
if($ch_eff['name']=="Тайный том 2"){$eff_image="tz.gif";}
if($ch_eff['name']=="Тайный том 3"){$eff_image="tz.gif";}
if($ch_eff['name']=="Тайный том 4"){$eff_image="tz.gif";}
if($ch_eff['name']=="Право на Опыт"){$eff_image="wis_light_shield.gif";}
}
 ?>	<div style="position:absolute; left:<?=$left?>px; top:<?=$top?>px; width:120px; height:220px; z-index:2"><IMG width=40 height=25 src='http://img.yourc.com/i/misc/icon_<?=$inf_el['img']?>' onmouseout='ghideshow();' onmouseover='gfastshow("<B><? echo $ch_eff['name'];?></B> (<?=$opp?>)<BR> еще <? echo ceil(($ch_eff['time']-time())/60/$chas);?> <?=$chastxt?>")';> </div>
<?}?>
<DIV style="Z-INDEX: 2; POSITION: absolute; WIDTH: 120px; HEIGHT: 220px; TOP: 0px; LEFT: 0px"></DIV></DIV></TD></TR>
<TR>
<TD>
						<table width="120" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td width="40" height="20">
<?php
		if ($user['karman1'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['karman1']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(1);
                            destructitem($dress['id']);
                        }
                        $mess="Снять ".$dress['name']."".(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress['ghp']:"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress['gmana']:"")."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].(($dress['text']!=null)?"\r\n<br/>На предмете выгравировано ".$dress['text']:"");
			echo '<a href="?edit=1&drop=29"><img src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=40 height=20 title="'.$mess.'"></a>';
		}
		else{
			$mess='Пустой слот карман 1';
			echo '<img src="http://img.yourc.com/i/w15.gif" width=40 height=20 title="'.$mess.'">';
		}
	?></td>
						  <td width="40" height="20"><img src="http://img.yourc.com/i/w15.gif" /></td>
						  <td width="40" height="20"><?php
		if ($user['karman2'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['karman2']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(1);
                            destructitem($dress['id']);
                        }
                        $mess="Снять ".$dress['name']."".(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress['ghp']:"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress['gmana']:"")."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].(($dress['text']!=null)?"\r\n<br/>На предмете выгравировано ".$dress['text']:"");
			echo '<a href="?edit=1&drop=30"><img src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=40 height=20 title="'.$mess.'"></a>';
		}
		else{
			$mess='Пустой слот карман 2';
			echo '<img src="http://img.yourc.com/i/w15.gif" width=40 height=20 title="'.$mess.'">';
		}
	?></td>
						</tr>
						<tr>
						  <td width="40" height="20"><img src="http://img.yourc.com/i/w20.gif" /></td>
						  <td width="40" height="20"><img src="http://img.yourc.com/i/w20.gif" /></td>
						  <td width="40" height="20"><img src="http://img.yourc.com/i/w20.gif" /></td>
						</tr>
					  </table>
<?

?>
</TD>
</TR></TBODY></TABLE></TD>
<TD><TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
<TBODY><TR><TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['sergi'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['sergi']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(1);
                            destructitem($dress['id']);
                        }
                        $mess="Снять ".$dress['name']."".(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress['ghp']:"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress['gmana']:"")."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].(($dress['text']!=null)?"\r\n<br/>На серьгах выгравировано ".$dress['text']:"");
			echo '<a href="?edit=1&drop=1"><img src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=20 title="'.$mess.'"></a>';
		}
		else{
			$mess='Пустой слот серьги';
			echo '<img src="http://img.yourc.com/i/w1.gif" width=60 height=20 title="'.$mess.'">';
		}
	?></TD></TR>
<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['kulon'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['kulon']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(2);
                            destructitem($dress['id']);
                        }
                        $mess="Снять ".$dress['name']."".(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress['ghp']:"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress['gmana']:"")."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].(($dress['text']!=null)?"\r\n<br/>На кулоне выгравировано ".$dress['text']:"");
			echo '<a href="?edit=1&drop=2"><img src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=20 title="'.$mess.'"></a>';
		}
		else{
			$mess='Пустой слот ожерелье';
			echo '<img src="http://img.yourc.com/i/w2.gif" width=60 height=20 title="'.$mess.'">';
		}
	?></TD></TR>

<TR><TD><TABLE border=0 cellSpacing=0 cellPadding=0>
<TBODY> <TR>
<TD style="BACKGROUND-IMAGE: none"><?php
		if ($user['r1'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['r1']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
						
                            dropitem(5);
                            destructitem($dress['id']);
                        }
                        $mess="Снять ".$dress['name']."".(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress['ghp']:"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress['gmana']:"")."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].(($dress['text']!=null)?"\r\n<br/>На кольце выгравировано ".$dress['text']:"");
			echo '<a href="?edit=1&drop=5"><img title="'.$mess.'" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=20 height=20></a>';
		}
		else{
			$mess='Пустой слот кольцо';
			echo '<img title="'.$mess.'" src="http://img.yourc.com/i/w6.gif" width=20 height=20 >';
		}
	?></td>
<TD style="BACKGROUND-IMAGE: none"><?php
		if ($user['r2'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['r2']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(6);
                            destructitem($dress['id']);
                        }
                        $mess="Снять ".$dress['name']."".(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress['ghp']:"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress['gmana']:"")."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].(($dress['text']!=null)?"\r\n<br/>На кольце выгравировано ".$dress['text']:"");
			echo '<a href="?edit=1&drop=6"><img title="'.$mess.'" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=20 height=20></a>';
		}
		else{
			$mess='Пустой слот кольцо';
			echo '<img src="http://img.yourc.com/i/w6.gif" width=20 height=20 title="'.$mess.'">';
		}
	?></td>
<TD style="BACKGROUND-IMAGE: none"><?php
		if ($user['r3'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['r3']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(7);
                            destructitem($dress['id']);
                        }
                        $mess="Снять ".$dress['name']."".(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress['ghp']:"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress['gmana']:"")."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].(($dress['text']!=null)?"\r\n<br/>На кольце выгравировано ".$dress['text']:"");
			echo '<a href="?edit=1&drop=7"><img title="'.$mess.'" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=20 height=20></a>';
		}
		else{
			$mess='Пустой слот кольцо';
			echo '<img title="'.$mess.'" src="http://img.yourc.com/i/w6.gif" width=20 height=20 alt="Пустой слот кольцо" >';
		}
	?></td>
</TR></TBODY></TABLE></TD></TR>
<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['perchi'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['perchi']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(9);
                            destructitem($dress['id']);
                        }
                        $mess="Снять ".$dress['name']."".(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress['ghp']:"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress['gmana']:"")."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].(($dress['text']!=null)?"\r\n<br/>На перчатках выгравировано ".$dress['text']:"");
			echo '<a href="?edit=1&drop=9"><img title="'.$mess.'" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=40></a>';
		}
		else{
			$mess='Пустой слот перчатки';
			echo '<img title="'.$mess.'" src="http://img.yourc.com/i/w11.gif" width=60 height=40>';
		}
	?></TD></TR>
<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['shit'] > 0) {
			if($user['shit']==$user['weap']){
				$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['shit']}' LIMIT 1;"));
				if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(10);
                            destructitem($dress['id']);
                        }
                                $mess="Снять ".$dress['name']."".(($dress['minu']>0)?"\r\n<br/>Урон: {$dress['minu']}-{$dress['maxu']}":"").(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress['ghp']:"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress['gmana']:"")."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].(($dress['text']!=null)?"\r\n<br/>На щите выгравировано ".$dress['text']:"");
				echo '<a href="?edit=1&drop=10"><img title="'.$mess.'" src="http://img.yourc.com/i/w3.gif" width=60 height=60></a>';
			}else{
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['shit']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(10);
                            destructitem($dress['id']);
                        }
                        $mess="Снять ".$dress['name']."".(($dress['minu']>0)?"\r\n<br/>Урон: {$dress['minu']}-{$dress['maxu']}":"").(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress['ghp']:"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress['gmana']:"")."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].(($dress['text']!=null)?"\r\n<br/>На щите выгравировано ".$dress['text']:"");
			echo '<a href="?edit=1&drop=10"><img title="'.$mess.'" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=60></a>';
			}
		}
		else{
			$mess='Пустой слот щит';
			echo '<img title="'.$mess.'" src="http://img.yourc.com/i/w10.gif" width=60 height=60>';
		}
	?></TD></TR>
<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['leg'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['leg']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(24);
                            destructitem($dress['id']);
                        }
                        $mess="Снять ".$dress['name']."".(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress['ghp']:"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress['gmana']:"")."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].(($dress['text']!=null)?"\r\n<br/>На поножах выгравировано ".$dress['text']:"");
			echo '<a href="?edit=1&drop=24"><img title="'.$mess.'" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=80></a>';
		}
		else{
			$mess='Пустой слот поножи';
			echo '<img title="'.$mess.'" src="http://img.yourc.com/i/w19.gif" width=60 height=80>';
		}
	?></TD></TR>
<TR><TD style="BACKGROUND-IMAGE: none">
<?php
		if ($user['boots'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['boots']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(11);
                            destructitem($dress['id']);
                        }
                        $mess="Снять ".$dress['name']."".(($dress['ghp']>0)?"\r\n<br/>Уровень жизни: +".$dress['ghp']:"").(($dress['gmana']>0)?"\r\n<br/>Уровень маны: +".$dress['gmana']:"")."\r\n<br/>Долговечность: ".$dress['duration']."/".$dress['maxdur'].(($dress['text']!=null)?"\r\n<br/>На сапогах выжжено ".$dress['text']:"");
			echo '<a href="?edit=1&drop=11"><img title="'.$mess.'" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=60 height=40></a>';
		}
		else{
			$mess='Пустой слот обувь';
			echo '<img title="'.$mess.'" src="http://img.yourc.com/i/w12.gif" width=60 height=40>';
		}
	?></TD></TR>

</TBODY></TABLE></TD></TR>


<?if ($user['m1'] > 0 or $user['m2'] > 0 or $user['m3'] > 0 or $user['m4'] > 0 or $user['m5'] > 0 or $user['m6'] > 0 or $user['m7'] > 0 or $user['m8'] > 0 or $user['m9'] > 0 or $user['m10'] > 0 or $user['m11'] > 0 or $user['m12'] > 0) {?>
<TR>
	<TD colspan=3>
	<?
		if ($user['m1'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['m1']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(12);
                            destructitem($dress['id']);
                        }
                        $mess='Снять '.$dress['name'].'<br>Долговечность: '.$dress['duration'].'/'.$dress['maxdur'];
			echo '<a href="?edit=1&drop=12"><img  onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=40 height=25></a>';
		} else {
				$mess='пустой слот магия';
				echo '<img onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src=http://img.yourc.com/i/w13.gif  width=40 height=25>';
		  }
		if ($user['m2'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['m2']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(13);
                            destructitem($dress['id']);
                        }
                        $mess='Снять '.$dress['name'].'<br>Долговечность: '.$dress['duration'].'/'.$dress['maxdur'];
			echo '<a href="?edit=1&drop=13"><img  onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=40 height=25></a>';
		} else {
				$mess='пустой слот магия';
				echo '<img onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src=http://img.yourc.com/i/w13.gif  width=40 height=25>';
		  }
		if ($user['m3'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['m3']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(14);
                            destructitem($dress['id']);
                        }
                        $mess='Снять '.$dress['name'].'<br>Долговечность: '.$dress['duration'].'/'.$dress['maxdur'];
			echo '<a href="?edit=1&drop=14"><img  onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=40 height=25></a>';
		} else {
				$mess='пустой слот магия';
				echo '<img onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src=http://img.yourc.com/i/w13.gif  width=40 height=25>';
		  }
		if ($user['m4'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['m4']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(15);
                            destructitem($dress['id']);
                        }
                        $mess='Снять '.$dress['name'].'<br>Долговечность: '.$dress['duration'].'/'.$dress['maxdur'];
			echo '<a href="?edit=1&drop=15"><img  onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=40 height=25></a>';
		} else {
				$mess='пустой слот магия';
				echo '<img onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src=http://img.yourc.com/i/w13.gif  width=40 height=25>';
		  }
		if ($user['m5'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['m5']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(16);
                            destructitem($dress['id']);
                        }
                        $mess='Снять '.$dress['name'].'<br>Долговечность: '.$dress['duration'].'/'.$dress['maxdur'];
			echo '<a href="?edit=1&drop=16"><img  onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=40 height=25></a>';
		} else {
				$mess='пустой слот магия';
				echo '<img onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src=http://img.yourc.com/i/w13.gif  width=40 height=25>';
		  }
		if ($user['m6'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['m6']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(17);
                            destructitem($dress['id']);
                        }
                        $mess='Снять '.$dress['name'].'<br>Долговечность: '.$dress['duration'].'/'.$dress['maxdur'];
			echo '<a href="?edit=1&drop=17"><img  onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=40 height=25></a>';
		} else {
				$mess='пустой слот магия';
				echo '<img onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src=http://img.yourc.com/i/w13.gif  width=40 height=25>';
		  }
	?>
	</TD>
</TR>
<TR>
	<TD colspan=3>
	<?
		if ($user['m7'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['m7']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(18);
                            destructitem($dress['id']);
                        }
                        $mess='Снять '.$dress['name'].'<br>Долговечность: '.$dress['duration'].'/'.$dress['maxdur'];
			echo '<a href="?edit=1&drop=18"><img onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=40 height=25></a>';
		} else {
				$mess='пустой слот магия';
				echo '<img onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src=http://img.yourc.com/i/w13.gif  width=40 height=25>';
		  }
		if ($user['m8'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['m8']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(19);
                            destructitem($dress['id']);
                        }
                        $mess='Снять '.$dress['name'].'<br>Долговечность: '.$dress['duration'].'/'.$dress['maxdur'];
			echo '<a href="?edit=1&drop=19"><img onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=40 height=25></a>';
		} else {
				$mess='пустой слот магия';
				echo '<img onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src=http://img.yourc.com/i/w13.gif width=40 height=25>';
		  }
		if ($user['m9'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['m9']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(20);
                            destructitem($dress['id']);
                        }
                        $mess='Снять '.$dress['name'].'<br>Долговечность: '.$dress['duration'].'/'.$dress['maxdur'];
			echo '<a href="?edit=1&drop=20"><img onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=40 height=25></a>';
		} else {
				$mess='пустой слот магия';
				echo '<img onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src=http://img.yourc.com/i/w13.gif  width=40 height=25>';
		  }
		if ($user['m10'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['m10']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(21);
                            destructitem($dress['id']);
                        }
                        $mess='Снять '.$dress['name'].'<br>Долговечность: '.$dress['duration'].'/'.$dress['maxdur'];
			echo '<a href="?edit=1&drop=21"><img  onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=40 height=25></a>';
		} else {
				$mess='пустой слот магия';
				echo '<img onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src=http://img.yourc.com/i/w13.gif  width=40 height=25>';
		  }
		if ($user['m11'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['m11']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(25);
                            destructitem($dress['id']);
                        }
                        $mess='Снять '.$dress['name'].'<br>Долговечность: '.$dress['duration'].'/'.$dress['maxdur'];
			echo '<a href="?edit=1&drop=25"><img  onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=40 height=25></a>';
		} else {
				$mess='пустой слот магия';
				echo '<img onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src=http://img.yourc.com/i/w13.gif  width=40 height=25>';
		  }
		if ($user['m12'] > 0) {
			$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id` = '{$user['m12']}' LIMIT 1;"));
			if((($dress['maxdur'] <= ($dress['duration'])) OR ($dress['dategoden']>0 && $dress['dategoden'] <= time())))
                        {
                            dropitem(26);
                            destructitem($dress['id']);
                        }
                        $mess='Снять '.$dress['name'].'<br>Долговечность: '.$dress['duration'].'/'.$dress['maxdur'];
			echo '<a href="?edit=1&drop=26"><img  onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src="http://img.yourc.com/i/sh/'.$dress['img'].'" width=40 height=25></a>';
		} else {
				$mess='пустой слот магия';
				echo '<img onMouseOut="HideOpisShmot()" onMouseOver="OpisShmot(event,\''.$mess.'\')" src=http://img.yourc.com/i/w13.gif  width=40 height=25>';
		  }
	?>
	</TD>
</TR>
<? }?>

</TBODY></TABLE></TD></TR>
<TR><TD></TD>

</TABLE>
<?

if ($_GET['clear_abil']) {

  if ($_GET['clear_abil']=='all') {

    clear_abils($myinfo);

    unset($myinfo->puton);$myinfo->setputon();

  }else{

    $all=$_GET['all'];$showcat=$_GET['show_cat'];

    //$res=db_use('array',"SELECT id_priem FROM priem WHERE priem='".$_GET['clear_abil']."';");
    $res=mysql_fetch_array(mysql_query("SELECT id_priem FROM priem WHERE priem='".$_GET['clear_abil']."';"));
//    db_use("query","DELETE FROM puton WHERE id_person='".$myinfo->id_person."' AND id_thing='".$res['id_priem']."';");
    mysql_query("DELETE FROM puton WHERE id_person='".$_SESSION['uid']."' AND id_thing='".$res['id_priem']."';");

//    unset($myinfo->puton);$myinfo->setputon();

  }



}








if ($_GET['set_abil'] ) {

$all=$_GET['all'];$showcat=$_GET['show_cat'];$doit=true;

$res=mysql_fetch_array(mysql_query("SELECT id_priem FROM priem WHERE priem='".$_GET['set_abil']."';"));
//$res=db_use('array',"SELECT id_priem FROM priem WHERE priem='".$_GET['set_abil']."';");

$id_priem=$res['id_priem'];

if ($id_priem) {
$res=mysql_query("SELECT slot,id_thing FROM puton WHERE slot>=201 AND slot<=214 AND id_person='".$_SESSION['uid']."' order by slot;");
// $res=db_use('query',"SELECT slot,id_thing FROM puton WHERE slot>=201 AND slot<=210 AND id_person='".$myinfo->id_person."' order by slot;");$j=200;
$j=200;
  unset($i);while ($s=mysql_fetch_array($res)) {

    $j++;

    if ($s['id_thing']==$id_priem) {$doit=false;break;}

    if (!$x && $s['slot']!=$j) {$x=$j;} elseif (!$x && $j==210) {$x=1000;}

  }unset($i);if (!$x) {$x=$j+1;};unset($j);

  if ($doit) {

    if ($x==1000) {

      $x=214;mysql_query("UPDATE puton SET id_thing='".$id_priem."' WHERE id_person='".$_SESSION['uid']."' AND slot='".$x. "';");

    }else{
mysql_query("INSERT INTO puton(id_person,id_thing,slot) VALUES ('".$_SESSION['uid']."','".$id_priem."','".$x."');");
 //   db_use('query',"INSERT INTO puton(id_person,id_thing,slot) VALUES ('".$myinfo->id_person."','".$id_priem."','".$x."');");

    }



  }

  unset($x,$id_priem);

}

}












class prieminfo{
  var $id_priem;
  var $name;
  var $type;
  var $priem;
  var $n_block;
  var $n_counter;
  var $n_hit;
  var $n_hp;
  var $n_krit;
  var $n_parry;
  var $minlevel;
  var $wait;
  var $maxuses;
  var $minhp;
  var $sduh_proc;
  var $sduh;
  var $hod;
  var $intel;
  var $mana;
  var $opisan;
  var $m_magic1;
  var $m_magic2;
  var $m_magic3;
  var $m_magic4;
  var $m_magic5;
  var $m_magic6;

  var $m_magic7;
  var $needsil;
  var $needvyn;
  function prieminfo($s,$priem) { # либо по id ($s) либо по названию $priem
    if ($s) {
$res=mysql_fetch_array (mysql_query("select * from priem where id_priem='".$s."';"));
  //    $res=db_use('array',"select * from priem where id_priem='".$s."';");
    }else{
$res=mysql_fetch_array (mysql_query("select * from priem where priem='".$priem."';"));
 //     $res=db_use('array',"select * from priem where priem='".$priem."';");
    }
    $this->id_priem=$res['id_priem'];#$id_priem;
    $this->name=$res['name'];
    $this->type=$res['type'];
    $this->priem=$res['priem'];
    $this->n_block=$res['n_block'];
    $this->n_counter=$res['n_counter'];
    $this->n_hit=$res['n_hit'];
    $this->n_hp=$res['n_hp'];
    $this->n_krit=$res['n_krit'];
    $this->n_parry=$res['n_parry'];
    $this->minlevel=$res['minlevel'];
    $this->wait=$res['wait'];
    $this->maxuses=$res['maxuses'];
    $this->minhp=$res['minhp'];
    $this->sduh_proc=$res['sduh_proc'];
    $this->sduh=$res['sduh'];
    $this->hod=$res['hod'];
    $this->intel=$res['intel'];
    $this->mana=$res['mana'];
    $this->opisan=$res['opisan'];
    $this->m_magic1=$res['m_magic1'];
    $this->m_magic2=$res['m_magic2'];
    $this->m_magic3=$res['m_magic3'];
    $this->m_magic4=$res['m_magic4'];
    $this->m_magic5=$res['m_magic5'];
    $this->m_magic6=$res['m_magic6'];
    $this->m_magic7=$res['m_magic7'];
    $this->needsil=$res['need_sil'];
    $this->needvyn=$res['need_vyn'];
  }
  
function check_hars($n) {
global $user; # проверка. n=0: все хар-ки n=1: только жизнь и мана
    if($n==0) {

      if(($this->minlevel<=$user['level']) && ($this->intel<=$user['intel']) && ($this->needsil<=$user['sila']) && ($this->needvyn<=$user['vinos']) && ($this->m_magic1<=$user['mfire']) && ($this->m_magic2<=$user['mwater']) && ($this->m_magic3<=$user['mair']) && ($this->m_magic4<=$user['mearth']) && ($this->m_magic5<=$user['mlight']) && ($this->m_magic6<=$user['mgray']) && ($this->m_magic7<=$user['mdark']) ) {
        return true;
      }else{return false;}
    }elseif($n==1){
      if($this->check_hars(0) && ($this->mana<=$user['mana']) && ($this->minhp<=$user['hp'])) {
        return true;     # !!!!!!!!!!!!!!!! НЕ ДОДЕЛАНО !!!!!!!!!!!!!!!!!!!!!!
      }else{return false;}
    }
  }
  function checkbattlehars($myinfo,$hit,$krit,$parry,$counter,$block,$s_duh) { # влад магией, статы + хар-ки битвы
  if (
  $hit>=$this->n_hit &&
  $krit>=$this->n_krit &&
  $parry>=$this->n_parry &&
  $counter>=$this->n_counter &&
  $hp>=$this->n_hp &&
  $block>=$this->n_block &&
  $user['level']>=$this->minlevel &&
  $user['hp']>=$this->minhp &&
  ($s_duh && ($s_duh>=$this->sduh OR $this->sduh_proc)) &&
  $user['intel']>=$this->intel &&
  $user['mana']>=$this->mana &&
  $user['mfire']>=$this->m_magic1 &&
  $user['mwater']>=$this->m_magic2 &&
  $user['mair']>=$this->m_magic3 &&
  $user['mearth']>=$this->m_magic4 &&
  $user['mlight']>=$this->m_magic5 &&
  $user['mgray']>=$this->m_magic6 &&
  $user['mdark']>=$this->m_magic7 &&
  $user['sila']>=$this->needsil &&
  $user['vinos']>=$this->needvyn ) {
  return true;}
  }
  }




function printpriem($prinfo,$myinfo,$n) {
global $harnames,$all,$showcat, $user;

#1
echo "
";
$check1=$prinfo->check_hars(0);

if (!in_array($prinfo->priem,array('block_absolute','block_activeshield','block_addchange','block_aftershock','block_circleshield','block_fullshield','block_magicshield','block_path','block_restore','block_revenge','block_target','block_target_shield','blood_gainattack','counter_bladedance','counter_deathwalk','counter_ward','counter_winddance','hit_empower','hit_luck','hit_natisk','hit_overhit','hit_resolve','hit_restrike','hit_shock','hit_strong','hit_target_sword','hit_willpower','hp_circleshield','hp_cleance','hp_defence','hp_enrage','hp_laststrike','hp_natisk','hp_regen','hp_trade','hp_travma','invoke_create_bloodstone','invoke_create_lesserbloodstone','krit_blindluck','krit_blooddrink','krit_bloodlust','krit_crush','krit_wildluck','multi_agressiveshield','multi_blockchanges','multi_cowardshift','multi_doom','multi_followme','multi_hiddendodge','multi_hiddenpower','multi_hitshock','multi_resolvetactic','multi_rollback','multi_skiparmor','multi_speedup','novice_def','novice_hit','novice_hp','parry_prediction','parry_secondlife','parry_supreme','spirit_1_protfire100','spirit_2_protwater100','spirit_3_protair100','spirit_4_protearth100','spirit_11_prot_100','spirit_12_prot_100','spirit_13_prot_100','spirit_14_prot_100','spirit_block25','spirit_survive','wis_air_chaincure05','wis_air_chaincure06','wis_air_chaincure07','wis_air_chaincure08','wis_air_chaincure09','wis_air_chaincure10','wis_air_chaincure11','wis_air_chainlight06','wis_air_chainlight07','wis_air_chainlight08','wis_air_chainlight09','wis_air_chainlight10','wis_air_chainlight11','wis_air_charge','wis_air_charge_dmg','wis_air_charge_gain','wis_air_charge_shock','wis_air_manaheal','wis_air_mark','wis_air_sacrifice','wis_air_shaft04','wis_air_shaft05','wis_air_shaft06','wis_air_shaft07','wis_air_shaft08','wis_air_shaft09','wis_air_shaft10','wis_air_shaft11','wis_air_shield','wis_air_shield07','wis_air_shield08','wis_air_shield09','wis_air_shield10','wis_air_sign','wis_air_spark','wis_air_sparks08','wis_air_sparks09','wis_air_sparks10','wis_air_sparks11','wis_air_speed','wis_dark_damage07','wis_dark_damage08','wis_dark_damage09','wis_dark_damage10','wis_dark_damage11','wis_dark_eyeforeye','wis_dark_manadamage07','wis_dark_manadamage08','wis_dark_manadamage09','wis_dark_manadamage10','wis_dark_manadamage11','wis_dark_souleat','wis_dark_soulweak','wis_earth_cleance','wis_earth_dmg04','wis_earth_dmg05','wis_earth_dmg06','wis_earth_dmg07','wis_earth_dmg08','wis_earth_dmg09','wis_earth_dmg10','wis_earth_dmg11','wis_earth_flower08','wis_earth_flower09','wis_earth_flower10','wis_earth_flower11','wis_earth_gravity07','wis_earth_gravity08','wis_earth_gravity09','wis_earth_gravity10','wis_earth_gravity11','wis_earth_heal05','wis_earth_heal06','wis_earth_heal07','wis_earth_heal08','wis_earth_heal09','wis_earth_heal10','wis_earth_heal11','wis_earth_link_minus','wis_earth_link_plus','wis_earth_link_zero','wis_earth_mark','wis_earth_meteor06','wis_earth_meteor07','wis_earth_meteor08','wis_earth_meteor09','wis_earth_meteor10','wis_earth_meteor11','wis_earth_rain05','wis_earth_rain06','wis_earth_rain07','wis_earth_rain08','wis_earth_rain09','wis_earth_rain10','wis_earth_rain11','wis_earth_sacrifice','wis_earth_shield','wis_earth_shield2','wis_earth_sign','wis_earth_strike07','wis_earth_strike08','wis_earth_summon','wis_fire_boost','wis_fire_burst08','wis_fire_burst09','wis_fire_burst10','wis_fire_burst11','wis_fire_flamedeath','wis_fire_flamedestroy','wis_fire_flameshock','wis_fire_flametongue','wis_fire_flamming06','wis_fire_flamming07','wis_fire_flamming08','wis_fire_flamming09','wis_fire_flamming10','wis_fire_flamming11','wis_fire_heal05','wis_fire_heal06','wis_fire_heal07','wis_fire_heal08','wis_fire_heal09','wis_fire_heal10','wis_fire_heal11','wis_fire_hiddenpower','wis_fire_incenerate04','wis_fire_incenerate05','wis_fire_incenerate06','wis_fire_incenerate07','wis_fire_incenerate08','wis_fire_incenerate09','wis_fire_incenerate10','wis_fire_incenerate11','wis_fire_mark','wis_fire_sacrifice','wis_fire_shield','wis_fire_sign','wis_gray_beam','wis_gray_forcefield07','wis_gray_forcefield08','wis_gray_forcefield09','wis_gray_forcefield10','wis_gray_forcefield11','wis_gray_manabarrier','wis_gray_manabarrier07','wis_gray_manabarrier08','wis_gray_manabarrier09','wis_gray_manabarrier10','wis_gray_manabarrier11','wis_gray_mastery','wis_gray_meditation','wis_light_heal','wis_light_cleance','wis_light_damage07','wis_light_damage08','wis_light_damage09','wis_light_damage10','wis_light_damage11','wis_light_heal07','wis_light_heal08','wis_light_heal09','wis_light_heal10','wis_light_heal11','wis_light_insight07','wis_light_insight08','wis_light_insight09','wis_light_insight10','wis_light_insight11','wis_light_shield','wis_water_aheal','wis_water_break','wis_water_cleance','wis_water_cloud08','wis_water_cloud09','wis_water_cloud10','wis_water_cloud11','wis_water_crystalize','wis_water_frost04','wis_water_frost05','wis_water_frost06','wis_water_frost07','wis_water_frost08','wis_water_frost09','wis_water_frost10','wis_water_frost11','wis_water_hiddenpower','wis_water_icegrap','wis_water_mark','wis_water_poison06','wis_water_poison07','wis_water_poison08','wis_water_poison09','wis_water_poison10','wis_water_poison11','wis_water_regen05','wis_water_regen06','wis_water_regen07','wis_water_regen08','wis_water_regen09','wis_water_regen10','wis_water_regen11','wis_water_sacrifice','wis_water_shield','wis_water_sign','wis_water_spirit','wis_water_strike','wis_water_tempheal','rogue_zalp','attack_strongshot','attack_bloodflow','attack_cuttingshot','attack_headsh','warrior','warlord','gladiator','dreadnought','dualist','knight','dark_avenger','paladin','phoenix_knight','hell_knight'))) {$check12=false;
}else {$check12=true;}
if ($n==0) {
	echo "<A HREF='/umenie.php?clear_abil=".$prinfo->priem."&all=".$_GET['all'].($showcat?'&show_cat='.$showcat:'')."&r=".rand(0,50000000)."&all=".(0+$_GET['all']).($showcat?'&show_cat='.$showcat:'')."'><IMG style=\"cursor:hand\" ";
}elseif ($n==1 && $check1) {
	echo "<A HREF='/umenie.php?set_abil=".$prinfo->priem."&all=".(0+$_GET['all']).($showcat?'&show_cat='.$showcat:'')."&r=".rand(0,50000000)."'><IMG style=\"cursor:hand\" ";
}elseif(($n==1 && !$check1) OR $n==2 or ($n==0 && !$check1)) {
	echo"<IMG style=\"filter:gray(), Alpha(Opacity='70');\" ";
}
if (($n==1 or $n==0) && !$check12) {
echo "style=\"filter:gray(), Alpha(Opacity='70');\"";
}
		echo "width=40 height=25 src='i/priem/".$prinfo->priem.".gif'
			onmouseout='hideshow();' onmouseover='fastshow(\"<B>".$prinfo->name."</B><BR>";
		if ($prinfo->n_hit) {echo "<IMG width=7 height=8 src=http://img.yourc.com/i/misc/micro/hit.gif> ".
					$prinfo->n_hit."&nbsp;&nbsp; ";
					}
		if ($prinfo->n_counter) {echo"<IMG width=7 height=8 src=http://img.yourc.com/i/misc/micro/counter.gif> ".$prinfo->n_counter."&nbsp;&nbsp; ";}
		if ($prinfo->n_parry) {echo"<IMG width=7 height=8 src=http://img.yourc.com/i/misc/micro/parry.gif> ".$prinfo->n_parry."&nbsp;&nbsp; ";}
		if ($prinfo->n_krit) {echo"<IMG width=7 height=8 src=http://img.yourc.com/i/misc/micro/krit.gif> ".$prinfo->n_krit."&nbsp;&nbsp; ";}
		if ($prinfo->n_block) {echo"<IMG width=7 height=8 src=http://img.yourc.com/i/misc/micro/block.gif> ".$prinfo->n_block."&nbsp;&nbsp; ";}
		if ($prinfo->n_hp) {echo"<IMG width=7 height=8 src=http://img.yourc.com/i/misc/micro/hp.gif> ".$prinfo->n_hp."&nbsp;&nbsp; ";}
		echo "<BR>";
		if ($prinfo->sduh) {echo"Сила духа: ".$prinfo->sduh."<BR>";
		}elseif ($prinfo->sduh_proc) {echo"Сила духа: ".$prinfo->sduh_proc."%<BR>";}
		if ($prinfo->mana) {echo"Расход маны: ".$prinfo->mana."<BR>";}
		if ($prinfo->wait) {echo"Задержка: ".$prinfo->wait."<BR>";}
		if ($prinfo->hod) {echo"&bull; Прием тратит ход<BR>";	}
		if ($prinfo->minlevel OR $prinfo->intel OR
		$prinfo->minhp OR $prinfo->m_magic1 OR $prinfo->m_magic2
		OR $prinfo->m_magic3 OR $prinfo->m_magic4 OR $prinfo->m_magic6) {
			echo "<BR><B>Минимальные требования:</B><BR>";
			if ($prinfo->intel) {
				echo ($prinfo->intel>$user['intel']?"<font color=red>":"").
				"Интеллект: ".$prinfo->intel."<BR>".
				($prinfo->intel>$user['intel']?"</font>":"");
			}

			if ($prinfo->m_magic1) {
				echo ($prinfo->m_magic1>$user['mfire']?"<font color=red>":"").
				"Мастерство владения стихией Огня: ".$prinfo->m_magic1."<BR>".
				($prinfo->m_magic1>$user['mfire']?"</font>":"");
			}
			if ($prinfo->m_magic2) {
				echo ($prinfo->m_magic2>$user['mwater']?"<font color=red>":"").
				"Мастерство владения стихией Воды: ".$prinfo->m_magic2."<BR>".
				($prinfo->m_magic2>$user['mwater']?"</font>":"");
			}
			if ($prinfo->m_magic3) {
				echo ($prinfo->m_magic3>$user['mair']?"<font color=red>":"").
				"Мастерство владения стихией Воздуха: ".$prinfo->m_magic3."<BR>".
				($prinfo->m_magic3>$user['mair']?"</font>":"");
			}
			if ($prinfo->m_magic4) {
				echo ($prinfo->m_magic4>$user['mearth']?"<font color=red>":"").
				"Мастерство владения стихией Земли: ".$prinfo->m_magic4."<BR>".
				($prinfo->m_magic4>$user['mearth']?"</font>":"");
			}
			if ($prinfo->m_magic5) {
				echo ($prinfo->m_magic5>$user['mlight']?"<font color=red>":"").
				"Мастерство владения магией Света: ".$prinfo->m_magic5."<BR>".
				($prinfo->m_magic5>$user['mlight']?"</font>":"");
			}
			if ($prinfo->m_magic6) {
				echo ($prinfo->m_magic6>$user['mgray']?"<font color=red>":"").
				"Мастерство владения Серой магией: ".$prinfo->m_magic6."<BR>".
				($prinfo->m_magic6>$user['mgray']?"</font>":"");
			}
			if ($prinfo->m_magic7) {
				echo ($prinfo->m_magic7>$user['mdark']?"<font color=red>":"").
				"Мастерство владения магией Тьмы: ".$prinfo->m_magic7."<BR>".
				($prinfo->m_magic7>$user['mdark']?"</font>":"");
			}
			if ($prinfo->minhp) {
				echo "Уровень жизни (HP): ".$prinfo->minhp."<BR>";
			}
			if ($prinfo->minlevel) {
				echo ($prinfo->minlevel>$user['level']?"<font color=red>":"").
				"Уровень: ".$prinfo->minlevel."<BR>".
				($prinfo->minlevel>$user['level']?"</font>":"");
			}
		}
		echo"<BR>".$prinfo->opisan."\",300)'>".($n==2?'':"</A>");


}
echo"<SCRIPT>
var p_name;

function redirectto (s) {
	location = s;
}

function show_div(o) {
	if (p_name) {document.all[p_name].style.display=\"none\"};
	p_name = o;
	document.all[o].style.display=\"\";
}
</SCRIPT>";

print"<br /><table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
  ";
$res=mysql_query("select slot,id_thing from puton where id_person='".$_SESSION['uid']."' and slot>=201 and slot<=214;");
//  $res=db_use('query',"select slot,id_thing from puton where id_person='".$this->id_person."' and slot>=201 and slot<=214;");
 while ($s=mysql_fetch_array($res)) {

    $puton[$s['slot']]=$s['slot']; // =new prieminfo($s['id_thing'],0);
    $puton2[$s['slot']]=$s['id_thing'];
  }


if($user['level']>=2){
for ($i=201;$i<=205;$i++) {
	echo"<TD>";

	if ($puton[$i]) {
		printpriem(new prieminfo($puton2[$i],0),$myinfo,0);
	} else {
		echo"<IMG style=\"\" width=40 height=25 src='http://img.yourc.com/i/sh/clearPriem.gif'>";
	}
	echo "</TD>";
}unset($i);

echo "</TR><TR><TD colspan=5 height=3><SPAN></SPAN></TD></TR><TR>";
}
if($user['level']>=2){
for ($i=206;$i<=210;$i++) {
	echo"<TD>";
	if ($puton[$i]) {
		printpriem(new prieminfo($puton2[$i],0),$myinfo,0);
	} else {
		echo"<IMG style=\"\" width=40 height=25 src='http://img.yourc.com/i/sh/clearPriem.gif'>";
	}
	echo "</TD>";
}unset($i);
}
if($user['slot11']==1 && $user['level']>=2){
echo "</TR><TR><TD colspan=5 height=3><SPAN></SPAN></TD></TR><TR>";
for ($i=211;$i<=211;$i++) {
	echo"<TD>";
	if ($puton[$i]) {
		printpriem(new prieminfo($puton2[$i],0),$myinfo,0);
	} else {
		echo"<IMG style=\"\" width=40 height=25 src='http://img.yourc.com/i/sh/clearPriem.gif'>";
	}
	echo "</TD>";

}unset($i);
}
if($user['slot12']==1 && $user['level']>=2){
for ($i=212;$i<=212;$i++) {
	echo"<TD>";
	if ($puton[$i]) {
		printpriem(new prieminfo($puton2[$i],0),$myinfo,0);
	} else {
		echo"<IMG style=\"\" width=40 height=25 src='http://img.yourc.com/i/sh/clearPriem.gif'>";
	}
	echo "</TD>";

}unset($i);
}
if($user['slot13']==1 && $user['level']>=2){

for ($i=213;$i<=213;$i++) {
	echo"<TD>";
	if ($puton[$i]) {
		printpriem(new prieminfo($puton2[$i],0),$myinfo,0);
	} else {
		echo"<IMG style=\"\" width=40 height=25 src='http://img.yourc.com/i/sh/clearPriem.gif'>";
	}
	echo "</TD>";

}unset($i);
}
if($user['slot14']==1 && $user['level']>=2){

for ($i=214;$i<=214;$i++) {
	echo"<TD>";
	if ($puton[$i]) {
		printpriem(new prieminfo($puton2[$i],0),$myinfo,0);
	} else {
		echo"<IMG style=\"\" width=40 height=25 src='http://img.yourc.com/i/sh/clearPriem.gif'>";
	}
	echo "</TD>";

}unset($i);
}
function print_priems($res,$myinfo) {
global $all;
$x=0;
while ($i<mysql_num_rows($res)) {
	$i++;$j++;$s=mysql_fetch_array($res);
	#if ($j>9) {$j=1;echo "</TR><TR>";}
	$priem1=new prieminfo($s['id_priem'],0);
	$check1=$priem1->check_hars(0); 
	if ((!$_GET['all'] && $check1) OR ($_GET['all'])) {$x=1;	printpriem($priem1,$myinfo, ($s['ifa']?2:1)); }
}
return $x;
}	

print"
  </tr>
</table>";

?>
</CENTER> <?php
}
// раздеть перса
function undressall($id) {
	global $mysql;
        //$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
	for($i=1;$i<=30;$i++){
		dropitemid($i,$id);
	//	dropitem($i);
	}
	mysql_query("update users set sergi=0,kulon=0,perchi=0,weap=0,bron=0,rybax=0,plaw=0,r1=0,r2=0,r3=0,helm=0,shit=0,boots=0,m1=0,m2=0,m3=0,m4=0,m5=0,m6=0,m7=0,m8=0,m9=0,m10=0,m11=0,m12=0,karman1=0,karman2=0 where id='".$_SESSION['uid']."'");
}
function undressall2($id) {
	global $mysql;
	//$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
	for($i=1;$i<=30;$i++){
		dropitemid($i,$id);
		//dropitem($i);
	}
}
function testgoden(){
    $t=mysql_fetch_array(mysql_query("select count(id) where owner='".$_SESSION['uid']."' and `dategoden`<'".time()."' and `dategoden`>0"));
    $u=mysql_fetch_array(mysql_query("select * from users where id='".$_SESSION['uid']."'"));
    $inv=mysql_fetch_array(mysql_query("select * from inventory where owner='".$_SESSION['uid']."' and `dategoden`>0 and dressed=1"));
    
    if((($inv['maxdur'] <= ($inv['duration'])) OR ($inv['dategoden']>0 && $inv['dategoden'] <= time())))
                        {
                            foreach($u as $k=>$v){
        if($v==$inv['id']){

             mysql_query("UPDATE `users`, `inventory` SET `users`.{$k} = 0, `inventory`.dressed = 0,
			`users`.sila = `users`.sila - `inventory`.gsila,
			`users`.lovk = `users`.lovk - `inventory`.glovk,
			`users`.inta = `users`.inta - `inventory`.ginta,
			`users`.intel = `users`.intel - `inventory`.gintel,
			`users`.maxhp = `users`.maxhp - `inventory`.ghp,
			`users`.maxmana = `users`.maxmana - `inventory`.gmana,
			`users`.noj = `users`.noj - `inventory`.gnoj,
			`users`.topor = `users`.topor - `inventory`.gtopor,
			`users`.dubina = `users`.dubina - `inventory`.gdubina,
			`users`.mec = `users`.mec - `inventory`.gmech,
			`users`.posoh = `users`.posoh - `inventory`.gposoh,
			`users`.mfire = `users`.mfire - `inventory`.gfire,
			`users`.mwater = `users`.mwater - `inventory`.gwater,
			`users`.mair = `users`.mair - `inventory`.gair,
			`users`.mearth = `users`.mearth - `inventory`.gearth,
			`users`.mlight = `users`.mlight - `inventory`.glight,
			`users`.mgray = `users`.mgray - `inventory`.ggray,
			`users`.mdark = `users`.mdark - `inventory`.gdark
			`users`.mfdfire = `users`.mfdfire - `inventory`.gmfdfire
             WHERE `inventory`.id = {$v} AND `inventory`.dressed = 1 AND `inventory`.owner = '".$_SESSION['uid']."' AND `users`.id = '".$_SESSION['uid']."';");
                                }
                                
                                }
                               
                            //destructitem($inv['id']);
                        }


                                if($t[0]>1){testgoden();}
}
// скинуть шмот с ид
function dropitemid($slot,$id) {
	global $mysql;
	$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
	switch($slot) {
		case 1: $slot1 = 'sergi'; break;
		case 2: $slot1 = 'kulon'; break;
		case 3: $slot1 = 'weap'; break;
		case 4: $slot1 = 'bron'; break;
		case 5: $slot1 = 'r1'; break;
		case 6: $slot1 = 'r2'; break;
		case 7: $slot1 = 'r3'; break;
		case 8: $slot1 = 'helm'; break;
		case 9: $slot1 = 'perchi'; break;
		case 10: $slot1 = 'shit'; break;
		case 11: $slot1 = 'boots'; break;
		case 12: $slot1 = 'm1'; break;
		case 13: $slot1 = 'm2'; break;
		case 14: $slot1 = 'm3'; break;
		case 15: $slot1 = 'm4'; break;
		case 16: $slot1 = 'm5'; break;
		case 17: $slot1 = 'm6'; break;
		case 18: $slot1 = 'm7'; break;
		case 19: $slot1 = 'm8'; break;
		case 20: $slot1 = 'm9'; break;
		case 21: $slot1 = 'm10'; break;
		case 22: $slot1 = 'naruchi'; break;
		case 23: $slot1 = 'belt'; break;
		case 24: $slot1 = 'leg'; break;
		case 25: $slot1 = 'm11'; break;
		case 26: $slot1 = 'm12'; break;
		case 27: $slot1 = 'rybax'; break;
        case 28: $slot1 = 'plaw'; break;
		case 29: $slot1 = 'karman1'; break;
		case 30: $slot1 = 'karman2'; break;
	}
	$item = mysql_fetch_array(mysql_query("SELECT * FROM users u, inventory i WHERE u.id = '{$user['id']}'  and i.owner=u.id and i.id=u.{$slot1} LIMIT 1;"));
	if($item['complect_id']>0){
		mysql_query("update users set ".unsetComplectAdds($item['complect_id'], $user['id'])." where id='{$user['id']}'");
		updateComplectEff($item['complect_id'], $user['id'], 'undress');
	}
		if (mysql_query("UPDATE `users`, `inventory` SET `users`.{$slot1} = 0, `inventory`.dressed = 0,
			`users`.sila = `users`.sila - `inventory`.gsila,
			`users`.lovk = `users`.lovk - `inventory`.glovk,
			`users`.inta = `users`.inta - `inventory`.ginta,
			`users`.intel = `users`.intel - `inventory`.gintel,
			`users`.maxhp = `users`.maxhp - `inventory`.ghp,
			`users`.maxmana = `users`.maxmana - `inventory`.gmana,
			`users`.noj = `users`.noj - `inventory`.gnoj,
			`users`.topor = `users`.topor - `inventory`.gtopor,
			`users`.dubina = `users`.dubina - `inventory`.gdubina,
			`users`.mec = `users`.mec - `inventory`.gmech,
			`users`.posoh = `users`.posoh - `inventory`.gposoh,
			`users`.mfire = `users`.mfire - `inventory`.gfire,
			`users`.mwater = `users`.mwater - `inventory`.gwater,
			`users`.mair = `users`.mair - `inventory`.gair,
			`users`.mearth = `users`.mearth - `inventory`.gearth,
			`users`.mlight = `users`.mlight - `inventory`.glight,
			`users`.mgray = `users`.mgray - `inventory`.ggray,
			`users`.mdark = `users`.mdark - `inventory`.gdark
				WHERE `inventory`.id = `users`.{$slot1} AND `inventory`.dressed = 1 AND `inventory`.owner = {$user['id']} AND `users`.id = {$user['id']};"))
			mysql_query("UPDATE `users` SET `hp` = `maxhp`, `fullhptime` = ".time()." WHERE  `hp` > `maxhp` AND `id` = '{$id}' LIMIT 1;");
	{
		return 	true;
	}
}
// снять предмет
function dropitem($slot) {
	global $user, $mysql;
	$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$user['id']}' LIMIT 1;"));
	switch($slot) {
		case 1: $slot1 = 'sergi'; break;
		case 2: $slot1 = 'kulon'; break;
		case 3: $slot1 = 'weap'; break;
		case 4: $slot1 = 'bron'; break;
		case 5: $slot1 = 'r1'; break;
		case 6: $slot1 = 'r2'; break;
		case 7: $slot1 = 'r3'; break;
		case 8: $slot1 = 'helm'; break;
		case 9: $slot1 = 'perchi'; break;
		case 10: $slot1 = 'shit'; break;
		case 11: $slot1 = 'boots'; break;
		case 12: $slot1 = 'm1'; break;
		case 13: $slot1 = 'm2'; break;
		case 14: $slot1 = 'm3'; break;
		case 15: $slot1 = 'm4'; break;
		case 16: $slot1 = 'm5'; break;
		case 17: $slot1 = 'm6'; break;
		case 18: $slot1 = 'm7'; break;
		case 19: $slot1 = 'm8'; break;
		case 20: $slot1 = 'm9'; break;
		case 21: $slot1 = 'm10'; break;
		case 22: $slot1 = 'naruchi'; break;
		case 23: $slot1 = 'belt'; break;
		case 24: $slot1 = 'leg'; break;
		case 25: $slot1 = 'm11'; break;
		case 26: $slot1 = 'm12'; break;
        case 27: $slot1 = 'rybax'; break;
        case 28: $slot1 = 'plaw'; break;
        case 29: $slot1 = 'karman1'; break;
        case 30: $slot1 = 'karman2'; break;
	}
	if($user['weap']==$user['shit'] and $user['weap']){
		if($slot1=="weap"){$eee="u.shit = 0,";}
		if($slot1=="shit"){$eee="u.weap = 0,";}
	}
	$item = mysql_fetch_array(mysql_query("SELECT * FROM users u, inventory i WHERE u.id = '{$user['id']}'  and i.owner=u.id and i.id=u.{$slot1} LIMIT 1;"));
	if($item['complect_id']>0){
		mysql_query("update users set ".unsetComplectAdds($item['complect_id'], $user['id'])." where id='{$user['id']}'");
		updateComplectEff($item['complect_id'], $user['id'], 'undress');
	}
		if (mysql_query("UPDATE `users` as u, `inventory` as i SET {$eee} u.{$slot1} = 0, i.dressed = 0,
			u.sila = u.sila - i.gsila,
			u.lovk = u.lovk - i.glovk,
			u.inta = u.inta - i.ginta,
			u.intel = u.intel - i.gintel,
			u.maxhp = u.maxhp - i.ghp,
			u.maxmana = u.maxmana - i.gmana,
			u.noj = u.noj - i.gnoj,
			u.topor = u.topor - i.gtopor,
			u.dubina = u.dubina - i.gdubina,
			u.mec = u.mec - i.gmech,
			u.posoh = u.posoh - i.gposoh,
			u.mfire = u.mfire - i.gfire,
			u.mwater = u.mwater - i.gwater,
			u.mair = u.mair - i.gair,
			u.mearth = u.mearth - i.gearth,
			u.mlight = u.mlight - i.glight,
			u.mgray = u.mgray - i.ggray,
			u.mdark = u.mdark - i.gdark
				WHERE i.id = u.{$slot1} AND i.dressed = 1 AND i.owner = {$user['id']} AND u.id = {$user['id']};"))
			mysql_query("UPDATE `users` SET `hp` = `maxhp`, `fullhptime` = ".time()." WHERE  `hp` > `maxhp` AND `id` = '{$user['id']}' LIMIT 1;");
			mysql_query("UPDATE `users` SET `mana` = `maxmana`, `fullhptime` = ".time()." WHERE  `mana` > `maxmana` AND `id` = '{$user['id']}' LIMIT 1;");
	{
		return 	true;
	}
}

//сможет держать
function derj($id) {
	global $user, $mysql;
		if ($dd = mysql_query("SELECT i.`id` FROM`users` as u, `inventory` as i
			WHERE
			i.needident = 0 AND
			i.id = {$id} AND
			i.duration < i.maxdur  AND
			i.owner = {$user['id']} AND
			u.sila >= i.nsila AND
			u.lovk >= i.nlovk AND
			u.inta >= i.ninta AND
			u.vinos >= i.nvinos AND
			u.intel >= i.nintel AND
			u.mudra >= i.nmudra AND
			u.level >= i.nlevel AND
			((".(int)$user['align']." = i.nalign) or (i.nalign = 0)) AND
			u.noj >= i.nnoj AND
			u.topor >= i.ntopor AND
			u.dubina >= i.ndubina AND
			u.mec >= i.nmech AND
			u.posoh >= i.nposoh AND
			u.mfire >= i.nfire AND
			u.mwater >= i.nwater AND
			u.mair >= i.nair AND
			u.mearth >= i.nearth AND
			u.mlight >= i.nlight AND
			u.mgray >= i.ngray AND
			u.mdark >= i.ndark AND
			i.setsale = 0 AND
			u.id = {$user['id']};"))
			{

				$dd = mysql_fetch_array($dd);
				//echo $dd[0]." ";
				if($dd[0] > 0) {
					return true;
				} else {
					return false;
				}
			}

 
}

/*function droppy(){
	$stats=mysql_fetch_assoc(mysql_query("SELECT * from `users` where `id`='".$_SESSION['uid']."'"));
	while($item=mysql_fetch_assoc(mysql_query("SELECT * from `inventory` where `owner`='".$_SESSION['uid']."' and `dressed`='1'"))){
	if ($stats['level']<$item['nlevel'] or $stats['sila']<$item['nsila'] or $stats['lovk']<$item['nlovk'] or $stats['inta']<$item['ninta'] or $stats['vinos']<$item['nvinos'] or $stats['intel']<$item['nintel'] or $stats['mudra']<$item['nmudra']){
	//$error+=1;
	dropitem($item['type']);

	}
	}

	//if($error>0){
	//droppy();
	//}
}*/
// обновляем рандом
function make_seed() {
		list($usec, $sec) = explode(' ', microtime());
		return (float) $sec + ((float) $usec * 100000);
	}

// пусть падают
function ref_drop ($id) {
		global $user, $mysql;
		$err=0;
		$slot = array('sergi','kulon','weap','bron','r1','r2','r3','helm','perchi','shit','boots','m1','m2','m3','m4','m5','m6','m7','m8','m9','m10','naruchi','belt','leg','m11','m12','karman1','karman2');

		for ($i=0;$i<=29;$i++) {
			if ($user[$slot[$i]] && !derj($user[$slot[$i]])) {
				dropitem($i+1);

				$user[$slot[$i]] = null;
				//$vasa = 1;
				$err++;

			}
		}
/*		if ($user['plaw'] && !derj($user['plaw'])) {
				dropitem(28);
				$user[28] = null;
				//$vasa = 1;
$err++;
			}
			if ($user['rybax'] && !derj($user['rybax'])) {
				dropitem(27);
				$user[27] = null;
				//$vasa = 1;
$err++;
			}*/
			//if($err>0){ref_drop();}
		//	if($err>1){header("Location:main.php?edit=1");}

		//if ($vasa) { header("Location:main.php?edit=1"); }
}
// одеть предмет
function dressitem ($id) {
	global $mysql, $user;
	//mysql_query("LOCK TABLES `users` as u WRITE, `inventory` as i WRITE;");
	$item = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` as i WHERE  `duration` < `maxdur` AND `id` = '{$id}' AND `owner` = '{$_SESSION['uid']}' AND `dressed` = 0; "));
	$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` as u WHERE `id` = '{$user['id']}' LIMIT 1;"));
	switch($item['type']) {
		case 1: $slot1 = 'sergi'; break;
		case 2: $slot1 = 'kulon'; break;
		case 3: $slot1 = 'weap'; break;
		case 4: $slot1 = 'bron'; break;
		case 5: $slot1 = 'r1'; break;
		case 6: $slot1 = 'r2'; break;
		case 7: $slot1 = 'r3'; break;
		case 8: $slot1 = 'helm'; break;
		case 9: $slot1 = 'perchi'; break;
		case 10: $slot1 = 'shit'; break;
		case 11: $slot1 = 'boots'; break;
//		case 12: $slot1 = 'm1'; break;
		case 22: $slot1 = 'naruchi'; break;
		case 23: $slot1 = 'belt'; break;
		case 24: $slot1 = 'leg'; break;
		case 27: $slot1 = 'rybax'; break;
   		case 28: $slot1 = 'plaw'; break;
   		case 29: $slot1 = 'karman1'; break;
   		case 30: $slot1 = 'karman2'; break;

	}
	if($item['dvur']>0 && $item['type']==3 ){$slot1 = 'weap'; $slot2 = "u.shit = {$id},"; dropitem(3); dropitem(10);}
	if(($item['type']==3) and ($user['weap']==$user['shit']) and ($user['weap']>0)){$slot1 = 'weap'; dropitem(10);}
	if(($item['type']==10) and ($user['weap']==$user['shit'])  and ($user['shit']>0)){$slot1 = 'shit'; dropitem(3);}
	if($item['second']>0 && $item['type']==3 && $user['weap']>0){$slot1 = 'shit'; $item['type']=10;}
	if($item['type']==5)
	{
		if(!$user['r1']) { $slot1 = 'r1';}
		elseif(!$user['r2']) { $slot1 = 'r2';}
		elseif(!$user['r3']) { $slot1 = 'r3';}
		else {
			$slot1 = 'r1';
			dropitem(5);
		}
	}
	elseif($item['type']==29)
	{
		if(!$user['karman1']) { $slot1 = 'karman1';}
		elseif(!$user['karman2']) { $slot1 = 'karman2';}
		else {
			$slot1 = 'karman1';
			dropitem(29);
		}
	}
	elseif($item['type']==25)
	{
		if(!$user['m1']) { $slot1 = 'm1';}
		elseif(!$user['m2']) { $slot1 = 'm2';}
		elseif(!$user['m3']) { $slot1 = 'm3';}
		elseif(!$user['m4']) { $slot1 = 'm4';}
		elseif(!$user['m5']) { $slot1 = 'm5';}
		elseif(!$user['m6']) { $slot1 = 'm6';}
		elseif(!$user['m7']) { $slot1 = 'm7';}
		elseif(!$user['m8']) { $slot1 = 'm8';}
		elseif(!$user['m9']) { $slot1 = 'm9';}
		elseif(!$user['m10']) { $slot1 = 'm10';}
		elseif(!$user['m11']) { $slot1 = 'm11';}
		elseif(!$user['m12']) { $slot1 = 'm12';}
		else {
			$slot1 = 'm1';
			dropitem(12);
		}
	}
	else {
		dropitem($item['type']);
	}

	if (!($item['type']==25  && $item['type']==29  && $user['level'] < 4)) {
		if($item['complect_id']>0){
			mysql_query("update users set ".setComplectAdds($item['complect_id'], $user['id'])." where id='{$user['id']}'");
			//die(mysql_error());
			//die("update users set ".setComplectAdds($item['complect_id'], $user['id'])." where id='{$user['id']}'");
			updateComplectEff($item['complect_id'], $user['id'], 'dress');
		}
		
		if (mysql_query("UPDATE `users` as u, `inventory` as i SET {$slot2} u.{$slot1} = {$id}, i.dressed = 1,
			u.sila = u.sila + i.gsila,
			u.lovk = u.lovk + i.glovk,
			u.inta = u.inta + i.ginta,
			u.intel = u.intel + i.gintel,
			u.maxhp = u.maxhp + i.ghp,
			u.maxmana = u.maxmana + i.gmana,
			u.noj = u.noj + i.gnoj,
			u.topor = u.topor + i.gtopor,
			u.dubina = u.dubina + i.gdubina,
			u.mec = u.mec + i.gmech,
			u.posoh = u.posoh + i.gposoh,
			u.mfire = u.mfire + i.gfire,
			u.mwater = u.mwater + i.gwater,
			u.mair = u.mair + i.gair,
			u.mearth = u.mearth + i.gearth,
			u.mlight = u.mlight + i.glight,
			u.mgray = u.mgray + i.ggray,
			u.mdark = u.mdark + i.gdark
				WHERE
			i.needident = 0 AND
			i.id = {$id} AND
			i.dressed = 0 AND
			i.owner = {$user['id']} AND
			u.sila >= i.nsila AND
			u.lovk >= i.nlovk AND
			u.inta >= i.ninta AND
			u.vinos >= i.nvinos AND
			u.intel >= i.nintel AND
			u.mudra >= i.nmudra AND
			u.level >= i.nlevel AND
			((".(int)$user['align']." = i.nalign) or (i.nalign = 0)) AND
			u.noj >= i.nnoj AND
			u.topor >= i.ntopor AND
			u.dubina >= i.ndubina AND
			u.mec >= i.nmech AND
			u.posoh >= i.nposoh AND
			u.mfire >= i.nfire AND
			u.mwater >= i.nwater AND
			u.mair >= i.nair AND
			u.mearth >= i.nearth AND
			u.mlight >= i.nlight AND
			u.mgray >= i.ngray AND
			u.mdark >= i.ndark AND
			i.setsale = 0 AND
			u.id = {$user['id']};"))
//			if ($item['clan']) {
//			mysql_query("UPDATE `clanstorage` SET `dressed` = '1' WHERE `it_id` = '{$item['id']}';")}
{
			$user[$slot1] = $item['id'];
			return 	true;}
		}
    //mysql_query("UNLOCK TABLES;");
    //$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$user['id']}' LIMIT 1;"));
}

// одеть предмет
function dressitemkomplekt ($id,$idd) {
	global $mysql, $user;
//dad3a37aa9d50688b5157698acfd7aee
//1d564716d0441731c9aee86bdc892cfc
	
	$item = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE owner=".$_SESSION['uid']." AND dressed = 0 and duration < maxdur and id='".$idd."' order by second asc limit 1"));
	if ($item['id']=='')
		$item = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE owner=".$_SESSION['uid']." AND dressed = 0 and duration < maxdur and name='".$id."' order by duration desc limit 1"));
	    switch($item['type']) {
		case 1: $slot1 = 'sergi'; break;
		case 2: $slot1 = 'kulon'; break;
		case 3: $slot1 = 'weap'; break;
		case 4: $slot1 = 'bron'; break;
		case 5: $slot1 = 'r1'; break;
		case 6: $slot1 = 'r2'; break;
		case 7: $slot1 = 'r3'; break;
		case 8: $slot1 = 'helm'; break;
		case 9: $slot1 = 'perchi'; break;
		case 10: $slot1 = 'shit'; break;
		case 11: $slot1 = 'boots'; break;
//		case 12: $slot1 = 'm1'; break;
		case 22: $slot1 = 'naruchi'; break;
		case 23: $slot1 = 'belt'; break;
		case 24: $slot1 = 'leg'; break;
        case 27: $slot1 = 'rybax'; break;
        case 28: $slot1 = 'plaw'; break;
	    case 29: $slot1 = 'karman1'; break;
	    case 30: $slot1 = 'karman2'; break;
    
    }
	if($item['dvur']>0 && $item['type']==3){$slot1 = 'weap'; $slot2 = "u.shit = {$item['id']},"; dropitem(3); dropitem(10);}
     

		if($item['second']>0 && $item['type']==3 && $user['weap']>0){$slot1 = 'shit'; $item['type']=10;}
        	
	if($item['type']==5)
	{
		if(!$user['r1']) { $slot1 = 'r1';}
		elseif(!$user['r2']) { $slot1 = 'r2';}
		elseif(!$user['r3']) { $slot1 = 'r3';}
		else {
			$slot1 = 'r1';
			
			dropitem(5);
		}
	}
	if($item['type']==29)
	{
		if(!$user['karman1']) { $slot1 = 'karman1';}
		elseif(!$user['karman2']) { $slot1 = 'karman2';}
		else {
			$slot1 = 'karman1';
			dropitem(29);
		}
	}
 elseif($item['type']==25)
	{
		if(!$user['m1']) { $slot1 = 'm1';}
		elseif(!$user['m2']) { $slot1 = 'm2';}
		elseif(!$user['m3']) { $slot1 = 'm3';}
		elseif(!$user['m4']) { $slot1 = 'm4';}
		elseif(!$user['m5']) { $slot1 = 'm5';}
		elseif(!$user['m6']) { $slot1 = 'm6';}
		elseif(!$user['m7']) { $slot1 = 'm7';}
		elseif(!$user['m8']) { $slot1 = 'm8';}
		elseif(!$user['m9']) { $slot1 = 'm9';}
		elseif(!$user['m10']) { $slot1 = 'm10';}
		elseif(!$user['m11']) { $slot1 = 'm11';}
		elseif(!$user['m12']) { $slot1 = 'm12';}
		else {
			$slot1 = 'm1';
			dropitem(12);
		}
	}
	else {
		dropitem($item['type']);
	}
	if (!($item['type']==25  && $item['type']==29  && $user['level'] < 4)) {
		if (mysql_query("UPDATE `users` as u, `inventory` as i SET {$slot2} u.{$slot1} = {$item['id']}, i.dressed = 1,
			u.sila = u.sila + i.gsila,
			u.lovk = u.lovk + i.glovk,
			u.inta = u.inta + i.ginta,
			u.intel = u.intel + i.gintel,
			u.maxhp = u.maxhp + i.ghp,
			u.maxmana = u.maxmana + i.gmana,
			u.noj = u.noj + i.gnoj,
			u.topor = u.topor + i.gtopor,
			u.dubina = u.dubina + i.gdubina,
			u.mec = u.mec + i.gmech,
			u.posoh = u.posoh + i.gposoh,
			u.mfire = u.mfire + i.gfire,
			u.mwater = u.mwater + i.gwater,
			u.mair = u.mair + i.gair,
			u.mearth = u.mearth + i.gearth,
			u.mlight = u.mlight + i.glight,
			u.mgray = u.mgray + i.ggray,
			u.mdark = u.mdark + i.gdark
				WHERE
			i.needident = 0 AND
			i.id = {$item['id']} AND
			i.dressed = 0 AND
			i.owner = {$user['id']} AND
			((".(int)$user['align']." = i.nalign) or (i.nalign = 0)) AND
			i.setsale = 0 AND
			u.id = {$user['id']};"))
//			if ($item['clan']) {
//			mysql_query("UPDATE `clanstorage` SET `dressed` = '1' WHERE `it_id` = '{$item['id']}';")}
 {
			$user[$slot1] = $item['id'];
			return 	true;}
		}
   // mysql_query("UNLOCK TABLES;");
    //$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '{$user['id']}' LIMIT 1;"));

}

// убить предмет
function destructitem($id) {
	global $user, $mysql;
	$dress = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `owner` = '{$_SESSION['uid']}' AND `id` = '{$id}' LIMIT 1;"));
	switch($dress['type']) {
		case 1: $slot1 = 'sergi'; break;
		case 2: $slot1 = 'kulon'; break;
		case 3: $slot1 = 'weap'; break;
		case 4: $slot1 = 'bron'; break;
		case 5: $slot1 = 'r1'; break;
		case 6: $slot1 = 'r2'; break;
		case 7: $slot1 = 'r3'; break;
		case 8: $slot1 = 'helm'; break;
		case 9: $slot1 = 'perchi'; break;
		case 10: $slot1 = 'shit'; break;
		case 11: $slot1 = 'boots'; break;
//		case 12: $slot1 = 'm1'; break;
		case 22: $slot1 = 'naruchi'; break;
		case 23: $slot1 = 'belt'; break;
		case 24: $slot1 = 'leg'; break;
        case 27: $slot1 = 'rybax'; break;
        case 28: $slot1 = 'plaw'; break;
        case 29: $slot1 = 'karman1'; break;
	    case 30: $slot1 = 'karman2'; break;
	}
	if($dress['type']==5)
	{
		if($user['r1']==$dress['id']) { $slot1 = 'r1';}
		elseif($user['r2']==$dress['id']) { $slot1 = 'r2';}
		elseif($user['r3']==$dress['id']) { $slot1 = 'r3';}
	}
	if($item['type']==29)
	{
		if(!$user['karman1']) { $slot1 = 'karman1';}
		elseif(!$user['karman2']) { $slot1 = 'karman2';}
		
	}
 elseif($dress['type']==25)
	{
		if($user['m1']==$dress['id']) { $slot1 = 'm1';}
		elseif($user['m2']==$dress['id']) { $slot1 = 'm2';}
		elseif($user['m3']==$dress['id']) { $slot1 = 'm3';}
		elseif($user['m4']==$dress['id']) { $slot1 = 'm4';}
		elseif($user['m5']==$dress['id']) { $slot1 = 'm5';}
		elseif($user['m6']==$dress['id']) { $slot1 = 'm6';}
		elseif($user['m7']==$dress['id']) { $slot1 = 'm7';}
		elseif($user['m8']==$dress['id']) { $slot1 = 'm8';}
		elseif($user['m9']==$dress['id']) { $slot1 = 'm9';}
		elseif($user['m10']==$dress['id']) { $slot1 = 'm10';}
		elseif($user['m11']==$dress['id']) { $slot1 = 'm11';}
		elseif($user['m12']==$dress['id']) { $slot1 = 'm12';}
	}

	if (($dress['owner'] == $_SESSION['uid'])) {
		mysql_query("DELETE FROM `inventory` WHERE `id` = '{$id}' LIMIT 1;");
		//mysql_query("INSERT INTO `delo`(`id` , `author` ,`pers`, `text`, `type`, `date`) VALUES ('','0','{$_SESSION['uid']}','Выброшен предмент {$dress['name']}. Цена:{$dress['cost']} кр.',1,'".time()."');");
		//echo "<font color=red><b>Предмет \"{$dress['name']}\" утерян.</b></font>";
		if ($dress['dressed'] == 1) {
			mysql_query("UPDATE `users` SET `".$slot1."` = 0 WHERE `id` = '{$_SESSION['uid']}';");
		}
		return 'good';
	}
}

// использовать магию
function usemagic($id,$target) {
	global $user, $mysql, $fbattle;;
	$row = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `owner` = '{$_SESSION['uid']}' AND `id` = '{$id}' LIMIT 1;"));
	   if (((($user['sila'] >= $row['nsila']) or $user['sila'] <=0) &&
		    (($user['lovk'] >= $row['nlovk']) or $user['lovk'] <=0) &&
			(($user['inta'] >= $row['ninta']) or $user['inta'] <=0) &&
			(($user['vinos'] >= $row['nvinos']) or $user['vinos'] <=0) &&
			(($user['intel'] >= $row['nintel']) or $user['intel'] <=0) &&
			(($user['mudra'] >= $row['nmudra']) or $user['mudra'] <=0) &&
			($user['level'] >= $row['nlevel']) &&
			(((int)$user['align'] == (int)$row['nalign']) OR ($row['nalign'] == 0)) &&
			($user['noj'] >= $row['nnoj']) &&
			($user['topor'] >= $row['ntopor']) &&
			($user['dubina'] >= $row['ndubina']) &&
			($user['mec'] >= $row['nmech']) &&
			($user['posoh'] >= $row['nposoh']) &&
			($row['type'] <= 29  OR $row['type'] == 50 OR $row['type'] == 30 OR $row['type'] == 188)&&
            ($user['mfire'] >= $row['nfire']) &&
			($user['mwater'] >= $row['nwater']) &&
			($user['mair'] >= $row['nair']) &&
			($user['mearth'] >= $row['nearth']) &&
			($user['mlight'] >= $row['nlight']) &&
			($user['mgray'] >= $row['ngray']) &&
			($user['mdark'] >= $row['ndark']) &&
			($row['needident'] == 0)
			) || $row['magic'] == 48 || $row['magic'] == 50)
	{

		$magic = mysql_fetch_array(mysql_query("SELECT * FROM `magic` WHERE `id` = '{$row['magic']}' LIMIT 1;"));
		if(!$row['magic']) {
			$incmagic = mysql_fetch_array(mysql_query('SELECT * FROM `magic` WHERE `id` = \''.$row['includemagic'].'\' LIMIT 1;'));
			$incmagic['name'] = $row['includemagicname'];
			$incmagic['cur'] = $row['includemagicdex'];
			$incmagic['max'] = $row['includemagicmax'];
			if($incmagic['cur'] <= 0) {
					return false;
			}
			$magic['targeted'] = $incmagic['targeted'];
			echo "<div align=right><font color=red><b>";
			include("./magic/".$incmagic['file']);
			echo "</b></font></div>";
		}
		 else {
			echo "<div align=right><font color=red><b>";
			include("./magic/".$magic['file']);
			echo "</b></font></div>";
		}

		if ($bet) {
			if($row['maxdur'] <= ($row['duration']+1))
			{
				echo "<!--";
				destructitem($row['id']);
				echo "-->";
			}
			else
			{
				if(!$row['magic']) {
					//echo "ins";
					mysql_query("UPDATE `inventory` SET `includemagicdex` =`includemagicdex`-{$bet} WHERE `id` = {$row['id']} LIMIT 1;");
				} else {
					mysql_query("UPDATE `inventory` SET `duration` =`duration`+{$bet} WHERE `id` = {$row['id']} LIMIT 1;");
				}
			}
		}
		echo " ";
		//echo mysql_error();
	}
}

function addch ($text,$room=0) {
			global $user;
			if ($room==0) {
				$room = $user['room'];
			}
			if($fp = @fopen ("tmpdisk/chat.txt","a")){ //открытие
				flock ($fp,LOCK_EX); //БЛОКИРОВКА ФАЙЛА
				fputs($fp ,":[".time()."]:[!sys!!]:[".($text)."]:[".$room."]\r\n"); //работа с файлом
				fflush ($fp); //ОЧИЩЕНИЕ ФАЙЛОВОГО БУФЕРА И ЗАПИСЬ В ФАЙЛ
				flock ($fp,LOCK_UN); //СНЯТИЕ БЛОКИРОВКИ
				fclose ($fp); //закрытие
			}
}


function err($t) {
	echo '<font color=red>',$t,'</font>';
}

// ставим травму
function settravma($id,$type,$time=86400,$kill = false) {
	$user = mysql_fetch_array(mysql_query("SELECT `align`,`level` FROM `users` WHERE `id` = '{$id}' LIMIT 1;"));
	if((($user['align'] == 2 && mt_rand(1,100) > 20) && !$kill) OR ($user['level'] == 0)) {
		return false;
	}
	else {
	$travmalist = array ("разбитый нос","сотрясение первой степени","потрепанные уши","прикушенный язык","перелом переносицы","растяжение ноги","растяжение руки","подбитый глаз","синяк под глазом","кровоточащее рассечение","отбитая <пятая точка>","заклинившая челюсть","выбитый зуб <мудрости>","косоглазие");
	$travmalist2 = array ("отбитые почки","вывих <вырезано цензурой>","сотрясение второй степени","оторванное ухо","вывих руки","оторванные уши","поврежденный позвоночник","отбитые почки","поврежденный копчик","разрыв сухожилия","перелом ребра","перелом двух ребер","вывих ноги","сломанная челюсть");
	$travmalist3 = array ("пробитый череп","разрыв селезенки","смещение позвонков","открытый перелом руки","открытый перелом <вырезано цензурой>","излом носоглотки","непонятные, но множественные травмы","сильное внутреннее кровотечение","раздробленная коленная чашечка","перелом шеи","смещение позвонков","открытый перелом ключицы","перелом позвоночника","вывих позвоночника","сотрясение третьей степени");
	$owntravma = mysql_fetch_array(mysql_query("SELECT `type`,`id`,`sila`,`lovk`,`inta` FROM `effects` WHERE `owner` = ".$id." AND (`type`=11 OR `type`=12 OR `type`=13) ORDER by `type` DESC LIMIT 1 ;"));
	if($type != 0 && $type != 100) { $owntravma['type']= $type; }
	elseif ($type != 0 && $type == 100 && $owntravma['type']==0) {
		$type=mt_rand(1,100);
		if ($type < 10) {$owntravma['type']=25;}
		elseif ($type < 60) {$owntravma['type']="set";}
		elseif ($type < 85) {$owntravma['type']=11;}
		else {$owntravma['type']=12;}
	}
	elseif ($owntravma['type'] == 0) {
		$tr=mt_rand(1,3);
		switch($tr){
			case 1: $owntravma['type']=0; break;
			case 2: $owntravma['type']=11; break;
			case 3: $owntravma['type']=12; break;
		}
	}

		switch($owntravma['type']) {

		case 20:
                        /*$zz = mt_rand(1,3); $s=0;$l=0;$i=0;
			switch($zz){
				case 1: $s=($user['level'] + $st)*3; break;
				case 2: $l=($user['level'] + $st)*3; break;
				case 3: $i=($user['level'] + $st)*3; break;
			}*/
			$trv = $travmalist3[mt_rand(0,count($travmalist3)-1)];
//			$time = 60*60*mt_rand(15,24);
			//mysql_query("DELETE FROM `effects` WHERE `id` = '".$owntravma['id']."' LIMIT 1;");
			//mysql_query("INSERT INTO `effects` (`owner`,`name`,`time`,`type`,`sila`,`lovk`,`inta`,`vinos`) values ('".$id."','".$trv."',".(time()+$time).",13,'".$s."','".$l."','".$i."','0');");
			mysql_query("INSERT INTO `effects` (`owner`,`name`,`time`,`type`) values ('".$id."','".$trv."',".(time()+$time).",14);");

			//mysql_query("UPDATE `users` SET `sila`=`sila`+'".$owntravma['sila']."', `lovk`=`lovk`+'".$owntravma['lovk']."', `inta`=`inta`+'".$owntravma['inta']."' WHERE `id` = '".$id."' LIMIT 1;");
			mysql_query("UPDATE `users` SET `sila`=`sila`-'".$s."', `lovk`=`lovk`-'".$l."', `inta`=`inta`-'".$i."' WHERE `id` = '".$id."' LIMIT 1;");
			return $trv;
		break;
		case 0:
			$st=mt_rand(0,2);
			$zz = mt_rand(1,3); $s=0;$l=0;$i=0;
			switch($zz){
				case 1: $s=$user['level'] + $st; break;
				case 2: $l=$user['level'] + $st; break;
				case 3: $i=$user['level'] + $st; break;
			}
			$trv = $travmalist[mt_rand(0,count($travmalist)-1)];
			$time = 60*60*mt_rand(1,5);
			mysql_query("INSERT INTO `effects` (`owner`,`name`,`time`,`type`,`sila`,`lovk`,`inta`,`vinos`) values ('".$id."','".$trv."',".(time()+$time).",11,'".$s."','".$l."','".$i."','0');");
			mysql_query("UPDATE `users` SET `sila`=`sila`-'".$s."', `lovk`=`lovk`-'".$l."', `inta`=`inta`-'".$i."' WHERE `id` = '".$id."' LIMIT 1;");
			return $trv;
		break;
		case "set":
			$st=mt_rand(0,2);
			$zz = mt_rand(1,3); $s=0;$l=0;$i=0;
			switch($zz){
				case 1: $s=$user['level'] + $st; break;
				case 2: $l=$user['level'] + $st; break;
				case 3: $i=$user['level'] + $st; break;
			}
			$trv = $travmalist[mt_rand(0,count($travmalist)-1)];
			$time = 60*60*mt_rand(1,5);
			mysql_query("INSERT INTO `effects` (`owner`,`name`,`time`,`type`,`sila`,`lovk`,`inta`,`vinos`) values ('".$id."','".$trv."',".(time()+$time).",11,'".$s."','".$l."','".$i."','0');");
			mysql_query("UPDATE `users` SET `sila`=`sila`-'".$s."', `lovk`=`lovk`-'".$l."', `inta`=`inta`-'".$i."' WHERE `id` = '".$id."' LIMIT 1;");
			return $trv;
		break;
		case 11:
			$zz = mt_rand(1,3); $s=0;$l=0;$i=0;
			switch($zz){
				case 1: $s=($user['level'] + $st)*2;  break;
				case 2: $l=($user['level'] + $st)*2;  break;
				case 3: $i=($user['level'] + $st)*2;  break;
			}
			$trv = $travmalist2[mt_rand(0,count($travmalist2)-1)];
			$time = 60*60*mt_rand(5,15);
			//mysql_query("DELETE FROM `effects` WHERE `id` = '".$owntravma['id']."' LIMIT 1;");
			mysql_query("INSERT INTO `effects` (`owner`,`name`,`time`,`type`,`sila`,`lovk`,`inta`,`vinos`) values ('".$id."','".$trv."',".(time()+$time).",12,'".$s."','".$l."','".$i."','0');");
			//mysql_query("UPDATE `users` SET `sila`=`sila`+'".$owntravma['sila']."', `lovk`=`lovk`+'".$owntravma['lovk']."', `inta`=`inta`+'".$owntravma['inta']."' WHERE `id` = '".$id."' LIMIT 1;");
			mysql_query("UPDATE `users` SET `sila`=`sila`-'".$s."', `lovk`=`lovk`-'".$l."', `inta`=`inta`-'".$i."' WHERE `id` = '".$id."' LIMIT 1;");
			return $trv;
		break;
		case 12:
			$zz = mt_rand(1,3); $s=0;$l=0;$i=0;
			switch($zz){
				case 1: $s=($user['level'] + $st)*3; break;
				case 2: $l=($user['level'] + $st)*3; break;
				case 3: $i=($user['level'] + $st)*3; break;
			}
			$trv = $travmalist3[mt_rand(0,count($travmalist3)-1)];
			$time = 60*60*mt_rand(15,24);
			//mysql_query("DELETE FROM `effects` WHERE `id` = '".$owntravma['id']."' LIMIT 1;");
			mysql_query("INSERT INTO `effects` (`owner`,`name`,`time`,`type`,`sila`,`lovk`,`inta`,`vinos`) values ('".$id."','".$trv."',".(time()+$time).",13,'".$s."','".$l."','".$i."','0');");
			//mysql_query("UPDATE `users` SET `sila`=`sila`+'".$owntravma['sila']."', `lovk`=`lovk`+'".$owntravma['lovk']."', `inta`=`inta`+'".$owntravma['inta']."' WHERE `id` = '".$id."' LIMIT 1;");
			mysql_query("UPDATE `users` SET `sila`=`sila`-'".$s."', `lovk`=`lovk`-'".$l."', `inta`=`inta`-'".$i."' WHERE `id` = '".$id."' LIMIT 1;");
			return $trv;
		break;
		case 13:
			$zz = mt_rand(1,3); $s=0;$l=0;$i=0;
			switch($zz){
				case 1: $s=($user['level'] + $st)*3; break;
				case 2: $l=($user['level'] + $st)*3; break;
				case 3: $i=($user['level'] + $st)*3; break;
			}
			$trv = $travmalist3[mt_rand(0,count($travmalist3)-1)];
			$time = 60*60*mt_rand(25,26);
			//mysql_query("DELETE FROM `effects` WHERE `id` = '".$owntravma['id']."' LIMIT 1;");
			mysql_query("INSERT INTO `effects` (`owner`,`name`,`time`,`type`,`sila`,`lovk`,`inta`,`vinos`) values ('".$id."','".$trv."',".(time()+$time).",14,'".$s."','".$l."','".$i."','0');");
			//mysql_query("UPDATE `users` SET `sila`=`sila`+'".$owntravma['sila']."', `lovk`=`lovk`+'".$owntravma['lovk']."', `inta`=`inta`+'".$owntravma['inta']."' WHERE `id` = '".$id."' LIMIT 1;");
			mysql_query("UPDATE `users` SET `sila`=`sila`-'".$s."', `lovk`=`lovk`-'".$l."', `inta`=`inta`-'".$i."' WHERE `id` = '".$id."' LIMIT 1;");
			return $trv;
		break;
		}
	}
}
// удаляем травму
function deltravma($id) {
	$owntravmadb = mysql_query("SELECT `type`,`id`,`sila`,`lovk`,`inta`,`owner` FROM `effects` WHERE `id` = ".$id." AND (type=11 OR type=12 OR type=13 OR type=14);");
	while ($owntravma = mysql_fetch_array($owntravmadb)) {
		mysql_query("DELETE FROM `effects` WHERE `id` = '".$owntravma['id']."' LIMIT 1;");
		mysql_query("UPDATE `users` SET `sila`=`sila`+'".$owntravma['sila']."', `lovk`=`lovk`+'".$owntravma['lovk']."', `inta`=`inta`+'".$owntravma['inta']."' WHERE `id` = '".$owntravma['owner']."' LIMIT 1;");
	}
}
// отображаем травму
function showtrawma() {
}
// telegrafick
function telegraph($to,$text) {
	global $user;
	$ur = mysql_fetch_array(mysql_query("select `id` from `users` WHERE `login` = '{$to}' LIMIT 1;"));
	$us = mysql_fetch_array(mysql_query("select `id` from `online` WHERE `incity`='".$_SESSION['incity']."' and `date` >= ".(time()-60)." AND `id` = '{$ur['id']}' LIMIT 1;"));
	if(!$ur) {
		echo "<font color=red><b>Персонаж не найден.</b></font>";
	}
	elseif($us[0]){
		addchp (' ('.date("Y.m.d H:i").') <font color=darkblue>Сообщение телеграфом от </font><span oncontextmenu=OpenMenu()>'.nick7 ($user['id']).'</span>: '.$text.'  ','{[]}'.$to.'{[]}');
		echo "<font color=red><b>Персонаж получил ваше сообщение</b></font>";
	} else {
		// если в офе
		echo "<font color=red><b>Сообщение будет доставлено, как только персонаж будет on-line.</b></font>";
		mysql_query("INSERT INTO `telegraph` (`owner`,`date`,`text`) values ('".$ur['id']."','','".'['.date("d.m.Y H:i").'] <font color=darkblue>Сообщение по телеграфу от </font><span oncontextmenu=OpenMenu()>'.nick7 ($user['id']).'</span>: '.$text.'  '."');");
	}
}
// telegrafick
function tele_check($to,$text) {
	global $user;
	$ur = mysql_fetch_array(mysql_query("select `id` from `users` WHERE `login` = '{$to}' LIMIT 1;"));
	$us = mysql_fetch_array(mysql_query("select `id` from `online` WHERE `incity`='".$_SESSION['incity']."' and `date` >= ".(time()-60)." AND `id` = '{$ur['id']}' LIMIT 1;"));
	if(!$ur) {
		echo "<font color=red><b>Персонаж не найден.</b></font>";
	}
	elseif($us[0]){
		addchp (' ('.date("Y.m.d H:i").') <font color=darkblue>Сообщение телеграфом от </font><span oncontextmenu=OpenMenu()>'.nick7 ($user['id']).'</span>: '.$text.'  ','{[]}'.$to.'{[]}');
	} else {
		// если в офе
		mysql_query("INSERT INTO `telegraph` (`owner`,`date`,`text`) values ('".$ur['id']."','','".'['.date("d.m.Y H:i").'] <font color=darkblue>Сообщение по телеграфу от </font><span oncontextmenu=OpenMenu()>'.nick7 ($user['id']).'</span>: '.$text.'  '."');");
	}
}

function get_meshok(){
	global $user;
	$d = mysql_fetch_array(mysql_query("SELECT sum(`gmeshok`) FROM `inventory` WHERE `owner` = '{$user['id']}' AND `setsale` = 0 AND `gmeshok`>0 ; "));
	return ($user['sila']*4+$d[0]);
}
function get_meshok_to($to){
	$d = mysql_fetch_array(mysql_query("SELECT sum(`gmeshok`) FROM `inventory` WHERE `owner` = '{$to}' AND  `setsale` = 0 AND `gmeshok`>0 ; "));
	$s = mysql_fetch_array(mysql_query("SELECT sila FROM `users` WHERE `id` = '{$to}' LIMIT 1 ; "));
	return ($s['sila']*4+$s['vinos']*3+$d[0]);
}

function addlog($id,$log) {
	$fp = fopen ("/home/yourc/data/www/logs.yourc.com/backup/logs/battle".$id.".txt","a"); //открытие
	flock ($fp,LOCK_EX); //БЛОКИРОВКА ФАЙЛА
	fputs($fp , $log); //работа с файлом
	fflush ($fp); //ОЧИЩЕНИЕ ФАЙЛОВОГО БУФЕРА И ЗАПИСЬ В ФАЙЛ
	flock ($fp,LOCK_UN); //СНЯТИЕ БЛОКИРОВКИ
	fclose ($fp); //закрытие
	//chmod("/home/yourc/data/www/logs.yourc.com/backup/logs//battle".$id.".txt",666);
}

    function dressitem2 ($id) {
	global $mysql, $user;
	$item = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE  `duration` < `maxdur` AND `id` = '{$id}' AND `dressed` = 0; "));
	switch($item['type']) {
		case 1: $slot1 = 'sergi'; break;
		case 2: $slot1 = 'kulon'; break;
		case 3: $slot1 = 'weap'; break;
		case 4: $slot1 = 'bron'; break;
		case 5: $slot1 = 'r1'; break;
		case 6: $slot1 = 'r2'; break;
		case 7: $slot1 = 'r3'; break;
		case 8: $slot1 = 'helm'; break;
		case 9: $slot1 = 'perchi'; break;
		case 10: $slot1 = 'shit'; break;
		case 11: $slot1 = 'boots'; break;
		case 12: $slot1 = 'm1'; break;
		case 22: $slot1 = 'naruchi'; break;
		case 23: $slot1 = 'belt'; break;
		case 24: $slot1 = 'leg'; break;
        case 27: $slot1 = 'rybax'; break;
        case 28: $slot1 = 'plaw'; break;
	}
	if($item['type']==5)
	{
		if(!$user['r1']) { $slot1 = 'r1';}
		elseif(!$user['r2']) { $slot1 = 'r2';}
		elseif(!$user['r3']) { $slot1 = 'r3';}
		else {
			$slot1 = 'r1';
			dropitem(5);
		}
	}
	if($item['type']==29)
	{
		if(!$user['karman1']) { $slot1 = 'karman1';}
		elseif(!$user['karman2']) { $slot1 = 'karman2';}
		else {
			$slot1 = 'karman1';
			dropitem(29);
		}
	}
    elseif($item['type']==25)
	{
		if(!$user['m1']) { $slot1 = 'm1';}
		elseif(!$user['m2']) { $slot1 = 'm2';}
		elseif(!$user['m3']) { $slot1 = 'm3';}
		elseif(!$user['m4']) { $slot1 = 'm4';}
		elseif(!$user['m5']) { $slot1 = 'm5';}
		elseif(!$user['m6']) { $slot1 = 'm6';}
		elseif(!$user['m7']) { $slot1 = 'm7';}
		elseif(!$user['m8']) { $slot1 = 'm8';}
		elseif(!$user['m9']) { $slot1 = 'm9';}
		elseif(!$user['m10']) { $slot1 = 'm10';}
		elseif(!$user['m11']) { $slot1 = 'm11';}
		elseif(!$user['m12']) { $slot1 = 'm12';}
		else {
			$slot1 = 'm1';
			dropitem(12);
		}
	}
	else {
		dropitem($item['type']);
	}
	//echo $slot1,$id,$user['id'],$user['align'],$item['id'];
	if (!($item['type']==25 && $item['type']==29  && $user['level'] < 4)) {
		if (mysql_query("UPDATE `users` as u, `inventory` as i SET u.{$slot1} = {$id}, i.dressed = 1,
			u.sila = u.sila + i.gsila,
			u.lovk = u.lovk + i.glovk,
			u.inta = u.inta + i.ginta,
			u.intel = u.intel + i.gintel,
			u.maxhp = u.maxhp + i.ghp,
			u.maxmana = u.maxmana + i.gmana,
			u.noj = u.noj + i.gnoj,
			u.topor = u.topor + i.gtopor,
			u.dubina = u.dubina + i.gdubina,
			u.mec = u.mec + i.gmech,
			u.posoh = u.posoh + i.gposoh,
			u.mfire = u.mfire + i.gfire,
			u.mwater = u.mwater + i.gwater,
			u.mair = u.mair + i.gair,
			u.mearth = u.mearth + i.gearth,
			u.mlight = u.mlight + i.glight,
			u.mgray = u.mgray + i.ggray,
			u.mdark = u.mdark + i.gdark
				WHERE
			i.needident = 0 AND
			i.id = {$id} AND
			i.dressed = 0 AND
			i.owner = {$user['id']} AND
			u.sila >= i.nsila AND
			u.lovk >= i.nlovk AND
			u.inta >= i.ninta AND
			u.vinos >= i.nvinos AND
			u.intel >= i.nintel AND
			u.mudra >= i.nmudra AND
			u.level >= i.nlevel AND
			((".(int)$user['align']." = i.nalign) or (i.nalign = 0)) AND
			u.id = {$user['id']};")) {
			$user[$slot1] = $item['id'];
			return 	true;}
		}

}
//droppy();

function echoComplect($complect_id){
	$row = mysql_fetch_array(mysql_query("SELECT * FROM `complects` WHERE `id`='".$complect_id."'"));
	
	$stat_names = array('level'=>'Уровень','sila'=>'Сила','lovk'=>'Ловкость','inta'=>'Интуиция','vinos'=>'Выносливость','intel'=>'Интеллект','mudra'=>'Мудрость','duhov'=>'Духовность','mfkrit'=>'Мф. крит. удара','mfakrit'=>'Мф. против. крит. удара','mfparir'=>'Мф. парирования','mfcontr'=>'Мф. контр удара','mfuvorot'=>'Мф. увертывания','mfauvorot'=>'Мф. против увертывания','maxhp'=>'Уровень жизни','noj'=>'Мастерство владения ножами, кастетами','topor'=>'Мастерство владения топорами, секирами','dubina'=>'Мастерство владения дубинамии, булавами','mec'=>'Мастерство владения мечами');
	
	$complect = $row['name'];
	$complect_id = $row['id'];
	$params = $row['adds'];
	$add = array();
	
	$__adds = explode(';', $params);
		
	$c = mysql_fetch_assoc(mysql_query("select count(*) as count from inventory where owner='".$_SESSION['uid']."' and complect_id='$complect_id' and dressed=1"));
	
	foreach($__adds as $_adds_){	
		$_adds = explode(':', $_adds_);
		$adds = $_adds[1];	
			$add_ = explode('|',$adds);
			foreach($add_ as $_add){			
				$stat = explode('=',$_add);
				$add[$_adds[0]][$stat[0]] = (($stat[1]>0)?'+':'-').$stat[1];
			}
	}
	
	$ret = '<span title="';
	
	foreach($add as $l=>$add_level){
		$ret .= '&bull; <font color=green><b>'.$l.'</b></font>: ';
		foreach($add_level as $stat_name=>$stat){
			$ret .= $stat_names[$stat_name].': '.$stat.'<br/>';
		}
	}
	$ret .= '">';
			
	
	$ret .= '<b>'.$complect.'</b> ['.$c['count'].'/'.max(array_keys($add)).']</span>';
	
	return $ret;
}

function setComplectAdds($complect_id, $user_id){
	$data = mysql_fetch_assoc(mysql_query("select * from complects where id='".$complect_id."'"));
	$c = mysql_fetch_assoc(mysql_query("select count(*) as count from inventory where owner='".$user_id."' and complect_id='".$complect_id."' and dressed=1"));
	$weared_items = $c['count']+1;
	
	$add = array();
	$ret = array();
	$ret[] = 'sila=sila';
	$__adds = explode(';', $data['adds']);
	
		foreach($__adds as $_adds_){	
			$_adds = explode(':', $_adds_);
			$adds = $_adds[1];	
				$add_ = explode('|',$adds);
				foreach($add_ as $_add){			
					$stat = explode('=',$_add);
					$add[$_adds[0]][$stat[0]] = (($stat[1]>0)?($stat[0].'+'.$stat[1]):($stat[0].'-'.$stat[1]));
				}
		}
		
		foreach($add as $level=>$add_level){
			if($level==$weared_items){
				foreach($add_level as $stat_name=>$stat){
					$ret[] = $stat_name.'='.$stat;
				}
			}
		}
		//die(implode(',', $ret));
	return implode(',', $ret);
}

function unsetComplectAdds($complect_id, $user_id){
	$data = mysql_fetch_assoc(mysql_query("select * from complects where id='".$complect_id."'"));
	$c = mysql_fetch_assoc(mysql_query("select count(*) as count from inventory where owner='".$user_id."' and complect_id='".$complect_id."' and dressed=1"));
	$weared_items = $c['count'];
	
	$add = array();
	$ret = array();
	$ret[] = 'sila=sila';
	$__adds = explode(';', $data['adds']);
	
		foreach($__adds as $_adds_){	
			$_adds = explode(':', $_adds_);
			$adds = $_adds[1];	
				$add_ = explode('|',$adds);
				foreach($add_ as $_add){			
					$stat = explode('=',$_add);
					$add[$_adds[0]][$stat[0]] = (($stat[1]>0)?($stat[0].'-'.$stat[1]):($stat[0].'+'.$stat[1]));
				}
		}
		
		foreach($add as $level=>$add_level){
			if($level==$weared_items){
				foreach($add_level as $stat_name=>$stat){
					$ret[] = $stat_name.'='.$stat;
				}
			}
		}
		//die(implode(',', $ret));
	return implode(',', $ret);
}

function updateComplectEff($complect_id, $user_id, $action){
	$complect_eff = mysql_fetch_assoc(mysql_query("SELECT count(*) as count FROM complects_eff WHERE owner='".$user_id."' and complects_id='".$complect_id."'"));
	$complect_weared = $complect_eff['count'];
	
		if($action=='dress'){
			if($complect_weared==0){
				mysql_query("insert into complects_eff set weared_items=1, owner='".$user_id."', complects_id='".$complect_id."'");
			}else{
				mysql_query("update complects_eff set weared_items=weared_items+1 where owner='".$user_id."' and complects_id='".$complect_id."'");
			}
		}elseif($action=='undress'){
			mysql_query("update complects_eff set weared_items=weared_items-1 where owner='".$user_id."' and complects_id='".$complect_id."'");
			
			$dressed = mysql_fetch_assoc(mysql_query("select count(*) as count from inventory where owner='".$user_id."' and complect_id='".$complect_id."' and dressed=1"));
			if($dressed['count']==1){
				mysql_query("delete from complects_eff where owner='".$user_id."' and complects_id='".$complect_id."'");
			}
		}
}
?>
