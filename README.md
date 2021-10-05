# MathMonster

A simple math game designed by Father and Daughter one night before bed. 

```
php test.php
___  ___  ___ _____ _   _ ___  ________ _   _  _____ _____ ___________
|  \/  | / _ \_   _| | | ||  \/  |  _  | \ | |/  ___|_   _|  ___| ___ \
| .  . |/ /_\ \| | | |_| || .  . | | | |  \| |\ `--.  | | | |__ | |_/ /
| |\/| ||  _  || | |  _  || |\/| | | | | . ` | `--. \ | | |  __||    /
| |  | || | | || | | | | || |  | \ \_/ / |\  |/\__/ / | | | |___| |\ \
\_|  |_/\_| |_/\_/ \_| |_/\_|  |_/\___/\_| \_/\____/  \_/ \____/\_| \_|


         _,\,\,\|\|\|\|\|\|\|\/-\___.._
     __,-'                          () .\
    /  __/---\___                    ---/   70
   |  /          \ \___________/\ \__\
   | |            \ \            \
   | |            / |             \__/_
   | |            | \/_              /\
    ||             \--\
     ||
      \_______
       \-------\____


A) 18
B) 49
C) 84
D) 40
E) 30
What numbers equal total?D E
You Win!!!!
```
## Basic Usage
```
git clone https://github.com/hxtree/mathmonster.git
docker build --target test --tag mathmonster:latest -f Dockerfile .
docker run -it --mount type=bind,source="$(pwd)"/,target=/application/ mathmonster:latest php public/index.php
