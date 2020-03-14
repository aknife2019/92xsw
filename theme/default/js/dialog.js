var dialog = dialog || {};

/*
 * bootstrap扩展插件
 * */
dialog = {

    /*
     * dialog.normal 对话框 基于bootstrap模态弹窗
     * @options 可选参数
     * {
     *    id: 弹窗标识ID [必选，否则无法识别多个模态弹窗],
     *    hastitle: 是否显示标题栏，默认为true
     *    title: 模态弹窗标题
     *    html: 内容html，可带标签和样式，可用于表单提交之类的需求
     *    onshow: 显示时执行的函数
     *    onhide: 隐藏时执行的函数
     *    size: 对话框尺寸，按bootstrap的几个尺寸进行选择 sm lg，默认不给予尺寸样式
     *    button: 0 不显示按钮栏  1 只显示一个按钮（确定）  2 显示两个按钮（确定、取消） 默认为1
     *    btnText1: 按钮1文本
     *    btnText2: 按钮2文本
     *    lang: 语言 cn-中文 en-英文
     *    callback: 回调函数，确认框的确认按钮事件
     * }
     * =========================================
     * 例子：dialog.normal({
     *  id:"test",
     *  title:"text",
     *  html:"<h1>这是一个例子</h1>",
     *  button:2,
     *  btnText1:"提交",
     *  btnText2:"取消",
     *  lang:"cn"
     *  callback:function(){console.log("Submit success!");}
     * });
     * =========================================
     * */
    normal: function (options) {

        //语言包
        var langPack = {
            cn: {
                ok: "确定",
                cancel: "取消",
                title: "信息提示"
            },
            en: {
                ok: "Confirm",
                cancel: "Cancel",
                title: "Tips"
            }
        };
        options.lang = options.lang || "cn";
        var lp = langPack[options.lang];

        // 初始化参数变量
        options.id = options.id || "";
        options.hastitle = options.hastitle == undefined ? true : options.hastitle;
        options.title = options.title || "";
        options.html = options.html || lp.title + ": " + options.id;
        options.button = options.button || 0;
        options.size = options.size || "";
        options.btnText1 = options.btnText1 || lp.ok;
        options.btnText2 = options.btnText2 || lp.cancel;
        options.callback = options.callback || function () {
        };

        // 如果对象不存则创建对象
        if (!window["mymodal" + options.id]) {

            // 创建模态弹窗对象
            function _modal() {
                var _html = '<div class="modal" data-keyboard="false" data-backdrop="static" id="modal' + options.id + '" tabindex="-1" role="dialog" aria-describedby="modal-body' + options.id + '" aria-labelledby="myModalLabel' + options.id + '" aria-hidden="true">';
                _html += '<div class="modal-dialog modal-' + options.size + '">';
                _html += '<div class="modal-content">';
                if (options.hastitle) {
                    _html += '<div class="modal-header clearfix">';
                    _html += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-cancel"></i></button>';
                    _html += '<h4 class="modal-title" id="myModalLabel' + options.id + '">' + options.title + '</h4>';
                    _html += '</div>';
                }
                _html += '<div class="modal-body" id="modal-body' + options.id + '">';
                _html += options.html
                _html += '</div>';
                if (options.button != 0) {
                    _html += '<div class="modal-footer">';
                    if (options.button == 1) {
                        _html += '<button type="button" class="btn btn-default" id="modal' + options.id + '-btn1">' + options.btnText1 + '</button>';
                    }
                    else if (options.button == 2) {
                        _html += '<button type="button" class="btn btn-primary" id="modal' + options.id + '-btn1">' + options.btnText1 + '</button>';
                        _html += '<button type="button" class="btn btn-default" data-dismiss="modal">' + options.btnText2 + '</button>';
                    }
                    _html += '</div>';
                }
                _html += '</div></div></div>';
                $("body").append(_html);
            }

            // 绑定callback函数，主要是更新callback函数
            function bindCallback(callback) {
                // 绑定确认按钮事件
                if (options.button >= 1) {
                    $("#modal" + options.id + "-btn1").off("click").on("click", function () {
                        if (callback && typeof(callback) == "function") {
                            callback();
                        }
                        window["mymodal" + options.id].hide();
                    });
                }
            }

            // 模态弹窗显示
            // @content：提示内容，可包含html标签
            // @title：提示框标题，可选参数
            // @callback：回调函数，可选参数
            _modal.prototype.show = function (content, title, callback) {

                // 设置提示标题
                $("#myModalLabel" + options.id).html(title || options.title);

                // 设置提示内容
                $("#modal-body" + options.id).html(content || options.html);

                $("#modal" + options.id).modal("show");

                // 弹窗对象自己的Jquery对象
                _modal.prototype.self = $("#modal" + options.id);

                // 绑定callback函数
                bindCallback(callback || options.callback);

                // 显示后执行显示回调函数
                if (options.onshow) {
                    options.onshow();
                }
            }

            // 模态弹窗隐藏
            _modal.prototype.hide = function () {

                // 清空弹窗内容
                $("#modal-body" + options.id).html("");

                $("#modal" + options.id).modal("hide");

                // 隐藏后执行隐藏回调函数
                if (options.onhide) {
                    options.onhide();
                }
            }

            // 返回弹窗对象，jquery对象
            _modal.prototype.self = $("#modal" + options.id);

            // 模态弹窗存入全局变量
            window["mymodal" + options.id] = new _modal();
        }

        return window["mymodal" + options.id]

    },


    /*
     * dialog.alert 信息提示框
     * @msg: 提示信息内容
     * @type: 提示类型
     *         e - error 错误提示信息
     *         s - success 成功提示信息
     *         w - warning 警告提示信息
     *         对应的类型显示对应的提示图标，默认为普通提示，显示普通提示信息图标
     * @callback: 提示框确认按钮点击函数 [可选]
     * @lang: 语言 en-英文 cn-中文 [可选]
     * =========================================
     * */
    alert: function (msg, type, callback, lang) {
        //语言包
        var langPack = {
            cn: {
                title: "信息提示",
                title_error: "错误提示",
                title_success: "成功提示",
                title_warning: "警告提示"
            },
            en: {
                title: "Information",
                title_error: "Error",
                title_success: "Success",
                title_warning: "Warning"
            }
        };
        lang = lang || "cn";
        var lp = langPack[lang];

        var title = lp.title;
        var tipIco = " <i class='fa fa-info-circle fa-fw fsize-16 text-primary'></i> ";

        // 根据提示类型显示不同的提示标题和提示图标
        if (type) {
            switch (type) {
                case "e":
                    title = lp.title_error;
                    tipIco = " <i class='fa fa-close fa-fw text-danger'></i> ";
                    break;
                case "s":
                    title = lp.title_success;
                    tipIco = " <i class='fa fa-check-circle fa-fw text-success'></i> ";
                    break;
                case "w":
                    title = lp.title_warning;
                    tipIco = " <i class='fa fa-exclamation-triangle fa-fw text-warning'></i> ";
                    break;
                default:
                    tipIco = " <i class='fa fa-info fa-fw text-primary'></i> ";
                    break;
            }
        }

        var alertbox = this.normal({
            id: "-dialog-alert",
            button: 1,
            lang: lang
        });
        alertbox.show(msg, tipIco + title, callback);
        return alertbox;
    },

    /*
     * dialog.loading() 全屏遮挡loading状态
     * 参数：@msg loading提示语，默认为 正在处理···
     * =============================
     * */
    loading: function (msg) {
        var _msg = "<div class='center-block text-center fs24'><i class='icon-spin4 animate-spin fs24'></i> " + (msg || "loading···") + "</div>";

        var loadingBox = this.normal({
            id: "-dialog-loading",
            button: 0,
            size: "sm",
            hastitle: false
        });

        loadingBox.show(_msg);

        return loadingBox;
    }
};
