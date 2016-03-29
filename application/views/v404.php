<!-- light-blue - v3.2.0 - 2015-10-05 -->

<!DOCTYPE html>
<html>
<head>
    <title>Page not found</title>

        <link href="<?php echo base_url() ?>assets/white/css/application.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8">
    <script>
        /* yeah we need this empty stylesheet here. It's cool chrome & chromium fix
           chrome fix https://code.google.com/p/chromium/issues/detail?id=167083
                      https://code.google.com/p/chromium/issues/detail?id=332189
        */
    </script>
</head>
<body class="background-dark">
        <div class="error-page container">
            <main id="content" class="error-container" role="main">
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-xs-10 col-lg-offset-4 col-sm-offset-3 col-xs-offset-1">
                        <div class="error-container">
                            <h1 class="error-code">404</h1>
                            <p class="error-info">
                                Opps, it seems that this page does not exist.
                            </p>
                            <p class="error-help mb">
                                If you are sure it should, search for it.
                            </p>
                           <!-- <div class="form-group">
                                <input class="form-control" type="text" placeholder="Search Pages">
                            </div>
                            <a href="special_search.html" class="btn btn-default">
                                Search <i class="fa fa-search text-warning ml-xs"></i>
                            </a>
                        </div>-->
                    </div>
                </div>
            </main>

            <footer class="page-footer">
                2015 &copy; Midnight Arts
            </footer>
        </div>
<!-- common libraries. required for every page-->
<script src="<?php echo base_url() ?>assets/white/lib/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/white/lib/jquery-pjax/jquery.pjax.js"></script>
<script src="<?php echo base_url() ?>assets/white/lib/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/white/lib/widgster/widgster.js"></script>
<script src="<?php echo base_url() ?>assets/white/lib/underscore/underscore.js"></script>

<!-- common application js -->
<script src="<?php echo base_url() ?>assets/white/js/app.js"></script>
<script src="<?php echo base_url() ?>assets/white/js/settings.js"></script>

<!-- common templates -->
<script type="text/template" id="settings-template">
    <div class="setting clearfix">
        <div>Background</div>
        <div id="background-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% dark = background == 'dark'; light = background == 'light';%>
            <button type="button" data-value="dark" class="btn btn-sm btn-default <%= dark? 'active' : '' %>">Dark</button>
            <button type="button" data-value="light" class="btn btn-sm btn-default <%= light? 'active' : '' %>">Light</button>
        </div>
    </div>
    <div class="setting clearfix">
        <div>Sidebar on the</div>
        <div id="sidebar-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% onRight = sidebar == 'right'%>
            <button type="button" data-value="left" class="btn btn-sm btn-default <%= onRight? '' : 'active' %>">Left</button>
            <button type="button" data-value="right" class="btn btn-sm btn-default <%= onRight? 'active' : '' %>">Right</button>
        </div>
    </div>
    <div class="setting clearfix">
        <div>Sidebar</div>
        <div id="display-sidebar-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% display = displaySidebar%>
            <button type="button" data-value="true" class="btn btn-sm btn-default <%= display? 'active' : '' %>">Show</button>
            <button type="button" data-value="false" class="btn btn-sm btn-default <%= display? '' : 'active' %>">Hide</button>
        </div>
    </div>
    <div class="setting clearfix">
        <div>White Version</div>
        <div>
            <a href="http://demo.flatlogic.com/3.2/transparent/index.html" class="btn btn-sm btn-default">&nbsp; Switch &nbsp;   <i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</script>

<script type="text/template" id="sidebar-settings-template">
    <% auto = sidebarState == 'auto'%>
    <% if (auto) {%>
    <button type="button"
            data-value="icons"
            class="btn-icons btn btn-transparent btn-sm">Icons</button>
    <button type="button"
            data-value="auto"
            class="btn-auto btn btn-transparent btn-sm">Auto</button>
    <%} else {%>
    <button type="button"
            data-value="auto"
            class="btn btn-transparent btn-sm">Auto</button>
    <% } %>
</script>

    <!-- page specific scripts -->


</body>
</html>