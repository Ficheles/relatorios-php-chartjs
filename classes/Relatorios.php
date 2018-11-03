<?php

new Relatorios();

/**
 * Description of Relatorios
 *
 * @author Alexandre Unruh
 */
class Relatorios
{
	private $db;
	private $data_atual;

	public function __construct()
	{
		$this->db = new PDO('sqlite:.\..\base.db');
		
		$this->data_atual = date('Y-m-d H:i:m');

		$uri = urldecode(filter_input(INPUT_SERVER, 'PATH_INFO', FILTER_DEFAULT));
		
  		if ( $uri ):
    		$request = explode('/', substr($uri, 1));
    	  	$method  = $request[0];
    	  	$param   = $request[1] ?? null;
		endif;

		if ( method_exists(get_class(), $method) ):
			$this->$method($param);
		endif;	

		return false;
	}

	private function teste($param = NULL)
	{
		echo $param;
	}

	public function trafego_por_hora($param = NULL)
	{
		$periodo = date('Y-m-d h:i:m', strtotime($param));
		
		$sql = 'select substr(date, 12, 2) hour
		             , count(id) views 
		          from trafego 
		         where date >= :date 
		         group by hour';
		
		$stm = $this->db->prepare($sql);
		$stm->execute(['date'=>$periodo]);
		
		$result = $stm->fetchAll(PDO::FETCH_OBJ);

		$hours = array_fill(0, 24, 0);
		
		foreach ($result as $value) {
			$hours[(int)$value->hour] = (int) $value->views;
		}
		
		echo json_encode($hours);
	}

	public function trafego_semanal()
	{
		$periodo = date('Y-m-d h:i:m', strtotime('-7 days'));
		
		$sql = "select strftime('%w', date ) day
		             , count(id) views 
		          from trafego 
		         where date >= :date 
		         group by day";
		
		$stm = $this->db->prepare($sql);
		$stm->execute(['date'=>$periodo]);
		
		$result = $stm->fetchAll(PDO::FETCH_OBJ);

		$day = ['Domingo', 'Segunda', 'Terca', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
		
		$week = array_fill_keys(array_values($day), 0);

		
		foreach ($result as $value) {
			$week[$day[$value->day]] = (int) $value->views;
		}
		
		echo json_encode($week);
	}

	public function trafego_mensal($param)
	{
		
		$sql = "select strftime( '%d', date) day
                     , count(id) views 
                  from trafego 
                 where strftime('%m', date) = :month
                   and strftime('%Y', date) = :year
              group by day";
		
		$stm = $this->db->prepare($sql);
		$stm->execute(['month'=>date('m'), 'year'=>date('Y')]);
		
		$day = date('d');


		if( $day <= 10 ):
			$days = 10;
		elseif ($day <= 15 ):
			$days = 15;
		elseif ($day <= 20 ):
			$days = 20;
		elseif ($day <= 25 ):
			$days = 25;
		else :
			$days = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
		endif;	
		
		$month = array_fill(1, $days, 0);

		$result = $stm->fetchAll(PDO::FETCH_OBJ);


		foreach ($result as $value) {
			$month[(int)$value->day] = (int) $value->views;
		}

		echo json_encode($month);

	}

	public function trafego_por_plataforma()
	{
		$periodo = date('Y-m-d h:i:m', strtotime('-7 days'));
		
		$sql = "select platform 
		             , count(id) views 
		          from trafego 
		         where date >= :date 
		         group by platform
		         order by views desc
                 limit 5";
		
		$stm = $this->db->prepare($sql);
		$stm->execute(['date'=>$periodo]);
		
		$result = $stm->fetchAll(PDO::FETCH_OBJ);		
		
		foreach ($result as $value) {
			$platform[$value->platform] = (int) $value->views;
		}
		
		echo json_encode($platform);
	}

	public function trafego_por_navegador()
	{
		$periodo = date('Y-m-d h:i:m', strtotime('-7 days'));
		
		$sql = "select browser 
		             , count(id) views 
		          from trafego 
		         where date >= :date 
		         group by browser
		         order by views desc
                 limit 5";
		
		$stm = $this->db->prepare($sql);
		$stm->execute(['date'=>$periodo]);
		
		$result = $stm->fetchAll(PDO::FETCH_OBJ);		
		
		foreach ($result as $value) {
			$browser[$value->browser] = (int) $value->views;
		}
		
		echo json_encode($browser);
	}
		
}