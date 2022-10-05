<?php
/*
🔥کانال  ایلیا سورس🔥
برای دریافت سورس های بیشتر به کانال ما سر بزنید :) 
@Source_Eliya
*/
ob_start();
$load = sys_getloadavg();
$telegram_ip_ranges = [
['lower' => '149.154.160.0', 'upper' => '149.154.175.255'], 
['lower' => '91.108.4.0',    'upper' => '91.108.7.255'],    
];
$ip_dec = (float) sprintf("%u", ip2long($_SERVER['REMOTE_ADDR']));
$ok=false;
foreach ($telegram_ip_ranges as $telegram_ip_range) if (!$ok) {
$lower_dec = (float) sprintf("%u", ip2long($telegram_ip_range['lower']));
$upper_dec = (float) sprintf("%u", ip2long($telegram_ip_range['upper']));
if($ip_dec >= $lower_dec and $ip_dec <= $upper_dec) $ok=true;
}
if(!$ok) die("Fuck_You :)");
error_reporting(0);
$token = '5394201873:AAHeb92-3wAPSO-LlStJkDT6vj2MdfIgH6E'; //توکن بذارید
define('API_KEY',$token);
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
function SendMessage($chat_id,$text,$mode,$keyboard,$reply,$disable='true'){
return bot('SendMessage',[
'chat_id'=>$chat_id,
'text'=>$text,
'parse_mode'=>$mode,
'reply_to_message_id'=>$reply,
'disable_web_page_preview'=>$disable,
'reply_markup'=>$keyboard
]);
}
function EditMessage($chat_id,$message_id,$text,$mode,$keyboard){
return bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>$text,
'parse_mode'=>$mode,
'reply_markup'=>$keyboard
]);    
}
function DeleteMessage($chat_id,$message_id){
return bot('deletemessage', [
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
}

function Forward($KojaShe,$AzKoja,$KodomMSG){
return bot('ForwardMessage',[
'chat_id'=>$KojaShe,
'from_chat_id'=>$AzKoja,
'message_id'=>$KodomMSG
]);
}
function SendPhoto($chat_id,$photo,$keyboard,$caption,$reply){
return bot('SendPhoto',[
'chat_id'=>$chat_id,
'photo'=>$photo,
'caption'=>$caption
]);
}
function SendAudio($chatid,$audio,$keyboard,$caption,$reply,$title,$sazande){
return bot('SendAudio',[
'chat_id'=>$chatid,
'audio'=>$audio,
'caption'=>$caption,
'performer'=>$sazande,
'title'=>$title,
'reply_to_message_id'=>$reply,
'reply_markup'=>$keyboard
]);
}
function SendDocument($chatid,$document,$keyboard,$caption,$reply){
return bot('SendDocument',[
'chat_id'=>$chatid,
'document'=>$document,
'caption'=>$caption,
'reply_to_message_id'=>$reply,
'reply_markup'=>$keyboard
]);
}
function SendVideo($chatid,$video,$keyboard,$caption,$reply,$duration){
return bot('SendVideo',[
'chat_id'=>$chatid,
'video'=>$video,
'caption'=>$caption,
'reply_to_message_id'=>$reply,
'duration'=>$duration,
'reply_markup'=>$keyboard
]);
}

function save($filename,$TXTdata){
$myfile = fopen($filename,"w") or die("Unable to open file!");
fwrite($myfile,"$TXTdata");
fclose($myfile);
}
  function save2($data, $dir){
       $f = fopen("media/$dir","a") or die("Error to open file!");
       fwrite($f, "$data,");
       fclose($f);
  }
function KickChatMember($chatid,$user_id){
	bot('kickChatMember',[
	'chat_id'=>$chatid,
	'user_id'=>$user_id
	]);
	}
	/* Tabee Leave Chat */
function LeaveChat($chatid){
	bot('LeaveChat',[
	'chat_id'=>$chatid
	]);
	}
	/* Tabee Get Chat */
function getChat($idchat){
	$json=file_get_contents('https://api.telegram.org/bot'.API_KEY."/getChat?chat_id=".$idchat);
	$data=json_decode($json,true);
	return $data["result"]["first_name"];
}
	/* Tabee Get Chat Members Count */
function GetChatMembersCount($chatid){
	bot('getChatMembersCount',[
	'chat_id'=>$chatid
	]);
	}
	/* Tabee Get Chat Member */
function GetChatMember($chatid,$userid){
	$truechannel = json_decode(file_get_contents('https://api.telegram.org/bot'.API_KEY."/getChatMember?chat_id=".$chatid."&user_id=".$userid));
	$tch = $truechannel->result->status;
	return $tch;
	}
 /////// 
$update = json_decode(file_get_contents('php://input'),true);
if(isset($update['message'])){
    $message = $update['message'];
    $chat_id = $message['chat']['id'];
    $message_id = $message['message_id'];
    $text = $message['text'];
    $from_id = $message['from']['id'];
    $firstname = $message['from']['first_name'];
    $lastname = isset($message['from']['last_name']) ? null:null;
    $username = isset($message['from']['username']) ?'@'.null:null;
    $video = $message['video'];
    $video_id = $message['video']['file_id'];
    $photo = $message['photo'];
    $photo_id = $message['photo'][0]['file_id'];
    $doc = $message['document'];
    $doc_id = $message['document']['file_id'];
    $forward_id = $update->message->forward_from->id;
$forward_chat = $update->message->forward_from_chat;
$forward_chat_username = $update->message->forward_from_chat->username;
$forward_from = $message->forward_from;
$forward_from_chat = $message->forward_from_chat;
$forward_id = $forward_from->id;
$forward_name = $forward_from->first_name;
$stickerid = $message->sticker->file_id;
$videoid = $message->video->file_id;
$voiceid = $message->voice->file_id;
$fileid = $message->document->file_id;
$photoid = $photo[count($photo)-1]->file_id;
$musicid = $message->audio->file_id;
$music_name = $message->audio->title;
$videonoteid = $message->video_note->file_id;
$caption = $update->message->caption;
}
$db = file_get_contents(json_decode('data.json',true));
$gif = file_get_contents("media/gif.txt");
$vid = file_get_contents("media/vid.txt");
$pics = file_get_contents("media/pic.txt");
$db = file_get_contents(json_decode('data.json',true));
$gif = file_get_contents("media/gif.txt");
$vid = file_get_contents("media/vid.txt");
$pics = file_get_contents("media/pic.txt");
$sudo = ["336414094","336414094","336414094"]; //آیدی عددی ادمین
$channel = file_get_contents("channel.txt");
$tc = $update->message->chat->type;
$truechannel = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=@$channel&user_id=".$from_id));
$tch = $truechannel->result->status;
$bot_date = date('Ymd');
$step = file_get_contents("step.txt");
mkdir("media");

if(in_array($from_id, $list['ban'])){
SendMessage($chat_id,"
شما از این ربات مسدود شده اید ❌
",null);
exit();
}else{
function Spam($from_id){
@mkdir("spam");
$spam_status = json_decode(file_get_contents("$from_id.json"),true);
if($spam_status != null){
if(mb_strpos($spam_status[0],"time") !== false){
if(str_replace("time ",null,$spam_status[0]) >= time())
exit(false);
else
$spam_status = [1,time()+2];
}
elseif(time() < $spam_status[1]){
if($spam_status[0]+1 > 3){
$time = time() + 100;
$spam_status = ["time $time"];
file_put_contents("$from_id.json",json_encode($spam_status,true));
bot('SendMessage',[
'chat_id'=>$from_id,
'text'=>"⚠️به علت اسپم به مدت ۱۰۰ ثانیه مسدود شده اید ❗️ 
✅لطفا با ربات آهسته کار کنید !"
]);
exit(false);
}else{
$spam_status = [$spam_status[0]+1,$spam_status[1]];
}
}else{
$spam_status = [1,time()+2];
}
}else{
$spam_status = [1,time()+2];
}
file_put_contents("$from_id.json",json_encode($spam_status,true));
}
}
Spam($from_id);
///////////
$keyMedia = json_encode([
      'keyboard'=> [
      [['text'=> '+ عکس'],['text'=> '+ فیلم']],
      [['text'=> '+ گیف'], ['text'=> 'بازگشت']]
      ],'resize_keyboard'=> true
]);

$keyHome = json_encode([
      'keyboard'=> [
      [['text'=> '🖼عکس🖼'],['text'=> '🎞فیلم🎞']],
      [['text'=>"📀گیف📀"]],
      ],'resize_keyboard'=> true
]);
$keyPanel = json_encode([
      'keyboard'=> [
      [['text'=> 'آمار'],['text'=>"تنظیم کانال جوین اجباری 🔊"]],
      [['text'=>"📍 ارسال به همه"],['text'=>"📍 فروارد همگانی"]],
         [['text'=> 'افزودن مدیا +'],['text'=>'/start']],
      ],'resize_keyboard'=> true
]);
$keyBack = json_encode([
      'keyboard'=> [
      [['text'=> 'بازگشت']]
      ],'resize_keyboard'=> true
]);
$keyRemove = json_encode([
      'ReplyKeyboardRemove'=>[
       []
      ],'remove_keyboard'=> true
      
      
]);

  $user = file_get_contents('members.txt');
        $members = explode("\n", $user);
        if (!in_array($from_id, $members)) {
            $add_user = file_get_contents('members.txt');
            $add_user .= $from_id . "\n";
             file_put_contents('members.txt', $add_user);	
}
if(preg_match('/^\/start$/i',$text)){
    bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"🌹سلام به ربات ما خوش اومدی با این ربات میتونی بی نهایت فیلم بگیری🥰",
'reply_markup'=>$keyHome
]);
}

/*
🔥کانال  ایلیا سورس🔥
برای دریافت سورس های بیشتر به کانال ما سر بزنید :) 
@Source_Eliya
*/
if($text == '🖼عکس🖼'){
$tch = Bot('getChatMember',['chat_id'=>"@$channel",'user_id'=>$from_id])->result->status;
if($tch == 'member' | $tch == 'creator' | $tch == 'administrator'){
    $jo = $mphoto + 1;
    save($from_id ,"photo", "$jo");
   $ex = explode(",",$pics);
	$rand = rand(1, count($ex)-1) - 1;
	$send = $ex[$rand];
     $mi = bot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>"$send",
'caption'=>"ربات فول سکسیمون♥️😵💦
کص زن آدم دروغگو😒😒😒
",
  ]);
    $nop = 60;////بعد از چند ثانیه پاک بشه
      $send = bot('sendmessage',[
  'chat_id'=>$chat_id,
'text'=>"<pre>عکس بالا در <i>$nop</i> ثانیه دیگر به صورت خودکار پاک میشود.
لطفا آن را برای پیام های ذخیره شده ارسال کنید.</pre>
",
'parse_mode'=>'HTML',     
]);
while($nop >= 1){
sleep(1);
$nop--;
$id = $send->result->message_id;
   bot('editmessagetext',[
                'chat_id'=>$chat_id,
                'message_id'=>$id,
'text'=>"<pre>عکس بالا در <i>$nop</i> ثانیه دیگر به صورت خودکار پاک میشود.
لطفا آن را برای پیام های ذخیره شده ارسال کنید.</pre>
",
'parse_mode'=>'HTML',     
]);}
sleep(1);
 $no = $mi->result->message_id;
  bot('deletemessage',[
  'chat_id'=>$chat_id,
    'message_id'=>$no,
    ]);
     bot('editmessagetext',[
                'chat_id'=>$chat_id,
                'message_id'=>$id,
                'text'=>" <i> این پیام حذف شد </i>",
                'parse_mode'=>'HTML',     
]);
 }else{
        bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا ابتدا در کانال های ما عضو شوید 
@$channel
بعد گزینه مورد نظر را انتخاب کنید❗️",
]);
}}
/*
🔥کانال  ایلیا سورس🔥
برای دریافت سورس های بیشتر به کانال ما سر بزنید :) 
@Source_Eliya
*/
if($text == '🎞فیلم🎞'){
$tch = Bot('getChatMember',['chat_id'=>"@$channel",'user_id'=>$from_id])->result->status;
if($tch == 'member' | $tch == 'creator' | $tch == 'administrator'){
       $jo = $mvideo + 1;
    save($from_id ,"video", "$jo");
   $ex = explode(",",$vid);
	$rand = rand(1, count($ex)-1) - 1;
	$send = $ex[$rand];
	 $mi = bot('sendvideo',[
'chat_id'=>$chat_id,
'video'=>"$send",
   'parse_mode'=>'HTML',
   'caption'=>"ربات فول سکسیمون♥️😵💦
کص زن آدم دروغگو😒😒😒
",
   ]);
    $nop = 60;////بعد از چند ثانیه پاک بشه
      $send = bot('sendmessage',[
  'chat_id'=>$chat_id,
'text'=>"<pre>فیلم بالا در <i>$nop</i> ثانیه دیگر به صورت خودکار پاک میشود.
لطفا آن را برای پیام های ذخیره شده ارسال کنید.</pre>
",
'parse_mode'=>'HTML',     
]);
while($nop >= 1){
sleep(1);
$nop--;
$id = $send->result->message_id;
   bot('editmessagetext',[
                'chat_id'=>$chat_id,
                'message_id'=>$id,
'text'=>"<pre>فیلم بالا در <i>$nop</i> ثانیه دیگر به صورت خودکار پاک میشود.
لطفا آن را برای پیام های ذخیره شده ارسال کنید.</pre>
",
'parse_mode'=>'HTML',     
]);}
sleep(1);
 $no = $mi->result->message_id;
  bot('deletemessage',[
  'chat_id'=>$chat_id,
    'message_id'=>$no,
    ]);
     bot('editmessagetext',[
                'chat_id'=>$chat_id,
                'message_id'=>$id,
                'text'=>" <i> این پیام حذف شد </i>",
                'parse_mode'=>'HTML',     
]);
}else{
        bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا ابتدا در کانال های ما عضو شوید 
@$channel
بعد گزینه مورد نظر را انتخاب کنید❗️",
]);
}}
/*
🔥کانال  ایلیا سورس🔥
برای دریافت سورس های بیشتر به کانال ما سر بزنید :) 
@Source_Eliya
*/
elseif($text == '📀گیف📀'){
$tch = Bot('getChatMember',['chat_id'=>"@$channel",'user_id'=>$from_id])->result->status;
if($tch == 'member' | $tch == 'creator' | $tch == 'administrator'){
    if(file_exists("media/gif.txt")){
       $jo = $mgif + 1;
    save($from_id ,"gif", "$jo");
   $ex = explode(",",$gif);
	$rand = rand(1, count($ex)-1) - 1;
	$send = $ex[$rand];
	 $mi = bot('SendDocument',[
'chat_id'=>$chat_id,
'document'=>"$send",
   'parse_mode'=>'HTML',
'caption'=>"ربات فول سکسیمون♥️😵💦
کص زن آدم دروغگو😒😒😒
",
   ]);
    $nop = 60;////بعد از چند ثانیه پاک بشه
      $send = bot('sendmessage',[
  'chat_id'=>$chat_id,
'text'=>"<pre>گیف بالا در <i>$nop</i> ثانیه دیگر به صورت خودکار پاک میشود.
لطفا آن را برای پیام های ذخیره شده ارسال کنید.</pre>
",
'parse_mode'=>'HTML',     
]);
while($nop >= 1){
sleep(1);
$nop--;
$id = $send->result->message_id;
   bot('editmessagetext',[
                'chat_id'=>$chat_id,
                'message_id'=>$id,
'text'=>"<pre>گیف بالا در <i>$nop</i> ثانیه دیگر به صورت خودکار پاک میشود.
لطفا آن را برای پیام های ذخیره شده ارسال کنید.</pre>
",
'parse_mode'=>'HTML',     
]);}
sleep(1);
 $no = $mi->result->message_id;
  bot('deletemessage',[
  'chat_id'=>$chat_id,
    'message_id'=>$no,
    ]);
     bot('editmessagetext',[
                'chat_id'=>$chat_id,
                'message_id'=>$id,
                'text'=>" <i> این پیام حذف شد </i>",
                'parse_mode'=>'HTML',     
]);
}else{
        bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"🌹فعلا گیفی موجود نمی باشد!️",
]);
}}else{
        bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا ابتدا در کانال های ما عضو شوید 
@$channel
بعد گزینه مورد نظر را انتخاب کنید❗️",
]);
}}


