<?php

	if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

	class DashboardManager_User_Hooks
	{
	        function forceRelationshipPolicy(&$bean, $event, $arguments)
	        {
	            if (
	                isset($arguments['module']) && $arguments['module'] == 'Users'
	                && isset($arguments['related_module']) && $arguments['related_module'] == 'dash_DashboardManager'
	                && isset($arguments['link']) && !empty($arguments['link'])
	                && isset($arguments['relationship']) && !empty($arguments['relationship'])
	                && isset($arguments['related_id']) && !empty($arguments['related_id'])
	                && isset($arguments['id']) && !empty($arguments['id'])
	               )
	            {
	                require_once("modules/dash_DashboardManager/dash_DashboardManager.php");
	
	                $dashManagerObj = new dash_DashboardManager();
	                $dashManagerObj->retrieve($arguments['related_id']);
	                $dashManagerObj->forceRelationshipPolicy($arguments['relationship'], $bean);
	            }
	        }
	}

?>
