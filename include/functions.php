<?php
defined('s@>J$qw$i8_5rvY=6d{Z@!,V%J[J4Z^8C3q*bO$%/_db~iy6Fz=eTL/^O-@VKJU{E=U^x,JfooR19xKpgQ*,A/Dbg+9@>J1%.T[sL9#-4!-A8]t') or die('Доступ запрещён!');

function log_to_file($txt, $type = 'ERROR')
{
  $log_file_path =  __DIR__  . '/../logs/all_error.log';
  $f = fopen($log_file_path, 'a');
  fwrite($f, date('Y-m-d H:i:s') . ' ' . $type . ' > ' . $txt . ' ; ' . PHP_EOL);
  fclose($f);
}

function clear_string_tel($cl_str_tel)
{
  $cl_str_tel = stripslashes($cl_str_tel);
  $cl_str_tel = mb_substr($cl_str_tel, 0, 100, 'utf-8');
  $cl_str_tel = preg_replace('/[^0-9\s\+\,\(\)\/\-]/', '', $cl_str_tel);
  $cl_str_tel = trim($cl_str_tel);

  return $cl_str_tel;
}

function echo_html_teg($str)
{
  return htmlspecialchars($str);
}

function del_js_code($str)
{
  if (is_array($str)) {
    $new_arr = [];
    foreach ($str as $key => $value) {
      if (!is_null($value)) {
        $new_arr[$key] = preg_replace('~<script[^>]*>.*?</script>~si', '', $value);
        //$new_arr[$key] = str_replace('<', '&lt;', $new_arr[$key]);
        //$new_arr[$key] = str_replace('>', '&gt;', $new_arr[$key]);
      } else {
        $new_arr[$key] = null;
      }
    }
    return $new_arr;
  } else {
	$str = preg_replace('~<script[^>]*>.*?</script>~si', '', $str);
	//$str = str_replace('<', '&lt;', $str);
    //$str = str_replace('>', '&gt;', $str);
	return $str;
  }
}

function link_transform($text_origin)
{
  $text_origin = preg_replace('/[^a-zA-Z0-9\s\_\-]{1,255}/', '', trim($text_origin));
  $text_origin = preg_replace("#\s+# ", "-", $text_origin);
  $text_origin = preg_replace("#\-+# ", "-", $text_origin);
  $text_origin = mb_strtolower($text_origin);
  return $text_origin;
}

function name_dir_win($nazv, $date='')
{
	$puth = trim(trim($date),'_') . ' ' . trim(trim($nazv),'_');
	$puth = trim($puth);
	$puth = str_replace("\\", "", $puth);
	$puth = stripcslashes($puth);
	//$puth = preg_replace('/[^a-zA-Zа-яёА-ЯЁ0-9\s\_\-]/iu', '', $puth);//разрешаем только эти символы
	$puth = preg_replace('/[\/:*?"<>|+%!@]/', '', $puth);//вырезаем только эти символы
	$puth = preg_replace('/[^\S\r\n]+/', ' ', $puth);
	$puth = preg_replace('/^(?![\r\n]\s)+|(?![\r\n]\s)+$/m', ' ', $puth);
	$puth = preg_replace('/\s+/', ' ', $puth);
	$puth = trim($puth,".");
	$puth = trim($puth);
	$puth = mb_substr($puth, 0, 150);
	return $puth;
}

function date_transform($date, $time = 0, $sec = 0)
{
  /*
  $time = 0
  from 2019-12-13 12:34:56 to 25.12.2019
  $time = 1
  from 2019-12-13 12:34:56 to 25.12.2019 12:34
  $sec = 1
  from 2019-12-13 12:34:56 to 25.12.2019 12:34:56
  */
  if (empty($date)) {
    return '1900-01-01';
  }

  if ($time == 0) {
    $date = date('d.m.Y', strtotime($date));
  } elseif ($time == 1 && $sec == 0) {
    $date = date('d.m.Y H:i', strtotime($date));
  } elseif ($sec == 1) {
    $date = date('d.m.Y H:i:s', strtotime($date));
  } else {
    $date = date('d.m.Y', strtotime($date));
  }

  return $date;
}

function date_transform_revers($date)
{
  /*
  from 25.12.2019 to 2019-12-25
  */

  return date('Y-m-d', strtotime($date));
}

function get_year($data_rojd)
{
	$birthday = new \DateTime($data_rojd);
	$interval = $birthday->diff(new \DateTime());
	return $interval->y.' лет';
}

function clear_table_column($str)
{
  $str = stripslashes($str);
  $str = mb_substr($str, 0, 155, 'utf-8');
  $str = preg_replace('/[^A-Za-z0-9\_]/', '', $str);

  return $str;
}




//\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\start password_mod//////////////////////////////////////////////
function recurs_pass($n, $n2, $salt)
{
  if (mb_strlen($n, 'utf-8') < 2) {
    return $n2;
  } else {
    $n0 = sha1($n . '7iGwc(MStWfmGEl#hYYGN6,n%NinwIs^QT|!X68pR3ODFBSoO' . $n2 . 'X8V*58p]C.qQg}:afCj)o9^B{o?aZ!t[ZUJ74o%w;p.tx;L%qr' . $n . $salt);
    return recurs_pass(substr($n, 0, -1), $n0, $salt);
  }
}

