<p>Здравствуйте! Здесь можно увидеть краткое описание работы и инструкцию по запуску.</p> 

<h2>Краткое описание.</h2>
<div>Работа выполнена с использованием стека php/html/js. Фреймворки не использовались.</div>
<div>В проекте есть 3 ветки:</div><br>
<p>-How_I_Studied - изначальный вариант работы, сделанный так, как меня учили в вузе. В нём нет разделения между frontend-частью и backend-частью.</p>
<p>-FrontendBackendSeparation - вторая версия проекта, оформленная правильно. В ней реализованно разделение frontend и backend.</p>
<p>-OOP_Style - финальная версия проекта, в которой такие функции, как добавление, изменение и удаление данных в таблицах, реализованы методами ООП и сгруппированы в один файл.</p><br>
<p>В финальной версии реализованы все функции, которые были описаны в ТЗ:</p>
<p>-Регистрация/Вход</p>
<p>-CRUD-интерфейс для работы с таблицами, адаптирующийся под права доступа пользователей</p>
<p>-API для вывода данных о товарах и категориях с фильтрацией поиска и постраничным выводом</p>

<h2>Инструкция по развёртыванию</h2>
<div>Работа была выполнена с использованием OpenServer.</div>
<div>К сожалению, поиски бесплатного хостинга, не требующего привязки карты, не увенчались успехом, поэтому проект необходимо развернуть так же, на локальном сервере. Ниже будет инструкция по развёртыванию проекта с использованием OpenServer, но для других локальных серверов действия должны быть аналогичными.</div><br>
<p>Для начала необходимо скачать zip-архив с файлами проекта с GitHub.</p>
<p>Далее необходимо загрузить файлы проекта в папку с проектами OpenServer. Необходимо перейти в папку, где установлен OpenServer, далее перейти в папку domains и распаковать архив.</p>
<p>После этого для инициализации проекта необходимо перезапустить OpenServer, если он был запущен.</p>
<p>Теперь необходимо открыть phpMyAdmin через панель управления OpenServer. В phpMyAdmin нужно создать новую базу данных, затем нажать кнопку "Импорт" и выбрать файл базы данных, который находится в папке с проектом.</p>
<p>После этого необходимо открыть файл db.php (в финальной версии проекта находится по пути backend\db\) и настроить подключение к базе данных (если используются настройки OpenServer по умолчанию, то нужно проверить только название БД, которое записывается в переменную $db).</p>
<p>Перейти на главную страницу проекта можно по ссылке http://mytestproject/backend/public/index.php</p>
<p>Для перехода в admin-панель необходимо войти в аккаунт админа (логин: admin, пароль: admin).</p>
<p>В базе данных уже есть три пользователя admin (пароль admin), moder (пароль 1234) и user (пароль 1234). У админа есть полные права на редактирование всех таблиц и проверку api через простые формы, у модератора есть только права на редактирование таблиц с продуктами и категориями, а обычные пользователи могут только просматривать таблицу с продуктами. Изменять роли пользователей можно через панель админа, либо в самой базе данных.</p>
