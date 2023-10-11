<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>User Page</title>
        <style>
            *{box-sizing:border-box;}
            body
            {
                margin:50px;
                border:3px solid black;
                border-radius:5px;
                box-shadow:0  0  50px orange;
                padding-top:5rem;
                font-size:28px;
            }
            
            div , td
            {
                padding-left:5rem;
            }
            img
            {
                width:30%;
                height:27%; 
            }
            
            a
            {
                text-decoration:none;
                color:white;
                display:inline-block;
                text-align:left;
                background-color:black;
                border:3px solid black;
                border-radius:50%;
                padding: 0 10 0 10;
                margin-top:6rem;
                margin-bottom:1.7rem;
                margin-left:2.2rem;
            }
            input[type="submit"]
            {
                background-color:black;
                color:white;
                border:3px solid black;
                border-radius:5px;
                padding: 10 10 10 10;
                margin-top:2rem;
                margin-bottom:0;
                margin-left:3rem;
                font-weight:auto;
            }
            
        </style>   
    </head>

    <body>

        <?php
        $db_hostname="127.0.0.1";
        $db_username="root";
        $db_password="";
        $db_name="poll";
        
        $conn = mysqli_connect($db_hostname,$db_username,$db_password,$db_name);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (isset($_GET["page"])) 
        { $page  = $_GET["page"]; } 
        else { $page=1; };
        
        $results_per_page = 1;
        $start_from = ($page-1) * $results_per_page;
        
        $sql = "SELECT * FROM newpollingbox ORDER BY qno ASC LIMIT $start_from," .$results_per_page;
        $rs_result = mysqli_query($conn,$sql);
        
        $sql_query = "SELECT title FROM newpollingbox";
        $res = mysqli_query($conn,$sql_query);
        
        ?>
        
        <?php
        // Correct while loop
        $title='';
        $edate = '';
        while($row = mysqli_fetch_assoc($rs_result)) 
        {
            $title  = $row['title'];
            //$edate = $row['edate'];
            echo "<form action='opinion.php' method='POST'>";
            echo "<tr><div style='width=200px';><img src='image/".$row['image'] ."' alt='Image' >"  ."</div></tr>";

            echo "<div><b>Title : </b>". $row['title'] ."</div>";
            echo "<div><b>Description : </b>" .$row['description'] ."</div>";
            echo "<div>" .$row['poll_ques'] ."</div>";

            echo "<div>
            <td><input type='radio' id='rad_btn1' name='opinion' value='Yes'/>Yes</td>
            <td><input type='radio' id='rad_btn2' name='opinion' value='No'/>No</td>
            <td><input type='radio' id='rad_btn3' name='opinion' value='Other'/>Other</td>
            </div>";
            
            echo "<div><input type='submit' name-'Submit' value='Submit' onclick='func()'></div>";
            echo "<input type='hidden' name='edate' value='" . $row['edate'] . "'>";
            echo "<input type='hidden' name='title' value='" . $row['title'] . "'>";
            echo "<input type='hidden' name='page' value='$page'>";
            echo "</form>";
        } 


$sql = "SELECT COUNT(qno) AS total FROM newpollingbox";
$result = mysqli_query($conn,$sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row["total"] / $results_per_page); 
  
for ($i=1; $i<=$total_pages; $i++)
 {  
    echo "<a href='user.php?page=".$i."'";
    if ($i==$page) 
     echo " class='curPage'";
    echo ">".$i."</a> ";
}

mysqli_close($conn);
?>



<script>
const cur_date = new Date();
const end_date = "<?php echo $edate ?>"; 
alert(end_date);
if(cur_date >= end_date)
{
    //alert('Hello');
    document.getElementById("rad_btn1").disabled=true;
    document.getElementById("rad_btn2").disabled=true;
    document.getElementById("rad_btn3").disabled=true;
}



    // Function to perform AJAX request
    function fetchPhpVariable() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var phpVariable = this.responseText;
                document.getElementById("phpVariableSpan").innerText = phpVariable;
            }
        };
        xhttp.open("GET", "fetch_php_variable.php", true); // Replace with the correct server-side PHP file
        xhttp.send();
    }

    // Call the function when the page loads
    fetchPhpVariable();





function func()
{
    alert('Vote casted successfully');
}

</script>
    </body>

</html>






