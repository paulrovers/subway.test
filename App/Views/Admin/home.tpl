<h1>Orders</h1>

<p>
    Create a new order by clicking on the button "Start a new order".<br>
    All registered users will get an email to notify them about the new order with the order link. <br>
    <br>
</p>

{if $openorder === 'closed'}
    <div class="button" style="overflow:hidden;">
        <a href="new" class="button">Start new order</a>
    </div>
{/if}

<h3>Order list</h3>

{if $orders}
    {foreach from=$orders item=order}
        <div class="clients">
            <div style="display:inline-block;min-width:40px;"><a href="/inloggen/orderdetails/{$order['id']}/">{$order['id']}</a></div>
            <div class="client_row">{$order['date']}</div>
            <div class="client_row">{$order['status']}</div>
            <div class="client_row">
                {if $order['status'] === 'open'}
                    <a href="/inloggen/orderdetails/{$order['id']}/">details</a>  |   <a href="close/{$order['id']}/" class="greenlink">close</a>
                {else}
                    <a href="/inloggen/orderdetails/{$order['id']}/">details</a>
                {/if}
            </div>
        </div>
    {/foreach}
{else}
    <p>
        There are no orders to show
    </p>
{/if}