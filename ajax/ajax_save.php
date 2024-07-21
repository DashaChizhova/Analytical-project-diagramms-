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
if (isset($_POST['save_pok']) && $_POST['save_pok'] === '12345') {
	
	$error = '';

	$diagramma_id = (INT)$_POST['diagramma_id'];

    $excelent_from = (INT)$_POST['excelent_from'];
	$excelent_to = (INT)$_POST['excelent_to'];
	
	$good_from = (INT)$_POST['good_from'];
	$good_to = (INT)$_POST['good_to'];

	$better_from = (INT)$_POST['better_from'];
	$better_to = (INT)$_POST['better_to'];

	$notgood_from = (INT)$_POST['notgood_from']; 
	$notgood_to = (INT)$_POST['notgood_to'];

	$bad_from = (INT)$_POST['bad_from']; 
	$bad_to = (INT)$_POST['bad_to'];

	$ahtung_from = (INT)$_POST['ahtung_from']; 
	$ahtung_to = (INT)$_POST['ahtung_to'];

	$current__date = date('Y-m-d');

	/*updateColumn('`diagrams_nastroiki`',
    	'`diagramma_id` =?,
    	`excelent_from`=?,`excelent_to` =?, 
    	`good_from` =?,`good_to` =?, 
    	`better_from` =?,`better_to` =?, 
    	`notgood_from` =?,`notgood_to` =?, 
    	`bad_from` =?,`bad_to` =?, 
    	`ahtung_from` =?,`ahtung_to` =?', 
    	[$diagramma_id, 
    	$excelent_from, $excelent_to,  
    	$good_from, $good_to,
    	$better_from, $better_to,  
    	$notgood_from, $notgood_to,  
    	$bad_from, $bad_to,  
    	$ahtung_from, $ahtung_to
    ]);*/
    
    updateColumn(
        
        //1
        '`diagrams_nastroiki`',
    
        //2
    	'`excelent_from`=?,`excelent_to` =?, 
    	`good_from` =?,`good_to` =?, 
    	`better_from` =?,`better_to` =?, 
    	`notgood_from` =?,`notgood_to` =?, 
    	`bad_from` =?,`bad_to` =?, 
    	`ahtung_from` =?,`ahtung_to` =?,
		`current__date` =?', 
    	
    	//3 
    	'`diagramma_id` =?',
    	
    	//4
    	[$excelent_from, $excelent_to,  
    	$good_from, $good_to,
    	$better_from, $better_to,  
    	$notgood_from, $notgood_to,  
    	$bad_from, $bad_to,  
    	$ahtung_from, $ahtung_to,
		$current__date,
    	$diagramma_id
    ]);
	
	if($error === ''){
		exit(json_encode(['ok', 'Успешно добавлено!', __LINE__], JSON_UNESCAPED_UNICODE));
	}else{
		exit(json_encode(['error', $error, __LINE__], JSON_UNESCAPED_UNICODE));
	}

}
//-----------------------------------------add_pok---------------------------------------




exit(json_encode(['error', 'Ошибка запроса! Конец файла.', __LINE__], JSON_UNESCAPED_UNICODE));

?>