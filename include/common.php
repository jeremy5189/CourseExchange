<?php
session_start();
date_default_timezone_set("Asia/Taipei");

/* 
 * -------------------------
 *    DB Config File 
 * -------------------------
 */
 
include_once('config.php');


/*
 * -------------------------
 *   include/fb-login.php
 * -------------------------
 */
 
define( 'SQL_REGISTER_FB', "INSERT INTO `{$prefix}user` (`FBID`, `name`, `email`, `gender`, `locale`, `link`, `token`, `expiresin`, `jointime`, `updatetime`) VALUE (:FBID, :name, :email, :gender, :locale, :link, :token, :expiresin, :jointime, :updatetime)" );

define('SQL_UPDATE_USER',"UPDATE `{$prefix}user` SET `token` = :token, `expiresin` = :expiresin, `updatetime` = :updatetime WHERE `FBID` = :FBID" );  
 
define( 'SQL_RECORD_LOGIN', "INSERT INTO `{$prefix}log` (`FBID`, `time`, `ip`) VALUE( :FBID, :time, :ip)"); 
 
define( 'SQL_REG_FIND_REPEAT', "SELECT * FROM `{$prefix}user` WHERE `FBID` = ?" );

/*
 * -------------------------
 *   include/select-un.php
 * -------------------------
 */
 
define('SQL_SET_UNIVERSITY', "UPDATE `{$prefix}user` SET `university` = :university WHERE `FBID` = :FBID" );

/*
 * -------------------------
 *   select.php
 * -------------------------
 */

define('SQL_LIST_UNIVERSITY', "SELECT * FROM {$prefix}university ORDER BY `id`");

/*
 * -------------------------
 *   add.php
 * -------------------------
 */

define("SQL_ADD_COURSE", "INSERT INTO `{$prefix}course` (`FBID`, `changeID`, `changeName`, `wantID`, `wantName`, `university`,`status`) VALUES ( :FBID, :changeID, :changeName, :wantID, :wantName, :university, :status)");