<?php 

function max_follow_page($url) 
{
	$data = array ('foo' => 'bar'); 
$data = http_build_query($data); 

$opts = array ( 
'http' => array ( 
   'method' => 'GET', 
   'header'=> "Content-type: text/html" . 
                     "Content-Length: " . strlen($data) . "\r\n" . "Cookie:SINAGLOBAL=3701027564295.5644.1367460223625; ULV=1367805399109:2:2:1:1049144340055.031.1367805399093:1367460223656; NSC_wjq_xfjcp.dpn_w3.6_w4=ffffffff0941118a45525d5f4f58455e445a4a423660; _s_tentry=-; Apache=1049144340055.031.1367805399093; SUS=SID-3230106122-1367805372-JA-72ale-1f6e9a960d70fcdefd46adb24767058e; SUE=es%3Dcec773ff9031fc872b298ef61699ba44%26ev%3Dv1%26es2%3Dfa46aa0f25b343d28116f01e558f9f81%26rs0%3Duqz3FLrJb%252B9MUpJSGcUaO%252ByZ7l9A2LfzIYmO9MG2I%252BinxB%252FUlIJVx1niQL3KprIw5uCzCGW11cTQlHCk3WZgPeLqCUehVQVmndZFm4K6CGewqBJ5Wq6cUDEr5WliwUXLSvIKQfCnQopUXJWZQeAUljXHIpKA47J7hZiC7NiqleM%253D%26rv%3D0; SUP=cv%3D1%26bt%3D1367805372%26et%3D1367891772%26d%3Dc909%26i%3D21bb%26us%3D1%26vf%3D0%26vt%3D0%26ac%3D0%26st%3D0%26uid%3D3230106122%26user%3Dyaoniming234%2540126.com%26ag%3D4%26name%3Dyaoniming234%2540126.com%26nick%3Dyaoniming234%26fmp%3D%26lcp%3D; ALF=1370397372; SSOLoginState=1367805372; un=yaoniming234@126.com",'content' => $data 
) 
); 

$context = stream_context_create($opts); 
$str = file_get_contents($url,'',$context); 
//$str = htmlspecialchars($str);
//var_dump($str);

$begin = '<div class=\"W_pages W_pages_comment\">';
$end = 'class=\"W_btn_c\" href=\"';

if (strpos($str, $begin) != False) 
{
	$str = str_replace($begin, '贲', $str);
	$str = str_replace($end, '妣', $str);

	$str = strstr($str, '贲');
	$end = strpos($str, '妣');
	$end -= 1;

	$result_1 = substr($str, 1, $end);
	//var_dump($result_1);

	$matches = array();
	preg_match_all('/page=(\d+)/s', $result_1, $matches);
	//var_dump($matches[1]);

	$code = max($matches[1]);
	return $code;
	}
else {
	$code = 1;
	return $code;
	}
}


function createfile($filename, $url) {
	$fp = fopen($filename,"w");
	$maxpage = max_follow_page($url);
	for($i=1; $i<=$maxpage; $i++) {
		file_put_contents($filename, $url.'?page='.$i."\r\n", FILE_APPEND);
	}
	
	fclose($fp);
	echo $filename;
}



$file = file("list.txt");

foreach ($file as $url) {
		$res = array();
		preg_match('#com/(\d+)#s', $url, $res);
		$fileinfo = $res[1];
		$filename = $fileinfo.".txt";
		//echo $fileinfo.'*****'.'<br/>';
		$url = preg_replace('/((\s)*(\n)+(\s)*)/i', '', $url);
		createfile($filename, $url);	
}


?> 



