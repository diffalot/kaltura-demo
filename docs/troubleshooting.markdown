<h1 id="troubleshooting">Troubleshooting</h1>

<h2 id="codecs">Video Codecs</h2>

You will need to encode your video files into multiple codec formats to provide video for device platforms like iPhone, iPad, Android, and Blackberry.  [Dive into HTML5](http://diveintohtml5.org/video.html#firefogg) provides an excellent reference for encoding these multiple video formats with [Firefogg](http://firefogg.org/) , FFmpeg, and Handbrake.

If you would prefer to not have to deal with encoding your videos into multiple formats, you should obtain a trial account with [Kaltura](http://corp.kaltura.com/) and request a support technician setup your account to provide html5 flavored video codecs.

<h2 id="mime">HTML5 video MIME type</h2>

Note that if the MIME types for Theora video are not set on the server, the video may not show or show a gray box containing an X (if JavaScript is enabled).

You can fix this problem for the Apache Web Server by adding the extension used by Theora video files (".ogm", ".ogv", or ".ogg" are the common types) to the MIME type "video/ogg" via the "mime.types" file:

* Edit the mime.types apache configuration file (in "/etc/apache" on linux, "\xampp\apache\conf\mime.types" on windows-xampp)
* Search for `application/ogg     ogg` (if not exist skip this step), delete this line
* Add the following: `video/ogg     ogg ogm ogv`
* Restart apache

Or by adding the "AddType" configuration directive in httpd.conf - 

    AddType video/ogg .ogm
    AddType video/ogg .ogv
    AddType video/ogg .ogg
    AddType video/mp4 .mp4
    AddType video/webm .webm

Your web host may provide an easy interface to MIME type configuration changes for new technologies until a global update naturally occurs.
<h1 id="background">Background</h1>

This project started as a part of the MediaWiki HTML5 media functionality project.  *mwEmbed* is another name by which *Kaltura's HTML5 Media Library* is known at Wikimedia, where it provides Wikipedia's upcoming video editing functionality.

*mwEmbed* provides the basis for other MediaWiki media functionality. For more info see <a href="http://www.mediawiki.org/wiki/Media_Projects_Overview">the projects overview on MediaWiki</a> and the associated integration (currently called <a href="http://www.mediawiki.org/wiki/JS2_Overview">js2</a>) 

<h1 id="dev">Become a Developer</h1>

If you find this software useful, stop by #kaltura in FreeNode.

<h2 id="source">Get Project Source Code</h2>

<p class="note">MwEmbed is released under the GPL2 and hosted by the wikimedia foundation.<br />
You may check out a read-only working copy anonymously over HTTP:<br />
<span style="padding: 3px 0px 0px 30px; color:#555555;font-weight: bold;">svn checkout <a href="http://www.kaltura.org/kalorg/html5video/trunk/mwEmbed/" title="Kaltura Project Code - HTML5 and JS Media Library" target="_blank">http://www.kaltura.org/kalorg/html5video/trunk/mwEmbed/</a></span>
<span style="padding: 0px 0px 5px 0px; color:#885555;">If you'd like commit access, please submit a request to <a href="../join-project?lightframe" rel="lightframe[|width:570px; height:650px; scrolling: auto;]">join this project.</a>.</span>
</p>

<h2 id="compile_docs">Compile Developer Docs</h2>

    java -jar ~/src/jsdoc-toolkit/jsrun.jar ~/src/jsdoc-toolkit/app/run.js -t=/home/papyromancer/src/jsdoc-toolkit/templates/jsdoc/ mwEmbed.js loader.js mwEmbedLoader.js ./modules/**/*/*.js


    cat overview.markdown features.markdown basic_usage.markdown advanced_examples.markdown mit.markdown troubleshooting.markdown showcase.markdown license.markdown > README
    cat overview.markdown features.markdown basic_usage.markdown mit.markdown troubleshooting.markdown showcase.markdown > README.mit

    bluecloth README > docs/README.html

<h2 id="additionally">Additional Resources</h2>

For an overview of all mwEmbed files see: [http://www.mediawiki.org/wiki/MwEmbed](http://www.mediawiki.org/wiki/MwEmbed)

For stand alone usage see [http://kaltura.org/project/HTML5_Media_JavaScript_Library](http://kaltura.org/project/HTML5_Media_JavaScript_Library)


