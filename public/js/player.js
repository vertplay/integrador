class MusicPlayer {
    player_switch(){};

    constructor(){
        this.link = "/projetov2/public/";
        this.list = [];
        /*--------------------PAINELS---------------------------*/
        this.player_zone = document.getElementById("play-bar");
        this.playlist_painel = this.player_zone.children["playlist"];
        this.player = this.player_zone.children["music-player"];

        this.music_label = this.player_zone.children["music-name"];
        this.music_timer = this.player_zone.children["music-timer"];
        this.music_duration = 0;
        
        this.play_btn = this.player_zone.children["audio-controls"].children["play-btn"];
        this.playlist_btn = this.player_zone.children["audio-controls"].children["playlist-btn"];
        this.repeat_btn = this.player_zone.children["audio-controls"].children["repeat-btn"];

        //player display switch
        this.timer_out;
        var that = this;
        this.player_zone.onmouseover = function(){clearTimeout(this.timer_out);that.player_display(true);}
        this.player_zone.onmouseout = function(){this.timer_out = setTimeout(function(){ that.player_display(false)},2000);}

        this.play_btn.onclick = () => this.player_switch();
    }

    //alternar entre pausado ou tocando
    player_switch(){
        if(this.player.paused){
            this.player.play();
            this.play_btn.innerHTML = "pause_circle_filled";
        }
        else{
            this.player.pause();
            this.play_btn.innerHTML = "play_circle_filled";
        }
    }

    change_music(music, name){
        this.player.src = this.link+"music/"+music;
	    this.player.play();//play
	    this.play_btn.innerHTML = "pause_circle_filled";
        
        var that = this;
	    this.player.oncanplay =
		function(){
            that.player_att_info(name);//ATT INFO
			/*timer_get = setInterval(timer_att,1000);
			sessionStorage.setItem('player_music', music);
			sessionStorage.setItem('player_state', 'running');*/
		}
    }

    player_att_info(name){
	    this.music_label.innerHTML = "Now Playing: " + name;
	    this.timer_help = this.player.duration;
	    this.music_duration = this.timer_help;
        alert(this.player.duration);
	    this.music_timer.innerHTML = parseInt(this.music_duration / 60) + ":";
	    if(parseInt(this.music_duration % 60)<10){
		    this.music_timer.innerHTML += "0" + parseInt(this.music_duration % 60);
	    }
	    else{
		    this.music_timer.innerHTML += parseInt(this.music_duration % 60)
	    }
	    this.player_display(false);//ESTADO PADRÃO DO PLAYER
	    
    }

    player_display(check_value){
        if(!check_value){
            this.player_zone.style.height = "8px";
            this.playlist_painel.style.bottom = "7px";
        }
        else{
            this.player_zone.style.height = "35px";
            this.playlist_painel.style.bottom = "35px";
        }
        return true;
    }
    

}
var music_player
window.onload = function(){
    music_player = new MusicPlayer;
}