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

require_once('modules/dash_DashboardBackups/dash_DashboardBackups_sugar.php');
class dash_DashboardBackups extends dash_DashboardBackups_sugar
{
    var $unencoded_pages=array();
    var $unencoded_dashlets=array();
    var $ignore = false;

	function dash_DashboardBackups()
    {
		parent::dash_DashboardBackups_sugar();
	}

    /**
    * Function fetches a single row of data given the primary key value.
    *
    * @param string $id Optional, default -1, is set to -1 id value from the bean is used, else, passed value is used
    * @param boolean $encode Optional, default true, encodes the values fetched from the database.
    * @param boolean $deleted Optional, default true, if set to false deleted filter will not be added.
    * @return parent function
    */
    function retrieve($id = -1, $encode=true, $deleted=true)
    {
        $bean = parent::retrieve($id, $encode, $deleted);

        //set decoded dashboard
        $this->setUnencodedDashboard();

        return $bean;
    }

    /**
    * Decodes the base64 encoded dashboard for use with the bean
    */
    function setUnencodedDashboard()
    {
        $this->unencoded_pages = unserialize(base64_decode($this->encoded_pages));
        $this->unencoded_dashlets = unserialize(base64_decode($this->encoded_dashlets));
    }

    /**
    * Saves the Dashboard Backup
    *
    * @param boolean $check_notify Optional, default false, if set to true assignee of the record is notified via email.
    * @return parent function
    */
    function save($check_notify = FALSE)
    {
        //handle user default backup - for admins to retrieve their favorite dashboard easily
        if ($this->user_default == 1)
        {
            $backup_list = BeanFactory::newBean("dash_DashboardBackups");
            $results = $backup_list->get_list("", "assigned_user_id='{$this->assigned_user_id}'");

            foreach ($results['list'] as $id=>$backupObj)
            {
                if (!isset($this->fetched_row['id']) || $this->id != $id)
                {
                    $backupObj->user_default = 0;
                    $backupObj->ignore = true;
                    $backupObj->save();
                }
            }
        }

        //if being manually created
        if (
            empty($this->name)
            && !empty($this->assigned_user_id)
            && isset($_REQUEST['module'])
            && $this->ignore == false
           )
        {
            $userObj = BeanFactory::getBean("Users", $this->assigned_user_id);

            $this->unencoded_pages = $userObj->getPreference('pages', 'Home');
            $this->unencoded_dashlets = $userObj->getPreference('dashlets', 'Home');

            $this->name = "Manual Backup";
        }

        //encode for save
        $this->encoded_pages = base64_encode(serialize($this->unencoded_pages));
        $this->encoded_dashlets = base64_encode(serialize($this->unencoded_dashlets));

        return parent::save($check_notify);
    }

    /**
    * Sets the currently retrieved dashboard backup to a user
    *
    * @param object $userObj User Obj to set dashboard
    */
    function setDashboardForUser($userObj)
    {
        $userObj->setPreference('dashlets', $this->unencoded_dashlets, 0, 'Home');
        $userObj->setPreference('pages', $this->unencoded_pages, 0, 'Home');
        $userObj->savePreferencesToDB();
    }

    /**
    * Sets a backup back to its owner
    * @return string $full_name full name of updated user
    */
    function restoreDashboardForAssignedUser()
    {
        if (!empty($this->assigned_user_id))
        {
            $userObj = BeanFactory::getBean("Users", $this->assigned_user_id);

            //update user dashboard
            $userObj->setPreference('dashlets', $this->unencoded_dashlets, 0, 'Home');
            $userObj->setPreference('pages', $this->unencoded_pages, 0, 'Home');
            $userObj->savePreferencesToDB();

            return $userObj->full_name;
        }

        return "";
    }

    /**
    * Saves a backup of the users dashboard
    *
    * @param boolean $check_notify Optional, default false, if set to true assignee of the record is notified via email.
    * @return string $this->save() id of new record
    */
    function createDashboardBackup($dm_id, $name, $description = '', $userObj = null, $default = false)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        $GLOBALS['log']->info("Dashboard Manager :: Creating Dashboard Backup | Template: {$dm_id} / User: {$userObj->user_name} / Type: {$name}");

        $this->name = $name;
        $this->description = $description;
        $this->unencoded_pages = $userObj->getPreference('pages', 'Home');
        $this->unencoded_dashlets = $userObj->getPreference('dashlets', 'Home');
        $this->assigned_user_id = $userObj->id;
        $this->dash_dashb2ea8manager_ida = $dm_id;

        if ($default)
        {
            $this->user_default = '1';
        }

        return $this->save();
    }

    /**
    * Checks if a user has a dashboard backup
    *
    * @param object $userObj User Obj to set dashboard
    * @return boolean/string $hasBackup false if no backup, id string if so
    */
    function checkUserForDashboardBackup($userObj = null)
    {
        if (empty($userObj))
        {
            global $current_user;
            $userObj = $current_user;
        }

        $hasBackup = false;

        $results = $this->get_list("", "assigned_user_id='{$userObj->id}' and user_default = '1'");

        if (count($results['list']) > 0)
        {
            foreach ($results['list'] as $backup)
            {
                $hasBackup = $backup->id;
                break;
            }
        }

        return $hasBackup;
    }

	
}
?>