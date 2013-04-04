<?php
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Master Subscription
 * Agreement ("License") which can be viewed at
 * http://www.sugarcrm.com/crm/master-subscription-agreement
 * By installing or using this file, You have unconditionally agreed to the
 * terms and conditions of the License, and You may not use this file except in
 * compliance with the License.  Under the terms of the license, You shall not,
 * among other things: 1) sublicense, resell, rent, lease, redistribute, assign
 * or otherwise transfer Your rights to the Software, and 2) use the Software
 * for timesharing or service bureau purposes such as hosting the Software for
 * commercial gain and/or for the benefit of a third party.  Use of the Software
 * may be subject to applicable fees and any use of the Software without first
 * paying applicable fees is strictly prohibited.  You do not have the right to
 * remove SugarCRM copyrights from the source code or user interface.
 *
 * All copies of the Covered Code must include on each user interface screen:
 *  (i) the "Powered by SugarCRM" logo and
 *  (ii) the SugarCRM copyright notice
 * in the same form as they appear in the distribution.  See full license for
 * requirements.
 *
 * Your Warranty, Limitations of liability and Indemnity are expressly stated
 * in the License.  Please refer to the License for the specific language
 * governing these rights and limitations under the License.  Portions created
 * by SugarCRM are Copyright (C) 2004-2012 SugarCRM, Inc.; All Rights Reserved.
 ********************************************************************************/

$manifest = array (
    'acceptable_sugar_versions' => array (
        'regex_matches' => array ('6\\.5\\.(.*?)', '6\\.6\\.(.*?)', '6\\.6\\.(.*?)\\.(.*?)', '6\\.7\\.(.*?)', '6\\.7\\.(.*?)\\.(.*?)'),
    ),
    'acceptable_sugar_flavors' => array ('CE','PRO','CORP','ENT','ULT'),
    'readme' => '',
    'key' => 'dash',
    'author' => 'jclark',
    'description' => 'Dashboard Manager: Supported on 6.5.x, 6.6.x, 6.7.x',
    'icon' => '',
    'is_uninstallable' => true,
    'name' => 'Dashboard Manager',
    'published_date' => '2013-04-04 09:11:12',
    'type' => 'module',
    'version' => '1.7',
    'remove_tables' => 'prompt',
);

