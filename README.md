### 
演示站点 http://134.175.63.241/92xsw

### 原因
=====
几年前老项目，代码垃圾，不建议参考

一个非常简单的没有后台、没有入库的php小说小偷

###

主要rules节点 规则关键字，其他地方的规则请参考实例规则修改
1. url 源站url
2. cache 缓存时间，秒
3. limit 取出的数量,在有翻页的列表页尽量不要此字段，或者与源站相同
4. exclude 排除键。取出的结果中如果第0键和第4键，倒数第一个不能要，则 填写 "0|4|-1"
5. exception 例外。如果包含exception，且url包含对应值的字符串，则调用对应值的规则。比如不同分类不同展示样式，那么规则就不同

### TODO
没有更新了

## License

92xsw is licensed under [The MIT License (MIT)](LICENSE).
