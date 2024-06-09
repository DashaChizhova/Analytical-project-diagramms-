<?php
include __DIR__ . '/include/header_charset.php';
$id_page = basename(__FILE__, '.php');//index
define('s@>J$qw$i8_5rvY=6d{Z@!,V%J[J4Z^8C3q*bO$%/_db~iy6Fz=eTL/^O-@VKJU{E=U^x,JfooR19xKpgQ*,A/Dbg+9@>J1%.T[sL9#-4!-A8]t', true);
require_once __DIR__ . '/include/config.php';
require_once __DIR__ . '/include/db_action.php';
require_once __DIR__ . '/include/functions.php';
require_once __DIR__ . '/include/mobile_detect.php';

$link_page = 'none';

if(autorization() === false){
	$include_page = __DIR__ . '/pages/login.php';
}else{
	
	require_once __DIR__ . '/include/glob_array_data.php';
	
	//------------------mikro router start-----------------------
	$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	//portal
	//$url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$url = str_replace(ROOT_PATH_FULL, '', $url);
	$url = preg_replace('/[^a-z0-9\_\-\/]/', '', substr($url, 0, 255));
	
	$page = empty($mobile) ? 'pages' : 'pages_mob';
	
	$arr_param = explode('/',$url);
	if( $arr_param[0] == '' ){
		$include_page = __DIR__ . '/pages/index.php';
	}elseif(file_exists(__DIR__ . '/'.$page.'/'.$arr_param[0].'.php')){
		$include_page = __DIR__ . '/'.$page.'/'.$arr_param[0].'.php';
		$link_page = $arr_param[0];
		if(!empty($arr_param[1])){
			$get_param_1 = $arr_param[1];
		}
	}else{
		$include_page = __DIR__ . '/'.$page.'/404.php';
	}
	//------------------mikro router end-----------------------
	
}

$js_id_last_notif = (!empty($_SESSION['last_id_not'])) ? $_SESSION['last_id_not'] : 0;

?>
<!DOCTYPE html>
<html lang="ru">

<head>

<meta charset="utf-8">
<title>-ГРУПП</title>
<meta name="description" content="">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- Template Basic Images Start -->
<link rel="icon" href="<?=ROOT_PATH?>img/favicon/favicon.ico">
<link rel="apple-touch-icon" sizes="180x180" href="<?=ROOT_PATH?>img/favicon/apple-touch-icon-180x180.png">
<!-- Template Basic Images End -->

<!-- Custom Browsers Color Start -->
<meta name="theme-color" content="#000">
<!-- Custom Browsers Color End -->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link rel="stylesheet" href="<?=ROOT_PATH?>css/main.min.css?h=39">


<script src="<?=ROOT_PATH?>js/scripts.min.js"></script>

<!--<script type="text/javascript" src="<?=ROOT_PATH?>js_script/jquery.maskedinput.min.js"></script>-->
<script type="text/javascript" src="<?=ROOT_PATH?>js_script/jquery.maskedinput.js?4"></script>


<script type="text/javascript" src="<?=ROOT_PATH?>js_script/script.js?2"></script>

</head>
<body>
<!-- start -->
<?php if(autorization() === false){ include $include_page; exit; }?>

	<!-- Custom HTML -->
	<div class="page_wrap">
	
	<?php if(empty($mobile)){include __DIR__ . '/head.php';/*include __DIR__ . '/head_ng.php';*/}?>
	
		<section class="page_container">
			<div class="custom-grid">
				<?php 
				if(empty($mobile)){
					include __DIR__ . '/menu.php';
				}else{
					include __DIR__ . '/menu_mobile.php';
				}
				?>
				
				<?php include $include_page?>
			</div> 
		</section>
	</div>

<script type="text/javascript" language="javascript">
//--------------------------------------------------------------- sound ----------------------------------------------
var audio_notif = new Audio(); 
audio_notif.src = '<?=ROOT_PATH?>sound/add_notif.mp3'; 
var promise_notif;

function soundNotif(){
	
	audio_notif.autoplay = true; 
	promise_notif = audio_notif.play();
	
	if (promise_notif !== undefined) {
		promise_notif.then(_ => {
			audio_notif.play();
		})
		.catch(error => {
			console.log('err');
		});
	}
	
}

var audio_comment = new Audio(); 
audio_comment.src = '<?=ROOT_PATH?>sound/comment.mp3'; 
var promise_comment;

function soundComment(){
	
	audio_comment.autoplay = true; 
	promise_comment = audio_comment.play();
	
	if (promise_comment !== undefined) {
		promise_comment.then(_ => {
			audio_comment.play();
		})
		.catch(error => {
			console.log('err');
		});
	}
	
}
//--------------------------------------------------------------- sound ----------------------------------------------

var ws = new WebSocket("wss://<?=ROOT_PATH_HOST_NAME?>/chat001/");
//var ws = new WebSocket("wss://127.0.0.1:8000");
//var ws = new WebSocket("ws://127.0.0.1:8000"); 

