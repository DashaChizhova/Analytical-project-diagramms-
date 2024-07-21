<?php
function deleteRow($table, $condition = 1, $arr_param = [])
{
  global $conn;
  $stmt = $conn->prepare("DELETE FROM $table WHERE $condition");
  $stmt->execute($arr_param);
  return $stmt;
  //return mysqli_query($conn, "DELETE FROM $table WHERE $condition");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $current__date = $_POST['current__date'];
    $pokazatel = $_POST['pokazatel'];
    $diagramma_id	 = 3;
    
    $result = deleteRow('`pokazateli`', '`id` = ?', '`pokazatel` = ?','`current__date` = ?', '`diagramma_id` = ?',  [$id,$pokazatel, $current__date, $diagramma_id]);
  
    // Возвращаем какой-то ответ 
    echo json_encode(['success' => true, 'message' => 'Запись успешно удалена']);
} else {
    http_response_code(405); // Метод не разрешен
    echo json_encode(['error' => 'Метод не разрешен']);
}


