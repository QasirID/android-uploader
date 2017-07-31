#!/bin/bash
# declare STRING variable
#echo -e $(adb devices);
# ADBDEVICES=$(/Users/hartviq/Library/Android/sdk/platform-tools/adb devices | grep -E -i -w 'device' |  awk '{print $1}' FS=" ");
# echo $NAME
# LOOP=$(echo $ADBDEVICES | cut -f1 -s -d' ');
# echo $LOOP
# LOOP=' ' read -r -a array <<< "$ADBDEVICES"
# echo "${array[0]}"
#(ls -la) | xargs echo;

APK_SOURCE=$1;
# PACKAGE_NAME=$1;
ADB_SOURCE="/Users/hartviq/Library/Android/sdk/platform-tools/adb";
ADBDEVICES=$($ADB_SOURCE devices| grep -E -i -w 'device' | awk '{print $1}' FS=" ");

while read -r device
do
    echo "$device";
    ADB_INSTALL=$($ADB_SOURCE -s $device install -r $APK_SOURCE) 2>&1;
    # ADB_START+="$ADB_SOURCE -s $device shell monkey -p com.innovecto.etalastic.staging -c android.intent.category.LAUNCHER 1; ";
    # ADB_INSTALL+="$ADB_SOURCE -s $device install -r /Users/hartviq/Documents/MyProject/Website2/apkuploader/test.apk | "
done <<< "$ADBDEVICES"


