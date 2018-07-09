
<?php
  include "config.php";
  $_CFG['open_File'] = $argv[1];//需要在执行时带入的openid文件包名称
  //打开openid文件包
  $myfile = fopen($_CFG['open_File'], "a+") or die("Unable to open file!");
  //读取单行文件内容
  $contentchild = array();
  $line = 0;

  $sendfile = fopen($_CFG['open_File'].".sendFile.txt", "a+") or die("Unable to open file!");//预备发送的openid
  $sendsuccess = fopen($_CFG['open_File'].".sendSuccess.txt", "a+") or die("Unable to open file!");//发送成功的openid
  $failinsend = fopen($_CFG['open_File'].".failInSend.txt", "a+") or die("Unable to open file!");//发送失败的openid

  while(!feof($myfile)) { 
    array_push($contentchild, str_replace(array("\r\n", "\r", "\n"),'',fgets($myfile)));
    if(($line+1)%$_CFG['send_num']==0||feof($myfile)){
      getOpenid();
      array_splice($contentchild, 0, count($contentchild));
    }
    $line++;
  }

  fclose($sendfile);//关闭预备发送的openid文件
  fclose($sendsuccess);//关闭发送成功的的openid文件
  fclose($failinsend);//关闭发送失败的openid文件

  function getOpenid(){
    global $_CFG;
    $media_id = $_CFG['media_id'];
    $sendNum = $_CFG['send_num'];
    global $index,$content,$contentLength,$contentchild,$sendfile,$sendsuccess,$failinsend;
       echo '发送消息--';
      //将要发送的openid写入openidFile.txt文件
      $txt = json_encode($contentchild); //写文件
      fwrite($sendfile, $txt);
      //调用发送方法
      $returnStatus = json_decode(set_msg($media_id,$contentchild),true);

      var_dump($returnStatus);
        // var_dump($returnStatus);
        if($returnStatus['errcode']=="0"){
          echo '成功'.PHP_EOL;
          //将发送成功的openid写入sendSuccess.txt文件
          $txt = json_encode($contentchild); //写文件
          fwrite($sendsuccess, $txt);
        }else{
          echo '失败'.PHP_EOL;
          //将发送失败的openid写入failInSend.txt文件
          $txt = json_encode($contentchild); //写文件
          fwrite($failinsend, $txt);
        }
  }
  fclose($myfile);  //关闭文件
  //ini_set('memory_limit', '128M');  //设置内存

 function set_msg($mediaid,$openidall){
    global $_CFG;
    $host = $_CFG['host'];
    $access_token = $_CFG['access_token'];
    // 发送图文消息模板
    //openid一次最多10000个
    $formwork = '{
       "touser":[
       ],
       "mpnews":{
          "media_id":""
       },
        "msgtype":"mpnews",
        "send_ignore_reprint":0
    }';
    //将openid包导入到模板
    $arr = json_decode($formwork,true);
    foreach ($openidall as $key => $value) {
      # code...
      array_push($arr['touser'], $value); 
    };
    // //将media_id导入到模板
    $arr['mpnews']['media_id']=$mediaid;
    $reget = json_encode($arr);
    // var_dump($reget);
    // var_dump($formwork);
    $url = $host."/cgi-bin/message/mass/send?access_token={$access_token}";//正式
    // $url = $host."/cgi-bin/message/mass/preview?access_token={$access_token}";//预览
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($ch, CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$reget);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;

 }

echo '执行完毕';
?>