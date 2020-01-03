<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ajax异步传输验证用户名</title>


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">


        $(document).ready(function(){

            $('#sub').click(function(){


                $.ajax({
                    type:'POST',
                    url:'http://127.0.0.1:80/africashop/user/check_login',
                    data:{
                        name:$('#name').val()
                    },
                    dataType:'json',
                    success:function(msg){
                        if(msg.flag==1){
                            $('#checkbox2').html("您输入的用户名存在！请重新输入！");
                        }else{
                            $('#checkbox2').html("用户格式正确！");
                        }
                    }


                });
                });



            });



    </script>
</head>

<body>
<!--<form action="--><?php // echo site_url('userreg/regOption'); ?><!--" method="post" >-->
    用户 名：<input type="text" name="name" placeholder="用户名"  id="name" /><br/>
            <input type="button" id="sub" value="提交"/><br/>
            <p id="checkbox2"></p></p>
<!--</form>-->
</body>
</html>
