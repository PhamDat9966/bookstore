<?php
session_start();
echo "<h3>destroy Session</'h3>";
session_destroy();

echo "<pre>";
print_r($_SESSION);
echo "</pre>";