<?php
 include('../include/db_action.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/index.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="under_header">
            <div class="nazad_btn"><img src="../img/Back.svg" class="clear_img" alt="">Назад</div>
            <div class="title">Настройки</div>
            <div class="shesterenka_img" style="visibility: hidden;"><a href="#"><img src="../img/shesterenka.svg" alt=""></a></div>
            <div class="div_date" style="visibility: hidden;"><text class="date_text">Период C</text><input type="date" name="start_date"></div> 
            <div class="probel"></div>
            <div class="div_date" style="visibility: hidden;"><text class="date_text">Период ПО</text><input type="date" name="end_date"></div>  
            <div class="div_company" style="visibility: hidden;">Компания<select class="company_select"></select></div>  
            <div class="shesterenka_img"><a href="#"><img src="../img/Save.svg" alt=""></a></div>
        </div>

        <div class="nastroiki_main">
            <div class="vkladki">
                <div class="vkladka_btn"><a href="#" class="vkladka_a">Дебиторская задолженность</a></div>
                <div class="vkladka_btn"><a href="#" class="vkladka_a">Заявки</a></div>
                <div class="vkladka_btn"><a href="#" class="vkladka_a">Выручка</a></div>
                <div class="vkladka_btn"><a href="#" class="vkladka_a">Выход людей</a></div>
                <div class="vkladka_btn"><a href="#" class="vkladka_a">Кредиторская задолженность</a></div>
                <div class="vkladka_btn"><a href="#" class="vkladka_a">Остатки на счетах</a></div>
            </div>
            <div class="nastroiki_content">
                  <div class="rub">рублей</div>   
                  <div class="text_inputs">
                    <div div><input type="text" ></div>
                    <div class="tire"></div>
                    <div><input type="text" ></div>
                  </div>
                  <div class="score" style="color: #30AD43;">Отлично</div>
            </div>
            <div class="nastroiki_content">
                <div class="rub">рублей</div>   
                <div class="text_inputs">
                  <div div><input type="text" ></div>
                  <div class="tire"></div>
                  <div><input type="text" ></div>
                </div>
                <div class="score" style="color: #84BD32;">Хорошо</div>
            </div>
            <div class="nastroiki_content">
                <div class="rub">рублей</div>   
                <div class="text_inputs">
                <div div><input type="text" ></div>
                <div class="tire"></div>
                <div><input type="text" ></div>
                </div>
                <div class="score" style="color: #D1D80F;">Могло быть лучше</div>
            </div>
            <div class="nastroiki_content">
                <div class="rub">рублей</div>   
                <div class="text_inputs">
                  <div div><input type="text" ></div>
                  <div class="tire"></div>
                  <div><input type="text" ></div>
                </div>
                <div class="score" style="color: #FEE114;">Не хорошо</div>
          </div>
          <div class="nastroiki_content">
              <div class="rub">рублей</div>   
              <div class="text_inputs">
                <div div><input type="text" ></div>
                <div class="tire"></div>
                <div><input type="text" ></div>
              </div>
              <div class="score" style="color: #FF8888;">Плохо</div>
          </div>
          <div class="nastroiki_content">
              <div class="rub">рублей</div>   
              <div class="text_inputs">
              <div div><input type="text" ></div>
              <div class="tire"></div>
              <div><input type="text" ></div>
              </div>
              <div class="score" style="color: #FF0000;">Ахтунг</div>
          </div>

        </div>
    </div>
</body>
</html>