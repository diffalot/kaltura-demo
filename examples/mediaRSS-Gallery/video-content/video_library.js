selected_video = 0;
videoplayer = {};
play_button = {};
download_button = {};

function init(){
  videoplayer = document.getElementById('video-player');
  play_button = document.getElementById('play-button');;
  download_button = document.getElementById('download-button');
  thumbs_container = document.getElementById('thumbs-container');
  nav_link_prev = document.getElementById('nav-link-previous');
  thumbnailClick(document.getElementById('thumbnail-0'));
}
function thumbnailClick(element){
  id = parseInt(element.id.substring(element.id.indexOf('-')+1,element.id.length));
  videoplayer.innerHTML = '';
  last_thumbnail = document.getElementById('thumbnail-'+selected_video);
  last_detail_image = document.getElementById('detail-image-'+selected_video);
  last_detail_text = document.getElementById('detail-text-'+selected_video);
  current_thumbnail = document.getElementById('thumbnail-'+id);
  current_detail_image = document.getElementById('detail-image-'+id);
  current_detail_text = document.getElementById('detail-text-'+id);
  last_thumbnail.className = "thumbnail";
  last_detail_image.style.opacity = 0;
  last_detail_text.style.opacity = 0;
  current_thumbnail.className = "thumbnail selected";
  current_detail_image.style.opacity = 1;
  current_detail_text.style.opacity = 1;
  selected_video = id
  download_button.setAttribute('href', video_h264_files[id]);
  play_button.innerHTML = 'PLAY';
  play_button.removeEventListener('click',playVideo, false);
  play_button.removeEventListener('click', pauseVideo, false);
  play_button.addEventListener('click', playVideo, false);
  current_detail_text.style.zIndex = "10";
  last_detail_text.style.zIndex = "1";
  return false;
}
function thumbnailHover(element){
  id = element.id.substring(element.id.indexOf('-')+1,element.id.length)
}
function playVideo(){
  detail_image = document.getElementById('detail-image-'+selected_video);
  if (! videoplayer.hasChildNodes()){
    new_content = '<video width="480" height="270" controls>'
    if(video_theora_files[selected_video]){
      new_content += '<source src="'+video_theora_files[selected_video]+'" type="video/ogg"></source>'
    }
    if(video_h264_files[selected_video]){
      new_content += '<source src="'+video_h264_files[selected_video]+'" type="video/mp4"></source>'
    }
    new_content += '</video>'
    videoplayer.innerHTML = new_content;
    videoplayer.style.opacity = 1;
  }
  play_button.innerHTML = 'PAUSE';
  play_button.removeEventListener('click',playVideo, false);
  play_button.removeEventListener('click', pauseVideo, false);
  play_button.addEventListener('click', pauseVideo, false);
  videoplayer.firstChild.play();
}
function pauseVideo(){
  videoplayer.firstChild.pause();
  play_button.innerHTML = 'PLAY';
  play_button.removeEventListener('click',playVideo, false);
  play_button.removeEventListener('click', pauseVideo, false);
  play_button.addEventListener('click', playVideo, false);
}
function previousPage(){
  thumbs_container.style.left = '0px';
}
function nextPage(){
  thumbs_container.style.left = '-964px';
  nav_link_prev.style.display = "inline";
}
init()