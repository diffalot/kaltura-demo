## Advanced Examples

## MediaRSS Playlists

## Fall Forward from Flash to html5 for iOS and Android Support

__Kaltura's HTML5 Video Library__ may be installed in conjunction with existing flash video integrations to provide fall forward from flash to html5 to enable video embedding for iPhone and iPad.

Installing html5 support to an existing Kaltura integration is as simple as adding a javascript tag to include `http://html5.kaltura.org/js`.  The library will automatically replace your Flash embed with an html5 `<video>` element on browsers capable of parsing the tag.

    <!DOCTYPE html>
    <html>
    <head>
      <title>Fall forward from Flash to html5</title>
      <script type="text/javascript" src="http://html5.kaltura.org/js"></script>
    </head>
    <body>
      <h2>Fall forward from Flash to html5</h2>
      <object id="kaltura_player" name="kaltura_player"
        type="application/x-shockwave-flash"
        allowFullScreen="true" allowNetworking="all"
        allowScriptAccess="always" height="330" width="400"
        data="http://www.kaltura.com/index.php/kwidget/cache_st/1274763304/wid/_243342/uiconf_id/48501/entry_id/0_swup5zao">
        <param name="allowFullScreen" value="true" />
        <param name="allowNetworking" value="all" />
        <param name="allowScriptAccess" value="always" />
        <param name="bgcolor" value="#000000" />
        <param name="flashVars" value="&" />
        <param name="movie" value="http://www.kaltura.com/index.php/kwidget/cache_st/1274763304/wid/_243342/uiconf_id/48501/entry_id/0_swup5zao" />
      </object>
    </body>
    </html>

## Themeing with jQuery-UI

You can add a custom jQuery UI theme by using the theme wizard: [http://www.kaltura.org/apis/html5lib/kplayer-examples/Player_Themable.html](http://www.kaltura.org/apis/html5lib/kplayer-examples/Player_Themable.html). Note that although the themeroller only works in Firefox, the temes you create with it will work in multiple browsers.


## Skinning and Themeing

[jQuery UI ThemeRoller]: http://jqueryui.com/themeroller/

You can add a custom jquery ui theme by using the [jQuery UI ThemeRoller][].  Downloading that theme and adding a reference to jquery-ui-.custom.css after the mwEmbed-player-static.css file.

A few sample jQuery UI themes are included in the skins/jquery.ui.themes folder of the [HTML5 Video Player][].

You can remove the kaltura attribution for the player by adding the following javascript:

    <script type="text/javascript">mw.setConfig('EmbedPlayer.kalturaAttribution', false );</script>

You can remove the kaltura attribution for the player by adding the following javascript: 

    <script type="text/javascript">mw.setConfig('EmbedPlayer.kalturaAttribution', false );</script>

## Analytics

## Subtitles


