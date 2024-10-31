jQuery(document).ready(function($) {
	function rvyvGetVideoID(videolink) {
		/*Check if input is videolink URL*/
		var DADcekUrl = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
		if(!DADcekUrl.test(videolink)){ /* Jika Bukan */
			return videolink;
		}else{ /* Jika Iya */
			var regex = new RegExp('([\\?&]v=([^&#]*)|[0-9]{8,20})');
		var results = regex.exec(videolink);
			return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
		}
	}
    tinymce.create('tinymce.plugins.rvyv_video_responsive', {
        init : function(ed, url) {
                // Register command for when button is clicked
                ed.addCommand('rvyv_video_responsive_insert_shortcode', function() {
                    var insert_rvyv_video_responsive = window.prompt('Insert Link Video');
                    if( insert_rvyv_video_responsive ){
                        //If text is selected when button is clicked
                        //Wrap shortcode around it.
					
					 content =  '[video-responsive v="'+rvyvGetVideoID(insert_rvyv_video_responsive)+'"]';
					
					}else{
                        content =  '[video-responsive v="INSERT-VIDEO-LINK-HERE"]';
                    }

                    tinymce.execCommand('mceInsertContent', false, content);
                });

            // Register buttons - trigger above command when clicked
			
            ed.addButton('rvyv_video_responsive', {
			
				'classes' : 'video-responsive-class', title : 'Add Video videolink Or Vimeo (Responsive!)', cmd : 'rvyv_video_responsive_insert_shortcode', image: url + '/../img/tinymce-button.png' });
        
			
		
		},   
		
		
		
    });

    // Register our TinyMCE plugin
    // first parameter is the button ID1
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('rvyv_video_responsive', tinymce.plugins.rvyv_video_responsive);
});