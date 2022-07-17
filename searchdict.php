<meta charset="utf-8">
<?php

$search = $_GET['did'];

$search= urlencode($search);

//$key = "79B605F4CCB04187CC20A578EE95DD33";

$url = "https://stdict.korean.go.kr/api/search.do?key=79B605F4CCB04187CC20A578EE95DD33&type_search=search&q=".$search;

$ch = curl_init(); //curl 초기화
curl_setopt($ch, CURLOPT_URL, $url); //URL 지정하기 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //요청 결과를 문자열로 반환 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); //connection timeout 10초 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //원격 서버의 인증서가 유효한지 검사 안함
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method); 
$response = curl_exec($ch); 
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
$error = curl_error($ch); 
curl_close($ch);

$xml = simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOCDATA); 
$json = json_encode($xml); 
$array = json_decode($json, true);

$count = 0;
echo "<h1>";
	if(is_array($array["item"])){
		foreach ($array["item"] as $key => $val){
			if($array["total"] != "1"){
			   echo $val["sup_no"].". ".$val["word"]." [ 품사: ".$val["pos"]." ]<br><br>";
			   echo $val["sense"]["definition"]."<br><br>";
	           echo "<br><br>";
	           echo "---------------------------------------------------------<br><br><br>";
	           } else{
	           if(is_array($array)){
		          if($count == 1) break;
		              echo $array["item"]["word"]." [ 품사: ".$array["item"]["pos"]." ]<br><br>";
			          echo $array["item"]["sense"]["definition"]."<br><br><br><br>";
	                  echo "<br><br>";
	                  $count++;
	                }
		        }
			}
		} else{
		      echo("존재하지 않는 단어입니다.");
			}
?>