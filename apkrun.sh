#!/bin/bash
# declare STRING variable
#echo -e $(adb devices);

if [ $ANDROID_HOME = "" ]; then
    echo "Please set ANDROID_HOME first."
    exit 0
fi

if [ $1 = "" ]; then
    echo "Please define device name"
    exit 0
fi

if [ $2 = "" ]; then
    echo "Please define package name"
    exit 0
fi

ADB_SOURCE="$ANDROID_HOME/platform-tools/adb"
DEVICE_NAME=$1
PACKAGE_NAME=$2

ADBDEVICES=$($ADB_SOURCE -s $DEVICE_NAME  shell monkey -p $PACKAGE_NAME -c android.intent.category.LAUNCHER 1);
echo $ADBDEVICES
#(ls -la) | xargs echo;
