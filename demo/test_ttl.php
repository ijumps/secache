<?php
/**
  * ������ʱ�����д����secache��ʾ�ű�
  * @author Horse Luke
  * @version $Id$
  */

require('../secache/secache.php');
$cache = new secache;
$cache->workat('cachedata');

$key = md5('test_arr_ttl_store'); //You must *HASH* it by your self�������ֵ������ǰ�汾����һ�£�������hash��
$ttl = 5; //����ʱ�䣬��λΪ�롣����������Ĭ��Ϊ30�죨2592000�룩������Ϊ0�������飨��Ϊ�������ʹ�øû���һ���ᱻlru���������Ҳ����˵��Ҫ��secache�����û���ʹ��

$value = null;
if($cache->fetch($key,$value)){
	echo 'find cache:<br />';
	print_r($value);
}else{
	$value = createRandArray();    //���������ݡ�����ǰ�汾��ͬ�����Դ����κ�����ֵ����������沼��ֵfalse����Ϊ��ᵼ��{@link secache::fetch()}�Ļ����ж�ʧ��
	$cache->store($key,$value,$ttl);    //������ʱ�����д����secacheʹ�÷���
	echo 'cache not found and recreated, refresh to see';
}

//status show
echo '<hr />';
$curBytes = $totalBytes = 0;
$_status = $cache->status($curBytes,$totalBytes);
echo 'totalBytes:'. ($totalBytes / 1024). ' KB ; curBytes:'. ($curBytes / 1024). ' KB';
echo '<br />';
print_r($_status);


//����php4���ҽ�Ϊ��ʾ����û�в�ȡ����ȫ��mt_rand
function createRandArray(){
	$return = array();
	for($i=1;$i<=10;$i++){
		$return[$i] = rand(1, 100000);
	}
	return $return;
}
