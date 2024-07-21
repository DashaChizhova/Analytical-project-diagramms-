
<?php 
//https://fontawesome.com/icons?d=gallery
/*
zakritie:
Заявки на работу 
Запрос справки
ЧС
Инциденты
Карта геолокации
Объекты строительства
Заявки на кредит
Филиалы
Опросы
Форум
Логи
Анонимные жалобы
*/
?>

<div class="div_block">
	<div data-class="chat" class="li_nav"><a href="<?=ROOT_PATH?>chat"><div class="name">Чат <i class="fas fa-comments fas-ico"></i></div></a></div>
	<div data-class="task add-task edit-task" class="li_nav"><a href="<?=ROOT_PATH?>task"><div class="name">Планировщик задач <i class="fas fa-tasks fas-ico"></i></div></a></div>
	<div data-class="diary add-diary edit-diary" class="li_nav"><a href="<?=ROOT_PATH?>diary"><div class="name">Ежедневник <i class="fas fa-book fas-ico"></i></div></a></div>
	<div data-class="contract detail-contract add-contract" class="li_nav"><a href="<?=ROOT_PATH?>contract"><div class="name">Система договоров <i class="fas fa-file-contract fas-ico"></i></div></a></div>
	<div data-class="structure-company" class="li_nav"><a href="<?=ROOT_PATH?>structure-company"><div class="name">Структура компании <i class="fas fa-building fas-ico"></i></div></a></div>
	<div data-class="staff staff-profile" class="li_nav"><a href="<?=ROOT_PATH?>staff"><div class="name">Сотрудники <i class="fas fa-users fas-ico"></i></div></a></div>
	<div data-class="working working-profile" class="li_nav"><a href="<?=ROOT_PATH?>working"><div class="name">Список Рабочих <i class="fas fa-address-book fas-ico"></i></div></a></div>
	<div data-class="contragents contragents-detail" class="li_nav"><a href="<?=ROOT_PATH?>contragents"><div class="name">Контрагенты <i class="fas fa-briefcase fas-ico"></i></div></a></div>
	<!--<div data-class="job job-detail" class="li_nav"><a href="<?=ROOT_PATH?>job"><div class="name">Заявки на работу <i class="fas fa-user-plus fas-ico"></i></div></a></div>-->
	<div data-class="news add-news edit-news" class="li_nav"><a href="<?=ROOT_PATH?>news"><div class="name">Новости <i class="fas fa-rss-square fas-ico"></i></div></a></div>
	<!--<div data-class="credit credit-detail" class="li_nav"><a href="<?=ROOT_PATH?>credit"><div class="name">Заявки на кредит <i class="fas fa-credit-card fas-ico"></i></div></a></div>-->
	<!--<div data-class="reference reference-detail" class="li_nav"><a href="<?=ROOT_PATH?>reference"><div class="name">Запрос справки <i class="fas fa-bookmark fas-ico"></i></div></a></div>-->
	<div data-class="push" class="li_nav"><a href="<?=ROOT_PATH?>push"><div class="name">Push-уведомления <i class="fas fa-comment-dots fas-ico"></i></div></a></div>
	<!--<div data-class="cs cs-detail" class="li_nav"><a href="<?=ROOT_PATH?>cs"><div class="name">ЧС <i class="fas fa-dot-circle fas-ico"></i></div></a></div>
	<div data-class="incident" class="li_nav"><a href="<?=ROOT_PATH?>incident"><div class="name">Инциденты <i class="fas fa-info-circle fas-ico"></i></div></a></div>-->
	<div data-class="notifications" class="li_nav"><a href="<?=ROOT_PATH?>notifications"><div class="name">Уведомления <i class="fas fa-bell fas-ico"></i></div></a></div>
	<div data-class="file-storage" class="li_nav"><a href="<?=ROOT_PATH?>file-storage"><div class="name">Файлы <i class="fas fa-folder fas-ico"></i></div></a></div>
	<div data-class="manager-table" class="li_nav"><a href="<?=ROOT_PATH?>manager-table"><div class="name">Таблица <i class="fas fa-table fas-ico"></i></div></a></div>
	<!--<div data-class="complaint" class="li_nav"><a href="<?=ROOT_PATH?>complaint"><div class="name">Анонимные жалобы <i class="fas fa-angry fas-ico"></i></div></a></div>-->
	<div data-class="needs needs-profile" class="li_nav"><a href="<?=ROOT_PATH?>needs"><div class="name">Потребности <i class="fas fa-address-card fas-ico"></i></div></a></div>
	<div data-class="request" class="li_nav"><a href="<?=ROOT_PATH?>request"><div class="name">Заявки <i class="fas fa-clipboard fas-ico"></i></div></a></div>
	<div data-class="request_ticket" class="li_nav"><a href="<?=ROOT_PATH?>request_ticket"><div class="name">Заявки на билет <i class="fas fa-calendar fas-ico"></i></div></a></div>
	<div data-class="list" class="li_nav"><a href="<?=ROOT_PATH?>list"><div class="name">Списки <i class="fas fa-list-ol fas-ico"></i></div></a></div>
	<div data-class="office_manager" class="li_nav"><a href="<?=ROOT_PATH?>office_manager/index.php"><div class="name">Отправки <i class="fas fa-bus fas-ico"></i></div></a></div>
	
	<div class="li_nav" id="open_all"><a href="#none"><div class="name">Показать все <i class="fas fa-arrow-right fas-ico"></i></div></a></div>
