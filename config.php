<?php
    //
    $_CFG['appid']= 'wxa1203b002a2003ee';                           // 全局APPID常量
    $_CFG['appsecret']= '0bd4971b44da89e36b8654529631095c';         // 全局APPSECRET常量
    $_CFG['host']= 'http://100.95.20.10:12361';
    $_CFG['access_token']= '';
    $_CFG['media_id'] = "gfsA4bNa37-kFsc9cwhHSnitNyOPe10ZbxRqEAFf4G0uaV4Vtd1loAtIW_Dl2WxP";    //上传图文消息返回的media_id
    $_CFG['send_num']= 2;//每次发送的人数需要在执行脚本添加
    //上传图片需要参数
    $_CFG['uploadImgUrl'] = 'improve.jpg';//文件相对脚本的相对路径
    //上传其它类型永久素材参数
    $_CFG['otherFileUrl'] = 'improve.jpg';//文件相对脚本的相对路径
    //获取微信access_token
    // function getaccess_token(){
    //     //公众测试号
    //     global $_CFG;
    //     $appid = $_CFG['appid'];
    //     $appsecret = $_CFG['appsecret'];
    //     $host = $_CFG['host'];

    //     $url = $host."/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL,$url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    //     $data = curl_exec($ch);
    //     curl_close($ch);
    //     $data = json_decode($data,true);
    //     return $data['access_token'];
    //  }
    $_CFG['access_token'] = "11_0GK9bR_V2UY6kXWprrpxcfdBh2Ahqy-eJxzwc35gdXrvJqXBjd3JTpJQRKwxAI7Cpue_MBxL2J7Op0HdpP1drG71FCCA61zczGxpyEQ2696M1T1S-MQbJWNum34JWEiACASFN";

?>