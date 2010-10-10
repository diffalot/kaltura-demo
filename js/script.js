/* Author:  Andrew Davis <andrew.davis@kaltura.com>
  The Prototyping Script
*/

// Our Raw Data, carefully prepared
var demonstrations = [
  { 
/* Template for Data
    name:        "",
platform:        [ 'handheld', 'webkit', 'firefox' ],
    beta:        false,
difficulty:      1,
    docs:        "docs/.markdown",
    slug:        "",
    key:         "",
    sourceURL:   "" 
  }, { 
*/
   name:        "Green Screen in Canvas",
difficulty:      1,
    docs:        "docs/.markdown",

    slug:        "from [Paul Rouget](http://people.mozilla.com/~prouget/demos/green/green.xhtml)",
    key:         "greenscreen",
    sourceURL:   "examples-paulrouget/green.xhtml"
  }, {
   name:        "HTML5 Player with Flash Fallback",
difficulty:      1,
    docs:        "docs/.markdown",

    slug:        "The *Fallback* player defaults to an HTML5 media player and only uses flash fallback when the browser cannot use the `<video>` or `<audio>` html tag.",
    key:         "player-fallback",
    sourceURL:   "examples/Player_Fallback.html"
  }, {
    name:        "HTML5 Playlist",
difficulty:      1,
    docs:        "docs/.markdown",

    slug:        "_Kaltura's HTML5 Media Library_ has full support for locally and remotely hosted MediaRSS feeds via it's playlist player.",
    key:         "ipad-playlist",
    sourceURL:   "examples/Player_PlaylistFallForward.html"
  }, {
    name:        "Fall Forward Player",
difficulty:      1,
    docs:        "docs/.markdown",

    slug:        "When used in *Fall Forward* mode, Kaltura's player provides HTML5 video and audio embedding on devices that do not support Flash.",
    key:         "player-fall-forward",
    sourceURL:   "examples/Player_FallForward.html"
  }, { 
    name:        "Audio Player",
difficulty:      1,
    docs:        "docs/.markdown",

    slug:        "The *Audio Player* plays audio files embedded with the `<audio>` tag.",
    key:         "player-audio",
    sourceURL:   "examples/Player_Audio.html" 
  }, { 
    name:        "jQuery UI Themeable Player",
difficulty:      1,
    docs:        "docs/.markdown",

    slug:        "This example allows you to build a custom jQueryUI theme when viewed in Firefox.",
    key:         "player-themeable",
    sourceURL:   "examples/Player_Themable.html"
  }, { 
    name:        "Player Inserted by Kaltura EntryID",
difficulty:      2,
    docs:        "docs/.markdown",

    slug:        "A video on a Kaltura server may be inserted into a page using only the Kaltura EntryID and WidgetID.",
    key:         "player-kentryid",
    sourceURL:   "examples/Player_kEntryId.html"
  }, { 
    name:        "Javascript Dynamic Embed Demo",
difficulty:      2,
    docs:        "docs/.markdown",

    slug:        "_Kaltura's HTML5 Video Player_ may be dynamically generated from pure Javascript.",
    key:         "player-dynamic-embed",
    sourceURL:   "examples/Player_DynamicEmbed.html"
  }, { 
    name:        "iOS Player with Native Controls",
difficulty:      2,
    docs:        "docs/.markdown",
    slug:        "Although Kaltura provides advanced player skinning through css, you may decide to use the browser's native controls while still using the analytics and reporting features of the library.",
    key:         "ipad-native-controls",
    sourceURL:   "examples/Player_IpadNativeControls.html"
  }, { 
    name:        "iOS Touch interface Mashup",
difficulty:      3,
    docs:        "docs/.markdown",

    slug:        "iOS touch controls may be bound to the player controls.",
    key:         "ipod-touch-control-mashup",
    sourceURL:   "examples/Player_IpadTouchMashup.html"
  }, { 
    name:        "iOS with HTML Controls",
difficulty:      2,
    slug:        "",
    docs:        "docs/.markdown",
    key:         "ipad-html",
    sourceURL:   "examples/Player_IpadHTMLControls.html"
  }, {
    name:        "Javascript API Demonstration",
difficulty:      2,
    docs:        "docs/.markdown",

    slug:        "_Kaltura's HTML5 Video Library_ can be controlled completely through it's Javascript API.",
    key:         "player-api",
    sourceURL:   "examples/Player_ApiDemo.html"
  }, {
    name:        "Static Media Gallery",
difficulty:      4,
    docs:        "docs/.markdown",

    slug:        "_Kaltura's HTML5 Media Library_ can be fully scripted to create customized user interfaces to media content hosted on a Kaltura server or any other server platform.  (This examples uses a Kaltura server for thumbnail and video hosting.)",
    key:         "player-gallery",
    sourceURL:   "examples/mediaRSS-Gallery/video_library.html" 
  }, {
    name:        "Add Media Wizard",
difficulty:      3,
    docs:        "docs/.markdown",

    slug:        'The *Add Media Wizard* allows searching and browsing open content repositories like [Archive.org](http://archive.org), [Wikimedia Commons](http://commons.wikimedia.org/wiki/Main_Page), [Metavid](http://metavid.org/wiki/), and [Flickr](http://www.flickr.com/).',
    key:         "add-media-wizard",
    sourceURL:   "examples/Add_Media_Wizard.html" 
}];