function password_mod($pass_sha, $pass_verifity = false)
{

  if ($pass_verifity) {

    if (strlen($pass_verifity) !== 128) {
      return false;
    }

    $pass_ver = substr($pass_verifity, 8, 128);
    $salt = substr($pass_verifity, 0, 8);

  } else {
    $salt = bin2hex(random_bytes(4));
  }

  $pass_md0 = '';
  $pass_120 = $pass_sha;
  $pass_sha1 = sha1('_SQz[idbIyORHuQ),zzO2K.|8d#zb],C|uG[*XBzy|F#h8{da}' . $pass_sha . '+ZIPaT$,>vf+o$Yjd6Al,X9KEqFmQ0@1d/YS.qG.kbRtvr$T(o' . $salt);
  $pass_md4 = sha1($pass_sha1[2] . $pass_sha1[7] . $pass_sha1[28] . $pass_sha1[29] . $pass_sha1 . $pass_sha1[18] . $pass_sha1[9] . $pass_sha1[28] . $pass_sha1[2]);
  $pass_md1 = sha1($salt . 'p4dxBb*gwT[O:1MYeZ3qwG_94!n^@7,MC|-?[TwpqSy_;tD-@g' . $pass_md4 . ':t%v.+c}9Y]{8$rF-=;4AHl;Am9@?{_~QjfE]28,r^NJ]E)oqS');


  $pass_md_recurs = recurs_pass($pass_sha1 . $pass_md4 . $pass_md1 . sha1($pass_md1) . sha1(sha1($pass_md1)), $pass_md1, $salt);

  $string = str_split($pass_md_recurs);
  foreach ($string as $k1 => $v1) {
    if ($k1 == 7) {
      $pass_md0 .= $v1 . $pass_md4[12];
    } elseif ($k1 == 15) {
      $pass_md0 .= $v1 . $pass_md4[8];
    } elseif ($k1 == 28) {
      $pass_md0 .= $v1 . $pass_md4[21];
    } else {
      $pass_md0 .= $v1;
    }
  }

  /*------------------------------sha1 128 simvol--------------------------------*/
  $pass_md_120_1 = sha1("A1" . $pass_md0 . $pass_120 . $pass_md_recurs[10] . "A4");
  $pass_md_120_2 = sha1("Df" . $pass_md0 . $pass_120 . $pass_md_recurs[20] . "05");
  $pass_md_120_3 = sha1("QL" . $pass_md0 . $pass_120 . $pass_md_recurs[30] . "Rq");

  if ($pass_verifity) {
    return ($salt . $pass_md_120_1 . $pass_md_120_3 . $pass_md_120_2 === $salt . $pass_ver) ? true : false;
  } else {
    return $salt . $pass_md_120_1 . $pass_md_120_3 . $pass_md_120_2;
  }

}

/////////////////////////////////end password_mod\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


function unik_id($count = 5, $microtime = false)
{
  $id_unik = $microt = '';
  $arr_let = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
  if ($microtime) {
    $mt = microtime();
    $microt = substr(str_replace(' ', '', str_replace('.', '', $mt)), 1);
  }

  for ($i = 0; $i < $count; $i++) {
    $id_unik .= $arr_let[rand(0, strlen($arr_let) - 1)];
  }

  return $id_unik . $microt;
  //KV89f
  //w0Raq396716001570908926
}

function getip()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  $ip = htmlspecialchars(substr($ip, 0, 15), ENT_QUOTES);
  return $ip;
}

function ip_blok($id_page = 'functions', $action = 'default')
{
  $header = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] . ',<br>' : '[1]';
  $header .= isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] . ',<br>' : '[2]';
  $header .= isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] . ',<br>' : '[3]';
  $header .= isset($_SERVER['HTTP_ACCEPT_ENCODING']) ? $_SERVER['HTTP_ACCEPT_ENCODING'] . ',<br>' : '[4]';
  $header .= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . ',<br>' : '[5]';
  $header .= isset($_SERVER['HTTP_CONNECTION']) ? $_SERVER['HTTP_CONNECTION'] . ',<br>' : '[6]';
  $header .= isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] . ',<br>' : '[7]';
  $header .= isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '[8]';

  $id_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '0';
  $user_login = isset($_SESSION['user_login']) ? $_SESSION['user_login'] : 'none';

  @insertTable('`log_bd`', '`id_user`,`login`,`ip`,`header`,`signature`,`id_page`,`action`',
    "(:id, :login, :ip, :header, :sig, :page, :action)",
    ['id' => $id_user, 'login' => $user_login, 'ip' => getip(), 'header' => $header, 'sig' => sha1($header), 'page' => $id_page, 'action' => $action]);
}

