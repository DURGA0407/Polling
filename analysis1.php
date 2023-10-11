<!DOCTYPE html>
<head>
    <title>SENTIMENTAL ANALYSIS</title>
</head>
<body>
    <center><h2 style="color:indigo">SENTIMENT ANALYSIS</h2></center>
    <style>
        *{font-size:21.5px;}
    </style>
</body>

<?php
    $db_hostname="127.0.0.1";
    $db_username="root";
    $db_password="";
    $db_name="poll";
    
    $conn = mysqli_connect($db_hostname,$db_username,$db_password,$db_name);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    function sentimentAnalysis($text, $sentimentLexicon, &$positiveCount, &$negativeCount, &$neutralCount) 
    {
        $words = preg_split('/\s+/', $text);
        $score = 0;

        foreach ($words as $word)
        {
            $word = strtolower($word);
            if (isset($sentimentLexicon[$word])) 
            {
                $score += $sentimentLexicon[$word];
            }
        }
    
        if ($score > 0) {
            $positiveCount++;
            return 'positive';
        } elseif ($score < 0) {
            $negativeCount++;
            return 'negative';
        } else {
            $neutralCount++;
            return 'neutral';
        }
    }

    $sentimentLexicon = array(
    'good' => 1,
    'useful' => 1,
    'perfect' => 1,
    'agree' => 1,
    'happy' => 1,
    'benificial' =>1,
    'great' => 1,
    'excellent' => 1,
    'bad' => -1,
    'terrible' => -1,
    'waste' => -1,
    'less' =>-1,
    'welcome' =>1,
    'not' =>-1,
    'imperfect' => -1,
    'wrong' => -1,
    'disagree' => -1,
    'graceful' => 1,
    'inspiring' => 1,
    'hopeful' =>1,
    'hope' =>1,
    'oppose' => -1,
    'opposing' => -1,
    'refuse' =>-1,
    'difficult'=>-1,
    );
    
    $comments = "SELECT suggestion FROM discussion1";
    $exec = mysqli_query($conn,$comments);

    
    $positiveCount = 0;
    $negativeCount = 0;
    $neutralCount = 0;
    
    while($row = mysqli_fetch_assoc($exec))
    {
        $comments = $row['suggestion'];
        $result = sentimentAnalysis($comments, $sentimentLexicon, $positiveCount, $negativeCount, $neutralCount);
        echo "<b>Comment:</b> $comments <br><b>Sentiment: </b>" . ucfirst($result) . PHP_EOL;
        echo "<br><br>";
    }
    
    $count = "SELECT count(email) as count from discussion1 ";
    $res = mysqli_query($conn,$count);
    $row = $res->fetch_assoc();
    $totalComments  = ceil($row["count"]);
    //$totalComments = count($res);
    $positivePercentage = ($positiveCount / $totalComments) * 100;
    $negativePercentage = ($negativeCount / $totalComments) * 100;
    $neutralPercentage = ($neutralCount / $totalComments) * 100;
    
    echo "Total Comments: $totalComments<br>" . PHP_EOL;
    echo "Positive Comments: $positiveCount ($positivePercentage%)<br>" . PHP_EOL;
    echo "Negative Comments: $negativeCount ($negativePercentage%)<br>" . PHP_EOL;
    echo "Neutral Comments: $neutralCount ($neutralPercentage%)<br>" . PHP_EOL;
    
    
?>


