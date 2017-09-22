<div class="bouncein">
    <div class="panel admin-panel">
        <div class="padding border-bottom container-layout">
            <!--第1排-->
            <div class="form-group w80">
                <div class="label">
                    <label>学生姓名：</label>
                </div>
                <div class="field w25">
                    <input type="text" class="input w75" id="studentName" onblur="username()" value="<?=$data['bfdyt_name'];?>" placeholder="学生姓名"/>
                    <div class="tips"></div>
                </div>
                <div class="label">
                    <label> 性别：</label>
                </div>
                <div class="field w17 margin-right" style="padding: 7px">
                    <input type="radio" id="man"  name="sex" value="1" <?php echo $data['bfdyt_sex']==1?'checked="checked"':''; ?>/> <label for="man" class="margin-left">男</label>
                    <input id="woman" type="radio"  name="sex" <?php echo $data['bfdyt_sex']==0?'checked="checked"':''; ?> style="margin-left: 30px" value="0"/> <label for="woman" class="margin-left">女</label>
                    <div class="tips"></div>
                </div>
            </div>
            <!--第2排-->
            <div class="form-group w100">
                <div class="label">
                    <label>年龄：</label>
                </div>
                <div class="field w17">
                    <input type="text" id="studentAge" class="input w80" onblur="userAge()" value="<?=$data['bfdyt_age'];?>" placeholder="年龄"/>
                    <div class="tips"></div>
                </div>
                <div class="label">
                    <label>学历：</label>
                </div>
                <div class="field w17">
                    <select class="input w80" id="culture">
                        <option value="2">-请选择-</option>
                        <?php 
                            foreach ($edu  as $k => $v) {
                                if($k==$data['bfdyt_edu']){
                                    $select='selected="selected"';
                                }else{
                                    $select='';
                                }
                                echo '<option value="'.$k.'" '.$select.'>'.$v.'</option>';
                            }
                         ?>
                    </select>
                </div>
            </div>
            <!--第3排-->
            <div class="form-group w100">
                <div class="label">
                    <label>电话号码：</label>
                </div>
                <div class="field w17">
                    <input type="text"  class="input w80" id="phone" onblur="phone()" value="<?php echo $data['bfdyt_phone'] ?>" placeholder="请输入电话号码">
                    <div class="tips"></div>
                </div>
                <div class="label">
                    <label>微信/QQ：</label>
                </div>
                <div class="field w17">
                    <input type="text" class="input w80" id="qq" onblur="wq()" value="<?php  echo $data['bfdyt_qq']?>" placeholder="请输入微信或qq号码">
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group w100">
                <div class="label">
                    <label>职业状况：</label>
                </div>
                <div class="field w17">
                    <select class="input w80" id="vocation">
                        <option value="0">-请选择-</option>
                        <?php 
                            foreach ($job  as $k => $v) {
                                if($data['bfdyt_job']==$k){
                                    $select='selected="selected"';
                                }else{
                                    $select='';
                                }
                                echo '<option value="'.$k.'" '.$select.'>'.$v.'</option>';
                            }
                         ?>
                    </select>
                </div>
                <div class="label">
                    <label>回访时间：</label>
                </div>
                <div class="field w17">
                    <input type="date"  class="input w80" value="<?php echo $data['bfdyt_visitime']?>" id="dataTime">
                </div>
            </div>
            <div class="form-group w100">
                <div class="label">
                    <label>地区：</label>
                </div>
                <div class="field w80">
                    <select name="seachprov" class="input w17 margin-right" id="seachprov" onchange="changeComplexProvince(this.value, sub_array, 'seachcity', 'seachdistrict');">
                        <option value="0">省</option>
                    </select>
                    <select name="seachcity" class="input w17 margin-right" id="seachcity" onchange="changeCity(this.value,'seachdistrict','seachdistrict');">
                        <option value="0">市</option>
                    </select>
                    <select  id="seachdistrict" class="input w17" name="seachdistrict">
                        <option value="0">县</option>
                    </select>
                </div>
            </div>
            <!--第2排-->
            <div class="form-group w80">
                <div class="label">
                    <label>咨询日期：</label>
                </div>
                <div class="field w17">
                    <input type="date" id="zxData"  value="<?php echo $data['bfdyt_zxdate']?>" class="input w80"/>
                    <div class="tips"></div>
                </div>
                <div class="label">
                    <label>星级：</label>
                </div>
                <div class="field w17">
                    <select class="input w80" id="xing">
                        <option value="1">1星级</option>
                        <option value="2">2星级</option>
                        <option value="3">3星级</option>
                    </select>
                </div>
                <div class="label">
                    <label>咨询时间：</label>
                </div>
                <div class="field w17">
                    <select class="input w80" id="stopTime">
                        <option value="0">-请选择-</option>
                        <?php 
                            for($i=8;$i<24;$i++){
                                if($data['bfdyt_zxtime']==$i){
                                    $select='selected="selected"';
                                }else{
                                    $select='';
                                }
                                echo '<option value="'.$i.'"'.$select.'>'.$i.'点</option>';
                            }
                         ?>
                    </select>
                </div>
                <div class="label">
                    <label>咨询状态：</label>
                </div>
                <div class="field w17">
                    <select class="input w80" id="stzt">
                        <option value="0">请选择</option>
                        <option value="1" <?php echo $data['bfdyt_zxstatus']=='1'?'selected="selected"':'';?>>已到校</option>
                        <option value="2" <?php echo $data['bfdyt_zxstatus']=='2'?'selected="selected"':'';?>>未到校</option>
                    </select>
                </div>
            </div>
            <!--第三排-->
            <div class="form-group w80">
                <div class="label">
                    <label>咨询专业：</label>
                </div>
                <div class="field w17">
                    <select class="input w80" id="consult">
                        <option value="0">-请选择-</option>
                        <?php 
                            foreach ($major  as $k => $v) {
                                if($data['bfdyt_major']==$k){
                                    $select='selected="selected"';
                                }else{
                                    $select='';
                                }
                                echo '<option value="'.$k.'" '.$select.'>'.$v.'</option>';
                            }
                         ?>
                    </select>
                </div>
                <div class="label">
                    <label>来源渠道：</label>
                </div>
                <div class="field w17">
                    <select class="input w80" id="tool">
                        <option value="0">-请选择-</option>
                        <?php 
                            foreach ($source as $k => $v) {
                                # code...
                                if($data['bfdyt_major']==$k){
                                    $select='selected="selected"';
                                }else{
                                    $select='';
                                }
                                echo '<option value="'.$k.'" '.$select.'>'.$v.'</option>';
                            }
                         ?>
                    </select>
                </div>
                <div class="label">
                    <label>咨询学制：</label>
                </div>
                <div class="field w17">
                    <select class="input w80" id="system">
                        <option value="0">-请选择-</option>
                        <?php 
                            foreach($learnmonth as $k=>$v){
                               if($data['bfdyt_learnmonth']==$k){
                                    $select='selected="selected"';
                                }else{
                                    $select='';
                                }

                                echo '<option value="'.$k.'"'.$select.'>'.$v.'</option>';
                            }
                         ?>
                    </select>
                </div>
                <div class="label">
                    <label style="width:100px">预计到校时间：</label>
                </div>
                <div class="field w17">
                    <input type="date" id="getData" value="<?php echo $data['bfdyt_arivetime']; ?>" class="input w80"/>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group w80">
                <div class="label">
                    <label>备注：</label>
                </div>
                <div class="field w80">
                    <textarea name="desc" placeholder="请输入内容" id="htremark" class="textarea w50"><?php echo $data['bfdyt_htremark'];?></textarea>
                </div>
            </div>
            <div class="form-group w25" style="margin: 0 auto;padding-top:20px">
                <div class="button bg-main" onclick="addInfo()" style="margin-left: 10px;cursor: pointer">修改</div>
            </div>
            <p style="color: red">温馨提示：请填写完整资料</p>
        </div>
    </div>

    <script type="text/javascript">
        $(function (){
            initComplexArea('seachprov', 'seachcity', 'seachdistrict', area_array, sub_array, '0', '0', '0');
        });
        //得到地区码
        function getAreaID(){
            var area = 0;
            if($("#seachdistrict").val() != "0"){
                area = $("#seachdistrict").val();
            }else if ($("#seachcity").val() != "0"){
                area = $("#seachcity").val();
            }else{
                area = $("#seachprov").val();
            }
            return area;
        }
        function showAreaID() {
            //地区码
            var areaID = getAreaID();
            //地区名
            var areaName = getAreaNamebyID(areaID);
            return areaName;
        }

        //根据地区码查询地区名
        function getAreaNamebyID(areaID){
            var areaName = "";
            if(areaID.length == 2){
                areaName = area_array[areaID];
            }else if(areaID.length == 4){
                var index1 = areaID.substring(0, 2);
                areaName = area_array[index1] + " " + sub_array[index1][areaID];
            }else if(areaID.length == 6){
                var index1 = areaID.substring(0, 2);
                var index2 = areaID.substring(0, 4);
                areaName = area_array[index1] + " " + sub_array[index1][index2] + " " + sub_arr[index2][areaID];
            }
            return areaName;
        }
    </script>
