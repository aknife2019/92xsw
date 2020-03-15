/* 载入核心模板 */
{extend name="base" /}

/* 根据需求载入标题、关键字、描述 */
{if condition="$seo.title"}
{block name="title"}{$seo.title}{/block}
{block name="keywords"}{$seo.keywords}{/block}
{block name="description"}{$seo.description}{/block}
{/if}

/* 根据需求载入css样式或者文件 */
{block name="style"}{/block}

/* 正文 */
{block name="body"}
<ol class="breadcrumb hidden-xs">
    <li><a href="{$config.website}" title="千千小说网"><i class="fa fa-home fa-fw"></i>首页</a></li>
    <li class="active">{$info.category}</li>
    <li class="active">{$info.title}</li>
</ol>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-2 col-xs-4 hidden-xs"><img class="img-thumbnail" alt="{$info.title}" src="{$info.img}" title="{$info.title}" width="140" height="180"></div>
            <div class="col-md-10">
                <h1 class="bookTitle">{$info.title}</h1>
                <p class="booktag">
                    <span class="red">{$info.author}</span>
                    <span class="red">{$info.category}</span>
                    <span class="blue">{$info.number}</span>
                    <span class="blue">{$info.type}</span>
                </p>
                <p>
                    最新章节：<a href="{:baseUrl($info.newchapter_url,'show',0,$url.'/')}" title="{$info.newchapter}">{$info.newchapter}</a><span class="hidden-xs"></span>
                </p>
                <p class="visible-xs">更新时间：{:strReplace($info.time)}</p>
                <hr>
                <p class="text-muted" id="bookIntro" style="">
                    {$info.desc|raw}
                </p>

            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="panel panel-danger">
    <div class="panel-heading"><i class="fa fa-history fa-fw"></i><strong>《{$info.title}》最新章节</strong></div>
    <dl class="panel-body panel-chapterlist">
        {volist name="newchapter" id="val"}
        <dd class="col-md-4">
            <a class="blue" href="{:baseUrl($val.show_url,'show',0,$url.'/')}">{$val.show}</a>
        </dd>
        {/volist}
    </dl>
</div>
<div class="panel panel-default" id="list-chapterAll">
    <div class="panel-heading"><i class="fa fa-list fa-fw"></i><strong>《{$info.title}》全部章节目录</strong></div>
    <dl class="panel-body panel-chapterlist">
        <dt class="col-md-12"><i class="fa fa-bookmark fa-fw"></i>正文卷</dt>
        {volist name="chapter" id="val"}
        <dd class="col-md-3">
            <a class="blue" href="{:baseUrl($val.show_url,'show',0,$url.'/')}">{$val.show}</a>
        </dd>
        {/volist}
        <div class="clear"></div>
    </dl>
</div>
{/block}

/* 根据需求载入js代码或者文件 */
{block name="script"}{/block}