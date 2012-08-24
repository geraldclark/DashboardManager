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


class dash_DashboardBackupsViewRestoreUserDashboard extends ViewDetail
{
 	public function __construct()
 	{
 		parent::ViewDetail();
 	}

 	public function display()
 	{
         global $current_user;

         if(!$current_user->is_admin)
         {
             sugar_die(translate("LBL_MUST_BE_ADMIN"));
         }

         $url_string = "";
         if (isset($_GET['backup_id']))
         {
             $dashboardBackupObj = BeanFactory::getBean("dash_DashboardBackups", $_GET['backup_id']);
             $url_string = "index.php?module=Home";
         }
         else
         {
            $dashboardBackupObj = BeanFactory::getBean("dash_DashboardBackups", $_REQUEST['record']);
            $url_string = "index.php?module=dash_DashboardBackups&action=DetailView&record=" . $_REQUEST['record'];
         }

         $user_name = $dashboardBackupObj->restoreDashboardForAssignedUser();

         $restorationHeader = translate("LBL_RESTORATION_HEADER");
         $dashboardRestored = translate("LBL_DASHBOARD_RESTORED");
         $message = translate("LBL_DASHBOARD_RESTORED_MSG_PART1") . " {$user_name}" . translate("LBL_DASHBOARD_RESTORED_MSG_PART2");
         $clickToReturn = translate("LBL_CLICK_TO_CONTINUE");

         $HTML=<<<HTML

         <div id="content">
                 <table id="contentTable" style="width:100%"><tbody><tr><td><div class="moduleTitle">
                 <h2>{$restorationHeader}</h2>
         </div>

         <div class="dashletPanelMenu wizard">
             <div class="bd">
                 <div class="screen">

                     <p></p>
                     <table width="100%" cellspacing="0" cellpadding="0" class="h3Row">
                         <tbody>
                             <tr>
                                 <td width="20%" valign="bottom">
                                     <h3>{$dashboardRestored}</h3>
                                 </td>
                             </tr>
                             <tr>
                                 <td style="padding-top: 3px; padding-bottom: 5px;">
                                     {$message}
                                 </td>
                             </tr>
                             <tr>
                                 <td>

                                 </td>
                             </tr>
                             <tr>
                                 <td style="padding-top: 3px; padding-bottom: 5px;">
                                     <a href="{$url_string}" target="_self">{$clickToReturn}</a>
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