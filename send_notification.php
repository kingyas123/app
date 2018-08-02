<?php
require "con1.php";
$message=$_POST['Message'];
$title =$_POST['title'];
$list=$_POST['myList']; 
$path_to_kinga='https://fcm.googleapis.com/fcm/send';
$server_key="AAAAPKYNJ7o:APA91bFjnbpSFIZzUCyBb4qERLBKu4M58dccrpvUqDCVX050Sy_I8tgV50SfJ-_Fg5flIWc4BSs7sSWsIc7_cIGzdIaalAdlt5-Y2s-zBpNiQvVg7xALqdTaB7tjJHM2An1z_HEWdrVAl8VRWNL75f8A4sNWv1vqkw";
$sql="select tokens from token_data where Section ='$list'";
$result=mysqli_query($con,$sql);
$i=0;
$j=mysqli_num_rows($result);
//$result=mysqli_store_result();
while($j>$i)
{
$row=mysqli_fetch_row($result);
$key[$i]=$row[0]; 
$i=$i+1;
}
$headers=array(
            'Authorization:key=' .$server_key,
            'content-Type:application/json'
 );
$i=0;
$curl_session=curl_init();

while($j>$i)
{
$fields=array('to'=>$key[$i],'notification'=>array('title'=>$title,'body'=>$message),'content_available'=>true); 
$payload =json_encode($fields);
curl_setopt($curl_session,CURLOPT_URL,$path_to_kinga);
curl_setopt($curl_session,CURLOPT_POST,true);
curl_setopt($curl_session,CURLOPT_HTTPHEADER,$headers);
curl_setopt($curl_session,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl_session,CURLOPT_SSL_VERIFYPEER,false);
//curl_setopt($curl_session,CURLOPT_IPRESOLVE,CURLOPT_IPRESOLVE_V4);
curl_setopt($curl_session,CURLOPT_POSTFIELDS,$payload);
$result =curl_exec($curl_session);
if($result)
echo $result;
else
 echo curl_error($curl_session);
$i=$i+1;
}
curl_close($curl_session);
mysqli_close($con);
?>