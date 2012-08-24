<?php
// created: 2012-08-23 23:17:02
$dictionary["dash_dashboardmanager_users_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'dash_dashboardmanager_users_1' => 
    array (
      'lhs_module' => 'dash_DashboardManager',
      'lhs_table' => 'dash_dashboardmanager',
      'lhs_key' => 'id',
      'rhs_module' => 'Users',
      'rhs_table' => 'users',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'dash_dashboardmanager_users_1_c',
      'join_key_lhs' => 'dash_dashboardmanager_users_1dash_dashboardmanager_ida',
      'join_key_rhs' => 'dash_dashboardmanager_users_1users_idb',
    ),
  ),
  'table' => 'dash_dashboardmanager_users_1_c',
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
      'name' => 'dash_dashboardmanager_users_1dash_dashboardmanager_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'dash_dashboardmanager_users_1users_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'dash_dashboardmanager_users_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'dash_dashboardmanager_users_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'dash_dashboardmanager_users_1dash_dashboardmanager_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'dash_dashboardmanager_users_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'dash_dashboardmanager_users_1users_idb',
      ),
    ),
  ),
);