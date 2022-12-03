<?php
header('Content-Type: text/html; charset=utf-8');
$arrContextOptions = array(
    "ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false,
    ),
);
$link = 'https://sjc.com.vn/giavang/textContent.php';
$data = file_get_contents($link, false, stream_context_create($arrContextOptions));

preg_match('#<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">(.*)</table>#imsU', $data, $table);

preg_match_all('#<td class="br bb ylo2_text p12">(.*)</td>#imsU', $table[0], $nameG);

preg_match_all('#<span style="font-size:larger">\s*(.*)</span>#imsU', $table[0], $price);

$buy = [];
$sell = [];

foreach ($price[0] as $key => $value) {
    if ($key % 2 == 1) {
        $sell[] = $value;
        continue;
    }
    $buy[] = $value;
}

$xhtml_gold = '';

$xhtml_gold .= '<table id="table_coin" class="table table-sm">';
$xhtml_gold .= '
<thead>
    <tr>
        <th><b>Loại vàng</b></th>
        <th><b>Mua vào</b></th>
        <th><b>Bán ra</b></th>
    </tr>
</thead>';

for ($i = 0; $i <= 8; $i++) {
    $xhtml_gold .= '
        <thead>
          <tr>
            <td>' . $nameG[1][$i] . '</td>
            <td>' . $buy[$i] . '</td><td>' . $sell[$i] . '</td>
          </tr>
        </thead>';
}
$xhtml_gold .= '</table>';
echo $xhtml_gold;
