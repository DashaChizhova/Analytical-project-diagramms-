<?php
if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
	exit(json_encode(['error', 'error xmlhttprequest', __LINE__], JSON_UNESCAPED_UNICODE));
}

define('s@>J$qw$i8_5rvY=6d{Z@!,V%J[J4Z^8C3q*bO$%/_db~iy6Fz=eTL/^O-@VKJU{E=U^x,JfooR19xKpgQ*,A/Dbg+9@>J1%.T[sL9#-4!-A8]t', true);
require_once __DIR__ . '/../include/config.php';
require_once __DIR__ . '/../include/db_action.php';
require_once __DIR__ . '/../include/functions.php';
require_once __DIR__ . '/../include/massives.php';

if (isset($_POST['get_all_pok']) && $_POST['get_all_pok'] === '12345'){
	
	$error = '';

	$diagramma_id = (INT)$_POST['diagramma_id'];
	
	$company_id = (INT)$_POST['company_id'];

	$arr_data = [];
	$arr_data2 = [];
	
	// $sql = selectColumnAll('pokazateli', 'id, pokazatel, period', 'diagramma_id=? AND company_id=?', [$diagramma_id, $company_id]);
	
    $result = "SELECT id, pokazatel, period FROM pokazateli 
    WHERE diagramma_id = :diagramma_id AND company_id = :company_id
    ORDER BY DATE_FORMAT(STR_TO_DATE(CONCAT('01.', period), '%d.%m.%Y'), '%Y-%m-01') DESC"; //чтобы в истории показателей показатели выводились по убыванию
	
    $stmt = $conn->prepare($result);

    $stmt->execute([':diagramma_id' => $diagramma_id, ':company_id' => $company_id]);
    $sql = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$myArray = getPokazateliMassive();
	foreach ($myArray as $item) {
		if ($item['company_id'] == $company_id && $item['diagramma_id'] == $diagramma_id) {
			$arr_data2[] = $item;
		   
		}
	}
	$sql = array_merge($sql, $arr_data2);
    $row_number = 0;
	foreach($sql as $val){
        $row_number += 1;
		$arr_data[] = ['id'=>$val['id'], 'pokazatel'=>$val['pokazatel'], 'period'=>$val['period'],'row_number'=> $row_number];
		
	}

	// foreach($sql2 as $val){
		
	// 	$arr_data2[] = ['excelent_from'=>$val['excelent_from']];
	// }
	exit(json_encode(['ok',  $arr_data,   __LINE__], JSON_UNESCAPED_UNICODE));

}