</div>

<script type="text/javascript" language="javascript">
$('.li_nav,.li_nav_op').removeClass('li_active');
$("[data-class ~= '<?=$link_page?>']").addClass('li_active');

$(document).on('click', '.li_nav,.li_nav_op', function(){
	var id = $(this).attr('id');
	
	if(id === 'open_all'){
		if($(this).hasClass('li_nav')){
			$('.li_nav').addClass('li_nav_op').removeClass('li_nav');
			$('#open_all').html('<div class="name">Скрыть все <i class="fas fa-arrow-left fas-ico"></i></div>');
		}else{
			$('.li_nav_op').addClass('li_nav').removeClass('li_nav_op');
			$('#open_all').html('<div class="name">Показать все <i class="fas fa-arrow-right fas-ico"></i></div>');
		}
	}
	
	//$('.li_nav,.li_nav_op').removeClass('li_active');
	//$("[data-class ~= '<?=$link_page?>']").addClass('active');
	//$(this).addClass('li_active');
});
</script>

<!--
<div class="sidebar">
	<ul class="nav_admin_list">
		<li class="actv" data-class="chat"><a href="<?=ROOT_PATH?>chat"><span class="name"><i class="fas fa-comments fas-ico"></i>Чат</span></a></li>
		<li class="actv" data-class="task add-task edit-task"><a href="<?=ROOT_PATH?>task"><span class="name"><i class="fas fa-tasks fas-ico"></i>Планировщик задач</span></a></li>
		<li class="actv" data-class="diary add-diary edit-diary"><a href="<?=ROOT_PATH?>diary"><span class="name"><i class="fas fa-book fas-ico"></i>Ежедневник</span></a></li>
		<li class="actv" data-class="contract detail-contract add-contract"><a href="<?=ROOT_PATH?>contract"><span class="name"><i class="fas fa-file-contract fas-ico"></i>Система договоров</span></a></li>
		<li class="actv" data-class="structure-company"><a href="<?=ROOT_PATH?>structure-company"><span class="name"><i class="fas fa-building fas-ico"></i>Структура компании</span></a></li>
		<li class="actv" data-class="staff staff-profile"><a href="<?=ROOT_PATH?>staff"><span class="name"><i class="fas fa-users fas-ico"></i>Сотрудники</span></a></li>
		<li class="actv" data-class="working working-profile"><a href="<?=ROOT_PATH?>working"><span class="name"><i class="fas fa-address-book fas-ico"></i>Список Рабочих</span></a></li>
		<!--<li class="actv" data-class="map-geo"><a href="<?=ROOT_PATH?>map-geo"><span class="name"><i class="fas fa-map-marked-alt fas-ico"></i>Карта геолокации</span></a></li>-j->
		<li class="actv" data-class="contragents contragents-detail"><a href="<?=ROOT_PATH?>contragents"><span class="name"><i class="fas fa-briefcase fas-ico"></i>Контрагенты</span></a></li>
		<!--<li class="actv"><a href="<?=ROOT_PATH?>"><span class="name"><i class="fas fa-home fas-ico"></i>Объекты строительства</span></a></li>-j->
		<!--<li class="actv" data-class="branches add-branches"><a href="<?=ROOT_PATH?>branches"><span class="name"><i class="fas fa-hotel fas-ico"></i>Филиалы</span></a></li>-j->
		<li class="actv" data-class="news add-news edit-news"><a href="<?=ROOT_PATH?>news"><span class="name"><i class="fas fa-rss-square fas-ico"></i>Новости</span></a></li>
		<!--<li class="actv" data-class="polls poll add-poll"><a href="<?=ROOT_PATH?>polls"><span class="name"><i class="fas fa-poll fas-ico"></i>Опросы</span></a></li>-j->
		<!--<li class="actv" data-class="job job-detail"><a href="<?=ROOT_PATH?>job"><span class="name"><i class="fas fa-user-plus fas-ico"></i>Заявки на работу</span></a></li>-j->
		li class="actv" data-class="credit credit-detail"><a href="<?=ROOT_PATH?>credit"><span class="name"><i class="fas fa-credit-card fas-ico"></i>Заявки на кредит</span></a></li>
		<!--<li class="actv" data-class="reference reference-detail"><a href="<?=ROOT_PATH?>reference"><span class="name"><i class="fas fa-bookmark fas-ico"></i>Запрос справки</span></a></li>-j->
		<li class="actv" data-class="push"><a href="<?=ROOT_PATH?>push"><span class="name"><i class="fas fa-comment-dots fas-ico"></i>Push-уведомления</span></a></li>
		<!--<li class="actv" data-class="forum add-forum edit-forum forum-detail"><a href="<?=ROOT_PATH?>forum"><span class="name"><i class="fas fa-comment-alt fas-ico"></i>Форум</span></a></li>-j->
		<li class="actv" data-class="cs cs-detail"><a href="<?=ROOT_PATH?>cs"><span class="name"><i class="fas fa-dot-circle fas-ico"></i>ЧС</span></a></li>
		<!--<li class="actv" data-class="incident"><a href="<?=ROOT_PATH?>incident"><span class="name"><i class="fas fa-info-circle fas-ico"></i>Инциденты</span></a></li>-j->
		<li class="actv" data-class="notifications"><a href="<?=ROOT_PATH?>notifications"><span class="name"><i class="fas fa-bell fas-ico"></i>Уведомления</span></a></li>
		<!--<li class="actv" data-class="log"><a href="<?=ROOT_PATH?>log"><span class="name"><i class="fas fa-exclamation-triangle fas-ico"></i>Логи</span></a></li>-j->
		<li class="actv" data-class="file-storage"><a href="<?=ROOT_PATH?>file-storage"><span class="name"><i class="fas fa-folder fas-ico"></i>Файлы</span></a></li>
		<li class="actv" data-class="manager-table"><a href="<?=ROOT_PATH?>manager-table"><span class="name"><i class="fas fa-table fas-ico"></i>Таблица</span></a></li>
		<li class="actv" data-class="complaint"><a href="<?=ROOT_PATH?>complaint"><span class="name"><i class="fas fa-angry fas-ico"></i>Анонимные жалобы</span></a></li>
		<li class="actv" data-class="needs"><a href="<?=ROOT_PATH?>needs"><span class="name"><i class="fas fa-address-card fas-ico"></i>Потребности</span></a></li>
		<li class="actv" data-class="request"><a href="<?=ROOT_PATH?>request"><span class="name"><i class="fas fa-clipboard fas-ico"></i>Заявки</span></a></li>
		<li class="actv" data-class="list"><a href="<?=ROOT_PATH?>list"><span class="name"><i class="fas fa-list-ol fas-ico"></i>Списки</span></a></li>
		<li class="actv" data-class="office_manager"><a href="<?=ROOT_PATH?>office_manager/index.php"><span class="name"><i class="fas fa-bus fas-ico"></i>Отправки</span></a></li>
	</ul>
</div>

<script type="text/javascript" language="javascript">
$('.actv').removeClass('active');
$("[data-class ~= '<?=$link_page?>']").addClass('active');
</script>

-->






