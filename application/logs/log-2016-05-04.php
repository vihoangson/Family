<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-05-04 09:49:37 --> Severity: Parsing Error --> syntax error, unexpected '$this' (T_VARIABLE) D:\xampp\htdocs\vhosts\family\application\models\MY_Kyniem.php 35
ERROR - 2016-05-04 09:49:59 --> Severity: Parsing Error --> syntax error, unexpected 'parent' (T_STRING) D:\xampp\htdocs\vhosts\family\application\models\MY_Kyniem.php 47
ERROR - 2016-05-04 09:50:30 --> Severity: error --> Exception: D:\xampp\htdocs\vhosts\family\application\models/MY_Kyniem.php exists, but doesn't declare class MY_Kyniem D:\xampp\htdocs\vhosts\family\system\core\Loader.php 306
ERROR - 2016-05-04 09:51:04 --> Severity: error --> Exception: D:\xampp\htdocs\vhosts\family\application\models/MY_Kyniem.php exists, but doesn't declare class MY_Kyniem D:\xampp\htdocs\vhosts\family\system\core\Loader.php 306
ERROR - 2016-05-04 09:51:09 --> Severity: error --> Exception: D:\xampp\htdocs\vhosts\family\application\models/MY_Kyniem.php exists, but doesn't declare class MY_Kyniem D:\xampp\htdocs\vhosts\family\system\core\Loader.php 306
ERROR - 2016-05-04 09:52:20 --> Severity: error --> Exception: D:\xampp\htdocs\vhosts\family\application\models/My_kyniem.php exists, but doesn't declare class My_kyniem D:\xampp\htdocs\vhosts\family\system\core\Loader.php 306
ERROR - 2016-05-04 11:38:53 --> Severity: Error --> Call to a member function get_all() on null D:\xampp\htdocs\vhosts\family\application\controllers\blog\Blog_controller.php 21
ERROR - 2016-05-04 11:39:15 --> Severity: Error --> Call to a member function get_all() on null D:\xampp\htdocs\vhosts\family\application\controllers\blog\Blog_controller.php 21
ERROR - 2016-05-04 11:42:04 --> Query error: table blog has no column named created_at - Invalid query: INSERT INTO "blog" ("blog_title", "blog_content", "created_at") VALUES ('adfasd', '<p>fasdfasdf</p>', '2016-05-04 11:42:04')
ERROR - 2016-05-04 11:44:01 --> Severity: Error --> Cannot access protected property Blog::$timestamps D:\xampp\htdocs\vhosts\family\application\controllers\blog\Blog_controller.php 10
ERROR - 2016-05-04 11:47:14 --> Severity: Error --> Cannot access protected property Blog::$timestamps D:\xampp\htdocs\vhosts\family\application\controllers\blog\Blog_controller.php 10
ERROR - 2016-05-04 11:48:55 --> Query error: table blog has no column named created_at - Invalid query: INSERT INTO "blog" ("blog_title", "blog_content", "created_at") VALUES ('ádfa', '<p>sdfasdf</p>', '2016-05-04 11:48:55')
ERROR - 2016-05-04 11:54:24 --> Query error: table blog has no column named create_at - Invalid query: INSERT INTO "blog" ("blog_title", "blog_content", "create_at") VALUES ('asdf', '<p>adf</p>', '2016-05-04 11:54:24')
ERROR - 2016-05-04 11:57:12 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\vhosts\family\application\views\blog\index.php 13
ERROR - 2016-05-04 12:54:23 --> Severity: Error --> Call to a member function write_log() on null D:\xampp\htdocs\vhosts\family\application\models\BlogComment.php 20
ERROR - 2016-05-04 13:12:36 --> Query error: near ".": syntax error - Invalid query: SELECT "`blogcomment`"."`blog_id`", "`blogcomment`"."`"..."`"
FROM "BlogComment"
WHERE "BlogComment"."blog_id" IN('1')
ERROR - 2016-05-04 13:12:46 --> Query error: no such column: `blogcomment`.`blog_id` - Invalid query: SELECT "`blogcomment`"."`blog_id`", "`blogcomment`"."`*`"
FROM "BlogComment"
WHERE "BlogComment"."blog_id" IN('1')
ERROR - 2016-05-04 13:13:13 --> Query error: no such column: `blogcomment`.`blog_id` - Invalid query: SELECT "`blogcomment`"."`blog_id`", "`blogcomment`"."`*`"
FROM "BlogComment"
WHERE "BlogComment"."blog_id" IN('1')
ERROR - 2016-05-04 13:13:19 --> Query error: near ".": syntax error - Invalid query: SELECT "`blogcomment`"."`blog_id`", "`blogcomment`"."`"..."`"
FROM "BlogComment"
WHERE "BlogComment"."blog_id" IN('1')
ERROR - 2016-05-04 13:18:02 --> Query error: no such column: `blogcomment`.`blog_id` - Invalid query: SELECT "`blogcomment`"."`blog_id`", "`blogcomment`"."`id`"
FROM "BlogComment"
WHERE "BlogComment"."blog_id" IN('1', '2')
ERROR - 2016-05-04 13:18:14 --> Query error: no such column: `blogcomment`.`blog_id` - Invalid query: SELECT "`blogcomment`"."`blog_id`", "`blogcomment`"."`blog_id`"
FROM "BlogComment"
WHERE "BlogComment"."blog_id" IN('1', '2')
ERROR - 2016-05-04 13:19:58 --> Query error: no such column: `blogcomment`.`blog_id` - Invalid query: SELECT COUNT(*) AS counted_rows, "BlogComment"."blog_id"
FROM "BlogComment"
WHERE "BlogComment"."blog_id" IN('1', '2')
GROUP BY "`blogcomment`"."`blog_id`"
ERROR - 2016-05-04 13:25:12 --> Query error: no such column: `blogcomment`.`blog_id` - Invalid query: SELECT COUNT(*) AS counted_rows, "BlogComment"."blog_id"
FROM "BlogComment"
WHERE "BlogComment"."blog_id" IN('1', '2')
GROUP BY "`blogcomment`"."`blog_id`"
ERROR - 2016-05-04 13:31:32 --> Query error: no such column: `blogcomment`.`blog_id` - Invalid query: SELECT COUNT(*) AS counted_rows, "BlogComment"."blog_id"
FROM "BlogComment"
WHERE "BlogComment"."blog_id" IN('1', '2')
GROUP BY "`blogcomment`"."`blog_id`"
