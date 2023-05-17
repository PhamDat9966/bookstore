<?php

// Kiem tra du lieu khac rong
function checkEmpty($value)
{
    $flag = false;
    if (!isset($value) || trim($value) == "") {
        $flag = true;
    }
    return $flag;
}

// Kiem tra chieu dai du lieu
function checkLength($value, $min, $max)
{
    $flag     = false;
    $length    = strlen($value);
    if ($length < $min || $length > $max) {
        $flag = true;
    }
    return $flag;
}

// Tao ra ten file
function randomString($length = 5)
{

    $arrCharacter = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
    $arrCharacter = implode('', $arrCharacter);
    $arrCharacter = str_shuffle($arrCharacter);

    $result        = substr($arrCharacter, 0, $length);
    return $result;
}

// Size
function convertSize($size, $totalDigit = 2, $ditance = ' ')
{
    $units    = array('B', 'KB', 'MB', 'GB', 'TB');

    $length    = count($units);
    for ($i = 0; $i < $length; $i++) {
        if ($size > 1024) {
            $size    = $size / 1024;
        } else {
            $unit    = $units[$i];
            break;
        }
    }

    $result = round($size, $totalDigit) . $ditance . $unit;
    return $result;
}

// Check file size
function checkSize($size, $min, $max)
{
    $flag = false;
    if ($size >= $min && $size <= $max) $flag = true;
    return $flag;
}

// Check file extensions
function checkExtension($fileName, $arrExtension)
{
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $flag = false;
    if (in_array(strtolower($ext), $arrExtension) == true) $flag = true;
    return $flag;
}

// RandomString 
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// shuffle Array với value cũng là 1 mảng
function mixArray($arrMix){
    $arrKey = array_keys($arrMix);                         //Lấy mảng chứa key
    shuffle($arrKey);                                      // Sáo chộn mảng chưa key
    array_flip($arrKey);                                   // Đảo vị trí key và value
    $return = array_combine($arrKey, $arrMix);              // ghép lại mảng có key đã đảo và mảng chứa value cần lấy
    ksort($return);                                         // Sắp xếp lại mảng theo key thứ tự 1,2,3....
    return $return;                                        
}



