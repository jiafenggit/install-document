<?php


	    var_dump(get_defined_constants()); //获得所有已经定义的常量
		var_dump(get_defined_vars());  //获得一定义的全局变量
		var_dump(get_called_class()); //静态方法调用的类名
		var_dump(get_declared_classes());//获得已经申明的类
		var_dump(get_declared_interfaces());//获得已经申明的接口
		$result = get_defined_functions();//获得已定义的函数
		var_dump($result['user']); //打印用户自定义的行数
		
		
		echo get_parent_class($this); //获得对象的父类名称
	
		
		$reffunc = new ReflectionFunction('gb2utf8xhsafestr');
		echo $reffunc->getParameters(); //获得函数需要传递的参数
		echo PHP_EOL;
		echo $reffunc->getDocComment(); //打印函数的注视
		echo PHP_EOL;
		echo $reffunc->getStartLine();//打印函数所在行
		echo PHP_EOL;
		echo $reffunc->getFileName();//打印函数文件名
		echo PHP_EOL;
		echo $reffunc->getStaticVariables();//获得静态变量
		echo PHP_EOL;
		echo $reffunc->__toString ();	//获得函数实现的文本
		

		//var_dump(debug_backtrace()); //追踪 当前方法执行流程
		//var_dump(debug_print_backtrace()); // 追踪当前执行流程
		
	
		//var_dump(get_class($articleLib)); //获得对象的类名
		
		
		//反射一个类
		$reflect = new ReflectionClass(get_class($this));
		$res = $reflect->getProperties(); //获得类属性
		$res1 = $reflect->getParentClass(); //获得父类
		
		//答应出一个类的继承关系以及属性
		$i =1;
		
		function getclass($class){
			$reflect = new ReflectionClass($class);
			$res = $reflect->getProperties();//获得的当前类的所有属性
			$res1 = $reflect->getParentClass();//获得父类名称
			$patentclass = get_parent_class($class);//获得父类名称
			var_dump(get_class_vars($class));//获得类的所有属性
			echo $res1->name;//获得类名
			echo PHP_EOL;
			global $i;
			echo $i;
			if($i>100){
				die;
			}
			
			if(class_exists($res1->name)){
				$i++;
				//递归打印这个这个类的继承关系
				getclass($res1->name);
			}
			
		}
		getclass(get_class($this));
	
		
		
//压缩
zlib.output_compression =On 
zlib.output_compression_level = 5 
output_buffering = 4096 

ini_set('zlib.output_compression',1);
ini_set('zlib.output_compression_level',5);


//获得一个函数的定义
function getfunc($func){
	try{		
		$reflect = new ReflectionFunction($func);
	} catch(Exception $e){
		echo $e->getMessage();
		return ;
	}
		echo $reflect->__toString();
		$start = $reflect->getStartLine() - 1;

	$end =  $reflect->getEndLine() - 1;

	$filename = $reflect->getFileName();

	echo implode("", array_slice(file($filename),$start, $end - $start + 1));
}



	function getclass($class){
			$reflect = new ReflectionClass($class);
			//var_dump($reflect->getConstants());
			echo $reflect->getFileName();
			$res = $reflect->getProperties();
			$res1 = $reflect->getParentClass();
			//echo $reflect->__toString(); 
			echo $reflect->getMethod('load'); 
			//get_parent_class($class);
			//var_dump(get_class_vars($class));
			
	$start = $reflect->getStartLine() - 1;

	$end =  $reflect->getEndLine() - 1;

	echo $filename = $reflect->getFileName();die;

	echo implode("", array_slice(file($filename),$start, $end - $start + 1));
	
			echo $res1->name;
			echo PHP_EOL;
			global $i;
			//echo $i;
			if($i>1000){
				die;
			}
			//var_dump($res);
			if(class_exists($res1->name)){
				$i++;
				getclass($res1->name);
			}			
		}
		//getclass(get_class($this));
		getclass('JieqiObject');
			die;
			
function getfunc($func){
	try{		
		$reflect = new ReflectionFunction($func);
	} catch(Exception $e){
		echo $e->getMessage();
		return ;
	}
		echo $reflect->__toString();
		$start = $reflect->getStartLine() - 1;

	$end =  $reflect->getEndLine() - 1;

	$filename = $reflect->getFileName();

	echo implode("", array_slice(file($filename),$start, $end - $start + 1));
}

call_user_func($this,'load');
die;


 //调用类中非静态成员函数，该成员函数中有$this调用了对象中的成员    
       $a = new A;    
       $a->name = 'wen';           
       call_user_func_array(array($a,'show',),array('han!'));  
     
       //调用类中非静态成员函数，没有对象被创建，该成员函数中不能有$this  
       call_user_func_array(array('A','show1',),array('han!','wen'));    
  
       //调用类中静态成员函数  
       call_user_func_array(array('A','show2'),array('argument1','argument2'));  