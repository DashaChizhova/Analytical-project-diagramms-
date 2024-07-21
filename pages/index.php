<?php 
$diagrams_array = selectColumnAll('diagrams_nastroiki', '*'); 


$myArray = getDiagrammNastroikiMassive();
$diagrams_array = array_merge($diagrams_array, $myArray);

$pokazateli_array = [];

foreach($diagrams_array as $val){
    $pokazateli_array[] = [
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
});

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
                                let resultArray = getPokazateliDiagramm(summaItog, index);
                                $(this).find('.diagramma_itog').text(summaItog.toLocaleString() + ' ' + resultArray.get('izmerenie'));
                                $(this).find('.diagramma').removeClass('empty-diagram');
                                $(this).find('.center').css('transform', `rotate(${resultArray.get('itog_degree')}deg)`);   
                                $(this).find('.diagramma_img').attr('src', `<?=ROOT_PATH?>img/diagramma/diagramma_${resultArray.get('otsenka')}.svg`);   
                                $(this).find('.diagramma_itog').css('background-color', `${resultArray.get('diagramma_itog_color')}`);
                            }
                        }); 
                     
                   
                        //находит в каких значениях находится сумма диграммы, чтобы поменять цвет и показатель стрелки диаграммы
                        function getPokazateliDiagramm(summaItog, index){
                                var pokazateli_array = <?php echo json_encode($pokazateli_array); ?>;
                                var arr;
                                arr = pokazateli_array[index];
                                
                                let isInverseSettings = arr['excelent_from'] > arr['ahtung_from']; //находит инверсивные ли показатели в настройках (от меньшего к большему или наоборот)
                                summaItog = checkPokazatel(summaItog, Math.min(arr['excelent_from'],arr['excelent_to']), Math.max(arr['ahtung_to'], arr['ahtung_from']), isInverseSettings); //проверяет находится ли показатель за границами настроек на странице настроек

                                
                                let scores = [
                                    { start: arr['excelent_from'], end: arr['excelent_to'], score: 150, score_text: "excelent", diagramma_itog_color: "#30AD43" },
                                    { start: arr['good_from'], end: arr['good_to'], score: 120, score_text: "good", diagramma_itog_color: "#84BD32" },
                                    { start: arr['better_from'], end: arr['better_to'], score: 90 , score_text: "better", diagramma_itog_color: "#D1D80F"},
                                    { start: arr['notgood_from'], end: arr['notgood_to'], score: 60, score_text: "notgood", diagramma_itog_color: "#FEE114" },
                                    { start: arr['bad_from'], end: arr['bad_to'], score: 30, score_text: "bad", diagramma_itog_color: "#FF8888" },
                                    { start: arr['ahtung_from'], end: arr['ahtung_to'], score: 0, score_text: "ahtung", diagramma_itog_color: "#FF0000" }
                                 ];
                                let result;
                                let otsenka = "" ;
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
                                var itog_degree = 30/(score.end/summaItog) + result;
                                var resultArray = new Map();
                                summaItog = summaItog.toLocaleString();
                                resultArray.set('otsenka', otsenka); //для фона диаграммы
                                resultArray.set('itog_degree', itog_degree); //для градусов наклона стрелки
                                resultArray.set('diagramma_itog_color',diagramma_itog_color);
                                // resultArray.set('summaItog',summaItog +' '+ arr['izmerenie']);
                                resultArray.set('izmerenie', arr['izmerenie']);
                                
                                console.log(summaItog)
                                console.log(resultArray.get('itog_degree'));
                                console.log(resultArray.get('otsenka'))
                                console.log(resultArray.get('diagramma_itog_color'))
                                console.log(resultArray.get('summaItog'))
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
                        }
                    // }
                    else{
                        alert(arr_resp[1]);
                    }
                }catch(e){alert('Error: '+e+'\n\n'+data);}
            }
    });
   

}



</script>