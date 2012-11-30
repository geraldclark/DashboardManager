<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Master Subscription
 * Agreement ("License") which can be viewed at
 * http://www.sugarcrm.com/crm/master-subscription-agreement
 * By installing or using this file, You have unconditionally agreed to the
 * terms and conditions of the License, and You may not use this file except in
 * compliance with the License.  Under the terms of the license, You shall not,
 * among other things: 1) sublicense, resell, rent, lease, redistribute, assign
 * or otherwise transfer Your rights to the Software, and 2) use the Software
 * for timesharing or service bureau purposes such as hosting the Software for
 * commercial gain and/or for the benefit of a third party.  Use of the Software
 * may be subject to applicable fees and any use of the Software without first
 * paying applicable fees is strictly prohibited.  You do not have the right to
 * remove SugarCRM copyrights from the source code or user interface.
 *
 * All copies of the Covered Code must include on each user interface screen:
 *  (i) the "Powered by SugarCRM" logo and
 *  (ii) the SugarCRM copyright notice
 * in the same form as they appear in the distribution.  See full license for
 * requirements.
 *
 * Your Warranty, Limitations of liability and Indemnity are expressly stated
 * in the License.  Please refer to the License for the specific language
 * governing these rights and limitations under the License.  Portions created
 * by SugarCRM are Copyright (C) 2004-2012 SugarCRM, Inc.; All Rights Reserved.
 ********************************************************************************/

global $current_user;

$dashManagerObj = BeanFactory::newBean("dash_DashboardManager");
$vesionCheck = $dashManagerObj->checkVersion();

