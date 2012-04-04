function addPhoto() {
    var collectionHolder = $('#cruceros_fotos');
    var prototype = collectionHolder.attr('data-prototype');
    form = prototype.replace(/\$\$name\$\$/g, collectionHolder.children().length);
    form = $(form).filter('div').first().html($(form).html() +'<a class="delete_link" href="#">remove</a>');
    collectionHolder.append(form);
}

$(document).on('click', 'a.delete_link',function(event) {
    $(event.currentTarget).parent().remove();
});

$(document).on('click', 'a.addphoto', function(event) {
    event.preventDefault();
    addPhoto();
});

$(document).on('click', 'input.jxaz', function() {
	console.log($(this).attr('id'));
	//return;
	JXaz.Upload.create('.jxaz', {
    	'url': '/app_dev.php/admin/cruceros/photo/save',
        'success': function(response) {
            var json = $.parseJSON(response);
            if (json.error == undefined) {
            	console.log('firehfier');
            } else {
            	console.log(json.error);
            }
        }
    });
});