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

class dash_DashboardManagerViewEdit extends ViewEdit
{
 	public function __construct()
 	{
 		parent::ViewEdit();
 	}

 	public function display()
 	{
        global $current_user, $current_language, $sugar_flavor, $sugar_config;

        if(!$current_user->is_admin)
        {
            sugar_die(translate("LBL_MUST_BE_ADMIN"));
        }

        //RemoveTabSave: let dashboard pass since we are still altering it
        if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'RemoveTabSave')
        {
            if (isset($_REQUEST['TabToRemove']))
            {
                $dashboardManager = BeanFactory::newBean("dash_DashboardManager");
                $dashboardManager->temp_unencoded_pages = $dashboardManager->deletePageByKey($_REQUEST['TabToRemove'], $current_user->getPreference('pages', 'Home'));
                $dashboardManager->temp_unencoded_dashlets = $current_user->getPreference('dashlets', 'Home');
                $dashboardManager->setDashboardForUser($current_user);

                $current_user->getPreference('pages', 'Home');
                $current_user->getPreference('dashlets', 'Home');
            }
        }
        //Existing edit
        elseif (isset($this->bean->fetched_row['id']))
        {
            //set this dashboard for current user
            $this->bean->setDashboardForUser($current_user);
        }
        //New edit
        else
        {
            //set dashboard back to clean template
            $current_user->resetPreferences('Home');
        }

        parent::display();

        //get language for dashboard
        $mod_strings = return_module_language($current_language, 'Home');

        //render dashboard
        $lock_homepage = $sugar_config['lock_homepage'];
        $sugar_config['lock_homepage'] = false;

        require_once("modules/Home/index.php");

        $sugar_config['lock_homepage'] = $lock_homepage;
 	}
}