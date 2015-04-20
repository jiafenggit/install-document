<?php
		var_dump(get_called_class()); //静态方法调用的类名
		echo get_parent_class($this); //获得对象的父类名称
		var_dump(get_defined_constants()); //获得所有已经定义的常量
		var_dump(get_defined_vars());  //获得一定义的全局变量
		$result = get_defined_functions();//获得已定义的函数
		var_dump($result['user']);
		$reffunc = new ReflectionFunction('gb2utf8xhsafestr');
		echo $reffunc->getParameters();
		echo PHP_EOL;
		echo $reffunc->getDocComment();
		echo PHP_EOL;
		echo $reffunc->getStartLine();
		echo PHP_EOL;
		echo $reffunc->getFileName();
		echo PHP_EOL;
		echo $reffunc->getStaticVariables();
		echo PHP_EOL;
		echo $reffunc->__toString ();			
		var_dump($data);die;

		//var_dump(debug_backtrace());
		//var_dump(debug_print_backtrace());
		
	
		//var_dump(get_class($articleLib));
		
		$reflect = new ReflectionClass(get_class($this));
		$res = $reflect->getProperties();
		$res1 = $reflect->getParentClass();
		$i =1;
		//var_dump(get_declared_classes());die;
		//var_dump(get_declared_interfaces());die;
		function getclass($class){
			$reflect = new ReflectionClass($class);
			$res = $reflect->getProperties();
			$res1 = $reflect->getParentClass();
			//get_parent_class($class);
			var_dump(get_class_vars($class));
			echo $res1->name;
			echo PHP_EOL;
			global $i;
			echo $i;
			if($i>100){
				die;
			}
			var_dump($res);
			if(class_exists($res1->name)){
				$i++;
				getclass($res1->name);
			}
			
		}
		getclass(get_class($this));
		//var_dump($res);
		var_dump($res1);die;
		var_dump($result['user']);
		var_dump(debug_backtrace());die;
		
		
//压缩
zlib.output_compression =On 
zlib.output_compression_level = 5 
output_buffering = 4096 

ini_set('zlib.output_compression',1);
ini_set('zlib.output_compression_level',5);


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