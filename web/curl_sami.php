<?php

$data = array("jsonrpc" => "2.0",
    "method" => "getFeedBackSenace",
    "params" => array("idSeance" => 1),
    "id" => 1

);
$data_string = json_encode($data);

$ch = curl_init('http://project-group-5.estiam.com:8000/jsonrpc/FeedBacks/dys_2016_estiam');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

$result = curl_exec($ch);
//$result = json_decode($result, true);
var_dump($result);
//$i = 0;
//foreach ($result["result"]["feed"]["movie"] as $info) {
//    echo "<pre>".print_r($info["code"])."</pre>";
//}
//var_dump($result);


