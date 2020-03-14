<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>错误提示</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="renderer" content="webkit"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-transform"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="stylesheet" href="{__CSS__}bootstrap.min.css">
    <link rel="stylesheet" href="{__CSS__}font-awesome.min.css">
    <link rel="stylesheet" href="{__CSS__}site.css">
    <script src="{__JS__}jquery.js"></script>
    <script src="{__JS__}bootstrap.min.js"></script>
    <script src="{__JS__}dialog.js"></script>
</head>
<body>
<div class="container body-content mt20">
    <div class="row mt20 mb20">
        <div class="col-md-6 col-md-offset-3 col-xs-12">
            <div class="panel panel-danger">
                <div class="panel-heading"><i class="fa fa-close fa-fw"></i>错误提示</div>
                <div class="panel-body">
                    <p><strong>错误原因：</strong><br/>{$message}</p>
                    <p>
                        <a class="btn btn-primary" href="javascript:history.back(1)">返回并修正</a>
                        <a class="btn btn-default" href="javascript:window.close()">关闭本窗口</a>
                    </p>
                </div>
                <div class="panel-footer">版权所有&copy; <a href="{$config.website}">{$config.title}</a></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>