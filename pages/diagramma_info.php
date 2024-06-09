<?php 
 $data_array = array_reverse(selectColumnAll('debitorka', '*'));
?>
<div class="container">

    <div class="under_header">
        <a href="index.php"><div class="nazad_btn"><div class="nazad_img"><img src="img/Back.svg" class="clear_img" alt=""></div><div>Назад</div></div></a>
        <div class="title">Дебиторская задолженность</div>
        <div class="div_date" style="visibility: hidden;"><text class="date_text">Период C</text><input type="date" name="start_date"></div> 
        <div class="probel"></div>
        <div class="div_date" style="visibility: hidden;"><text class="date_text">Период ПО</text><input type="date" name="end_date"></div>  
        <div class="div_company">Компания<select class="company_select"></select></div>  
    </div> 

    <div class="diagramma_main">
        <div class="info_block">
            <div class="diagramma_block">
                <div class="diagramma">
                    <img class="diagramma_img" src="img/diagramma/diagramma.svg" alt="">
                    <div class="strelka"></div>
                    <div class="center" alt=""></div>
                </div>
                <div class="diagramma_itog"><?php echo number_format($data_array[0]['debitorka_summa'], 0, '.', ' '); ?> руб.</div>
                <div class="nastroiki">
                    <div class="row">
                        <div class="div_date">Период С<br> <input type="date" name="start_date"></div> 
                        <div class="tire tire_low"></div>
                        <div class="div_date">Период ПО <br><input type="date" name="end_date"></div>  
                    </div>
                    <div  class="row">
                        <div ><input class="search_btn" class="search_btn" type="submit" value="Поиск"></div>  
                        <div class="clear_btn"><a href="#">Очистить <img class="clear_img" src="img/lastik.svg" alt=""></a></div>  
                    </div>
                </div>
            </div>
            <div class="stick"></div>
            <div class="pokazateli_block">
                <div class="scrollable_content">
                    <div class="pokazateli_title">История показателя дебиторской задолженности</div><br>
                    <div class="pokazateli_row row">
                        <div class="number"></div>
                        <div class="pokazatel_date">Дата <br><input type="date" name="end_date" ></div>  
                        <div class="pokazatel">Показатель<br><input type="text" ></div>
                        <div class="pokazatel_btn"><a href="#"><img src="img/Plus Math.svg" alt=""></a></div>
                    </div>
                    <?php
                        foreach($data_array as $key => $data){
                            $reverse_number = count($data_array) - $key;
                            $month=date("m",strtotime($data['debitorka_date']));
                            $year=date("Y",strtotime($data['debitorka_date']));
                    ?>
                    <div class="pokazateli_row row">
                        <div class="number"> #<?php echo $reverse_number ; ?></div>
                        <div class="pokazatel_date" >Дата<br><input type="text" name="end_date" value="<?php echo $month.'.'.$year; ?>"></div>  
                        <div class="pokazatel" >Показатель<br><input type="text" name="end_date" value="<?php echo number_format($data['debitorka_summa'], 0, '.', ' '); ?>"></div>
                        <div class="pokazatel_btn"><a href="#"><img src="img/Remove.svg" alt=""></a></div>
                    </div>
                    <?php
                        };
                    ?>           
                </div>
            </div>
        </div>
        <div class="grafik_block">
            <div class="grafik_title">Динамика дебиторской задолженности</div>
            <div class="grafik_period">
                <ul class="grafik_ul">
                    <li class="grafik_li ">Месяц</li>
                    <li class="grafik_li">3 Месяца</li>
                    <li class="grafik_li">6 Месяцев</li>
                    <li class="grafik_li">Год</li>
                    <li class="grafik_li ">Все время</li>
                </ul>
            </div>
        </div>
            <canvas id="myChart"></canvas>
        
    </div>
</div>
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
      datasets: [{
        label: '',
        data: [1000000, 2000000, 3000000, 4000000, 5000000, 6000000],
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
</script>

