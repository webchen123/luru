<div class="bouncein">
    <div class="panel admin-panel">
        <div class="padding border-bottom container-layout">
            <!--第1排-->
            <div class="form-group w80">
                <div class="label">
                    <label><span style="color:red">*</span>学生姓名：</label>
                </div>
                <div class="field w25">
                    <input type="text" class="input w75" id="studentName" onblur="username()"  placeholder="学生姓名"/>
                    <div class="tips"></div>
                </div>
                <div class="label">
                    <label> 性别：</label>
                </div>
                <div class="field w17 margin-right" style="padding: 7px">
                    <input type="radio" id="man" checked="checked" name="sex" value="1"/> <label for="man" class="margin-left">男</label>
                    <input id="woman" type="radio"  name="sex" style="margin-left: 30px" value="0"/> <label for="woman" class="margin-left">女</label>
                    <div class="tips"></div>
                </div>
            </div>
            <!--第2排-->
            <div class="form-group w100">
                <div class="label">
                    <label>年龄：</label>
                </div>
                <div class="field w17">
                    <input type="text" id="studentAge" class="input w80"   placeholder="年龄"/>
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
                                echo '<option value="'.$k.'">'.$v.'</option>';
                            }
                         ?>
                    </select>
                </div>
            </div>
            <!--第3排-->
            <div class="form-group w100">
                <div class="label">
                    <label><span style="color:red">*</span>电话号码：</label>
                </div>
                <div class="field w17">
                    <input type="text"  class="input w80" id="phone" onblur="phone()" placeholder="请输入电话号码">
                    <div class="tips"></div>
                </div>
                <div class="label">
                    <label>微信/QQ：</label>
                </div>
                <div class="field w17">
                    <input type="text" class="input w80" id="qq"  placeholder="请输入微信或qq号码">
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
                                echo '<option value="'.$k.'">'.$v.'</option>';
                            }
                         ?>
                    </select>
                </div>
                <div class="label">
                    <label>回访时间：</label>
                </div>
                <div class="field w17">
                    <input type="date"  class="input w80" id="dataTime">
                </div>
            </div>
            <div class="form-group w100">
                <div class="label">
                    <label><span style="color:red">*</span>地区：</label>
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
                    <label><span style="color:red">*</span>来源渠道：</label>
                </div>
                <div class="field w17">
                    <select class="input w80" id="tool">
                        <option value="">-请选择-</option>
                        <?php 
                            foreach ($source as $k => $v) {
                                echo '<option value="'.$k.'">'.$v.'</option>';
                            }
                         ?>
                    </select>
                </div>
                
                <div class="label">
                    <label>回访状态：</label>
                </div>
                <div class="field w17">
                    <select class="input w80" name="visitstatus" id="visitstatus">
                         <option value="1">回访通话</option>
                        <?php 
                            foreach ($visitstatus  as $k => $v) {
                                if($k=='1') continue;
                                echo '<option value="'.$k.'">'.$v.'</option>';
                            }
                         ?>
                    </select>
                </div>
                <div class="label">
                    <label>报名状态</label>
                </div>
                <div class="field w17">
                    <select class="input w80" name="joinstatus" id="joinstatus">
                        <option value="0">请选择</option>
                        <option value="0">未报名</option>
                        <?php 
                            foreach ($major  as $k => $v) {
                                echo '<option value="'.$k.'">'.$v.'</option>';
                            }
                         ?>
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
                        <option value="14">-请选择-</option>
                        <?php 
                            foreach ($major  as $k => $v) {
                                echo '<option value="'.$k.'">'.$v.'</option>';
                            }
                         ?>
                    </select>
                </div>
                <div class="label">
                    <label>星级：</label>
                </div>
                <div class="field w17">
                    <select class="input w80" id="xing">
                        <?php 
                            foreach ($star  as $k => $v) {
                                echo '<option value="'.$k.'">'.$v.'</option>';
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
                                echo '<option value="'.$k.'">'.$v.'</option>';
                            }
                         ?>
                    </select>
                </div>
                <div class="label">
                    <label style="width:100px">预计到校时间：</label>
                </div>
                <div class="field w17">
                    <input type="date" id="getData" class="input w80"/>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group w80">
                <div class="label">
                    <label>备注：</label>
                </div>
                <div class="field w80">
                    <textarea name="desc" placeholder="请输入内容" id="remark" class="textarea w50"></textarea>
                </div>
            </div>
            <div class="form-group w25" style="margin: 0 auto;padding-top:20px">
                <div class="button bg-main" onclick="addInfo()" style="margin-left: 10px;cursor: pointer">添加</div>
            </div>
            <p style="color: red">温馨提示：请尽量填写完整信息 加*为必填项。</p>
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
    // function userAge(){
    //     var str=$('#studentAge');
    //     var reg=/^[1-9]\d$/;
    //     return rule(str,reg)
    // }
    //phone || qq,weixin 二个填一个
    // function ery(){
    //     var phone=$('#phone');
    //     var qq=$("#qq");
    //     if(phone.val()!="" || qq.val()!=""){
    //         return true;
    //     }else {
    //         alert('请填写qq或者微信号码');
    //         return false
    //     }
    // }
    //phone
    function phone(){
        var phone=$('#phone');
        var regPhone=/^1[3456789]\d{9}/;
        var value = phone.val();
        if(!regPhone.test(phone.val())){
            fls(phone);
            return false;
        }else {
            var res = true;
            console.log(value);
            $.ajax({
                url:'/student/checkinfo',
                data:{'value':value},
                type:'post',
                async:false,
                success:function(data){
                   if(data==1){
                        res = true;
                        tru(phone);
                   }else{
                        fls(phone);
                        alert('此电话号信息已添加');
                        res = false;
                   } 
                }
            })
            return res;
        }
    }
    //qq
    // function wq(){
    //     var qq=$("#qq");
    //     var value = qq.val();
    //     var regQQ=/^[0-9a-zA_Z]+$/;
    //     if(!regQQ.test(qq.val())){
    //         fls(qq);
    //         return false;
    //     }else {
    //         var res = true;
    //         $.ajax({
    //             url:'/student/checkinfo',
    //             data:{'value':value},
    //             type:"post",
    //             async:false,
    //             success:function(data){
    //                if(data==1){
    //                     res = true;
    //                     tru(qq);
    //                }else{
    //                     fls(qq);
    //                     alert('此qq信息已添加');
    //                     res = false;
    //                } 
    //             }
    //         })
    //         return res
    //     }
    // }
    //判断select是否选中
    function qu(){
        var seachprov=$("#seachprov").val();  // 省份
        var seachcity=$("#seachcity").val();  // 市
        var tool=$("#tool").val();            //来源渠道
        if(seachprov!=0 && seachcity!=0  &&   tool!=0 ){
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
        if( phone()==true&&username()==true && qu()==true){
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
            data.zxstatus=$('#visitstatus').val();
            // data.zxdate=$('#zxData').val();
            data.star=$('#xing').val();
            // data.zxtime=$('#stopTime').val();
            data.joinstatus=$('#joinstatus').val();
            data.major=$('#consult').val();
            data.learnmonth=$('#system').val();
            data.source=$('#tool').val();
            data.arivetime=$('#getData').val();
            data.remark=$('#remark').val();
            $.ajax({
                url:'/student/doadd/',
                type:'post',
                data:data,
                success:function(data){
                    if(data){
                        alert('添加成功');
                        window.location.href="/"
                    }else{
                        alert('添加失败，请联系管理员');
                    }
                },
                error:function(){
                    alert('请联系管理员')
                }
            })
        }else{
            alert('请检查必填信息是否填写完整');
        }
    }
</script>
