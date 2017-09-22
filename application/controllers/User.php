<?php 
    /*
    *用户管理
    */
    class User extends CI_Controller 
    {
        function __construct(){
            parent::__construct();
            if(!isset($_SESSION['bfdyt_username'])){
                header('Location:/login/');
                exit;
            }
        }
        //用户列表
        public function index($nowpage=1){
            //权限认证
            if($_SESSION['bfdyt_role']!=0&&$_SESSION['bfdyt_role']!=1){
                echo '<script>alert("你无权限操作")</script>';
                exit;
            }
            $this->load->database();
            if($_SESSION['bfdyt_role']==1){
                $where = ' bfdyt_fid='.$_SESSION['bfdyt_id'];
            }else{
                $where = ' 1 = 1';
            }
            //分页
            $num = 5;//每页显示条数
            $this->db->where($where);
            $count = $this->db->count_all_results('bfdyt_user');
            $maxpage = ceil($count/$num);
            $prepage = $nowpage-1<=0?1:$nowpage-1;
            $nextpage = $nowpage+1>$maxpage?$maxpage:$nowpage+1;
            $offset = ($nowpage-1)*$num;
            $limit = ' limit '.$offset.','.$num;
            $sql = "select bfdyt_id,bfdyt_username,bfdyt_role,bfdyt_name,bfdyt_passwd,bfdyt_phone,
                    bfdyt_status,bfdyt_time,bfdyt_logintime,bfdyt_logins,lusername,lname
                    from bfdyt_user as user 
                    left join (select bfdyt_id as lid,bfdyt_username as lusername,bfdyt_name as lname from bfdyt_user) as luser 
                    on user.bfdyt_fid = luser.lid where".$where.' order by bfdyt_id desc '.$limit;
            $query = $this->db->query($sql);
            $count = $query->num_rows();
            $data = $query->result_array();
            $this->load->view('user/list',
                array('data'=>$data,'nowpage'=>$nowpage,'maxpage'=>$maxpage,'prepage'=>$prepage,'nextpage'=>$nextpage)
                );
        }

        //添加页面
        public function add(){
            if($_SESSION['bfdyt_role']!=0&&$_SESSION['bfdyt_role']!=1){
                echo '<script>alert("你无权限操作")</script>';
                exit;
            }
            $this->load->database();
            
            $data=array();
            if($_SESSION['bfdyt_role']==0){
                $this->db->select('bfdyt_id,bfdyt_fid,bfdyt_name,bfdyt_username');
                $query = $this->db->get_where('bfdyt_user',array('bfdyt_fid'=>$_SESSION['bfdyt_id'],'bfdyt_role'=>'1'));
                $data['leader'] = $query->result_array();
            }else{
                $data['leader'][0] = $_SESSION; 
            }
            $this->load->view('user/add',$data);
        }
        //验证登录名不能重复
        public function checkname($id){

            $this->load->database();
            $username = $this->input->get('username');
            $this->db->select('bfdyt_username');
            if($id){
                $where = array('bfdyt_username'=>$username,'bfdyt_id !='=>$id);
            }else{
                $where = array('bfdyt_username'=>$username);
            }
            $query = $this->db->get_where('bfdyt_user',$where);
            if($query->num_rows()){
                echo 'false';
            }else{
                echo 'true';
            }
        }
        //执行用户添加
        public function doadd(){
             if($_SESSION['bfdyt_role']!=0&&$_SESSION['bfdyt_role']!=1){
                echo '<script>alert("你无权限操作")</script>';
                exit;
            }
            $this->load->database();
            $datastr = $this->input->post('data');
            parse_str($datastr);
            $data['bfdyt_username']=isset($username)&&$username!=''?$username:exit('0');
            $data['bfdyt_passwd']=isset($passwd)&&$passwd!=''?md5($passwd):exit('0');
            $data['bfdyt_role']=isset($role)&&$role>=$_SESSION['bfdyt_role']?$role:exit('0');
            $data['bfdyt_fid']=isset($fid)?$fid:exit('0');
            $data['bfdyt_name']=isset($name)?$name:exit('0');
            // $data['bfdyt_job']=isset($job)?$job:exit('0');
            // $data['bfdyt_sex']=isset($sex)?$sex:exit('0');
            $data['bfdyt_phone']=isset($phone)&&$phone!=''?$phone:exit('0');
            $data['bfdyt_time']=date('Y-m-d',time());
            $data['bfdyt_logintime']=date('Y-m-d H:i:s',time());
            $res = $this->db->insert('bfdyt_user',$data);
                echo $res?'1':'0';
        }
        //用户信息修改
        public function edit($id){
            $this->load->database();
            $query=$this->db->get_where('bfdyt_user',array('bfdyt_id'=>$id));
            $info = $query->result_array();
            $data['info'] = $info[0];
            $this->db->where_in(' bfdyt_role',array('0','1'));
            $lquery = $this->db->get('bfdyt_user');
            $data['leader'] = $lquery->result_array();
            // var_dump($this->db->last_query(),$data['leader']);exit;
            $this->load->view('user/edit',$data);
        }
        //执行用户修改
        public function doedit(){

            $this->load->database();
            $datastr = $this->input->post('data');
            parse_str($datastr);
            isset($username)&&$username!='' ? $data['bfdyt_username']=$username :'';
            isset($passwd)&&$passwd!=''     ? $data['bfdyt_passwd']=md5($passwd):'';
            isset($role)&&$role>=$_SESSION['bfdyt_role']? $data['bfdyt_role']=$role:'';
            isset($fid)                     ? $data['bfdyt_fid']=$fid:'';
            isset($name)                    ? $data['bfdyt_name']=$name:'';
            // $data['bfdyt_job']=isset($job)?$job:exit('0');
            // $data['bfdyt_sex']=isset($sex)?$sex:exit('0');
            isset($phone)&&$phone!=''       ? $data['bfdyt_phone'] = $phone:'';
            isset($status)                  ? $data['bfdyt_status'] = $status:'';
            $this->db->where('bfdyt_id',$id);
            $res = $this->db->update('bfdyt_user',$data);
                echo $res?'1':'0';
        }
        //删除账户
        public function del(){
            if($_SESSION['bfdyt_role']!=0&&$_SESSION['bfdyt_role']!=1){
                echo '<script>alert("你无权限操作")</script>';
                exit;
            }
            $id=$this->input->post('id');
            $this->load->database();
            $res = $this->db->delete('bfdyt_user',array('bfdyt_id'=>$id));
            if($res){
                $this->db->update('bfdyt_studentinfo', array('bfdyt_backuser'=>$_SESSION['bfdyt_id']), "bfdyt_bcakuser = ".$id);
                $this->db->update('bfdyt_studentinfo', array('bfdyt_frontuser'=>$_SESSION['bfdyt_id']), "bfdyt_frontuser = ".$id);
                echo 1;
            }else{
                echo 0;
            }
        }
    }
 ?>
