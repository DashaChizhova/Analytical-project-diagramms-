<?php 
 if(!empty($get_param_1)){

}else{
	echo 'Диаграма не найдена';
}

$pokazateli_array = selectColumnAll('pokazateli', '`id`, `pokazatel`, `period`, `diagramma_id`', '`diagramma_id`=? and `company_id`=? ORDER BY period DESC', [$get_param_1, 222]);

$diagrams_array = selectColumnAll('diagrams_nastroiki', '*', '`diagramma_id`=?', [$get_param_1]);
$myArray = getDiagrammNastroikiMassive();
$arr_data2 = [];
foreach ($myArray as $item) {
    if ($item['diagramma_id'] == $get_param_1) {
        $arr_data2[] = $item;
       
    }
}
$diagrams_array = array_merge($diagrams_array, $arr_data2);
$nastroiki_array = [];
foreach($diagrams_array as $val){
    $nastroiki_array[] = [
        'excelent_from'=>(INT)$val['excelent_from'], 'excelent_to'=>(INT)$val['excelent_to'],
        'good_from'=>(INT)$val['good_from'], 'good_to'=>(INT)$val['good_to'],
        'better_from'=>(INT)$val['better_from'], 'better_to'=>(INT)$val['better_to'],
        'notgood_from'=>(INT)$val['notgood_from'], 'notgood_to'=>(INT)$val['notgood_to'],
        'bad_from'=>(INT)$val['bad_from'], 'bad_to'=>(INT)$val['bad_to'],
        'ahtung_from'=>(INT)$val['ahtung_from'], 'ahtung_to'=>(INT)$val['ahtung_to'],
        'diagramma_id'=>(INT)$val['diagramma_id'], 'izmerenie'=>$val['izmerenie']
];

}


 $currentDate = date('Y-m-d');
$startOfMonth = date('Y-m-01'); 
?>
<div class="nav">
<div class="container_full">
        <div class="under_header">
            <div class="title_block">  
                <a href="<?=ROOT_PATH?>"><div class="nazad_btn"><div class="nazad_img"><img src="<?=ROOT_PATH?>img/Back.svg" class="clear_img" alt=""></div><div>Назад</div></div></a>
                <div class="title"><?php echo  $diagrams_array[0]['diagramma_title']; ?></div>
            </div>  
            <div style="visibility: hidden;" class="dates_block">
                <div class="div_date"><text class="date_text">Период C</text><input class="papam_filtr" type="date" name="start_date"  value="<?php echo $startOfMonth; ?>"></div> 
                <div class="div_date"><text class="date_text">Период ПО</text><input class="papam_filtr"  type="date" name="end_date" value="<?php echo $currentDate; ?>"></div>  
            </div>
            <div  class="div_company"><text class="date_text">Компания</text>
            <select class="company_select papam_filtr" id="company_select">
                <option value="111">Компания1</option>
                <option value="222">Компания2</option>
                <option value="333">Компания3</option>
            </select></div>  
        </div>
</div>
</div>

<div class="container">
<div class="container_full">
    <div class="diagramma_main">
        <div class="info_block">
            <div class="diagramma_block">
                <div class="diagramma">
                    <?php include('include/diagramma.php'); ?>
                </div>
                <div class="diagramma_itog" data-itog="">руб.</div>
                <div class="nastroiki">
                    <div class="row">
                        <div class="div_date">Месяц<br> 
                        <select class="month_select papam_filtr">
                                <option value="01">Январь</option>
                                <option value="02">Февраль</option>
                                <option value="03">Март</option>
                                <option value="04">Апрель</option>
                                <option value="05">Май</option>
                                <option value="06">Июнь</option>
                                <option value="07">Июль</option>
                                <option value="08">Август</option>
                                <option value="09">Сентябрь</option>
                                <option value="10">Октябрь</option>
                                <option value="11">Ноябрь</option>
                                <option value="12">Декабрь</option>
                        </select>
                    </div> 
                        <div class="tire tire_low"></div>
                        <div class="div_date div_date_noleft">Год<br>
                            <?php $year = date("Y"); ?>
                            <select class="year_select papam_filtr">
                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                    <option value="<?php echo $year - 1; ?>"><?php echo $year - 1; ?></option>
                                    <option value="<?php echo $year - 2; ?>"><?php echo $year - 2; ?></option>
                                    <option value="<?php echo $year - 3; ?>"><?php echo $year - 3; ?></option>
                            </select>
                        </div>  
                    </div>
                    <div  class="row">
                        <!-- <div ><input class="search_btn" class="search_btn" type="submit" value="Поиск"></div>  
                        <div class="clear_btn"><a href="#">Очистить <img class="clear_img" src="<?=ROOT_PATH?>img/lastik.svg" alt=""></a></div>   -->
                    </div>
                </div>
            </div>
            <div class="stick"></div>
            <div class="pokazateli_block">
                <div class="scrollable_content">
                    <div class="pokazateli_title">История показателей</div><br>
                    <div class="pokazateli_row row">
                        <div class="number"></div>
                        <div class="pokazatel_date">Дата <br><input type="date" name="end_date" id="pok_date_input" ></div>  
                        <div class="pokazatel">Показатель<br><input type="text" id="pok_input"></div>
                        <div class="pokazatel_btn"><a href="#" class="add-btn" data-iddiagram="<?= $pokazateli_array[0]['diagramma_id']?>" ><img src="<?=ROOT_PATH?>img/Plus Math.svg" alt=""></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="grafik_block">
            <div class="grafik_title">Динамика дебиторской задолженности</div>
            <div class="grafik_period">
                <ul class="grafik_ul">
                    <li class="grafik_li papam_frafik" onclick="getGrafikData(0)" >Месяц</li>
                    <li class="grafik_li papam_frafik" onclick="getGrafikData(3)">3 Месяца</li>
                    <li class="grafik_li papam_frafik" onclick="getGrafikData(6)">6 Месяцев</li>
                    <li class="grafik_li papam_frafik" onclick="getGrafikData(12)">Год</li>
                    <li class="grafik_li papam_frafik orange-background" onclick="getGrafikData('alltime')">Все время</li>
                </ul>
            </div>
        </div>
            <canvas id="myChart"></canvas>
        
    </div>
