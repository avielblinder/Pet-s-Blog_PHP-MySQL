<?php

session_start();
session_destroy();//delete the session from browser
header('location:signin.php');


#