/*
🔥کانال  ایلیا سورس🔥
برای دریافت سورس های بیشتر به کانال ما سر بزنید :) 
@Source_Eliya
*/
elseif($text == "/panel" || $text == "بازگشت"){
if(in_array($from_id , $sudo)){
      save("step.txt",'none');
  bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>'<pre>سلام ادمین جان به پنل مدیریت خوش اومدی</pre>',
	   'parse_mode'=>'HTML',
	   'reply_markup'=>$keyPanel
	   ]);
}}
elseif($text == 'آمار' && in_array($from_id , $sudo)){
  $user = file_get_contents("members.txt");
    $member_id = explode("\n",$user);
    $counts = count($member_id) -1;
    $picc = count(explode(",", $pics)) - 1;
    $vidd = count(explode(",", $vid)) - 1;
    $giff = count(explode(",", $gif)) - 1;
	 bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"💎تعداد اعضا : $counts ■تعداد فیلم ها : $vidd ■ تعداد عکس ها : $picc ■ تعداد گیف ها : $giff",
'parse_mode'=>'HTML',
   ]);
}

elseif($text == 'افزودن مدیا +'  && in_array($from_id , $sudo)){
 bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا نوع مدیا خود را انتخاب کنید :",
'reply_markup'=>$keyMedia
]);
}
elseif($text == '+ گیف' or $text == '+ عکس' or $text == '+ فیلم'  && in_array($from_id , $sudo)){
    $fa = ["+ گیف","+ فیلم","+ عکس"];
    $en = ['gif','film','photo'];
    $str = str_replace($fa,$en,$text);
    save("step.txt","$str");
    bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا $text های خود را ارسال کنید و در آخر گزینه بازگشت را بزنید",
  'reply_markup'=>$keyBack
  ]);
}
elseif($step == 'film' && isset($video)){
    save2($video_id,"vid.txt");
       bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"فیلم شما ذخیره شد فیلم های دیگر هم دارید ارسال کنید در غیر این صورت بازگشت را بزنید",
  'reply_markup'=>$keyBack
  ]);
}
elseif($step == 'photo' && isset($photo)){
   save2($photo_id,"pic.txt");
      bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"عکس شما ذخیره شد عکس های دیگر هم دارید ارسال کنید در غیر این صورت بازگشت را بزنید",
 'reply_markup'=>$keyBack
  ]);
}
elseif($step == 'gif' && isset($doc)){
    save2($doc_id,"gif.txt");
     bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"گیف شما ذخیره شد گیف های دیگر هم دارید ارسال کنید در غیر این صورت بازگشت را بزنید",
 'reply_markup'=>$keyBac
  ]);
}
elseif($text == "📍 فروارد همگانی" && in_array($chat_id,$sudo)){
         save("step.txt",'fwd');
    bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"پیام خودتون را فروراد کنید:",
    'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'/panel']],
      ],'resize_keyboard'=>true])
  ]);
}
elseif($step == "fwd" && $text!="/panel"){
   save("step.txt","none");
  bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"با موفقیت فروارد شد.",
  ]);
	$all_member = fopen( "members.txt", "r");
		while( !feof( $all_member)) {
 			$user = fgets( $all_member);
	$id = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChat?chat_id=".$user));
	$user2 = $id->result->id;
if($user2 != null){
			    bot('ForwardMessage',[
        'chat_id'=>$user,
        'from_chat_id'=>$chat_id,
        'message_id'=>$message_id
    ]);
}
		}
}