function browser_signature()
{
  $header = isset($_SERVER['HTTP_USER_AGENT']) ? trim($_SERVER['HTTP_USER_AGENT']) . '-,<br>' : '1';
  $header .= isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? trim($_SERVER['HTTP_ACCEPT_LANGUAGE']) . '-,<br>' : '2';
  $header .= isset($_SERVER['HTTP_ACCEPT_ENCODING']) ? trim(str_replace(', sdch', '', $_SERVER['HTTP_ACCEPT_ENCODING'])) . '-,<br>' : '3';//mob yand brauz dobavlyaet eto: {, sdch} 

  return sha1($header);
  //Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0,<br>*/*,<br>ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3,<br>gzip, deflate,<br>
}

function getIpInfo($ip)
{
  return @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip), true);
  /*
  {
    "geoplugin_request":"95.72.217.195",
    "geoplugin_status":200,
    "geoplugin_delay":"1ms",
    "geoplugin_credit":"Some of the returned data includes GeoLite data created by MaxMind, available from <a href='http:\/\/www.maxmind.com'>http:\/\/www.maxmind.com<\/a>.",
    "geoplugin_city":"Kolomna",
    "geoplugin_region":"Moscow Oblast",
    "geoplugin_regionCode":"MOS",
    "geoplugin_regionName":"Moscow Oblast",
    "geoplugin_areaCode":"",
    "geoplugin_dmaCode":"",
    "geoplugin_countryCode":"RU",
    "geoplugin_countryName":"Russia",
    "geoplugin_inEU":0,
    "geoplugin_euVATrate":false,
    "geoplugin_continentCode":"EU",
    "geoplugin_continentName":"Europe",
    "geoplugin_latitude":"55.0794",
    "geoplugin_longitude":"38.7783",
    "geoplugin_locationAccuracyRadius":"100",
    "geoplugin_timezone":"Europe\/Moscow",
    "geoplugin_currencyCode":"RUB",
    "geoplugin_currencySymbol":"руб",
    "geoplugin_currencySymbol_UTF8":"руб",
    "geoplugin_currencyConverter":64.286
  }
  */
}

function autorization()
{
  
  if(empty($_COOKIE[PREFIX_COOKIE . 'autorization']) || empty($_SESSION['user_id']) || empty($_SESSION['user_ses'])){
	  return false;
  }
  
  $row_bd = selectColumn('`users_ofis`', '`id`,`uprav`,`prov`,`sogl`,`manager`,`bronir`,`otd_k`,`ohr_t`', "`id` = :id AND `ses` = :ses", ['id' => $_SESSION['user_id'], 'ses' => $_SESSION['user_ses']]);

  if (empty($row_bd['id']) || 
    empty($_SESSION['user_login']) || 
    !isset($_SESSION['user_otdel']['urov']) || 
    !isset($_SESSION['user_role']) || 
    hash('sha256', $_SESSION['user_ses'] . SALT . browser_signature()) !== $_COOKIE[PREFIX_COOKIE . 'autorization']
  ){
    return false;
  } else {
    //перезаписываем сессию в зависимости от количества обращений или истечению времени последнего обращения. Или удаляем
	
	//------------------perezap-----------------
	$_SESSION['user_uprav'] = $row_bd['uprav'];
	$_SESSION['user_prov'] = $row_bd['prov'];
	$_SESSION['user_sogl'] = $row_bd['sogl'];
	$_SESSION['user_manager'] = $row_bd['manager'];
	$_SESSION['user_bronir'] = $row_bd['bronir'];
	$_SESSION['user_otd_k'] = $row_bd['otd_k'];
	$_SESSION['user_ohr_t'] = $row_bd['ohr_t'];
	$_SESSION['user_bez_gal'] = ($row_bd['uprav']+$row_bd['prov']+$row_bd['sogl']+$row_bd['manager']+$row_bd['bronir']+$row_bd['otd_k']+$row_bd['ohr_t']);
	//------------------perezap-----------------
	
	return true;
  }

  return false;
}
function autorization_masters()
{
  
  if(empty($_COOKIE[PREFIX_COOKIE . 'autorization']) || empty($_SESSION['user_id']) || empty($_SESSION['user_ses'])){
	  return false;
  }
  
  $row_bd = selectColumn('`users_rab`', '`id`', "`id` = :id AND `ses` = :ses", ['id' => $_SESSION['user_id'], 'ses' => $_SESSION['user_ses']]);

  if (empty($row_bd['id']) || hash('sha256', $_SESSION['user_ses'] . SALT . browser_signature()) !== $_COOKIE[PREFIX_COOKIE . 'autorization']){
	
	return false;
	
  } else {
    
	return true;
	
  }

  return false;
}