// Variable Declarations
var editor = undefined;
var source = undefined;

// Stupid user agent tricks to determine browser
var handheld = false;
if ( navigator.userAgent.indexOf('iPhone') == -1 ) {
} else {
  handheld = true;
}
if ( navigator.userAgent.indexOf('iPad') == -1 ) {
} else {
  handheld = true;
}
if ( navigator.userAgent.indexOf('Android') == -1 ) {
} else {
  handheld = true;
}

// switch to editor for handhelds
  function switchToEdit() {
    var height = $(".syntaxhighlighter").height();
    $("#the-source").hide();
    $("#source-code").height(height*1.2);
    $("#source-code").show();
    $("#switch-to-edit").remove();
    $("#update-preview").show();
    $('#button-pane').html('<button id="update-preview">Update Preview</button><button id="switch-to-source" onClick="switchToSource();">Back to Syntax Highlighted View</button>');
  }

  function switchToSource() {
    $("#source-code").hide();
    $("#the-source").show();
    $("#switch-to-source").remove();
    $("#update-preview").hide();
    $('#button-pane').html('');

  }


// Here we go! the dom is ready, let's run
$(function(){

  // The Model

  var demos = new Lawnchair({adaptor: "dom"});
  // Let's grab each demo and throw the raw data into the store
  $.each( demonstrations, function(index, demonstration) {
      demos.save({ 
        slug:demonstration.slug, 
        name:demonstration.name, 
        key:demonstration.key, 
        sourceURL:demonstration.sourceURL, 
        difficulty:demonstration.difficulty,
        docs:demonstration.docs
      });
  });

 
  // Controller Functions


  // Load A demo
  function loadDemonstration(key) {
    var demo = demos.get(key, function(demo) {
      $.get(demo.sourceURL, function(new_source) {
        if ( handheld == false ) {
          editor.setCode(new_source);
        } else {
          // this is what we do for handheld display
          $("#update-preview").hide();
          $("#source-code").hide();
          $("#source-code").val(new_source);
          $("#source").html("<pre id='the-source' class='brush: js'>");
          $("#the-source").text(new_source);
          SyntaxHighlighter.highlight( document.getElementById("the-source") );
          $('#button-pane').html('');
        }
      });
      $('#demonstration').html('<iframe id="preview-iframe" width="100%" height="600px" style="margin:0;padding:0;background:white" src="' + demo.sourceURL +'">');
    });
  };

  function showDemoSlug(key) {
    var converter = new Showdown.converter();
    demos.get(key, function(demo) {
      $('#demo-docs').html(converter.makeHtml('#' + demo.name + '\n\n' + demo.slug));
    });
  }

  // View Bindings

  // Populate the list for the Demo Index div
  $('#demo-list').html('<ul class="demos"></ul>');
  // Add the Demo to the list
  $.each( demonstrations, function(index, demo) {
    $('.demos').append('<li><a href="#/demos/'+demo.key+'" id="'+demo.key+'">'+demo.name+'</a></li>');
  });

  // replace our source code textarea with a codeMirror editor if we're on a desktop
  if (handheld == false) {
    editor = new CodeMirror.fromTextArea("source-code", {
      parserfile: ["parsexml.js", "parsecss.js", "tokenizejavascript.js", "parsejavascript.js", "parsehtmlmixed.js"],
      stylesheet: ["js/codemirror/css/xmlcolors.css", "js/codemirror/css/jscolors.css", "js/codemirror/css/csscolors.css"],
      path: "js/codemirror/js/"
    });
      $("#source").hide();
  }

  // Our Sinatra Routings tie to our Controllers and Helpers, declared above ^^ (maybe a nasty practice IRL)
  var app = $.sammy(function() {
                                                    //    this.element_selector = '#code';    
    // Load up a demo based on its key
    this.get('#/demos/:key', function(context) {
      loadDemonstration(this.params['key']);
      showDemoSlug(this.params['key']);
    });
  });

  // Start Sinatra Application Routing
  $(function() {
    
   
    app.run('#/demos/player-fallback');

    //bind the preview button to the updatePreview function
    $("#update-preview").bind('click', function() {
        if ( editor != undefined ) {
      source = editor.getCode();
      iframe = window.frames[1];
      iframe.document.open();
      iframe.document.write(source);
      iframe.document.close();
    } else {
      source = $('#source-code').val();
      iframe = window["preview-iframe"];
      iframe.document.open();
      iframe.document.write(source);
      iframe.document.close();
    }
    });

  });

});





















