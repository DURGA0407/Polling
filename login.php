<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width , initial-scale=1.0"/>
    <meta charset="UTF-8"> 
    <style>
        body{
            font-size: 21px;
            font-family: 'Times New Roman', Times, serif;
        }
        .boundary
        {
            margin-top:-15rem;
            border:3px solid white;
            border-radius:9px;
            box-shadow:0 0 50px grey;
            padding-top:14rem;
            padding-bottom:3rem; 
        }
        input{
            padding-left:20px;
        }
        .container
        {
            display: block;
            padding:16px;
            margin-top:-4rem;
        }
        .form-styling
        {
            text-align: center;
            justify-content: center;
            padding: 20% 20%;
        }
        .box-1, .box-2
        {
            margin-left:20px;
            
            width: 300px;
            height: 45px;
            border-radius:6px;
        }
        input[type="submit"]
        {
            padding:15px;
            width:110px;
            background-color:green;
            border: 2px solid black;
            border-radius: 10px;
            font-size: 17px;
            font-weight: bold;
        }
        input[type="text"],input[type="password"]
        {
            font-size: 18px;
            font-family:Arial, Helvetica, sans-serif;
            font-weight: bold;
        }
        img
        {
            margin-top: -16rem;
        }
    
    
    </style>
</head>


<body>
    <center>
    <form class="form-styling"  action="loginprocess.php" method="POST" >
    <div class="boundary">
        <div>
            <img src="user_logo.png" width="20%"   border-radius="40px"/>
        </div> <br/><br/>
        <div class="container">
            <b>Email :&emsp;&ensp;</b>   <input class="box-1"  type="text" name="email" placeholder="Enter your Email ID"/>
            <br><br/>
            <b>Password :</b> <input  class="box-2" type="password" name="password" placeholder="Enter the password"/>
        </div><br><br>
        <div>
            <input type="submit" value="Login" name="sub">
        </div>

        <?php 
        if(isset($_REQUEST["err"]))
            $msg="Invalid username or Password";
        ?>
        <p style="color:red;">
        <?php if(isset($msg))
        {
            
        echo $msg;
        }
        ?>

        </p>
    </div>
    </center>

</body>





</html>