function create_notifications($user_id, $destination, $get_id, $nazv = null)
{
  //$user_id = array //id users
  //$destination = int //id notif
  //$get_id = int //id page
  //$nazv = string ($_POST)//message text

  /*
  Массив сформирован в файле: ajax_extract_notif.php
  1 = Вам выставили новую задачу
  .....
  17 - В потребности
  */

  if (!is_array($user_id)) {
	  log_to_file("({$user_id}, {$destination}, {$get_id}, {$nazv})", 'ERROR create_notifications line: '.__LINE__);
    return false;
  }

  $user_id = array_diff(array_unique($user_id), ['']);

  if (count($user_id) > 0 && $destination != '' && $get_id != '') {
    $all_insert = '';
    $arr_nazv = [];
    $destination = (INT)$destination;
    $get_id = (INT)$get_id;
	$data = date("Y-m-d H:i:s");
    foreach ($user_id as $value) {
      $value = (INT)$value;
      $arr_nazv[] = $nazv;
      $arr_nazv[] = $data;
      if (!empty($value)) $all_insert .= "({$value},{$destination},{$get_id},?,?,1),";
    }
    $ins_id = insertTable('`notification`', '`id_user`,`destin`,`get_id`,`nazv`,`data`,`prosmotr`', rtrim($all_insert, ','), $arr_nazv);
  }

  return (!empty($ins_id)) ? $ins_id : false;
}

function update_notifications($user_id, $destination, $get_id)
{
  //$user_id = string
  //$destination = int
  //$get_id = int

  if ($user_id != '' && $destination != '' && $get_id != '') {
    updateColumn('`notification`', '`prosmotr` = 0', '`id_user` = :user AND `destin` = :dest AND `get_id` = :get', ['user' => $user_id, 'dest' => $destination, 'get' => $get_id]);
  }
}
function add_log($id_rab, $message)
{
	$arr_param[] = $id_rab;//id rabochego po kotoromu bili izmeneniya
	$arr_param[] = $_SESSION['user_id'];
	$arr_param[] = $_SESSION['user_fio'];
	$arr_param[] = $message;//"Добавление рабочего: fio"
	
	$ins_sql = insertTable('`om_logi`', '`id_rab`,`id_sotr`,`fio_sotr`,`data_vrem`,`text`', '(?,?,?,NOW(),?)', $arr_param);
	
	if($ins_sql){
		return $ins_sql;
	}else{
		return false;
	}
}

function permisUser($name_page, $edit = '')
{
  //$name_page: add-task
  //$edit: edit

  if ($_SESSION['user_otdel']['urov'] === 1) return true;

  if ($edit === 'edit') {
    if (!selectId('`prava_dastupa`', '`unik` = ? AND `redact` = 1', [$_SESSION['user_id'] . '_' . $name_page])) return false;
  } else {
    if (!selectId('`prava_dastupa`', '`unik` = ?', [$_SESSION['user_id'] . '_' . $name_page])) return false;
  }

  return true;
}

function microtime_str()
{
  $micr = explode(' ', microtime());
  return strtr($micr[1] . $micr[0], '.', '_');
}


function valid_str_id($str)
{
	//12,45,1
	$str_n = preg_replace('/[^0-9\,]/', '', $str);
	$str_n = trim($str_n);
	$str_n = trim($str_n, ',');
	
	if(empty($str_n)){
		return [];
	}
	
	$arr_str_n = explode(',', $str_n);
	
	if(!is_array($arr_str_n)){return 'Invalid param data: '. $str .PHP_EOL;}
	
	$new_arr_str_n = [];
	
	if(count($arr_str_n)>1000){return 'Вы выбрали более 1000 значений!'. PHP_EOL;}
	
	foreach($arr_str_n as $v){
		$v_n = (INT)$v;
		if(empty($v_n)){
			return 'Invalid param data: '. $str .PHP_EOL;
		}else{
			$new_arr_str_n[] = $v_n;
		}
	}
	
	return $new_arr_str_n;//[12,45,1]
}

function count_user_potr($id_potr)
{
	$id_potr = (INT)$id_potr;
	
	$count_user_nim = selectCount('`users_rab`', '`id`', '`id_potr`=? AND `flag_potr`=1', [$id_potr]);
	
	return (INT)$count_user_nim;
}


//-----------------------------ftp_connect-----------------------------

function ftp_conn()
{
	$ftp = ftp_connect(FTP_IP_SERVER, FTP_PORT, "30");
	$login = ftp_login($ftp, FTP_LOGIN_U, FTP_PASS);
	ftp_set_option($ftp, FTP_USEPASVADDRESS, false);
	ftp_pasv($ftp, true);
	ftp_chdir($ftp, FTP_FOLDER);
	if (!$login) {
		@log_to_file("ftp_conn: ".implode(', ', error_get_last()));
		return false;
	}else{
		return $ftp;
	}
}
function ftp_insert_img($ftp, $folder_name, $all_img_dir, $name_img)
{
	$zap = true;
	ftp_chdir($ftp, $folder_name);
	if(is_array($all_img_dir)){
		foreach($all_img_dir as $img_dir){
			$zap = ftp_put($ftp, $name_img, $img_dir, FTP_BINARY);
		}
	}else{
		$zap = ftp_put($ftp, $name_img, $all_img_dir, FTP_BINARY);
	}
	if($zap !== true){
		@log_to_file("ftp_insert_img: ".implode(', ', error_get_last()));
		return false;
	}else{
		return $zap;
	}
}
function ftp_extract_name_img($ftp, $folder)
{
	ftp_chdir($ftp, $folder);
	$files = ftp_nlist($ftp, ".");
	if(is_array($files)){
		$arr_img = [];
		foreach($files as $f){
			$file_size = ftp_size($ftp, $f);
			if ($file_size != -1) {
				$arr_img[] = $f;
			}
		}
		return $arr_img;
	}else{
		return false;
	}
}
function ftp_directory_exists($ftp, $dir)
{
	$origin = ftp_pwd($ftp);
	if (@ftp_chdir($ftp, $dir)) {
		ftp_chdir($ftp, $origin);   
		return true;
	}
	return false;
}
function ftp_directory_create($ftp, $dir)
{
	ftp_mkdir($ftp, $dir);
}
function ftp_directory_rename($ftp, $dir_tec, $dir_new)
{
	ftp_rename($ftp, $dir_tec, $dir_new);
}
function ftp_delete_file($ftp, $dir_file, $name_file)
{
	$origin = ftp_pwd($ftp);
	ftp_chdir($ftp, $dir_file);
	ftp_delete($ftp, $name_file);
	ftp_chdir($ftp, $origin);   
}
function ftp_clos($ftp)
{
	ftp_close($ftp);
}
//-------------------------ftp functions----------------------------------------------------

