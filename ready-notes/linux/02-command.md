##  Linux基本命令

* ls
  * ls --> 列出当前文件夹下的所有文件及文件名，隐藏文件除外)
  * ls -a -->列出当前文件夹下的所有文件及文件名(包括隐藏文件)，表示当前目录(.)或上一级目录(..)
  * ls -al --> 查看目录结构
  * ls -f -->列出目录下的所有文件，包括隐常文件
* cd ( .  or  .. )
  * cd ..  -->返回上一级目录
  * cd /  -->进入根目录
  * cp  aaa   bbb/xxx   -->将aaa文件复制到bbb目录下，文件名名变为xxx，若不写xxx，则文件名还为aaa
  * cp -R aaa  bbb/xxx  -->将aaa文件夹复制到bbb目录下，加xxx，文件夹名发生改变，反之不变
* mkdir aaa -->在当前目录下创建目录
* touch xxx - 新建文件
* pwd -->查看当前目录的绝对路径-->eg:  /home/xiaoliu/aaa
* rm (删除)
  * rm aaa  -->删除aaa文件
  * rm -r  xxx/  -->删除xxx目录
  * rm -rf  xxx/ -->强制删除目录
* cat   xxx  -->打开xxx文件
* init  (可取0,1,2,3,4,5,6)
  * init 0 --> 停机
  * init 1 --> 单用户模式
  * init 2 --> 多用户模式，没有网络连接
  * init 3 --> 完全多用户模式，有网络服务
  * init 4 --> 系统未使用保留给用户
  * init 5 --> 切换到图形界面
  * init 6 --> 重启系统
* shutdown -h now --> 立刻关机
* shutdown -h now /reboot --> 立刻重启计算机