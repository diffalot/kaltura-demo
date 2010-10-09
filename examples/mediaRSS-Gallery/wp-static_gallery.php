<?php

/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Kaltura Static Gallery
*/
?>
<?php get_header(); ?>


<!--[if IE]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://html5.kaltura.org/js"></script>  


<script type="text/javascript" src="http://www.openvideoconference.org/user_generated_gallery/libs/showdown.js"></script>


<script type="text/javascript">

var galleryClips = [
  {
    'entryId' : 'njbqgmfi1k',
    'title' : 'Xeni Jardin',
    'description' : 'She’s the co-editor of Boing Boing and host/executive producer of the daily internet video program Boing Boing tv—she’s Xeni Jardin! In addition to her work at Boing Boing, Xeni also contributes to WIRED, National Public Radio’s “Day to Day,” and hosts NPR’s “Xeni Tech” podcast. She has been published in online and print versions of publications including the Los Angeles Times, MSNBC, WIRED News, Playboy, Popular Science, Gotham, Nerve, Grammy Magazine, Make, and more. \n\nXeni is a very unique mix of journalist, unpop-cultural commentator, geek, and video producer. Xeni will relate her recent experiences in Guatemala, where serious political and social unrest has been spreading through social networks and other citizen driven media.'
  },
  {
    'entryId' : 'pqxobj4rqi',
    'title' : 'The Pirate’s Dilemma: Matt Mason',
    'description' : 'Online video can be a powerful tool for satire and commentary, enabling independent voices to challenge the way the news is presented. Piracy can be a business model, argues bestselling author Matt Mason. Rather than battling pirates, producers should learn from them. Instead of chasing lost revenues through expensive and contentious litigation, or locking down content with intrusive access controls, producers should leverage this new cultural phenomenon. \n\nAs a consultant, Mason helps firms understand how pirates light the way: they create markets, signal trends, and develop innovative ways to reach these markets.'
  },
  {
    'entryId' : 'rarclw7j1c',
    'title' : 'Open Video in the Developing World',
    'description' : 'Ronaldo Lemos, a professor and renowned free culture leader in Brazil will explain how people in developing countries have innovated and created their own models for video and cultural production.'
  },
  {
    'entryId' : 'e4nddkfu4g',
    'title' : 'Open Video Collaboration in Wikipedia',
  'description' : 'Since January 2008, the Wikimedia Foundation has worked together with Kaltura to bring the ability to collaboratively edit video sequences to Wikipedia, based on open standards. We will show how these technological approaches enable us to go beyond what is possible in contemporary proprietary web video frameworks. Building on the technological foundations laid by the Annodex and Xiph Foundation as well as open web standards implemented through browsers like Mozilla Firefox, we can treat video on the web in much the same way we treat and transform text. We will present the current state of  these technological developments and contextualize them in Wikimedia’s long term approach to open collaboration around rich media.'
  },
  {
   'entryId' : 'nmmy3xrvko',
    'title' : 'Jonathan Zittrain',
    'description' : 'Jonathan Zittrain is co-director and co-founder of Harvard’s Berkman Center for Internet and Society and a professor at Harvard Law School. Among his areas of expertise are cyberlaw, security, and copyright law. His book The Future of the Internet—And How To Stop It is about generative technology like the internet and how it promotes innovation and disruption. As controlled devices like iPods and Tivos grow in popularity, we face worrisome consequences for the net’s future potential for user participation.'
  },
  {
    'entryId' : '99ezprs0ek',
    'title' : 'Mozilla: The Future of Open Video',
    'description' : "Mozilla, a strong supporter of the open web, will present its vision for the future of online video. This presentation will include a live demonstration of new open video technologies in Firefox 3.5 that will empower people to communicate and innovate in new ways. Additionally, a representative from Dailymotion will give a brief overview of its initiative to offer over 300,000 videos in open formats.\n  speaker: Chris Blizzard: Director of Evangelism, Mozilla Corporation\n\n  speaker: Mark Surman: Executive Director, Mozilla Foundation"
  },
  {
    'entryId' : 'qajvsgvwhw',
    'title' : 'Lightning Talks',
    'description' : 'Earth-Touch\n\nEarth-Touch is a new type of wildlife filmmaking company. Earth-Touch’s mission is to celebrate the beauty of nature and to reflect what happens in the natural world truthfully and instantaneously to a global audience. Earth-Touch is different to other mainstream wildlife production companies because it is making high quality wildlife media free, accessible and available to the online video watching community.\n\n  Critical Commons\n\n  Critical Commons is a non-profit advocacy coalition that supports fair use of media for learning and creativity, providing resources, information and tools for scholars, students and creators. Our aim is to build open, informed communities around media-based teaching, learning and creativity, both inside and outside of formal educational environments.This presentation highlights some key features of Critical Commons including the ability to upload and share media, tagging, annotating and commenting on video clips, and the creation of playlists to share with students, members of your community and the public at large.\n\n  presented by Steve Anderson — Assistant Professor, USC School of Cinematic Arts\n\n  Blender\n\n  A brief showcase and demo of Blender, a powerful free and open source 3d model- ing, rendering, and video composting software.presented by Bassam Kurdali — Director and Animator, Elephant’s Dream (2006)\n\n  Reframe (Tribeca Film Institute)\n\n  Brian Newman is the president & CEO of theTribeca Film Institute (TFI) where he leads the Institute’s innovative programs in support of filmmakers, youth and the public. Brian conceived and launched the Reframe project of TFI, a unique initiative that is digitizing and make available thousands of films for DVD, streaming and video on demand.\n\n  Uncensored Interview\n\n  Uncensored	Interview	creates	high quality	open	licensed	interviews	with	musicians, connecting fans and artists.They are pioneers in the industry,and have recently been transcoding their videos into the Ogg Theora format.'
  },
  {
    'entryId' : 'fwr4lj0f00',
    'title' : 'Lizz Winstead',
    'description' : 'Online video can be a powerful tool for satire and commentary, enabling independent voices to challenge the way the news is presented. Lizz Winstead, co-creator of The Daily Show and co-founder of Air America Radio, will share her vision for a world where connected citizens keep an eye on those who are supposed to be keeping an eye on elected officials. Winstead is currently involved with Shoot The Messenger Productions, an independent comedy group that performs a weekly satirical news summary in the form of the Off-Broadway show, Wake Up World.'
  },
  {
    'entryId' : '1i83pqvkv4',
    'title' : 'Yochai Benkler',
    'description' : 'Yochai Benkler is the Berkman Professor of Entrepreneurial Legal Studies at Harvard, and faculty co-director of the Berkman Center for Internet and Society. He writes about the Internet and the emergence of networked economy and society, as well as the organization of infrastructure, such as wireless communications. His work traverses a wide range of disciplines and sectors, and is taught in a variety of professional schools and academic departments. \n\nIn real world applications, his work has been widely discussed in both the business sector and civil society. His most recent book, The Wealth of Networks: How social production transforms markets and freedom (2006), is considered a seminal piece on peer production and the power of networked societies. His work can be freely accessed at www.benkler.org.'
  },
  {
    'entryId' : 'claynabeeg',
    'title' : 'Fair use battles',
    'description' : 'Falzone will discuss his experience defending Shephard Fairey in the much-discussed Obama Photo case, and McSherry will talk about her ground-breaking work in Lenz v. Universal, a case fighting for the acknowledgment of fair use in issuing DMCA video takedowns.\n  speaker:Anthony Falzone — Executive Director of the Fair Use Project at Stanford Law School speaker: Corynne McSherry — Staff Lawyer, Electronic Frontier Foundation'
  },
  {
    'entryId' : 'h1vxg1uepw',
    'title' : 'Industry Perspectives On Open Video',
    'description' : 'As internet video matures, industry players will play an integral part in shaping the online video ecosystem. A combination of open and proprietary technologies has fueled the development of digital video, making it a staple on the web. How will this relationship unfold in the future? What technologies will power internet video long-term? What forms will video delivery take, and what innovations will propel the medium forward? Harvard’s Jonathan Zittrain moderates a discussion with industry experts on the future of online video, the role of innovation, and its relationship to open source and open standards. \n\n  moderator: Jonathan Zittrain, Professor, Harvard Law School and co-Founder, Berkman Center for Internet & Society \n\n  panelist: Nikhil Chandhok, Senior Product Manager, YouTube \n\n  panelist: Mike Hudack, CEO, blip.tv \n\n  panelist: Avner Ronen, CEO, Boxee \n\n  panelist: Jennifer Taylor, Flash Product Manager, Adobe'
  },
  {
    'entryId' : 'mtpcu7u24c',
    'title' : 'The People vs. Comcast & AT&T',
    'description' : 'The future of the Internet – and online video – will be decided by lawmakers in 2009 and 2010: will the Internet be neutral, open, competitive and fast enough for ubiquitous high-def video? Will the US continue to fall behind the rest of the world in broadband speed and affordability? Will the 40% of Americans without broadband bridge the digital divide?  Will there be a place for critical journalism and independent video in a digital America? \n\n  speaker: Josh Silver — Executive Director, Free Press'
  },
  {
    'entryId' : 'a4565p4lo8',
    'title' : 'VLC 1.0 Announcement',
    'description' : 'Jean Baptiste-Kempf of VLC media player makes a special announcement.'
  },
  {
    'entryId' : 'o45u7ws9tk',
    'title' : 'Amy Goodman',
    'description' : 'Amy Goodman, host and executive producer of the news program Democracy Now!, often asks questions nobody else will ask, bringing her viewers and listeners the sort of information you can only get from independent media. Goodman believes that journalists should serve as a check to the powers that be. Democracy Now! is currently aired on over 700 radio and television stations. The program has proven the power of grassroots analog media, and has also been a pioneer in online publishing. \n\nThe show streamed live audio over the internet as far back as 1997 and they currently offer the program in full-resolution over bittorrent. While the technology has never been the focus, Goodman is a strong advocate for more open and decentralized forms of publishing; she spoke on related issues at the National Conference for Media Reform in 2008. \n  Goodman will relate her experience as an independent journalist, and how a more open future can bolster the efforts of people working in similar grassroots capacities all over the world.'
  },
  {
    'entryId' : 'nsvhss7ody',
    'title' : 'The Eclectic Method',
    'description' : 'A demonstration of the art and science of audiovisual remix. Eclectic Method’s audio-visual mash-ups feature television, film, music and video game footage sliced and diced into blistering, post-modern dance floor events. It’s a cyclone of music and images mashed together in a world where Kill Bill fight scenes and Dave Chappelle’s Rick James rants are ingeniously cut and looped over bootleg samples, DVD scratches and pumped-up dance anthems. It’s a real-time subversion of technology and media performed live on video turntables for what LA Weekly called a “mesmerizing” sensory overload. \n\n  speaker: Ian Edgar — VJ/DJ, Eclectic Method \n\n  speaker: Jonny Wilson — VJ/DJ, Eclectic Method'
  },
  {
    'entryId' : 'zlfjko6kfg',
    'title' : 'How to Make A Political Remix Video',
    'description' : 'Jonathan McIntosh is a pop-culture hacker, video remix artist, citizen photo journalist, new media teacher and activist. He has presented political remix video work at Ars Electronica, the 24/7 DIY Video Summit, the IP/Gender Conference, and the Mashup/Remix Conference. His social justice photography has been featured in magazines, newspapers and documentary films around the world, all licensed through Creative Commons. He is also the co-editor of the Political Remix Video blog. All of Jonathan’s creative work can be found on his site at rebelliouspixels.com\n\n  speaker : Jonathan McIntosh — Video Remixer & Activist, rebelliouspixels.com'
  },
  {
    'entryId' : 'wr0wo48424',
    'title' : 'DVD Jon: Featured Talk',
    'description' : 'Jon Lech Johansen, also known as DVD Jon, is famous for his work on reverse engineering data formats. He is most famous for his involvement in the release of the DeCSS software, which decodes the content-scrambling system used for DVD licensing enforcement. Jon later became “iTunes Jon,” breaking Apple’s FairPlay DRM for iTunes. More recently, he has been working on doubleTwist, a program for managing all media types across devices. Jon will tell the story of DeCSS, his rise to folk-hero status in the software development world, and about his current work in the consumer software sector.\n  speaker: Jon Lech Johansen, aka DVD Jon — Founder, doubleTwist'
  },
  {
    'entryId' : 'p2uhf304co',
    'title' : 'The Politics and Poetics of DeCSS',
    'description' : 'In this talk, NYU Steinhardt professor Gabriella Coleman visits the protests surrounding the DeCSS arrest and lawsuits that unfolded between 1999 and 2003 in order to examine when and how a new vibrant free speech sensibility was cemented and refined among Free and Open Source developers. Contained within this story are important lessons about the role of conventional protests and unconventional protests (in this case, in the form of poetry and art) for establishing this free speech ethic. \n  speaker: Gabriella Coleman — Assistant Professor, NYU Steinhardt School of Culture, Education, and Human Development'
  },
  {
    'entryId' : '3surs1euum',
    'title' : 'Steal These Films',
    'description' : 'These panelists are together on one stage for the first time; each directed a feature length film addressing copyright in the digital age. While these films do share a common theme, their approaches to the issue are all radically different. Each was produced in a different country and, not surprisingly, was funded and released in a unique way. Join them as they discuss copyright in the digital age, the craft of filmmaking, and Open Video. \n\n  speaker: Jamie King — Director, Steal this Film I & II \n\n  speaker: Henrik Moltke — Director, Good Copy Bad Copy \n\n  speaker: Brett Gaylor — Director, RIP: A Remix Manifesto'
  },
  {
    'entryId' : 'oji830zvvm',
    'title' : 'Closing Remarks: Nicholas Reville',
    'description' : 'Closing remarks by Nicholas Reville (Participatory Culture Foundation).'
  },
  {
    'entryId' : '99ezprs0ek',
    'title' : 'Opening Remarks Day Two',
    'description' : 'Welcome by Ben Moskowitz (Conference Director). Opening Remarks by Shay David (Yale ISP/Kaltura) and Leah Belsky (Yale ISP/Kaltura).'
  },
  {
    'entryId' : '2ldb0z7v70',
    'title' : 'A TEDtalk about TED',
    'description' : 'Jason Wishnow is a New York-based film director. He is also the Director of Film and Video for TED and co-creator of TEDTalks, the web video series that has been viewed more than 100 million times. \n\n  speaker: Jason Wishnow — Director of Film and Video, TED'
  },
  {
    'entryId' : 'kzggj7dmb4',
    'title' : 'Public Media, Open Content, and Sustainability',
    'description' : 'How is public media being supported today by foundations, government agencies, and the public?  What could be produced or funded differently?  What strategic interventions—from producers, funders, technologists, the public—could help public broadcasting now reach more of its potential?  In this panel a group of funders and practitioners look to jump-start the conversation and explore the future of public media. \n\n  moderator: Peter Kaufman — President and CEO, Intelligent Television \n  panelist: Jack Brighton — Director of Internet Development, WILL Public Media \n\n  panelist: Alyce Myatt — Executive Director, Grantmakers in Film and Electronic Media \n\n  panelist: Joel Pomerleau — Head of Interactive Services, National Film Board of Canada \n\n  panelist: Eirik Solheim — Project Manager and Strategic Advisor, NRK (Norway’s Public Broadcaster) \n\n  panelist: Vince Stehle — Program Officer, Surdna Foundation'
  },
  {
    'entryId' : 'kzggj7dmb4',
    'title' : 'Perspectives from Traditional Media',
    'description' : 'While online video presents new opportunities for new media creators, it has shaken many of the foundations of traditional mass-media. This panel opens a dialogue with traditional media players, asking how the quickly evolving open landscape can be engaged with productively, and exploring the economic and social imperatives that drive decisions. \n\n  moderator: Anita Ondine — CEO, Seize the Media \n\n  panelist: Peter Flood — VP, Business Development at GCluster America, Inc. \n\n  panelist: Tracey Barrett Lee — Vice President, Bridge Media Systems \n\n  panelist: Glenn Moss — Adjunct Instructor, School of Management at Binghamton University \n\n  panelist: Tania Yuki — Senior Product Manager (Video Metrix), comScore Networks'
  },
  {
    'entryId' : 'j8uchffmr4',
    'title' : 'Emerging Video Art',
    'description' : 'Two leading figures from the art and technology world will discuss the role that open video has to play in artistic creation, and specific projects that embody this. Tribe, a preeminent video artist, will discuss his Port Huron project, and Cornell, Executive Director of Rhizome, will focus on how remix culture and free expression are synonymous with artistic video creation.\n\n  speaker: Lauren Cornell — Executive Director, Rhizome and Adjunct Curator, The New Museum \n\n  speaker: Mark Tribe — Artist and Professor, Brown University'
  },
  {
    'entryId' : '2mf8xqegqz',
    'title' : 'Purefold an Open Media Franchise by Ridley Scott: Featured Talk',
    'description' : 'Ridley Scott is involved a new production called Purefold, which will be done in five separate 10-minute installments. The story is set shortly before 2019 (right ahead of the Blade Runner story). “It’s actually based on the same themes as Blade Runner,” series co-producer David Bausola told The New York Times. \n\n"It’s the search for what it means to be human and understanding the notion of empathy.” The series will be licensed with Creative Commons. \n\n  speaker: David Bausola — Co-Producer, Purefold'
/*  },
  {
    'entryId' : '',
    'title' : 'The Evolution of Storytelling',
    'description' : 'Ted Hope producer of (21 Grams, The Ice Storm, Adventureland) and writer/director Lance Weiler (The Last Broadcast, Head Trauma) discuss how technology is impacting the art and craft of storytelling. As the industry shifts and audiences move from passive to active collaborators how does the art of storytelling change. What will emerge as new formats and how will they be funded and distributed? 
  speaker: Ted Hope — Film Producer (of nearly sixty features including 21 Grams and Adventureland) 
  speaker: Lance Weiler — Filmmaker and Co-founder, WorkBook Project' */
  }
];