</div>
</div>
<script type="text/javascript" language="javascript">

	// -------------------------DIAGRAMMA------------------------
    const ctx = document.getElementById('myChart');

var myChart = new Chart(ctx, {
type: 'line',
data: {
    labels: [],
    datasets: [{
    label: '',
    //  data: [1000000, 2000000, 3000000, 4000000, 5000000, 6000000],
    data: [],
    borderWidth: 5,
    borderColor: "#F86501"
    }]
},
options: {
    scales: {
    y: {
        beginAtZero: true
    }
    }
}
});
	// -------------------------DIAGRAMMA------------------------

    

	// -------------------------при загрузке документа------------------------
$(document).ready(function() {

    //подставить в селект текущую дату
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth() + 1; 
    let currentYear = currentDate.getFullYear(); 
    $('.month_select').val(currentMonth < 10 ? "0" + currentMonth : currentMonth);
    $('.year_select').val(currentYear);

    getData();

  

    getGrafikData('alltime');

    //в графике подсветить выбранный период графика
    $(".grafik_li").click(function() {
        $(".grafik_li").removeClass("orange-background");
        $(this).addClass("orange-background");
    });

    getPokazateliHistory()
    
});



function getGrafikData(timeframe) {

    var get_param_1 = "<?php echo $get_param_1; ?>";
    var company_id = $('.company_select').val();

    var form_data = new FormData();
    form_data.append('get_grafikData', '12345');
    form_data.append('timeframe', timeframe);
    form_data.append('diagramma_id', get_param_1);
    form_data.append('company_id', company_id);


    $.ajax({
    url: "<?=ROOT_PATH?>ajax/getGrafikData.php",
    type: "POST",
    data: form_data,
    processData: false,
    contentType: false,
    success: function (data, textStatus, jqXHR) {
        try{
            arr_resp = JSON.parse(data);
            if(arr_resp[0] === 'ok'){
                
                let pokazateli_array = [];
                let period_array = [];

                for (let i = 0; i < arr_resp[1].length; i++) {
                    pokazateli_array.push(arr_resp[1][i].pokazatel);
                    period_array.push(String(arr_resp[1][i].period));
                }
                console.log(pokazateli_array);
                myChart.data.datasets[0].data = pokazateli_array.map(function(item) {
                    return item; 
                });
                myChart.data.labels = period_array.map(function(item) {
                    return item; 
                });
                myChart.update();
            }else{
                alert(arr_resp[1]);
            }
        }catch(e){alert('Error: '+e+'\n\n'+data);}
    }
    });

};

$(document).on('change', '.papam_filtr', function () {
	getData();
    
   
});
$(document).on('change', '.company_select', function () {
	getGrafikData('alltime');
    getPokazateliHistory();
});

	// -------------------------удаление записи в истории показателей по кнопке------------------------
