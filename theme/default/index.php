/* 载入核心模板 */
{extend name="base" /}

/* 根据需求载入标题、关键字、描述 */
{/*block name="title"}{/block*/}
{/*block name="keywords"}{/block*/}
{/*block name="description"}{/block*/}

/* 根据需求载入css样式或者文件 */
{block name="style"}{/block}

/* 正文 */
{block name="body"}
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default hidden-xs">
            <div class="panel-heading">
                <div class="row">
                    <h5 class="pull-left col-xs-4"><i class="fa fa-diamond fa-fw"></i>本站推荐</h5>
                    <div class="col-md-6 col-xs-8 pull-right">
                        <form action="/search.php" target="_blank">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="请输入您需要搜索的关键字" id="bdcsMain" name="keyword">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search fa-fw"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="clear">
                    </div>
                </div>
            </div>
            <div class="panel-body">
                {volist name="hot" id="val"}
                <div class="col-md-3 col-xs-6 mb10 mt10">
                    <a class="thumbnail" href="{:baseUrl($val.book_url,'book')}" title="{$val.book}"><img src="{$val.image}" alt="{$val.book}" style="height:202px;">
                    <div class="caption">
                        <strong>{$val.book}</strong><br/><span class="text-muted fs-12">{$val.author} / 著</span>
                    </div>
                    </a>
                </div>
                {/volist}
                <div class="clear">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 pl0">
        <span class="visible-xs mb10">
            <form action="/search.php" target="_blank">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="请输入您需要搜索的关键字" id="bdcsMain" name="keyword">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="fa fa-search fa-fw"></i>
                        </button>
                    </span>
                </div>
            </form>
        </span>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab-weekvisit" role="tab" data-toggle="tab">本月热门</a></li>
        </ul>
        <div class="tab-content mt10">
            <div role="tabpanel" class="tab-pane active" id="tab-weekvisit">
                <ul class="list-group list-top">
                    {volist name="hotList" id="val"}
                    <li class="list-group-item">
                        <i class="topNum">{$i}</i>
                        <a href="{:baseUrl($val.book_url,'book')}" title="{$val.book}">{$val.book}</a>
                        <small class="text-muted">{$val.author}</small>
                    </li>
                    {/volist}
                </ul>
            </div>
        </div>
    </div>
    <div class="clear">
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h5 class="mg0"><i class="fa fa-history fa-fw"></i>最近更新</h5>
            </div>
            <table class="table">
                {volist name="newupdate" id="val"}
                <tr>
                    <td class="text-muted hidden-xs" width="10%">
                        {$val.cat}
                    </td>
                    <td>
                        <a href="{:baseUrl($val.book_url,'book')}" title="{$val.book}">{$val.book}</a>
                    </td>
                    <td class="hidden-xs">
                        <a href="{:baseUrl($val.show_url,'show')}" title="{$val.show}">{$val.show}</a>
                    </td>
                    <td class="text-muted fs-12" title="{$val.author}">
                        {$val.author}
                    </td>
                    <td class="fs-12">
                        {$val.time}
                    </td>
                </tr>
                {/volist}
            </table>
        </div>
    </div>
    <div class="col-md-4 pl0">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h5 class="mg0"><i class="fa fa-download fa-fw"></i>最新入库</h5>
            </div>
            <table class="table">
                {volist name="newlist" id="val"}
                 <tr>
                    <td class="text-muted">
                        {$val.cat}
                    </td>
                    <td>
                        <a href="{:baseUrl($val.book_url,'book')}" title="{$val.book}">{$val.book}</a>
                    </td>
                    <td class="text-muted fs-12" title="{$val.author}">
                        {$val.author}
                    </td>
                </tr>
                {/volist}
            </table>
        </div>
    </div>
    <div class="clear">
    </div>
</div>
<!-- 友情链接 -->
<div class="panel panel-default hidden-xs" style="margin-left: -15px;">
    <div class="panel-heading">
        <span class="text-muted"><i class="fa fa-link fa-fw"></i>友情链接</span>
    </div>

    <div class="panel-body panel-friendlink">
        {volist name="$config.link" id="val"}
        <a href="{$val[1]}" target="_blank">{$val[0]}</a>
        {/volist}
    </div>
</div>
{/block}

/* 根据需求载入js代码或者文件 */
{block name="script"}{/block}