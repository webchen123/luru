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
        	if($_SESSION['bfdyt_role']>1){
                 echo '<script>alert("你无权访问该信息")</script>';
                exit;
            }
            //非管理账号限定只显示所在主管下的信息
            $this->load->database();
            $arr = array();
            if($_SESSION['bfdyt_role']==1){//当前账户为校区主管
                $this->db->where('bfdyt_fid' ,$_SESSION['bfdyt_id']);
                $this->db->select('bfdyt_id');
                $res = $this->db->get('bfdyt_user');
                $res_arr = $res->result_array();
                foreach ($res_arr as $k => $v) {
                    $arr[]=$v['bfdyt_id'];
                }
                $arr[] = $_SESSION['bfdyt_id'];
                $xqwhere = ' (bfdyt_backuser in ('.(implode(',',$arr)).') or bfdyt_frontuser in ('.(implode(',',$arr)).'))';
            }else{
                $xqwhere = '1=1';
            }

            if(!$year){
                $year = date('Y');
            }
            $data = array();
            $start=$year.'-01-01 00:00:00';
            $end  =$year.'-12-31 23:59:59';
            $this->db->where('bfdyt_zxdate >',$start);
            $this->db->where('bfdyt_zxdate <',$end);
            $this->db->where($xqwhere);
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
        	if($_SESSION['bfdyt_role']>1){
                 echo '<script>alert("你无权访问该信息")</script>';
                exit;
            }
            //非管理账号限定只显示所在主管下的信息
            $this->load->database();
            $arr = array();
            if($_SESSION['bfdyt_role']==1){//当前账户为校区主管
                $this->db->where('bfdyt_fid' ,$_SESSION['bfdyt_id']);
                $this->db->select('bfdyt_id');
                $res = $this->db->get('bfdyt_user');
                $res_arr = $res->result_array();
                foreach ($res_arr as $k => $v) {
                    $arr[]=$v['bfdyt_id'];
                }
                $arr[] = $_SESSION['bfdyt_id'];
                $xqwhere = ' (bfdyt_backuser in ('.(implode(',',$arr)).') or bfdyt_frontuser in ('.(implode(',',$arr)).'))';
            }else{
                $xqwhere = '1=1';
            }

            if(!$year){
                $year = date('Y');
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
            $this->db->where('bfdyt_zxdate >',$start.' 00:00:00');
            $this->db->where('bfdyt_zxdate <',$end.' 23:59:59');
            $this->db->where($xqwhere);
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
        	if($_SESSION['bfdyt_role']>1){
                 echo '<script>alert("你无权访问该信息")</script>';
                exit;
            }
            //非管理账号限定只显示所在主管下的信息
            $this->load->database();
            $arr = array();
            if($_SESSION['bfdyt_role']==1){//当前账户为校区主管
                $this->db->where('bfdyt_fid' ,$_SESSION['bfdyt_id']);
                $this->db->select('bfdyt_id');
                $res = $this->db->get('bfdyt_user');
                $res_arr = $res->result_array();
                foreach ($res_arr as $k => $v) {
                    $arr[]=$v['bfdyt_id'];
                }
                $arr[] = $_SESSION['bfdyt_id'];
                $xqwhere = ' (bfdyt_backuser in ('.(implode(',',$arr)).') or bfdyt_frontuser in ('.(implode(',',$arr)).'))';
            }else{
                $xqwhere = '1=1';
            }

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
            $this->db->where($xqwhere);
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
            arsort($data['area']);
            foreach ($data['area'] as $k => $v) {
            	$i++;
            	if($i>=8){
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
        	if($_SESSION['bfdyt_role']>1){
                 echo '<script>alert("你无权访问该信息")</script>';
                exit;
            }
            //非管理账号限定只显示所在主管下的信息
            $this->load->database();
            $arr = array();
            if($_SESSION['bfdyt_role']==1){//当前账户为校区主管
                $this->db->where('bfdyt_fid' ,$_SESSION['bfdyt_id']);
                $this->db->select('bfdyt_id');
                $res = $this->db->get('bfdyt_user');
                $res_arr = $res->result_array();
                foreach ($res_arr as $k => $v) {
                    $arr[]=$v['bfdyt_id'];
                }
                $arr[] = $_SESSION['bfdyt_id'];
                $xqwhere = ' (bfdyt_backuser in ('.(implode(',',$arr)).') or bfdyt_frontuser in ('.(implode(',',$arr)).'))';
            }else{
                $xqwhere = '1=1';
            }
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
        	$this->db->where('bfdyt_zxdate >',$start.' 00:00:00');
            $this->db->where('bfdyt_zxdate <',$end.' 23:59:59');
            $this->db->where($xqwhere);
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
            // var_dump($data['month']);exit;
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
                    	AND i.bfdyt_zxdate >= "'.$start.' 00:00:00"
                    	AND i.bfdyt_zxdate <= "'.$end.' 23:59:59"
                        AND i.bfdyt_zystatus = "1"'.$userwhere;
                        
            }else{//普通后台客服
                $sql='SELECT  i.bfdyt_major as major,
                    i.bfdyt_city as city,i.bfdyt_learnmonth as month
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_backuser=u.bfdyt_id 
                        AND u.bfdyt_id = '.$_SESSION['bfdyt_id'].'
                        AND i.bfdyt_zxdate >= "'.$start.' 00:00:00"
                        AND i.bfdyt_zxdate <= "'.$end.' 23:59:59"
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
                    	AND i.bfdyt_zxdate >= "'.$start.' 00:00:00"
                        AND i.bfdyt_zxdate <= "'.$end.' 23:59:59" 
                        AND i.bfdyt_isjoin = "1"'.$userwhere;
                        
            }else{//普通前台客服
                $sql='SELECT  i.bfdyt_major as major,
                    i.bfdyt_city as city,i.bfdyt_learnmonth as month
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_frontuser=u.bfdyt_id 
                   		 AND i.bfdyt_zxdate >= "'.$start.' 00:00:00"
                        AND i.bfdyt_zxdate <= "'.$end.' 23:59:59"
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
        //信息导出页面
        public function getExcel(){
            if($_SESSION['bfdyt_role']>1){
                 echo '<script>alert("你无权访问该信息")</script>';
                exit;
            }
            //获取校区管理账户
            $this->load->database();
            $this->db->select('bfdyt_id,bfdyt_name');
            $this->db->where('bfdyt_role','1');
            $query = $this->db->get('bfdyt_user');
            $xqleaders = $query->result_array();
            $this->load->view('analyse/getexcel',array('xqlist'=>$xqleaders));
        }
        //执行信息导出到excel
        public function dogetExcel(){
            if($_SESSION['bfdyt_role']>1){
                 echo '<script>alert("你无权访问该信息")</script>';
                exit;
            }
            //获取用户数据生成excel
            $title=array('姓名','性别','后台老师','前台老师','电话','qq/微信','来源','住址','状态','录入时间','校区');
            $starTime = $this->input->get('starTime',0);
            $endTime = $this->input->get('endTime',0);
            $type = $this->input->get('type',0);//校区选择

            if(!$starTime||!$endTime){
                exit('<script>alert("请选择日期范围")</script>');
            }
            $datewhere = 'bfdyt_zxdate>="'.$starTime.' 00:00:00" and bfdyt_zxdate<="'.$endTime.' 23:59:59"';
            $this->load->database();
            //指定校区主管信息
            $arr = array();
            if($type){
                $this->db->where('bfdyt_fid',$type);
                $this->db->select('bfdyt_id');
                $res = $this->db->get('bfdyt_user');
                $res_arr = $res->result_array();
                if(!$res_arr){
                    exit('<script>alert("没有信息可以导出,请检查导出条件")</script>');
                }
                foreach ($res_arr as $k => $v) {
                    $arr[]=$v['bfdyt_id'];
                }
                $arr[] = $type;
                $xqwhere = ' (bfdyt_backuser in ('.(implode(',',$arr)).') or bfdyt_frontuser in ('.(implode(',',$arr)).'))';
            }else{
                $xqwhere = '1=1';
            }

            //获取校区老师信息
            $users = array();
            $this->db->select('bfdyt_id,bfdyt_name,bfdyt_fid');
            if($arr){
                $this->db->where('bfdyt_id in ('.implode(',',$arr).')');
            }
            $query = $this->db->get('bfdyt_user');
            $userlist = $query->result_array();
            foreach($userlist as $v){
                $users[$v['bfdyt_id']]=$v['bfdyt_name'];
                $xqids[$v['bfdyt_id']]=$v['bfdyt_fid'];
            }
            //查询信息
            $this->db->where($datewhere);
            $this->db->where($xqwhere);
            $this->db->select('bfdyt_name,bfdyt_sex,bfdyt_backuser,bfdyt_frontuser,bfdyt_phone,bfdyt_qq,bfdyt_source,bfdyt_pro,bfdyt_city,bfdyt_zxstatus,bfdyt_zxdate');
            $query = $this->db->get('bfdyt_studentinfo');
            $infolist = $query->result_array();
            if(!$infolist){
                exit('<script>alert("没有信息可以导出,请检查导出条件")</script>');
            }
            $data = array();
            foreach ($infolist as $k => $v) {
                $xqid='';
                foreach($v as $kk=>$vv){
                    if($kk == 'bfdyt_backuser'&&$vv){
                        $xqid = $xqids[$vv];
                        $vv = $users[$vv];
                    }
                    if($kk == 'bfdyt_frontuser'&&$vv){
                        $xqid = $xqids[$vv];
                        $vv = $users[$vv];
                    }
                    if($kk == 'bfdyt_pro'){
                        $proarr = $this->config->item('area_array');
                        $cityarr = $this->config->item('sub_array');
                        $vv = $proarr[$vv].$cityarr[$v['bfdyt_city']];
                    }
                    if($kk=='bfdyt_sex'){
                        $vv=$vv?'男':'女';
                    }
                    if($kk=='bfdyt_source'){
                        $sourcearr = $this->config->item('source');
                        $vv = $sourcearr[$vv];
                    }
                    if($kk=='bdfyt_phone'){

                        $vv = trim($vv,'/');
                    }
                    if($kk=='bfdyt_city'){
                        continue;
                    }
                    if($kk=='bfdyt_zxstatus'){
                        $zxstatusarr=$this->config->item('visitstatus');
                        $vv = $zxstatusarr[$vv];
                    }
                    $data[$k][] = $vv;
                }
                //校区
                if($xqid){
                    $data[$k][]=$users[$xqid];
                }else{
                    $data[$k][]='管理员添加';
                }
            }
            if($type){
                $xq = $users[$type];
            }else{
                $xq = '全部校区';
            }
            $filename = $xq.$starTime.'-'.$endTime.'数据';
            $this->exportExcel($title,$data,$filename,'/excel',true);
        }
        /** 
         * 数据导出 
         * @param array $title   标题行名称 
         * @param array $data   导出数据 
         * @param string $fileName 文件名 
         * @param string $savePath 保存路径 
         * @param $type   是否下载  false--保存   true--下载 
         * @return string   返回文件全路径 
         * @throws PHPExcel_Exception 
         * @throws PHPExcel_Reader_Exception 
         */  
        private function exportExcel($title=array(), $data=array(), $fileName='', $savePath='./', $isDown=false){  
            $this->load->library('phpexcel');
          
            //横向单元格标识  
            $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');  
              
            $this->phpexcel->getActiveSheet(0)->setTitle('sheet名称');   //设置sheet名称  
            $_row = 1;   //设置纵向单元格标识  
            if($title){  
                $_cnt = count($title);  
                $this->phpexcel->getActiveSheet(0)->mergeCells('A'.
                $_row.':'.$cellName[$_cnt-1].$_row);   //合并单元格  
                $this->phpexcel->setActiveSheetIndex(0)->setCellValue('A'.$_row, '数据导出：'.date('Y-m-d H:i:s'));  //设置合并后的单元格内容  
                $_row++;  
                $i = 0;  
                foreach($title AS $v){   //设置列标题  
                    $this->phpexcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].$_row, $v);  
                    $i++;  
                }  
                $_row++;  
            }  
            //填写数据  
            if($data){  
                $i = 0;  
                foreach($data AS $_v){  
                    $j = 0;  
                    foreach($_v AS $_cell){  
                        $this->phpexcel->getActiveSheet(0)->setCellValue($cellName[$j] . ($i+$_row), $_cell);  
                        $j++;  
                    }  
                    $i++;  
                }  
            }  
            //文件名处理  
            if(!$fileName){  
                $fileName = uniqid(time(),true);  
            }
            $objWrite = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');  
            if($isDown){   //网页下载 
                ob_end_clean();
                header('pragma:public');  
                header("Content-Disposition:attachment;filename=$fileName.xlsx");  
                $objWrite->save('php://output');exit;  
            }
            $_fileName = iconv("utf-8", "gb2312", $fileName);   //转码  
            $_savePath = $savePath.$_fileName.'.xlsx';  
            $objWrite->save($_savePath);  
            return $savePath.$fileName.'.xlsx';  
        }  
	}
 ?>