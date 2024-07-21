<?php
if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
	exit(json_encode(['error', 'error xmlhttprequest', __LINE__], JSON_UNESCAPED_UNICODE));
}

define('s@>J$qw$i8_5rvY=6d{Z@!,V%J[J4Z^8C3q*bO$%/_db~iy6Fz=eTL/^O-@VKJU{E=U^x,JfooR19xKpgQ*,A/Dbg+9@>J1%.T[sL9#-4!-A8]t', true);
require_once __DIR__ . '/../include/config.php';
require_once __DIR__ . '/../include/db_action.php';
require_once __DIR__ . '/../include/functions.php';
require_once __DIR__ . '/../include/massives.php';

/* if (autorization() !== true) {
	exit(json_encode(['error', 'error autorization', __LINE__]));
} */


//-----------------------------------------del_pok---------------------------------------
if (isset($_POST['del_pok']) && $_POST['del_pok'] === '12345') {
	
	$error = '';
	
	$id_diagr = (INT)$_POST['id_d'];
	
	deleteRow('`pokazateli`', '`id`=?', [$id_diagr]);
	
	// $myArray = getPokazateliMassive();
	// // foreach ($myArray as $key => $item) {
	// // 	if ($item['id'] == $id_diagr) {
	// // 		unset($myArray[$key]);
	// // 	}
	// // }
	// for ($i = 0; $i < count($myArray); $i++) {
	// 	if ($myArray[$i]['id'] == $id_diagr) {
	// 		unset($myArray[$i]);
	// 	}
	// }

	if($error === ''){
		exit(json_encode(['ok', 'Успешно удалено!', __LINE__], JSON_UNESCAPED_UNICODE));
	}else{
		exit(json_encode(['error', $error, __LINE__], JSON_UNESCAPED_UNICODE));
	}
}
//-----------------------------------------del_pok---------------------------------------




exit(json_encode(['error', 'Ошибка запроса! Конец файла.', __LINE__], JSON_UNESCAPED_UNICODE));
?>