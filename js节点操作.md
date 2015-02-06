##dom操作
元素选择器
document.getElementById();
document.getElementsByName();
document.getElementsByTagName();
document.getElementsByClassName();

##文档结构和遍历
parentNode 获取该节点的父节点
childNodes 获取该节点的子节点数组
firstChild 获取该节点的第一个子节点
lastChild  获取该节点的最后一个子节点
nextSibling获取该节点的下一个兄弟节点元素
previoursSibling 获取该节点的上一个兄弟元素
nodeType 节点类型，9代表document节点 ,1代表element节点，3代表text节点，8代表comment节点，11代表documentFragment节点
nodeValue text或者comment节点的文本内容
nodeName  元素的标签名（大写的形式）

##作为元素树的文档
firstElementChild      第一个元素节点
lastElementChild       最后一个元素节点
nextElementSibling     下一个兄弟元素节点
previousElementSibling 前一个兄弟元素节点
ChildElementCount      子元素节点个数

##W3CShool 资料
http://www.w3school.com.cn/jsref/dom_obj_document.asp

##资料：DOM操作
http://www.cnblogs.com/kissdodog/archive/2012/12/25/2833213.html