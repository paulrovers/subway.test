<h1>Order details</h1>

<p>
    <a href="/inloggen/home/">Back to overview</a>
    <br><br>
    Order details for order nr: {$order['id']}
</p>

{if $sandwiches}
    {foreach from=$sandwiches item=sandwich}
        <div class="clients">
            <div class="">Ordered by : <a href="mailto:{$sandwich['email']}">{$sandwich['name']}</a></div>
            <div style="margin-left:20px;margin-top:5px;">
                <ul>
                {foreach from=$sandwich['options']|unserialize key=key item=option}
                    <li>{$key}: {$option}</li>
                {/foreach}
                </ul>
            </div>
            <div style="margin-top:5px;">
                {if $order['status'] === 'open'}<a href="delete/{$sandwich['id']}/">Delete Sandwich</a>{/if}
            </div>
        </div>
    {/foreach}
{else}
    <p>
        There are no sandwiches in this order yet
    </p>
{/if}