<?php
$viewdefs['DashboardBackups'] = 
array (
  'mobile' => 
  array (
    'view' => 
    array (
      'detail' => 
      array (
        'templateMeta' => 
        array (
          'form' => 
          array (
            'buttons' => 
            array (
              0 => 'EDIT',
              1 => 'DUPLICATE',
              2 => 'DELETE',
            ),
          ),
          'maxColumns' => '1',
          'widths' => 
          array (
            0 => 
            array (
              'label' => '10',
              'field' => '30',
            ),
            1 => 
            array (
              'label' => '10',
              'field' => '30',
            ),
          ),
          'useTabs' => false,
          'tabDefs' => 
          array (
            'LBL_PANEL_DEFAULT' => 
            array (
              'newTab' => false,
              'panelDefault' => 'expanded',
            ),
          ),
        ),
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
                'label' => 'LBL_NAME',
              ),
              1 => 
              array (
                'name' => 'assigned_user_name',
                'label' => 'LBL_ASSIGNED_TO_NAME',
              ),
              2 => 
              array (
                'name' => 'user_default',
                'label' => 'LBL_USER_DEFAULT',
              ),
            ),
          ),
        ),
      ),
    ),
  ),
);
