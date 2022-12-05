

<?php

$search = $_GET['yid'];

$search= urlencode($search);



$keys = array("");

array_push ($keys, "");

array_push ($keys, "");

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

	<link rel="icon" href="favicon.ico">

<meta property="og:image" content="https://i.imgur.com/1shPItc.png">

    <meta charset="utf-8">

    <meta name="description" content="부엉이 종합사전">

        <title>부엉이 종합사전</title>

    

</head>



<style>

@import url('https://fonts.googleapis.com/css2?family=Cormorant+SC&family=Do+Hyeon&family=Great+Vibes&family=Gugi&family=Sunflower:wght@500&family=Tangerine:wght@700&display=swap');

</style>





</br></br></br><h1>



<font size="7"><p align=center style = "font-family: 'Sunflower', sans-serif;"> <a href="http://www.megastudy.pe.kr" target="_blank"><img src="https://i.imgur.com/1shPItc.png" width="50" height="50" alt="부엉이" /></a><br>부엉이 종합사전<br><br><br>

	

	

<a href="http://developers.naver.com" target="_blank"><img src="2-5. NAVER OpenAPI_c_ver.png" width="200" height="50" alt="NAVER 오픈 API" /></a><br>

<a href="https://stdict.korean.go.kr/m/main/main.do" target="_blank">

<img src="logo_big.png" width="717" height="170" alt="표준국어대사전" />

</a><br></p>

	



<br>



<br><br><br>

<!-- 표준국어대사전 검색 코드-->

<form method="get" action="searchdict.php">

<p align=center style = "font-family: 'Do Hyeon', sans-serif;" >표준국어대사전 검색

<br><br>

<input type="text" name="did" style="text-align:left; width:600px; height:50px; letter-spacing: -5px; font-size:50px;"/>

<input type="image" alt="검색" src="search.png" width="50" height="50"/>

</form>

<br>

	

<!-- 네이버 영어사전 검색 코드-->

<form method="get" action="engdictsearch.php">

<p align=center style = "font-family: 'Do Hyeon', sans-serif;">영한 사전 검색 + 문장 번역 (Papago)

<br>

<br>

<input type="text" name="eid" style="text-align:left; width:600px; height:50px; letter-spacing: -5px; font-size:50px;"/>

<input type="image" alt="검색" src="search.png" width="50" height="50"/>

</form><br><br>

	

<!-- 네이버 백과사전 검색 코드-->

<form method="get" action="search.php">

<p align=center style = "font-family: 'Do Hyeon', sans-serif;">백과사전 검색

<br>

<br>

<input type="text" name="id" style="text-align:left; width:600px; height:50px; letter-spacing: -5px; font-size:50px;"/>

<input type="image" alt="검색" src="search.png" width="50" height="50"/>

</form>





<br><br><br><br><br></p>



<p align = "center" style = "font-family: 'Cormorant SC', serif;">The master Key for Success</p>



<br>



<p align = "center" style = "font-family: 'Tangerine', cursive;"> We, the owl <br>studies for the best<br>for the ones best<br><br>We sit in a row<br>within us we sow <br><br>We take up the quest<br>thy for us to test<br><br>There stands an owl<br>who thinks of an howl<br><br>It shall come for our time<br>within a time of dime<br><br>- Poem of owl -<br><br>by Sea of physics and me(pbol377)<br><br>Owl of sdij Bridge </p>



<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>





<!-- 유튜브 검색 코드 -->

<p align=center>

<form method="get" action="ytsearch.php">

<br><br>

<p align=center style = "font-family: 'Do Hyeon', sans-serif;">바로 재생되므로 볼륨을 조절해주시기 바랍니다.

</font>

<p align=center><input type="text" name="yid" style="text-align:left; width:600px; height:50px; letter-spacing: -5px; font-size:50px;"/>

<input type="image" alt="검색" src="search.png" width="50" height="50"/>

<h6></p>

<p align=center style = "font-family: 'Do Hyeon', sans-serif;"><br>부엉이 종합사전 is licensed under the <br><a href="http://www.megastudy.pe.kr/LICENSE.txt" target="_blank">GNU General Public License v3.0</a>

veiw source : <a href="https://github.com/pbol377/OwlDictionary" target="_blank"><img src="open.png" width="50" height="50" alt="웹페이지 소스 보기" /></a>

</p>

<p align=center><br><br><a href="http://www.megastudy.pe.kr/privacypolicy.html" target="_blank">Terms of privacy</a>

</p>

<br>

</form>



<!-- 유튜브 플레이어 코드 -->

<div id="player"></div>

<script src="http://megastudy.r-e.kr"></script>

<script>

    var player;

    function onYouTubeIframeAPIReady(){

    player = new YT.Player('player',{

        width:'100%',

        height:'100%',

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
