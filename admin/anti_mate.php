<?

setlocale (LC_ALL, "ru_RU.CP1251");

class anti_mate {
		var $let_matches = array (
	"a" => "а",
	"c" => "с",
	"e" => "е",
	"k" => "к",
	"m" => "м",
	"o" => "о",
	"x" => "х",
	"y" => "у",
	"ё" => "е"
							 );
		var $bad_words = array (".*ху(й|и|я|е|л(и|е)).*", ".*пи(з|с)д.*", "бля.*", ".*бля(д|т|ц).*", "(с|сц)ук(а|о|и).*", "еб.*", ".*уеб.*", "заеб.*", ".*еб(а|и)(н|с|щ|ц).*", ".*ебу(ч|щ).*", ".*пид(о|е)р.*", ".*хер.*", ".*г(а|о)ндон.*", ".*залуп.*", ".*залуп.*", "член", "пидр", "жопа", ".*писю.*", "мудак", "гнида", "комбатс", "c", "com", "r.?u", "net", "k",);

	
	function rand_replace (){
			$output = " <font color=red>в/ц</font> ";
			return $output;
	}

function filter ($string){
			$counter = 0;
			$elems = explode (" ", $string); 			$count_elems = count($elems);
			for ($i=0; $i<$count_elems; $i++)
			{
			$blocked = 0;
			
			$str_rep = eregi_replace ("[^a-zA-Zа-яА-Яё]", "", strtolower($elems[$i]));
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
