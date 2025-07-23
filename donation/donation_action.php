<?php
include('../config.php');
include(root.'lib/vendor/autoload.php');

$action = $_POST['action'];
$userid = $_SESSION["donationms_userid"];

if($action == 'showcard'){
    $no=0;                                           
    $search = $_POST['search'];
    $a = "";
    if($search != ''){  
        $a = " where (Name like '%$search%') ";
    }      
    $sql = "select * from tblitem ".$a." 
    order by AID desc";
        
    $result=mysqli_query($con,$sql) or die("SQL a Query");
    $out="";
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $out.='
            <div class="col-xl-6 col-md-6 col-12">
                <a id="addcard" data-aid="'.$row["AID"].'" 
                    data-name="'.$row["Name"].'" 
                    data-price="'.$row["Price"].'"
                    <div class="card bg-gradient-directional-info">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-white text-right">
                                        <h3 class="text-white">'.$row["Name"].'</h3>
                                        <span>'.number_format($row["Price"]).' MMK</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            ';
        }
        echo $out; 
    }
    else{
        $out.='
        <div class="col-xl-12 col-md-6 col-12">
            <div class="card bg-gradient-directional-info">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-white text-right">
                                <h3 class="text-white text-center">ပစ္စည်းစာရင်းမရှိသေးပါ</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
        echo $out;
    }

}

if($action == 'addcard'){ 
    $aid = $_POST['aid'];
    $name = $_POST['name']; 
    $price = $_POST['price'];
    $sql = "INSERT INTO tblsaletemp (ItemID,ItemName,Price,UserID) VALUES (?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("isdi", $aid, $name, $price, $userid);
    if($stmt->execute()){
        echo 1;
    }else{
        echo 0;
    }
}

if($action == 'showtable'){
    $no=0;  
    $totalamt = 0;  
    $sql = "select * from tblsaletemp order by AID desc";
        
    $result=mysqli_query($con,$sql) or die("SQL a Query");
    $out="";
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $no=$no+1;
            $totalamt += $row["Price"];
            $out.="<tr>
                <td>{$no}</td>
                <td>{$row["ItemName"]}</td>
                <td>{$row["Price"]}</td>
                <td class='text-center'>
                    <a href='#' id='btndeletetemp'
                        data-aid='{$row['AID']}'>
                        <i class='la la-trash text-danger'></i></a>
                </td>
            </tr>";
        }
        $out .= "
            <tr>
                <td colspan='2' class='text-center'>စုစုပေါင်း</td>
                <td colspan='2'>".number_format($totalamt)."</td>
            </tr>
        ";
        echo $out; 
        
    }
    else{
        $out.='
            <tr>
                <td colspan="4" class="text-center">စာရင်းမရှိသေးပါ။</td>
            </tr>
        ';
        echo $out;
    }

}

if($action == 'deletetemp'){
    $aid = $_POST["aid"];
    $sql = "delete from tblsaletemp where AID=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $aid);
    if($stmt->execute()){
        echo 1;
    }else{
        echo 0;
    }   
}

if($action == 'donate'){
    $donatorname = $_POST["donatorname"];
    $description = $_POST["description"];
    $address = $_POST["address"];
    $donationamount = $_POST["donationamount"];
    $donationdate = $_POST["donationdate"];
    $vno = date("YmdHis");
    $sql = "insert into tblsale (ItemID,ItemName,Price,VNO,Date,UserID) select ItemID,ItemName,Price,
    '".$vno."','".$donationdate."',UserID from tblsaletemp where UserID=".$userid."";
    if(mysqli_query($con,$sql)){
        $totalprice = GetInt("SELECT Sum(Price) FROM tblsale WHERE VNO=? FOR UPDATE",[$vno]);
        $amount = $totalprice + $donationamount;
        $sql_voucher = "INSERT INTO tblvoucher (VNO,TotalPrice,UserID,Date,Donater,Description,Address,
        Price,Amount) VALUES ('".$vno."','".$totalprice."','".$userid."','".$donationdate."',
        '".$donatorname."','".$description."','".$address."','".$donationamount."','".$amount."')";
        if(mysqli_query($con,$sql_voucher)){
            $sql_del = "DELETE FROM tblsaletemp WHERE UserID=".$userid."";
            if(mysqli_query($con,$sql_del)){
                save_log($_SESSION["donationms_username"]." သည် ဖြတ်ပိုင်းစာရင်းအသစ်၊ အလှူရှင်အမည်(".$donatorname.") ဖြင့် အသစ်သွင်းသွားသည်။");
                echo 1;
            }
        }
    }
    else{
        error_log("Save error in donation action, ".$stmt->error."\n", 3, root."donation/my_log_file.log");
        echo 0;
    }
}