function proverka_nal_faila($url)
{
	//true - file exist, false - file no exist
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_NOBODY, 1);
	curl_setopt($ch, CURLOPT_FAILONERROR, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	$result = curl_exec($ch);
	
	if(curl_errno($ch) || curl_error($ch)){
		@log_to_file('Ошибка curl: ' . curl_errno($ch) . ', ' . curl_error($ch));
		return false;
	}
	
	curl_close($ch);
	if($result !== false){return true;}else{return false;}
}


//---------------------------folder func--------------------------------
function copy_folder_user($tec_dir, $nov_dir)
{
	$error = '';
	$del_foldr = true;
	
	$arr_file = scandir($tec_dir);
	if(is_array($arr_file)){
		foreach($arr_file as $val){
			$val = trim($val);
			$val = trim($val, '.');
			$val = trim($val, '/');
			if(!empty($val)){
				$res = copy($tec_dir.$val, $nov_dir.$val);
				if($res !== true){$error .= $res; $del_foldr = false;}else{unlink($tec_dir.$val);}
			}
		}
	}
	
	if($del_foldr === true){
		$res = rmdir($tec_dir);
		if($res !== true){$error .= $res;}
		
	}
	
	return $error;
}
function add_folder_user($name_folder){
	
	if(FTP_LOCALHOST === 'FTP'){
		$ftp = ftp_conn();
		if (ftp_directory_exists($ftp, $name_folder) === false) {
			ftp_directory_create($ftp, $name_folder);
		}
		if (ftp_directory_exists($ftp, $name_folder) === false) {
			return 'Не удалось создать директорию для загрузки файла! ('.$name_folder.')' . PHP_EOL;
		}
		ftp_clos($ftp);
	}else{
		$dir_folder = __DIR__ .'/../'.NAME_FOLDER_OTPR.$name_folder;
		if (!is_dir($dir_folder)){
			mkdir($dir_folder, 0777, true);
		}
		if (!is_dir($dir_folder)){
			return 'Не удалось создать директорию для загрузки файла! ('.$name_folder.')' . PHP_EOL;
		}
		
	}
	
	return '';
}
function rename_folder($name_folder_cur, $name_folder_new){
	
	if(FTP_LOCALHOST === 'FTP'){
		$ftp = ftp_conn();
		if (ftp_directory_exists($ftp, $name_folder_cur) === true) {
			ftp_directory_rename($ftp, $name_folder_cur, $name_folder_new);
		}
		ftp_clos($ftp);
	}else{
		$dir_path_cur = __DIR__ .'/../'.NAME_FOLDER_OTPR.$name_folder_cur;
		$dir_path_new = __DIR__ .'/../'.NAME_FOLDER_OTPR.$name_folder_new;
		if (is_dir($dir_path_cur)){
			$rez = @rename($dir_path_cur,$dir_path_new);
			if($rez !== true){
				log_to_file("rename_folder: ".$rez);
				return 'Не удалось переименовать директорию! ('.$name_folder_cur.', '.$name_folder_new.')' . PHP_EOL;
			}
		}
	}
	
	return '';
}
function add_file_folder($tmp_name_file, $name_folder, $name_file){
	
	if(FTP_LOCALHOST === 'FTP'){
		$ftp = ftp_conn();
		ftp_insert_img($ftp, $name_folder, $tmp_name_file, $name_file);
		ftp_clos($ftp);
	}else{
		$dir_file = __DIR__ .'/../'.NAME_FOLDER_OTPR.$name_folder.$name_file;
		if (!move_uploaded_file($tmp_name_file, $dir_file)) {
			log_to_file("add_file_folder: ".$dir_file);
			return 'Ошибка загрузки файла ('. $name_file .')!' . PHP_EOL;
		}
	}
	
	return '';
}
function del_file_folder($name_folder, $name_file){
	
	if(FTP_LOCALHOST === 'FTP'){
		$ftp = ftp_conn();
		ftp_delete_file($ftp, $name_folder, $name_file);
		ftp_clos($ftp);
	}else{
		$dir_file = __DIR__ .'/../'.NAME_FOLDER_OTPR.$name_folder.$name_file;
		if(file_exists($dir_file)){
			unlink($dir_file);
		}
	}
	
	return '';
}
//---------------------------folder func--------------------------------


