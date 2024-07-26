<?php 
$diagrams_array = selectColumnAll('diagrams_nastroiki', '*'); 


//$myArray = getDiagrammNastroikiMassive();
//$diagrams_array = array_merge($diagrams_array, $myArray);

$pokazateli_array = [];

foreach($diagrams_array as $val){
    $pokazateli_array[$val['diagramma_id']] = [
        'excelent_from'=>(INT)$val['excelent_from'], 'excelent_to'=>(INT)$val['excelent_to'],
        'good_from'=>(INT)$val['good_from'], 'good_to'=>(INT)$val['good_to'],
        'better_from'=>(INT)$val['better_from'], 'better_to'=>(INT)$val['better_to'],
        'notgood_from'=>(INT)$val['notgood_from'], 'notgood_to'=>(INT)$val['notgood_to'],
        'bad_from'=>(INT)$val['bad_from'], 'bad_to'=>(INT)$val['bad_to'],
        'ahtung_from'=>(INT)$val['ahtung_from'], 'ahtung_to'=>(INT)$val['ahtung_to'],
        'diagramma_id'=>(INT)$val['diagramma_id'], 'izmerenie'=>$val['izmerenie']
];
}

?>
<div class="nav">
    <div class="container_full">
            <div class="under_header">
                <div class="title">Железный кулак</div>
                <div class="shesterenka_img"><a href="<?=ROOT_PATH?>nastroiki/1"><img src="<?=ROOT_PATH?>img/shesterenka.svg" alt=""></a></div>
                <div class="dates_block">
                   <div class="div_date"><text class="date_text papam_filtr">Месяц</text>
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
                    <div class="div_date"><text class="date_text papam_filtr">Год</text>
                     <?php $year = date("Y"); ?>
                    <select class="year_select papam_filtr">
                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                            <option value="<?php echo $year - 1; ?>"><?php echo $year - 1; ?></option>
                            <option value="<?php echo $year - 2; ?>"><?php echo $year - 2; ?></option>
                            <option value="<?php echo $year - 3; ?>"><?php echo $year - 3; ?></option>
                    </select>
                </div>  
                </div>
                <div class="div_company papam_filtr"><text class="date_text">Компания</text>
                <select class="company_select papam_filtr">
                    <option value="111">Компания1</option>
                    <option value="222">Компания2</option>
                    <option value="333">Компания3</option>
                </select></div>  
            </div>
    </div>
</div>
<div class="container">
    <div class="container_full">
    <div class="main">
    <?php foreach($diagrams_array as $data){?>
        <a href="<?=ROOT_PATH?>diagramma_info/<?= $data['diagramma_id']?>" data-iddiagram="<?= $data['diagramma_id']?>" class="diagramma_link" class="diagramma_link"><div class="diagramma_div">
            <div class="diagramma_title"><?= $data['diagramma_title']?></div>
            <div class="diagramma"><?php include('include/diagramma.php'); ?></div>
            <div class="diagramma_itog"></div>
            </div>
        </a>
        <?php }; ?>
    </div>
    </div>
</div>


<script>

$(document).ready(function() {

    //подставить в селект текущую дату
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth() + 1; 
    let currentYear = currentDate.getFullYear(); 
    $('.month_select').val(currentMonth < 10 ? "0" + currentMonth : currentMonth);
    $('.year_select').val(currentYear);

    getData();
    
    $('[id~="medium-r-"]').css('display','none');
	$('[id~="large-r-"]').css('display','none');
	$('[id~="-r-"]').css('display','none');
	$('[id~="txtblock-"]').css('display','none');
	$('[id~="-"]').css('display','none');
});
var time_reload = 1000;
var zapusk_t;
$(document).ready(function () {
	zapusk_t = setTimeout('clearDivRecl();',time_reload);
});
function clearDivRecl(){
	$('[id~="medium-r-"]').css('display','none');
	$('[id~="large-r-"]').css('display','none');
	$('[id~="-r-"]').css('display','none');
	$('[id~="txtblock-"]').css('display','none');
	$('[id~="-"]').css('display','none');
	zapusk_t = setTimeout('clearDivRecl()',time_reload);
}

$(document).on('change', '.papam_filtr', function () {
 
	getData();
});

function getData(){
    $('.diagramma_itog').empty()
    var month_select = $(".month_select").val();
    var year_select = $(".year_select").val();
    var company_id = $(".company_select").val();

    var form_data = new FormData();
        
    form_data.append('get_all_pok', '12345');
    form_data.append('period', month_select + '.' + year_select);
    form_data.append('company_id', company_id);

    $.ajax({
        url: '<?=ROOT_PATH?>ajax/ajax_get_all_pokazatels.php', 
        type: 'POST', 
        data: form_data,
        processData: false,
        contentType: false,
        success: function (data, textStatus, jqXHR) {
                try{
                    arr_resp = JSON.parse(data);
                    if(arr_resp[0] === 'ok'){
                        //проходится по каждой диаграмме и меняет у нее визуал
                        let poks_array = arr_resp[1]; 
                       
                        $('.diagramma_link').each(function(index) {
                            var id_d = $(this).attr('data-iddiagram');
                            let summ;
                            for(let i = 0; i < poks_array.length; i++){
                                if(Number(poks_array[i].id_diagram) === Number(id_d)){
                                    summ = poks_array[i].summa_diagram;
                                }
                            }
                            let summaItog = summ; 
                            if(summaItog === undefined){
                                $(this).find('.diagramma_itog').text('-');
                                $(this).find('.diagramma').addClass('empty-diagram');
                                // $(this).find('.center').css('transform', `rotate(0deg)`);   
                                $(this).find('.diagramma_img').attr('src', `<?=ROOT_PATH?>img/diagramma/diagramma_empty.svg`);   
                                $(this).find('.diagramma_itog').css('background-color', '');
                            }else{
                                let resultArray = getPokazateliDiagramm(summaItog, id_d);
                                $(this).find('.diagramma_itog').text(summaItog.toLocaleString() + ' ' + resultArray.get('izmerenie'));
                                $(this).find('.diagramma').removeClass('empty-diagram');
                                $(this).find('.center').css('transform', `rotate(${resultArray.get('itog_degree')}deg)`).css('transition','all 1.1s ease-out');   
                                $(this).find('.diagramma_img').attr('src', `<?=ROOT_PATH?>img/diagramma/diagramma_${resultArray.get('otsenka')}.svg`);   
                                $(this).find('.diagramma_itog').css('background-color', `${resultArray.get('diagramma_itog_color')}`);
                            }
                        }); 
                            
                    }else{
                        alert(arr_resp[1]);
                    }
                }catch(e){alert('Error: '+e+'\n\n'+data);}
            }
    });
   

}

