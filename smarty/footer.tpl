        <hr />
        <div class="container"> 
            <div class="span12">
                <p id="footer_content">Copyright © 2013 448CLASS.COM.<br />All Rights Reserved. </p>
            </div>
        </div>
        <div id="modal"></div>
        <script type="text/javascript">
            $.ajax({
               type: "GET",
               url: "smarty/modal.html",
               dataType: "html",
               async: false,
               cache: false,
               success: function(info) {
                   $("#modal").html(info);
                   makeValidation();
               }
            });
        </script>
    </body>
</html>