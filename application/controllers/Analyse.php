<?php 
	/*
	*数据分析类
	*/
	class Analyse extends CI_Controller
	{
		function __construct(){
            parent::__construct();
            if(!isset($_SESSION['bfdyt_username'])||$_SESSION['bfdyt_role']<0||$_SESSION['bfdyt_role']>3){
                header('Location:/login/');
                exit;
            }
        }
        //年度每月信息量
        public function monthinfo($year=0){
        	if($_SESSION['bfdyt_role']!=0){
                 echo '<script>alert("你无权访问该信息")</script>';
                exit;
            }
            if(!$year){
            	$year = date('Y');
            }
            $data = array();
            $start=$year.'-01-01';
            $end  =$year.'-12-31';
            $this->load->database();
            $this->db->where('bfdyt_zxdate >',$start);
            $this->db->where('bfdyt_zxdate <',$end);
            $this->db->select('MONTH(bfdyt_zxdate) as month,COUNT(*) as num');
            $this->db->group_by('month');
            $query=$this->db->get('bfdyt_studentinfo');
            $res=$query->result_array();
            $sum = $query->num_rows();
            foreach ($res as $k => $v) {
            	$data[$v['month']] = $v['num'];
            }
            $str='';
            for($i=1;$i<=12;$i++){
            	if(isset($data[$i])){
            		$str.=$data[$i].',';
            	}else{
            		$str.='0,';
            	}
            }
            $str=rtrim($str,',');
            $this->load->view('analyse/monthinfo',array('data'=>$str,'year'=>$year,'sum'=>$sum));
        }
        //月份每日信息量
        public function dayinfo($year=0,$month = 0){
        	if($_SESSION['bfdyt_role']!=0){
                 echo '<script>alert("你无权访问该信息")</script>';
                exit;
            }
            if(!$month||$month>31){
            	$month = date('m');
            }else if($month<10){
            	$month='0'.$month;
            }
            if(!$year||$year>date('Y')){
           		$year = date('Y');
            }
            $data = array();
            $days = date('t',strtotime($year.'-'.$month.'-01'));
            $start = $year.'-'.$month.'-01';
            $end = $year.'-'.$month.'-'.$days;
            $this->load->database();
            $this->db->where('bfdyt_zxdate >',$start);
            $this->db->where('bfdyt_zxdate <',$end);
            $this->db->select('DAY(bfdyt_zxdate) as day,COUNT(*) as num');
            $this->db->group_by('day');
            $query=$this->db->get('bfdyt_studentinfo');
            $res=$query->result_array();
            $sum=$query->num_rows();
            foreach ($res as $k => $v) {
            	$data[$v['day']] = $v['num'];
            }
            $str='';
            for($i=1;$i<=$days;$i++){
            	if(isset($data[$i])){
            		$str.=$data[$i].',';
            	}else{
            		$str.='0,';
            	}
            }
            $str=rtrim($str,',');
            $this->load->view('analyse/dayinfo',array('data'=>$str,'year'=>$year,'month'=>$month,'days'=>$days,'sum'=>$sum));
        }
        //地域分析
        public function areainfo(){
        	if($_SESSION['bfdyt_role']!=0){
                 echo '<script>alert("你无权访问该信息")</script>';
                exit;
            }
            $this->load->database();
        	$start = $this->input->get('start',0);
        	$end = $this->input->get('end',0);
        	if(!$start||$start<0){
        		$start=date('Y-m').'-01';
        	}else{
        		$start=date('Y-m-d',strtotime($start));
        	}
        	if(!$end||$end<0){
        		$end=date('Y-m').'-'.date('t');
        	}else{
        		$end=date('Y-m-d',strtotime($end));
        	}
        	$this->db->where('bfdyt_zxdate >=',$start);
            $this->db->where('bfdyt_zxdate <=',$end);
            $this->db->select('bfdyt_source,bfdyt_city,bfdyt_age');
            $query=$this->db->get('bfdyt_studentinfo');
            $res=$query->result_array();
            $data['source']=array();
            $data['area']=array();
            $data['age']=array();
            $data['sum'] = $query->num_rows();
            foreach($res as $v){
            	if(!isset($data['source'][$v['bfdyt_source']])){
            		$data['source'][$v['bfdyt_source']]=0;
            	}
            	if(!isset($data['area'][$v['bfdyt_city']])){
            		$data['area'][$v['bfdyt_city']]=0;
            	}
            	if(!isset($data['age'][$v['bfdyt_age']])){
            		$data['age'][$v['bfdyt_age']]=0;
            	}
            	$data['source'][$v['bfdyt_source']]+=1;
            	$data['area'][$v['bfdyt_city']] +=1;
            	$data['age'][$v['bfdyt_age']]+=1;
            }
           	$source=$this->config->item('source');
           	$sourcearr = array();
            foreach($data['source'] as $k=>$v){
            	$sourcearr[]=array(
            			'name'=>$source[$k],
            			'value'=>$v
            		);
            }
            $agevalue='';
            $agekey = '';
            foreach($data['age'] as $k=>$v){
            	$agevalue .= $v.',';
            	$agekey .=$k.',';
            }
            $agevalue=rtrim($agevalue,',');
            $agekey = rtrim($agekey,',');
            $i=0;
            $other=0;
            $areaarr = array();
            foreach ($data['area'] as $k => $v) {
            	$i++;
            	if($i>=9){
            		$other+=$v;
            	}else{
            		$areaarr[]=array(
            			'name'=>$k,
            			'value'=>$v
            			);
            	}
            }
            if($other){
            	$areaarr[]=array(
            		'name'=>'其他',
            		'value'=>$other
            		);
            }
            $sourcejson = json_encode($sourcearr);
            $areajson = json_encode($areaarr);
            $this->load->view('analyse/areainfo',
        	array('sourcejson'=>$sourcejson,
            	'areajson'=>$areajson,
            	'agevalue'=>$agevalue,
            	'agekey'=>$agekey,
        		'start'=>$start,
        		'end'=>$end)
        	);
        }
        //专业分析
        public function majorinfo(){
        	if($_SESSION['bfdyt_role']!=0){
                 echo '<script>alert("你无权访问该信息")</script>';
                exit;
            }
            $this->load->database();
        	$start = $this->input->get('start',0);
        	$end = $this->input->get('end',0);
        	if(!$start||$start<0){
        		$start=date('Y-m').'-01';
        	}else{
        		$start=date('Y-m-d',strtotime($start));
        	}
        	if(!$end||$end<0){
        		$end=date('Y-m').'-'.date('t');
        	}else{
        		$end=date('Y-m-d',strtotime($end));
        	}
        	$this->db->where('bfdyt_zxdate >',$start);
            $this->db->where('bfdyt_zxdate <',$end);
            $this->db->select('bfdyt_learnmonth,bfdyt_major,bfdyt_job');
            $query=$this->db->get('bfdyt_studentinfo');
            $res=$query->result_array();
            $data['month']=array();
            $data['major']=array();
            $data['job']=array();
            $data['sum'] = $query->num_rows();
            foreach($res as $v){
            	if(!isset($data['month'][$v['bfdyt_learnmonth']])){
            		$data['month'][$v['bfdyt_learnmonth']]=0;
            	}
            	if(!isset($data['major'][$v['bfdyt_major']])){
            		$data['major'][$v['bfdyt_major']]=0;
            	}
            	if(!isset($data['job'][$v['bfdyt_job']])){
            		$data['job'][$v['bfdyt_job']]=0;
            	}
            	$data['month'][$v['bfdyt_learnmonth']]+=1;
            	$data['major'][$v['bfdyt_major']] +=1;
            	$data['job'][$v['bfdyt_job']]+=1;
            }
            $major=$this->config->item('major');
            $month=$this->config->item('learnmonth');
            $job = $this->config->item('job');

           	$montharr = array();
            foreach($data['month'] as $k=>$v){
            	$montharr[]=array(
            			'name'=>$month[$k],
            			'value'=>$v
            		);
            }
            $majorvalue='';
            $majorkey = '';
            foreach($data['major'] as $k=>$v){
            	$majorvalue .= $v.',';
            	$majorkey .='"'.$major[$k].'",';
            }
            $majorvalue=rtrim($majorvalue,',');
            $majorkey = rtrim($majorkey,',');
            $jobarr = array();
            foreach ($data['job'] as $k => $v) {
            		$jobarr[]=array(
            			'name'=>$job[$k],
            			'value'=>$v
            			);
            }
            $jobjson = json_encode($jobarr);
            $monthjson = json_encode($montharr);
            $this->load->view('analyse/majorinfo',
        	array('jobjson'=>$jobjson,
            	'monthjson'=>$monthjson,
            	'majorvalue'=>$majorvalue,
            	'majorkey'=>$majorkey,
            	'start'=>$start,
            	'end'=>$end
            	)
        	);
        }
        //转接数据
        public function transdinfo(){
        	if($_SESSION['bfdyt_role']==3){
                 echo '<script>alert("你无权访问该信息")</script>';
                exit;
            }
            $this->load->database();
            $start = $this->input->get('start',0);
        	$end = $this->input->get('end',0);
        	if(!$start||$start<0){
        		$start=date('Y-m').'-01';
        	}else{
        		$start=date('Y-m-d',strtotime($start));
        	}
        	if(!$end||$end<0){
        		$end=date('Y-m').'-'.date('t');
        	}else{
        		$end=date('Y-m-d',strtotime($end));
        	}

            if($_SESSION['bfdyt_role']<2){//主管账户权限
                if($_SESSION['bfdyt_role']==0){//主账户查看所有
                    $userwhere='';
                }else{
                    $userwhere=' AND (u.bfdyt_fid = '.$_SESSION['bfdyt_id'].' OR u.bfdyt_id = '.$_SESSION['bfdyt_id'].')';
                }

                $sql='SELECT  i.bfdyt_major as major,
                    i.bfdyt_city as city,i.bfdyt_learnmonth as month
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_backuser=u.bfdyt_id 
                    	AND i.bfdyt_zxdate >= "'.$start.'"
                    	AND i.bfdyt_zxdate <= "'.$end.'"
                        AND i.bfdyt_zystatus = "1"'.$userwhere;
                        
            }else{//普通后台客服
                $sql='SELECT  i.bfdyt_major as major,
                    i.bfdyt_city as city,i.bfdyt_learnmonth as month
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_backuser=u.bfdyt_id 
                        AND u.bfdyt_id = '.$_SESSION['bfdyt_id'].'
                        AND i.bfdyt_zxdate >= "'.$start.'"
                        AND i.bfdyt_zxdate <= "'.$end.'"
                        AND i.bfdyt_zystatus = "1"';
            }
            $query = $this->db->query($sql);
            $res=$query->result_array();
            $data['month']=array();
            $data['major']=array();
            $data['city']=array();
            $data['sum'] = $query->num_rows();
            foreach($res as $v){
            	if(!isset($data['month'][$v['month']])){
            		$data['month'][$v['month']]=0;
            	}
            	if(!isset($data['major'][$v['major']])){
            		$data['major'][$v['major']]=0;
            	}
            	if(!isset($data['city'][$v['city']])){
            		$data['city'][$v['city']]=0;
            	}
            	$data['month'][$v['month']]+=1;
            	$data['major'][$v['major']] +=1;
            	$data['city'][$v['city']]+=1;
            }
            $major=$this->config->item('major');
            $month=$this->config->item('learnmonth');

           	$montharr = array();
            foreach($data['month'] as $k=>$v){
            	$montharr[]=array(
            			'name'=>$month[$k],
            			'value'=>$v
            		);
            }
            $majorvalue='';
            $majorkey = '';
            foreach($data['major'] as $k=>$v){
            	$majorvalue .= $v.',';
            	$majorkey .='"'.$major[$k].'",';
            }
            $majorvalue=rtrim($majorvalue,',');
            $majorkey = rtrim($majorkey,',');
            $cityarr=array();
            foreach ($data['city'] as $k => $v) {
            		$cityarr[]=array(
            			'name'=>$k,
            			'value'=>$v
            			);
            }
            $cityjson = json_encode($cityarr);
            $monthjson = json_encode($montharr);
            $this->load->view('analyse/transdinfo',
        	array('cityjson'=>$cityjson,
            	'monthjson'=>$monthjson,
            	'majorvalue'=>$majorvalue,
            	'majorkey'=>$majorkey,
            	'start'=>$start,
            	'end'=>$end
            	)
        	);
        }
        //报名数据
        public function joininfo(){
        	if($_SESSION['bfdyt_role']==2){
                 echo '<script>alert("你无权访问该信息")</script>';
                exit;
            }
            $this->load->database();
            $start = $this->input->get('start',0);
        	$end = $this->input->get('end',0);
        	if(!$start||$start<0){
        		$start=date('Y-m').'-01';
        	}else{
        		$start=date('Y-m-d',strtotime($start));
        	}
        	if(!$end||$end<0){
        		$end=date('Y-m').'-'.date('t');
        	}else{
        		$end=date('Y-m-d',strtotime($end));
        	}

            if($_SESSION['bfdyt_role']<2){//主管账户权限
                if($_SESSION['bfdyt_role']==0){//主账户查看所有
                    $userwhere='';
                }else{
                    $userwhere=' AND (u.bfdyt_fid = '.$_SESSION['bfdyt_id'].' OR u.bfdyt_id = '.$_SESSION['bfdyt_id'].')';
                }

                $sql='SELECT  i.bfdyt_major as major,
                    i.bfdyt_city as city,i.bfdyt_learnmonth as month
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_frontuser=u.bfdyt_id
                    	AND i.bfdyt_zxdate >= "'.$start.'"
                        AND i.bfdyt_zxdate <= "'.$end.'" 
                        AND i.bfdyt_isjoin = "1"'.$userwhere;
                        
            }else{//普通前台客服
                $sql='SELECT  i.bfdyt_major as major,
                    i.bfdyt_city as city,i.bfdyt_learnmonth as month
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_frontuser=u.bfdyt_id 
                   		 AND i.bfdyt_zxdate >= "'.$start.'"
                        AND i.bfdyt_zxdate <= "'.$end.'"
                        AND u.bfdyt_id = '.$_SESSION['bfdyt_id'].'
                        AND i.bfdyt_isjoin = "1"';
            }
            $query = $this->db->query($sql);
            $res=$query->result_array();
            $data['month']=array();
            $data['major']=array();
            $data['city']=array();
            $data['sum'] = $query->num_rows();
            foreach($res as $v){
            	if(!isset($data['month'][$v['month']])){
            		$data['month'][$v['month']]=0;
            	}
            	if(!isset($data['major'][$v['major']])){
            		$data['major'][$v['major']]=0;
            	}
            	if(!isset($data['city'][$v['city']])){
            		$data['city'][$v['city']]=0;
            	}
            	$data['month'][$v['month']]+=1;
            	$data['major'][$v['major']] +=1;
            	$data['city'][$v['city']]+=1;
            }
            $major=$this->config->item('major');
            $month=$this->config->item('learnmonth');

           	$montharr = array();
            foreach($data['month'] as $k=>$v){
            	$montharr[]=array(
            			'name'=>$month[$k],
            			'value'=>$v
            		);
            }
            $majorvalue='';
            $majorkey = '';
            foreach($data['major'] as $k=>$v){
            	$majorvalue .= $v.',';
            	$majorkey .='"'.$major[$k].'",';
            }
            $majorvalue=rtrim($majorvalue,',');
            $majorkey = rtrim($majorkey,',');
            $cityarr=array();
            foreach ($data['city'] as $k => $v) {
            		$cityarr[]=array(
            			'name'=>$k,
            			'value'=>$v
            			);
            }
            $cityjson = json_encode($cityarr);
            $monthjson = json_encode($montharr);
            $this->load->view('analyse/joininfo',
        	array('cityjson'=>$cityjson,
            	'monthjson'=>$monthjson,
            	'majorvalue'=>$majorvalue,
            	'majorkey'=>$majorkey,
            	'start'=>$start,
            	'end'=>$end
            	)
        	);
        }
	}
 ?>