<div  class="line-under-nav" ></div>
<div class="subpage">

<section>

        <div class="container-lg-pages">

            <h1 id="page-title">Login</h1>
	 		
			{if !empty($smarty.session.flash_notifications)}
				{foreach from=$smarty.session.flash_notifications key=myId item=i}
				<div class="alert alert-{$i.type}">
					{$i.body}
				</div>
				{/foreach}
			{/if}
			
			<form method="post" action="/inloggen/">

				<div>
					<label style="display: inline-block;width:100px;" for="inputEmail">Email</label>
					<input type="email" name="email" id="inputEmail" value="{$email}" placeholder="E-mail" autocomplete="username" required autofocus aria-required="true" aria-invalid="true" />
				</div>
				<div>
					<label style="display: inline-block;width:100px;" for="inputPassword">Password</label>
					<input type="password" id="inputPassword" name="password" required autocomplete="current-password" placeholder="Password" aria-required="true" aria-invalid="true" />
				</div>

				<button type="submit">Login</button>

			</form>


			<br><br>

            <div style="margin-top:50px;width: 1160px;opacity: 0.5;"></div><hr>
        </div>
  
</section>



</div>