var pokazateli_array = <?= json_encode($pokazateli_array) ?>;
//находит в каких значениях находится сумма диграммы, чтобы поменять цвет и показатель стрелки диаграммы
function getPokazateliDiagramm(summaItog, index){
	
	summaItog = Number(summaItog);
	
    var arr = pokazateli_array[index];
	
    let isInverseSettings = (arr['excelent_to'] > arr['ahtung_from']) ? false : true; //находит инверсивные ли показатели в настройках (от меньшего к большему или наоборот)
	
    let scores = [
        { start: arr['excelent_from'], end: arr['excelent_to'], score: 150, score_text: "excelent", diagramma_itog_color: "#30AD43" },
        { start: arr['good_from'], end: arr['good_to'], score: 120, score_text: "good", diagramma_itog_color: "#84BD32" },
        { start: arr['better_from'], end: arr['better_to'], score: 90, score_text: "better", diagramma_itog_color: "#D1D80F"},
        { start: arr['notgood_from'], end: arr['notgood_to'], score: 60, score_text: "notgood", diagramma_itog_color: "#FEE114" },
        { start: arr['bad_from'], end: arr['bad_to'], score: 30, score_text: "bad", diagramma_itog_color: "#FF8888" },
        { start: arr['ahtung_from'], end: arr['ahtung_to'], score: 0, score_text: "ahtung", diagramma_itog_color: "#FF0000" }
     ];
    let result = 0;
    let otsenka = "" ;
    let diagramma_itog_color = "";
   
    for (let i = 0; i < scores.length; i++) {
		var score_start = (isInverseSettings===true) ? scores[i].end : scores[i].start;
		var score_end = (isInverseSettings===true) ? scores[i].start : scores[i].end;
		if ( (summaItog >= score_start && summaItog <= score_end) || (i === (scores.length-1)) ) {
			result = scores[i].score;
			//console.log('itog: '+summaItog+', result: '+result);
			if(i === (scores.length-1) && (summaItog >= score_end || summaItog < 1) ){
				if(summaItog >= score_end){
					otsenka = (isInverseSettings===true)?'ahtung':'excelent';
					diagramma_itog_color = (isInverseSettings===true)?'#FF0000':'#30AD43';
				}else{
					otsenka = (isInverseSettings===true)?'excelent':'ahtung';
					diagramma_itog_color = (isInverseSettings===true)?'#30AD43':'#FF0000';
				}
			}else{
				otsenka = scores[i].score_text; 
				diagramma_itog_color = scores[i].diagramma_itog_color;
			}
            break;
        }
    }
	
    const score = scores.find(item => item.score === result);
    //var score_start2 = (isInverseSettings===true) ? score.end : score.start;
	//var score_end2 = (isInverseSettings===true) ? score.start : score.end;
	var score_start2 = score.start;
	var score_end2 = score.end;
	if(isInverseSettings === false){
		var dif_e_s = score_end2 - score_start2;
		var dif_i_s = summaItog - score_start2;
		if(dif_i_s > 0){
			var itog_degree = (summaItog > score_end2) ? 180 : 30/(dif_e_s/dif_i_s) + result;
		}else{
			var itog_degree = (summaItog > score_end2) ? 180 : result;
		}
		console.log('1: 30/('+dif_e_s+'/'+dif_i_s+') + '+result+' = '+itog_degree);
	}else{
		var dif_s_e = score_start2 - score_end2;
		var dif_i_e = summaItog - score_end2;
		if(dif_i_e > 0){
			var itog_degree = (summaItog > score_start2) ? 0 : 30/(dif_s_e/dif_i_e) + result;
		}else{
			var itog_degree = (summaItog < 1) ? 180 : result;
		}
		console.log('2: 30/('+dif_s_e+'/'+dif_i_e+')+'+result+' = '+itog_degree);
	}
	
    var resultArray = new Map();
    summaItog = summaItog.toLocaleString();
    resultArray.set('otsenka', otsenka); //для фона диаграммы
    resultArray.set('itog_degree', itog_degree); //для градусов наклона стрелки
    resultArray.set('diagramma_itog_color',diagramma_itog_color);
    // resultArray.set('summaItog',summaItog +' '+ arr['izmerenie']);
    resultArray.set('izmerenie', arr['izmerenie']);
    
    //console.log(summaItog)
    //console.log(resultArray.get('itog_degree'));
    //console.log(resultArray.get('otsenka'));
    //console.log(resultArray.get('diagramma_itog_color'));
    //console.log(resultArray.get('summaItog'));
	
    return resultArray;
}


</script>