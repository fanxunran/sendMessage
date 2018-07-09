<?php
include "config.php";

 // 上传图文消息内的图片获取URL
function uploadImg(){
    global $_CFG;
    $host = $_CFG['host'];
    $access_token = $_CFG['access_token'];
    $url = $host."/cgi-bin/media/uploadimg?access_token={$access_token}";//永久
    $ch = curl_init();


    $imgurl = $_CFG['uploadImgUrl'];
    $img_info = array(
      'filename' =>  $imgurl, //图片相对于网站根目录的路径
      // 'content-type' => 'thumb', //文件类型image/jpg
      // 'filelength' => filesize($filelength) //图文大小
    );
   if (class_exists('CURLFile')) {  
        //PHP5.5及以上  
        //realpath返回绝对路径  
        $filedata = array('media' => new CURLFile(realpath($img_info['filename'])));  
    } else {  
        //PHP5.4及以下  
        $filedata = array('media' => '@'.realpath($img_info['filename']));  
    }  
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);//设置为POST方式
    curl_setopt($ch, CURLOPT_POSTFIELDS,$filedata);//POST数据
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    $data = curl_exec($ch);
    $data = json_decode($data,true);
    return $data;
// 返回数据格式
//  {
//     "url":  "http://mmbiz.qpic.cn/mmbiz_jpg/GrM8TpJoiaEiaAKTy2Yf9F9eMpnUwdOsP8y2LdHRyliaCdjwqiblsaXSUFnPdI9ia2UmmjJfhicnNRhUSLpdHa27QRZw/0"
// }
}
// $url_Img = uploadImg();
// var_dump($url_Img);

//新增其它类型永久素材
function uploadOther(){
    global $_CFG;
    $host = $_CFG['host'];
    $access_token = $_CFG['access_token'];
    $type = 'thumb';
    //$type = 'image';//临时
    //$url = $host."/cgi-bin/material/add_material?access_token={$access_token}&type={$type}";//永久素材
    $url = "http://100.95.20.10:12361/cgi-bin/media/upload?access_token={$access_token}&type={$type}";//临时素材
    $ch = curl_init();
    
    $otherfileurl = $_CFG['otherFileUrl'];
    $other_info = array(
      'filename' => $otherfileurl, //图片相对于网站根目录的路径
      'content-type' => 'image/jpg', //文件类型image/jpg
      'filelength' => 100 //文件大小缩略图最大64k
    );
   if (class_exists('CURLFile')) {  
        //PHP5.5及以上  
        //realpath返回绝对路径  
        $filedata = array('media' => new CURLFile(realpath($other_info['filename'])));  
    } else {  
        //PHP5.4及以下  
        $filedata = array('media' => '@'.realpath($other_info['filename']));  
    }  
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);//设置为POST方式
    curl_setopt($ch, CURLOPT_POSTFIELDS,$filedata);//POST数据
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    $data = curl_exec($ch);
    $data = json_decode($data,true);
    return $data;
// 返回数据格式
// {
//   "media_id":cmP2bpEHXXfXxIf3eQYHmOx7n9K_WTuq4Wo-UToDnRo,
//   "url":http://mmbiz.qpic.cn/mmbiz_jpg/GrM8TpJoiaEiaAKTy2Yf9F9eMpnUwdOsP8y2LdHRyliaCdjwqiblsaXSUFnPdI9ia2UmmjJfhicnNRhUSLpdHa27QRZw/0?wx_fmt=jpeg
// }
//临时素材返回结果
//   array(3) {
//   ["type"]=>
//   string(5) "image"
//   ["media_id"]=>
//   string(64) "-slW15Xnw6VNCRXD9pDbySc9S3iTalRtGxzUICRVh4fwIG7fJPRBbK8fFmxXoVd9"
//   ["created_at"]=>
//   int(1529495118)
// }

}
// $urlMedia = uploadOther();
// var_dump($urlMedia);

