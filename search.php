<meta charset="utf-8">
<?php
  echo "<h1>";
  $search = $_GET['id'];
  
  $client_id = "U5vVBtdmVCj9KZxQgC7F";
  $client_secret = "A2yB8q34Vz";
  
  $encText = urlencode($search);
  
  $url = "https://openapi.naver.com/v1/search/encyc.json?query=".$encText; // json 결과
  $is_post = false;
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
  
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close ($ch);
  if($status_code == 200) {
     $file = json_decode($response);
     $count = 1;
     $count2 = 1;
     foreach($file as $key => $val){
        if ($key == "lastBuildDate") echo "검색일자:".$val."\n";
           if($count2 == 1)echo "---------------------------------------------------------";
              $count2 = 2;
           if ($key == "items"){
              foreach ($val as $key3 => $val3){
              	$arr = get_object_vars($val3);
                  echo $count.". ".$arr["title"]."<br><br>\n".$arr["description"]."<br><br><br>";
                  echo "---------------------------------------------------------<br><br><br>";
                  $count++;
              }
          }
          echo "<br>";
      }
  } else {
    echo "Error 내용:".$response;
  }
?>