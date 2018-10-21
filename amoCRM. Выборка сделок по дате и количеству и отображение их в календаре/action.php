<?php 

$result = !empty($_GET["date"]) ? $_GET["date"] : "Нет даты";

echo "ДАТА: " . $result;