$(document).on('click', '.delete-btn', function () {
	if (!confirm("Вы действительно хотите удалить запись?")) {
		return;
	}
	
	//на кнопку удаления вешается атрибут data-iddiagram и туда записываем id записи для удаления.
	var id_d = $(this).attr('data-iddiagram');
	
	var form_data = new FormData();
	
	form_data.append('del_pok', '12345');
	form_data.append('id_d', id_d);

    var row = $(this).closest('.pokazateli_row');
		
	$.ajax({
		url: "<?=ROOT_PATH?>ajax/ajax_delete.php",
		type: "POST",
		data: form_data,
		processData: false,
		contentType: false,
		success: function (data, textStatus, jqXHR) {
			try{
				arr_resp = JSON.parse(data);
				if(arr_resp[0] === 'ok'){
					// location.reload(true);
                    getPokazateliHistory();
                    getData();
                    getGrafikData('alltime');
				}else{
					alert(arr_resp[1]);
				}
			}catch(e){alert('Error: '+e+'\n\n'+data);}
		}
	});
    
});

	// -------------------------добавление записи в истории показателей по кнопке------------------------
    $(document).on('click', '.add-btn', function () {
	if (!confirm("Добавить запись?")) {
		return;
	}
    
    var originalDate = String($('#pok_date_input').val());

    let parts = originalDate.split("-");
   
    let month = parts[1];
    let year = parts[0];
    


    var id_d = $(this).attr('data-iddiagram');

	var form_data = new FormData();
	
	form_data.append('add_pok', '12345');
    form_data.append('period', month + '.' + year);
    form_data.append('pokazatel', parseInt($('#pok_input').val().replace(/\s/g, '')));

    form_data.append('diagramma_id', id_d);
    form_data.append('company_id', $('#company_select').val());

	$.ajax({
		url: "<?=ROOT_PATH?>ajax/ajax_add.php",
		type: "POST",
		data: form_data,
		processData: false,
		contentType: false,
		success: function (data, textStatus, jqXHR) {
			try{
				arr_resp = JSON.parse(data);
				if(arr_resp[0] === 'ok'){
					// location.reload(true);
                    $('#pok_date_input, #pok_input').val('');
                    getPokazateliHistory();
                    getData();
                    getGrafikData('alltime');
				}else{
					alert(arr_resp[1]);
				}
			}catch(e){alert('Error: '+e+'\n\n'+data);}
		}
	});
    
});
	// -------------------------изменения показателей-----------------------
   function getPokazateliHistory() { 
   
     $(".pokazateli_row").each(function(index) {
        if (index !== 0) {
            $(this).remove();
    }
});
 
    var get_param_1 = "<?php echo $get_param_1; ?>";
   
    var company_id = $(".company_select").val();
    
    var form_data = new FormData();
       
       form_data.append('get_all_pok', '12345');
       form_data.append('diagramma_id', get_param_1);
       form_data.append('company_id', company_id);
       $.ajax({
        url: '<?=ROOT_PATH?>ajax/get_history_poks.php', 
        type: 'POST', 
        data: form_data,
        processData: false,
        contentType: false,
        success: function (data, textStatus, jqXHR) {
            try{
                arr_resp = JSON.parse(data);
                if(arr_resp[0] === 'ok'){
                   
                let pokazatel_array =  arr_resp[1];
                var pokazateliBlock = $(".scrollable_content");

                pokazatel_array.forEach(function(item) {

                var newBlock = 
                '<div class="pokazateli_row row" >' +
                        '<div class="number"> #' + item.row_number + '</div>' +
                        '<div class="pokazatel_date" >Дата<br><input type="text" id="pokazatel_date" name="end_date" value="' + item.period + '" readonly></div>' + 
                        '<div class="pokazatel" >Показатель<br><input type="text" id="pokazatel" name="end_date" value="' + item.pokazatel.toLocaleString() + '" readonly></div>' +
                        '<div class="pokazatel_btn"><a href="#" class="delete-btn" data-iddiagram="'+ item.id +'"><img src="<?=ROOT_PATH?>img/Remove.svg" alt=""></a></div>' +
                    '</div>' 
                pokazateliBlock.append(newBlock);
                });
                }
            }catch(e){alert('Error: '+e+'\n\n'+data);}
            }
    });

   }


	// -------------------------изменения показателей диаграмм------------------------
