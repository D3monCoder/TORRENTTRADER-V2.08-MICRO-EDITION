# TORRENTTRADER-V2.08-MICRO-EDITION


TORRENTTRADER V2.08 MICRO EDITION INSTALL NOTES
===================================================================

READ FIRST:
===========

- These notes are designed for fresh install only. Below is a checklist of things that you will need
to have before this script will work.

1) You WILL need a google key to use the recaptcha, or you wont even be able to log in. You can also replace the account-login.php
file with one that does not use google if you choose. It is on sourceforge in the "Remove google captcha" folder.
Go to https://www.google.com/recaptcha/intro/ and get your keys. Sign up (its free), enter your info, and set
your keys in backend/config.php. At the top you will see where to put your keys, its clearly labeled. DO THIS FIRST.

Enter API keys in backend/config near the top. The info below is for reference only. You dont need to edit those files.

account-login.php for google captcha is on line 12 & 13 (sign up here https://www.google.com/recaptcha/intro/)
torrents-details.php for traileraddict trailers on line 398 (Send a email request for a key http://www.traileraddict.com/trailerapi)
jw-view-cinema.php for the site videos on line 43 (sign up for your key https://www.jwplayer.com/).

2) This code was tested and modded on ubuntu 14.04.5 server. I wouldn't expect it to function properly under windows server, and
I offer NO help with that. Be smart.....use LINUX.

3) openSSL is required for torrent downloads to work, unless you reverse the edits, which are clearly marked
in the torrents-details.php (start line 132) and backend/functions.php (start line 1266). Install openSSL on your linux server. Its easy, just do it.
The .htaccess file is already in place for everything to work, but you will need to ensure that your apache can use .htaccess.
This is set in your apache2 configuration.

4) OPTIONAL - Go to http://www.projecthoneypot.org/ and sign up (its free). Get your file from them and insert it into the honeypot folder.
This will help prevent spam harvesters from raiding your site for emails and the like. Just an extra measure of security and you should participate if you are able.

5) This script will NOT work under PHP 7.

6) If you are using ubuntu 16, this script will NOT work, as that distro comes packaged with PHP 7, see number 5

7) To have IMDB info added to your files, you need to get an API key from omdb (https://www.omdbapi.com/)
 and place the key in backend/TTIMDB line 3. You will see where it goes

8) You can choose between the regular shoutbox or the Ajshout in the config file as well. Both shoutboxes are independent of each other,
 so anything done in one will not show up in the other.

8.1) (credit UFFENO1 and Tiloup) Added IP checking to the config and account-signup.php. Only 1 account per IP address. This can be changed in config.php

8.2) Language updates (7-22-2018)

9) I added the new forum modifications by UFFENO1 and tiloup (7-7-2018), so if you add any other themes, you need to add this to the theme.css at the bottom for
 each theme. Visit torrenttrader.org for more info.

.forumbutton {
    /*webkit-border-radius: 5px;
   -moz-border-radius: 5px;*/
   border-radius: 2px;
   border: 1px solid #FFF;
   
    /*border: none;*/
      
    padding: 2px;
    -moz-box-shadow: 0 0px 2px 1px #555;
   -webkit-box-shadow: 0 0px 2px 1px#555;
   box-shadow: 0 0px 2px 1px #555;
   
   font-weight: bolder;
   font-family: Arial, Helvetica, sans-serif;
   font-size: 11px;
   text-align: center;
    text-decoration: none;
    display: inline-block;
   
    margin: 2px 2px;
    cursor: pointer;

   background-image: url(images/f-cat-bg.jpg);
   background-repeat: repeat-x;
   background-position: center center;
   border: 1px solid #6a8603;
   box-shadow: 0 0 0 1px rgba(0, 0, 0, 1) inset;
   -webkit-box-shadow: 0 0 0 1px rgba(0, 0, 0, 1) inset;
   -moz-box-shadow: 0 0 0 1px rgba(0, 0, 0, 1) inset;
   }
.forumbutton {
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
}

.forumbutton:hover {
    color: white;
   
}

///end CSS code

TESTED AND WORKING ON:
======================
Ubuntu 14.04.5 server
Mysql Version: 5.5.54-0ubuntu0.14.04.1
PHP Version: 5.5.9-1ubuntu4.21
Apache Version: Apache/2.4.7 (Ubuntu)


REQUIREMENTS:
=============
- PHP 4.3+
- MYSQL 4+
- We do not advise that register_globals is enabled
- We do not advise installation in a windows enviroment, however it will work (you may need to adjust paths)


INSTALLATION:
=============
Please remember to backup all files AND database before you update anything!
FRESH INSTALL INSTRUCTIONS ONLY!!!!

THERE IS NO INSTALLER REQUIRED!

1) Copy ALL files to your webserver

2) Import via phpmyadmin "Database.sql"

3) Edit the file backend/mysql.php to suit your MYSQL connection

4) Edit the file backend/config.php to suit your needs
- special note should be taken for urls, emails, paths (use check.php if unsure)

5) Remove the following line from config.php: die("You didn't edit your config correctly."); // You MUST remove this line  

5) Apply the following CHMOD's
777 - cache/
777 - cache/get_row_count/
777 - cache/queries/
777 - backups/
777 - uploads/
777 - uploads/images/
777 - uploads/imdb/
777 - import/
777 - avatars/
600 - censor.txt

Edit backup-database.php and change the path. Make sure it exists and is chmod 777

if you have any of those folders missing (eg: uploads/images/), please create them and chmod 777

6) Run check.php from your browser to check you have configured everything ok
   check.php is designed for UNIX systems, if you are using WINDOWS it may not report the paths correctly.

7) Now register as a new user on the site.  The first user registered will become administrator

8) If check.php still exists, please remove it or rename.
A warning will display on the site index until its removed

9) You should properly secure backup-database.php and the backups dir. (htaccess/htpasswd)
