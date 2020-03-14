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
<div class="panel panel-default">
    <div class="panel-heading"><h1 class="fs-18 mg0"><strong>搜索结果</strong></h1></div>
    <table class="table">
        <tr align="center">
            <th width="20%">文章名称</th>
            <th width="40%" class="hidden-xs">最新章节</th>
            <th width="15%">作者</th>
            <th width="9%" class="hidden-xs">字数</th>
            <th width="10%" class="hidden-xs">更新</th>
            <th width="6%">状态</th>
        </tr>
        {volist name="search" id="val"}
        <tr>
            <td class="odd"><a href="{:baseUrl($val.book_url,'book')}">{$val.book}</a></td>
            <td class="hidden-xs"><a href="{:baseUrl($val.show_url,'show')}" target="_blank"> {$val.show}</a></td>
            <td class="odd">{$val.author}</td>
            <td class="hidden-xs">{$val.number}</td>
            <td class="hidden-xs">{$val.time}</td>
            <td class="even">{$val.type}</td>
        </tr>
        {/volist}
    </table>
</div>
<ul class="pagination" id="pagelink">
    {volist name="pages" id="val"}
        {if condition="$val.title_url"}<li><a href="{:baseUrl($val.title_url,'cat',1)}">{$val.title|raw}</a></li>{else}<li class="active"><span>{$val.now|raw}</span></li>{/if}
    {/volist}
</ul>
{/block}

/* 根据需求载入js代码或者文件 */
{block name="script"}{/block}