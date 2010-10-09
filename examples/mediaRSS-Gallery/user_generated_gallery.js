if(!window.console) {
    window.console = new function() {
      this.log = function(str) {};
      this.dir = function(str) {};
      };
    }

var kWidgetId = "_22646",
    kPartnerId = 22646,
    thumbHeight = 135,
    thumbWidth = 240,
    posterHeight = 270,
    posterWidth = 480,
    previousDescription = undefined,
    thumbnailTop = undefined,
    page = 1,
    mediaRSS,
    descriptionsDB,
    descriptionsArray,
    galleryClips = new Array();


var jsonMediaRSS;



function loadMediaRSS() {
  $.getJSON('http://www.openvideoconference.org/user_generated_gallery/playlist.json', function(json){ jsonMediaRSS=json; });
  /*  $.ajax({
            type: "GET",
            url: "http://www.openvideoconference.org/user_generated_gallery/jsonMediaRSSproxy.php",
            async:false,
        //    dataType: "xml",
            success: function(json) {
            jsonResult = json;
            console.log(json.item);
            //debugger;
              $(xml).find("item").each(function() {
                console.log( "parsing item" );
                var thisitem = $(this);
                console.log( thisitem.find("title") );
                var thistitle = thisitem.find("title").text();
                var thisentryId = thisitem.find("entryId").text();
                console.log( "saving: " + thistitle + " " + thisentryId );
                galleryClips.push({ 'entryId' : thisentryId,  'title' : thistitle });
                });
            // tried jParse, seems to only be designed to output variables lib remains installed, but is unused
            console.log( $(xml).jParse({item: { title: title, entryId: kEntryId}}) );
              }
            });
                */
}

function loadDatabase() {
// load up our database of descriptions
descriptionsDB = new Lawnchair({adaptor: "dom"});
$(descriptionsArray).each(function(i,desc){
    console.log (descriptionsArray[i].kEntryId + ": " + descriptionsArray[i].description);
    descriptionsDB.save({key: descriptionsArray[i].kEntryId, "kEntryId": descriptionsArray[i].kEntryId, "description": descriptionsArray[i].description, "name": descriptionsArray[i].name});
//    descriptions.save({key: descriptionsArray[i].kEntryId, description: descriptionsArray[i].description});
    });
}

function loadGallery() {
  $(jsonMediaRSS.rss.channel.item).each(function(index, value){ 
      var thisentryId = jsonMediaRSS.rss.channel.item[index].guid.split('|')[1];
      galleryClips.push({ 'entryId' : thisentryId });
      });


    $.each( galleryClips, function( index, video ) {
        
        // Get the url of the thumbnail from Kaltura
        // Set the poster
        thumbnailImage = 'http://cdnakmi.kaltura.com/p/' + kPartnerId + '/sp/' +
            kPartnerId + '00/thumbnail/entry_id/' + video.entryId + '/width/' +
            thumbWidth + '/height/' + thumbHeight;

        // This is the div we want to add in for each Thumbnail
        divText = "<div class='thumbnail' id='" + index + "'>" +
                  "  <img src='" + thumbnailImage + "'>" +
                  "</div>";

        // Add in the div
        $('#thumbs-container').append(divText);
    });
     
    // Load up the first video
    loadVideo(0);

    checkArrows(page);

    //Make thumbnail divs hoverable
    $('.thumbnail').mouseenter( function(){
        previewVideo(this.id);
    }); 
    $('.thumbnail').mouseleave( function(){
       $('#video-description').html(previousDescription);
    });

    // Make thumbnail divs clickable
    $('.thumbnail').click( function(){
        loadVideo(this.id);
    });

    // Bind the Scroll Buttons
    $('.left-arrow').click( function() {
        scrollUp();
    });
    $('.right-arrow').click( function() {
        scrollDown();
    });
}

function loadVideo(videoId){
  var converter = new Showdown.converter();
  //var description = '## ' + galleryClips[videoId].title + '\n\n' + galleryClips[videoId].description;
  //var text = converter.makeHtml(description);
  var title; //= galleryClips[videoId].title;
  descriptionsDB.get(galleryClips[videoId].entryId, function(r){ title = r.name; });
  var description;
  descriptionsDB.get(galleryClips[videoId].entryId, function(r){ description = r.description; });
console.log( title +"+"+ description );
  var descriptionText = '## ' + title + '\n\n' + description;
  var text = converter.makeHtml(descriptionText);
  $('#video-description').html(text);

  $('#video-description').html(text);
  previousDescription = text;
  mw.ready( function(){
      $j( '#video-player' ).loadingSpinner();
      mw.load( 'EmbedPlayer', function(){
        $j( '#video-player' ).html(
          $j('<video />')
            .css({
              'width' : 480,
              'height' : 270
            })
            .attr({
              'kentryid' : galleryClips[videoId].entryId,
              'kwidgetid' : kWidgetId,
              'kpartnerid' : kPartnerId
            })
        );      
        // Rewrite all the players on the page
        $j.embedPlayers();
      });
  });
}

function findDescription(kEntryId) {
  descriptionsDB.get(kEntryId, function(r){return r.description;});
  }

function checkArrows(page) {
  if (page == 1) {
    $('.left-arrow').hide();
  }
  if (page == 2) {
    $('.left-arrow').show();
  }
  if (page == 3) {
    $('.right-arrow').show();
  }
  if (page == 4) {
    $('.right-arrow').hide();
  }
}

function scrollUp () {
  if (thumbnailTop== undefined) {
    thumbnailTop = 283;
  } else {
    thumbnailTop = thumbnailTop+283;
  }
  $('#thumbs-container').animate({
    top: (thumbnailTop)+"px",
  }, 750);
  page = page - 1;
  checkArrows(page);
}

function scrollDown () {
  if (thumbnailTop== undefined) {
    thumbnailTop = -283;
  } else {
    thumbnailTop = thumbnailTop-283;
  }
  $('#thumbs-container').animate({
    top: (thumbnailTop)+"px",
  }, 750);
  page = page + 1;
  checkArrows(page);
}

function showUpload() {
  $('#ksu').dialog('open');
}

function previewVideo(videoId){
  var converter = new Showdown.converter();
  var title; //= galleryClips[videoId].title;
  descriptionsDB.get(galleryClips[videoId].entryId, function(r){ title = r.name; });
  
  var description;
  descriptionsDB.get(galleryClips[videoId].entryId, function(r){ description = r.description; });

  //var description = descriptionsDB.get(galleryClips[videoId].kEntryId, function(r){return r.description;});
console.log( title +"+"+ description );
  var descriptionText = '## ' + title + '\n\n' + description;
  var text = converter.makeHtml(descriptionText);
  $('#video-description').html(text);
}

$(function(){
    mw.setConfig('EmbedPlayer.KalturaAttribution', false );
    mw.setConfig('EmbedPlayer.PlayerSelector', false );
//load descriptions
$.getJSON('http://www.openvideoconference.org/user_generated_gallery/db.php', function(json){ descriptionsArray=json; });
$('#ksu').dialog({
              title: "Upload a Video", 
              autoOpen: false,
              width: 650,
              height: 450,});


//    onLoadHandler();


    //setTimeout("loadMediaRSS()", 10);
    setTimeout("loadMediaRSS()", 10);
    
    setTimeout("loadDatabase()", 3000);

    setTimeout("loadGallery()",8000);
});


