if( !window.jquitr ){
	jquitr = {};
}
//add dev tool to page
jquitr.addThemeRoller = function(){
	if($j('#inline_themeroller').size() > 0){
		$j('#inline_themeroller').fadeIn();
	}
	else {
		var themeRollerSource = '<div id="inline_themeroller" style="display: none; position: fixed; background: #111; top: 25px; right: 25px; padding: 22px 0 15px 4px;width: 245px;height:400px; -webkit-border-radius: 6px; -moz-border-radius: 6px; z-index: 9999999;">'+
			'<a href="#" class="closeTR" style="font-family: Verdana, sans-serif; font-size: 10px; display: block; position: absolute; right: 0; top: 2px; text-align: right; background: url(http://jqueryui.com/themeroller/developertool/icon_bookmarklet_close.gif) 0 2px no-repeat; width: 16px;height: 16px; color: #fff; text-decoration: none;" title="Close ThemeRoller"></a>'+
			'<iframe name="trApp" src="themeroller/appinterface.html" style="background: transparent; overflow: auto; width: 240px;height:100%;border: 0;" frameborder="0" ></iframe>'+
			'</div>';

		$j('body').append( themeRollerSource );

		$j('#inline_themeroller')
			.draggable({
				start: function(){
					$j('<div id="div_cover" />')
					.appendTo('#inline_themeroller')
					.css({
						width: $j(this).width(), 
						height: $j(this).height(), 
						position: 'absolute', 
						top: 0, 
						left:0
					});
				},
				stop: function(){
					$j('#div_cover').remove();
				},
				opacity: 0.6,
				cursor: 'move'
			})
			.resizable({
				start: function(){
					$j(this).find('iframe').hide();
				},
				stop: function(){
					$j(this).find('iframe').show();
				},
				handles: 's'
			})
			.find('a.closeTR').click(function(){
				jquitr.closeThemeRoller();
			})
			.end()
			.find('.ui-resizable-s').css({
				background: 'url(http://jqueryui.com/themeroller/developertool/icon_bookmarklet_dragger.gif) 50% 50% no-repeat',
				border: 'none',
				height: '14px',
				dipslay: 'block',
				cursor: 'resize-s',
				bottom: '-3px'
			})
			.end()
			.css('cursor', 'move')
			.fadeIn();
		}
		jquitr.reloadCSS();		
}
//close dev tool
jquitr.closeThemeRoller = function(){
	$j('#inline_themeroller').fadeOut();
};
//get current url hash
jquitr.getHash = function(){
	var currSrc = window.location.hash;
	if(currSrc.indexOf('#') > -1){currSrc = currSrc.split('#')[1];}
	return currSrc;
};
//recursive reload call
jquitr.reloadCSS = function(){
	var currSrc = jquitr.getHash();
	if(jquitr.trString != currSrc && currSrc != ''){
		jquitr.trString = currSrc;
		var cssLink = '<link href="http://jqueryui.com/themeroller/css/parseTheme.css.php?'+ currSrc +'" type="text/css" rel="Stylesheet" />';
		//works for both 1.6 final and early rc's
		if( $j("link[href*=parseTheme.css.php], link[href=ui.theme.css]").size() > 0){
			$j("link[href*=parseTheme.css.php]:last, link[href=ui.theme.css]:last").eq(0).after(cssLink);
		}
		else {
			$j("head").append(cssLink);
		}
		if( $j("link[href*=parseTheme.css.php]").size() > 3){
			$j("link[href*=parseTheme.css.php]:first").remove();
		}
	}
	setTimeout(jquitr.reloadCSS, 1000);
}

