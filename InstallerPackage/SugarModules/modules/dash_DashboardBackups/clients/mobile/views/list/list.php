<?php
$module_name = 'dash_DashboardBackups';
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
                'name' => 'description',
                'label' => 'LBL_DESCRIPTION',
                'enabled' => true,
                'sortable' => false,
                'width' => '10%',
                'default' => true,
              ),
              2 => 
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
