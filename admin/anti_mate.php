<?

setlocale (LC_ALL, "ru_RU.CP1251");

class anti_mate {
		var $let_matches = array (
	"a" => "�",
	"c" => "�",
	"e" => "�",
	"k" => "�",
	"m" => "�",
	"o" => "�",
	"x" => "�",
	"y" => "�",
	"�" => "�"
							 );
		var $bad_words = array (".*��(�|�|�|�|�(�|�)).*", ".*��(�|�)�.*", "���.*", ".*���(�|�|�).*", "(�|��)��(�|�|�).*", "��.*", ".*���.*", "����.*", ".*��(�|�)(�|�|�|�).*", ".*���(�|�).*", ".*���(�|�)�.*", ".*���.*", ".*�(�|�)����.*", ".*�����.*", ".*�����.*", "����", "����", "����", ".*����.*", "�����", "�����", "�������", "c", "com", "r.?u", "net", "k",);

	
	function rand_replace (){
			$output = " <font color=red>�/�</font> ";
			return $output;
	}

function filter ($string){
			$counter = 0;
			$elems = explode (" ", $string); 			$count_elems = count($elems);
			for ($i=0; $i<$count_elems; $i++)
			{
			$blocked = 0;
			
			$str_rep = eregi_replace ("[^a-zA-Z�-��-߸]", "", strtolower($elems[$i]));
				for ($j=0; $j<strlen($str_rep); $j++)
				{
					foreach ($this->let_matches as $key => $value)
					{
						if ($str_rep[$j] == $key)
						$str_rep[$j] = $value;

					}
				}
		    
				for ($k=0; $k<count($this->bad_words); $k++)
				{
					if (ereg("\*$", $this->bad_words[$k]))
					{
						if (ereg("^".$this->bad_words[$k], $str_rep))
						{
						$elems[$i] = $this->rand_replace();
						$blocked = 1;
						$counter++;
						break;
						}
					
					}
					if ($str_rep == $this->bad_words[$k]){
					$elems[$i] = $this->rand_replace();
					$blocked = 1;
					$counter++;
					break;
					}

				}
			}
			if ($counter != 0)
			$string = implode (" ", $elems); return $string;
}
}
?>
