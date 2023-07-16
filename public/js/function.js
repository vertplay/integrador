/*-----------------------VARS--------------------------*/
var player = document.getElementById("music-player");
//BTNs
var music_label = document.getElementById("music-name");
var music_timer = document.getElementById("music-timer");
var music_duration = 0;
var play_btn = document.getElementById("play-btn");
var playlist_btn = document.getElementById("playlist-btn");
var repeat_btn = document.getElementById("repeat-btn");


var progress_bar = document.getElementById("audio-progress");
var atual_progress = document.getElementById("atual-progress");
/*--------------------PAINELS---------------------------*/
var player_zone = document.getElementById("play-bar");
var playlist_painel = document.getElementById("playlist");

/*-------------------CONFIG----------------------------*/
var link = "/projeto/public/";
var album_art;//TEMP(?)
var album_img = document.getElementById("album-art");
var timer_out;
var timer_get;
var timer_help;
var music_name;
var session_m,session_t,repeat_state;
var progress_bar_pos_click;
var progress_bar_begin = player_zone.offsetLeft;
var progress_bar_end = progress_bar.offsetWidth;
/*---------------------FUNCTIONS----------------------*/
/*--------------------------BTN CLICKS----------------------*/
play_btn.onclick = function(){
	//PLAY
	if(play_btn.innerHTML == "pause_circle_filled"){
		player.pause();
		play_btn.innerHTML = "play_circle_filled";
		clearInterval(timer_get);
		sessionStorage.setItem('player_state', 'paused');
	}
	//PAUSE
	else{
		player.play();
		play_btn.innerHTML = "pause_circle_filled";
		timer_get = setInterval(timer_att,1000);
		player_att_info(sessionStorage.getItem('player_music'));
		sessionStorage.setItem('player_state', 'running');
	}
}
playlist_btn.onclick = function(){
	if(playlist_painel.style.height == "300px"){
		playlist_painel.style.height = "0px";
	}
	else{
		playlist_painel.style.height = "300px";
	}
}
repeat_btn.onclick = function(){
	switch(repeat_state){
		case 0: //repetir atual
			repeat_btn.innerHTML = "repeat_one";
			repeat_btn.style.color = "#00bfff";
			repeat_state = 1;
			player.loop = true;
			sessionStorage.setItem('player_loop', 1);
		break;
		case 1: //n�o repetir
			repeat_btn.innerHTML = "repeat";
			repeat_btn.style.color = play_btn.style.color;
			repeat_state = 2;
			player.loop = false;
			sessionStorage.setItem('player_loop', 2);
		break;
		default: //repetir tudo
			repeat_btn.innerHTML = "repeat";
			repeat_btn.style.color = "#00bfff";
			repeat_state = 0;
			player.loop =  true;
			sessionStorage.setItem('player_loop', 0);
			//add controle de playlist
		break;
	}
}
/*--------------------------RECOVERY MUSIC SESSION----------------------*/
function refresh(){
	session_m=sessionStorage.getItem('player_music');
	session_t=sessionStorage.getItem('player_time');
	repeat_state = Number(sessionStorage.getItem('player_loop'));
	if(session_m != undefined & session_t != undefined & repeat_state != undefined & session_m != null & session_t != null & repeat_state != null){
		if(sessionStorage.getItem('player_state')=="running"){
			alter_music(session_m);
			player.currentTime=session_t;
			
		}
		else{
			player.src = link+"music/"+session_m;
			player.currentTime=session_t;
			player.pause();
			player.oncanplay =
				function(){
					player_att_info(session_m);
					timer_att();
				}
		}
		switch(repeat_state){
			case 1: //repetir atual
				repeat_btn.innerHTML = "repeat_one";
				repeat_btn.style.color = "#00bfff";
				player.loop = true;
			break;
			case 0: //repetir tudo
				repeat_btn.innerHTML = "repeat";
				repeat_btn.style.color = "#00bfff";
				player.loop =  true;
				//add controle de playlist
			break;
			default: //n�o repetir
				repeat_btn.innerHTML = "repeat";
				repeat_btn.style.color = play_btn.style.color;
				player.loop = false;
			break;
		}
	}
	else{
		player_display(false);
	}
}
/*--------------------------ALTER MUSIC----------------------*/
function alter_music(music_src){
	player.src = link+"music/"+music_src;
	player.play();//play
	play_btn.innerHTML = "pause_circle_filled";
	player.oncanplay =
		function(){
			player_att_info(music_src);
			timer_get = setInterval(timer_att,1000);
			sessionStorage.setItem('player_music', music_src);
			sessionStorage.setItem('player_state', 'running');
		}
}
/*--------------------------ATT INFO----------------------*/
function player_att_info(name){
	music_name = name.replace(".mp3", "");
	music_label.innerHTML = "Now Playing: " + music_name;
	timer_help = player.duration;
	music_duration = timer_help;
	music_timer.innerHTML = parseInt(music_duration / 60) + ":";
	if(parseInt(music_duration % 60)<10){
		music_timer.innerHTML += "0" + parseInt(music_duration % 60);
	}
	else{
		music_timer.innerHTML += parseInt(music_duration % 60)
	}
	player_display(false);//ESTADO PADRÃO DO PLAYER
	player_att_art(name);
}
function player_att_art(name){//TEMP(?)/////////
	album_art = "";
	for(var inicio=name.indexOf("[") + 1,fim=name.indexOf("]");inicio < fim;inicio++){
		album_art += name[inicio];
	}
	album_img.src =link+"img/album/" + album_art.toLowerCase() + ".jpg";
}
/*--------------------------ATT PROGRESS BAR----------------------*/
function timer_att(){
	timer_help = player.currentTime;
	atual_progress.style.width = (parseInt(timer_help) / parseInt(music_duration)) * 100 + "%";
	sessionStorage.setItem('player_time', timer_help);
	
}
/*--------------------------END MUSIC----------------------*/
player.onended = function(){end_m()};
function end_m(){
	play_btn.innerHTML = "play_circle_filled";
	music_label.innerHTML = "Stopped";
	clearInterval(timer_get);
	atual_progress.style.width = "100%";
	player_display(false);
}
/*------------------------AUDIO PROGRESS ALTER--------------------*/
function audio_progress(event){
	progress_bar_begin = player_zone.offsetLeft;
	progress_bar_end = progress_bar.offsetWidth; 
	progress_bar_pos_click = event.clientX - progress_bar_begin;
	atual_progress.style.width = (progress_bar_pos_click / progress_bar_end)*100 + "%";
	player.currentTime = music_duration * (progress_bar_pos_click / progress_bar_end);
}
/*------------------------VOLUME LEVEL ALTER--------------------*/
function volume_level(event){
	volume_zone = document.getElementById("volume-level");
	volume_bar_begin = player_zone.offsetLeft + 163;
	volume_bar_end = volume_zone.offsetWidth; 
	volume_bar_pos_click = event.clientX - volume_bar_begin;
	document.getElementById("atual-volume").style.width = (volume_bar_pos_click / volume_bar_end)*100 + "%";
	player.volume = (volume_bar_pos_click / volume_bar_end);
}
/*--------------------------PLAYER DISPLAY---------------------*/
player_zone.onmouseover = function(){clearTimeout(timer_out);player_display(true);}
player_zone.onmouseout = function(){timer_out = setTimeout(player_display,2000,false);}
function player_display(check_value){
	if(!check_value){
		player_zone.style.height = "8px";
		playlist_painel.style.bottom = "7px";
	}
	else{
		player_zone.style.height = "35px";
		playlist_painel.style.bottom = "35px";
	}
}