<meta charset="utf-8">
<?php
$search = $_GET['yid'];
$search= urlencode($search);

$keys = array("AIzaSyBMu37f39uDLO3UAvLwINjsWaI_qAdONy8");
array_push ($keys, "AIzaSyCWDdv94ryDiaEwUkrQ_1oMz4hoXQ5c2AQ");
array_push ($keys, "AIZASYCWDDV94RYDIAEWUKRQ_1OMZ4HOXQ5C2AQ");
$code = 0;
foreach ($keys as $indicater => $value){
    $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q='.$search.'&key=".$value;

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
    $response = (array)json_decode ($response);
    $count = 0;

    if(isset($response["error"]) && $indicater != count($keys) - 1) continue;

    if(!isset($response["error"])){
        foreach ($response["items"] as $key => $val){
	        $res = json_encode($response["items"][$key]);
	        $res = json_decode($res, true);
	        if($key == "id"){
		       foreach ($res as $key2 => $val2){
		           $ids = $res["id"]["videoId"];
		           $code = 1;
		           break;
		       }
		    }
	    }
    } 
}
if($code == 0) echo "<p align=center><h1>현재 유튜브 검색 할당량이 초과되었습니다. 내일 이용해주세요";
?>
	
<html lang="ko">
<html>
	
<head>
    <meta charset="utf-8">
    <meta name="description" content="부엉이 백과사전">
        <title>부엉이 백과사전</title>
    <meta property="og:image" content="https://i.imgur.com/1shPItc.png">
</head>

</br></br></br><h1>
	
<font size="7">
	
<a href="https://stdict.korean.go.kr/m/main/main.do" target="_blank">
<p align=center><img src="logo_big.png" width="717" height="170" alt="표준국어대사전" />
</a><br>
	
<a href="http://developers.naver.com" target="_blank">
<p align=center><img src="2-5. NAVER OpenAPI_c_ver.png" width="400" height="100" alt="NAVER 오픈 API" />
</a>

<!-- 표준국어대사전 검색 코드-->
<form method="get" action="searchdict.php">
<p align=center>표준국어대사전 검색
<br><br>
<input type="text" name="did" style="text-align:left; width:700px; height:60px; letter-spacing: -5px; font-size:50px;"/>
<input type="submit" value="검색" style="width:120px; height:70px;font-size:50px;border:7;solid:#81F581;"/>
</form>
<br>
	
<!-- 네이버 백과사전 검색 코드-->
<form method="get" action="search.php">
<p align=center>백과사전 검색
<br>
<br>
<input type="text" name="id" style="text-align:left; width:700px; height:60px; letter-spacing: -5px; font-size:50px;"/>
<input type="submit" value="검색" style="width:120px; height:70px;font-size:50px;border:7;solid:#81F581;"/>
</form><br><br><br><br><br>
	
본 웹사이트는 비영리를 목적으로 하고있으며 오직 학습적인 목적만을 위해 만들어진 웹사이트입니다.

<br><br><br>
	
라이브러리에서 백과사전을 보지 못하는 부엉이 여러분을 위해 네이버 백과사전 API를 이용해 제작하였습니다.

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	
</font>

<form method="get" action="index.html">
<br><br>
<p align=center><input type="submit" value="재생 중지" style="width:300px; height:70px;font-size:50px;border:7;solid:#81F581;"/>
</form>

<br><br>
	
<!-- 유튜브 검색 코드 -->
<form method="get" action="ytsearch.php">
<br><br>
<p align=center><input type="text" name="yid" style="text-align:left; width:700px; height:60px; letter-spacing: -5px; font-size:50px;"/>
<input type="submit" value="검색" style="width:120px; height:70px;font-size:50px;border:7;solid:#81F581;"/>
</form>
<!-- 유튜브 플레이어 코드 -->
<div id="player"></div>
<script src="http://www.youtube.com/iframe_api"></script>
<script>
    var player;
    function onYouTubeIframeAPIReady(){
    player = new YT.Player('player',{
        width:'0%',
        height:'0%',
        videoId: '<?php echo $ids ?>' ,
        playerVars:{'autoplay':1,'playsinline':1},
        events:{ 'onReady':onPlayerReady }
        });
    }
    
    function onPlayerReady(e){
    e.target.playVideo();
        }
</script>
</html>