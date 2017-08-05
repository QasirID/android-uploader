<?php 

if (!file_exists('config.ini')) {
    throw new Exception("Missing config.ini file", 1);
}

// Read configuration file
$config = parse_ini_file('config.ini');
if (empty($config['package_name'])) {
    throw new Exception("Missing 'package_name' in the configuration file", 1);
}
$PACKAGE_NAME=$config['package_name'];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload APK</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
<div class="row">
    <div class="col-xs-12">&nbsp;</div>
</div>
<div class="row">
    <div class="col-xs-12">
        <form enctype="multipart/form-data" action="" method="POST" class="form-inline">
            <!-- MAX_FILE_SIZE must precede the file input field -->
            <!-- Name of input element determines name in $_FILES array -->
            <div class="form-group">
                <label for="apkfile">
                Upload APK: 
                </label>
                <input name="apkfile" type="file" class="form-control" />
            </div>
            <input type="submit" value="Send File" class="btn btn-default" />
        </form>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-xs-12">
<?php
if (isset($_FILES['apkfile']))
{
    $uploaddir  = 'uploads/';
    $uploadfile = $uploaddir . basename($_FILES['apkfile']['name']);
    echo '<pre>';
    if (move_uploaded_file($_FILES['apkfile']['tmp_name'], $uploadfile))
    {
        echo "Installing Process... Please wait... \n";
        exec("./apkuploader.sh $uploadfile 2>&1", $output, $vart);
        foreach ($output as $key => $value)
        {
            exec("./apkrun.sh $value $PACKAGE_NAME 2>&1", $output, $vart);
        }
        echo "Was successfully installed for all devices.\n";
    }
    else
    {
        echo "Possible file upload attack!\n";
    }
    echo '</pre>';
}

// $listDevices = split("device", $output[0]);

// foreach ($listDevices as $key => $value)
// {
//     if ($value != "")
//     {
//         $device = trim($value);
//         echo "device $key : " . $device . "<br>";

//         // exec("/Users/hartviq/Library/Android/sdk/platform-tools/adb shell monkey -p com.innovecto.etalastic.staging -c android.intent.category.LAUNCHER 1", $a, $e);
//         exec("./apkinstall.sh $device 2>&1", $a, $e);
//         exec("./apkrun.sh $device 2>&1", $a, $e);
//         var_dump($a);
//     }

// }
?>
    </div>
</div>

</body>
</html>