function valid_file($img_file = 'img', $name_fail = 'file_all')
{
  $error = '';

  $phpFileUploadErrors = [
    1 => 'Загруженный файл превышает директиву upload_max_filesize в php.ini!',
    2 => 'Загруженный файл превышает директиву MAX_FILE_SIZE, указанную в HTML-форме!',
    3 => 'Загруженный файл был загружен только частично!',
    4 => 'Файл не был загружен!',
    6 => 'Отсутствует временная папка!',
    7 => 'Не удалось записать файл на диск!',
    8 => 'Расширение PHP остановило загрузку файла!',
  ];

  if (isset($_FILES[$name_fail])) {

    if (is_array($_FILES[$name_fail]['name'])) {
      for ($i = 0; $i < count($_FILES[$name_fail]['name']); $i++) {

        if (isset($_FILES[$name_fail]['name'][$i])) {

          if ($_FILES[$name_fail]['error'][$i] > 0) {
            $error = isset($phpFileUploadErrors[$_FILES[$name_fail]['error'][$i]]) ? $phpFileUploadErrors[$_FILES[$name_fail]['error'][$i]] : 'Неизвестная ошибка загрузки файла!';
          } else {
            $tmp = explode('.', $_FILES[$name_fail]['name'][$i]);
            //if(!is_array($tmp) || !array_key_exists(end($tmp), ($img_file === 'img') ? TYPE_IMG : TYPE_FILE) || !in_array($_FILES[$name_fail]['type'][$i], ($img_file === 'img') ? TYPE_IMG : TYPE_FILE)){
            if ($img_file === 'img') {
              if (!is_array($tmp) || !array_key_exists(strtolower(end($tmp)), TYPE_IMG)) {
                $error = 'Допустимые расширения: ' . implode(', ', array_keys(TYPE_IMG)) . PHP_EOL;
              }
            } else {
              if (!is_array($tmp) || array_key_exists(strtolower(end($tmp)), TYPE_FILE)) {
                $error = 'Недопустимые расширения: ' . implode(', ', array_keys(TYPE_FILE)) . PHP_EOL;
              }
            }
          }
        }
      }
    } else {
      if (isset($_FILES[$name_fail]['name'])) {
        if ($_FILES[$name_fail]['error'] > 0) {
          $error = isset($phpFileUploadErrors[$_FILES[$name_fail]['error']]) ? $phpFileUploadErrors[$_FILES[$name_fail]['error']] : 'Неизвестная ошибка загрузки файла!';
        } else {
          $tmp = explode('.', $_FILES[$name_fail]['name']);
          //if(!is_array($tmp) || !array_key_exists(end($tmp), ($img_file === 'img') ? TYPE_IMG : TYPE_FILE) || !in_array($_FILES[$name_fail]['type'], ($img_file === 'img') ? TYPE_IMG : TYPE_FILE)){
          if ($img_file === 'img') {
            if (!is_array($tmp) || !array_key_exists(strtolower(end($tmp)), TYPE_IMG)) {
              $error = 'Допустимые расширения: ' . implode(', ', array_keys(TYPE_IMG)) . PHP_EOL;
            }
          } else {
            if (!is_array($tmp) || array_key_exists(strtolower(end($tmp)), TYPE_FILE)) {
              $error = 'Недопустимые расширения: ' . implode(', ', array_keys(TYPE_FILE)) . PHP_EOL;
            }
          }
        }
      }
    }

  }

  return $error;
}

function insert_istoria_raboti($id_rab)
{
	$insert_istoria = insertTableCopy('`istoriya_raboti_rab`', '`users_rab`', 
	'`id_user`,`data_s`,`data_po`,`id_otpr`,`id_obiekt`,`id_mast`,`id_man`,`id_spets`,`id_potr`,`id_filial`,`vahta`,
	`id_uchast`,`id_rab_smen`,`id_status`,`o_t_g`,`o_t_p`,`o_k_g`,`o_k_p`,`data_dob`,`samohod`,`master`,
	`id_vahti`,`id_agent`,`data_prib`,`vrem_prib`,`mesto_prib`,`id_organ`,`comm_otpr`', 
	'`id`,`data_postup`,`data_zaversh`,`id_otpravki`,`id_obiekt`,`sogl_s_mast`,`id_manager`,`doljnosti`,`id_potr`,`id_filial`,`vahta`,
	`sector_id`,`id_rab_smen`,`status`,`ohr_trud_got`,`ohr_trud_podp`,`otd_kadr_got`,`otd_kadr_podp`,NOW(),`samohod`,`master`,
	`id_vahti`,`id_agent`,`data_prib`,`vrem_prib`,`mesto_prib`,`id_organ`,`comm_otpr`',
	'`users_rab`.`id`=?',
	[$id_rab]
	);
		
	if(empty($insert_istoria)){
		return false;
	}else{
		return $insert_istoria;
	}
}


