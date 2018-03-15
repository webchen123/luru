<?php 
    /**
    * 登录验证
    */
    class Login extends CI_Controller 
    {
        function __construct(){
            parent::__construct();
        }
        public function index(){
            $this->load->view('login');
        }
        /*
        *验证登录
        */
        public function dologin(){
            $this->load->library('session');
            $this->load->library('form_validation');
            $this->load->database();
            $formrule = array(
                array(
                    'field' => 'username',
                    'label' => 'username Confirmation',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'passwd',
                    'label' => 'passwd Confirmation',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'capword',
                    'label' => 'capword Confirmation',
                    'rules' => 'required'
                )
            );
            $this->form_validation->set_rules($formrule);
            if($this->form_validation->run()==false){
                echo '<script>alert("请提交正确的数据后访问");window.location.href="/login/"</script>';
                exit;
            }
            $username = $this->input->post('username');
            $passwd = md5($this->input->post('passwd'));
            $captcha = $this->input->post('capword');
            $capword = $this->session->capword;
            if(strtolower($capword)!=strtolower($captcha)){
                echo '<script>alert("验证码不正确");window.location.href="/login/"</script>';
                exit;
            }
            //限制一小时内同一ip连续5次登陆失败则禁止该ip登陆
            $time = time()-3600;
            $ip=$_SERVER['REMOTE_ADDR'];
            $this->db->where('bfdyt_ip = "'.$ip.'" and bfdyt_logintime>='.$time.' and bfdyt_status = "0"');
            $loginFailNum = $this->db->count_all_results('bfdyt_log');
            if($loginFailNum>=6){
                echo '<script>alert("一小时内你已经连续5次登陆失败，请稍后再试");window.location.href="/login/"</script>';
                exit;
            }
            $query =  $this->db->get_where('bfdyt_user',array('bfdyt_username'=>$username,'bfdyt_passwd'=>$passwd,'bfdyt_status'=>'1'));
            if($result = $query->result_array()){
                $this->session->set_userdata($result[0]);
                $this->db->where('bfdyt_id', $result[0]['bfdyt_id']);
                $this->db->update('bfdyt_user', array('bfdyt_logintime'=>date('Y-m-d H:i:s',time()),'bfdyt_logins'=>$result[0]['bfdyt_logins']+1));
                $this->writelog('1',$username,$result[0]['bfdyt_id']);
                header('Location:/index/');
                exit;
            }else{
                $this->writelog('0',$username,0);
                echo '<script>alert("用户名密码不正确");window.location.href="/login/"</script>';
                exit;
            }
        }
        /*
        *记录登陆日志
        */
        protected function writelog($status,$username,$id){
            $ip=$_SERVER['REMOTE_ADDR'];
            $this->load->database();
            $this->db->insert('bfdyt_log',array(
                'bfdyt_username'=>$username,
                'bfdyt_userid'=>$id,
                'bfdyt_logintime'=>time(),
                'bfdyt_status'=>$status,
                'bfdyt_ip'=>$ip
                ));
        }
        /*
        *查看登陆日志
        */
        public function loglist($nowpage=1){
            if($_SESSION['bfdyt_role']!=0&&$_SESSION['bfdyt_role']!=1){
                echo '<script>alert("你无权限查看")</script>';
                exit;
            }
            $this->load->database();
             //分页
            $num = 5;//每页显示条数
            $this->db->from('bfdyt_user');
            $this->db->join('bfdyt_log','bfdyt_log.bfdyt_userid = bfdyt_user.bfdyt_id');
            $count = $this->db->count_all_results();
            $maxpage = ceil($count/$num);
            $prepage = $nowpage-1<=0?1:$nowpage-1;
            $nextpage = $nowpage+1>$maxpage?$maxpage:$nowpage+1;
            $offset = ($nowpage-1)*$num;

            $this->db->select('bfdyt_log.bfdyt_id as bfdyt_id ,bfdyt_log.bfdyt_username as bfdyt_username ,bfdyt_name,bfdyt_role,bfdyt_log.bfdyt_logintime as bfdyt_time');
            $this->db->from('bfdyt_user');
            $this->db->join('bfdyt_log','bfdyt_log.bfdyt_userid = bfdyt_user.bfdyt_id');
            $this->db->order_by('bfdyt_id','DESC');
            $this->db->limit($num,$offset);
            $query = $this->db->get();
            $res = $query->result_array();
            $this->load->view('log/list',array("res"=>$res,'nowpage'=>$nowpage,'maxpage'=>$maxpage,'prepage'=>$prepage,'nextpage'=>$nextpage));
        }
        /*
        *删除登陆日志
        */
        public function dellog(){
            if($_SESSION['bfdyt_role']!=0&&$_SESSION['bfdyt_role']!=1){
                echo '0';
                exit;
            }
            $id = $this->input->post('id');
            $this->load->database();
            $res = $this->db->delete('bfdyt_log',array('bfdyt_id'=>$id));
            if($res){
                echo 1;
            }else{
                echo 0;
            }
        }
        /*
        *退出
        */
        public function loginout(){
            $this->load->library('session');
            $this->session->sess_destroy();
            header('Location:/login/');
        }
        /*
        *生成验证码
        */
        public function captcha(){
            $this->load->helper('captcha');
            $this->load->library('session');
            $vals = array(
                'img_path'  => './public/captcha/',
                'img_url'   => '/public/captcha/',
                'font_path' => './public/font/SERIFAT.TTF',
                'expiration'    => 300,
                'img_width' => '126',
                'img_height'    => '52',
                'word_length'   =>4,
                'font_size' => 25,
                'img_id'    => 'Imageid',
                'pool'      => '23456789abcdefghjkmnpqrstuvwxyz',
                // White background and border, black text and red grid
                'colors'    => array(
                    'background' => array(225, 225,225),
                    'border' => array(255, 255, 255),
                    'text' => array(rand(0,100), rand(0,100), rand(0,100)),
                    'grid' => array(225, 225, 225)
                )
            );
            $cap = create_captcha($vals);
            $word = $cap['word'];
            $this->session->set_userdata('capword',$word);
            echo $cap['image'];
        }
    }
 ?>
