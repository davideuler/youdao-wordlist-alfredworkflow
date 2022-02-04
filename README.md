## 有道词典的增加新词功能的脚本。
用来替换有道词典Alfredworkflow中的加入生词本的脚本。

更新说明：v2.7.0
* 可以在 MacOS Monterey 12.0 中使用, 不依赖于 /usr/bin/php 的路径。

### 步骤：
*  1.安装有道词典alfredworkflow。
*  2.创建 php 的符号链接: sudo ln -sf `which php` /usr/local/bin/php
*  3.打开workflow, 更新workflow脚本中的用户名，密码, appKey/Secret。
*  4.即可输入 yd xxx 来翻译单词

由于有道翻译 api 迁移到了有道智云，所以需要去有道智云进行注册然后创建应用。

步骤如下:

1.注册有道智云帐号

  https://ai.youdao.com/

2. 创建一个自然语言翻译服务

  https://ai.youdao.com/fanyi-services.s

3. 创建一个应用并绑定第二步创建的服务

  https://ai.youdao.com/appmgr.s

4. 这样就可以获得应用(appKey)和密钥(secret)了

  应用详情 - 应用ID appKey, 应用密钥 secret

5. 把变量填入 workflow 右上角的 [X] 点开后的配置框中

### 原始workflow与github工程:
*  https://pan.baidu.com/s/1skdqQ
*  https://github.com/dalang/alfred-workflows/tree/master/youdao-tranlator


### Overview：
*  yd word         中英翻译结果最丰富
*  Cmd/Alt + Enter 单词发音(本地/在线)
*  Ctrl + Enter 加入到有道生词本中
*  Shift + Enter     复制到粘贴板(比较适合得到中译英的结果)


### 感谢如下作者的工作:
* 初始翻译功能开发者          ：icyleaf  <icyleaf.cn@gmail.com>
* 单词本功能开发者             ：dalang, david euler
* 发音和网站搜索功能开发者 ：dengo  <i@dengo.org>