function getData(){
    // $('.diagramma_itog').text('-'); 

    // $('.diagramma_img').attr('src', `<?=ROOT_PATH?>img/diagramma/diagramma_empty.svg`);
    // $('.diagramma_itog').css('background-color', '');
    var get_param_1 = "<?php echo $get_param_1; ?>";
    
    var company_id = $(".company_select").val();
 
        
    var month_select = $(".month_select").val();
    var year_select = $(".year_select").val();

       var form_data = new FormData();
       
        form_data.append('get_pok', '12345');
        form_data.append('diagramma_id', get_param_1);
        form_data.append('period', month_select + '.' + year_select);
        form_data.append('company_id', company_id);
       
    $.ajax({
        url: '<?=ROOT_PATH?>ajax/ajax_get_pokazateli.php', 
        type: 'POST', 
        data: form_data,
        processData: false,
        contentType: false,
        success: function (data, textStatus, jqXHR) {
                try{
                    arr_resp = JSON.parse(data);
                    if(arr_resp[0] === 'ok'){
                        // arr_resp[1].foreach(data=>{
                       if(arr_resp[1][0] !== undefined){
                        let summaItog =  arr_resp[1][0].pokazatel;
                        let resultArray = getPokazateliDiagramm(summaItog);
                        
                        $('.diagramma_itog').text(summaItog.toLocaleString() + ' ' + resultArray.get('izmerenie'));
                        $('<style>.diagramma .center:before {display: block}</style>').appendTo('head');
                        $('.center').css('transform', `rotate(${resultArray.get('itog_degree')}deg)`);  
                        
                        $('.diagramma_img').attr('src', `<?=ROOT_PATH?>img/diagramma/diagramma_${resultArray.get('otsenka')}.svg`);
                        $('.diagramma_itog').css('background-color', `${resultArray.get('diagramma_itog_color')}`);
                       } else{
                       
                        $('.diagramma_itog').text('-');
                        $('<style>.diagramma .center:before {display: none}</style>').appendTo('head');
                        // $('.center').css('transform', 'rotate(0deg)');  
                        $('.diagramma_img').attr('src', `<?=ROOT_PATH?>img/diagramma/diagramma_empty.svg`);
                        $('.diagramma_itog').css('background-color', '');
                       }
                        
                        function getPokazateliDiagramm(summaItog){
                            var nastroiki_array = <?php echo json_encode($nastroiki_array); ?>;
                            console.log(nastroiki_array);
                            arr = nastroiki_array[0];
                            let isInverseSettings = arr['excelent_from'] > arr['ahtung_from']; //находит инверсивные ли показатели в настройках (от меньшего к большему или наоборот)
                            summaItog = checkPokazatel(summaItog, Math.min(arr['excelent_from'],arr['excelent_to']), Math.max(arr['ahtung_to'], arr['ahtung_from']), isInverseSettings);
                            let scores = [
                                { start: arr['excelent_from'], end: arr['excelent_to'], score: 150, score_text: "excelent", diagramma_itog_color: "#30AD43" },
                                    { start: arr['good_from'], end: arr['good_to'], score: 120, score_text: "good", diagramma_itog_color: "#84BD32" },
                                    { start: arr['better_from'], end: arr['better_to'], score: 90 , score_text: "better", diagramma_itog_color: "#D1D80F"},
                                    { start: arr['notgood_from'], end: arr['notgood_to'], score: 60, score_text: "notgood", diagramma_itog_color: "#FEE114" },
                                    { start: arr['bad_from'], end: arr['bad_to'], score: 30, score_text: "bad", diagramma_itog_color: "#FF8888" },
                                    { start: arr['ahtung_from'], end: arr['ahtung_to'], score: 0, score_text: "ahtung", diagramma_itog_color: "#FF0000" }
                            ];
                                let result;
                                let otsenka = "";
                                let diagramma_itog_color = "";
                                for (let i = 0; i < scores.length; i++) {
                                    if (summaItog >= scores[i].start && summaItog <= scores[i].end || summaItog <= scores[i].start && summaItog >= scores[i].end) {
                                        result = scores[i].score;
                                        otsenka += scores[i].score_text; 
                                        diagramma_itog_color += scores[i].diagramma_itog_color;
                                        break;
                                    }
                                }
                                const score = scores.find(item => item.score === result);
                              
                                var itog_degree = (30/(score.end/summaItog)) + result;
                                var resultArray = new Map();
                                resultArray.set('otsenka',otsenka);
                                resultArray.set('itog_degree',itog_degree);
                                resultArray.set('diagramma_itog_color',diagramma_itog_color);
                                resultArray.set('izmerenie', arr['izmerenie']);
                                console.log('summaitog: :' + String(summaItog))
                                console.log('градусов:' + String(resultArray.get('itog_degree')));
                                console.log('score.end:' + String(score.end));
                                console.log(resultArray.get('otsenka'))
                                
                                return resultArray;
                        }
                        function checkPokazatel(num, num1, num2, isInverseSettings) {
                               let lowerNum;
                               let upperNum;
                                if(isInverseSettings){
                                    lowerNum = num2;
                                    upperNum = num1;
                               }else{
                                    lowerNum = num1;
                                    upperNum = num2;
                               }
                               if (num < lowerNum || num > upperNum) {
                                    if (Math.abs(num - lowerNum) < Math.abs(num - upperNum)) {
                                        return lowerNum;
                                    } else {
                                        return upperNum;
                                    }
                                } else {
                                    return num;
                                }
                            }
                    // });
                    }else{
                        alert(arr_resp[1]);
                    }
                }catch(e){alert('Error: '+e+'\n\n'+data);}
            }
    });

}
</script>


