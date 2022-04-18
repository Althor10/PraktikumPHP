<?php

include "session.php";

$_SESSION["user"] = null;
redirect("./index.php?page=admin"); ?>