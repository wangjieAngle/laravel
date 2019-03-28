<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.all.min.js')}}"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="{{asset("ueditor/lang/zh-cn/zh-cn.js")}}"></script>

    <style type="text/css">
        div{
            width:100%;
        }
    </style>
    <script type="text/javascript" src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
</head>
<body>
    <script id="container" name="content" type="text/plain">
        这里写你的初始化内容
    </script>
    <script type="text/javascript">
        var ue = UE.getEditor('container');
    </script>
</body>
</html>