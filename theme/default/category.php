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
<div class="row">
    {if condition="$sidebar"}
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-fire fa-fw"></i>热门推荐  </div>
            <div class="list-group list-top">
                {volist name="sidebar" id="val"}
                <li class="list-group-item">
                    <i class="topNum">{$i}</i>
                    <a href="{:baseUrl($val.book_url,'book')}" title="{$val.book}">{$val.book}</a>
                    <small class="text-muted">{$val.author}</small>
                </li>
                {/volist}
            </div>
        </div>
    </div>
    <div class="col-md-8">
    {else /}
    <div class="col-md-12">
    {/if}
        <div class="panel panel-default">
            <div class="panel-heading"><h1 class="fs-16 mg0"><i class="fa fa-list fa-fw"></i>最新更新</h1></div>
            <table class="table">
                <tbody><tr>
                    <th>书名</th>
                    <th class="hidden-xs">最新章节</th>
                    <th>作者</th>
                    <th class="hidden-xs">更新时间</th>
                    <th>连载状态</th>
                </tr>
                {volist name="main" id="val"}
                <tr>
                    <td><a href="{:baseUrl($val.book_url,'book')}" title="{$val.book}" target="_blank">{$val.book}</a></td>
                    <td class="hidden-xs"><a class="text-muted" href="{:baseUrl($val.show_url,'show')}" target="_blank">{$val.show}</a></td>
                    <td class="text-muted">{$val.author}</td>
                    <td class="hidden-xs">{$val.time}</td>
                    <td>{if condition="$val.type"}{$val.type}{else}已完本{/if}</td>
                </tr>
                {/volist}
            </tbody>
        </table>
        </div>
        <ul class="pagination" id="pagelink">
            {volist name="pages" id="val"}
                {if condition="$val.title_url"}<li><a href="{:baseUrl($val.title_url,'cat',1)}">{$val.title|raw}</a></li>{else}<li class="active"><span>{$val.now|raw}</span></li>{/if}
            {/volist}
        </ul>
    </div>
</div>
{/block}

/* 根据需求载入js代码或者文件 */
{block name="script"}{/block}