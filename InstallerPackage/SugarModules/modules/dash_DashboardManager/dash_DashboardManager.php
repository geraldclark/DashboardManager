<?PHP

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

 /**
 * THIS CLASS IS FOR DEVELOPERS TO MAKE CUSTOMIZATIONS IN
 */

require_once('modules/dash_DashboardManager/dash_DashboardManager_sugar.php');

class dash_DashboardManager extends dash_DashboardManager_sugar
{
    var $unencoded_pages=array();
    var $unencoded_dashlets=array();
    var $temp_unencoded_pages=array();
    var $temp_unencoded_dashlets=array();
    var $user_check_errors = array();

    //for reference
    var $locked_dashboard_id = "dash_dashboardmanager_usersdash_dashboardmanager_ida";
    var $locked_dashboard_rel = "dash_dashboardmanager_users";

    var $one_time_id = "dash_dashboardmanager_users_1dash_dashboardmanager_ida";
    var $one_time_rel = "dash_dashboardmanager_users_1";

    var $forced_pages_id = "dash_dashboardmanager_users_2dash_dashboardmanager_ida";
    var $forced_pages_rel = "dash_dashboardmanager_users_2";

	function dash_DashboardManager()
    {
		parent::dash_DashboardManager_sugar();
	}

    /**
    * Function fetches a single row of data given the primary key value.
    *
    * @param string $id Optional, default -1, is set to -1 id value from the bean is used, else, passed value is used
    * @param boolean $encode Optional, default true, encodes the values fetched from the database.
    * @param boolean $deleted Optional, default true, if set to false deleted filter will not be added.
    */
    function retrieve($id = -1, $encode=true, $deleted=true)
    {
        $bean = parent::retrieve($id, $encode, $deleted);

        //set decoded dashboard
        $this->setUnencodedDashboard();

        return $bean;
    }

    /**
    * Function to convert matching errors to a string
    *
    * @param boolean $clear_errors Optional, clears errors in case you want to do further logic with bean
    */
    function getCheckErrors($clear_errors = true)
    {
        $error_string = '';

        if (is_array($this->user_check_errors) && !empty($this->user_check_errors))
        {
            $error_string = "Reasons for backup:\r\n- ";
            $error_string .= implode("\r\n- ", $this->user_check_errors);
        }

        if ($clear_errors)
        {
            $this->user_check_errors = array();
        }

        return $error_string;
    }

    /**
    * Delete a page by its page_key
    *
    * @param array $new_pages New page arrangement.
    */
    function deletePageByKey($page_key, $pages)
    {
        if (empty($page_key))
        {
            $page_key = '0';
        }

        if (isset($pages[$page_key]))
        {
            unset($pages[$page_key]);
        }

        $count = 0;
        $new_pages = array();
        foreach ($pages as $key=>$page)
        {
            $new_pages[$count] = $page;
            $count = $count + 1;
        }

        return $new_pages;
    }

    /**
    * Saves the Dashboard Template
    *
    * @param boolean $check_notify Optional, default false, if set to true assignee of the record is notified via email.
    */
    function save($check_notify = FALSE)
    {
        //workaround for create record not populating fields
        if (empty($this->name) && isset($_REQUEST['name']) && !empty($_REQUEST['name']))
        {
            $this->name = $_REQUEST['name'];
        }

        //workaround for create record not populating fields
        if (empty($this->description) && isset($_REQUEST['description']) && !empty($_REQUEST['description']))
        {
            $this->description = $_REQUEST['description'];
        }

        global $current_user;

        //get current user dash so we can save it
        $this->unencoded_pages = $this->getUserPreference($current_user, 'pages', 'Home');
        $this->unencoded_dashlets = $this->getUserPreference($current_user, 'dashlets', 'Home');

        //check for identifiers
        $this->setIdentifiers();

        //echo '<pre>'; print_r($this->temp_unencoded_pages); exit;
        //echo '<pre>'; print_r($this->temp_unencoded_dashlets); exit;

        //encode for save
        $this->encoded_pages = base64_encode(serialize($this->unencoded_pages));
        $this->encoded_dashlets = base64_encode(serialize($this->unencoded_dashlets));

        $id = parent::save($check_notify);

        return $id;
    }

    /**
    * Decodes the base64 encoded dashboard for use with the bean
    */
    function setUnencodedDashboard()
    {
        $this->unencoded_pages = unserialize(base64_decode($this->encoded_pages));
        $this->unencoded_dashlets = unserialize(base64_decode($this->encoded_dashlets));

        $this->temp_unencoded_pages = unserialize(base64_decode($this->encoded_pages));
        $this->temp_unencoded_dashlets = unserialize(base64_decode($this->encoded_dashlets));
    }

    /**
    * Used when forcing a template to a user. Allows us to keep users old settings assuming they have had a template forced to them before.
    *
    * DO NOT USE THIS METHOD AND SAVE THE BEAN
    *
    * @param array $options list of options and the identifiers they belong to
    */
    function setOptionsToTemplate($options)
    {
        foreach ($this->temp_unencoded_dashlets as $key=>$value)
        {
            if (isset($this->temp_unencoded_dashlets[$key]['DashletID']) && !empty($this->temp_unencoded_dashlets[$key]['DashletID']))
            {
                if (isset($options[$this->temp_unencoded_dashlets[$key]['DashletID']]))
                {
                    $this->temp_unencoded_dashlets[$key]['options'] = $options[$this->temp_unencoded_dashlets[$key]['DashletID']];
                }
            }
        }
    }

