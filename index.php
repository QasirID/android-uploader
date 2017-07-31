<!DOCTYPE html>
<html>
<head>
    <title>Upload APK</title>
</head>
<body>
<form enctype="multipart/form-data" action="" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <!-- Name of input element determines name in $_FILES array -->
    Upload APK: <input name="apkfile" type="file" />
    <br>
    <input type="submit" value="Send File" />
</form>

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
            exec("./apkrun.sh $value com.innovecto.etalastic.staging 2>&1", $output, $vart);
        }
        echo "Was successfully installed for all devices.\n";
    }
    else
    {
        echo "Possible file upload attack!\n";
    }
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


</body>
</html>