function user_fio_dat_exist($fio, $data_rojd)
{
	
	$sql = selectColumn('`users_rab`', '`id`', '`fio`=? AND `data_rojd`=?', [$fio, $data_rojd]);
	
	return (!empty($sql['id'])) ? $sql['id'] : false;
	
}

function stsenarii_proverki_rab_zay($active, $status, $id_rab, $fio, $dr, $data_postup, $data_zaversh, $id_manager_rab, $type=''){
	//-------------------------------------------stsenarii proverki-----------------------------------------------
			if((INT)$active === 2){
				//Статусы “Нарушитель”
				return ['error', 'Не удалось подать заявку. Рабочий - НАРУШИТЕЛЬ. Для изменения его статуса, обратитесь к Вашему руководителю!', __LINE__];
			}elseif((INT)$active === 3){
				//Статусы “Черный список”
				return ['error', 'Не удалось подать заявку. Рабочий в ЧЕРНОМ СПИСКЕ. Для изменения его статуса, обратитесь к Вашему руководителю!', __LINE__];
			}
			if(empty($status)){
				//Без статуса
				return ['ok', 'ok', __LINE__]; 
			}
			if((INT)$status === 9 || (INT)$status === 10){
				//Статусы “Слет”, “Отказ”
				//Текущая отправка переходит в Историю отправок (и создается новая отправка, согласно выбранной потребности)
				//------------------------------kopiruem dannie iz users_rab v istoriya_raboti_rab-----------------
				if($type !== 'no_istor'){
					$insert_istoria = insert_istoria_raboti($id_rab);
					if(empty($insert_istoria)){
						@log_to_file("Не удалось записать историю рабочего! ".__LINE__);
						return ['error', 'Не удалось записать историю рабочего! '.__LINE__, __LINE__];
					}
				}
				return ['ok', 'ok', __LINE__]; 
				//------------------------------kopiruem dannie iz users_rab v istoriya_raboti_rab-----------------
			}
			if((INT)$status !== 8 && (INT)$status !== 17){
				//Если статусы не: “Отправлен” ,и не “На объекте” (то есть все остальные) то выходим из сценария
				//То выходит Пуш уведосление “Не удалось подать заявку. Рабочий находится на Вахте”. Сообщение будут передано Управляющему”
				//19 => ' ', //Не удалось подать заявку. Иванов Иван Иванович 13.02.1987. менеджер Ткачёва Евгения Михайловна дата и время". Иванов Иван Иванович 13.02.1987. Менеджер: Ткачёва Евгения Михайловна
				$id_users = selectIdArr('`users_ofis`', '`uprav` = 1');
				create_notifications($id_users, 19, $id_rab, 'Текущая отправка. Не удалось подать заявку. '.$fio.' '.date_transform($dr).'. Менеджер: '.$_SESSION['user_fio'].' '.date('d.m.Y H:i'));
				return ['error', 'Не удалось подать заявку. У рабочего текущая отправка. Сообщение будут передано Управляющему.', __LINE__];
			}
			
			//Статусы “Отправлен”, “На объекте”
			//Проверка на “Показать даты вахты” поле “По” 
			if($data_zaversh == '1900-01-01' || empty($data_zaversh)){
				//если не проставленны даты: " Внимание! У работника не проставлены даты вахты. Убедитесь, что работник не закреплён за другим менеджером.
				$id_users = selectIdArr('`users_ofis`', '`uprav` = 1');
				create_notifications($id_users, 19, $id_rab, 'Не проставлены даты вахты. '.$fio.' '.date_transform($dr).'. Менеджер: '.$_SESSION['user_fio'].' '.date('d.m.Y H:i'));
				return ['error', 'Не проставлены даты вахты. Сообщение будут передано Управляющему!', __LINE__];
			}elseif(time() > strtotime($data_zaversh)){
				//Если значение поле “По” раньше текущей даты на сервере (т.е. Вахта закончилась)
				//то идет проверка на менеджера 8 мес с даты начала вахты (data_postup)
				if(time() < (strtotime($data_postup)+20736000)){//ne proshlo 8 mes
					if($_SESSION['user_id'] == $id_manager_rab){
						//Менеджер подающий заявку совпадает с тем что в последней отправке у Рабочего
						//------------------------------kopiruem dannie iz users_rab v istoriya_raboti_rab-------------
						if($type !== 'no_istor'){
							$insert_istoria = insert_istoria_raboti($id_rab);
							if(empty($insert_istoria)){
								@log_to_file("Не удалось записать историю рабочего! ".__LINE__);
								return ['error', 'Не удалось записать историю рабочего! '.__LINE__, __LINE__];
							}
						}
						//------------------------------kopiruem dannie iz users_rab v istoriya_raboti_rab-----------------
					}else{
						//Менеджер подающий заявку НЕ совпадает с тем что в последней отправке у Рабочего
						//То выходит Пуш уведосление “Неудалось подать заявку. Рабочий находится на Вахте”. Сообщение будут передано Управляющему”
						//19 => ' ', //Активная Вахта. Не удалось подать заявку. Иванов Иван Иванович 13.02.1987. Менеджер: Ткачёва Евгения Михайловна
						$id_users = selectIdArr('`users_ofis`', '`uprav` = 1');
						create_notifications($id_users, 19, $id_rab, 'Другой менеджер. Не удалось подать заявку. '.$fio.' '.date_transform($dr).'. Менеджер: '.$_SESSION['user_fio'].' '.date('d.m.Y H:i'));
						return ['error', 'Другой менеджер. Не удалось подать заявку. Сообщение будут передано Управляющему!', __LINE__];
					}
				}else{//proshlo 8 mes
					//------------------------------kopiruem dannie iz users_rab v istoriya_raboti_rab-------------
					if(isset($_POST['manager']) && $_SESSION['user_manager'] === 1 && ((INT)$_POST['manager'] !== $_SESSION['user_id'])){
						$_POST['manager']=$_SESSION['user_id'];
					}
					if($type !== 'no_istor'){
						$insert_istoria = insert_istoria_raboti($id_rab);
						if(empty($insert_istoria)){
							@log_to_file("Не удалось записать историю рабочего! ".__LINE__);
							return ['error', 'Не удалось записать историю рабочего! '.__LINE__, __LINE__];
						}
					}
					//------------------------------kopiruem dannie iz users_rab v istoriya_raboti_rab-----------------
				}
			}elseif(time() < strtotime($data_zaversh)){
				//Если значение поле “По” позже текущей даты на сервере (т.е. Вахта НЕ закончилась)
				//То выходит Пуш уведосление “Не удалось подать заявку. Рабочий находится на Вахте”. Сообщение будут передано Управляющему”
				//Уведомление всем сотрудникам с галочкой “Управляющий” " Активная Вахта. Не удалось подать заявку. Иванов Иван Иванович 13.02.1987. менеджер Ткачёва Евгения Михайловна дата и время"
				//19 => ' ', //Активная Вахта. Не удалось подать заявку. Иванов Иван Иванович 13.02.1987. Менеджер: Ткачёва Евгения Михайловна
				$id_users = selectIdArr('`users_ofis`', '`uprav` = 1');
				create_notifications($id_users, 19, $id_rab, 'Активная Вахта. Не удалось подать заявку. '.$fio.' '.date_transform($dr).'. Менеджер: '.$_SESSION['user_fio'].' '.date('d.m.Y H:i'));
				return ['error', 'Не удалось подать заявку. Рабочий находится на Вахте. Сообщение будут передано Управляющему!', __LINE__];
			}
			//-------------------------------------------stsenarii_proverki-----------------------------------------------
	return ['ok', 'ok', __LINE__]; 
}

