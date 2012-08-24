<?php
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

require_once('include/MVC/View/views/view.html.php');

class CustomViewMakeDefaultBackup extends ViewHtml
{
 	function CustomViewMakeDefaultBackup()
    {
 		parent::ViewHtml();
 	}
 	
 	function display()
    {
        global $current_user;

        if(!$current_user->is_admin)
        {
            sugar_die(translate("LBL_MUST_BE_ADMIN"));
        }

        $url = array("index.php?");

        if (isset($_REQUEST['module']))
        {
            array_push($url, "module=".$_REQUEST['module']);
        }

        if (isset($_REQUEST['action']))
        {
            array_push($url, "action=".$_REQUEST['action']);
        }

        if (isset($_REQUEST['record']))
        {
            array_push($url, "record=".$_REQUEST['record']);
        }

        array_push($url, "runbackup=1");

        $url_string = implode("&", $url);

        $backupWarning = translate("LBL_BACKUP_WARNING");
        $warningMessageOne = translate("LBL_WARNING_MESSAGE_ONE");
        $warningMessageTwo = translate("LBL_WARNING_MESSAGE_TWO");
        $continueLink = translate("LBL_WARNING_LINK");

        $HTML=<<<HTML

        <div id="content">
                <table id="contentTable" style="width:100%"><tbody><tr><td><div class="moduleTitle">
                <h2><span class="error">{$backupWarning}</span></h2>
        </div>

        <div class="dashletPanelMenu wizard">
            <div class="bd">
                <div class="screen">

                    <p></p>
                    <table width="100%" cellspacing="0" cellpadding="0" class="h3Row">
                        <tbody>
                            <tr>
                                <td width="20%" valign="bottom">
                                    <h3>{$warningMessageOne}</h3>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 3px; padding-bottom: 5px;">
                                    {$warningMessageTwo}
                                </td>
                            </tr>
                            <tr>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 3px; padding-bottom: 5px;">
                                    <a href="{$url_string}" target="_self">{$continueLink}</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <p>
                    </p>

                </div>
            </div>
        </div>
HTML;

        echo $HTML;
 	}
}
?>
