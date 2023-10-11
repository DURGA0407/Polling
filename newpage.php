<!--<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width , initial-scale=1.0"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="upload.css"/>
    <title>Create Poll</title>
    <style>
        /*@import url('https://fonts.googleapis.com/css2?family=Jost:wght@100;300;400;700&display=swap');
        .wrapper
        {
            width:400px;
            margin: 40px auto;
            padding:10px;
            border-radius: 5px;
            background: white;
        }

        input[type="text"]
        {
            padding:10px;
            margin:10px auto;
            display:block;
            border-radius: 5px;
            border:1px solid rgb(266,266,266);
            background: none;
            width:274px;
            color:black;
        }

        input[type="text"]:focus{
            outline: none;
        }

        .controls
        {
            width:294px;
            margin:15px auto;
        }

        #remove_fields
        {
            float:right;
        }

        .controls a i.fa-mius
        {
            margin-right: 5px;
        }*/
        
        a{ color:black; text-decoration: none;}

        #poll-title,#poll_question
        {
            padding:11px;
            margin-left: 3px;
            width:99.5%;
            border-radius:5px;
            border-color: #f1f1f1;
            background-color: white;
            outline: none;
        }
        
    </style>
</head>
<body>
    <h1>Polling Form</h1>
    <form class="form-container" action="" method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Poll Title : </b></label>
            <div class="col-sm-10">
              <input type="text" id="poll-title" class="form-control" name="title" >
            </div>
        </div>

        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label"><b>Poll Description : </b></label>
            <div class="col-sm-10">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>                                
            </div>
        </div>


        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Add Questions : </b></label>
            <div class="col-sm-10">
              <input type="text" id="poll_question" class="form-control" name="poll_ques" >
            </div>
        </div>

        <div>
            <label style="padding-top: 100px;"><b>Poll from Date : </b></label>
            <input class="from-date" id="from-date" type="date" name="sdate">
        </div>

        <div >
            <label style="padding-top: 100px;"><b>Poll to Date : </b></label>
            <input class="to-date" id="to-date" type="date" name="edate">
        </div>

        <div>
            <label style="padding-top: 32px;"><b>Upload Image : </b></label>
            <input class="img-upload"  type="file" name="image" accept=".jpg , .jpeg , .png" value="">
        </div>

        <div>

            <input type="submit" name="Upload"  value="Upload" class="btn btn-primary" onclick="popupmsg()" >
        </div> 
        
    </form>

    <script src="script.js"></script>-->




    <?php
    session_start ();
    if(!isset($_SESSION["login"]))
        header("location:login.php"); 
    ?>
<?php
    $db_hostname="127.0.0.1";
    $db_username="root";
    $db_password="";
    $db_name="poll";
    
    $conn = mysqli_connect($db_hostname,$db_username,$db_password,$db_name);
    if(!$conn)
    {
        echo "Connection with the database failed!";
        exit;
    }
    if(isset($_POST["upload"]))
    {
        //$poll_ques1="";
        $title = $_POST['title'];
        $description = $_POST['description'];
        $poll_ques = $_POST['poll_ques'];
        $sdate = $_POST['sdate'];
        $edate = $_POST['edate'];
        $image = $_FILES['image']['name'];

        if ($_FILES['image']['error'] !== 0) {
            echo "<script> alert('Error uploading image');</script>";
        }
        
        else
        {
            $fileName = $_FILES["image"]["name"];
            $fileSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];

            $validImageExtension = ['jpg' , 'jpeg' , 'png'];
            $imageExtension = explode('.',$fileName);
            $imageExtension = strtolower(end($imageExtension));
            if(!in_array($imageExtension,$validImageExtension))
            {
                echo 
                "<script> alert('Invalid Image Extension'); </script>"
                ;
            }
            else if($fileSize > 100000000)
            {
                echo "<script> alert('Image size is too large'); </script>";
            }
            else{
                $newImageName = uniqid();
                $newImageName .= '.' . $imageExtension;

                move_uploaded_file($tmpName, 'image/'.$newImageName);
                $sql = "INSERT INTO newpollingbox (title, description,poll_ques, sdate, edate,image) VALUES ('$title','$description', '$poll_ques','$sdate','$edate','$newImageName')";


                $result = mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error".mysqli_error($conn);
                }
            }
        }
    }
    mysqli_close($conn);
?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width , initial-scale=1.0"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="upload.css"/>
    <title>Create Poll</title>
    <style>
        /*@import url('https://fonts.googleapis.com/css2?family=Jost:wght@100;300;400;700&display=swap');
        .wrapper
        {
            width:400px;
            margin: 40px auto;
            padding:10px;
            border-radius: 5px;
            background: white;
        }

        input[type="text"]
        {
            padding:10px;
            margin:10px auto;
            display:block;
            border-radius: 5px;
            border:1px solid rgb(266,266,266);
            background: none;
            width:274px;
            color:black;
        }

        input[type="text"]:focus{
            outline: none;
        }

        .controls
        {
            width:294px;
            margin:15px auto;
        }

        #remove_fields
        {
            float:right;
        }

        .controls a i.fa-mius
        {
            margin-right: 5px;
        }*/
        
        a{ color:black; text-decoration: none;}

        #poll-title,#poll_question
        {
            padding:11px;
            margin-left: 3px;
            width:99.5%;
            border-radius:5px;
            border-color: #f1f1f1;
            background-color: white;
            outline: none;
        }
        .btn-primary
        {
            margin-top:3rem;
            margin-left:41rem;
        }
    </style>
</head>
<body>
    <h1>Polling Form</h1>
    <form class="form-container" action="newpage.php" method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Poll Title : </b></label>
            <div class="col-sm-10">
              <input type="text" id="poll-title" class="form-control" name="title" >
            </div>
        </div>

        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label"><b>Poll Description : </b></label>
            <div class="col-sm-10">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>                                
            </div>
        </div>


        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Add Questions : </b></label>
            <div class="col-sm-10">
              <input type="text" id="poll_question" class="form-control" name="poll_ques" >
            </div>
        </div>

        <div>
            <label style="padding-top: 100px;"><b>Poll from Date : </b></label>
            <input class="from-date" id="from-date" type="date" name="sdate">
        </div>

        <div >
            <label style="padding-top: 100px;"><b>Poll to Date : </b></label>
            <input class="to-date" id="to-date" type="date" name="edate">
        </div>

        <div>
            <label style="padding-top: 32px;"><b>Upload Image : </b></label>
            <input class="img-upload"  type="file" name="image" accept=".jpg , .jpeg , .png" value="">
        </div>

        <div>
            <button type="submit" name="upload" class="btn btn-primary" onclick="popupmsg()" >Upload</button>
        </div> 
        
    </form>

    <script>
        function popupmsg()
        {
            alert("Successfully uploaded");
        }

    </script>
</body>