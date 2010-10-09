var kUploadConfiguration,
    kUploadClient;		
kUploadConfiguration = new KalturaConfiguration(kPartnerId), // set in the php file
kUploadClient = new KalturaClient(kUploadConfiguration);
kUploadClient.setKs(ks); //set in the php file

$(function() {

				$("#upload_field").html5_upload({
          url: "upload2.php",
					sendBoundary: window.FormData || $.browser.mozilla,
					onStart: function(event, total) {
						//return confirm("You are trying to upload " + total + " files. Are you sure?");
						$("#progress_report_bar").progressbar({ value: 0 });
					},
					setName: function(text) {
							$("#progress_report_name").text(text);
					},
					setStatus: function(text) {
						$("#progress_report_status").text(text);
					},
					setProgress: function(val) {
						$("#progress_report_bar").progressbar({ value: Math.ceil(val*100) });
					},
					onFinishOne: function(event, response, name, number, total) {
						//alert(response);
					}
				});
			});

