SUGAR.util.doWhen("document.getElementById('add_page') != null && typeof jQuery != 'undefined'", function(){

    jQuery.noConflict();

    var tabcount = jQuery('#tabList').children().length;

    //remove delete tab images from form
    for (i=0; i<tabcount; i++)
    {
        removeDeleteTabButton(i);
    }

    jQuery('#add_dashlets').remove();
    jQuery('#change_layout').remove();
    jQuery('#add_page').remove();

});

function removeDeleteTabButton(tab_id)
{
    jQuery("#pageNum_"+tab_id+"_delete_page_img").remove();
}