if($action == 'edit'){
    $aid = $_POST["eaid"];
    $categoryname = $_POST["ecategoryname"];
    $sql = "UPDATE tblcategory SET Name=? WHERE AID=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("si", $categoryname, $aid);
    if($stmt->execute()){
        save_log($_SESSION["donationms_username"]." သည် Category Name (".$categoryname.") အား update လုပ်သွားသည်။");
        echo 1;
    }else{
        error_log("Edit error in category action, ".$stmt->error."\n", 3, root."category/my_log_file.log");
        echo 0;
    }
    
}

if($action == 'delete'){
    $aid = $_POST["aid"];
    $categoryname = $_POST["categoryname"];
    $sql = "delete from tblcategory where AID=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $aid);
    if($stmt->execute()){
        save_log($_SESSION["donationms_username"]." သည် Category Name (".$categoryname.") အား delete လုပ်သွားသည်။");
        echo 1;
    }else{
        error_log("Delete error in category action, ", 3, root."category/my_log_file.log");
        echo 0;
    }   
}

if($action == 'excel'){
    $search = $_POST['ser'];
    $a = "";
    if($search != ''){  
        $a = " where (Name like '%$search%') ";
    }      
    $sql = "select * from tblcategory ".$a." 
    order by AID desc";
    $result = mysqli_query($con,$sql);
    $out="";
    $fileName = "ManageCategory_".date('d-m-Y').".xls";
    $out .= '<head><meta charset="UTF-8"></head>
        <table >  
            <tr>
                <td colspan="2" align="center"><h3>Manage Category</h3></td>
            </tr>
            <tr><td colspan="2"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Category Name</th>  
       
            </tr>';
    if(mysqli_num_rows($result) > 0){
        $no=0;
        while($row = mysqli_fetch_array($result)){
            $no = $no + 1;
            $out .= '
                <tr>  
                    <td style="border: 1px solid ;">'.$no.'</td>  
                    <td style="border: 1px solid ;">'.$row["Name"].'</td>                   
                </tr>';
        }          
    }else{
        $out .= '
            <tr>
                <td style="border: 1px solid ;" colspan="2" align="center">No data found</td>   
            </tr>';
        
    }
    $out .= '</table>';
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename='.$fileName);
    echo $out;
}

if($action == 'pdf'){
    $search = $_POST['ser'];
    $a = "";
    if($search != ''){  
        $a = " where (Name like '%$search%') ";
    }      
    $sql = "select * from tblcategory ".$a." 
    order by AID desc";
    $result = mysqli_query($con,$sql);
    $out="";
    $out .= '<h3 align="center">Manage Category</h3>
    <head><meta charset="UTF-8"></head>
        <table >  
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Category Name</th>  
       
            </tr>';
    if(mysqli_num_rows($result) > 0){
        $no=0;
        while($row = mysqli_fetch_array($result)){
            $no = $no + 1;
            $out .= '
                <tr>  
                    <td style="border: 1px solid ;">'.$no.'</td>  
                    <td style="border: 1px solid ;">'.$row["Name"].'</td>                    
                </tr>';
        }          
    }else{
        $out .= '
            <tr>
                <td style="border: 1px solid ;" colspan="2" align="center">No data found</td>   
            </tr>';
        
    }
    $out .= '</table>';
    $mpdf = new \Mpdf\Mpdf();
    //$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']); // Set to landscape
    $mpdf->autoScriptToLang = true;
    $mpdf->autoLangToFont   = true;  
    $stylesheet = file_get_contents(roothtml.'lib/mypdfcss.css'); // external css
    $mpdf->WriteHTML($stylesheet,1);  
    $mpdf->WriteHTML($out,2);
    $file = 'ManageCategory_'.date("d_m_Y").'.pdf';
    $mpdf->output($file,'D');
    
}

?>