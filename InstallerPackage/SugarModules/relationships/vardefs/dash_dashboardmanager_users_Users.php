<?php
// created: 2012-08-23 23:17:02
$dictionary["User"]["fields"]["dash_dashboardmanager_users"] = array (
  'name' => 'dash_dashboardmanager_users',
  'type' => 'link',
  'relationship' => 'dash_dashboardmanager_users',
  'source' => 'non-db',
  'vname' => 'LBL_DASH_DASHBOARDMANAGER_USERS_FROM_DASH_DASHBOARDMANAGER_TITLE',
  'id_name' => 'dash_dashboardmanager_usersdash_dashboardmanager_ida',
);
$dictionary["User"]["fields"]["dash_dashboardmanager_users_name"] = array (
  'name' => 'dash_dashboardmanager_users_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_DASH_DASHBOARDMANAGER_USERS_FROM_DASH_DASHBOARDMANAGER_TITLE',
  'save' => true,
  'id_name' => 'dash_dashboardmanager_usersdash_dashboardmanager_ida',
  'link' => 'dash_dashboardmanager_users',
  'table' => 'dash_dashboardmanager',
  'module' => 'dash_DashboardManager',
  'rname' => 'name',
);
$dictionary["User"]["fields"]["dash_dashboardmanager_usersdash_dashboardmanager_ida"] = array (
  'name' => 'dash_dashboardmanager_usersdash_dashboardmanager_ida',
  'type' => 'link',
  'relationship' => 'dash_dashboardmanager_users',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_DASH_DASHBOARDMANAGER_USERS_FROM_USERS_TITLE',
);
