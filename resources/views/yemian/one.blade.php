<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script type="text/javascript" src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
</head>
<body>
    <button id="one">one</button>
    <div>
        @foreach ($arr as $key => $value)
            <p>{{$value}}</p>
        @endforeach
    </div>

    <script>
        $(function (){
            /*$('#one').click(function (){
                $.ajax({
                    type: "get",
                    url: "http://www.test.com:82/test/ajax_getUsertwo",
//                    url: "http://10.10.22.92:82/test/ajax_getUsertwo",
//                    url: "http://10.10.22.92:8989/bos/getMerMerchantinfByNo",
                    async: true,
                    data: {},
                    // jsonpCallback : 'jiecallback',
                    dataType: 'json',
//                    contentType:"application/json; charset=utf-8",
                    // crossDomain:true,
                    success: function (data) {
                        console.log(data);
                    }
                    , error: function (XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                })
            })*/
            var arr = [];
            arr.push(1);
            var arr2 = Array.from(<?= json_encode($arr)?>);
            console.log(arr);
            console.log((arr2));
            $('#one').click(function (){
                $.ajax({
                    type: "get",
                    url: "http://www.mytest.com/async/yemian2",
//                    url: "http://10.10.22.92:82/test/ajax_getUsertwo",
//                    url: "http://10.10.22.92:8989/bos/getMerMerchantinfByNo",
                    async: true,
                    data: {},
                    // jsonpCallback : 'jiecallback',
                    dataType: 'json',
//                    contentType:"application/json; charset=utf-8",
                    // crossDomain:true,
                    success: function (data) {
                        console.log(data.data);
                    }
                    , error: function (XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                })
            })


        })
    </script>

</body>
</html>