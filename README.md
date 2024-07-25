# openbekenpm-unraid

With this UnRaid plugin you can turn a OpenBeken device into an energy monitor for your server.

I have forked the code from [SimonFair/tasmotapm-unraid](https://github.com/SimonFair/tasmotapm-unraid), and modified it a bit so it will work with a the OpenBeken firmware.

## Introduction

Before you start, be sure that you protect your OpenBeken device against incorrect operation. So that you don't accidentally turn off your server. I solved this for myself with the command: `PowerOnState 4` This sets the on / off switch in the WebUI and on the device to always on. Therefore, check what would be best for your device before using it. Have a look at the OpenBeken Documentation. Use the plugin and device at your own risk. I will not be responsible for any damage.

I use a Tuya Power Monitoring Plug (LSPA9) with OpenBeken firmware 1.17.645 and this template.  

```
{
  "vendor": "Tuya",
  "bDetailed": "0",
  "name": "Full Device Name Here",
  "model": "enter short model name here",
  "chip": "BK7231N",
  "board": "TODO",
  "flags": "0",
  "keywords": [
    "TODO",
    "TODO",
    "TODO"
  ],
  "pins": {
    "6": "BL0937CF1;0",
    "7": "BL0937CF;0",
    "8": "WifiLED_n;0",
    "10": "Btn;1",
    "24": "BL0937SEL;0",
    "26": "Rel;1"
  },
  "command": "backlog startDriver ntp; setupEnergyStats 1 60 60;",
  "image": "https://obrazki.elektroda.pl/YOUR_IMAGE.jpg",
  "wiki": "https://www.elektroda.com/rtvforum/topic_YOUR_TOPIC.html"
}
```

## Installing the plugin

Plugins > Install Plugin
```
https://raw.githubusercontent.com/ElVit/openbekenpm-unraid/main/openbekenpm.plg
```
## Building a package

- `git clone` this repo to your unraid machine (I used the code-server docker container to do this)
- open the terminal in unraid
- cd (change directory) to the directory where you have cloned this repo (e.g. `cd /mnt/user/git/openbekenpm-unraid`)
- cd to the "src" directory (`cd src/`)
- run the "mkpkg" script (`.\mkpkg openbekenpm`)
- the script will
    - create a "*.txz" file in the "pkg" directory of this repo
    - create a "*.md5" file in the "pkg" directory of this repo
    - modify the file "openbekenpm.plg" by adding the current version to the "changelog" section
- commit all changes