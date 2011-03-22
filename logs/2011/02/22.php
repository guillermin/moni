<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-02-22 12:11:44 --- ERROR: ReflectionException [ -1 ]: Class controller_movements does not exist ~ SYSPATH/classes/kohana/request.php [ 1178 ]
2011-02-22 15:57:32 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'movement.timestamp' in 'order clause' [ SELECT `transfers`.* FROM `transfers` WHERE `transfers`.`equity_id` = '2' ORDER BY `movement`.`timestamp` ASC ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 179 ]
2011-02-22 16:13:22 --- ERROR: ErrorException [ 8 ]: Undefined variable: trasnfer ~ APPPATH/views/html/equity/movements.php [ 10 ]
2011-02-22 16:23:16 --- ERROR: ErrorException [ 1 ]: Class 'Model_Drain' not found ~ MODPATH/orm/classes/kohana/orm.php [ 118 ]
2011-02-22 16:23:36 --- ERROR: ErrorException [ 1 ]: Class 'Model_Drain' not found ~ MODPATH/orm/classes/kohana/orm.php [ 118 ]
2011-02-22 16:23:59 --- ERROR: ErrorException [ 1 ]: Class 'Model_Drain' not found ~ MODPATH/orm/classes/kohana/orm.php [ 118 ]
2011-02-22 16:24:04 --- ERROR: ErrorException [ 1 ]: Class 'Model_Drain' not found ~ MODPATH/orm/classes/kohana/orm.php [ 118 ]