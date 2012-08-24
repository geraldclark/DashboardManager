<?php

    //Dashboard Manager Panel
    $admin_option_defs=array();
    $admin_option_defs['Administration']['DashboardManager_DashboardManager'] = array('ModuleLoader','LBL_DASHBOARD_MANAGER','LBL_DASHBOARD_MANAGER_DESCRIPTION','index.php?module=dash_DashboardManager');
    $admin_option_defs['Administration']['DashboardManager_DashboardBackup'] = array('Backups','LBL_DASHBOARD_BACKUPS','LBL_DASHBOARD_BACKUPS_DESCRIPTION','index.php?module=dash_DashboardBackups');
    $admin_group_header[]= array('LBL_DASHBOARD_MANAGEMENT', '', false, $admin_option_defs, '');
