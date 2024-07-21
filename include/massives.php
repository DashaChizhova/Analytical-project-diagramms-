<?php
function getDiagrammNastroikiMassive(){
    $myArray = 
    Array(['diagramma_id' => 4, 
    'diagramma_title' => 'Выход людей', 
    'excelent_from'=> 1500, 'excelent_to'=> 3000,
    'good_from'=> 1000, 'good_to'=> 1500,
    'better_from'=> 700, 'better_to'=> 1000,
    'notgood_from'=> 500, 'notgood_to'=> 700,
    'bad_from'=> 300, 'bad_to'=> 500,
    'ahtung_from'=> 0, 'ahtung_to'=> 300,
    'izmerenie' => 'чел.'],
    ['diagramma_id' => 5, 
    'diagramma_title' => 'Кредиторская задолженность', 
    'excelent_from'=> 5000000, 'excelent_to'=> 1,
    'good_from'=> 10000000, 'good_to'=> 5000000,
    'better_from'=> 20000000, 'better_to'=> 10000000,
    'notgood_from'=> 40000000, 'notgood_to'=> 20000000,
    'bad_from'=> 60000000, 'bad_to'=> 40000000,
    'ahtung_from'=> 100000000, 'ahtung_to'=> 60000000,
    'izmerenie' => 'руб.'],
    ['diagramma_id' => 6, 
    'diagramma_title' => 'Остатки на счетах', 
    'excelent_from'=> 1500, 'excelent_to'=> 2000,
    'good_from'=> 1000, 'good_to'=> 1500,
    'better_from'=> 700, 'better_to'=> 1000,
    'notgood_from'=> 500, 'notgood_to'=> 700,
    'bad_from'=> 300, 'bad_to'=> 500,
    'ahtung_from'=> 0, 'ahtung_to'=> 300,
    'izmerenie' => 'руб.']
    
);
    return $myArray;
};

function getPokazateliMassive(){
    $myArray = 
    Array(['diagramma_id' => 4, 
    'pokazatel' => 600,
	'company_id'=>111,
	'period' => '07.2024',
    'id' => 1
    ],
	['diagramma_id' => 5, 
    'pokazatel' => 5000000,
	'company_id'=>111,
	'period' => '07.2024',
    'id' => 1],
	['diagramma_id' => 6, 
    'pokazatel' => 380,
	'company_id'=>111,
	'period' => '07.2024',
    'id' => 1],
);
    return $myArray;
}