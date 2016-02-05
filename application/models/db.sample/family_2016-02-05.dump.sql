----
-- phpLiteAdmin database dump (https://bitbucket.org/phpliteadmin/public)
-- phpLiteAdmin version: 1.9.6
-- Exported: 4:41pm on February 5, 2016 (ICT)
-- database file: application/models/db/family
----
BEGIN TRANSACTION;

----
-- Table structure for kyniem
----
CREATE TABLE 'kyniem' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'kyniem_title' TEXT NOT NULL, 'kyniem_content' TEXT, 'kyniem_images' TEXT, 'kyniem_create' DATETIME NOT NULL, 'kyniem_modifie' DATETIME NOT NULL, 'kyniem_auth' TEXT NOT NULL DEFAULT 'Bố', 'delete_flg' INTEGER NOT NULL DEFAULT 0);

----
-- Table structure for user
----
CREATE TABLE 'user' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'username' TEXT NOT NULL, 'password' TEXT NOT NULL, 'type' INTEGER NOT NULL DEFAULT 0 );

----
-- Table structure for timeline
----
CREATE TABLE 'timeline' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'timeline_title' TEXT, 'timeline_date' DATETIME, 'timeline_tag' TEXT, 'timeline_note' TEXT, 'timeline_image' REAL, 'timeline_create' DATETIME, 'timeline_modifie' TEXT, 'delete_flg' INTEGER NOT NULL DEFAULT 0);

----
-- Table structure for files
----
CREATE TABLE 'files' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'files_name' TEXT NOT NULL, 'files_path' TEXT, 'files_size' REAL, 'files_type' TEXT, 'delete_flg' INTEGER NOT NULL DEFAULT 0 , 'files_title' TEXT);

----
-- Table structure for comment
----
CREATE TABLE 'comment' ('id' INTEGER PRIMARY KEY NOT NULL, 'kyniem_id' INTEGER, 'comment_content' TEXT, 'comment_user' TEXT, 'kyniem_create' DATETIME, 'kyniem_modifie' DATETIME);
COMMIT;
