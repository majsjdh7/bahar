<?php
ob_start();
define('API_KEY','5756176030:AAGN2IZOLbY9m7vosqMPKtJ17R2oDMdxnN4');
$admin = ashymashye ;
$idbot = "UserInfoGn_bot";
$channel = "Gladiator_Net";
//=============//
function takparbot($method,$datas=[]){
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
//================//
$menuadmin = json_encode(['keyboard'=>[
 [
['text'=>"📤فوروارد همگانی📤"],['text'=>"📬پیام همگانی📬"]
],
 [
['text'=>"📊 آمار 📊"]
],
],'resize_keyboard'=>true]);
$backadmin = json_encode(['keyboard'=>[
[
['text'=>'بازگشت به پنل مدیریت']
],
],'resize_keyboard'=>false]);


//متغیر ها
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$forward_chat_msg_id = $update->message->forward_from_message_id;
$from_id = $message->from->id;
mkdir("data");
mkdir("data/$from_id");
$reply = $update->message->reply_to_message->forward_from->id;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$username = $message->from->username;
$forward_chat_username = $message->forward_from_chat->username;
$forward_chat_id = $message->forward_from_chat->id;
$forward = $update->message->forward_from;
$forward_first = $update->message->forward_from->first_name;
$forward_last = $update->message->forward_from->last_name;
$forward_user = $update->message->forward_from->username;
$forward_id = $update->message->forward_from->id;
$text = $message->text;
$step= file_get_contents("data/$from_id/file.txt");
$data = file_get_contents("data/$from_id/mamal.txt");
//================//

function SendMessage($chatid,$text,$parsmde,$disable_web_page_preview,$keyboard){
    takparbot('sendMessage',[
        'chat_id'=>$chatid,
        'text'=>$text,
        'parse_mode'=>$parsmde,
        'disable_web_page_preview'=>$disable_web_page_preview,
        'reply_markup'=>$keyboard
    ]);
}
function save($filename, $data)
{
$file = fopen($filename, 'w');
fwrite($file, $data);
fclose($file);
}
function sendAction($chat_id, $action){
takparbot('sendChataction',[
'chat_id'=>$chat_id,
'action'=>$action]);
}
function Forward($berekoja,$azchejaei,$kodompayam)
{
takparbot('ForwardMessage',[
'chat_id'=>$berekoja,
'from_chat_id'=>$azchejaei,
'message_id'=>$kodompayam
]);
}
function SendVideo($chatid, $video, $captionl)
{
    takparbot('SendVideo', [
        'chat_id' => $chatid,
        'video' => $video,
        'caption' => $caption
    ]);
}
function sendphoto($chat_id, $photo, $captionl){
takparbot('sendphoto',[
'chat_id'=>$chat_id,
'photo'=>$photo,
'caption'=>$caption
 ]);
 }
//===============//



$truechannel = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@".$channel."&user_id=".$from_id));
$tch = $truechannel->result->status;
if($tch != 'member' && $tch != 'creator' && $tch != 'administrator'){
    SendMessage($chat_id,"📛 برای حمایت از ما و همچنان ربات ابتدا وارد کانال زیر بشید 👇

@$channel

✅ سپس روی JOIN بزنید و به ربات برگشته عبارت 👇

🔸 /start
");
return ;
}
//==============//
	if ($text == "/start") {
		if (!file_exists("data/$from_id/mamal.txt")) {
        mkdir("data/$from_id");
        file_put_contents("data/$from_id/mamal.txt","none");
        $myfile2 = fopen("member.txt", "a") or die("Unable to open file!");
        fwrite($myfile2, "$from_id\n");
        fclose($myfile2);
    }
SendMessage($chat_id,"سلام لطفا پیامی برای من ارسال یا فوروارد کن تا اطلاعاتشو برات ارسال کنم😁");

	}
	elseif($text == "پنل" && $from_id == $admin or $text == "بازگشت به پنل مدیریت" && $from_id == $admin){
		save("data/$from_id/mamal.txt","n");  
	SendMessage($chat_id,"به پنل مدیریت خوش اومدی❤️🌹","html","true",$menuadmin);
	}
	elseif($text == "➿ویژه کردن➿" && $from_id == $admin){
		save("data/$from_id/mamal.txt","vips");  
	SendMessage($chat_id,"ای دی عددی فرد رو وارد  بفرست تا ویژه بشه");
	}
	elseif($data == "vips" && $chat_id == $admin){
    save("data/$from_id/mamal.txt","no");
    save("data/$text/davat.txt",7);
    SendMessage($text,"حساب شما توسط مدیر ربات با موفقیت ویژه شد✅
حالا میتونی ب تعداد نا محدود لوگو بسازی😁");
    SendMessage($chat_id,"ویژه شد✅");
    }
	elseif($text == "📊 آمار 📊" && $from_id == $admin){
		$user = file_get_contents("member.txt");
    $member_id = explode("\n",$user);
    $member_count = count($member_id) -1;
 SendMessage($chat_id ," 📊 آمار کاربران 📊  : $member_count");
}
elseif($text == "📬پیام همگانی📬" && $from_id == $admin){
    save("data/$from_id/mamal.txt","send");  
    SendMessage($chat_id,"📝 پیام مورد نظر رو در قالب متن بفرستید","html","true",$backadmin);
}
elseif($data == "send" && $chat_id == $admin){
    save("data/$from_id/mamal.txt","no");
    SendMessage($chat_id," 📬پیام همگانی ارسال شد","html","true",$menuadmin);
 $all_member = fopen( "member.txt", "r");
  while( !feof( $all_member)) {
    $user = fgets( $all_member);
   SendMessage($user,$text);
  }
}
elseif($text == "📤فوروارد همگانی📤" && $from_id == $admin){
    save("data/$from_id/mamal.txt","fwd");
    SendMessage($chat_id,"پیام خودتون را فوروارد کنید:","html","true",$backadmin);
 }
elseif($data == "fwd" && $chat_id == $admin){
    save("data/$from_id/mamal.txt","no");
    SendMessage($chat_id,"درحال ارسال...","html","true",$backadmin);
$forp = fopen( "member.txt", 'r'); 
while( !feof( $forp)) { 
$fakar = fgets( $forp); 
Forward($fakar, $chat_id,$message_id); 
  } 
  SendMessage($chat_id,"با موفقیت ارسال شد.","html","true",$menuadmin);
}
	elseif($message){
	if(isset($message->forward_from_chat)){
		if($forward_chat_username != null){
		SendMessage($chat_id,"channel id : <code>$forward_chat_id</code>
channel username : @$forward_chat_username
link post : https://telegram.me/$forward_chat_username/$forward_chat_msg_id

🔅@$idbot","html");
return ;
}else{
	SendMessage($chat_id,"channel id : <code>$forward_chat_id</code>

🔅@$idbot","html");
return ;
	}
	}
	if($forward == null){
		if($username != null){
		SendMessage($chat_id,"first name : $first_name
		last name : $last_name
		username : @$username
		id :<code>$from_id</code>

🔅@$idbot
","html");
}else{
	SendMessage($chat_id,"first name : $first_name
		last name : $last_name
		username : null
		id :<code>$from_id</code>

🔅@$idbot
","html");
}
}else{
	if($forward_user != null){
	SendMessage($chat_id,"
		first name : $forward_first
		last name : $forward_last
		username : @$forward_user
		id :<code>$forward_id</code>

🔅@$idbot
","html");
	}else{
		
	SendMessage($chat_id,"
		first name : $forward_first
		last name : $forward_last
		username : null
		id :<code>$forward_id</code>

🔅@$idbot
","html");
}
	}
	}
	
	
/*the end...:)*/

?>
