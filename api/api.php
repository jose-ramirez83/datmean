<?php
//echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."public/api/v1";die();
print_r($_REQUEST);die();
header("Location:http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."public/api/v1");