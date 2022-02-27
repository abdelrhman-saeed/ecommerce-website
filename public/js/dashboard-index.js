

var item_type = $('.item-type'),
    dashboard_list = $('.dashboard-list'),
    dashboard_list_lily = $('.dashboard-list .lily');

    
item_type.click(function () {
    dashboard_list.css('left', '0%');
});

dashboard_list_lily.click(function () {
    dashboard_list.css('left', '-105%');
});

$('.item-name i').click(function () {
    $(this).parent().next('.item-options').toggleClass('d-none');
});