<?php

session_start();

?>

<form action="action.php" method="post">
    <p>Введите цифру 1: <input type="text" name="num1"></p>
    <p>Введите действие: 
        <select name="znak">
            <option value="+">плюс</option>
            <option value="-">минус</option>
            <option value="*">умножить</option>
            <option value="/">разделить</option>
        </select>
    </p>
    <p>Введите цифру 2: <input type="text" name="num2"></p>
    <p><input type="submit" value="Посчитать"></p>
    <p><input type="reset" value="Сбросить"></p>
    <p>Сумма:
        <?php
        $result = (empty($_SESSION['result'])) ? '' : $_SESSION['result']; 
        echo $result;
        session_destroy();?>
    </p>
</form>