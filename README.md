# 使用方式
本项目可拉取core.send.php自行部署。也可使用作者提供的云服务方式，无需服务器，修改代码。即可完成每天定时给对象推送早安消息。
视频教程：[https://www.bilibili.com/video/BV1BW4y187iN/](https://www.bilibili.com/video/BV1BW4y187iN/)

## 访问提醒系统
[https://dev.6liu6.cn/wx_zaoan/](https://dev.6liu6.cn/wx_zaoan/)

# 1.登录微信测试号
1. 使用电脑打开 [https://mp.weixin.qq.com/debug/cgi-bin/sandbox?t=sandbox/login](https://mp.weixin.qq.com/debug/cgi-bin/sandbox?t=sandbox/login)
使用微信扫码登录测试号
![输入图片说明](pic/pic%E5%9B%BE%E7%89%871.png)

2.进入后，复制你的appid 
![输入图片说明](pic/pic%E5%9B%BE%E7%89%872.png)
# 2.登录提醒系统
**打开链接**[**https://dev.6liu6.cn/wx_zaoan/**](https://dev.6liu6.cn/wx_zaoan/)
**输入刚才复制的appid 登录**
![输入图片说明](pic/pic%E5%9B%BE%E7%89%873.png)
# 3.公众号信息维护
**在后台维护这4个参数。**
![输入图片说明](pic/pic%E5%9B%BE%E7%89%874.png)
## 3.1 appid与appsecret
**进入**[**https://mp.weixin.qq.com/debug/cgi-bin/sandbox?t=sandbox/login**](https://mp.weixin.qq.com/debug/cgi-bin/sandbox?t=sandbox/login)** 查看appid与appsecret填写到提醒系统**
![输入图片说明](pic/pic%E5%9B%BE%E7%89%875.png)
## 3.2 接收人openid
让你的对象扫描公众号后台的二维码，关注公众号。然后刷新页面。获取你对象的openid。填写到后台的接收人微信openid
![输入图片说明](pic/pic%E5%9B%BE%E7%89%876.png)
## 3.4 模板id
**页面下滑，找到模板消息接口。点击新增测试模板。**
![输入图片说明](pic/pic%E5%9B%BE%E7%89%877.png)
****色模板内容，粘贴进去新增。**
{{first.DATA}} 
城市：{{keyword1.DATA}} 
今天天气：{{keyword2.DATA}} 
最低气温：{{keyword3.DATA}} 
最高气温：{{keyword4.DATA}} 
今天是我们恋爱的第{{keyword5.DATA}}天
距离宝宝的生日还有{{keyword6.DATA}}天
距离我的生日还有{{keyword7.DATA}} 天
每日寄言：{{keyword8.DATA}} 
{{remark.DATA}}
![输入图片说明](pic/pic%E5%9B%BE%E7%89%878.png)
**提交成功后，复制你的模板id填写到后台。**
![输入图片说明](pic/pic%E5%9B%BE%E7%89%879.png)
# 4.恋爱信息维护
**按照自己的情况维护好信息，设置好发送时间。接收人即可在指定时间接收到通知啦～**
![输入图片说明](pic/pic%E5%9B%BE%E7%89%8710.png)
# 5.大功告成
![输入图片说明](pic/pic%E5%9B%BE%E7%89%8711.png)
