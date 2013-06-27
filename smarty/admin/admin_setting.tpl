<section id="main" class="column">
    {if $status == "success"}
        <h4 class="alert_success">全局设置已成功修改。</h4>
    {/if}
    <article class="module width_full">
        <header><h3>全局设置</h3></header>
        <div class="module_content">
            <fieldset>
                <label>站点标题（6字以内）</label>
                <input type="text" id="siteTitle" maxlength="6" value="{$settingTitle}">
            </fieldset>
            <fieldset>
                <label>站点副标题（50字以内）</label>
                <input type="text" id="siteSubtitle" maxlength="50" value="{$settingSubtitle}">
            </fieldset>
            <fieldset>
                <label>首页宣传文字</label>
                <textarea rows="12" id="siteIndexWriting">{$settingIndexWriting}</textarea>
            </fieldset>
            <div class="clear"></div>
        </div>
        <footer>
            <div class="submit_link">
                <input type="button" value="提交更改" class="alt_btn" onclick="submitSetting()">
            </div>
        </footer>
    </article>
</section>