<?php

/**
 * Description of Traffic
 *
 * @author Alexandre Unruh
 */
class Traffic
{
	private $db;
	private $ip;
	private $data;
	private $uri;
	private $user_agent;

	public function __construct()
	{
		//$option = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET LC_TIME_NAMES = pt_BR']
		$this->db = new PDO('sqlite:base.db');
		$this->uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_DEFAULT);
		$this->ip = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP);
		$cookie = filter_input(INPUT_COOKIE, md5($this->uri), FILTER_DEFAULT);
		$this->user_agent = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT');

		if( ! $cookie):
			//echo 'Ainda não tem Cookie';
			$this->_set_cookie();
			$this->_set_data();
		endif;			

	}

	private function _set_cookie(){
		setcookie(md5($this->uri), sha1('Cookie-Test'), time()+3600);
	}

	private function _set_data()
	{
		include_once('includes/user_agents.php');
		$this->ip = $this->ip != '::1' ? $this->ip : '189.110.56.197';
		$geo = json_decode(file_get_contents('http://ip-api.com/json/' . $this->ip ))	;

		$this->data['date'] = date('Y-m-d H:i:s');
		$this->data['page'] = $this->uri;
		$this->data['ip'] = $this->ip != '::1' ? $this->ip : 'localhost'; 
		$this->data['city'] = $geo->city ?? 'Desconhecida';
		$this->data['region'] = $geo->regionName ?? 'Desconhecida';
		$this->data['country'] = $geo->country ?? 'Desconhecida';
		$this->data['browser'] = $this->_get_browser($browsers);
		$this->data['platform'] = $this->_get_platform($platforms);
		$this->data['referer'] = $this->_get_referer();

		$this->_rec_data();

	}

	private function _get_browser(Array $browsers)
	{
		foreach ($browsers as $key => $value):		
			if(preg_match('/' . $key . '.*?[0-9\.]+/i', $this->user_agent )):
				return $value ;
			endif;				
		endforeach;		
	}

	private function _get_platform(Array $platforms)
	{
		foreach ($platforms as $key => $value):		
			if(preg_match('/'. $key .'/i', $this->user_agent)):
				return $value ;
			endif;				
		endforeach;
	}

	private function _get_referer()
	{
		$referer = filter_input(INPUT_SERVER, 'HTTP_REFERER', FILTER_VALIDATE_URL);
		$referer_host = parse_url($referer, PHP_URL_HOST);
		$host = filter_input(INPUT_SERVER, 'SERVER_NAME');
		
		if( ! $referer ):
			return 'Acesso direto';
		endif;

		if( $referer_host == $host):
			return 'Navegação Interna';
		endif;	

		return $referer ;
	}

	private function _rec_data()
	{
		$sql = 'insert into trafego (date, page, ip, city, region, country, browser, platform, referer)   values (:date, :page, :ip, :city, :region, :country, :browser, :platform, :referer)';

		$stm = $this->db->prepare($sql);
		$stm->execute($this->data);
	}
}	
