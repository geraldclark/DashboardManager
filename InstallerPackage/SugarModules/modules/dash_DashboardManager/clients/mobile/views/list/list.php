<?php
$module_name = 'dash_DashboardManager';
$viewdefs[$module_name] = 
array (
  'mobile' => 
  array (
    'view' => 
    array (
      'list' => 
      array (
        'panels' => 
        array (
          0 => 
          array (
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'name',
                'default' => true,
                'enabled' => true,
                'width' => '32%',
                'label' => 'LBL_NAME',
                'link' => true,
              ),
              1 => 
              array (
                'name' => 'assigned_user_name',
                'default' => true,
                'enabled' => true,
                'width' => '9%',
                'label' => 'LBL_ASSIGNED_TO_NAME',
              ),
              2 => 
              array (
                'name' => 'user_default',
                'label' => 'LBL_USER_DEFAULT',
                'enabled' => true,
                'width' => '10%',
                'default' => true,
              ),
              3 => 
              array (
                'name' => 'date_entered',
                'label' => 'LBL_DATE_ENTERED',
                'enabled' => true,
                'width' => '10%',
                'default' => true,
              ),
            ),
          ),
        ),
      ),
    ),
  ),
);
