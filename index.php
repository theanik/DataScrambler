<?php
require_once realpath("vendor/autoload.php");

use Scrambler\DataScrambler\DataScrambler;



$ds = new DataScrambler;

$task = 'encode';
$task = $_GET['task'] ?? $task;


$keyValue = $ds->displayKey($task);
if(isset($_POST['key']) && $_POST['key'] != ""){
    $keyValue = "value=".$_POST['key'];

    
}
$porcessedData = '';
if(isset($_POST['data']) && $_POST['data'] != ''){
    $porcessedData = $ds->ScrambleData($_POST['data'],$_POST['key']);
}

if('decode' == $task){
    if(isset($_POST['data']) && $_POST['data'] != '' && !$_POST['key'] == ''){
        $porcessedData = $ds->DecodeData($_POST['data'],$_POST['key']);
    }
}

// Contional rendering
$readonly = 'encode' == $task || 'key' == $task;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Example</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
    <link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">
    <style>
        body {
            margin-top: 30px;
        }

        #data {
            width: 100%;
            height: 160px;
        }

        #result {
            width: 100%;
            height: 160px;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="column column-60 column-offset-20">
            <h2>Data Scrambler</h2>
            <p>Use this application to scramble your data</p>
            <p>
                <a href="?task=encode">Encode</a> |
                <a href="?task=decode">Decode</a> |
                <a href="?task=key">Generate Key</a>

            </p>
        </div>
    </div>
    <div class="row">
        <div class="column column-60 column-offset-20">
    <form method="POST" <?php if('decode' == $task): ?> action="index.php?task=decode" <?php endif; ?> action="index.php">
                <label for="key">Key</label>
                <input type="text"<?php if( $readonly ) {echo "readonly disable"; }?>  name="key" <?=$keyValue ?> id="key">
                <label for="data">Data</label>
                <textarea name="data" id="data"><?php if(isset($_POST['data'])){ echo $_POST['data'];}  ?></textarea>
                <label for="result">Result</label>
                <textarea id="result"><?=$porcessedData ?></textarea>
                <button type='submit'>Do It For Me</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>