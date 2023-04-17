<?php 
echo ("<br>");

foreach ($result['response']['data'] as $value) {
    echo ($value->name);
    echo ("<br>");
}
?>