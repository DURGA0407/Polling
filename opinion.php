<?php
$db_hostname="127.0.0.1";
$db_username="root";
$db_password="";
$db_name="poll";

$conn = mysqli_connect($db_hostname,$db_username,$db_password,$db_name);
if (!$conn) {
    echo  "Connection failed: " . mysqli_connect_error();
}

$sql1 = "SELECT title FROM newpollingbox " ;
$res1 = mysqli_query($conn, $sql1);




/*$qno = "SELECT qno,title from newpollingbox";
$result = mysqli_query($conn,$qno);

if($result)
{
    $qnotitlearray = mysqli_fetch_all($result,MYSQLI_ASSOC);
    foreach($qnotitlearray as $data)
    {
        $qnoval = $data['qno'];
        $titleval = $data['title'];
        //echo "$qnoval &emsp;  $titleval &emsp;";
    }
    $opinion = $_POST['opinion'];
    $sql2 = "INSERT INTO response6 (title,opinion) VALUES('$titleval','$opinion') ORDER BY $qnoval";
}
*/



$title = $_POST['title'];
$opinion = $_POST['opinion'];
$sql2 = "INSERT INTO response6 (title,opinion) VALUES('$title','$opinion')";
$res2 = mysqli_query($conn,$sql2);
if(!$res2)
{
    echo "Couldn't enter the values in table " .mysqli_error($conn);
    exit;
} 





/*$edate = $_POST['edate'];
$sql3 = "SELECT edate from newpollingbox";
$res3 = mysqli_query($conn,$sql3);
while($row = mysqli_fetch_assoc($res3))
{
    echo "<input type='hidden' name='edate' value='" . $row['edate'] . "'>";
    echo "<script>
    const cur_date = new Date();
    const end_date = '<?php echo $edate ?>'; 
    
    if(cur_date >= end_date)
    {
        //alert('Hello');
        document.getElementById("rad_btn1").disabled=true;
        document.getElementById("rad_btn2").disabled=true;
        document.getElementById("rad_btn3").disabled=true;
    }
    </script>";
}*/


mysqli_close($conn);
echo "<center style='color:red;font-size:30px;font-weight:bold;padding-top:15rem'>Thank You for voting! 😊 <center>";
?>