<?php 

include("config.php");

$action = $_POST["action"];
$usertype = (isset($_SESSION["esport_admin_usertype"])?$_SESSION["esport_admin_usertype"]:"Admin");

if($action=="login"){

    $username=$_POST["username"];
    $password=$_POST["password"];     
    $sql="select * from tbluser where UserName='{$username}' and Password='{$password}'";
    $result = mysqli_query($con,$sql);     
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $_SESSION["donationms_userid"] = $row['AID'];
        $_SESSION["donationms_username"] = $row['UserName'];                  
        $_SESSION["donationms_usertype"] = $row['UserType'];
        $_SESSION["donationms_userpassword"] = $row['Password'];
        
        save_log($row['UserName']." သည် Login ဝင်သွားသည်");

        //remember username and password
        if(!empty($_POST['remember'])){
            setcookie("member_login",$row['UserName'],time()+(10*365*24*60*60));
            setcookie("member_password",$row['Password'],time()+(10*365*24*60*60));
        }
        else{
            if(isset($_COOKIE['member_login'])){
                setcookie("member_login",'');
            }
            if(isset($_COOKIE['member_password'])){
                setcookie("member_password",'');
            }
        }
        echo 1;
    }
    else{
        session_unset();
        echo 0;
    }


}

if($action == "logout"){   
    save_log($_SESSION['donationms_username']." Logout လုပ်သွားသည်");
    unset($_SESSION["donationms_userid"]);
    unset($_SESSION["donationms_username"]);
    unset($_SESSION["donationms_usertype"]);
    unset($_SESSION["donationms_userpassword"]);
    unset($_SESSION["go_sport_permission_aid"]);
    unset($_SESSION["go_sport_permission_name"]);
    unset($_SESSION["go_detail_agentid"]);
    echo 1;
}


?>