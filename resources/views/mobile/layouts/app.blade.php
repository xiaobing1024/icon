<!DOCTYPE html>
<html>
<head>
    <title>lottery</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <link href="https://cdn.bootcss.com/weui/1.1.3/style/weui.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/jquery-weui/1.2.1/css/jquery-weui.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            -webkit-tap-highlight-color: transparent;
        }

        .ball {
            width: 26px;
            height: 26px;
            background-color: #fe2e2e;
            border-radius: 50%;
            margin-right: 8px;
            box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);
            font-size: 14px;
            text-align: center;
            line-height: 26px;
            color: white;
        }

        .blue-ball {
            background-color: #29a3f6;
        }

        [v-cloak] {
            display: none
        }

    </style>

    @yield('css')
</head>

<body ontouchstart>

@yield('content')

<script src="https://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/fastclick/1.0.6/fastclick.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.min.js"></script>
<script src="https://cdn.bootcss.com/clipboard.js/2.0.4/clipboard.min.js"></script>
<script src="https://cdn.bootcss.com/collect.js/4.6.1/collect.min.js"></script>
<script src="https://cdn.bootcss.com/vue/2.5.22/vue.min.js"></script>

<script>
    var ssq_red = [
        '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33'
    ];

    var ssq_blue = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16'];

    var dlt_red = [
        '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35'
    ];
    var dlt_blue = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

    $(function () {
        // FastClick.attach(document.body);
    });

    function random_num(type = 0, arr = []) {
        var data = collect([]);
        if (arr.length < 1) {
            data = collect(type == 0 ? ssq_red : dlt_red).random(type == 0 ? 6 : 5).sort();

            data = data.concat(collect(type == 0 ? ssq_blue : dlt_blue).random(type == 0 ? 1 : 2).sort());
        } else {
            arr.forEach(function (value, index, array) {
                data = data.concat(collect(value[0]).random(value[1])).sort();
            })
        }

        return data.toArray();
    }
</script>
@yield('js')
</body>
</html>