// 上传图文消息素材正式接口每天10次quate
function uploadNews(){
    global $_CFG;
    $host = $_CFG['host'];
    $access_token = $_CFG['access_token'];
    $url = $host."/cgi-bin/media/uploadnews?access_token={$access_token}";
    $ch = curl_init();
    //图文模板
    $newJons = '{
	   "articles": [    {
	                        "thumb_media_id":"-slW15Xnw6VNCRXD9pDbySc9S3iTalRtGxzUICRVh4fwIG7fJPRBbK8fFmxXoVd9",
	                        "author":"fanxunran",
	                        "title":"掌握这3个姿势，借款成功率提高65%！",
	                        "content_source_url":"https://mp.weixin.qq.com/s/ARx3TsaZip8oF7jdrYn6Sw",
	                        "content":"<section class=\"xmteditor\" style=\"display:none;\" data-tools=\"新媒体管家\" data-label=\"powered by xmt.cn\"></section><p style=\"white-space: normal;\"><span style=\"font-size: 14px;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span style=\"font-size: 16px;\">小编跟微乐粉们唠嗑时，发现很多本来可以顺利借到款的小伙伴却因为各种原因失败了，于是，小编决定把最重要的<span style=\"font-size: 16px;color: rgb(255, 41, 65);\"><strong>三个“姿势”</strong></span>教给大家，一起来学习吧！</span></span><br  /></p><p style=\"white-space: normal;line-height: 1.75em;\"><span style=\"font-size: 18px;\"></span><br  /></p><section class=\"editor\" style=\"white-space: normal;box-sizing: border-box;\"><section style=\"margin-top: 5px;\"><section style=\"display: flex;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;height: 39px;\"><section style=\"background: rgb(44, 192, 255);width: 12px;\"><img data-ratio=\"2.71875\" src=\"https://mmbiz.qpic.cn/mmbiz_png/GCSG9VLghhrRYDqyicn3RFArt0nBEULnveZpTFgQU4JKfbnVsIiczR6RX6pBiaShUdVtF8SyTm9lIzdhrnYTR8oxg/640?wx_fmt=png\" data-type=\"png\" data-w=\"32\" data-width=\"100%\" style=\"width: 100%;vertical-align: top;\"  /></section><section style=\"padding: 2px;border-top: 1px solid rgb(44, 192, 255);border-bottom: 1px solid rgb(44, 192, 255);box-sizing: border-box;\"><section style=\"padding-right: 15px;padding-left: 15px;border-top: 1px solid rgb(44, 192, 255);border-bottom: 1px solid rgb(44, 192, 255);font-size: 16px;color: rgb(44, 192, 255);min-width: 1px;box-sizing: border-box;\"><p><span style=\"font-size: 16px;\"><strong style=\"font-size: 15px;caret-color: red;\"><strong style=\"color: rgb(44, 192, 255);font-size: 16px;white-space: normal;\">姿势一：获得微乐分申请资格</strong></strong><strong style=\"font-size: 15px;caret-color: red;\"></strong></span></p></section></section><section style=\"background: rgb(44, 192, 255);width: 12px;\"><img data-ratio=\"2.71875\" src=\"https://mmbiz.qpic.cn/mmbiz_png/GCSG9VLghhrRYDqyicn3RFArt0nBEULnvcRIeG3Gx29iaaHgXSMIkXrgVAotxGictQ9XsibJzpIqciazQjnfGanSc8w/640?wx_fmt=png\" data-type=\"png\" data-w=\"32\" data-width=\"100%\" style=\"width: 100%;vertical-align: top;\"  /></section></section></section></section><p style=\"white-space: normal;text-indent: 2em;line-height: 1.75em;\"><span style=\"font-size: 16px;\">自上线以来，许多乐粉跑来问小编，为什么他们申请的状态一直是“逐步开放中”。</span></p><p style=\"text-align: center;\"><img class=\"\" data-copyright=\"0\" data-ratio=\"1.0957446808510638\" data-s=\"300,640\" src=\"https://mmbiz.qpic.cn/mmbiz_png/YbjySVybDiasUb5n50NYRmGAezibNwgxL8cFgGGJ7hhb9Pw7Zjwz7scdnqnXWcNRMBlvLZhGiceZGXoQheiaN3BA5g/640?wx_fmt=png\" data-type=\"png\" data-w=\"188\" style=\"\"  /></p><section class=\"editor\" style=\"white-space: normal;border-width: 0px;border-style: none;border-color: initial;box-sizing: border-box;\"><p><span style=\"text-indent: 42px;caret-color: red;font-size: 16px;\">符合<span style=\"text-indent: 42px;caret-color: red;font-size: 16px;color: rgb(255, 41, 65);\"><strong>以下条件</strong></span>越多，越早获取申请资格哟！<br  /></span></p></section><p style=\"white-space: normal;text-indent: 28px;line-height: 1.75em;\"><span style=\"text-indent: 42px;caret-color: red;font-size: 16px;\">1）<strong>完成微信的实名认证</strong>；</span></p><p style=\"white-space: normal;text-indent: 28px;line-height: 1.75em;\"><span style=\"text-indent: 42px;caret-color: red;font-size: 16px;\">2）<strong>多使用微信支付功能，包括发红包，线上、线下的消费</strong>；</span></p><p style=\"white-space: normal;text-indent: 28px;line-height: 1.75em;\"><span style=\"text-indent: 42px;caret-color: red;font-size: 16px;\">3）<strong>使用微信钱包-信用卡还款功能</strong>；</span></p><p style=\"white-space: normal;text-indent: 28px;line-height: 1.75em;\"><span style=\"text-indent: 42px;caret-color: red;font-size: 16px;\">4）<strong>保持良好的信用</strong>。</span></p><p><br  /></p><section class=\"editor\" style=\"white-space: normal;box-sizing: border-box;\"><section style=\"margin-top: 5px;\"><section style=\"display: flex;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;height: 39px;\"><section style=\"background: rgb(44, 192, 255);width: 12px;\"><img data-ratio=\"2.71875\" src=\"https://mmbiz.qpic.cn/mmbiz_png/GCSG9VLghhrRYDqyicn3RFArt0nBEULnveZpTFgQU4JKfbnVsIiczR6RX6pBiaShUdVtF8SyTm9lIzdhrnYTR8oxg/640?wx_fmt=png\" data-type=\"png\" data-w=\"32\" data-width=\"100%\" style=\"width: 100%;vertical-align: top;\"  /></section><section style=\"padding: 2px;border-top: 1px solid rgb(44, 192, 255);border-bottom: 1px solid rgb(44, 192, 255);box-sizing: border-box;\"><section style=\"padding-right: 15px;padding-left: 15px;border-top: 1px solid rgb(44, 192, 255);border-bottom: 1px solid rgb(44, 192, 255);font-size: 16px;color: rgb(44, 192, 255);min-width: 1px;box-sizing: border-box;\"><p><strong>姿势二：额度长期有效，借款不被拒绝</strong></p></section></section><section style=\"background: rgb(44, 192, 255);width: 12px;\"><img data-ratio=\"2.71875\" src=\"https://mmbiz.qpic.cn/mmbiz_png/GCSG9VLghhrRYDqyicn3RFArt0nBEULnvcRIeG3Gx29iaaHgXSMIkXrgVAotxGictQ9XsibJzpIqciazQjnfGanSc8w/640?wx_fmt=png\" data-type=\"png\" data-w=\"32\" data-width=\"100%\" style=\"width: 100%;vertical-align: top;\"  /></section></section></section></section><p style=\"white-space: normal;\"><span style=\"font-size: 15px;\"></span></p><p style=\"white-space: normal;text-indent: 28px;\"><span style=\"text-indent: 42px;caret-color: red;font-size: 16px;\">&nbsp;小编在后台不时会收到这样的反馈，有些小伙伴已经在微乐分借过款了，但最近的借款申请却被拒绝了。</span></p><p style=\"text-align: center;\"><img class=\"\" data-copyright=\"0\" data-ratio=\"0.90625\" data-s=\"300,640\" src=\"https://mmbiz.qpic.cn/mmbiz_png/YbjySVybDiauuJVC3haERCjMjUH0tNBtlibQMicEDk9uvbia5JdVUtcNql0oQJbOP6nHjth1ibibWj8pNlL510xdTdvw/640?wx_fmt=png\" data-type=\"png\" data-w=\"192\" style=\"\"  /></p><p style=\"white-space: normal;text-indent: 28px;\"><span style=\"font-size: 14px;text-indent: 42px;caret-color: red;\"></span><br  /></p><p style=\"white-space: normal;\"><span style=\"font-size: 14px;text-indent: 42px;caret-color: red;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span style=\"text-indent: 42px;caret-color: red;font-size: 16px;\">为了使额度长期有效，防止借款被拒绝，</span></span><span style=\"font-size: 16px;text-indent: 42px;caret-color: red;\">在第一次借款之后，应<strong><span style=\"font-size: 16px;text-indent: 42px;caret-color: red;color: rgb(255, 41, 65);\">避免</span></strong>以下几种情况：</span></p><p style=\"white-space: normal;text-indent: 2em;\"><span style=\"text-indent: 42px;caret-color: red;font-size: 16px;\">1）<strong>信用卡的逾期程度较高，或其他贷款逾期</strong>；</span></p><p style=\"white-space: normal;text-indent: 2em;\"><span style=\"text-indent: 42px;caret-color: red;font-size: 16px;\">2）<strong>频繁申请信用卡，或其它贷款产品</strong>；</span></p><p style=\"white-space: normal;text-indent: 2em;\"><span style=\"text-indent: 42px;caret-color: red;font-size: 16px;\">3）<strong>其它综合信用有不良记录。</strong></span></p><p style=\"white-space: normal;\"><span style=\"font-size: 14px;text-indent: 42px;caret-color: red;color: rgb(127, 127, 127);font-size: 12px;\">tips：请警惕任何非官方渠道邀请的开通申请哦~</span></p><section class=\"editor\"><p style=\"margin-right: auto;margin-left: auto;text-align: center;\"><br  /></p></section><section class=\"editor\" style=\"white-space: normal;box-sizing: border-box;\"><section style=\"margin-top: 5px;\"><section style=\"display: flex;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;height: 39px;\"><section style=\"background: rgb(44, 192, 255);width: 12px;\"><img data-ratio=\"2.71875\" src=\"https://mmbiz.qpic.cn/mmbiz_png/GCSG9VLghhrRYDqyicn3RFArt0nBEULnveZpTFgQU4JKfbnVsIiczR6RX6pBiaShUdVtF8SyTm9lIzdhrnYTR8oxg/640?wx_fmt=png\" data-type=\"png\" data-w=\"32\" data-width=\"100%\" style=\"width: 100%;vertical-align: top;\"  /></section><section style=\"padding: 2px;border-top: 1px solid rgb(44, 192, 255);border-bottom: 1px solid rgb(44, 192, 255);box-sizing: border-box;\"><section style=\"padding-right: 15px;padding-left: 15px;border-top: 1px solid rgb(44, 192, 255);border-bottom: 1px solid rgb(44, 192, 255);font-size: 16px;color: rgb(44, 192, 255);min-width: 1px;box-sizing: border-box;\"><p><strong>姿势三：提高自身信用水平</strong></p></section></section><section style=\"background: rgb(44, 192, 255);width: 12px;\"><img data-ratio=\"2.71875\" src=\"https://mmbiz.qpic.cn/mmbiz_png/GCSG9VLghhrRYDqyicn3RFArt0nBEULnvcRIeG3Gx29iaaHgXSMIkXrgVAotxGictQ9XsibJzpIqciazQjnfGanSc8w/640?wx_fmt=png\" data-type=\"png\" data-w=\"32\" data-width=\"100%\" style=\"width: 100%;vertical-align: top;\"  /></section></section></section></section><p style=\"white-space: normal;text-indent: 2em;\"><span style=\"text-indent: 42px;caret-color: red;font-size: 16px;\">基本操作这次就不讲了，爆个<strong><span style=\"text-indent: 42px;caret-color: red;font-size: 16px;color: rgb(255, 41, 65);\">猛料</span></strong>吧！</span></p><p style=\"white-space: normal;text-indent: 2em;\"><span style=\"text-indent: 42px;caret-color: red;font-size: 16px;\">听说<strong><span style=\"text-indent: 42px;caret-color: red;font-size: 16px;color: rgb(255, 41, 65);\">越多</span></strong>微信好友成功开通微乐分，信用水平就会变得<span style=\"text-indent: 42px;caret-color: red;font-size: 16px;color: rgb(255, 41, 65);\"><strong>越高</strong></span>，越有机会获得申请资格或通过审核。<img src=\"https://res.wx.qq.com/mpres/htmledition/images/icon/common/emotion_panel/smiley/smiley_44.png\" data-ratio=\"1\" data-w=\"20\" style=\"display:inline-block;width:20px;vertical-align:text-bottom;\"  /></span></p><p style=\"white-space: normal;text-indent: 2em;\"><span style=\"font-size: 16px;text-indent: 42px;caret-color: red;\">上面的方法都get到了吗？快来体验吧<img src=\"https://res.wx.qq.com/mpres/htmledition/images/icon/common/emotion_panel/smiley/smiley_63.png\" data-ratio=\"1\" data-w=\"20\" style=\"display:inline-block;width:20px;vertical-align:text-bottom;\"  /></span><br  /></p><p style=\"white-space: normal;text-indent: 2em;\"><span style=\"font-size: 16px;text-indent: 42px;caret-color: red;\"><br  /></span></p><p style=\"white-space: normal;text-indent: 2em;\"><br  /></p><p style=\"white-space: normal;text-indent: 2em;\"><br  /></p><p><a href=\"https://fenqi.tenpay.com/cgi-bin/fenqi/ctfq_open_acct_index.cgi?channel_id=1&amp;attach=200.2000.001.001.007#wechat_redirect\" target=\"_blank\"><img class=\"\" data-copyright=\"0\" data-ratio=\"0.17851739788199697\" data-s=\"300,640\" src=\"https://mmbiz.qpic.cn/mmbiz_png/YbjySVybDiauqEzbwbrkbz9eJckFahnQpEhIv4HtuVG0ibMpFjgrjweLz2RiamfbVxfW6VOVibcGHoY8WblXO2U1icA/640?wx_fmt=png\" data-type=\"png\" data-w=\"661\" style=\"\"  /></a></p><section class=\"editor\"><img class=\"\" data-ratio=\"0.06666666666666667\" src=\"https://mmbiz.qpic.cn/mmbiz_gif/YbjySVybDiasNJxniaeznaEqFZJXCyZk8Uwgvu97P1w98MMyLRz1aqXg0BfNRnt40Xn8hyDicIrXZgxpd4hfsia5dw/640?wx_fmt=gif\" data-type=\"gif\" data-w=\"900\"  /></section><p style=\"white-space: normal;\"><img class=\"\" data-ratio=\"0.40634920634920635\" src=\"https://mmbiz.qpic.cn/mmbiz_jpg/YbjySVybDiasNJxniaeznaEqFZJXCyZk8UjL8N0Txs0HX5WPNr9KxaZGWia4VICZTLlKy3xGdicCn5cKeHkpPlU7AA/640?wx_fmt=jpeg\" data-type=\"jpeg\" data-w=\"630\"  /></p><p style=\"white-space: normal;\"><span style=\"font-size: 14px;\">感谢您关注微乐分公众号，有任何问题欢迎留言与我们沟通。您也可以通过公众号底部菜单了解更多<span style=\"font-size: 14px;color: rgb(0, 0, 0);\">微乐分</span>相关信息。</span></p><p><br  /></p>",
	                        "digest":"微乐分借钱给你还信用卡，千元日利息低至0.45元",
	                        "show_cover_pic":1
	                    }
	   ]
	}';
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);//设置为POST方式
    curl_setopt($ch, CURLOPT_POSTFIELDS,$newJons);//POST数据
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    $data = curl_exec($ch);
    $data = json_decode($data,true);
    return $data;
}
// 返回数据格式
// array(3) {
//   ["type"]=>
//   string(4) "news"
//   ["media_id"]=>
//   string(64) "jjSyfo-YsJtDGJfYVxsSeETOe_S-tz-x98ad2dDXldFyqsnxm_xHwSDtMdCTnKkL"
//   ["created_at"]=>
//   int(1529495333)
// }
$imagetext = uploadNews();
var_dump($imagetext);
?>