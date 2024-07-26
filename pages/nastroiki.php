<?php
 if(!empty($get_param_1)){

 }else{
     
 }



$diagrams_array = selectColumnAll('diagrams_nastroiki', '`diagramma_id`,`diagramma_title`');
// $myArray = getDiagrammNastroikiMassive();
// $arr_data2 = $arr_data3 = [];
// foreach ($myArray as $item) {
//         $arr_data2[] = ['diagramma_id'=>$item['diagramma_id'],'diagramma_title'=>$item['diagramma_title'] ];
    
// }
// $diagrams_array = array_merge($diagrams_array, $arr_data2);
$current_diagrams_array = selectColumnAll('diagrams_nastroiki', '*', '`diagramma_id`=?', [$get_param_1]);
// foreach ($myArray as $item) {
//     if($item['diagramma_id'] == $get_param_1){
//     $arr_data3[] = $item;
//     }
// }
// $current_diagrams_array = array_merge($current_diagrams_array, $arr_data3);
?>
<div class="nav">
<div class="container_full">
        <div class="under_header">
            <div class="title_block"> 
                <a href="<?=ROOT_PATH?>"><div class="nazad_btn"><div class="nazad_img"><img src="<?=ROOT_PATH?>img/Back.svg" class="clear_img" alt=""></div><div>Назад</div></div></a>
                <div class="title">Настройки</div>
            </div>
            <div style="visibility: hidden;" class="dates_block">
                <div class="div_date"><text class="date_text">Период C</text><input type="date" name="start_date" placeholder=" "></div> 
                <div class="div_date"><text class="date_text">Период ПО</text><input type="date" name="end_date"></div>  
            </div>
            <div style="visibility: hidden;" class="div_company"><text class="date_text">Компания</text><select class="company_select"></select></div>  
            <div class="shesterenka_img"><a class="save-btn" data-iddiagram="<?= $current_diagrams_array[0]['diagramma_id']?>" href="#"><img src="<?=ROOT_PATH?>img/Save.svg" alt=""></a></div>
        </div>
