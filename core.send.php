<?php
date_default_timezone_set( 'Asia/Shanghai' );

$runtime=date("H:i",time());

$arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  
 $newsapi="https://news.topurl.cn/api";
 global $newsdata;
    $newsdata=file_get_contents($newsapi,false, stream_context_create($arrContextOptions));
    $newsdata=json_decode($newsdata,true);
    $mpconfig=array(
        "appid"=>"",
        "appkey"=>"",
        "lovestart"=>"",
        "birthday"=>"",
        "city"=>"",
        "template_id"=>"",
    )

   startsenddata($mpconfig);


function startsenddata($mpconfig){
$appId = $mpconfig['appid']; //对应自己的appId
$appSecret = $mpconfig['appkey'];  //对应自己的appSecret
$wxgzhurl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $appId . "&secret=" . $appSecret;
$access_token_Arr = https_request($wxgzhurl);
$access_token = json_decode($access_token_Arr, true);
$ACCESS_TOKEN = $access_token['access_token']; //ACCESS_TOKEN


// 什么时候恋爱的(格式别错)
$lovestart = strtotime($mpconfig['lovestart']);
$end = time();
$love = ceil(($end - $lovestart) / 86400);

// 下一个生日是哪一天(格式别错)
$birthdaystart = strtotime(getbirthday($mpconfig['birthday']));
$end = time();
$diff_days = ($birthdaystart - $end);
$birthday = (int)($diff_days/86400);
$birthday = str_replace("-", "", $birthday);

//
// 下一个生日是哪一天(格式别错)
$birthdaystart1 = strtotime(getbirthday($mpconfig['my_birthday']));
$end = time();
$diff_days1 = ($birthdaystart1 - $end);
$birthday1 = (int)($diff_days1/86400);
$birthday1 = str_replace("-", "", $birthday1);




// 你自己的一句话
$yjh = $mpconfig['yjh']; //可以留空 也可以写上一句
//print_r($envdata)
$touser = $mpconfig['nvp_openid'];  //这个填你女朋友的openid
$weatherdata=json_decode(getweather($mpconfig['city']),true);
//print_r($weatherdata);
global $newsdata;
$duanyu=$newsdata['data']['sentence']['author'].":".$newsdata['data']['sentence']['sentence'];

$data = array(
    'touser' => $touser,
    'template_id' => $mpconfig['templateid'],
        "topcolor"=>"#FF00FF",
    'data' => array(
        'first' => array(
            'value' => getzhou(),
            'color' => "#8A2BE2"
        ),
        'keyword1' => array(
            'value' => $mpconfig['city_label'],
            'color' => "#000"
        ),
        'keyword2' => array(
            'value' => $weatherdata['forecasts'][0]['casts'][0]['dayweather'],
            'color' => "#000"
        ),
        'keyword3' => array(
            'value' => $weatherdata['forecasts'][0]['casts'][0]['nighttemp']."°C",
            'color' => "#66CCFF"
        ),
        'keyword4' => array(
            'value' => $weatherdata['forecasts'][0]['casts'][0]['daytemp']."°C",
            'color' => "#FF0000"
        ),
        'keyword5' => array(
            'value' => $love,
            'color' => "#000"
        ),
        'keyword6' => array(
            'value' => $birthday,
            'color' => "#000"
        ),
        'keyword7' => array(
            'value' => $birthday1,
            'color' => "#000"
        ),
        'keyword8' => array(
            'value' => $duanyu,
            'color' => "#000"
        ),
        'remark' => array(
            'value' => $mpconfig['yjh'],
            'color' => "#996600"
        ),
    )
);

// 下面这些就不需要动了————————————————————————————————————————————————————————————————————————————————————————————
$json_data = json_encode($data);
$url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $ACCESS_TOKEN;
$res = https_request($url, urldecode($json_data));
$res = json_decode($res, true);
//print_r($res);
if ($res['errcode'] == 0 && $res['errcode'] == "ok") {
    echo "发送成功！<br/>";
}else {
        echo "发送失败！请检查代码！！！<br/>";
}

}
function https_request($url, $data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}
function getbirthday($da){
    $today_riqi=date("m-d",time());
$today_y=date("Y",time());
if($today_riqi<$da){
    $birstr=$today_y."-".$da;
}else{
    $nextyear=mktime(0,0,0,date("m"),date("d"),date("Y")+1);  
	 $next_riqi=date('Y',$nextyear);
	   $birstr=$next_riqi."-".$da;
}
return $birstr;
}

function getzhou(){
global $newsdata;
$weekarray=array("日","一","二","三","四","五","六");

//先定义一个数组
//return "今天星期".$weekarray[date("w")];
return "今天 星期".$weekarray[date("w")].' 农历 '.$newsdata['data']['calendar']['monthCn'].$newsdata['data']['calendar']['dayCn'];
}


function getweather($adcode){
    $apiurl="https://restapi.amap.com/v3/weather/weatherInfo?city={$adcode}&key=your key&extensions=all";
    $resdata=getcurl($apiurl);
    return $resdata;
}
function getcurl($targetUrl) {

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $targetUrl);
    curl_setopt($ch, CURLOPT_POST, 0);


    



    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);


    curl_setopt ($ch, CURLOPT_HEADER, 0);


    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=UTF-8',
    )); //设置请求头为json
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727;)");
    //  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727;)");
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);

    curl_setopt($ch, CURLOPT_TIMEOUT, 5);

    curl_setopt($ch, CURLOPT_HEADER, false);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);

    curl_close($ch);

    return $result;
}
