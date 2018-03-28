<?php 
    /*
    * 学生信息管理
    */
    class Student extends CI_Controller 
    {
        function __construct(){
            parent::__construct();
            if(!isset($_SESSION['bfdyt_username'])||$_SESSION['bfdyt_role']<0||$_SESSION['bfdyt_role']>5){
                header('Location:/login/');
                exit;
            }
        }
        /*
        * 后台客服学生信息列表
        */
        public function index($nowpage=1){
            if($_SESSION['bfdyt_role']==3){
                 echo '<script>alert("你无权访问该信息")</script>';
                exit;
            }else {
                // $zystatus = '0';//尚未转移信息
                $usertype = 'backuser';//后台客服信息
            }
            $data = array();
            $view = 'list';//加载信息列表
            $this->load->database();
            $checkstr = '';
            //已转接信息列表
            if(isset($_GET['zystatus'])&&$_GET['zystatus']){
                $data['zystatus'] = '1';
                $zywhere = ' AND i.bfdyt_frontuser != 0 ';
                $checkstr.='zystatus='.$data['zystatus'].'&';
                $view = 'vlist';
            }else{
                $data['zystatus']='';
                $zywhere = '';
            }
            //完整性检索
            if(isset($_GET['isfull'])){//是否为完整信息
                if($_GET['isfull']==1){
                    $fullwhere=' AND i.bfdyt_phone != "" ';
                }else if($_GET['isfull']==='0'){
                    $fullwhere=' AND i.bfdyt_phone = ""';
                }else{
                    $fullwhere="";
                }
                $data['isfull'] = $_GET['isfull'];
                $checkstr.='isfull='.$data['isfull'].'&';
            }else{
                $fullwhere="";
                $data['isfull'] = '';
            }
            //咨询老师筛选
            if(isset($_GET['backuser'])&&$_GET['backuser']){
                $data['backuser'] = $_GET['backuser'];
                $backuserwhere = ' AND i.bfdyt_backuser = '.$_GET['backuser'];
                $checkstr.='backuser='.$data['backuser'].'&';
            }else{
                $data['backuser']='';
                $backuserwhere = '';
            }
	    //省份筛选
            if(isset($_GET['pro'])&&$_GET['pro']){
                $data['pro'] = $_GET['pro'];
                $prowhere = ' AND i.bfdyt_pro = '.$_GET['pro'];
                $checkstr.='pro='.$data['pro'].'&';
            }else{
                $data['pro']='';
                $prowhere = '';
            }
            //城市筛选
            if(isset($_GET['city'])&&$_GET['city']){
                $data['city'] = $_GET['city'];
                $citywhere = ' AND i.bfdyt_city = '.$_GET['city'];
                $checkstr.='city='.$data['city'].'&';
            }else{
                $data['city']='';
                $citywhere = '';
            }
            //回访状态检索
            if(isset($_GET['zxstatus'])&&$_GET['zxstatus']){
                $data['zxstatus'] = $_GET['zxstatus'];
                $zxwhere = ' AND i.bfdyt_zxstatus = '.$_GET['zxstatus'];
                $checkstr.='zxstatus='.$data['zxstatus'].'&';
            }else{
                $data['zxstatus']='';
                $zxwhere = '';
            }
            //日期范围筛选
            if(isset($_GET['startime'])&&$_GET['startime']){
                $startime = date('Y-m-d',strtotime($_GET['startime']));
                $stimewhere = ' AND i.bfdyt_zxdate >= "'.$startime.' 00:00:00" ';
                $data['startime'] = $startime;
                $checkstr.='startime='.$data['startime'].'&';
            }else{
                $stimewhere = '';
                $data['startime'] = '';
            }
            if(isset($_GET['endtime'])&&$_GET['endtime']){
                $endtime = date('Y-m-d',strtotime($_GET['endtime']));
                $etimewhere = ' AND i.bfdyt_zxdate <= "'.$endtime.' 23:59:59" ';
                $data['endtime'] = $endtime;
                $checkstr.='endtime='.$data['endtime'].'&';
            }else{
                $etimewhere = '';
                $data['endtime'] = '';
            }
            //条件搜索
            if(isset($_GET['search'])&&$_GET['search']!=''){
                $data['search'] = $search = $_GET['search'];
                $searchwhere = ' AND ( i.bfdyt_name like "%'.$search.'%" OR i.bfdyt_qq like "%'.$search.'%" OR i.bfdyt_phone like "%'.$search.'%")';
                $checkstr.='search='.$data['search'].'&';
            }else{
                $searchwhere = '';
                 $data['search'] = '';
            }
            $data['checkstr'] = $checkstr;
            $wherecheck = $fullwhere.$backuserwhere.$prowhere.$citywhere.$zxwhere.$searchwhere.$stimewhere.$etimewhere.$zywhere;

            //要回访的信息列表获取
            if(isset($_GET['visit'])&&$_GET['visit']!=''){
                if($_GET['visit']==1){
                    $visitwhere=' AND  i.bfdyt_visitstatus = 1';
                    $view = 'vlist';//已经回访学生信息
                }else if($_GET['visit']==='0'){
                    $visitwhere=' AND i.bfdyt_visitime <="'.(date('Y-m-d',time())).'" AND i.bfdyt_visitime>0 AND i.bfdyt_visitstatus = 0 ';
                    $view = 'vlist';//要回访学生信息
                }else{
                    $visitwhere="";
                }
                $data['visit'] = $_GET['visit'];
            }else{
                $visitwhere="";
                $data['visit'] = '';
            }
            $num = 5;//每页显示条数

            if($_SESSION['bfdyt_role']<2||$_SESSION['bfdyt_role']==5){//主管账户权限
                if($_SESSION['bfdyt_role']==0){//主账户查看所有
                    $userwhere='';
                    $backuserswhere = ' bfdyt_role not in("3","0","1","4","5") ';
                }else{
                    if($_SESSION['bfdyt_role']==5){
                        $userwhere=' AND (u.bfdyt_fid = '.$_SESSION['bfdyt_fid'].' OR u.bfdyt_id = '.$_SESSION['bfdyt_id'].')';
                        $backuserswhere = ' bfdyt_role = "2" AND bfdyt_fid = '.$_SESSION['bfdyt_fid'];
                    }else{
                        $userwhere=' AND (u.bfdyt_fid = '.$_SESSION['bfdyt_id'].' OR u.bfdyt_id = '.$_SESSION['bfdyt_id'].')';
                        $backuserswhere = ' bfdyt_role = "2" AND bfdyt_fid = '.$_SESSION['bfdyt_id'];
                    }
                }

                $sql='SELECT i.bfdyt_zxdate as zxdate ,u.bfdyt_name as kfname,
                    i.bfdyt_zxtime as zxtime,i.bfdyt_source as source,
                    i.bfdyt_name as name,i.bfdyt_sex as sex,i.bfdyt_frontuser as frontuser,
                    i.bfdyt_age as age,i.bfdyt_phone as phone,
                    i.bfdyt_qq as qq,i.bfdyt_star as star,i.bfdyt_zystatus as zystatus,
                    i.bfdyt_visitime as vtime,i.bfdyt_arivetime as atime,
                    i.bfdyt_major as major,i.bfdyt_id as id,i.bfdyt_zxstatus as visitstatus,
                    i.bfdyt_pro as pro,i.bfdyt_city as city,i.bfdyt_county as county
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_'.$usertype.'=u.bfdyt_id '.$userwhere.$wherecheck.$visitwhere;
                $countsql='SELECT count(i.bfdyt_id) as num
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_'.$usertype.'=u.bfdyt_id '.$userwhere.$wherecheck.$visitwhere;
                //获取后台客服老师名单
                $backuserquery = $this->db->query('select bfdyt_id,bfdyt_name from bfdyt_user where '.$backuserswhere);
                $data['backusers'] = $backuserquery->result_array();    
            }else{//普通后台客服
                $sql='SELECT i.bfdyt_zxdate as zxdate ,u.bfdyt_name as kfname,
                    i.bfdyt_zxtime as zxtime,i.bfdyt_source as source,
                    i.bfdyt_name as name,i.bfdyt_sex as sex,i.bfdyt_frontuser as frontuser,
                    i.bfdyt_age as age,i.bfdyt_phone as phone,
                    i.bfdyt_qq as qq,i.bfdyt_star as star,i.bfdyt_zystatus as zystatus,
                    i.bfdyt_visitime as vtime,i.bfdyt_arivetime as atime,
                    i.bfdyt_major as major,i.bfdyt_id as id,i.bfdyt_zxstatus as visitstatus,
                    i.bfdyt_pro as pro,i.bfdyt_city as city,i.bfdyt_county as county
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_'.$usertype.'=u.bfdyt_id 
                        AND u.bfdyt_id = '.$_SESSION['bfdyt_id'].$wherecheck.$visitwhere;
                $countsql='SELECT count(i.bfdyt_id) as num
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_'.$usertype.'=u.bfdyt_id 
                        AND u.bfdyt_id = '.$_SESSION['bfdyt_id'].$wherecheck.$visitwhere;
            }
            
            $countquery = $this->db->query($countsql);
            $countres = $countquery->row_array();
            $count = $countres['num'];
            $maxpage = ceil($count/$num);
            $prepage = $nowpage-1<=0?1:$nowpage-1;
            $nextpage = $nowpage+1>$maxpage?$maxpage:$nowpage+1;
            $offset = ($nowpage-1)*$num;
            $limit = ' limit '.$offset.','.$num;

            $query = $this->db->query($sql.' order by i.bfdyt_zxdate desc , i.bfdyt_id desc '.$limit);
            // echo '<pre>';
            $data['data']=$query->result_array();

            //获取前台客服老师名单
            if($data['zystatus']){
                $frontuserquery = $this->db->query('select bfdyt_id,bfdyt_name from bfdyt_user where bfdyt_role != 2');
                $frontusers = $frontuserquery->result_array();
                $data['frontusers'] = array();
                foreach ($frontusers as  $v) {
                    $data['frontusers'][$v['bfdyt_id']] =$v['bfdyt_name']; 
                }
            }

            $data['source']=$this->config->item('source');
            $data['major']=$this->config->item('major');
            $data['visitstatus']=$this->config->item('visitstatus');
            $data['maincity']=$this->config->item('maincity');
	        $data['province']=$this->config->item('province');
            $data['maxpage']=$maxpage;
            $data['prepage']=$prepage;
            $data['nextpage']=$nextpage;
            $data['nowpage']=$nowpage;
            $this->load->view('/student/'.$view,$data);

        }
        /*
        *前台客服学生信息列表
        */
        public function indexfront($nowpage=1){
             if($_SESSION['bfdyt_role']==2){
                 echo '<script>alert("你无权访问该信息")</script>';
                exit;
            }else {
                // $zystatus = '1';//转移信息
                $usertype = 'frontuser';//前台客服信息
            }
            $data = array();
            $view = 'frontlist';//加载信息列表
            $this->load->database();
            if(isset($_GET['joinstatus'])){//是否为完整信息
                if($_GET['joinstatus']==1){
                    $joinwhere=' AND i.bfdyt_isjoin="1" ';
                }else if($_GET['joinstatus']==='0'){
                    $joinwhere=' AND i.bfdyt_isjoin="0" ';
                }else{
                    $joinwhere="";
                }
                $data['joinstatus'] = $_GET['joinstatus'];
            }else{
                $joinwhere="";
                $data['joinstatus'] = '';
            }
            //条件搜索
            if(isset($_GET['search'])&&$_GET['search']!=''){
                $data['search'] = $search = $_GET['search'];
                $searchwhere = ' AND ( i.bfdyt_name like "%'.$search.'%" OR i.bfdyt_qq like "%'.$search.'%" OR i.bfdyt_phone like "%'.$search.'%")';
            }else{
                $searchwhere = '';
                 $data['search'] = '';
            }
            //要回访的信息获取
            if(isset($_GET['visit'])&&$_GET['visit']!=''){
                if($_GET['visit']==1){
                    $visitwhere=' AND  i.bfdyt_visitstatus = 1';
                    $view = 'frontvlist';//已经回访学生信息
                }else if($_GET['visit']==='0'){
                    $visitwhere=' AND i.bfdyt_visitime <="'.(date('Y-m-d',time())).'" AND i.bfdyt_visitime>0 AND i.bfdyt_visitstatus = 0 ';
                    $view = 'frontvlist';//要回访学生信息
                }else{
                    $visitwhere="";
                }
                $data['visit'] = $_GET['visit'];
            }else{
                $visitwhere="";
                $data['visit'] = '';
            }
            //分页
            $num = 5;//每页显示条数

            if($_SESSION['bfdyt_role']<2||$_SESSION['bfdyt_role']==4){//主管账户权限
                if($_SESSION['bfdyt_role']==0){//主账户查看所有
                    $userwhere='';
                }else{
                    if($_SESSION['bfdyt_role']==4){//前台主管
                        $userwhere=' AND (u.bfdyt_fid = '.$_SESSION['bfdyt_fid'].' OR u.bfdyt_id = '.$_SESSION['bfdyt_id'].')';
                    }else{
                        $userwhere=' AND (u.bfdyt_fid = '.$_SESSION['bfdyt_id'].' OR u.bfdyt_id = '.$_SESSION['bfdyt_id'].')';
                    }
                }

                $sql='SELECT i.bfdyt_zxdate as zxdate ,u.bfdyt_name as kfname,
                    i.bfdyt_zxdate as zxdate,i.bfdyt_name as name,
                    i.bfdyt_phone as phone,i.bfdyt_qq as qq,
                    i.bfdyt_arivetime as atime,i.bfdyt_id as id,
                    i.bfdyt_backuser as backuserid,i.bfdyt_visitime as vtime,
                    i.bfdyt_isjoin as joinstatus,i.bfdyt_rltime as rltime,i.bfdyt_major as major
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_'.$usertype.'=u.bfdyt_id '.$userwhere.$joinwhere.$searchwhere.$visitwhere;
                $countsql='SELECT count(i.bfdyt_id) as num
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_'.$usertype.'=u.bfdyt_id '.$userwhere.$joinwhere.$searchwhere.$visitwhere;
                        
            }else{//普通前台客服
                $sql='SELECT i.bfdyt_zxdate as zxdate ,u.bfdyt_name as kfname,
                    i.bfdyt_zxdate as zxdate,i.bfdyt_name as name,
                    i.bfdyt_phone as phone,i.bfdyt_qq as qq,
                    i.bfdyt_arivetime as atime,i.bfdyt_id as id,
                    i.bfdyt_backuser as backuserid,i.bfdyt_visitime as vtime,
                    i.bfdyt_isjoin as joinstatus,i.bfdyt_rltime as rltime,i.bfdyt_major as major
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_'.$usertype.'=u.bfdyt_id 
                        AND u.bfdyt_id = '.$_SESSION['bfdyt_id'].$searchwhere.$joinwhere.$visitwhere;
                $countsql='SELECT count(i.bfdyt_id) as num
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_'.$usertype.'=u.bfdyt_id 
                        AND u.bfdyt_id = '.$_SESSION['bfdyt_id'].$searchwhere.$joinwhere.$visitwhere;
            }
            $countquery = $this->db->query($countsql);
            $countres = $countquery->row_array();
            $count = $countres['num'];
            $maxpage = ceil($count/$num);
            $prepage = $nowpage-1<=0?1:$nowpage-1;
            $nextpage = $nowpage+1>$maxpage?$maxpage:$nowpage+1;
            $offset = ($nowpage-1)*$num;
            $limit = ' limit '.$offset.','.$num;

            $query = $this->db->query($sql.' order by i.bfdyt_zxdate, i.bfdyt_id desc '.$limit);
            //获取后台网聊客服信息
            $this->db->select('bfdyt_id,bfdyt_name');
            $userquery = $this->db->get('bfdyt_user');
            $userarray = $userquery->result_array();
            $data['backuser']=array();
            foreach($userarray as $v){
                $data['backuser'][$v['bfdyt_id']]=$v['bfdyt_name'];
            }
            // echo '<pre>';
            $data['data']=$query->result_array();
            $data['source']=$this->config->item('source');
            $data['major']=$this->config->item('major');
            $data['visitstatus']=$this->config->item('visitstatus');
            $data['maxpage']=$maxpage;
            $data['prepage']=$prepage;
            $data['nextpage']=$nextpage;
            $data['nowpage']=$nowpage;
           // var_dump($this->db->last_query());exit;

            $this->load->view('/student/'.$view,$data);
        }
        //公共学生信息列表
        public function publicinfo($nowpage = 1){
            $this->load->database();
            $num = 5;
             //条件搜索
            if(isset($_GET['search'])&&$_GET['search']!=''){
                $data['search'] = $search = $_GET['search'];
                $searchwhere = ' AND ( i.bfdyt_name like "%'.$search.'%" OR i.bfdyt_qq like "%'.$search.'%" OR i.bfdyt_phone like "%'.$search.'%")';
            }else{
                $searchwhere = '';
                 $data['search'] = '';
            }
            //非管理账号限定只显示所在主管下的信息
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
                $xqwhere = ' and i.bfdyt_backuser in ('.(implode(',',$arr)).')';
            }else if($_SESSION['bfdyt_role']>1){
                $this->db->where('bfdyt_fid' ,$_SESSION['bfdyt_fid']);
                $this->db->select('bfdyt_id');
                $res = $this->db->get('bfdyt_user');
                $res_arr = $res->result_array();
                foreach ($res_arr as $k => $v) {
                    $arr[]=$v['bfdyt_id'];
                }
                $arr[] = $_SESSION['bfdyt_fid'];
                $xqwhere = ' and i.bfdyt_backuser in ('.(implode(',',$arr)).')';
            }else{
                $xqwhere = '';
            }
            $sql='SELECT i.bfdyt_zxdate as zxdate ,u.bfdyt_name as kfname,
                    i.bfdyt_zxtime as zxtime,i.bfdyt_source as source,
                    i.bfdyt_name as name,i.bfdyt_sex as sex,
                    i.bfdyt_age as age,i.bfdyt_phone as phone,
                    i.bfdyt_qq as qq,i.bfdyt_star as star,
                    i.bfdyt_visitime as vtime,i.bfdyt_arivetime as atime,
                    i.bfdyt_major as major,i.bfdyt_id as id,
                    i.bfdyt_pro as pro,i.bfdyt_city as city,i.bfdyt_county as county
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_backuser = u.bfdyt_id
                        AND i.bfdyt_frontuser = 0 '.$xqwhere.$searchwhere;
            $countsql='SELECT count(i.bfdyt_id) as num
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_backuser=u.bfdyt_id 
                        AND i.bfdyt_frontuser = 0 '.$xqwhere.$searchwhere;
            $countquery = $this->db->query($countsql);

            $countres = $countquery->row_array();
            $count = $countres['num'];
            $maxpage = ceil($count/$num);
            $prepage = $nowpage-1<=0?1:$nowpage-1;
            $nextpage = $nowpage+1>$maxpage?$maxpage:$nowpage+1;
            $offset = ($nowpage-1)*$num;
            $limit = ' limit '.$offset.','.$num;
            $orderby = ' order by i.bfdyt_zxdate desc ,  i.bfdyt_id desc ';
            $query = $this->db->query($sql.$orderby.$limit);
            $data['data']=$query->result_array();
            $data['source']=$this->config->item('source');
            $data['major']=$this->config->item('major');
            $data['maxpage']=$maxpage;
            $data['prepage']=$prepage;
            $data['nextpage']=$nextpage;
            $data['nowpage']=$nowpage;
            $this->load->view('/student/publiclist',$data);
        }
        /*
        *信息认领
        */
        public function receiveinfo(){
            $this->load->database();
            $where[' bfdyt_id'] = $this->input->get('id',0);
            $where['bfdyt_frontuser'] = 0;
            $now = date('Y-m-d');
            $data = array(
                'bfdyt_rltime'=>$now,
                'bfdyt_frontuser' => $_SESSION['bfdyt_id'],
                'bfdyt_visitime'=>0,
                'bfdyt_visitstatus'=>0
                );
            $this->db->where($where);
            $this->db->update('bfdyt_studentinfo',$data);
            $res = $this->db->affected_rows();
            if($res){
                echo 1;
            }else{
                echo 0;
            }
        }
        /*
        * 信息添加
        */
        public function add(){
            $data['edu'] = $this->config->item('edu');
            $data['major'] = $this->config->item('major');
            $data['job'] = $this->config->item('job');
            $data['source'] = $this->config->item('source');
            $data['learnmonth'] = $this->config->item('learnmonth');
            $data['visitstatus'] = $this->config->item('visitstatus');
            $data['star'] = $this->config->item('star');
            $this->load->view('student/add',$data);
        }
        /*
        *执行学生添加
        */
        public function doadd(){
            $this->load->library('form_validation');
            $this->load->database();
            //参数验证
            $config=array(
                array(
                    'field'=>'name',
                    'label'=>'姓名',
                    'rules'=>'required|max_length[12]'
                    ),
                array(
                    'field'=>'age',
                    'label'=>'年龄',
                    'rules'=>'max_length[3]'
                    ),
                array(
                    'field'=>'phone',
                    'label'=>'电话',
                    'rules'=>'max_length[11]'
                    ),
                array(
                    'field'=>'qq',
                    'label'=>'微信qq号',
                    'rules'=>'max_length[36]'
                    ),
                array(
                    'field'=>'source',
                    'label'=>'来源',
                    'rules'=>'required'
                    ),
                );
            $this->form_validation->set_rules($config);
            if($this->form_validation->run()==false){
                echo 0;
                exit;
            }else{
                $data=array();//信息数据
                $dataVisit=array();//回访数据
                $dataremark = array();
                $post = $this->input->post();
                foreach($post as $k=>$v){
                    if($k=='remark'){
                        if($_SESSION['bfdyt_role']==3){
                            $data['bfdyt_frontuser']=$_SESSION['bfdyt_id'];
                            $data['bfdyt_backuser']=$_SESSION['bfdyt_id'];
                            $data['bfdyt_rltime']=date('Y-m-d');
                        }else{
                            $data['bfdyt_backuser']=$_SESSION['bfdyt_id'];
                        }
                        if($v){
                            $dataremark['bfdyt_content']=$v;
                            $dataremark['bfdyt_username'] = $_SESSION['bfdyt_name'];
                            $dataremark['bfdyt_time']=date('Y-m-d H:i:s');
                        }
                        continue;
                    }
                    if($k=='visitime'&&$v!=''){
                        $dataVisit['bfdyt_userid']=$_SESSION['bfdyt_id'];
                        $dataVisit['bfdyt_time']=$v;
                        $dataVisit['bfdyt_status']=0;
                        $data['bfdyt_visitime']=$v;
                        continue;
                    }
                    if($k=='joinstatus'){
                        if($v){
                            $data['bfdyt_isjoin']='1';
                            $data['bfdyt_major'] = $v;
                        }
                        continue;
                    }
                    $data['bfdyt_'.$k]=$this->input->post($k);
                } 
                $data['bfdyt_zxdate'] = date('Y-m-d H:i:s');  
            }
            if($data['bfdy_phone']){
                 $res = $this->db->get_where('bfdyt_studentinfo',array('bfdyt_phone'=>$value))->result_array();
                 if($res){
                    echo 0;
                    exit;
                 }
            }
            $res=$this->db->insert('bfdyt_studentinfo',$data);
            if($res){
                if($dataremark){
                    $dataremark['bfdyt_infoid']=$dataVisit['bfdyt_infoid']=$this->db->insert_id();
                    $dataremark['bfdyt_zxstatus']=$data['bfdyt_zxstatus'];
                    $this->db->insert('bfdyt_remark',$dataremark);
                }
                echo 1;
            }else{
                echo 0;
            }
        }
        //备注添加
        public function addremark(){
            $data=array();
            $this->load->database();
            $data['bfdyt_infoid']=$this->input->get('infoid','');
            $data['bfdyt_username']=$this->input->get('name','');
            $data['bfdyt_content']=$this->input->get('content','');
            $data['bfdyt_zxstatus'] =$this->input->get('zxstatus','');
            $data['bfdyt_time'] = date('Y-m-d H:i:s');
            $res=$this->db->insert('bfdyt_remark',$data);
            if($res){
                echo 1;
            }else{
                echo 0;
            }
        }
        //获取某位学生的信息
        public function getinfo($id){
            $this->load->database();
            //学生信息
            $studentinfo = $this->db->get_where('bfdyt_studentinfo',array('bfdyt_id'=>$id));
            $data['data']=$studentinfo->row_array();
            //后台老师信息
            $this->db->select('bfdyt_name');
            $backuserinfo = $this->db->get_where('bfdyt_user',array('bfdyt_id'=>$data['data']['bfdyt_backuser']));
            $data['backuser'] = $backuserinfo->row_array();
            //前台老师信息
            $this->db->select('bfdyt_name');
            $frontuserinfo = $this->db->get_where('bfdyt_user',array('bfdyt_id'=>$data['data']['bfdyt_frontuser']));
            $data['frontuser'] = $frontuserinfo->row_array();
            //备注信息
            $remarkinfo=$this->db->get_where('bfdyt_remark',array('bfdyt_infoid'=>$id));
            $data['remark'] = $remarkinfo->result_array();
            $data['source']=$this->config->item('source');
            $data['major']=$this->config->item('major');
            $data['job']=$this->config->item('job');
            $data['edu']=$this->config->item('edu');
            $data['visitstatus']=$this->config->item('visitstatus');
            $data['star']=$this->config->item('star');
            $this->load->view('student/studentinfo',$data);
        }
        //更新学生信息
        public function update(){
            $this->load->database();
            $where = '';
            $key = '';
            $sql = '';
            foreach($_POST as $k => $v){
                if($k=='id'){
                    $where=' where bfdyt_id = '.$v;
                }else{
                    $key = $k;
                    $value = $v;
                }
            }
            switch($key){
                case 'visitime':
                case 'name':
                case 'arivetime':
                case 'zystatus':
                case 'visitstatus':
                case 'zxstatus':
                case 'phone':
                case 'star':
                    $sql = 'UPDATE bfdyt_studentinfo SET bfdyt_'.$key.'="'.$value.'"';
                    break;
                case 'qq':
                    $sql = 'UPDATE bfdyt_studentinfo SET bfdyt_'.$key.' = CONCAT( bfdyt_'.$key.',"/'.$value.'")';
                    break;
                default:
                break;
            }
            if($where&&$sql){
                // var_dump($sql.$where);exit;
                $res = false;
                if($key == 'phone'){
                    $res = $this->db->get_where('bfdyt_studentinfo',array('bfdyt_phone'=>$value))->result_array();
                   
                }
                if($res){
                    $result['code']=0;
                    $result['mesg']="修改失败该手机号已添加,\r\n可前往信息添加页面查询添加人信息";
                }else{
                    $this->db->query($sql.$where);
                    $res = $this->db->affected_rows();
                    if($res){
                        $result['code']=1;
                        $result['mesg']='修改成功';
                    }else{
                        $result['code']=0;
                        $result['mesg']='修改信息重复,联系管理员';
                    }
                }
            }else{
                $result['code']=0;
                $result['mesg']='修改失败,联系管理员';
            }
            echo json_encode($result);
        }
        //信息修改
        public function edit($id){
            if($_SESSION['bfdyt_role']>1&&$_SESSION['bfdyt_role']<4){
                echo '<script>alert("你无权访问该信息")</script>';
                exit;
            }
            $this->load->database();
            $studentinfo = $this->db->get_where('bfdyt_studentinfo',array('bfdyt_id'=>$id));
            $data['data']=$studentinfo->row_array();
            //备注信息
            $remarkinfo=$this->db->get_where('bfdyt_remark',array('bfdyt_infoid'=>$id));
            $data['remark'] = $remarkinfo->result_array();

            $data['edu'] = $this->config->item('edu');
            $data['major'] = $this->config->item('major');
            $data['job'] = $this->config->item('job');
            $data['source'] = $this->config->item('source');
            $data['learnmonth'] = $this->config->item('learnmonth');
            $data['visitstatus'] = $this->config->item('visitstatus');
            $data['star'] = $this->config->item('star');
            $this->load->view('student/edit',$data);
        }
        //执行信息修改
        public function doedit(){
            if($_SESSION['bfdyt_role']>1&&$_SESSION['bfdyt_role']<4){
                echo '0';
                exit;
            }
            $this->load->library('form_validation');
            $this->load->database();
            //参数验证
            $config=array(
                array(
                    'field'=>'name',
                    'label'=>'姓名',
                    'rules'=>'required|max_length[12]'
                    ),
                array(
                    'field'=>'age',
                    'label'=>'年龄',
                    'rules'=>'required|max_length[3]'
                    ),
                array(
                    'field'=>'phone',
                    'label'=>'电话',
                    'rules'=>'max_length[11]'
                    ),
                array(
                    'field'=>'qq',
                    'label'=>'微信qq号',
                    'rules'=>'max_length[12]'
                    ),
                );
            $this->form_validation->set_rules($config);
            if($this->form_validation->run()==false){
                echo 0;
                exit;
            }else{
                $data=array();//信息数据
                $dataVisit=array();//回访数据
                $where='';
                $post = $this->input->post();
                foreach($post as $k=>$v){
                    if(!$v) continue;
                    if($k=='id'){
                        $where=" bfdyt_id=".$v;
                        continue;
                    }
                    $data['bfdyt_'.$k]=$this->input->post($k);
                }   
            }
            // var_dump($data,$where);exit;
            if(!$where){
                echo 0;
                exit;
            }
            $res=$this->db->update('bfdyt_studentinfo',$data,$where);
            if($res){
                echo 1;
            }else{
                echo 0;
            }
        }
        //信息删除
        public function delinfo($id){
             if($_SESSION['bfdyt_role']!=0){
                echo '0';
                exit;
            }
            $this->load->database();
            $res = $this->db->delete('bfdyt_studentinfo',array('bfdyt_id'=>$id));
            if($res){
                echo '1';
            }else{
                echo '0';
            }
        }
        //更改报名状态
        public function makejoin(){
            if($_SESSION['bfdyt_role']==2){
                echo 0;
                exit;
            }
            $id=$this->input->post('id',0);
            $major=$this->input->post('major',0);
            if(!$id||!$major){
                echo 0;
                exit;
            }
            $this->load->database();
            $this->db->update('bfdyt_studentinfo',array('bfdyt_major'=>$major,'bfdyt_isjoin'=>'1'),'bfdyt_id = '.$id);
            $res = $this->db->affected_rows();
            echo $res;
        }
        public function checkinfo(){
            $value=$this->input->post('value');
            $this->load->database();
            $this->db->select('bfdyt_backuser,bfdyt_frontuser,bfdyt_name');
            $this->db->where('bfdyt_phone',$value);
            $this->db->or_where('bfdyt_qq',$value);
            $query = $this->db->get('bfdyt_studentinfo');
            $res = $query->result_array();
            if($res){
                if($res[0]['bfdyt_frontuser']){
                    $this->db->select('bfdyt_name,bfdyt_phone');
                    $this->db->where('bfdyt_id',$res[0]['bfdyt_frontuser']);
                    $user = $this->db->get('bfdyt_user');
                }else{
                    $this->db->select('bfdyt_name,bfdyt_phone');
                    $this->db->where('bfdyt_id',$res[0]['bfdyt_backuser']);
                    $user = $this->db->get('bfdyt_user');
                }
                $owner = $user->result_array();
                $data['code'] = 1;
                $data['owner']=$owner[0]['bfdyt_name'].'~电话'.$owner[0]['bfdyt_phone'];
            }else{
                $data['code'] = 0;
                $data['owner']='';
            }
            echo json_encode($data);
        }
    }
?>
