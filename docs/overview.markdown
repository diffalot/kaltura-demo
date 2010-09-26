

## Library Overview

[html5]: https://developer.mozilla.org/En/Using_audio_and_video_in_FireFox
[KDP3]: http://www.kaltura.org/project/Video_Player_Playlist_Widget

__Kaltura's HTML5 Media Library__ enables you to take advantage of the [html5 `<video>` and `<audio>` tags][html5] today with a consistent player interface across all major browsers including Internet Explorer. 

The library supports a seamless fallback with Flash based playback using [Kaltura's Flash player][KDP3] or Java Cortado for browsers that don't yet feature HTML5 video & audio support.  Upon detection of the client browser, the __Kaltura HTML5 Media Library__ chooses the right codec to use (specified in the source attributes, or available from a Kaltura server) and the right player to display.  So whether you're using flash, h264, ogg-theora, or WebM -- Kaltura's library will make sure it is played on all browsers with the same UI.
While support for HTML5 video is growing, there is large percentage of the web browser market that is presently best served by the Adobe Flash plugin and an associated player. A base component of the Kaltura HTML5 javascript library bridges this gap, by cascading to an underlining Flash player in browsers that do not support the native HTML5 video player. In addition, Kaltura's player maintains a unified look & feel across formats and browsers.