elseif($text == "📍 ارسال به همه" && in_array($chat_id,$sudo)){
      save("step.txt",'send');
 bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"پیام خود را در قالب متن بفرستید:",
'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'/panel']],
      ],'resize_keyboard'=>true])
  ]);
}
elseif($step == "send" && $text!="/panel" && in_array($chat_id,$sudo)){
   save("step.txt","none");
  bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅ پیام همگانی فرستاده شد.",
  ]);
		$all_member = fopen( "members.txt", 'r');
		while( !feof( $all_member)) {
 			$user = fgets( $all_member);
	$id = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChat?chat_id=".$user));
	$user2 = $id->result->id;
if($user2 != null){
			if($text != null){
	bot('sendMessage', [
	'chat_id' =>$user,
	'text' =>$text,
	'parse_mode' =>"html",
	'disable_web_page_preview' =>"true"
	]);
			}
}
		}
}
elseif($text == "تنظیم کانال جوین اجباری 🔊" && in_array($from_id , $sudo)){
save("step.txt","set join channel");
SendMessage($chat_id,"💠 لطفا آیدی کانال مورد نظر را بدن @ ارسال کنید

👈🏻 توجه : ربات باید مدیر کانال مورد نظر باشد!",'HTML',json_encode(['resize_keyboard'=>true,'keyboard'=>[[['text'=>"انصراف"]],
]
]),$message_id);
}
elseif($step == "set join channel"){
file_put_contents("channel.txt","$text");
save("step.txt",'none');
SendMessage($chat_id,"با موفقیت تنظیم شد👌",'HTML',json_encode(['resize_keyboard'=>true,'keyboard'=>[[['text'=>"بازگشت"]],
]
]),$message_id);
}
elseif($text == "بازگشت" or $text == "انصراف"){
save("step.txt",'none');
SendMessage($chat_id,"✅ به منوی اصلی بازگشتید !
◀️لطفا یکی از قسمت های زیر را جهت ورود انتخاب نمایید.",'HTML',$keyHome,$message_id);
}
/*
🔥کانال  ایلیا سورس🔥
برای دریافت سورس های بیشتر به کانال ما سر بزنید :) 
@Source_Eliya
*/

?>