</div>
</div>
<div class="container">
<div class="container_full">
    <div class="nastroiki_main">
        <div class="vkladki">
        <?php foreach($diagrams_array as $data){?>
            <a href="<?=ROOT_PATH?>nastroiki/<?= $data['diagramma_id']; ?>" class="vkladka_a"><div data-iddiagram="<?= $data['diagramma_id']?>"  class="vkladka_btn"><?php echo  $data['diagramma_title']; ?></div></a>
        <?php }?>
        </div>
        <form enctype="multipart/form-data" method="post" action="include/pokazateli_send.php">
            <div class="nastroiki_content">
                <div class="rub"><?= $current_diagrams_array[0]['izmerenie'] ?></div>   
                <div class="text_inputs">
                    <div div><input id="excelent_from" type="text" name="excelent_from" value="<?= number_format($current_diagrams_array[0]['excelent_from'], 0, '', ' ');?>" ></div>
                    <div class="tire"></div>
                    <div><input id="excelent_to" type="text" name="excelent_to" value="<?= number_format($current_diagrams_array[0]['excelent_to'], 0, '', ' ');?>"></div>
                </div>
                <div class="score" style="color: #30AD43;">Отлично</div>
            </div>
            <div class="nastroiki_content">
                <div class="rub"><?= $current_diagrams_array[0]['izmerenie'] ?></div>   
                <div class="text_inputs">
                    <div div><input id="good_from" type="text" name="good_from" value="<?= number_format($current_diagrams_array[0]['good_from'], 0, '', ' ');?>" ></div>
                    <div class="tire"></div>
                    <div><input id="good_to" type="text" name="good_to" value="<?= number_format($current_diagrams_array[0]['good_to'], 0, '', ' ');?>" ></div>
                </div>
                <div class="score" style="color: #84BD32;">Хорошо</div>
            </div>
            <div class="nastroiki_content">
                <div class="rub"><?= $current_diagrams_array[0]['izmerenie'] ?></div>   
                <div class="text_inputs">
                <div div><input id="better_from" type="text" name="better_from" value="<?= number_format($current_diagrams_array[0]['better_from'], 0, '', ' ');?>" ></div>
                <div class="tire"></div>
                <div><input id="better_to" type="text" name="better_to" value="<?= number_format($current_diagrams_array[0]['better_to'], 0, '', ' ');?>" ></div>
                </div>
                <div class="score" style="color: #D1D80F;">Могло быть лучше</div>
            </div>
            <div class="nastroiki_content">
                <div class="rub"><?= $current_diagrams_array[0]['izmerenie'] ?></div>   
                <div class="text_inputs">
                    <div div><input id="notgood_from" type="text" name="notgood_from" value="  <?= number_format($current_diagrams_array[0]['notgood_from'], 0, '', ' '); ;?>" ></div>
                    <div class="tire"></div>
                    <div><input id="notgood_to" type="text" name="notgood_to" value="<?= number_format($current_diagrams_array[0]['notgood_to'], 0, '', ' ');?>" ></div>
                </div>
                <div class="score" style="color: #FEE114;">Не хорошо</div>
            </div>
            <div class="nastroiki_content">
                <div class="rub"><?= $current_diagrams_array[0]['izmerenie'] ?></div>   
                <div class="text_inputs">
                <div div><input id="bad_from" type="text" name="bad_from" value="<?= number_format($current_diagrams_array[0]['bad_from'], 0, '', ' ');?>" ></div>
                <div class="tire"></div>
                <div><input id="bad_to" type="text" name="bad_to" value="<?= number_format($current_diagrams_array[0]['bad_to'], 0, '', ' ');?>" ></div>
                </div>
                <div class="score" style="color: #FF8888;">Плохо</div>
            </div>
            <div class="nastroiki_content">
                <div class="rub"><?= $current_diagrams_array[0]['izmerenie'] ?></div>   
                <div class="text_inputs">
                <div div><input id="ahtung_from" type="text" name="ahtung_from" value="<?= number_format($current_diagrams_array[0]['ahtung_from'], 0, '', ' ');?>" ></div>
                <div class="tire"></div>
                <div><input id="ahtung_to" type="text" name="ahtung_to" value="<?= number_format($current_diagrams_array[0]['ahtung_to'], 0, '', ' ');?>" ></div>
                </div>
                <div class="score" style="color: #FF0000;">Ахтунг</div>
            </div>
        </form>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {

        var get_param_1 = "<?php echo $get_param_1; ?>";
        $('.vkladka_btn').each(function(index) {
            var id_d = $(this).attr('data-iddiagram');
            if(get_param_1 === id_d ){
                $(this).addClass("orange-background");
            }
         })
        


});
    
    	// -------------------------добавление записи в настройках------------------------
$(document).on('click', '.save-btn', function () {
	if (!confirm("Сохранить настройки?")) {
		return;
	}
    var id_d = $(this).attr('data-iddiagram');
    
	var form_data = new FormData();
	
	form_data.append('save_pok', '12345'); 
    form_data.append('diagramma_id', id_d);

    form_data.append('excelent_from', parseInt($('#excelent_from').val().replace(/\s/g, '')));
    form_data.append('excelent_to', parseInt($('#excelent_to').val().replace(/\s/g, '')));

    form_data.append('good_from', parseInt($('#good_from').val().replace(/\s/g, '')));
    form_data.append('good_to', parseInt($('#good_to').val().replace(/\s/g, '')));

    form_data.append('better_from', parseInt($('#better_from').val().replace(/\s/g, '')));
    form_data.append('better_to', parseInt($('#better_to').val().replace(/\s/g, '')));

    form_data.append('notgood_from',  parseInt($('#notgood_from').val().replace(/\s/g, '')));
    form_data.append('notgood_to', parseInt($('#notgood_to').val().replace(/\s/g, '')));

    form_data.append('bad_from', parseInt($('#bad_from').val().replace(/\s/g, '')));
    form_data.append('bad_to', parseInt($('#bad_to').val().replace(/\s/g, '')));

    form_data.append('ahtung_from', parseInt($('#ahtung_from').val().replace(/\s/g, '')));
    form_data.append('ahtung_to', parseInt($('#ahtung_to').val().replace(/\s/g, '')));

	$.ajax({
		url: "<?=ROOT_PATH?>ajax/ajax_save.php",
		type: "POST",
		data: form_data,
		processData: false,
		contentType: false,
		success: function (data, textStatus, jqXHR) {
			try{
				arr_resp = JSON.parse(data);
				if(arr_resp[0] === 'ok'){
					alert('Настройки сохранены');
				}else{
					alert(arr_resp[1]);
				}
			}catch(e){alert('Error: '+e+'\n\n'+data);}
		}
	});
});
   

</script>