ws.onopen = function(){
	ws.send(<?=$_SESSION['user_id']?>);
	console.log('Start Socket!');
}

ws.onmessage = function(evt){
	//console.log('new mess');
	
	var data = JSON.parse(evt.data);
	
	<?php if(isset($page_chat)){?>
	
	if(data.message){
		
		var id_chat_new_message = data.privates;
		
		var id_type = data.id_type;
		if(document.querySelector('div[data-list-chat]')!=undefined){
			if(document.querySelector('div[data-list-chat="'+data.privates+'"]')!=undefined){
				//если нам написали, проверяем есть ли фокус на это акно и обновляем его
				//data.privates id чата 
				if(id_type != "<?=$_SESSION['user_id']?>_0"){
					$(templateMessageIn(data.message, data.photo, data.fio, data.doljn, data.date_m)).fadeIn(100).appendTo('#chat_list');
					scrollWinChat();
					soundComment();
					//если есть айди чата, то удаляем уведомление о новом сообщении
					if(data.privates){
						deleteNewMessageChat(data.privates);
					}
				}
			}else{
				soundNotif();
				//обновляем менюшку слева
				loadMenuChat();
			}
		}
	
	}else if(data.user_group_id){
		loadMenuChat();
	}else if(data.user_private_id){
		loadMenuChat();
	}
	<?php }else{?>
	if(data.message){
		soundNotif();
		notifyMe('Новое сообщение в чате!', 'chat');
	}
	<?php }?>
};

ws.onclose = function(event) {
  if (event.wasClean) {
    console.log(`[close] Соединение закрыто чисто, код: ${event.code} причина: ${event.reason}`);
  } else {
    console.log(`[close] Соединение прервано, код: ${event.code}`);
  }
};

ws.onerror = function(error) {
  console.log(`[error] ${error.message}`);
};

var arr_notif_response;
var id_last_notif = <?=$js_id_last_notif?>;

$(document).ready(function() {
	zapusk_uvedoml = setTimeout('selectNewNotification();',333);
	notifSet();
	selectCountMessageChat();
});

function selectNewNotification(){
	
	clearTimeout(zapusk_uvedoml);
	
    $.post( '<?=ROOT_PATH?>ajax/ajax_extract_notif.php', {"select_notif": "4K46KDQGmhu4dRODbnzv", "param": 1}, function(data){
		console.log(data);
		arr_notif_response = JSON.parse(data);
		
		if(arr_notif_response[0] === 'yes'){
			
			$("[data-class ~= 'notifications'] .fas-ico").css('color','red');
			
			if(id_last_notif != arr_notif_response[1]){
				soundNotif();
				notifyMe(arr_notif_response[2]);
				<?php if(isset($page_notif)){?>
				//запускаем скролл и показ нового уведомления на странице notification.php
				newNotif();
				<?php }?>
			}
			
			if(arr_notif_response[1] > 0){
				$('link[rel="icon"], link[rel="apple-touch-icon"]').attr('href', '<?=ROOT_PATH?>/img/favicon/favicon2.gif?2');
			}
			
			id_last_notif = arr_notif_response[1];
			
		}else{
			$("[data-class ~= 'notifications'] .fas-ico").css('color','');
			$('link[rel="icon"], link[rel="apple-touch-icon"]').attr('href', '<?=ROOT_PATH?>/img/favicon/favicon.ico');
		}
		
		zapusk_uvedoml = setTimeout('selectNewNotification()',<?=TIME_AJAX?>);
	});
	
}


function selectCountMessageChat(){
	
    $.post( '<?=ROOT_PATH?>ajax/ajax_extract_notif.php', {"select_count_chat": "qdc4X01W54zSAdXtwUff", "param": 1}, function(data){
		//console.log(data);
		arr_notif_response = JSON.parse(data);
		
		if(arr_notif_response[0] === 'yes'){
			$("[data-class ~= 'chat'] .fas-ico").css('color','red');
		}else{
			$("[data-class ~= 'chat'] .fas-ico").css('color','');
		}
	});
	
}



function notifyMe(message, ref='notifications') {
	
	var notification = new Notification ("Новое уведомление", {
		tag : "notify",
		body : message,
		icon : "<?=ROOT_PATH?>images/info.png"
	});
	
	notification.onclick = function() {
		window.location.href = '<?=ROOT_PATH?>'+ref;
	};
	
}
function notifSet() {
	if (!("Notification" in window)){
		//alert("Ваш браузер не поддерживает уведомления.");
	}else if (Notification.permission === "granted"){
		//zapusk_uvedoml = setTimeout('notifyMe()',15000);
	}else if (Notification.permission !== "denied") {
		Notification.requestPermission (function (permission) {
			if (!('permission' in Notification)){
				Notification.permission = permission;
			}
			if (permission === "granted"){
				//zapusk_uvedoml = setTimeout('notifyMe()',15000);
			}
		});
	}
}
</script>

</body>
</html>