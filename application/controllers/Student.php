<?php 
    /*
    * 学生信息管理
    */
    class Student extends CI_Controller 
    {
        function __construct(){
            parent::__construct();
            if(!isset($_SESSION['bfdyt_username'])||$_SESSION['bfdyt_role']<0||$_SESSION['bfdyt_role']>3){
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
                $zystatus = '0';//尚未转移信息
                $usertype = 'backuser';//后台客服信息
            }
            $data = array();
            $view = 'list';//加载信息列表
            $this->load->database();
            //完整性检索
            if(isset($_GET['full'])){//是否为完整信息
                if($_GET['full']==1){
                    $fullwhere=' AND i.bfdyt_qq != "" AND i.bfdyt_phone != "" AND i.bfdyt_visitime != "" AND i.bfdyt_arivetime != "" ';
                }else if($_GET['full']==='0'){
                    $fullwhere=' AND(i.bfdyt_qq ="" OR i.bfdyt_phone = "" OR  i.bfdyt_visitime = "" OR i.bfdyt_arivetime ="")';
                }else{
                    $fullwhere="";
                }
                $data['full'] = $_GET['full'];
            }else{
                $fullwhere="";
                $data['full'] = '';
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
            //已转接的信息获取
            if(isset($_GET['zystatus'])&&$_GET['zystatus']!=''){
               $zystatus = '1';
               $data['zystatus']='1';
               $view="vlist";//已经转移的学生信息
            }else{
                $data['zystatus']='';
            }
            //
            //分页
            $num = 5;//每页显示条数

            if($_SESSION['bfdyt_role']<2){//主管账户权限
                if($_SESSION['bfdyt_role']==0){//主账户查看所有
                    $userwhere='';
                }else{
                    $userwhere=' AND (u.bfdyt_fid = '.$_SESSION['bfdyt_id'].' OR u.bfdyt_id = '.$_SESSION['bfdyt_id'].')';
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
                    WHERE i.bfdyt_'.$usertype.'=u.bfdyt_id 
                        AND i.bfdyt_zystatus = "'.$zystatus.'"'.$userwhere.$fullwhere.$searchwhere.$visitwhere;
                $countsql='SELECT count(i.bfdyt_id) as num
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_'.$usertype.'=u.bfdyt_id 
                        AND i.bfdyt_zystatus = "'.$zystatus.'"'.$userwhere.$fullwhere.$searchwhere.$visitwhere;
                        
            }else{//普通后台客服
                $sql='SELECT i.bfdyt_zxdate as zxdate ,u.bfdyt_name as kfname,
                    i.bfdyt_zxtime as zxtime,i.bfdyt_source as source,
                    i.bfdyt_name as name,i.bfdyt_sex as sex,
                    i.bfdyt_age as age,i.bfdyt_phone as phone,
                    i.bfdyt_qq as qq,i.bfdyt_star as star,
                    i.bfdyt_visitime as vtime,i.bfdyt_arivetime as atime,
                    i.bfdyt_major as major,i.bfdyt_id as id,
                    i.bfdyt_pro as pro,i.bfdyt_city as city,i.bfdyt_county as county
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_'.$usertype.'=u.bfdyt_id 
                        AND u.bfdyt_id = '.$_SESSION['bfdyt_id'].'
                        AND i.bfdyt_zystatus = "'.$zystatus.'"'.$fullwhere.$searchwhere.$visitwhere;
                $countsql='SELECT count(i.bfdyt_id) as num
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_'.$usertype.'=u.bfdyt_id 
                        AND u.bfdyt_id = '.$_SESSION['bfdyt_id'].'
                        AND i.bfdyt_zystatus = "'.$zystatus.'"'.$fullwhere.$searchwhere.$visitwhere;
            }
            $countquery = $this->db->query($countsql);
            $countres = $countquery->row_array();
            $count = $countres['num'];
            $maxpage = ceil($count/$num);
            $prepage = $nowpage-1<=0?1:$nowpage-1;
            $nextpage = $nowpage+1>$maxpage?$maxpage:$nowpage+1;
            $offset = ($nowpage-1)*$num;
            $limit = ' limit '.$offset.','.$num;

            $query = $this->db->query($sql.$limit);
            // echo '<pre>';
            $data['data']=$query->result_array();
            $data['source']=$this->config->item('source');
            $data['major']=$this->config->item('major');
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
                $zystatus = '1';//转移信息
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

            if($_SESSION['bfdyt_role']<2){//主管账户权限
                if($_SESSION['bfdyt_role']==0){//主账户查看所有
                    $userwhere='';
                }else{
                    $userwhere=' AND (u.bfdyt_fid = '.$_SESSION['bfdyt_id'].' OR u.bfdyt_id = '.$_SESSION['bfdyt_id'].')';
                }

                $sql='SELECT i.bfdyt_zxdate as zxdate ,u.bfdyt_name as kfname,
                    i.bfdyt_zxdate as zxdate,i.bfdyt_name as name,
                    i.bfdyt_phone as phone,i.bfdyt_qq as qq,
                    i.bfdyt_arivetime as atime,i.bfdyt_id as id,
                    i.bfdyt_backuser as backuserid,i.bfdyt_visitime as vtime,
                    i.bfdyt_isjoin as joinstatus,i.bfdyt_rltime as rltime,i.bfdyt_major as major
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_'.$usertype.'=u.bfdyt_id 
                        AND i.bfdyt_zystatus = "'.$zystatus.'"'.$userwhere.$joinwhere.$searchwhere.$visitwhere;
                $countsql='SELECT count(i.bfdyt_id) as num
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_'.$usertype.'=u.bfdyt_id 
                        AND i.bfdyt_zystatus = "'.$zystatus.'"'.$userwhere.$joinwhere.$searchwhere.$visitwhere;
                        
            }else{//普通前台客服
                $sql='SELECT i.bfdyt_zxdate as zxdate ,u.bfdyt_name as kfname,
                    i.bfdyt_zxdate as zxdate,i.bfdyt_name as name,
                    i.bfdyt_phone as phone,i.bfdyt_qq as qq,
                    i.bfdyt_arivetime as atime,i.bfdyt_id as id,
                    i.bfdyt_backuser as backuserid,i.bfdyt_visitime as vtime,
                    i.bfdyt_isjoin as joinstatus,i.bfdyt_rltime as rltime,i.bfdyt_major as major
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_'.$usertype.'=u.bfdyt_id 
                        AND u.bfdyt_id = '.$_SESSION['bfdyt_id'].'
                        AND i.bfdyt_zystatus = "'.$zystatus.'"'.$searchwhere.$joinwhere.$visitwhere;
                $countsql='SELECT count(i.bfdyt_id) as num
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_'.$usertype.'=u.bfdyt_id 
                        AND u.bfdyt_id = '.$_SESSION['bfdyt_id'].'
                        AND i.bfdyt_zystatus = "'.$zystatus.'"'.$searchwhere.$joinwhere.$visitwhere;
            }
            $countquery = $this->db->query($countsql);
            $countres = $countquery->row_array();
            $count = $countres['num'];
            $maxpage = ceil($count/$num);
            $prepage = $nowpage-1<=0?1:$nowpage-1;
            $nextpage = $nowpage+1>$maxpage?$maxpage:$nowpage+1;
            $offset = ($nowpage-1)*$num;
            $limit = ' limit '.$offset.','.$num;

            $query = $this->db->query($sql.$limit);
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
            $zystatus=1;
             //条件搜索
            if(isset($_GET['search'])&&$_GET['search']!=''){
                $data['search'] = $search = $_GET['search'];
                $searchwhere = ' AND ( i.bfdyt_name like "%'.$search.'%" OR i.bfdyt_qq like "%'.$search.'%" OR i.bfdyt_phone like "%'.$search.'%")';
            }else{
                $searchwhere = '';
                 $data['search'] = '';
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
                        AND i.bfdyt_frontuser = 0
                        AND i.bfdyt_zystatus = "'.$zystatus.'"'.$searchwhere;
                $countsql='SELECT count(i.bfdyt_id) as num
                    FROM  bfdyt_studentinfo AS i,bfdyt_user AS u 
                    WHERE i.bfdyt_backuser=u.bfdyt_id 
                        AND i.bfdyt_frontuser = 0
                        AND i.bfdyt_zystatus = "'.$zystatus.'"'.$searchwhere;
            $countquery = $this->db->query($countsql);

            $countres = $countquery->row_array();
            $count = $countres['num'];
            $maxpage = ceil($count/$num);
            $prepage = $nowpage-1<=0?1:$nowpage-1;
            $nextpage = $nowpage+1>$maxpage?$maxpage:$nowpage+1;
            $offset = ($nowpage-1)*$num;
            $limit = ' limit '.$offset.','.$num;

            $query = $this->db->query($sql.$limit);
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
            $where['bfdyt_id'] = $this->input->get('id',0);
            $where['bfdyt_zystatus'] = '1';
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
                $post = $this->input->post();
                foreach($post as $k=>$v){
                    if($k=='remark'){
                        if($_SESSION['bfdyt_role']==3){
                            $data['bfdyt_htremark']=$this->input->post($k);
                            $data['bfdyt_frontuser']=$_SESSION['bfdyt_id'];
                            $data['bfdyt_backuser']=$_SESSION['bfdyt_id'];
                            $data['bfdyt_rltime']=date('Y-m-d');
                            $data['bfdyt_zystatus']='1';
                        }else{
                            $data['bfdyt_htremark']=$this->input->post($k);
                            $data['bfdyt_backuser']=$_SESSION['bfdyt_id'];
                            $data['bfdyt_zystatus']='0';
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
                    $data['bfdyt_'.$k]=$this->input->post($k);
                }   
            }
            $res=$this->db->insert('bfdyt_studentinfo',$data);
            if($res){
                $dataVisit['bfdyt_infoid']=$this->db->insert_id();
                $res=$this->db->insert('bfdyt_visit',$dataVisit);
                echo 1;
            }else{
                echo 0;
            }
        }
        //获取某位学生的信息
        public function getinfo($id){
            $this->load->database();
            $studentinfo = $this->db->get_where('bfdyt_studentinfo',array('bfdyt_id'=>$id));
            $data['data']=$studentinfo->row_array();
            $this->db->select('bfdyt_name');
            $backuserinfo = $this->db->get_where('bfdyt_user',array('bfdyt_id'=>$data['data']['bfdyt_backuser']));
            $data['backuser'] = $backuserinfo->row_array();
            $this->db->select('bfdyt_name');
            $frontuserinfo = $this->db->get_where('bfdyt_user',array('bfdyt_id'=>$data['data']['bfdyt_frontuser']));
            $data['frontuser'] = $frontuserinfo->row_array();
            $data['source']=$this->config->item('source');
            $data['major']=$this->config->item('major');
            $data['job']=$this->config->item('job');
            $data['edu']=$this->config->item('edu');
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
                    $sql = 'UPDATE bfdyt_studentinfo SET bfdyt_'.$key.'="'.$value.'"';
                    break;
                case 'phone':
                case 'qq':
                case 'htremark':
                case 'qtremark':
                    $sql = 'UPDATE bfdyt_studentinfo SET bfdyt_'.$key.' = CONCAT( bfdyt_'.$key.',"/'.$value.'")';
                    break;
                default:
                break;
            }
            if($where&&$sql){
                // var_dump($sql.$where);exit;
                $this->db->query($sql.$where);
                $res = $this->db->affected_rows();
                echo $res;
            }else{
                echo 0;
            }
        }
        //信息修改
        public function edit($id){
            if($_SESSION['bfdyt_role']!=0){
                echo '<script>alert("你无权访问该信息")</script>';
                exit;
            }
            $this->load->database();
            $studentinfo = $this->db->get_where('bfdyt_studentinfo',array('bfdyt_id'=>$id));
            $data['data']=$studentinfo->row_array();
            $data['source']=$this->config->item('source');
            $data['major']=$this->config->item('major');
            $data['job']=$this->config->item('job');
            $data['edu']=$this->config->item('edu');
            $data['learnmonth']=$this->config->item('learnmonth');
            $this->load->view('student/edit',$data);
        }
        //执行信息修改
        public function doedit(){
            if($_SESSION['bfdyt_role']!=0){
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
            // $res = $this->db->delete('bfdyt_studentinfo',array('bfdyt_id'=>$id));
            if($rse){
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
    }
?>
