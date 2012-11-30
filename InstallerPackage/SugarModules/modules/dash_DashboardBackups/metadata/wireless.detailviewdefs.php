<?php
$module_name = 'dash_DashboardBackups';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
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
        'DEFAULT' => 
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
        0 => 'name',
      ),
      1 => 
      array (
        0 => 'assigned_user_name',
      ),
      2 => 
      array (
        0 => 
        array (
          'name' => 'user_default',
          'label' => 'LBL_USER_DEFAULT',
        ),
      ),
      3 => 
      array (
        0 => 
        array (
          'name' => 'date_entered',
          'comment' => 'Date record created',
          'label' => 'LBL_DATE_ENTERED',
        ),
      ),
    ),
  ),
);
?>
