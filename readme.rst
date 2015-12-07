###################
Code Challenge
###################

####
Models
####
Car_model.php
Item_model.php

####
Controllers
####
Items.php
Cart.php

####
download and install
####
1- Download the in zip format
2- unzip it in the project folder
3- import database into mysql
4- make sure environmental variable contains phpunit and php paths

####
Url item Data
####
http://<path of project>/index.php/items/lists (Default json)
http://<path of project>/index.php/items/lists.json (json)
http://<path of project>/index.php/items/lists.xml (xml)
http://<path of project>/index.php/items/lists/id/2 (json for id 2)
http://<path of project>/index.php/items/lists/id/2/format/xml (xml for id 2)
http://<path of project>/index.php/items/lists/id/2/format/html (html for id 2)

####
Unit Test
####
on console
<path to project_folder>\application\tests>phpunit
where php unit is the command
test case are in
Models: Cart_model_test.php, Item_model_test.php
Controllers: Cart_test.php, Items_test.php