<?php
function redirect_ke($url)
{
    header("Location: " . $url);
    exit();
}


function bersihkan($input) 
{
    
    if (!is_string($input)) {
        return $input; 
    }
    
    
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8'); 
    return $input;
}


function tidakKosong($str)
{
    return strlen(trim($str)) > 0;
}

function formatTanggal($tgl)
{
    return date("d M Y", strtotime($tgl));
}

function tampilkanBiodata($conf, $arr)
{
    $html = "";
    foreach ($conf as $k => $v) {
        $label = $v["label"];
        $nilai = bersihkan($arr[$k] ?? ''); 
        $suffix = $v["suffix"];

        $html .= "<p><strong>{$label}</strong> {$nilai}{$suffix}</p>";
    }
    return $html;
}