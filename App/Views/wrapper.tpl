<!DOCTYPE html>
<html>

<head>
<meta name="viewport"  charset="UTF-8" content="width=device-width, initial-scale=1">
<title>{$title}</title>
<meta name="robots" content="noindex,nofollow" />
<meta name="description" content="{$description}">
<meta property="og:title" content="{$title}">
<link rel="canonical" href="{$pageurl}" />

{literal}
<style>
.wrapper{
max-width:980px;
width:100%;
margin:0 auto;
}
nav .menu{
margin:0;
padding:0;
}
ul{
margin:0;
padding:0;
}
li{
listy-style:none;
}
nav .menu li{
position:relative;
display:inline-block;
listy-style:none;
}
nav .menu a{
text-decoration:none;
padding:10px;
color:#fff;
display:block;
}
header{
background:#222;
}
.main{
margin:20px 0;
}
.footer ul li{
list-style:none;
}
</style>
{/literal}
</head>

<body>

<div class="wrapper">

<header>
<nav>
     <ul class="menu">
        <li class="top-menu">
            <ul>
                <li><a href="{$site_url}">Home</a></li>
                <li><a href="{$site_url}inloggen/">Login</a></li>
            </ul>
        </li>
    </ul>
</nav>
</header>


<div class="main">
			
    {$buffered_content}

</div>



<footer>
    <div class="footer">
        <p> &#xA9; {'Y'|date} subway test</p>
    </div>
</footer>

</div>

</body>
</html>