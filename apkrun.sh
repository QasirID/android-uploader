#!/bin/bash
# declare STRING variable
#echo -e $(adb devices);
ADB_SOURCE="/Users/hartviq/Library/Android/sdk/platform-tools/adb";
DEVICE_NAME=$1
PACKAGE_NAME=$2;

ADBDEVICES=$($ADB_SOURCE -s $DEVICE_NAME  shell monkey -p $PACKAGE_NAME -c android.intent.category.LAUNCHER 1);
echo $ADBDEVICES
#(ls -la) | xargs echo;
