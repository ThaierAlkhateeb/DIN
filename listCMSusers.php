<?
include_once("../common/header-admin.php");
//-----------------------------------------------------------------------------------------------------------------------
//printHeader('subtitle','ref,del,add:page,ord,seo:filename,view:filename,widget:filename);

if( $_SESSION['USER_ID']<2){$add_page=",add:enterNewCMSUser.php";}
if( $_SESSION['USER_ID']<2){$del_news=',del';}
echo printHeader('',$del_news.$add_page.',ref');

$db_table = "login_users";
$db_table_grp = "login_groups";
$db_table_per = "login_groups_permissions";
/* * *********Default Sorting Option************ */
if (!isset($sb))
    $sb = "user_id";
if (!isset($_REQUEST['so']))
    $so = "ASC";
$sort = "ORDER BY $sb $so";
echo '<div class="head2_line cb"></div>';
//-----------------------------------------------------------------------------------------------------------------------
$user_id = $_REQUEST['user_id'];
$username = addslashes($_REQUEST['username']);
$password = addslashes($_REQUEST['password']);
$email = addslashes($_REQUEST['email']);
$gender = addslashes($_REQUEST['gender']);
$birthdate = addslashes($_REQUEST['birthdate']);
$user_desc = addslashes($_REQUEST['user_desc']);
$grp_id = addslashes($_REQUEST['grp_id']);
$action = $_REQUEST['action'];
$uploads_folder = $_REQUEST['uploads_folder'];
$code = randomStringUtil(50);

        $skype = addslashes($_REQUEST['skype']);
        $facebook = addslashes($_REQUEST['facebook']);
        $twitter = addslashes($_REQUEST['twitter']);
        $mobile = addslashes($_REQUEST['mobile']);
        $phone = addslashes($_REQUEST['phone']);
        $neighborhood = addslashes($_REQUEST['neighborhood']);
        $years_of_experience = addslashes($_REQUEST['years_of_experience']);
        $age = addslashes($_REQUEST['age']);
        $marital_status = addslashes($_REQUEST['marital_status']);
        $specialist = addslashes($_REQUEST['specialist']);
        
            $file = addslashes($_REQUEST['file']);

/* * *********Insert Option************ */

/* * *********Update Option************ */

/* * *********Delete Option************ */
if ($action == "Delete") {
    $array = $_POST['rid'];
    if ($array) {
        $ids = implode(",", $array);
        deleteRecord($db_table, "user_id in ($ids)", true);
    }
}
//-----------------------------------------------------------------------------------------------------------------------
$sql = "SELECT * FROM $db_table  $sort ";
$result = MYSQL_QUERY($sql);
$numberOfRows = MYSQL_NUMROWS($result);
$i = 0;
?>
<form method='post' name='main' action='<?= $_SERVER['PHP_SELF'] ?>' enctype='multipart/form-data'>
    <input type='hidden' name='action' value=''>
    <TABLE CELLSPACING="0" CELLPADDING="0" BORDER="0" WIDTH="100%" ID="list">
        <thead>
   <th width="2" >&nbsp;</th>
    <th width="3">&nbsp;</th>
    <th width="30">Active</th>
    
    <th width="3">&nbsp;</th>
        <th width="30">
        <div class="ch_all"><input type="checkbox"  ch_all /></div></th>
        </thead>
        <tbody><?
            while ($i < $numberOfRows) {
                $user_id = MYSQL_RESULT($result, $i, "user_id");
                $username = MYSQL_RESULT($result, $i, "username");
                $password = md5(MYSQL_RESULT($result, $i, "password"));
                ${'full_name_en'} = MYSQL_RESULT($result, $i, 'full_name_en');
                $email = MYSQL_RESULT($result, $i, "email");
                $gender = MYSQL_RESULT($result, $i, "gender");
                $birthdate = MYSQL_RESULT($result, $i, "birthdate");
                $grp_id = MYSQL_RESULT($result, $i, "grp_id");
                $user_desc = MYSQL_RESULT($result, $i, "user_desc");
                $uploads_folder = MYSQL_RESULT($result, $i, "uploads_folder");
                $active = MYSQL_RESULT($result, $i, "active");
                 $skype = MYSQL_RESULT($result, $i, "skype");
            $facebook = MYSQL_RESULT($result, $i, "facebook");
            $twitter = MYSQL_RESULT($result, $i, "twitter");
            $mobile = MYSQL_RESULT($result, $i, "mobile");
            $phone = MYSQL_RESULT($result, $i, "phone");
            $neighborhood = MYSQL_RESULT($result, $i, "neighborhood");
            $years_of_experience = MYSQL_RESULT($result, $i, "years_of_experience");
            $age = MYSQL_RESULT($result, $i, "age");
            $marital_status = MYSQL_RESULT($result, $i, "marital_status");
            $specialist = MYSQL_RESULT($result, $i, "specialist");
            $file = MYSQL_RESULT($result, $i, "file");

                    if ($user_id != 1 || ($_SESSION["SAdmin"] == 1 && $user_id == 1)) {
                        ?>
                        <TR>
                 <TD width="10" valign="top"><?=ViewPhotos2($file,1);?></TD>
                 
                <td height="250" valign="top">
                       <div>
                   <div style=" margin:3px; font-size:14px;">
                    	<strong><font style="color:#a00">Full Name:</font> <?=${'full_name_en'}?> </strong>
                        <strong><font style="color:#a00">/Age:</font> <?=$age?> </strong>
                        <strong><font style="color:#a00">/Gender:</font> <?=$gender?> </strong>
                    </div> 
                   <div style=" margin:3px; font-size:14px;">
                    	<strong><font style="color:#a00">UserName :</font> <?=stripslashes($username)?> </strong>
                    </div>
                     
                    <div style=" margin:3px; font-size:14px;">
                    	<strong><font style="color:#a00">Email:</font> <?=$email?> </strong>
                    </div>
                           <div style=" margin:3px; font-size:14px;">
                    	<strong><font style="color:#a00">Group:</font>   <?= lookupField($db_table_grp, 'grp_id', 'grp_name_' . $CMSLang, $grp_id); ?></strong>
                    </div>
                         
                    <div class="subjectPref"><?=stripslashes($brief)?></div>
                    
                    <div>Skype: <strong><?=stripslashes($skype)?></strong>
                        <span style="font-size:11px;">/ Facebook :<?=$facebook?></span>
                        <span style="font-size:11px;">/ Twitter :<?=$twitter?></span>
                    </div>
                  
                    <div>Mobile : <strong><?=$mobile?></strong></div>
                    
                    <div>Phone : <strong><?=$phone?></strong></div>
                </div>  
                      <TD align="center"><?= switcher('checkbox', $db_table, 'active', 'user_id', $user_id, $active) ?></TD>
                            
                          <TD align="center"><?= print_edit_icon("editCMSUsers.php?user_id=".$user_id); ?></TD>
                            <TD align="center"><?= print_delete_ckbox($user_id); ?></TD>
                            </td>
                        </TR>
                        <?
                    }
                
                $i++;
            } //End While
            ?>
        </tbody>
    </TABLE>
</form>
<? include_once("../common/footer-admin.php"); ?>