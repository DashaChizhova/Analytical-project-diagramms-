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


if (isset($_POST['get_pok']) && $_POST['get_pok'] === '12345'){
	
	$error = '';

	$diagramma_id = (INT)$_POST['diagramma_id'];
	$period = $_POST['period'];
	$company_id = (INT)$_POST['company_id'];

	$arr_data = [];
	$arr_data2 = [];
	
	$sql = selectColumnAll('pokazateli', 'pokazatel', 'diagramma_id=? AND company_id=? AND period=?', [$diagramma_id, $company_id, $period]);
	//$sql2 = selectColumnAll('diagrams_nastroiki', 'excelent_from, excelent_to, good_from, good_to, better_from, better_to, notgood_from, notgood_to, bad_from, bad_to, ahtung_from, ahtung_to', 'diagramma_id=?', [$diagramma_id]);
	
// 	$myArray = getPokazateliMassive();

// foreach ($myArray as $item) {
//     if ($item['company_id'] == $company_id && $item['diagramma_id'] == $diagramma_id && $item['period'] == $period) {
//         $arr_data2[] = $item;
       
//     }
// }
// $sql = array_merge($sql, $arr_data2);
	foreach($sql as $val){
		
		$arr_data[] = ['pokazatel'=>$val['pokazatel']];
	}

	// foreach($sql2 as $val){
		
	// 	$arr_data2[] = ['excelent_from'=>$val['excelent_from']];
	// }
	exit(json_encode(['ok',  $arr_data,   __LINE__], JSON_UNESCAPED_UNICODE));

}


?>