if ($vesionCheck)
{
    $type = $dashManagerObj->checkUser();

    if (isset($_REQUEST['module']) && $_REQUEST['module'] == 'Home' && $type === 2)
    {
        //check if we need to lock dashboard
        $dashManagerObj->checkLock();
        $page_js_array = $dashManagerObj->getRestrictedPageKeysForJS();

        $HTML=<<<HTML

                <script type="text/javascript">

                    function getRestrictedPages()
                    {
                        return {$page_js_array}
                    }

                    SUGAR.util.doWhen("document.getElementById('add_page') != null && typeof $ != 'undefined'", function(){

                        //handle user page actions
                        templatePages = getRestrictedPages();

                        for (var i = 0; i < templatePages.length; i++)
                        {
                            //handle tab delete
                            $("#pageNum_"+i+"_delete_page_img").attr("onclick", "");
                            $("#pageNum_"+i+"_delete_page_img").attr("class", "");

                            //rename tab
                            $("#pageNum_"+i+"_title_text").attr("ondblclick", "");
                        }

                    });

                </script>
HTML;

        echo $HTML;
    }
    elseif ($type === 3)
    {
        $user_id = $current_user->id;
        $dashlet_js_array = $dashManagerObj->getRestrictedDashletKeysForJS();
        $page_js_array = $dashManagerObj->getRestrictedPageKeysForJS();

        $HTML=<<<HTML

                <script type="text/javascript">

                    function getRestrictedPages()
                    {
                        return {$page_js_array}
                    }

                    function getRestrictedDashlets()
                    {
                        return {$dashlet_js_array}
                    }

                    function checkPage(id)
                    {
                        match = false;
                        templatePages = getRestrictedPages();

                        for (var i = 0; i < templatePages.length; i++)
                        {
                            if (templatePages[i] == id)
                            {
                                match = true;
                            }
                        }

                        return match;
                    }

                    function hideActions()
                    {
                        $('#change_layout').hide();
                        $('#add_dashlets').hide();
                    }

                    function showActions()
                    {
                        $('#change_layout').show();
                        $('#add_dashlets').show();
                    }

                    function removeDashDelete(id)
                    {
                        $("#pageNum_"+id+"_div .dashletToolSet").each(function(){
                            $(this).children("a:eq(2)").remove();
                        });
                    }

                    function checkPageToggle(id)
                    {
                        if (checkPage(id))
                        {
                            hideActions();
                        }
                        else
                        {
                            showActions();
                        }

                        SUGAR.mySugar.togglePages(id);

                        SUGAR.util.doWhen("SUGAR.mySugar.pageIsLoaded('pageNum_"+id+"_div') && document.getElementById('pageNum_"+id+"_div') != null", function(){
                            if (checkPage(id))
                            {
                                removeDashDelete(id);

                                $("#pageNum_"+id+"_div").hover(function(){
                                    removeDashDelete(id);
                                });

                            }
                        });
                    }

                    function checkDashletMove(id)
                    {
                        match = false;
                        templateDashlets = getRestrictedDashlets();

                        for (var i = 0; i < templateDashlets.length; i++)
                        {
                            if ("dashlet_"+templateDashlets[i] == id)
                            {
                                match = true;
                            }
                        }

                        return match;
                    }

                    function checkCurrentPage()
                    {
                        //handle initial page load
                        cp = Get_Cookie("{$user_id}_activePage");
                        if (cp)
                        {
                            checkPageToggle(cp);
                        }
                    }

                    function newTabAppend()
                    {
                        var tabcount = $('#tabList').children().length;

                        SUGAR.util.doWhen("document.getElementById('pageNum_"+tabcount+"_delete_page_img') != null", function(){
                            checkPageToggle(tabcount);
                        });
                    }

                    SUGAR.util.doWhen("typeof ygDDList != 'undefined'", function(){

                        //get stock functions
                        ygDDList.prototype.stockStartDrag = ygDDList.prototype.startDrag;
                        ygDDList.prototype.stockEndDrag = ygDDList.prototype.endDrag;
                        ygDDList.prototype.stockOnDragOver = ygDDList.prototype.onDragOver;

                        //recreate functions
                        ygDDList.prototype.startDrag = function(x, y)
                        {

                            if (checkDashletMove(this.id))
                            {
                                return;
                            }

                            this.stockStartDrag(x,y);
                        };

                        ygDDList.prototype.endDrag = function(e)
                        {
                            if (checkDashletMove(this.id))
                            {
                                return;
                            }

                            this.stockEndDrag(e);
                        }

                        ygDDList.prototype.onDragOver = function(e, id)
                        {
                            if (checkDashletMove(this.id))
                            {
                                return;
                            }

                            this.stockOnDragOver(e, id);
                        }

                    });

                    SUGAR.util.doWhen("document.getElementById('add_page') != null && typeof $ != 'undefined'", function(){

                        //handle user page actions
                        templatePages = getRestrictedPages();

                        for (var i = 0; i < templatePages.length; i++)
                        {
                            //handle tab delete
                            $("#pageNum_"+i+"_delete_page_img").attr("onclick", "");
                            $("#pageNum_"+i+"_delete_page_img").attr("class", "");

                            //rename tab
                            $("#pageNum_"+i+"_title_text").attr("ondblclick", "");
                        }

                        //handle page toggles
                        tabcount = $('#tabList').children().length;
                        for (i=0; i<tabcount; i++)
                        {
                            $("#pageNum_"+i+"_anchor").attr("href", "javascript:checkPageToggle('"+i+"');");
                        }

                        //get add page onclick event
                        AddPageOnclick = $('#add_page').attr("onclick");

                        //append new check
                        $('#add_page').attr("onclick", "newTabAppend();" + AddPageOnclick);

                    });

                    SUGAR.util.doWhen("SUGAR.mySugar != null && typeof $ != 'undefined'", function(){
                        checkCurrentPage();
                    });

                </script>
HTML;

        echo $HTML;
    }
}

if (!$vesionCheck)
{
    if($current_user->is_admin)
    {
        $adminVersionFail = translate("LBL_ADMIN_VERSION_FAIL");
        echo "<p><br><span class=\"error\">{$adminVersionFail}</span><br>";
    }
}

if($current_user->is_admin)
{
    $backupObj = BeanFactory::newBean("dash_DashboardBackups");
    $backup_id = $backupObj->checkUserForDashboardBackup();

    if ($backup_id !== false)
    {
        $confirmRestore = translate("LBL_CONFIRM_RESTORE");
        $restoreLink = translate("LBL_RESTORE_LINK_TEXT");
        echo '<div style="width:100%; text-align:right;"><br><a href="index.php?module=dash_DashboardBackups&action=RestoreUserDashboard&backup_id=' . $backup_id . '" style="font-size: 8pt" onclick="return confirm(\''.$confirmRestore.'\');">'.$restoreLink.'</a></div>';
    }
}

require("modules/Home/index.php");

?>