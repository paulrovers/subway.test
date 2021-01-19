<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<meta name="viewport"  charset="UTF-8" content="width=device-width, initial-scale=1">
		<title>{$title}</title>
		<meta name="robots" content="noindex,nofollow" />
		<meta name="description" content="{$description}">
		<meta property="og:title" content="{$title}">
		<link rel="canonical" href="{$pageurl}" />
        <link rel="stylesheet" href="/Static/css/sty.css" type="text/css" />
        <link rel="stylesheet" href="/Static/css/style.css" type="text/css" />
        <link rel="stylesheet" href="/Static/css/header.css" type="text/css" />
 {literal}
 <script>
 var siteUrl = "{/literal}{$admin_url}{literal}";
 </script>
 {/literal}
        <script src="/Static/js/jquery.js?{'H:m:s'|date}" type="text/javascript"></script>
        <script src="/Static/js/jquery.tools.min.js"></script>
		<script src="/Static/js/script.js" type="text/javascript"></script>
        <script src="/Static/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        <script src="/Static/js/jquery.scrollTo-min.js" type="text/javascript"></script>
        <script src="/Static/js/jquery.animate-colors-min.js" type="text/javascript"></script>
{literal}
        <style>
		
			.alert{
				margin: 30px 0 20px 0;
				padding: 20px;
			}
			
			.alert-warning{
				background-color:#ff6b63;
				border: 1px solid red;
				color:#fff;
			}

			.alert-success{
				background-color:#93ed99;
				border: 1px solid green;
				color:green;
			}

			.alert-info{
				background-color:#fff;
				border: 1px solid blue;
				color:#000;
			}
		
            #chooseSite div {
                padding:10px;
                border:1px solid #3B5998;
                background-color:#fff;
                font-family:"lucida grande",tahoma,verdana,arial,sans-serif;
                height: 278px;
            }

            #chooseSite h2 {
                margin:-11px;
                margin-bottom:0px;
                color:#fff;
                background-color:#ED7D2B;
                padding:12px 12px;
                border:1px solid #3B5998;
                font-size:20px;
            }
            .v_align{
                line-height: 24px;
                vertical-align: middle;
            }
            .logo{
                padding-top: 5px;
                font-size: 26px;
                text-decoration: none;
                font-family: Helvetica, sans-serif;
                font-stretch: expanded;
                font-style: italic;
            }

        </style>
{/literal}
	
    </head>
    <body>
   
        <div id="header">
            <div class="topbar">
                <div class="wrapper">
                    <a href="{$admin_url}" class="logo">SubwayTest</a>
                    <div id="loggedin">
                        <ol class="tb_menu2">
                          <li><a href="{$admin_url}" class="user_email">Orders</a>
                              <ol>
                                  <li><a href="{$admin_url}clients">Clients</a></li>
                                  <li><a href="{$admin_url}sandwichoptions/">Sandwich options</a></li>
                                  <li><a href="{$admin_url}account/">Account</a></li>
                                  <li><a href="{$admin_url}password/">Change password</a></li>
                              </ol>
                          </li>
                        </ol>
                        <!--<a href="{$admin_url}contact" title="Contact"><img src="/Static/images/menu/help.png" /></a>-->
                        <a href="{$admin_url}logout/" title="Uitloggen"><img src="/Static/images/menu/logout.png" /></a>
                    </div>
                </div>
            </div>

            <!--
            <div class="navbar">

                <div class="wrapper">
                    <div class="left_menu">
                        <ol class="nav">
                            <li><a href="{$admin_url}" title="Website Bewerken"><img src="/Static/images/menu/home.png"></a></li>
                            <li><a href="{$admin_url}settings/" title="Clients"><img src="/Static/images/menu/setting.png"></a></li>
							<li><a href="{$admin_url}linkpage/" title="Linkpages"><img src="/Static/images/menu/stat.png"></a></li>
                            <li><a href="{$admin_url}snippets/" title="Snippets"><img src="/Static/images/menu/disc.png"></a></li>
                            <li><a href="{$admin_url}forms/" title="Forms"><img src="/Static/images/menu/mail.png"></a></li>
                        </ol>
                    </div>
                </div>
            </div>
            -->

        </div><!-- header end-->

        <div id="container">	
            <div id="middle">

				{if !empty($smarty.session.flash_notifications)}
					{foreach from=$smarty.session.flash_notifications key=myId item=i}
					<div class="alert alert-{$i.type}">
						{$i.body}
					</div>
					{/foreach}
				{/if}

               {$buffered_content}

                </div>
            </div> <!-- middle end -->   
            <div id="footer">
				<div class="wrapper footer"> Copyright &copy; {'Y'|date} SubwayTest.</div>
            </div>
        </div>
		
		<div id="pagesettings" class="overlay">    
            <div class="contentWrap"></div>    
        </div>
		
   </body>
</html>
