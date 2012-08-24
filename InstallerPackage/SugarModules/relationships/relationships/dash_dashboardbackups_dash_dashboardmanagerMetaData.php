<?php
// created: 2012-08-23 23:17:02
$dictionary["dash_dashboardbackups_dash_dashboardmanager"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'dash_dashboardbackups_dash_dashboardmanager' => 
    array (
      'lhs_module' => 'dash_DashboardManager',
      'lhs_table' => 'dash_dashboardmanager',
      'lhs_key' => 'id',
      'rhs_module' => 'dash_DashboardBackups',
      'rhs_table' => 'dash_dashboardbackups',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'dash_dashboardbackups_dash_dashboardmanager_c',
      'join_key_lhs' => 'dash_dashb2ea8manager_ida',
      'join_key_rhs' => 'dash_dashb4c12backups_idb',
    ),
  ),
  'table' => 'dash_dashboardbackups_dash_dashboardmanager_c',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'dash_dashb2ea8manager_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'dash_dashb4c12backups_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'dash_dashboardbackups_dash_dashboardmanagerspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'dash_dashboardbackups_dash_dashboardmanager_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'dash_dashb2ea8manager_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'dash_dashboardbackups_dash_dashboardmanager_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'dash_dashb4c12backups_idb',
      ),
    ),
  ),
);