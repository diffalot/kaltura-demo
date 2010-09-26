## Basic Usage

## Using Kaltura SaaS for Video Transcoding

To use html5 video flavors from your Kaltura account, you need only to include a `kentryid` attribute in yout `<video>` tag.  The library will automatically select the appropriate video flavors for your visitors devices (make sure you have contacted support and requested that [html5 video flavors](#codecs) be added to your account)

    <!DOCTYPE html>
    <html>
    <head>
      <script type="text/javascript" src="http://html5.kaltura.org/js" > </script> 
    </head>
    <body>
      <video kentryid="0_swup5zao"
        kwidgetid="_243342"></video>
    </body>
    </html>

## Hosting Your Own Video Transcodes

Using __Kaltura's HTML5 Media Library__ in your own applications is as simple as adding a script include of the library javascript, `http://html5.kaltura.org/js` and then using the normal html5 video tag, ie `<video src="myOgg.ogg">`.

Putting it all together your embed page should look something like this:

    <!DOCTYPE html>
    <html>
    <head>
      <script type="text/javascript" src="http://html5.kaltura.org/js" > </script> 
    </head>
    <body>
      <video id="video" style="width:544px;height:304px;" 
        poster="http://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Elephants_Dream.ogg/seek%3D13-Elephants_Dream.ogg.jpg"
        duration="10:53" 
        linkback="http://www.elephantsdream.org/" >
        <source type="video/ogg" src="http://ia311040.us.archive.org/3/items/ElephantsDream/ed_1024.ogv" >
        <source type="video/h264" src="http://ia311040.us.archive.org/3/items/ElephantsDream/ed_hd_512kb.mp4" >
        <track kind="subtitles" id="video_af" srclang="af" 
             src="media/elephants_dream/elephant.afrikaans.srt"></track>
        <track kind="subtitles" id="video_en" srclang="en"  
             src="media/elephants_dream/elephant.english.srt"></track> 
      </video>
    </body>
    </html>

* For best compatibility: we include the poster, durationHint, width and height attributes. This way browsers such as IE can display the player interface with poster image at the correct resolution with a duration in the user interface.
* If you would like to support html5 with h.264 ( safari, IE9, google chrome) and support a flash fallback for older versions of IE you include an h.264 source. For best compatibility your mp4 source should ideally use a h.264 profile compatible with mobile devices such as the iPhone.  <a href="http://corp.kaltura.com/">Kaltura hosted Solutions</a> include iPhone support. Desktop video encoding software such as <a href="http://handbrake.fr/">handbrake</a> also includes iPhone profiles. 
* If you would like to change the theme you can change the class attribute `<video class="kskin">` more info about custom theming is on the way. 