$installdefs = array (
  'id' => 'DashboardManager',
  'logic_hooks' => array(
        array(
            'module' => 'Users',
            'hook' => 'after_relationship_add',
            'order' => 3,
            'description' => 'Force Relationship Policy',
            'file' => 'modules/dash_DashboardManager/logic_hooks/DashboardManager_User_Hooks.php',
            'class' => 'DashboardManager_User_Hooks',
            'function' => 'forceRelationshipPolicy',
        ),
  ),
  'beans' => 
  array (
    0 => 
    array (
      'module' => 'dash_DashboardBackups',
      'class' => 'dash_DashboardBackups',
      'path' => 'modules/dash_DashboardBackups/dash_DashboardBackups.php',
      'tab' => false,
    ),
    1 => 
    array (
      'module' => 'dash_DashboardManager',
      'class' => 'dash_DashboardManager',
      'path' => 'modules/dash_DashboardManager/dash_DashboardManager.php',
      'tab' => false,
    ),
  ),
  'layoutdefs' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/layoutdefs/dash_dashboardbackups_dash_dashboardmanager_dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/layoutdefs/dash_dashboardmanager_users_dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
    ),
    2 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/layoutdefs/dash_dashboardmanager_users_2_dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
    ),
    3 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/layoutdefs/dash_dashboardmanager_users_1_dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
    ),
  ),
  'relationships' => 
  array (
    0 => 
    array (
      'meta_data' => '<basepath>/SugarModules/relationships/relationships/dash_dashboardbackups_dash_dashboardmanagerMetaData.php',
    ),
    1 => 
    array (
      'meta_data' => '<basepath>/SugarModules/relationships/relationships/dash_dashboardmanager_usersMetaData.php',
    ),
    2 => 
    array (
      'meta_data' => '<basepath>/SugarModules/relationships/relationships/dash_dashboardmanager_users_2MetaData.php',
    ),
    3 => 
    array (
      'meta_data' => '<basepath>/SugarModules/relationships/relationships/dash_dashboardmanager_users_1MetaData.php',
    ),
  ),
  'image_dir' => '<basepath>/icons',
  'copy' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/modules/dash_DashboardBackups',
      'to' => 'modules/dash_DashboardBackups',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/modules/dash_DashboardManager',
      'to' => 'modules/dash_DashboardManager',
    ),
    2 =>
    array (
        'from' => '<basepath>/Files/custom/modules/Home/index.php',
        'to' => 'custom/modules/Home/index.php',
    ),
  ),
  'language' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'en_us',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'bg_BG',
    ),
    2 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'cs_CZ',
    ),
    3 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'da_DK',
    ),
    4 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'de_DE',
    ),
    5 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'es_ES',
    ),
    6 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'et_EE',
    ),
    7 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.fr_FR.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'fr_FR',
    ),
    8 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'he_IL',
    ),
    9 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'hu_HU',
    ),
    10 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'it_it',
    ),
    11 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'lt_LT',
    ),
    12 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'ja_JP',
    ),
    13 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'nb_NO',
    ),
    14 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'nl_NL',
    ),
    15 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'pl_PL',
    ),
    16 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'pt_PT',
    ),
    17 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'ro_RO',
    ),
    18 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'ru_RU',
    ),
    19 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'sv_SE',
    ),
    20 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'tr_TR',
    ),
    21 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'zh_CN',
    ),
    22 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'pt_br',
    ),
    23 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'ca_ES',
    ),
    24 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'en_UK',
    ),
    25 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
      'language' => 'sr_RS',
    ),
    26 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'en_us',
    ),
    27 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'bg_BG',
    ),
    28 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'cs_CZ',
    ),
    29 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'da_DK',
    ),
    30 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'de_DE',
    ),
    31 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'es_ES',
    ),
    32 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'et_EE',
    ),
    33 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.fr_FR.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'fr_FR',
    ),
    34 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'he_IL',
    ),
    35 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'hu_HU',
    ),
    36 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'it_it',
    ),
    37 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'lt_LT',
    ),
    38 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'ja_JP',
    ),
    39 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'nb_NO',
    ),
    40 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'nl_NL',
    ),
    41 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'pl_PL',
    ),
    42 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'pt_PT',
    ),
    43 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'ro_RO',
    ),
    44 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'ru_RU',
    ),
    45 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'sv_SE',
    ),
    46 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'tr_TR',
    ),
    47 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'zh_CN',
    ),
    48 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'pt_br',
    ),
    49 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'ca_ES',
    ),
    50 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'en_UK',
    ),
    51 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'sr_RS',
    ),
    52 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'en_us',
    ),
    53 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'bg_BG',
    ),
    54 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'cs_CZ',
    ),
    55 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'da_DK',
    ),
    56 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'de_DE',
    ),
    57 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'es_ES',
    ),
    58 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'et_EE',
    ),
    59 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.fr_FR.php',
      'to_module' => 'Users',
      'language' => 'fr_FR',
    ),
    60 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'he_IL',
    ),
    61 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'hu_HU',
    ),
    62 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'it_it',
    ),
    63 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'lt_LT',
    ),
    64 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ja_JP',
    ),
    65 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'nb_NO',
    ),
    66 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'nl_NL',
    ),
    67 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'pl_PL',
    ),
    68 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'pt_PT',
    ),
    69 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ro_RO',
    ),
    70 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ru_RU',
    ),
    71 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'sv_SE',
    ),
    72 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'tr_TR',
    ),
    73 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'zh_CN',
    ),
    74 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'pt_br',
    ),
    75 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ca_ES',
    ),
    76 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'en_UK',
    ),
    77 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'sr_RS',
    ),
    78 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'en_us',
    ),
    79 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'bg_BG',
    ),
    80 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'cs_CZ',
    ),
    81 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'da_DK',
    ),
    82 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'de_DE',
    ),
    83 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'es_ES',
    ),
    84 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'et_EE',
    ),
    85 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.fr_FR.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'fr_FR',
    ),
    86 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'he_IL',
    ),
    87 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'hu_HU',
    ),
    88 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'it_it',
    ),
    89 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'lt_LT',
    ),
    90 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'ja_JP',
    ),
    91 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'nb_NO',
    ),
    92 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'nl_NL',
    ),
    93 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'pl_PL',
    ),
    94 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'pt_PT',
    ),
    95 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'ro_RO',
    ),
    96 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'ru_RU',
    ),
    97 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'sv_SE',
    ),
    98 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'tr_TR',
    ),
    99 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'zh_CN',
    ),
    100 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'pt_br',
    ),
    101 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'ca_ES',
    ),
    102 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'en_UK',
    ),
    103 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'sr_RS',
    ),
    104 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'en_us',
    ),
    105 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'bg_BG',
    ),
    106 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'cs_CZ',
    ),
    107 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'da_DK',
    ),
    108 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'de_DE',
    ),
    109 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'es_ES',
    ),
    110 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'et_EE',
    ),
    111 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.fr_FR.php',
      'to_module' => 'Users',
      'language' => 'fr_FR',
    ),
    112 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'he_IL',
    ),
    113 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'hu_HU',
    ),
    114 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'it_it',
    ),
    115 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'lt_LT',
    ),
    116 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ja_JP',
    ),
    117 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'nb_NO',
    ),
    118 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'nl_NL',
    ),
    119 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'pl_PL',
    ),
    120 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'pt_PT',
    ),
    121 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ro_RO',
    ),
    122 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ru_RU',
    ),
    123 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'sv_SE',
    ),
    124 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'tr_TR',
    ),
    125 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'zh_CN',
    ),
    126 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'pt_br',
    ),
    127 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ca_ES',
    ),
    128 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'en_UK',
    ),
    129 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'sr_RS',
    ),
    130 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'en_us',
    ),
    131 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'bg_BG',
    ),
    132 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'cs_CZ',
    ),
    133 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'da_DK',
    ),
    134 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'de_DE',
    ),
    135 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'es_ES',
    ),
    136 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'et_EE',
    ),
    137 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.fr_FR.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'fr_FR',
    ),
    138 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'he_IL',
    ),
    139 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'hu_HU',
    ),
    140 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'it_it',
    ),
    141 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'lt_LT',
    ),
    142 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'ja_JP',
    ),
    143 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'nb_NO',
    ),
    144 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'nl_NL',
    ),
    145 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'pl_PL',
    ),
    146 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'pt_PT',
    ),
    147 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'ro_RO',
    ),
    148 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'ru_RU',
    ),
    149 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'sv_SE',
    ),
    150 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'tr_TR',
    ),
    151 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'zh_CN',
    ),
    152 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'pt_br',
    ),
    153 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'ca_ES',
    ),
    154 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'en_UK',
    ),
    155 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'sr_RS',
    ),
    156 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'en_us',
    ),
    157 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'bg_BG',
    ),
    158 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'cs_CZ',
    ),
    159 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'da_DK',
    ),
    160 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'de_DE',
    ),
    161 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'es_ES',
    ),
    162 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'et_EE',
    ),
    163 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.fr_FR.php',
      'to_module' => 'Users',
      'language' => 'fr_FR',
    ),
    164 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'he_IL',
    ),
    165 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'hu_HU',
    ),
    166 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'it_it',
    ),
    167 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'lt_LT',
    ),
    168 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ja_JP',
    ),
    169 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'nb_NO',
    ),
    170 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'nl_NL',
    ),
    171 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'pl_PL',
    ),
    172 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'pt_PT',
    ),
    173 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ro_RO',
    ),
    174 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ru_RU',
    ),
    175 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'sv_SE',
    ),
    176 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'tr_TR',
    ),
    177 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'zh_CN',
    ),
    178 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'pt_br',
    ),
    179 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ca_ES',
    ),
    180 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'en_UK',
    ),
    181 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'sr_RS',
    ),
    182 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'en_us',
    ),
    183 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'bg_BG',
    ),
    184 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'cs_CZ',
    ),
    185 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'da_DK',
    ),
    186 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'de_DE',
    ),
    187 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'es_ES',
    ),
    188 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'et_EE',
    ),
    189 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.fr_FR.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'fr_FR',
    ),
    190 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'he_IL',
    ),
    191 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'hu_HU',
    ),
    192 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'it_it',
    ),
    193 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'lt_LT',
    ),
    194 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'ja_JP',
    ),
    195 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'nb_NO',
    ),
    196 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'nl_NL',
    ),
    197 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'pl_PL',
    ),
    198 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'pt_PT',
    ),
    199 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'ro_RO',
    ),
    200 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'ru_RU',
    ),
    201 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'sv_SE',
    ),
    202 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'tr_TR',
    ),
    203 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'zh_CN',
    ),
    204 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'pt_br',
    ),
    205 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'ca_ES',
    ),
    206 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'en_UK',
    ),
    207 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
      'language' => 'sr_RS',
    ),
    208 => 
    array (
      'from' => '<basepath>/SugarModules/language/application/en_us.lang.php',
      'to_module' => 'application',
      'language' => 'en_us',
    ),
    209 =>
    array (
      'from' => '<basepath>/SugarModules/language/application/fr_FR.lang.php',
      'to_module' => 'application',
      'language' => 'fr_FR',
    ),    
    210 =>
    array (
      'from' => '<basepath>/Files/custom/Extension/modules/Administration/Ext/Language/DashboardManager.php',
      'to_module' => 'Administration',
      'language' => 'en_us',
    ),
    211 =>
    array (
      'from' => '<basepath>/Files/custom/Extension/modules/Administration/Ext/Language/DashboardManager.fr_FR.php',
      'to_module' => 'Administration',
      'language' => 'fr_FR',
    ),    
    212 =>
    array (
      'from' => '<basepath>/Files/custom/Extension/modules/Home/Ext/Language/DashboardManager.php',
      'to_module' => 'Home',
      'language' => 'en_us',
    ),
    213 =>
    array (
      'from' => '<basepath>/Files/custom/Extension/modules/Home/Ext/Language/DashboardManager.fr_FR.php',
      'to_module' => 'Home',
      'language' => 'fr_FR',
    ),
  ),
  'administration'=>
  array(
    array (
      'from' => '<basepath>/Files/custom/Extension/modules/Administration/Ext/Administration/DashboardManager.php',
    ),
  ),
  'vardefs' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/vardefs/dash_dashboardbackups_dash_dashboardmanager_dash_DashboardBackups.php',
      'to_module' => 'dash_DashboardBackups',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/vardefs/dash_dashboardbackups_dash_dashboardmanager_dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
    ),
    2 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/vardefs/dash_dashboardmanager_users_Users.php',
      'to_module' => 'Users',
    ),
    3 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/vardefs/dash_dashboardmanager_users_dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
    ),
    4 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/vardefs/dash_dashboardmanager_users_2_Users.php',
      'to_module' => 'Users',
    ),
    5 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/vardefs/dash_dashboardmanager_users_2_dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
    ),
    6 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/vardefs/dash_dashboardmanager_users_1_Users.php',
      'to_module' => 'Users',
    ),
    7 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/vardefs/dash_dashboardmanager_users_1_dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
    ),
  ),
  'layoutfields' => 
  array (
  ),
  'wireless_subpanels' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/wirelesslayoutdefs/dash_dashboardbackups_dash_dashboardmanager_dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/wirelesslayoutdefs/dash_dashboardmanager_users_dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
    ),
    2 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/wirelesslayoutdefs/dash_dashboardmanager_users_2_dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
    ),
    3 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/wirelesslayoutdefs/dash_dashboardmanager_users_1_dash_DashboardManager.php',
      'to_module' => 'dash_DashboardManager',
    ),
  ),
);
