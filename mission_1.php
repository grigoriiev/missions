<?php


$a='В конце апреля командование Военно-морских сил Индонезии сообщило об исчезновении подводной лодки KRI Nanggala 402
 недалеко от Бали, где экипаж производил тренировочные пуски торпед. На борту субмарины находились более 50 человек.
  Через несколько дней судно обнаружили на глубине 850 м, оно было разломлено на три части. Командование вооруженных 
  сил признало лодку затонувшей, а экипаж погибшим.';

$text = substr(strip_tags(htmlspecialchars($a, ENT_QUOTES, 'UTF-8')), 0, 180);

$words=explode(" ",$text);

$firstLastWord=mb_convert_encoding(array_pop($words), "utf-8");

$secondLastWord= mb_convert_encoding(array_pop($words), "utf-8")."...";

$lengthWords=iconv_strlen($secondLastWord,"utf-8")+iconv_strlen($firstLastWord,"utf-8");

$link="<a href=\"page.php\">$secondLastWord $firstLastWord</a>";

$b =mb_convert_encoding( mb_convert_encoding(substr($a, 0, 180-$lengthWords),   "utf-8","utf-8").$link,   "utf-8","utf-8") ;

echo $b;
/*Главное чтобы у текста новости была кодировка Utf-8 иначе возможно появление знаков вопроса и кракозябр.
  Текст статьи не должен  содержать HTML-сущности иначе возможны xss атаки.
 Для правильного отображения ссылки нужно использовать экранирование кавычек*/


