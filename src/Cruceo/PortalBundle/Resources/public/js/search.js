$(document).on('click', 'div#filter-category-ships ul li', {'type': 'category'}, sendAdvancedSearch);
$(document).on('click', 'div#filter-cabin ul li', {'type': 'cabin'}, sendAdvancedSearch);
$(document).on('click', 'div#filter-equipaments ul li', {'type': 'equipament'}, sendAdvancedSearch);
$(document).on('click', 'div#filter-shipping-companies ul li', {'type': 'shipping'}, sendAdvancedSearch);

function sendAdvancedSearch(e) {
    $('#f-'+e.data.type).val($(e.target).attr('attr-data'));
    $.post('/search/filters.json', $('#f-filters').serialize(), function(d) {
        $('#result-data').html(d);
    });
}