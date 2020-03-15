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
    <li><a href="{$config.website}"><i class="fa fa-home fa-fw"></i>首页</a></li>
    <li><a href="{:baseUrl($content.catgory_url,'cat',1)}" target="_blank" title="{$content.catgory}">{$content.catgory}</a></li>
    <li><a href="{:baseUrl($content.book_url,'book')}">{$content.book}</a></li>
    <li class="active">{$content.title}</li>
    <span class="pull-right">
        <select id="bcolor" onchange="changeBackoundColor()">            
                <option style="background-color: #E9FAFF" value="#E9FAFF">底色</option>
                <option style="background-color: #E9FAFF" value="#E9FAFF">默认</option>              
                <option style="background-color: #ffffff" value="#ffffff">白色</option>              
                <option style="background-color: #e3e8f7" value="#e3e8f7">淡蓝</option>            
                <option style="background-color: #daebfc" value="#daebfc">蓝色</option>              
                <option style="background-color: #ebeaea" value="#ebeaea">淡灰</option>              
                <option style="background-color: #e7e3e6" value="#e7e3e6">灰色</option>              
                <option style="background-color: #dedcd8" value="#dedcd8">深灰</option>              
                <option style="background-color: #d8d7d7" value="#d8d7d7">暗灰</option>              
                <option style="background-color: #e6fae4" value="#e6fae4">绿色</option>              
                <option style="background-color: #f9fbdd" value="#f9fbdd">明黄</option>                   
            </select>             
            <select id="txtcolor" onchange="changeFontColor()">              
                <option value="">字色</option>      
                <option value="#000000">黑色</option>              
                <option value="#ff0000">红色</option>              
                <option value="#006600">绿色</option>              
                <option value="#0000ff">蓝色</option>              
                <option value="#660000">棕色</option>            
            </select>              
            <select id="fonttype" onchange="changeFontSize()">       
                <option value="24px">字号</option>      
                <option value="16px">小号</option>            
                <option value="18px">中号</option>            
                <option value="24px">大号</option>            
                <option value="32px">特大</option>            
            </select>
    </span>
</ol>
<div class="panel panel-default panel-readcontent" id="content" style="background-color: rgb(233, 250, 255);">
    <div class="page-header text-center">
        <h1 class="readTitle">{$content.title}</h1>
    </div>
    <div class="panel-body" id="htmlContent" style="font-size: 24px;">
        {:strReplace($content.html)}
        <p class="text-center readPager">
            <a id="linkPrev" class="btn btn-default" href="{$page.prev_url}"><i class="fa fa-arrow-circle-left fa-fw"></i>{$page.prev}</a>
            <a id="linkIndex" class="btn btn-default" href="{:baseUrl($page.chapter_url,'book')}"><i class="fa fa-list fa-fw"></i>{$page.chapter}</a>
            <a id="linkNext" class="btn btn-default" href="{:baseUrl($page.next_url,'show')}">{$page.next}<i class="fa fa-arrow-circle-right fa-fw"></i></a>
        </p>
    </div>
</div>
{/block}

/* 根据需求载入js代码或者文件 */
{block name="script"}
    <script src="{__JS__}show.js"></script>
{/block}