<?php
// include 'videos_list.php';
include 'videos_list_demo.php';
?>
<style type="text/css">
#nav li ul{
  z-index:100;
}
#content {
  width:970px;
  position:relative;
  overflow:hidden;
}
.box270 {
  width:480px;
  height:270px;
  float:left;
  border:1px solid #DB6E5C;
  color:#F8FCC1;
  background:url("http://openvideoalliance.org/i/side_bg.png") repeat scroll 0 0 transparent;
  position: relative;
  overflow:hidden;
}
.video-highlight img,
#video-player{
  position:absolute;
  opacity:0;
}
#video-player{
  z-index:2;
}
.infobox {
  border:1px solid #F8FCC1;
}
.infobox .video-description{
  position:absolute;
  overflow:auto;
  width:480px;
  height:220px;
  opacity:0;
}
.infobox .video-description p{
  margin:1em;
}
.infobox .toolbar{
  height:50px;
  position:absolute;
  top:207px;
  margin-top:1em;
  overflow:hidden;
  width:100%;
}
.infobox .toolbar a{
  text-decoration:none;
  color:#DB6E5C;
  width:238px;
}
.infobox .toolbar a {
  background-color:#F8FCC1;
  color:#DB6E5C;
  display:inline-block;
  font-size:24px;
  font-weight:bold;
  height:50px;
  line-height:50px;
  text-align:center;
  text-decoration:none;
  vertical-align:middle;
  width:238px;
}
.infobox .toolbar .left-button{
  margin-right:4px;
}
#thumbs-viewport{
  width:964px;
  height:273px;
  display:inline-block;
  overflow:hidden;
  position:relative;
}
#thumbs-container{
  position:relative;
  left:0px;
}
.thumbs-page{
  position:absolute;
  width:964px;
}
.thumbs-page.page-1{left:0px;}
.thumbs-page.page-2{left:964px;}
#thumbs-container.page-1{left:0px;}
#thumbs-container.page-2{left:-964px;}
.thumbnail {
  display:inline-block;
  border:1px solid #DB6E5C;
}
.thumbnail img{
  width:239px;
  height:134px;
  opacity:.9;
}
.thumbnail:hover{
}
.thumbnail img:hover{
  opacity:1;
  cursor:pointer;
}
div.thumbnail.selected{
  border:1px solid #F8FCC1;
}
#video-player,
.detail-image,
.video-description{
  -webkit-transition-property: opacity;
  -moz-transition-property: opacity;
  -o-transition-property: opacity;
  -webkit-transition-duration: 1s;
  -moz-transition-duration: 1s;
  -o-transition-duration: 1s;
}
#thumbs-container{
  -webkit-transition-property: left;
  -moz-transition-property: left;
  -o-transition-property: left;
  -webkit-transition-duration: 1.5s;
  -moz-transition-duration: 1.5s;
  -o-transition-duration: 1.5s;
}
.navbar a{
  text-decoration:none;
}
.navbar a:hover{
  color:#fff;
}
.navbar .right-arrow{
  float:right;
  margin-right:7px;
}
.navbar .disabled{
  display:none;
}
</style>
<script type="text/javascript">
  <?php foreach($videos as $video){?>
    <?php echo( $video['entry_id'] );?>',<?php }?>
  ]
video_h264_files = [
  <?php foreach($videos as $video){?>'<?php echo( $video['video_m4v_360'] );?>',<?php }?>
]
video_theora_files = [
  <?php foreach($videos as $video){?>'<?php echo( $video['video_ogv_360'] );?>',<?php }?>
]
</script>

<div class="video-highlight box270">
  <div id="video-player"></div>
<?php foreach($videos as $key=>$video){?>
  <img src="<?php echo( $video['poster_270'] );?>" id="detail-image-<?php echo( $key );?>" class="detail-image" <?php if($key==0){echo 'style="opacity:1;" ';}?>/>
  <?php 
}?>
<?php foreach($videos_2 as $key=>$video){?>
  <img src="<?php echo( $video['poster_270'] );?>" id="detail-image-<?php echo( (count($videos) + $key) );?>" class="detail-image"/>
  <?php 
}?>
<?php foreach($videos_3 as $key=>$video){?>
  <img src="<?php echo( $video['poster_270'] );?>" id="detail-image-<?php echo( (count($videos) + $key) );?>" class="detail-image"/>
  <?php 
}?>
</div><div class="infobox box270">
<?php 
foreach($videos as $key=>$video){
  ?><div class="video-description" id="detail-text-<?php echo( $key );?>"><p><?php echo( $video['description'] );?></p></div><?php 
}?>
<?php 
foreach($videos_2 as $key=>$video){
  ?><div class="video-description" id="detail-text-<?php echo( (count($videos) + $key) );?>"><p><?php echo( $video['description'] );?></p></div><?php 
}?>
<?php 
foreach($videos_3 as $key=>$video){
  ?><div class="video-description" id="detail-text-<?php echo( (count($videos) + $key) );?>"><p><?php echo( $video['description'] );?></p></div><?php 
}?>
<p class="toolbar"><a href="javascript:void(0);" id="play-button" class="left-button">PLAY</a><a id="download-button" href="#">DOWNLOAD</a></p>
</div>
<div id="thumbs-viewport">
<div id="thumbs-container">
<div class="thumbs-page page-1"><?php foreach($videos as $key=>$video){?><div class="thumbnail" id="thumbnail-<?php echo( $key );?>" onclick="return thumbnailClick(this);">
<img src="<?php echo( $video['poster_135'] );?>" /></div><?php }?></div>
<div class="thumbs-page page-2"><?php foreach($videos_2 as $key=>$video){?><div class="thumbnail" id="thumbnail-<?php echo( (count($videos) + $key) );?>" onclick="return thumbnailClick(this);">
<img src="<?php echo( $video['poster_135'] );?>" /></div><?php }?></div>
</div>
</div>
<div class="navbar">
<a class="disabled" id="nav-link-previous" href="javascript:void(0)" onclick="return previousPage();">⇦</a>
<a class="right-arrow" id="nav-link-next" href="javascript:void(0)" onclick="return nextPage();">⇨</a>
</div>
<script type="text/javascript" src="/video-content/video_library.js"></script>