</div>
<script>
    /*
     * form判断
     * */
    //name
    function username(){
        var str=$("#studentName");
        var reg=/^([\u4e00-\u9fa5]){2,7}$/;
        return rule(str,reg)
    }
    //age
    function userAge(){
        var str=$('#studentAge');
        var reg=/^([2-5]\d)|60$/;
        return rule(str,reg)
    }
    //phone || qq,weixin 二个填一个
    function ery(){
        var phone=$('#phone');
        var qq=$("#qq");
        if(phone.val()!="" || qq.val()!=""){
            return true;
        }else {
            alert('请填写qq或者微信号码');
            return false
        }
    }
    //phone
    function phone(){
        var phone=$('#phone');
        var regPhone=/^1[34578]\d{9}/;
        if(!regPhone.test(phone.val())){
            if((!phone.val())&&(wq())){
                return false;
            }
            fls(phone);
            return false;
        }else {
            tru(phone);
            return true
        }
    }
    //qq
    function wq(){
        var qq=$("#qq");
        var regQQ=/^[0-9a-zA_Z]+$/;
        if(!regQQ.test(qq.val())){
            if((!qq.val())&&(phone())){
                return false;
            }
            fls(qq);
            return false;
        }else {
            tru(qq);
            return true
        }
    }
    //判断select是否选中
    function qu(){
        var vocation=$("#vocation").val();   //职业状况
        var zxdata=$("#zxData").val();        //咨询日期
        var stopTime=$("#stopTime").val();     //咨询时间
        var stzt=$("#stzt").val();            //咨询状态；
        var tool=$("#tool").val();            //来源渠道
        if(vocation!=0  && seachprov!=0 && seachcity!=0 && stopTime!=0 && stzt!=0 &&  tool!=0 ){
            return true
        }else {
            return false
        }
    }
    //条件判断
    function rule(str,reg,ad){
        if(!reg.test(str.val()) && str.val()==""){
            fls(str);
            return false;
        }else {
            tru(str);
            return true
        }
    }
    // tips is true
    function tru(s){
        s.siblings('.tips').css({
            background:'url(/public/img/torf.jpg) no-repeat 0 0',
            width:40,
            height:34
        })
    }
    //tips is false
    function fls(s){
        s.siblings('.tips').css({
            background:'url(/public/img/torf.jpg) no-repeat -51px 0',
            width:40,
            height:34
        })
    }
    //----添加信息-----
    function addInfo(){
        if(ery()==true && username()==true && userAge()==true && qu()==true){
            //获取表单信息
            var data={};
            data.name=$("#studentName").val();
            data.sex=$('input[name=sex]:checked').val();
            data.age=$('#studentAge').val();
            data.edu=$('#culture').val();
            data.phone=$('#phone').val();
            data.qq=$('#qq').val();
            data.job=$('#vocation').val();
            data.visitime=$('#dataTime').val();
            data.pro=$('#seachprov').val();
            data.city=$('#seachcity').val();
            data.county=$('#seachdistrict').val();
            data.zxdate=$('#zxData').val();
            data.star=$('#xing').val();
            data.zxtime=$('#stopTime').val();
            data.zxstatus=$('#stzt').val();
            data.major=$('#consult').val();
            data.learnmonth=$('#tool').val();
            data.source=$('#tool').val();
            data.arivetime=$('#getData').val();
            data.remark=$('#remark').val();
            data.id = <?php echo $data['bfdyt_id'];?>;
            $.ajax({
                url:'/student/doedit/',
                type:'post',
                data:data,
                success:function(data){
                    if(data){
                        alert('修改成功');
                    }else{
                        alert('添加失败，请联系管理员');
                    }
                },
                error:function(){
                    alert('请联系管理员')
                }
            })
        }else{
            alert('请检查信息是否填写完整');
        }
    }
</script>

