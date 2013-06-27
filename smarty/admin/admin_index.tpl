<section id="main" class="column">
    <article class="module width_full">
        <header><h3>网站信息统计</h3></header>
        <div class="module_content">
            <ul>
                <li>同学录登记人数：{$indexCountTotal}</li>
                <li>被禁止访问人数：{$indexCountBanned}</li>
                <li>待验证人数：{$indexCountUnverify}</li>
                <li>已验证人数：{"`$indexCountNormal+$indexCountAdmin`"}</li>
                <li>管理员人数：{$indexCountAdmin}</li>
            </ul>
            <div class="clear"></div>
        </div>
    </article>
</section>