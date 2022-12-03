<?php
header('Content-Type: text/html; charset=utf-8');
$url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
$parameters = [
    'start' => '1',
    'limit' => '10',
    'convert' => 'USD'
];

$headers = [
    'Accepts: application/json',
    'X-CMC_PRO_API_KEY: 5d9ce322-dfcf-4c0a-8a85-5bb1dbd038b9'
];
$qs = http_build_query($parameters); // query string encode the parameters
$request = "{$url}?{$qs}"; // create the request URL


$curl = curl_init(); // Get cURL resource
// Set cURL options
curl_setopt_array($curl, array(
    CURLOPT_URL => $request,            // set the request URL
    CURLOPT_HTTPHEADER => $headers,     // set the headers
    CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
));

$response = curl_exec($curl);
if ($response === FALSE) {
    die(curl_error($curl));
}

curl_close($curl);

$dataOject = json_decode($response)->data;

$xhtml_coin = '';

$xhtml_coin .= '<table id="table_coin" class="table table-sm">';
$xhtml_coin .= '
<thead>
    <tr>
        <th><b>Loại coin</b></th>
        <th><b>Mua vào</b></th>
        <th><b>Bán ra</b></th>
    </tr>
</thead>';

for($i=0;$i<10;$i++){
    $name = $dataOject[$i]->name;
    
    $price = number_format($dataOject[$i]->quote->USD->price,4,'.', '');
    if($price>1) $price = number_format($price,2,'.', '');
    
    
    $change = number_format($dataOject[$i]->quote->USD->percent_change_24h,2);
    $text_color = 'text-success';
    if($change < 0) $text_color = 'text-danger';
    $xhtml_coin .= '<tr>
                        <td>' . $name . '</td>
                        <td>' . $price . '</td>
                        <td><span class="'.$text_color.'">' . $change . '</span></td>
                   </tr>';   
}
$xhtml_coin .='</table>';
echo $xhtml_coin;
