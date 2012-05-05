var JXaz = window.JXaz || {};

JXaz.Upload = (function() {
	var _prefix = 'jxazup';
    var _mod = {
        'file_info':     'file_info',
        'file_name':     'file_name',
		'file_size':     'file_size',
		'file_type':     'file_type',
		'prg_indicator': 'progressbar',
    };

    var _settings = {
        'url':                    'upload.php',
        'clientAbort':            null,
        'clientError':            null,
        'clientLoad':             null,
        'clientLoadEnd':          null,
        'clientLoadStart':        null,
        'clientProgress':         null,
        'serverAbort':            null,
        'serverError':            null,
        'serverLoad':             null,
        'serverLoadStart':        null,
        'serverProgress':         null,
        'serverReadyStateChange': null,
        'success':                null,
        'name':                   'jxazupload'
    };

    function init(selector, options) {
        this.options = options || {};

        $(selector).each(function(i) {
            var $this = $(this);

            if ($this.is('[type="file"]')) {
                $this.bind('change', function() {
                    var files = this.files;
                    for (var x = 0, c = files.length; x < c; ++x) {
                        fileHandler(files[x], $this, i);
                    }
                });
            }
        });
    };

    function generateInfo(file, $element, i) {
        var fileSize = 0;
        if (file.size > 1024 * 1024) {
            fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
        } else {
            fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
        }
        $element.after('<div id="'+_prefix+'_'+_mod.file_info+i+'"/>');
        $('#'+_prefix+'_'+_mod.file_info+i).append('<div class="'+_prefix+'_'+_mod.file_name+i+'">Name: '+file.name+'</div>')
            .append('<div class="'+_prefix+'_'+_mod.file_size+i+'">Size: '+fileSize+'</div>')
            .append('<div class="'+_prefix+'_'+_mod.file_type+i+'">Type: '+file.type+'</div>');
    };

    function generateProgress(e, $element, i) {
        if (e.lengthComputable) {
        	if ($('#'+_prefix+'_style').length == 0) {
                insertStyle();
            }
            _bytesUploaded = e.loaded;
            _bytesTotal = e.total;
            var percent = Math.round(e.loaded * 100 / e.total);
            var tpl = $('#'+_prefix+'_'+_mod.prg_indicator+i);
            if (tpl.length == 0) {
            	$element.after('<div class="'+_prefix+'_container_progressbar">\
           			<div class="'+_prefix+'_progressbar" id="'+_prefix+'_'+_mod.prg_indicator+i+'"></div></div>');
            	tpl = $('#'+_prefix+'_'+_mod.prg_indicator+i);
            }
            tpl.css({width: percent.toString()+'%'}).html(percent.toString()+'%');
        }
    }
    
    function insertStyle() {
    	$('head').append('<style type="text/css" id="'+_prefix+'_style">\
   		    .'+_prefix+'_container_progressbar {\
    		    background-color: #446600;\
                border: 3px solid #84AD32;\
		        border-radius: 7px;\
		        -webkit-border-radius:7px;\
		        -moz-border-radius:7px;\
		        box-shadow: 0 1px 3px 0 #333333 inset;\
		        -webkit-box-shadow: 0 1px 3px 0 #333333 inset;\
		        -moz-box-shadow: 0 1px 3px 0 #333333 inset;\
		        width: 325px;\
           } \
           .'+_prefix+'_progressbar {\
        	    font-weight: bold;\
        	    font-size: 10px;\
        	    color: #000;\
        	    text-align: right;\
                border-radius: 5px;\
			    -webkit-border-radius: 5px;\
			    -moz-border-radius: 5px;\
			    box-shadow: 0 0 5px rgba(255, 255, 255, 0.5) inset;\
			    -webkit-box-shadow: 0 0 5px rgba(255, 255, 255, 0.5) inset;\
			    -moz-box-shadow: 0 0 5px rgba(255, 255, 255, 0.5) inset;\
			    height: 13px;\
			    position: relative;\
			    background: -webkit-linear-gradient(top, rgba(157,213,58,1) 0%,rgba(161,213,79,1) 50%,rgba(128,194,23,1) 51%,rgba(124,188,10,1) 100%);\
			    background: -moz-linear-gradient(top, rgba(157,213,58,1) 0%,rgba(161,213,79,1) 50%,rgba(128,194,23,1) 51%,rgba(124,188,10,1) 100%);\
			    background: -ms-linear-gradient(top, rgba(157,213,58,1) 0%,rgba(161,213,79,1) 50%,rgba(128,194,23,1) 51%,rgba(124,188,10,1) 100%);\
			    background: -o-linear-gradient(top, rgba(157,213,58,1) 0%,rgba(161,213,79,1) 50%,rgba(128,194,23,1) 51%,rgba(124,188,10,1) 100%);\
			    background: linear-gradient(top, rgba(157,213,58,1) 0%,rgba(161,213,79,1) 50%,rgba(128,194,23,1) 51%,rgba(124,188,10,1) 100%);\
			} \
		    .'+_prefix+'_progressbar:after {\
		        background: -webkit-repeating-linear-gradient(-45deg, transparent, transparent 8.5px, rgba(255,255,255,.2) 1px, rgba(255,255,255,.2) 17px);\
		        background: -moz-repeating-linear-gradient(-45deg, transparent, transparent 8.5px, rgba(255,255,255,.2) 1px, rgba(255,255,255,.2) 17px);\
		        background: -ms-repeating-linear-gradient(-45deg, transparent, transparent 8.5px, rgba(255,255,255,.2) 1px, rgba(255,255,255,.2) 17px);\
		        background: -o-repeating-linear-gradient(-45deg, transparent, transparent 8.5px, rgba(255,255,255,.2) 1px, rgba(255,255,255,.2) 17px);\
		        background: repeating-linear-gradient(-45deg, transparent, transparent 8.5px, rgba(255,255,255,.2) 1px, rgba(255,255,255,.2) 17px);\
		        content: "";\
		        height: 100%;\
		        left: 0;\
		        margin: 0;\
		        padding: 0;\
		        position: absolute;\
		        top: 0;\
		        width: 100%;\
	        }\
        </style>');
    }
    
    function humanBytes(bytesRaw) {
    	var bytes = 0;
    	
    	if (bytesRaw > 1024*1024) {
            bytes = (Math.round(bytesRaw * 100/(1024*1024))/100).toString() + 'MB';
        } else if (bytesRaw > 1024) {
            bytes = (Math.round(bytesRaw * 100/1024)/100).toString() + 'KB';
        } else {
            bytes = (Math.round(bytesRaw * 100)/100).toString() + 'Bytes';
        }
    	
    	return bytes;
    }

    function fileHandler(file, $element, i) {
        var settings = $.extend(_settings, JXaz.Upload.options);
        var fr = new FileReader();

        fr.onabort = function (e) {
            if (settings.clientAbort) {
                settings.clientAbort(e, file, $element);
            }
        };
        fr.onerror = function (e) {
            if (settings.clientError) {
                settings.clientError(e, file, $element);
            }
        };
        fr.onload = function (e) {
            if (settings.clientLoad) {
                settings.clientLoad(e, file, $element);
            }
        };
        fr.onloadend = function (e) {
            if (settings.clientLoadEnd) {
                settings.clientLoadEnd(e, file, $element);
            }
        };
        fr.onloadstart = function (e) {
            if (settings.clientLoadStart) {
                settings.clientLoadStart(e, file, $element);
            }
        };
        fr.onprogress = function (e) {
            if (settings.clientProgress) {
                settings.clientProgress(e, file, $element);
            }
        };
        
        fr.readAsDataURL(file);

        var xhr = new XMLHttpRequest();
        xhr.upload.onabort = function (e) {
            if (settings.serverAbort) {
                settings.serverAbort(e, file, $element);
            }
        };
        xhr.upload.onerror = function (e) {
            if (settings.serverError) {
                settings.serverError(e, file, $element);
            }
        };
        xhr.upload.onload = function (e) {
            if (settings.serverLoad) {
                settings.serverLoad(e, file, $element);
            }
        };
        xhr.upload.onloadstart = function (e) {
            if (settings.serverLoadStart) {
                settings.serverLoadStart(e, file, $element);
            }
        };
        xhr.upload.onprogress = function (e) {
            if (settings.serverProgress) {
                settings.serverProgress(e, file, $element);
            } else {
                generateProgress(e, $element, i);
            }
        };
        xhr.onreadystatechange = function (e) {
            if (settings.serverReadyStateChange) {
                settings.serverReadyStateChange(e, file, $element, xhr.readyState);
            }
            if (settings.success && xhr.readyState == 4 && xhr.status == 200) {
                settings.success(xhr.responseText, $element, file);
            }
        };
        
        var fd = new FormData();
        fd.append(settings.name, file);
        fd.append('name', settings.name);

        xhr.open("POST", settings.url, true);
        xhr.send(fd);
    };

    return {
        create: init
    };
})();