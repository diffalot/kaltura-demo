## Basic Usage of MIT Licensed Static Compiled HTML5 Video Player

[HTML5 Media Library]: http://www.kaltura.org/project/HTML5_Video_Media_JavaScript_Library
[HTML5 Video Player]: http://www.kaltura.org/project/HTML5_Video_Player

### Notes on Optimization

mwEmbed is designed to be used with a script-loader and this static package sacrifices transport size and packages in code every client won't use, in order to be a single static file.  You can learn more about using mwEmbed with a script-loader on the project home page. 

To use the load optimized [HTML5 Media Library][] replace your mwEmbed script include line of `<head>` with:

    <script type="text/javascript" src="http://html5.kaltura.org/js" ></script>

For full un-minified source see [HTML5 Video Player][]

### Basic Usage

In the `<head>` of your page you will need jQuery and the mwEmbed-player package:

    <!-- If your page already includes jQuery you can skip this step -->
    <script type="text/javascript" src="kaltura-html5player-widget/jquery-1.4.2.min.js" ></script>

    <!-- Include the css and javascript  -->
    <link rel="stylesheet" href="kaltura-html5player-widget/skins/jquery.ui.themes/jquery-ui-1.7.2.custom.css"></link> 
    <link rel="stylesheet" href="kaltura-html5player-widget/mwEmbed-player-static.css"></link> 
    <script type="text/javascript" src="kaltura-html5player-widget/mwEmbed-player-static.js"></scirpt>

Now in your HTML you can use the video tag and it will be given a user interface ie: 

    <video poster="myPoster.jpg" style="width:400px;height:300px" durationHint="32.2" >
      <source src="myH.264.mp4" />
      <source src="myOgg.ogg" />
    </video>
