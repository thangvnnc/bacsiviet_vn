<?php
session_start();
$session=session_id();
$time=time();
$time_check=$time-600; //Ấn định thời gian là 10 phút
$host="localhost"; //Tên host, thường là localhost
$username="botvn"; //Mysql username
$password="GW28y79C6q938njPp7dZwM3g&Y5$9V"; //Mysql password
$db_name="bacsiviet_db"; //Tên cơ sở dữ liệu
$tbl_name="user_online"; //Tên bảng (table)
// Kết nối tới sever và chọn database
mysqli_connect("$host", "$username", "$password")or die("cannot connect to server");
mysql_select_db("$db_name")or die("cannot select DB");
$sql="SELECT * FROM $tbl_name WHERE session='$session'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);
if($count=="0"){
$sql1="INSERT INTO $tbl_name(session, time)VALUES('$session', '$time')";
$result1=mysql_query($sql1);
}
else{
$sql2="UPDATE $tbl_name SET time='$time' WHERE session = '$session'";
$result2=mysql_query($sql2);
}
$sql3="SELECT * FROM $tbl_name";
$result3=mysql_query($sql3);
$count_user_online=mysql_num_rows($result3);
$count_user_online = $count_user_online+100;
echo "Số người đang online: $count_user_online ";
//Nếu quá 10 phút, xóa bỏ session
$sql4="DELETE FROM $tbl_name WHERE time<$time_check";
$result4=mysql_query($sql4);
//Đóng kết nối
mysql_close();
?>
