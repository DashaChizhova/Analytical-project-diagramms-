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
if (isset($_POST['get_grafikData']) && $_POST['get_grafikData'] === '12345') {
	
	$error = '';
    $arr_data_1 = [];
    $timeframe = $_POST['timeframe'];
	$diagramma_id = (INT)$_POST['diagramma_id'];
    $company_id = (INT)$_POST['company_id'];
	
if($timeframe === 'alltime'){
	$result = "SELECT `pokazatel`, `period` FROM `pokazateli`
	 WHERE diagramma_id = :diagramma_id
                AND company_id = :company_id ORDER BY DATE_FORMAT(STR_TO_DATE(CONCAT('01.', period), '%d.%m.%Y'), '%Y-%m-01');";
	 $stmt = $conn->prepare($result);

	 $stmt->execute([':diagramma_id' => $diagramma_id, ':company_id' => $company_id]);
	 $sql = $stmt->fetchAll(PDO::FETCH_ASSOC);
}else{
	$result = "SELECT `pokazatel`, `period` FROM `pokazateli`
	WHERE STR_TO_DATE(CONCAT('01.', period), '%d.%m.%Y') >= DATE_FORMAT(DATE_SUB(NOW(), INTERVAL :timeframe MONTH), '%Y-%m-01')
	AND STR_TO_DATE(CONCAT('01.', period), '%d.%m.%Y') <= LAST_DAY(NOW())  AND diagramma_id = :diagramma_id
                AND company_id = :company_id ORDER BY DATE_FORMAT(STR_TO_DATE(CONCAT('01.', period), '%d.%m.%Y'), '%Y-%m-01');";
	 $stmt = $conn->prepare($result);

	 $stmt->execute([':diagramma_id' => $diagramma_id, ':company_id' => $company_id, ':timeframe' => $timeframe]);
	 $sql = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
	
  	 
    foreach($sql as $val){
        $arr_data_1[] = ['period'=>$val['period'], 'pokazatel'=>$val['pokazatel']];
    }
    
	

	if($error === ''){
		exit(json_encode(['ok', $arr_data_1, __LINE__], JSON_UNESCAPED_UNICODE));
	}else{
		exit(json_encode(['error', $error, __LINE__], JSON_UNESCAPED_UNICODE));
	}


//-----------------------------------------add_pok---------------------------------------

exit(json_encode(['error', 'Ошибка запроса! Конец файла.', __LINE__], JSON_UNESCAPED_UNICODE));

?>