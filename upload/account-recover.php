<?php
//
//  TorrentTrader v2.x
//      $LastChangedDate: 2011-10-30 02:20:54 +0000 (Sun, 30 Oct 2011) $
//      $LastChangedBy: dj-howarth1 $
//
//      http://www.torrenttrader.org
//
//
require_once("backend/functions.php");
dbconn();
session_start();

$site_config["LEFTNAV"] = $site_config["MIDDLENAV"] = $site_config["RIGHTNAV"] = false;
$kind = "0";

if (is_valid_id($_POST["id"]) && strlen($_POST["secret"]) == 32) {
    $password = $_POST["password"];
    $password1 = $_POST["password1"];
    if (empty($password) || empty($password1)) {
        $kind = T_("ERROR");
        $msg =  T_("NO_EMPTY_FIELDS");
    } elseif ($password != $password1) {
        $kind = T_("ERROR");
        $msg = T_("PASSWORD_NO_MATCH");
    } else {
	$n = get_row_count("users", "WHERE `id`=".intval($_POST["id"])." AND MD5(`secret`) = ".sqlesc($_POST["secret"]));
	if ($n != 1)
		show_error_msg(T_("ERROR"), T_("NO_SUCH_USER"));
        $newsec = sqlesc(mksecret());
        SQL_Query_exec("UPDATE `users` SET `password` = '".passhash($password)."', `secret` = $newsec WHERE `id`=".intval($_POST['id'])." AND MD5(`secret`) = ".sqlesc($_POST["secret"]));
        $kind = T_("SUCCESS");
        $msg =  T_("PASSWORD_CHANGED_OK");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_GET["take"] == 1) {
    $email = trim($_POST["email"]);

    if (!validemail($email)) {
        $msg = T_("EMAIL_ADDRESS_NOT_VALID");
        $kind = T_("ERROR");
    }else{
        $res = SQL_Query_exec("SELECT id, username, email FROM users WHERE email=" . sqlesc($email) . " LIMIT 1");
        $arr = mysql_fetch_assoc($res);

        if (!$arr) {
            $msg = T_("EMAIL_ADDRESS_NOT_FOUND");
            $kind = T_("ERROR");
        }
		        $QaptChaInput = $_SESSION['qaptcha_key'];
    if (!isset($_POST[$QaptChaInput]))
        $message = 'Captcha failure.';
        unset($_SESSION['qaptcha_key']);

        if ($arr) {
              $sec = mksecret();
            $secmd5 = md5($sec);
            $id = $arr['id'];

              $body = "Someone from " . $_SERVER["REMOTE_ADDR"] . ", hopefully you, requested that the account details for the account associated with this email address ($email) be mailed back. \r\n\r\n Here is the information we have on file for this account: \r\n\r\n User name: ".$arr["username"]." \r\n To change your password, you have to follow this link:\n\n$site_config[SITEURL]/account-recover.php?id=$id&secret=$secmd5\n\n\n".$site_config["SITENAME"]."\r\n";

            @sendmail($arr["email"], "Your account details", $body, "", "-f".$site_config['SITEEMAIL']);

              $res2 = SQL_Query_exec("UPDATE `users` SET `secret` = ".sqlesc($sec)." WHERE `email`= ". sqlesc($email) ." LIMIT 1");

              $msg = sprintf(T_('MAIL_RECOVER'), htmlspecialchars($email));

              $kind = T_("SUCCESS");
        }
    }
}

stdhead();

begin_frame(T_("RECOVER_ACCOUNT"));
if ($kind != "0") {
    show_error_msg("Notice", "$kind: $msg", 0);
}

if (is_valid_id($_GET["id"]) && strlen($_GET["secret"]) == 32) {?>
<form method="post" action="account-recover.php">
<table border="0" cellspacing="0" cellpadding="5">
    <tr>
        <td>
            <b><?php echo T_("NEW_PASSWORD"); ?></b>:
        </td>
        <td>
            <input type="hidden" name="secret" value="<?php echo $_GET['secret']; ?>" />
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
            <input type="password" size="40" name="password" />
        </td>
    </tr>
    <tr>
        <td>
            <b><?php echo T_("REPEAT"); ?></b>:
        </td>
        <td>
            <input type="password" size="40" name="password1" />
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><input type="submit" value="<?php echo T_("SUBMIT"); ?>" /></td>
    </tr>
</table>
</form>
<?php } else { echo T_("USE_FORM_FOR_ACCOUNT_DETAILS"); ?>

<form method="post" action="account-recover.php?take=1">
    <table border="0" cellspacing="0" cellpadding="5">
        <tr>
            <td><b><?php echo T_("EMAIL_ADDRESS"); ?>:</b></td>
            
            <td><input type="text" size="40" name="email" />&nbsp;<input type="submit" value="<?php echo T_("SUBMIT");?>" /></td>
            <tr><td colspan="2"><div class="QapTcha"></div></td></tr>
        </tr>
    </table>
</form>
<link rel="stylesheet" href="jquery/QapTcha.jquery.css" type="text/css" />

<script type="text/javascript" src="jquery/jquery.js"></script>
<script type="text/javascript" src="jquery/jquery-ui.js"></script>
<script type="text/javascript" src="jquery/jquery.ui.touch.js"></script>
<script type="text/javascript" src="jquery/QapTcha.jquery.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
                $('.QapTcha').QapTcha({disabledSubmit:true,autoRevert:true});
        });
</script>

<?php
}
end_frame();
?>
<p align="center"><a href="account-signup.php"><?php echo T_("SIGNUP"); ?></a> | <a href="account-recover.php"><?php echo T_("RECOVER_ACCOUNT"); ?></a> | <a href="contact.php"><?php echo T_("CONTACT_WEBMASTER"); ?></a></p>

<center>
      <style>a.chacro{color:#FFF;font:bold 10px arial,sans-serif;text-decoration:none;}</style><table cellspacing="0"cellpadding="0"border="0"style="background:#999;width:230px;"><tr><td valign="top"style="padding: 1px 2px 5px 4px;border-right:solid 1px #CCC;"><span style="font:bold 30px arial,sans-serif;color:#666;top:0px;position:relative;">@</span></td><td valign="top" align="left" style="padding:3px 0 0 4px;"><a href="http://www.projecthoneypot.org/" target="_blank" class="chacro">MEMBER OF PROJECT HONEY POT</a><br/><a href="http://www.unspam.com"class="chacro">Spam Harvester Protection Network<br/>provided by Unspam</a></td></tr></table>
      </center>
<?php
stdfoot();
?>