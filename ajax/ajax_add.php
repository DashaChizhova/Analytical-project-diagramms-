<?php
if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
	exit(json_encode(['error', 'error xmlhttprequest', __LINE__], JSON_UNESCAPED_UNICODE));
}

define('s@>J$qw$i8_5rvY=6d{Z@!,V%J[J4Z^8C3q*bO$%/_db~iy6Fz=eTL/^O-@VKJU{E=U^x,JfooR19xKpgQ*,A/Dbg+9@>J1%.T[sL9#-4!-A8]t', true);
require_once __DIR__ . '/../include/config.php';
require_once __DIR__ . '/../include/db_action.php';
require_once __DIR__ . '/../include/functions.php';


/* if (autorization() !== true) {
	exit(json_encode(['error', 'error autorization', __LINE__]));
} */


//-----------------------------------------add_pok---------------------------------------
if (isset($_POST['add_pok']) && $_POST['add_pok'] === '12345') {
	
	$error = '';
	
    $period = $_POST['period'];
    $pokazatel = (INT)$_POST['pokazatel'];
    $diagramma_id = (INT)$_POST['diagramma_id'];
	$company_id = (INT)$_POST['company_id'];
	
	insertTable('`pokazateli`','`pokazatel`,`period`, `diagramma_id`, `company_id`', '(?,?,?,?)', [$pokazatel, $period,  $diagramma_id,  $company_id]);
	
	if($error === ''){
		exit(json_encode(['ok', 'Успешно добавлено!', __LINE__], JSON_UNESCAPED_UNICODE));
	}else{
		exit(json_encode(['error', $error, __LINE__], JSON_UNESCAPED_UNICODE));
	}
}
//-----------------------------------------add_pok---------------------------------------




exit(json_encode(['error', 'Ошибка запроса! Конец файла.', __LINE__], JSON_UNESCAPED_UNICODE));
?>