    /**
    * Checks if the current retrieve dashboard has identifiers. If not, identifier is generated.
    * This is a hack that may need to be altered in the future.
    */
    function setIdentifiers()
    {
        //handle pages
        foreach ($this->unencoded_pages as $pagekey=>$page)
        {
            if (!isset($this->unencoded_pages[$pagekey]['PageID']) || empty($this->unencoded_pages[$pagekey]['PageID']))
            {
                $id = create_guid();
                $this->unencoded_pages[$pagekey]['PageID'] = $id;
            }
        }

        //handle dashlets
        foreach ($this->unencoded_dashlets as $key=>$value)
        {
            if (!isset($this->unencoded_dashlets[$key]['DashletID']) || empty($this->unencoded_dashlets[$key]['DashletID']))
            {
                $id = create_guid();
                $this->unencoded_dashlets[$key]['DashletID'] = $id;
            }
        }
    }

    /**
    * Generates new keys for the dashlets (These are not identifiers).
    * This is to avoid any key conflicts between users and dashboards.
    */
    function setUniqueDashlets()
    {
        //get new dashlet ids
        $dashlets = array();
        $dashlet_ids = array();

        if (!empty($this->temp_unencoded_dashlets))
        {
            foreach ($this->temp_unencoded_dashlets as $key=>$value)
            {
                $id = create_guid();
                $dashlet_ids[$key] = $id;
                $dashlets[$id] = $value;
            }
        }

        //update pages to have new dashlet ids
        $pagesTemp = $this->temp_unencoded_pages;
        $pages = $this->temp_unencoded_pages;

        if (!empty($pagesTemp))
        {
            foreach ($pagesTemp as $pagekey=>$page)
            {
                foreach ($page as $tabkey=>$tab)
                {
                    if (is_array($tab))
                    {
                        foreach ($tab as $columnkey=>$column)
                        {
                            if (isset($column['dashlets']))
                            {
                                foreach ($column['dashlets'] as $dashletkey=>$dashlet)
                                {
                                    if (isset($dashlet_ids[$dashlet]))
                                    {
                                        //swap out old ids for new ones
                                        $pages[$pagekey][$tabkey][$columnkey]['dashlets'][$dashletkey] = $dashlet_ids[$dashlet];
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $this->temp_unencoded_pages = $pages;
        $this->temp_unencoded_dashlets = $dashlets;
    }

    /**
    * Sets the currently retrieved dashboard template to a user
    *
    * @param object $userObj User Obj to set dashboard
    * @param boolean $reset clear temp bean after save
    */
    function setDashboardForUser($userObj, $reset=true)
    {
        //get unique id for pages and dashlets
        $this->setUniqueDashlets();

        //update users
        $userObj->setPreference('dashlets', $this->temp_unencoded_dashlets, 0, 'Home');
        $userObj->setPreference('pages', $this->temp_unencoded_pages, 0, 'Home');
        $userObj->savePreferencesToDB();

        if ($reset)
        {
            //reset my unencoded dashboard
            $this->setUnencodedDashboard();
        }

        //echo '<pre>'; print_r($this->temp_unencoded_dashlets); //exit;
        //echo '<pre>'; print_r($this->temp_unencoded_pages); exit;
    }

    /**
    * Checks if the instance is on a supported version.
    *
    * @param object $userObj User Obj to set dashboard for. Empty assumes the current user.
    * @return bool $match Tells if version is supported
    */
    function checkVersion()
    {
        global $sugar_version;

        $match = false;

        $regexList = array ('6\\.5\\.(.*?)', '6\\.6\\.(.*?)', '6\\.6\\.(.*?)\\.(.*?)', '6\\.7\\.(.*?)', '6\\.7\\.(.*?)\\.(.*?)');

        $match = false;
        foreach($regexList as $regex)
        {
            if (preg_match("/{$regex}/", $sugar_version))
            {
                $match = true;
                break;
            }
        }

        if (!$match)
        {
            $GLOBALS['log']->fatal("Dashboard Manager :: Version check failed | Current version: {$sugar_version} | Regex List: " . implode(", ", $regexList) . " | Please check SugarForge for an updated package.");
        }

        return $match;
    }

    /**
    * Checks if the user should have a locked dashboard.
    *
    * @param object $userObj User Obj to set dashboard for. Empty assumes the current user.
    */
    function checkLock($userObj = null)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        if (!empty($userObj->dash_dashboardmanager_usersdash_dashboardmanager_ida))
        {
            global $sugar_config;

            if (!$sugar_config['lock_homepage'])
            {
                $sugar_config['lock_homepage'] = true;
            }
        }
    }

    /**
    * Checks user for Dashboard Template associations and applies the template configuration.
    *
    * @param object $userObj User Obj to check. Empty assumes the current user.
    * @return int Returns relationship type
    */
    function checkUser($userObj = null)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        //check for one time
        if (!empty($userObj->dash_dashboardmanager_users_1dash_dashboardmanager_ida))
        {
            //make backup
            $dashboardBackupObj = BeanFactory::newBean("dash_DashboardBackups");
            $dashboardBackupObj->createDashboardBackup($userObj->dash_dashboardmanager_users_1dash_dashboardmanager_ida, "One Time Backup", $this->getCheckErrors());

            $GLOBALS['log']->info("Dashboard Manager :: Updating One Time Dashboard | Template: {$this->id} / User: {$userObj->user_name}");

            $this->retrieve($userObj->dash_dashboardmanager_users_1dash_dashboardmanager_ida);

            //get dashboard
            $user_dashlets = $this->getUserPreference($userObj, 'dashlets', 'Home');
            $user_dashlet_options = $this->getDashletOptions($user_dashlets);

            //retain any existing options for template
            $this->setOptionsToTemplate($user_dashlet_options);
            $this->setDashboardForUser($userObj);

            //we only want to set this once when the user first logs in, so unset relationship
            $this->load_relationship("dash_dashboardmanager_users_1");
            $this->dash_dashboardmanager_users_1->delete($this->id, $userObj->id);

            return 1;
        }
        //check for locked dashboard
        elseif (!empty($userObj->dash_dashboardmanager_usersdash_dashboardmanager_ida))
        {
            $this->retrieve($userObj->dash_dashboardmanager_usersdash_dashboardmanager_ida);

            if (!$this->dashboardCompareStrict($userObj))
            {
                //make backup
                $dashboardBackupObj = BeanFactory::newBean("dash_DashboardBackups");
                $dashboardBackupObj->createDashboardBackup($userObj->dash_dashboardmanager_usersdash_dashboardmanager_ida, "Locked Dashboard Backup", $this->getCheckErrors());

                $GLOBALS['log']->info("Dashboard Manager :: Updating Locked Dashboard | Template: {$this->id} / User: {$userObj->user_name}");
                $this->mergeLockedDashboard($userObj);
                $this->setDashboardForUser($userObj);
            }
            else
            {
                $GLOBALS['log']->info("Dashboard Manager :: Dashboard Already Set | Template: {$this->id} / User: {$userObj->user_name}");
            }

            return 2;
        }
        //check for forced pages
        elseif (!empty($userObj->dash_dashboardmanager_users_2dash_dashboardmanager_ida))
        {
            $this->retrieve($userObj->dash_dashboardmanager_users_2dash_dashboardmanager_ida);

            if (!$this->dashboardCompareSemiStrict($userObj))
            {
                //make backup
                $dashboardBackupObj = BeanFactory::newBean("dash_DashboardBackups");
                $dashboardBackupObj->createDashboardBackup($userObj->dash_dashboardmanager_users_2dash_dashboardmanager_ida, "Forced Page Backup", $this->getCheckErrors());

                $GLOBALS['log']->info("Dashboard Manager :: Updating Forced Pages Dashboard | Template: {$this->id} / User: {$userObj->user_name}");
                $this->mergeForcedPageDashboard($userObj);
                $this->setDashboardForUser($userObj);
            }
            else
            {
                $GLOBALS['log']->info("Dashboard Manager :: Dashboard Already Set | Template: {$this->id} / User: {$userObj->user_name}");
            }

            return 3;
        }
    }

    /**
    * Merges a users dashlet options into the locked template.
    * This is run before forcing the template to the user and is done so users can keep exisiting settings.
    *
    * 1. Dashlets without identifiers are removed
    * 2. Dashlets without matching identifiers in template are removed
    * 3. Dashlets with matching identifiers will have existing user options merged to template
    *
    * @param object $userObj User Obj to compare dashboard for. Empty assumes the current user.
    */
    function mergeLockedDashboard($userObj = null)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        $user_dashlets = $this->getUserPreference($userObj, 'dashlets', 'Home');
        $user_dashlet_options = $this->getDashletOptions($user_dashlets);

        $this->setOptionsToTemplate($user_dashlet_options);
    }

    /**
    * Merges dashlet template pages into a users template.
    *
    * 1. Matching dashlets will have settings retained
    * 2. Non matching pages and dashlets are appended after forced pages
    *
    * @param object $userObj User Obj to merge dashboard for. Empty assumes the current user.
    */
    function mergeForcedPageDashboard($userObj = null)
    {

        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        //get user dash
        $user_dashlets = $this->getUserPreference($userObj, 'dashlets', 'Home');
        $user_pages = $this->getUserPreference($userObj, 'pages', 'Home');

        //get any current options
        $user_dashlet_options = $this->getDashletOptions($user_dashlets);
        $this->setOptionsToTemplate($user_dashlet_options);

        //get ids from template
        $template_page_ids = $this->getPageIDs($this->unencoded_pages);
        $template_dashlet_ids = $this->getDashletIDs($this->unencoded_dashlets);

        //remove stock template dashlets from current user layouts
        $user_pages_to_merge = $this->removePageByIdentifier($template_page_ids, $user_pages);
        $user_dashlets_to_merge = $this->removeDashletByIdentifier($template_dashlet_ids, $user_dashlets);

        //merge user pages back into template
        foreach ($user_pages_to_merge as $page)
        {
            array_push($this->temp_unencoded_pages, $page);
        }

        //merge user dashlets back into template
        foreach ($user_dashlets_to_merge as $key=>$dashlet)
        {
            $this->temp_unencoded_dashlets[$key] = $dashlet;
        }
    }

    /**
    * removes a dashlet by its identifier
    *
    * @param array list of dashlet ids to remove.
    * @return array $dashlets new list of dashlets
    */
    function removeDashletByIdentifier($ids, $dashlets)
    {
        if (is_string($ids))
        {
            $ids = array($ids);
        }

        if (count($dashlets) > 0)
        {
            foreach ($dashlets as $key=>$value)
            {
                if (isset($dashlets[$key]['DashletID']) && in_array($dashlets[$key]['DashletID'], $ids))
                {
                    unset($dashlets[$key]);
                }
            }
        }

        return $dashlets;
    }

    /**
    * removes a page by its identifier
    *
    * @param array list of page ids to remove.
    * @return array $pages new list of pages
    */
    function removePageByIdentifier($ids, $pages)
    {
        if (is_string($ids))
        {
            $ids = array($ids);
        }

        if (count($pages) > 0)
        {
            foreach ($pages as $key=>$page)
            {
                if (isset($pages[$key]['PageID']) && in_array($pages[$key]['PageID'], $ids))
                {
                    unset($pages[$key]);
                }
            }
        }

        return $pages;
    }

    /**
    * Merges a dashlet template into a users template.
    * This is run before forcing the modified template to the user and is done so users can keep exisiting settings.
    *
    * 1. Dashlets without identifiers are shifted but should still be present
    * 2. Dashlets without matching identifiers in template are removed
    * 3. Dashlets with matching identifiers will have exisiting user options merged to template
    *
    * @param object $userObj User Obj to compare dashboard for. Empty assumes the current user.
    * @return bool $match Tells if dashboard ids exist
    */
    function mergeAppendPageDashboard($userObj = null)
    {

        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        //get current user dash so we can push changes to it
        $this->temp_unencoded_pages = $this->getUserPreference($userObj, 'pages', 'Home');
        $this->temp_unencoded_dashlets = $this->getUserPreference($userObj, 'dashlets', 'Home');

        if (empty($this->temp_unencoded_pages))
        {
            $this->temp_unencoded_pages = array();
        }

        //handle missing pages
        $user_page_ids = $this->getPageIDs($this->temp_unencoded_pages);
        $template_page_ids = $this->getPageIDs($this->unencoded_pages);

        $pages_to_push = array();
        foreach($template_page_ids as $page_id)
        {
            if (!isset($user_page_ids[$page_id]))
            {
                $pages_to_push[$page_id]=$page_id;
            }
        }

        foreach ($pages_to_push as $page_id)
        {
            $new_page = $this->getPageByID($page_id, $this->unencoded_pages);

            if (!empty($new_page))
            {
                array_push($this->temp_unencoded_pages, $new_page);
            }
        }

        //handle missing dashlets
        $user_dashlet_ids = $this->getDashletIDs($this->temp_unencoded_dashlets);
        $template_dashlet_ids = $this->getDashletIDs($this->unencoded_dashlets);

        $dashlets_to_push = array();
        foreach($template_dashlet_ids as $dashlet_id)
        {
            if (!isset($user_dashlet_ids[$dashlet_id]))
            {
                $dashlets_to_push[$dashlet_id]=$dashlet_id;
            }
        }

        foreach ($dashlets_to_push as $dashlet_id)
        {
            $new_dashlet = $this->getDashletByID($dashlet_id, $this->unencoded_dashlets);

            if (!empty($new_dashlet))
            {
                foreach($new_dashlet as $key=>$dashlet_setup)
                {
                    $this->temp_unencoded_dashlets[$key] = $dashlet_setup;

                    //check dashlet id exists on a page
                    if ($this->getPageIDFromDashletID($dashlet_id, $this->temp_unencoded_dashlets, $this->temp_unencoded_pages) === false)
                    {
                        $page_id = $this->getPageIDFromDashletID($dashlet_id, $this->unencoded_dashlets, $this->unencoded_pages);

                        if ($page_id !== false)
                        {
                            $this->appendDashletToPage($page_id, $key);
                        }
                    }
                }
            }
        }
    }


    /**
    * Appends a dashlet key to a page by page identifier.
    *
    * @param string $page_id page identifier
    * @param string $dashlet_key Key for the dashlet, this is not the identifier
    */
    function appendDashletToPage($page_id, $dashlet_key)
    {
        foreach ($this->temp_unencoded_pages as $pagekey=>$page)
        {
            if (isset($this->temp_unencoded_pages[$pagekey]['PageID']) && isset($this->temp_unencoded_pages[$pagekey]['columns']) && !empty($this->temp_unencoded_pages[$pagekey]['columns']) && $this->temp_unencoded_pages[$pagekey]['PageID'] == $page_id)
            {
                $column = 1;
                if (count($this->temp_unencoded_pages[$pagekey]['columns'][0]['dashlets']) <= count($this->temp_unencoded_pages[$pagekey]['columns'][1]['dashlets']))
                {
                    $column = 0;
                }

                array_push($this->temp_unencoded_pages[$pagekey]['columns'][$column]['dashlets'], $dashlet_key);
            }
        }
    }

    /**
    * Compares dashboard template page identifiers to a users dashboard.
    * The check includes page positioning. Strict!
    *
    * @param object $userObj User Obj to compare dashboard for. Empty assumes the current user.
    * @param boolean $checkPageName Also check against page naming. Empty assumes true.
    * @return boolean $match Tells if page ids exist
    */
    function pagesCompareStrict($userObj = null, $checkPageName = true, $checkPageCount = true)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        $match = false;

        //check page tab names
        $pageNameMatch = true;
        if ($checkPageName && !$this->pageNameCompare($userObj))
        {
            $pageNameMatch = false;
        }

        //check page count
        $pageCountMatch = true;
        if ($checkPageCount && !$this->pageCountCompare($userObj))
        {
            $pageCountMatch = false;
        }

        $pagesCompare = $this->pagesCompare($userObj);
        $pageOrderCompare = $this->pageOrderCompare($userObj);

        //check result
        if (
            //check all forced pages exist
            $pagesCompare
            //check forced page order is correct
            && $pageOrderCompare
            //page name check result
            && $pageNameMatch
            //page count check result
            && $pageCountMatch
           )
        {
            $match = true;
        }

        return $match;
    }

    /**
    * Compares dashboard template page count to a users dashboard.
    *
    * @param object $userObj User Obj to compare dashboard for. Empty assumes the current user.
    * @return bool $match Tells if page count matches
    */
    function pageCountCompare($userObj = null)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        $match = false;

        //get page ids
        $template_page_count = $this->getPageCount($this->temp_unencoded_pages);
        $user_page_count = $this->getPageCount($this->getUserPreference($userObj, 'pages', 'Home'));

        if ($template_page_count == $user_page_count)
        {
            $match = true;
        }

        if (!$match)
        {
            $this->user_check_errors[]="Page count check failed.";
        }

        return $match;
    }

    /**
    * Compares dashboard template page tab names to a users dashboard.
    *
    * @param object $userObj User Obj to compare dashboard for. Empty assumes the current user.
    * @return bool $match Tells if compare matches
    */
    function pageNameCompare($userObj = null)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        $match = true;

        //get page ids
        $template_page_names = $this->getPageNames($this->temp_unencoded_pages);
        $user_page_names = $this->getPageNames($this->getUserPreference($userObj, 'pages', 'Home'));

        foreach ($template_page_names as $id=>$value)
        {
            if (!isset($user_page_names[$id]) || $template_page_names[$id] !== $user_page_names[$id])
            {
                $match = false;
            }
        }

        if (!$match)
        {
            $this->user_check_errors[]="Page name check failed.";
        }

        return $match;
    }

    /**
    * Compares dashboard template page order to a users dashboard.
    *
    * @param object $userObj User Obj to compare dashboard for. Empty assumes the current user.
    * @return bool $match Tells if compare matches
    */
    function pageOrderCompare($userObj = null)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        $match = true;

        //get page ids
        $template_page_order = $this->getPageOrder($this->temp_unencoded_pages);
        $user_page_order = $this->getPageOrder($this->getUserPreference($userObj, 'pages', 'Home'));

        foreach ($template_page_order as $id=>$value)
        {
            if (!isset($user_page_order[$id]) || $template_page_order[$id] !== $user_page_order[$id])
            {
                $match = false;
            }
        }

        if (!$match)
        {
            $this->user_check_errors[]="Page order check failed.";
        }

        return $match;
    }


    /**
    * Compares dashboard template page identifiers to a users dashboard.
    * The check excludes page positioning or page count matches. Not strict!
    *
    * @param object $userObj User Obj to compare dashboard for. Empty assumes the current user.
    * @return bool $match Tells if compare matches
    */
    function pagesCompare($userObj = null)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        $match = true;

        //get page ids
        $template_page_ids = $this->getPageIDs($this->temp_unencoded_pages);
        $user_page_ids = $this->getPageIDs($this->getUserPreference($userObj, 'pages', 'Home'));

        foreach ($template_page_ids as $id)
        {
            if (!isset($user_page_ids[$id]))
            {
                $match = false;
            }
        }

        if (!$match)
        {
            $this->user_check_errors[]="Page identifier check failed.";
        }

        return $match;
    }

