<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-02-13 00:05:32 --- ERROR: Database_Exception [ 1045 ]: Access denied for user 'apache'@'localhost' (using password: NO) ~ MODPATH/database/classes/kohana/database/mysql.php [ 67 ]
2011-02-13 00:05:42 --- ERROR: ErrorException [ 8 ]: Undefined index:  id ~ MODPATH/orm/classes/kohana/orm.php [ 1324 ]
2011-02-13 13:00:34 --- ERROR: Database_Exception [ 1045 ]: Access denied for user 'apache'@'localhost' (using password: NO) ~ MODPATH/database/classes/kohana/database/mysql.php [ 67 ]
2011-02-13 13:43:25 --- ERROR: ErrorException [ 8 ]: Undefined index:  id ~ MODPATH/orm/classes/kohana/orm.php [ 1324 ]
2011-02-13 15:06:13 --- ERROR: Database_Exception [ 1062 ]: Duplicate entry '11-2' for key 'movement_source' [ INSERT INTO `incomes` (`movement_id`, `source_id`, `amount`) VALUES (11, '2', 120000) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 179 ]
2011-02-13 15:11:43 --- ERROR: Kohana_Exception [ 0 ]: The parent_id property does not exist in the Model_Income class ~ MODPATH/orm/classes/kohana/orm.php [ 379 ]
2011-02-13 15:37:20 --- ERROR: Database_Exception [ 1062 ]: Duplicate entry '12-2' for key 'movement_source' [ INSERT INTO `incomes` (`movement_id`, `source_id`, `amount`) VALUES (12, '2', 120000) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 179 ]