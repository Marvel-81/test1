<?php

//  include_once("../footer.php");
class Testcontroller{
    function main(){

    }
}
?>

<form method="get" id="ff">
    <h1>Тестовый модуль</h1>
    <h3>ПОЛЕ СПРАВА ОТ КНОПОК - ДЛЯ ВВОДА ID (на случай, если захотим посмотреть конкретную строку, а не все. Если значение не задано - будут показаны все. Проверка токена - отключена</h3>
    <p><button type="button" onclick="f1()">Информация о кинотеатрах сети</button><input class="filter" type="text" id="a_id" name="newadr">&nbsp;</p>
    <p><button type="button" onclick="f2()">Информация о залах</button><input class="filter" type="text" id="b_id" name="newadr">&nbsp;</p>
    <p><button type="button" onclick="f3()">Информация о сеансах в указанный день</button><input class="filter" type="date" id="c_id" name="newadr">&nbsp;</p>
    <p><button type="button" onclick="f4()">Информация о фильмах</button><input class="filter" type="text" id="d_id" name="newadr">&nbsp;</p>
    <p><button type="button" onclick="f5()">Все места</button>&nbsp;&nbsp;
        <button type="button" onclick="f6()">Занятые места</button>&nbsp;&nbsp;
        <button type="button" onclick="f7()">Свободные места</button>&nbsp;&nbsp;
        ID НОМЕР СЕАНСА: <input class="filter" type="text" id="e_id" name="newadr" t value="1">
    </p>
    Приобретение билета:
    <p>
        ID НОМЕР СЕАНСА: <input class="filter" type="text" id="f_id" name="newadr" t value="1">
        Ряд: <input class="filter" type="text" id="g_id" name="newadr" t value="1">
        Место: <input class="filter" type="text" id="h_id" name="newadr" t value="1">
        <button type="button" onclick="f8()">Купить</button>&nbsp;&nbsp;
        <br>
</form>
<table style='text-align: center; border-collapse: collapse' border='1'>
    <tbody id="biblio-block"></tbody>
</table>
<!--<script>-->
<!--    alert ('hgg');-->
<!--</script>-->
<script src="../models/selector.js"></script>

