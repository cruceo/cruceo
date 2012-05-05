function addPrice() {
    var data = $('#cruceros_precios');
    var num = data.children().length;
    var form = data.attr('data-prototype').replace(/\$\$name\$\$/g, num);
    data.append(form);
    datePick();
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

function datePick() {
	$('.dp').datepicker({dateFormat: 'dd-mm-yy'});
}

$(document).on('click', 'button.add_price', function() {
    addPrice();
});

$(document).on('click', 'button.remove', function() {
	var $remove = $('#'+$(this).attr('data-remove'));
	$remove.hide('slow', function() { $(this).remove(); });
});

$(document).on('click', 'button#bDeleteEntity', function() {
	if (confirm('¿Quieres eliminar la entidad?')) {
		$('#deleteEntity').submit();
	} 
});

$(document).on('click', '#refreshImage', function() {
	var $tool = $(this);
	if (confirm('¿Quieres eliminar la imagen y cargar otra?')) {
		$.post('/app_dev.php/admin/cruceros/img/'+$tool.attr('data-remove')+'/remove', {}, function() {
			$rem = $('#editImgItenerarioView');
			$rem.hide('slow', function() { $(this).remove(); });
			$('#editImgItenerario').show();
		});
	}
});

$(document).ready(function() {
	datePick();
});

$(document).on('click', 'img.view_photo', function() {
	$e = $(this);
    $.post('/app_dev.php/admin/cruceros/photo/view', {'photo': $e.attr('data-view')}, function(json) {
    	if (json.error != undefined) {
			showMsg(json.msg);
		} else {
			showDialog('<img src="'+json.msg+'" />', 'Foto', json.width, json.height);
		}
    }, 'json');
});

$(document).on('click', 'img.delete_photo', function() {
	var $e = $(this);
	if (confirm('¿Quieres eliminar la foto?')) {
		$.post('/app_dev.php/admin/cruceros/photo/remove', {'photo': $e.attr('data-remove')}, function(json) {
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

$(document).on('click', 'input.jxaz', function() {
	JXaz.Upload.create('.jxaz', {
    	'url': '/app_dev.php/admin/cruceros/photo/save',
        'success': function(response, element, file) {
            var json = $.parseJSON(response);
            if (json.error == undefined) {
            	element.next().remove();
            	element.hide();
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