			var button_image_url= "images/upbtn.gif";
           if((allowType.toLowerCase()).indexOf("gif")>0){
        	   button_image_url= "images/upbtn.gif";
           }
           if((allowType.toLowerCase()).indexOf("doc")>0){
        	   button_image_url= "images/upbtn_file.gif";
           }
           if((allowType.toLowerCase()).indexOf("mp4")>0){
        	   button_image_url= "images/upbtn_video.gif";
           }
            var swfu;
			window.onload = function () {
				swfu = new SWFUpload({
					upload_url: "upload.php",
					post_params: {"uploadparam" : uploadparam},
					// File Upload Settings
					file_size_limit : "1640MB",	// 1000MB
					file_types :allowType,//设置可上传的类型
					file_types_description : "所有文件",
					file_upload_limit : "10",
					file_queue_error_handler : fileQueueError,//选择文件后出错
					file_dialog_complete_handler : fileDialogComplete,//选择好文件后提交
					file_queued_handler : fileQueued,
					upload_progress_handler : uploadProgress,
					upload_error_handler : uploadError,
					upload_success_handler : uploadSuccess,
					upload_complete_handler : uploadComplete,
	
					// Button Settings
					//button_image_url : "images/upbtn.gif",
					button_image_url : button_image_url,
					button_placeholder_id : "spanButtonPlaceholder",
					button_width: 85,
					button_height: 30,
					button_text : '<span class="button"></span>',
					button_text_style : '.button { font-family: Helvetica, Arial, sans-serif; font-size: 12pt; } .buttonSmall { font-size: 10pt; }',
					button_text_top_padding: 0,
					button_text_left_padding: 18,
					button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
					button_cursor: SWFUpload.CURSOR.HAND,
					
					// Flash Settings
					flash_url : "swf/swfupload.swf",
	
					custom_settings : {
						upload_target : "showDiv"
					},
					// Debug Settings
					debug:false //是否显示调试窗口
				});
			};
			function startUploadFile(){
				swfu.startUpload();
			}