var kWidgetId = "_22646",
    kPartnerId = 22646,
    thumbHeight = 135,
    thumbWidth = 240,
    posterHeight = 270,
    posterWidth = 480,
    previousDescription = undefined,
    thumbnailTop = undefined,
    page = 1;

function loadVideo(videoId){
  var converter = new Showdown.converter();
  var description = '## ' + galleryClips[videoId].title + '\n\n' + galleryClips[videoId].description;
  var text = converter.makeHtml(description);
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


function previewVideo(videoId){
  var converter = new Showdown.converter();
  var description = '## ' + galleryClips[videoId].title + '\n\n' + galleryClips[videoId].description;
  var text = converter.makeHtml(description);
  $('#video-description').html(text);
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
var step = 272;
function scrollUp () {
  if (thumbnailTop== undefined) {
    thumbnailTop = step;
  } else {
    thumbnailTop = thumbnailTop+step;
  }
  $('#thumbs-container').animate({
    top: (thumbnailTop)+"px",
  }, 750);
  page = page - 1;
  checkArrows(page);
}

function scrollDown () {
  if (thumbnailTop== undefined) {
    thumbnailTop = 0 - step;
  } else {
    thumbnailTop = thumbnailTop-step;
  }
  $('#thumbs-container').animate({
    top: (thumbnailTop)+"px",
  }, 750);
  page = page + 1;
  checkArrows(page);
}

$(function(){
    mw.setConfig('EmbedPlayer.KalturaAttribution', false );
    mw.setConfig('EmbedPlayer.PlayerSelector', false );
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
});

</script>

    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="http://www.openvideoconference.org/wp-content/themes/ovcclassic/style.css" type="text/css" media="screen" /> 
    <link rel="stylesheet" href="http://www.openvideoconference.org/user_generated_gallery/style.css" type="text/css" media="screen" /> 
    <link rel="stylesheet" href="http://www.openvideoconference.org/user_generated_gallery/spinner.css" type="text/css" media="screen" /> 
<div style="clear:both">
  <ul id="galleryTabs">
    <li><a class="activeGalleryTab">Highlights from 2009</a></li>
    <li><a href="http://www.openvideoconference.org/video_uploads/">Community Video Gallery</a></li>
  </ul>
</div><br/><br/>
<div id="gallery" style="position:relative;margin-left:auto;margin-right:auto">
    <div class="video-highlight box270">
        <div id="video-player"></div>
    </div>
    <div class="infobox box270">
        <div id="video-description"></div>
    </div>
    <div id="thumbs-viewport">
        <div id="thumbs-container"></div>
    </div>

    <div class="navbar">
        <span class="left-arrow" id="nav-link-previous">&uArr;</span>
        <span class="right-arrow" id="nav-link-next">&dArr;</span>
    </div>
</div>

    <div id="mediaRSS" style="display:none">
    </div>
    
    <div id="upload-dialog">
    </div>

<?php get_footer(); ?>
