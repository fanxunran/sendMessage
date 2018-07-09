    //这里是在模板里修改相应的变量
     $formwork = '{
            "touser":"'.$openid.'",
            "template_id":"bcnA8QBzyyRLfnpKqUGKny5kDVjac4IBqgZH1KQEzPk",
            "url":"http://www.baidu.com",            
            "data":{
                    "title": {
                        "value":"test模板标题",
                        "color":"#173177"
                    },
                    "content":{
                        "value":"test模板内容",
                        "color":"#173177"
                    },
                    "time": {
                        "value":"这里填写时间",
                        "color":"#173177"
                    }
            }
        }';

    //获取所有粉丝的openid
    function sendall(){
        //获取access_token
          $access_token = getaccess_token();
        $url = "http://100.95.20.10:12361/cgi-bin/user/get?access_token={$access_token}&next_openid=";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0); 
        $data = curl_exec($ch);
        $data = json_decode($data,true);
        return $data['data']['openid'];
    }

    // 获取所有图文消息列表
 function getAllUrl(){
    global $_CFG;
    $host = $_CFG['host'];
    $access_token = $_CFG['access_token'];
    $url = $host."/cgi-bin/material/batchget_material?access_token={$access_token}";
    $ch = curl_init();
    $postData = array(
      "type"=>"news",
      "offset"=>0,
      "count"=>1
    );
    $json = json_encode($postData);
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);//设置为POST方式
    curl_setopt($ch, CURLOPT_POSTFIELDS,$json);//POST数据
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    $data = curl_exec($ch);
    $data = json_decode($data,true);
    return $data;
 }
// $allimage = getAllUrl(); 
// var_dump($allimage);
// foreach ($variable as $key => $value) {
//   $openid_all[]=$value[openid];
// }

  // 读取文件内容的单个字符
  // while(!feof($myfile)) {
  //   echo fgetc($myfile);
  // }

    //读取单行文件内容
  // while(!feof($myfile)) { 
  //   echo fgets($myfile);
  // }
  <?php
/**
 * 提示用户输入，类似Python
 */
 
$fs = true;
 
do{
    if($fs){
        fwrite(STDOUT,'请输入您的博客名：');
        $fs = false;
    }else{
        fwrite(STDOUT,'抱歉，博客名不能为空，请重新输入您的博客名：');
    }
    $name = trim(fgets(STDIN)); 
}
while(!$name);
 
echo '您输入的信息是：'.$name."\r\n";
?>