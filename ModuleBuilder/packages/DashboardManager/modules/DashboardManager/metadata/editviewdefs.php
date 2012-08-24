<?php
$module_name = 'dash_DashboardManager';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'includes'=> array(
        array('file'=>'modules/dash_DashboardManager/lib/jquery-1.7.2.min.js'),
        array('file'=>'modules/dash_DashboardManager/views/edit.js')
      ),
      'maxColumns' => '2',
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
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
        ),
        1 => 
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
?>
