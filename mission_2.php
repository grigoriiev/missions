<?php

function ResizeImage ($filename, $widthCoefficient ,$heightCoefficient,  $pathSave, $newFilename)
{
    /*
    * Адрес директории для сохранения картинки
    */
    $dir  = $_SERVER['DOCUMENT_ROOT'].$pathSave;

    /*
    * Извлекаем формат изображения, то есть получаем
    * символы находящиеся после последней точки
    */
    $ext  = strtolower(strrchr(basename($filename), "."));

    /*
    * Допустимые форматы
    */
    $extentions = array('.jpg', '.gif', '.png', '.bmp');

    if (in_array($ext, $extentions)) {

        list($width, $height) = getimagesize($filename); // Возвращает ширину и высоту

        $newwidth = $width * $widthCoefficient;

        $newheight = $height * $heightCoefficient;

        $thumb = imagecreatetruecolor( $newwidth, $newheight);

        switch ($ext) {
            case '.jpg':
                $source = @imagecreatefromjpeg($filename);
                break;

            case '.gif':
                $source = @imagecreatefromgif($filename);
                break;

            case '.png':
                $source = @imagecreatefrompng($filename);
                break;

            case '.bmp':
                $source = @imagecreatefromwbmp($filename);
        }

        /*
        * Функция наложения, копирования изображения
        */
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        /*
        * Создаем изображение
        */
        switch ($ext) {
            case '.jpg':
                imagejpeg($thumb, $dir . $newFilename);
                break;

            case '.gif':
                imagegif($thumb, $dir . $newFilename);
                break;

            case '.png':
                imagepng($thumb, $dir . $newFilename);
                break;

            case '.bmp':
                imagewbmp($thumb, $dir . $newFilename);
                break;
        }
    } else {
        return false;
    }

    /*
    *  Очищаем оперативную память сервера от временных файлов,
    *  которые потребовались для создания миниатюры
    */
    @imagedestroy($thumb);
    @imagedestroy($source);

    return true;
}

function generateRandomString($length = 10) {

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $charactersLength = strlen($characters);

    $randomString = '';

    for ($i = 0; $i < $length; $i++) {

        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$pathSave="smallImage/";

$newFilename=generateRandomString().".png";

ResizeImage ('image/img_3.png',  0.001 ,0.0005,  $pathSave, $newFilename);

$link="<a href=\"page_1.php\"><img alt=\"imag\" src=\"$pathSave$newFilename\" title=\"img\" /></a>";

echo $link;