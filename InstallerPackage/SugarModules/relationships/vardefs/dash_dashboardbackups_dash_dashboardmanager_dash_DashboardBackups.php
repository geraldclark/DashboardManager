<?php
// created: 2012-08-23 23:17:02
$dictionary["dash_DashboardBackups"]["fields"]["dash_dashboardbackups_dash_dashboardmanager"] = array (
  'name' => 'dash_dashboardbackups_dash_dashboardmanager',
  'type' => 'link',
  'relationship' => 'dash_dashboardbackups_dash_dashboardmanager',
  'source' => 'non-db',
  'vname' => 'LBL_DASH_DASHBOARDBACKUPS_DASH_DASHBOARDMANAGER_FROM_DASH_DASHBOARDMANAGER_TITLE',
  'id_name' => 'dash_dashb2ea8manager_ida',
);
$dictionary["dash_DashboardBackups"]["fields"]["dash_dashboardbackups_dash_dashboardmanager_name"] = array (
  'name' => 'dash_dashboardbackups_dash_dashboardmanager_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_DASH_DASHBOARDBACKUPS_DASH_DASHBOARDMANAGER_FROM_DASH_DASHBOARDMANAGER_TITLE',
  'save' => true,
  'id_name' => 'dash_dashb2ea8manager_ida',
  'link' => 'dash_dashboardbackups_dash_dashboardmanager',
  'table' => 'dash_dashboardmanager',
  'module' => 'dash_DashboardManager',
  'rname' => 'name',
);
$dictionary["dash_DashboardBackups"]["fields"]["dash_dashb2ea8manager_ida"] = array (
  'name' => 'dash_dashb2ea8manager_ida',
  'type' => 'link',
  'relationship' => 'dash_dashboardbackups_dash_dashboardmanager',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_DASH_DASHBOARDBACKUPS_DASH_DASHBOARDMANAGER_FROM_DASH_DASHBOARDBACKUPS_TITLE',
);
