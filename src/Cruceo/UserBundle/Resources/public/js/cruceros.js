function addPhoto() {
    var collectionHolder = $('#barcos_fotos');
    var prototype = collectionHolder.attr('data-prototype');
    form = prototype.replace(/\$\$name\$\$/g, collectionHolder.children().length);
    form = $(form).filter('div').first().html($(form).html());
    collectionHolder.append(form);
}

function showMsg(msg) {
	alert(msg);
}

function showDialog(msg, title, w, h) {
	$('body').append('<div id="showmessage"></div>');
	var $e = $('#showmessage');
	$e.html(msg);
	$e.dialog({
		autoOpen: false,
		title: title,
		modal: true,
		width: w,
		height: h,
		resizable: false,
		zindex: 10001,
		close: function() {
			$e.remove();
		}
	});
	$e.dialog('open');
}

$(document).ready(function() {
	if ($('#path_generate').length > 0) {
		var path = $('#path_generate').val();
		$('.viewImage').each(function() {
			$(this).append('<img src="'+path+'/'+$(this).attr('data-image')+'" />');
		});
	}
});

$(document).on('click', 'img.refreshImage', function() {
	var $tool = $(this);
	if (confirm('¿Quieres eliminar la imagen y cargar otra?')) {
		$.post('/admin/barcos/img/'+$tool.attr('data-remove')+'/remove', {}, function() {
			$rem = $($tool.parent()).parent();
			$bro = $rem.next();
			$bef = $rem.prev();
			$rem.hide('slow', function() { $(this).remove(); });
			$bef.val('');
			$bro.show();
		});
		
	}
});

$(document).on('click', 'img.delete_photo', function() {
	var $e = $(this);
	if (confirm('¿Quieres eliminar la foto?')) {
		$.post('/admin/barcos/photo/remove', {'photo': $e.attr('data-remove')}, function(json) {
			if (json.error != undefined) {
				showMsg(json.msg);
			} else {
				var par = $e.parent();
				var inp = par.prev();
				inp.val('');
				inp.show();
				par.remove();
			}
		}, 'json');
	}
});

$(document).on('click', 'button.add_photo', function() {
    addPhoto();
});

$(document).on('click', 'img.view_photo', function() {
	$e = $(this);
    $.post('/admin/barcos/photo/view', {'photo': $e.attr('data-view')}, function(json) {
    	if (json.error != undefined) {
			showMsg(json.msg);
		} else {
			showDialog('<img src="'+json.msg+'" />', 'Foto', json.width, json.height);
		}
    }, 'json');
});

$(document).on('click', 'input.jxaz', function() {
	JXaz.Upload.create('input.jxaz', {
    	'url': '/admin/barcos/photo/save',
        'success': function(response, element, file) {
            var json = $.parseJSON(response);
            if (json.error == undefined) {
            	element.next().remove();
            	element.hide();
            	element.val('');
            	var nm = element.attr('id').substring(0, (element.attr('id').length - 4));
            	console.log(nm);
            	var i = $('#'+nm+'ruta');
            	i.val(json.msg);
            	var url = '/bundles/cruceouser/css/images/';
            	var html = '<span class="actions">';
            	html += file.name+'<img src="'+url+'ok.png" class="check_file"/>';
            	html += '<img src="'+url+'view.png" class="view_photo" data-view="'+json.msg+'" />';
            	html += '<img src="'+url+'remove.png" class="delete_photo" data-remove="'+json.msg+'" />';
            	html += '</span>';
            	element.parent().append(html);
            } else {
            	showMsg(json.msg);
            }
        }
    });
});

/**/