/*-----------------------VARS--------------------------*/
//BTNs
var menu_btn_user = document.getElementById("menu-btn-user");
var menu_btn_menu = document.getElementById("menu-btn-menu");
var menu_btn_theme_dark = document.getElementById("menu-btn-theme-dark");
var menu_btn_theme_light = document.getElementById("menu-btn-theme-light");
//BLOCKs & ZONEs
var menu_block_user = document.getElementById("menu-block-user");
var menu_block_menu = document.getElementById("menu-block-menu");
//OTHERs
//var css_dark_theme = document.getElementById('dark-theme');
//var css_light_theme = document.getElementById('light-theme');
/*---------------------FUNCTIONS----------------------*/
//menu-user
menu_btn_user.onclick = function(){
	if(menu_block_user.style.width == "350px"){
		menu_block_user.style.width = "0px";
	}
	else{
		menu_block_menu.style.width = "0px";
		menu_block_user.style.width = "350px";
	}
}
//menu base-menu
menu_btn_menu.onclick = function(){
	if(menu_block_menu.style.width == "350px"){
		menu_block_menu.style.width = "0px";
	}
	else{
		menu_block_user.style.width = "0px";
		menu_block_menu.style.width = "350px";
	}
}

/*
//theme change *DARK*
menu_btn_theme_dark.onclick = function(){
	css_dark_theme.disabled = false;
	css_light_theme.disabled = true;
	//add cookie alter
	localStorage.setItem('blocked_theme',"light");
}
//theme change *LIGHT*
menu_btn_theme_light.onclick = function(){
	css_light_theme.disabled = false;
	css_dark_theme.disabled = true;
	//add cookie alter
	localStorage.setItem('blocked_theme',"dark");
}
*/