    /**
    * Compares dashboard template dashlet identifiers to a users dashboard.
    * The check excludes positioning and option settings. Not strict!
    *
    * @param object $userObj User Obj to compare dashboard for. Empty assumes the current user.
    * @return bool $match Tells if compare matches
    */
    function dashletCompare($userObj = null)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        $match = true;

        //get dashlets ids
        $template_dashlet_ids = $this->getDashletIDs($this->temp_unencoded_dashlets);
        $user_dashlet_ids = $this->getDashletIDs($this->getUserPreference($userObj, 'dashlets', 'Home'));

        foreach ($template_dashlet_ids as $id)
        {
            if (!isset($user_dashlet_ids[$id]))
            {
                $match = false;
            }
        }

        if (!$match)
        {
            $this->user_check_errors[]="Dashlet identifier check failed.";
        }

        return $match;
    }

    /**
    * Compares dashboard template dashlet dimensions to a users dashboard.
    *
    * @param object $userObj User Obj to compare dashboard for. Empty assumes the current user.
    * @return bool $match Tells if compare matches
    */
    function dashletDimensionCompare($userObj = null)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        $match = true;

        //get dashlets dimensions
        $template_dashlet_dimensions = $this->getDashletDimensions($this->temp_unencoded_dashlets);
        $user_dashlet_dimensions = $this->getDashletDimensions($this->getUserPreference($userObj, 'dashlets', 'Home'));

        foreach ($template_dashlet_dimensions as $id=>$value)
        {
            if (!isset($user_dashlet_dimensions[$id]) || $template_dashlet_dimensions[$id] !== $user_dashlet_dimensions[$id])
            {
                $match = false;
            }
        }

        if (!$match)
        {
            $this->user_check_errors[]="Dashlet dimension check failed.";
        }

        return $match;
    }

    /**
    * Compares dashboard template dashlet columns/rows to a users dashboard columns/rows.
    *
    * @param object $userObj User object to compare dashboard for. Empty assumes the current user.
    * @return bool $match Tells if compare matches
    */
    function dashletColumnRowCompare($userObj = null)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        $match = true;

        //get dashlets columns
        $template_dashlet_columns = $this->getDashletColumns($this->temp_unencoded_pages, $this->temp_unencoded_dashlets, false);
        $user_dashlet_columns = $this->getDashletColumns($this->getUserPreference($userObj, 'pages', 'Home'), $this->getUserPreference($userObj, 'dashlets', 'Home'), false);

        //unset any ids from other templates
        foreach ($user_dashlet_columns as $id=>$value)
        {
            if (!isset($template_dashlet_columns[$id]))
            {
                unset($user_dashlet_columns[$id]);
            }
        }

        if ($template_dashlet_columns !== $user_dashlet_columns)
        {
            $match = false;
        }

        if (!$match)
        {
            $this->user_check_errors[]="Dashlet columns & rows check failed.";
        }

        return $match;
    }

    /**
    * Compares dashboard template dashlet columns to a users dashboard columns.
    *
    * @param object $userObj User object to compare dashboard for. Empty assumes the current user.
    * @return bool $match Tells if compare matches
    */
    function dashletColumnCompare($userObj = null)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        $match = true;

        //get dashlets columns
        $template_dashlet_columns = $this->getDashletColumns($this->temp_unencoded_pages, $this->temp_unencoded_dashlets);
        $user_dashlet_columns = $this->getDashletColumns($this->getUserPreference($userObj, 'pages', 'Home'), $this->getUserPreference($userObj, 'dashlets', 'Home'));

        foreach ($template_dashlet_columns as $id)
        {
            if (!isset($user_dashlet_columns[$id]))
            {
                $match = false;
            }
        }

        if (!$match)
        {
            $this->user_check_errors[]="Dashlet column check failed.";
        }

        return $match;
    }

    /**
    * Compares dashboard template dashlets to a users dashboard dashlets.
    * The check includes dashlet dimensions but NOT option settings.
    *
    * @param object $userObj User Obj to compare dashboard for. Empty assumes the current user.
    * @return bool $match Tells if compare matches
    */
    function dashletCompareStrict($userObj = null)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        $match = false;

        $dashletCompare = $this->dashletCompare($userObj);
        $dashletColumnRowCompare = $this->dashletColumnRowCompare($userObj);
        $dashletDimensionCompare = $this->dashletDimensionCompare($userObj);

        if (
            $dashletCompare
            && $dashletColumnRowCompare
            && $dashletDimensionCompare
           )
        {
            $match = true;
        }

        return $match;
    }

    /**
    * Compares dashboard template identifiers to a users dashboard.
    * The check excludes dashboard positioning and option settings. Not strict!
    *
    * @param object $userObj User Obj to compare dashboard for. Empty assumes the current user.
    * @return bool $match Tells if compare matches
    */
    function dashboardCompare($userObj = null)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        $match = false;
        $pageMatch = $this->pagesCompare($userObj);
        $dashletMatch = $this->dashletCompare($userObj);

        //check matches
        if ($pageMatch && $dashletMatch)
        {
            $match = true;
        }

        return $match;
    }

    /**
    * Compares dashboard template identifiers to a users dashboard.
    * The check includes dashboard positioning and page naming for tempated pages but not page count. Semi Strict!
    *
    * @param object $userObj User Obj to compare dashboard for. Empty assumes the current user.
    * @param bollean $pageNameCompare Adds in check for page naming. Defaults to true.
    * @return boolean $match Tells if compare matches
    */
    function dashboardCompareSemiStrict($userObj = null, $pageNameCompare = true, $checkPageCount = false)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        $match = false;

        $pageMatch = $this->pagesCompareStrict($userObj, $pageNameCompare, $checkPageCount);
        $dashletMatch = $this->dashletCompareStrict($userObj);

        //check matches
        if ($pageMatch && $dashletMatch)
        {
            $match = true;
        }

        return $match;
    }

    /**
    * Compares dashboard template identifiers to a users dashboard.
    * The check includes dashboard positioning and page naming. Strict!
    *
    * @param object $userObj User Obj to compare dashboard for. Empty assumes the current user.
    * @param bollean $pageNameCompare Adds in check for page naming. Defaults to true.
    * @return boolean $match Tells if compare matches
    */
    function dashboardCompareStrict($userObj = null, $pageNameCompare = true, $checkPageCount = true)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        $match = false;
        $pageMatch = $this->pagesCompareStrict($userObj, $pageNameCompare, $checkPageCount);
        $dashletMatch = $this->dashletCompareStrict($userObj);

        //check matches
        if ($pageMatch && $dashletMatch)
        {
            $match = true;
        }

        return $match;
    }

    /**
    * Retrieves identifier options from dashlets.
    *
    * @param array $dashlets Unencoded dashlets
    * @return array $dashlet_options List of dashlet identifier options found in the dashboard
    */
    function getDashletOptions($dashlets)
    {
        $dashlet_options = array();
        foreach ($dashlets as $key=>$value)
        {
            if (
                isset($dashlets[$key]['DashletID']) && !empty($dashlets[$key]['DashletID'])
                && isset($dashlets[$key]['options']) && !empty($dashlets[$key]['options'])
               )
            {
                $dashlet_options[$dashlets[$key]['DashletID']] = $dashlets[$key]['options'];
            }
        }

        return $dashlet_options;
    }

    /**
    * Retrieves identifiers from dashlets.
    *
    * @param string $key dashlet key
    * @param array $dashlets Unencoded dashlets
    * @return string $dashlet_id Dashlet identifier
    */
    function getDashletIDByKey($key, $dashlets)
    {
        $dashlet_id = '';
        if (isset($dashlets[$key]) && isset($dashlets[$key]['DashletID']) && !empty($dashlets[$key]['DashletID']))
        {
            $dashlet_id = $dashlets[$key]['DashletID'];
        }

        return $dashlet_id;
    }

    /**
    * Retrieves key from dashlets using the identifier.
    *
    * @param string $id dashlet identifier
    * @param array $dashlets Unencoded dashlets
    * @return string $dashlet_key Dashlet key
    */
    function getDashletKeyByID($id, $dashlets)
    {
        $dashlet_key = '';

        if (count($dashlets) > 0)
        {
            foreach ($dashlets as $key=>$value)
            {
                if (isset($dashlets[$key]['DashletID']) && !empty($dashlets[$key]['DashletID']) && $dashlets[$key]['DashletID'] == $id)
                {
                    $dashlet_key = $key;
                    break;
                }
            }
        }

        return $dashlet_key;
    }

    /**
    * Retrieves dashlet identifiers and dimensions.
    *
    * @param array $dashlets Unencoded dashlets
    * @return array $dashlet_dimensions List of dashlet identifiers and their dimensions found in the dashboard
    */
    function getDashletDimensions($dashlets, $sort = true)
    {
        $dashlet_dimensions = array();
        foreach ($dashlets as $key=>$value)
        {
            if (isset($dashlets[$key]['forceColumn']) && isset($dashlets[$key]['DashletID']) && !empty($dashlets[$key]['DashletID']))
            {
                $dashlet_dimensions[$dashlets[$key]['DashletID']] = $dashlets[$key]['forceColumn'];
            }
        }

        if ($sort)
        {
            ksort($dashlet_dimensions);
        }

        return $dashlet_dimensions;
    }

    /**
    * Retrieves identifiers from dashlets.
    *
    * @param array $dashlets Unencoded dashlets
    * @return array $dashlet_ids List of dashlet identifiers found in the dashboard
    */
    function getDashletIDs($dashlets, $sort = true)
    {
        $dashlet_ids = array();
        if (count($dashlets) > 0)
        {
            foreach ($dashlets as $key=>$value)
            {
                if (isset($dashlets[$key]['DashletID']) && !empty($dashlets[$key]['DashletID']))
                {
                    $dashlet_ids[$dashlets[$key]['DashletID']] = $dashlets[$key]['DashletID'];
                }
            }
        }

        if ($sort)
        {
            ksort($dashlet_ids);
        }

        return $dashlet_ids;
    }

    /**
    * Retrieves identifiers from pages.
    *
    * @param array $pages Unencoded pages
    * @return array $page_ids List of page identifiers found in the dashboard
    */
    function getPageIDs($pages, $sort = true)
    {
        $page_ids = array();
        if (count($pages) > 0)
        {
            foreach ($pages as $pagekey=>$page)
            {
                if (isset($pages[$pagekey]['PageID']) && !empty($pages[$pagekey]['PageID']))
                {
                    $page_ids[$pages[$pagekey]['PageID']] = $pages[$pagekey]['PageID'];
                }
            }
        }

        if ($sort)
        {
            ksort($page_ids);
        }

        return $page_ids;
    }

    /**
    * Retrieves pages order for pages with identifiers
    *
    * @param array $pages Unencoded pages
    * @return array $page_order List of page identifiers and their order in the dashboard
    */
    function getPageOrder($pages, $sort = true)
    {
        $page_order = array();
        foreach ($pages as $pagekey=>$page)
        {
            if (isset($pages[$pagekey]['PageID']) && !empty($pages[$pagekey]['PageID']))
            {
                $page_order[$pages[$pagekey]['PageID']] = $pagekey;
            }
        }

        if ($sort)
        {
            ksort($page_order);
        }

        return $page_order;
    }

    /**
    * Retrieves page count
    *
    * @param array $pages Unencoded pages
    * @return array $page_count Number of pages in the dashboard
    */
    function getPageCount($pages)
    {
        $page_count = count($pages);
        return $page_count;
    }

    /**
    * Retrieves page names for pages with identifiers
    *
    * @param array $pages Unencoded pages
    * @return array $page_names List of page identifiers and display name in the dashboard
    */
    function getPageNames($pages, $sort = true)
    {
        $page_names = array();
        foreach ($pages as $pagekey=>$page)
        {
            if (isset($pages[$pagekey]['pageTitle']) && isset($pages[$pagekey]['PageID']) && !empty($pages[$pagekey]['PageID']))
            {
                $page_names[$pages[$pagekey]['PageID']] = $pages[$pagekey]['pageTitle'];
            }
        }

        if ($sort)
        {
            ksort($page_names);
        }

        return $page_names;
    }

    /**
    * Retrieves dashlet columns
    *
    * @param array $pages Unencoded pages
    * @param array $dashlets Unencoded dashlets
    * @return array $page_names List of dashlet identifiers and column in the dashboard
    */
    function getDashletColumns($pages, $dashlets, $sort = true)
    {
        $dashlet_columns = array();
        foreach ($pages as $pagekey=>$page)
        {
            if (isset($pages[$pagekey]['PageID']) && isset($pages[$pagekey]['columns']) && !empty($pages[$pagekey]['columns']))
            {
                foreach($pages[$pagekey]['columns'] as $column_id=>$column)
                {
                    if (isset($column['dashlets']))
                    {
                        foreach ($column['dashlets'] as $key=>$dash_key)
                        {
                            $dashlet_columns[$this->getDashletIDByKey($dash_key, $dashlets)] = $column_id;
                        }
                    }
                }
            }
        }

        if ($sort)
        {
            ksort($dashlet_columns);
        }

        return $dashlet_columns;
    }

    /**
    * Retrieves a page by its identifier.
    *
    * @param array $page_id Page identifier
    * @return array $page Page setup
    */
    function getPageByID($page_id, $pages)
    {
        $page = array();
        if (count($pages) > 0)
        {
            foreach ($pages as $pagekey=>$page)
            {
                if (isset($pages[$pagekey]['PageID']) && $pages[$pagekey]['PageID'] == $page_id)
                {
                    $page=$pages[$pagekey];
                    break;
                }
            }
        }

        return $page;
    }

    /**
    * Retrieves a page by a dashlet key.
    *
    * @param array $dashlet_key Dashlet key
    * @return string $page_id Page identifier
    */
    function getPageIDFromDashletKey($dashlet_key, $pages)
    {
        $page_id = false;

        foreach ($pages as $pagekey=>$page)
        {
            if (isset($pages[$pagekey]['PageID']) && isset($pages[$pagekey]['columns']) && !empty($pages[$pagekey]['columns']))
            {
                foreach($pages[$pagekey]['columns'] as $column_id=>$column)
                {
                    if (isset($column['dashlets']))
                    {
                        foreach ($column['dashlets'] as $key=>$dash_key)
                        {
                            if ($dash_key == $dashlet_key)
                            {
                                $page_id = $pages[$pagekey]['PageID'];
                                break 3;
                            }
                        }
                    }
                }
            }
        }

        return $page_id;
    }

    /**
    * Retrieves the page identifier from a dashlet identifier.
    *
    * @param $dashlet_id Dashlet identifier
    * @param array $dashlets List of dashlets
    * @param array $pages List of pages
    * @return string $page_id Page identifier
    */
    function getPageIDFromDashletID($dashlet_id, $dashlets, $pages)
    {
        $page_id = false;
        if (count($dashlets) > 0)
        {
            foreach ($dashlets as $dashlet_key=>$page)
            {
                if (isset($dashlets[$dashlet_key]['DashletID']) && $dashlets[$dashlet_key]['DashletID'] == $dashlet_id)
                {
                    $page_id = $this->getPageIDFromDashletKey($dashlet_key, $pages);
                    break;
                }
            }
        }

        return $page_id;
    }

    /**
    * Retrieves a list of dashlets and their modules.
    *
    * @param array $dashlets List of dashlets
    * @return array $dashlet_modules List of modules that belong to the dashlets
    */
    function getDashletModules($dashlets)
    {
        $dashlet_modules = array();
        if (count($dashlets) > 0)
        {
            foreach ($dashlets as $dashlet_key=>$page)
            {
                if (isset($dashlets[$dashlet_key]['DashletID']) && isset($dashlets[$dashlet_key]['module']))
                {
                    $dashlet_modules[$dashlets[$dashlet_key]['DashletID']]=$dashlets[$dashlet_key]['module'];
                }
            }
        }

        return $dashlet_modules;
    }

    /**
    * Retrieves a dashlet by its identifier.
    *
    * @param array $page_id Page identifier
    * @return array $page Page setup
    */
    function getDashletByID($dashlet_id, $dashlets)
    {
        $dashlet = array();
        if (count($dashlets) > 0)
        {
            foreach ($dashlets as $dashletkey=>$page)
            {
                if (isset($dashlets[$dashletkey]['DashletID']) && $dashlets[$dashletkey]['DashletID'] == $dashlet_id)
                {
                    //uses key instead of identifier!
                    $dashlet[$dashletkey]=$dashlets[$dashletkey];
                    break;
                }
            }
        }

        return $dashlet;
    }

    /**
    * Returns the restricted pages for js use
    *
    * @param object $userObj User for access
    * @return string $js javascript array
    */
    function getRestrictedPageKeysForJS($userObj = null)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        $page_keys = array();

        foreach ($this->unencoded_pages as $key=>$page)
        {
            array_push($page_keys, $key);
        }

        $page_key_string = '"' . implode('","', $page_keys) . '"';
        $js = "new Array($page_key_string);";

        return $js;
    }

    /**
    * Returns the restricted dashlets for js use
    *
    * @param object $userObj User for access
    * @return string $js javascript array
    */
    function getRestrictedDashletKeysForJS($userObj = null)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        $dashlet_ids = $this->getDashletIDs($this->unencoded_dashlets);
        $dashlet_keys = array();

        foreach ($dashlet_ids as $id)
        {
            array_push($dashlet_keys, $this->getDashletKeyByID($id, $this->getUserPreference($userObj, 'dashlets', 'Home')));
        }

        $dashlet_key_string = '"' . implode('","', $dashlet_keys) . '"';
        $js = "new Array($dashlet_key_string);";

        return $js;
    }

    /**
    * Forces the relationship policy between Users and Dashboard Templates.
    * Users can only belong to 1 relationship in 1 template. Others must be removed.
    *
    * @param string $relationship Name of current relationship being used
    * @param object $userObj User Obj to force policy for. Empty assumes the current user.
    */
    function forceRelationshipPolicy($relationship, $userObj = null)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        //make sure user can only show under 1 subpanel under a Dashboard Template record
        $relationships = array(
            "dash_dashboardmanager_users" => "dash_dashboardmanager_users",
            "dash_dashboardmanager_users_1" => "dash_dashboardmanager_users_1",
            "dash_dashboardmanager_users_2" => "dash_dashboardmanager_users_2",
        );

        if (isset($relationships[$relationship]))
        {
            unset($relationships[$relationship]);
        }
        else
        {
            return;
        }

        $userUpdateObj = BeanFactory::getBean("Users", $userObj->id);

        //locked
        if (in_array("dash_dashboardmanager_users", $relationships))
        {
            if (!empty($userUpdateObj->dash_dashboardmanager_usersdash_dashboardmanager_ida))
            {
                $otherTemplate = BeanFactory::getBean("dash_DashboardManager", $userUpdateObj->dash_dashboardmanager_usersdash_dashboardmanager_ida);
                $otherTemplate->load_relationship("dash_dashboardmanager_users");
                $otherTemplate->dash_dashboardmanager_users->delete($otherTemplate->id, $userUpdateObj->id);
            }
        }

        //one time
        if (in_array("dash_dashboardmanager_users_1", $relationships))
        {
            if (!empty($userUpdateObj->dash_dashboardmanager_users_1dash_dashboardmanager_ida))
            {
                $otherTemplate = BeanFactory::getBean("dash_DashboardManager", $userUpdateObj->dash_dashboardmanager_users_1dash_dashboardmanager_ida);
                $otherTemplate->load_relationship("dash_dashboardmanager_users_1");
                $otherTemplate->dash_dashboardmanager_users_1->delete($otherTemplate->id, $userUpdateObj->id);
            }
        }

        //forced
        if (in_array("dash_dashboardmanager_users_2", $relationships))
        {
            if (!empty($userUpdateObj->dash_dashboardmanager_users_2dash_dashboardmanager_ida))
            {
                $otherTemplate = BeanFactory::getBean("dash_DashboardManager", $userUpdateObj->dash_dashboardmanager_users_2dash_dashboardmanager_ida);
                $otherTemplate->load_relationship("dash_dashboardmanager_users_2");
                $otherTemplate->dash_dashboardmanager_users_2->delete($otherTemplate->id, $userUpdateObj->id);
            }
        }
    }

    /**
    * Returns the ruser preference by name and category
    *
    * @param object $userObj User for access
    * @param string $name name of the preference to retreive
    * @param string $category name of the category to retreive, defaults to global scope
    * @param boolean $nullPossible Optional, default false, if set to true it's possible to return NULL
    * @return mixed the value of the preference (string, array, int etc)
    */
    function getUserPreference($userObj, $name, $category, $nullPossible = false)
    {
        $userPreference = $userObj->getPreference($name, $category);
        
        if (is_null($userPreference) && !$nullPossible) {
            $userPreference = array();
        }

        return $userPreference;
    }    

}

?>
