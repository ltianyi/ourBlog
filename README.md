# ourBlog
Blog
sql文件在根目录，在做标签功能的时候做了两个版本，所以代码当中有一些被注释掉的是没用的。functions和数据库config放在config文件夹下，后台在admin文件夹。

测试用的echo 和var_dump要去掉
同一测试里面多个Exception不会都出发，要分开写测试或者写dataprovider
封装的数据验证函数就解开吧，
数据验证:要注意按照程序的流程来写测试，先是Exception，后是正常执行return true的，注意能return true的要做DataSet数据库验证
数据库链接改用PDO

