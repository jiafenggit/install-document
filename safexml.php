<?php
	$str = preg_replace("/[\\x00-\\x08\\x0b-\\x0c\\x0e-\\x1f]/","",$str);
		$arr_search = array('<','>','&','\'','"','');
		$arr_replace = array('&lt;','&gt;','&amp;','&apos;','&quot;','');
		return str_ireplace($arr_search,$arr_replace,$str);