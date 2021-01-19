<h1>Clients</h1>

<p>
    Overview of all clients that can order sandwiches in the subwaytest.
</p>

{if $clients}
    {foreach from=$clients item=client}
        <div class="clients">
            <div class="client_row">{$client['name']}</div>
            <div class="client_row">{$client['email']}</div>
            <div class="client_row"><a href="delete/{$client['id']}/">Delete Client</a></div>
        </div>
    {/foreach}
{else}
    <p>
        There are no clients to show
    </p>
{/if}

<form action="" method="post">
    <div class="form_row">
        <label>Name</label>
        <input type="text" name="name" value="">
    </div>
    <div class="form_row">
        <label>E-mail</label>
        <input type="text" name="email" value="">
    </div>
    <div class="form_row">
        <input type="submit" name="submit" value="Add new client" class="button">
    </div>
</form>
