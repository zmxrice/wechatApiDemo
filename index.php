<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "cumt");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->responseMsg();
date_default_timezone_set('PRC');

class wechatCallbackapiTest
{
    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
				$event=$postObj->Event;
				$eventKey=$postObj->EventKey;
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[text]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
				$picWordTpl ="<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[news]]></MsgType>
						<ArticleCount>1</ArticleCount>
						<Articles>
						<item>
						<Title><![CDATA[%s]]></Title>
						<Description><![CDATA[%s]]></Description>
						<PicUrl><![CDATA[%s]]></PicUrl>
						<Url><![CDATA[%s]]></Url>
						</item>
						</Articles>
						</xml> ";		
				if(!empty($event)){
                	if($event=="subscribe"){
                		$contentStr = "生活中还有好多不方便啊，有木有？联欢晚会什么时候开啊？ 又有哪位名家来矿大了？ 要毕业了，去哪找工作啊？ 快递怎么还不到？ 糟糕，迷路了…有问题就找我吧！我一定给大家提供最优质的服务，最全面的信息，最权威的公告。赶快创建你的矿大快捷键吧！";
                		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $contentStr);
                		echo $resultStr;
					}
					if($event=="CLICK" && !empty($eventKey)){
						if($eventKey=="jykc"){
							$this->counter("就业快车");//点击计数
							$mytitle="就业快车";
							$mydescript="海量信息，就业畅通无阻，再也不用担心遗漏招聘信息！";
							$mypic="http://zhumx.sinaapp.com/images/rczp.png";
							$myurl="http://zhumx.sinaapp.com/xiaozhao/";
							$resultStr = sprintf($picWordTpl, $fromUsername, $toUsername, $time, $mytitle, $mydescript, $mypic, $myurl);
							echo $resultStr;
						}
						elseif($eventKey=="xyxs"){
							$this->counter("校园学术");//点击计数
							$mytitle="校园学术";
							$mydescript="这里实时更新校园学术动态，精彩讲座不容错过！";
							$mypic="http://zhumx.sinaapp.com/images/xyxs.png";
							$myurl="http://zhumx.sinaapp.com/jiangzuo/";
							$resultStr = sprintf($picWordTpl, $fromUsername, $toUsername, $time, $mytitle, $mydescript, $mypic, $myurl);
							echo $resultStr;
						}
						elseif($eventKey=="jchd"){
							$this->counter("精彩活动");//点击计数
							$mytitle="精彩活动";
							$mydescript="网罗校园各种精彩活动，从此校园生活不再无聊，你还在等什么？";
							$mypic="http://zhumx.sinaapp.com/images/hdtg.png";
							$myurl="http://zhumx.sinaapp.com/activity/";
							$resultStr = sprintf($picWordTpl, $fromUsername, $toUsername, $time, $mytitle, $mydescript, $mypic, $myurl);
							echo $resultStr;
						}
						elseif($eventKey=="gcts"){
							$this->counter("馆藏图书");//点击计数
							$mytitle="馆藏图书";
							$mydescript="借书之前先查询，万无一失省时省力!";
							$mypic="http://zhumx.sinaapp.com/images/gcts.png";
							$myurl="http://m.5read.com/cumt";
							$resultStr = sprintf($picWordTpl, $fromUsername, $toUsername, $time, $mytitle, $mydescript, $mypic, $myurl);
							echo $resultStr;
						}
						elseif($eventKey=="wl"){
							$this->counter("物流详单");//点击计数
							$mytitle="物流详单";
							$mydescript="跟踪宝贝信息，第一时间知道宝贝动向!";
							$mypic="http://zhumx.sinaapp.com/images/kuaidi.png";
							$myurl="http://m.kuaidi100.com/index_all.html";
							$resultStr = sprintf($picWordTpl, $fromUsername, $toUsername, $time, $mytitle, $mydescript, $mypic, $myurl);
							echo $resultStr;
						}
						elseif($eventKey=="xc"){
							$this->counter("校车班次");//点击计数
							$mytitle="校车班次";
							$mydescript="时时刻刻为您提供校车信息！";
							$mypic="http://zhumx.sinaapp.com/images/xiaoche.png";
							$myurl="http://zhumx.sinaapp.com/banche/";
							$resultStr = sprintf($picWordTpl, $fromUsername, $toUsername, $time, $mytitle, $mydescript, $mypic, $myurl);
							echo $resultStr;
						}
						elseif($eventKey=="xl"){
							$this->counter("校历日程");//点击计数
							$mytitle="校历日程";
							$mydescript="旅游出行，日程安排轻松搞定！";
							$mypic="http://zhumx.sinaapp.com/images/xiaoli.png";
							$myurl="http://zhumx.sinaapp.com/xiaoli/";
							$resultStr = sprintf($picWordTpl, $fromUsername, $toUsername, $time, $mytitle, $mydescript, $mypic, $myurl);
							echo $resultStr;
						}
						elseif($eventKey=="dh"){
							$this->counter("校园导航");//点击计数
							$mytitle="校园导航";
							$mydescript="路痴宝典，出门必备！\n(请先预装手机flash后查看~)";
							$mypic="http://zhumx.sinaapp.com/images/xydt.png";
							$myurl="http://vcampus.cumt.edu.cn/";
							$resultStr = sprintf($picWordTpl, $fromUsername, $toUsername, $time, $mytitle, $mydescript, $mypic, $myurl);
							echo $resultStr;
						}
						elseif($eventKey=="bgdh"){
							$this->counter("办公电话");//点击计数
							$mytitle="办公电话";
							$mydescript="这里有一千余条学校各单位的信息，妈妈再也不用担心我有问题！";
							$mypic="http://zhumx.sinaapp.com/images/bgdh.png";
							$myurl="http://zhumx.sinaapp.com/phoneSearch/";
							$resultStr = sprintf($picWordTpl, $fromUsername, $toUsername, $time, $mytitle, $mydescript, $mypic, $myurl);
							echo $resultStr;
						}
						elseif($eventKey=="tzsc"){
							$this->counter("跳蚤市场");//点击计数
							$mytitle="跳蚤市场";
							$mydescript="属于你我他的小市场，二手交易，一手搞定!";
							$mypic="http://zhumx.sinaapp.com/images/tzsc.png";
                        	$myurl="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx87470e2cc88e1c27&redirect_uri=http%3A%2F%2Fzhumx.sinaapp.com%2Fmarket%2FgetInfo.php&response_type=code&scope=snsapi_userinfo#wechat_redirect";
							$resultStr = sprintf($picWordTpl, $fromUsername, $toUsername, $time, $mytitle, $mydescript, $mypic, $myurl);
							echo $resultStr;
						}
						elseif($eventKey=="swzl"){
							$this->counter("失物招领");//点击计数
							$mytitle="失物招领";
							$mydescript="东西丢了？捡到别人的东西了？不要着急，赶紧过来看看！";
							$mypic="http://zhumx.sinaapp.com/images/swzl.png";
                        	$myurl="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx87470e2cc88e1c27&redirect_uri=http%3A%2F%2Fzhumx.sinaapp.com%2FlostAndFind%2FgetInfo.php&response_type=code&scope=snsapi_userinfo#wechat_redirect";
							$resultStr = sprintf($picWordTpl, $fromUsername, $toUsername, $time, $mytitle, $mydescript, $mypic, $myurl);
							echo $resultStr;
						}
						elseif($eventKey=="sysc"){
							$this->counter("使用手册");//点击计数
							$mytitle="使用手册";
							$mydescript="还不知道如何使用？想了解我们的一切，在这里认识一个不一样的我们。";
							$mypic="http://zhumx.sinaapp.com/images/sysc.png";
							$myurl="http://zhumx.sinaapp.com/manual/";
							$resultStr = sprintf($picWordTpl, $fromUsername, $toUsername, $time, $mytitle, $mydescript, $mypic, $myurl);
							echo $resultStr;
						}
						elseif($eventKey=="lyjy"){
							$contentStr = "说出你想对我们说的话，让我们做的更好!\n 请发送\"#我要留言#你想说的话\"到微信平台，主页君将在第一时间给你想要的反馈~";
                			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $contentStr);
                			echo $resultStr;
						}
						
						
					}//click			
                }//event
				
				if(!empty($keyword)){
					if ($keyword=="我要上墙"){
						$mytitle="微信上墙";
						$mydescript="现场参加微信墙互动，获得抽奖机会，有机会得到神秘礼品哦。";
						$mypic="http://zhumx.sinaapp.com/images/weixin.png";
						$myurl="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx87470e2cc88e1c27&redirect_uri=http%3A%2F%2Fzhumx.sinaapp.com%2FwechatWall%2FgetInfo.php&response_type=code&scope=snsapi_userinfo#wechat_redirect";
						$resultStr = sprintf($picWordTpl, $fromUsername, $toUsername, $time, $mytitle, $mydescript, $mypic, $myurl);
						echo $resultStr;
					}
                    elseif ($keyword=="后勤报修"){
						$mytitle="后勤报修";
						$mydescript="水龙头坏了？灯不亮了？没关系，有问题找后勤帮忙~";
						$mypic="http://zhumx.sinaapp.com/images/bgdh.png";
						$myurl="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx87470e2cc88e1c27&redirect_uri=http%3A%2F%2Fzhumx.sinaapp.com%2FdormFix%2FgetInfo.php&response_type=code&scope=snsapi_userinfo#wechat_redirect";
						$resultStr = sprintf($picWordTpl, $fromUsername, $toUsername, $time, $mytitle, $mydescript, $mypic, $myurl);
						echo $resultStr;
					}
                    elseif ($keyword=="游戏"){
						$mytitle="这也被你发现了！";
						$mydescript="九格棋小游戏，看看你能赢不，想赢可不容易哦！O(∩_∩)O~";
						$mypic="http://imcumter.sinaapp.com/jiugeqi/aa.png";
						$myurl="http://imcumter.sinaapp.com/jiugeqi/";
						$resultStr = sprintf($picWordTpl, $fromUsername, $toUsername, $time, $mytitle, $mydescript, $mypic, $myurl);
						echo $resultStr;
					}
					
					
				}//keyword
				

        }else {
        	echo "error";
        	exit;
        }
    }//function responseMsg()
	
	function counter($name){
		$mysql = new SaeMysql();
		$sql = "select * from counter where name='$name'";
		$data = $mysql->getData( $sql );
		if($data==NULL){
			$sql = "insert into counter(name, num) values('$name','1')";
		}else{
			$num = $data[0][num]+1;
			$sql = "update counter set num='$num' where name='$name'";
		}
		$mysql->runSql( $sql );
		
		$mysql->closeDb();
	}//function counter 点击次数统计
	
}

?>