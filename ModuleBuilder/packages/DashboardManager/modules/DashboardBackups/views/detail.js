SUGAR.util.doWhen("document.getElementById('add_page') != null && typeof $ != 'undefined'", function(){

    var tabcount = $('#tabList').children().length;

    //remove delete tab images from form
    for (i=0; i<tabcount; i++)
    {
        removeDeleteTabButton(i);
    }

    $('#add_dashlets').remove();
    $('#change_layout').remove();
    $('#add_page').remove();

});

function removeDeleteTabButton(tab_id)
{
    $("#pageNum_"+tab_id+"_delete_page_img").remove();
}