function zap_message_dubli($id_rab, $fio, $dr, $type=''){
	//19 => ' ', //Уведомление всем сотрудникам с галочкой “Управляющий” "Дубль. Иванов Иван Иванович 13.02.1987. Менеджер Ткачёва Евгения Михайловна. Дата и время (подачи)"
	$id_users = selectIdArr('`users_ofis`', '`uprav` = 1');
	create_notifications($id_users, 19, $id_rab, 'Дубль. '.$fio.' '.date_transform($dr).'. Менеджер: '.$_SESSION['user_fio'].' '.date('d.m.Y H:i'));
	return true; 
}

/*
$sql_s = selectColumnAll('INFORMATION_SCHEMA.TABLES', '*');
if(is_array($sql_s) && !empty($sql_s)){
	foreach($sql_s as $v){
		echo '<hr>'.$v['TABLE_NAME'];
	}
}

$stmt = $conn->prepare("DROP TABLE doljnosti");
$stmt->execute();

exit;
*/

$sql_s = selectColumnAll('`om_statusi`', '`id`,`name`', ' 1 ORDER BY `key_sort` ASC');
$arr = [];
$arr[] = 'Выберите статус';
if(is_array($sql_s) && !empty($sql_s)){
	foreach($sql_s as $v){
		if($v['id'] != 13 && $v['id'] != 14){$arr[$v['id']] = $v['name'];}
	}
}
define('STATUSI', $arr);

$sql_s = selectColumnAll('`om_spets`', '`id`,`name`', ' 1 ORDER BY `name` ASC');
$arr = [];
$arr[] = 'Выберите значение';
if(is_array($sql_s) && !empty($sql_s)){
	foreach($sql_s as $v){
		$arr[$v['id']] = $v['name'];
	}
}
define('SPETS', $arr);

$sql_s = selectColumnAll('`doljnosti`', '`id`,`nazvanie_dol`', ' 1 ORDER BY `nazvanie_dol` ASC');
$arr = [];
$arr[] = 'Выберите значение';
if(is_array($sql_s) && !empty($sql_s)){
	foreach($sql_s as $v){
		$arr[$v['id']] = $v['nazvanie_dol'];
	}
}
define('DOLJNOSTI', $arr);












