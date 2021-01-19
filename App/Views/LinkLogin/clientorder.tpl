<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Order Page</title>
    <meta name="description" content="Yes please order your sandwiches">
    <link rel="stylesheet" href="/Static/css/style.css" type="text/css" />
</head>

<body>

<div id="ordercontainer">
    <h1>Welcome {$session['client_name']}</h1>

    <p>
        Please select the options you want for your sandwich.
    </p>


{if $session['order'] === false}
    <form method="post" class="form" action="/order/{$session['order_id']}/">
        {foreach from=$options item=option}
            <div class="form_row">
                <label for="{$option['type']}" class="orderlabel">{$option['type']}</label>
                {if $option['fieldtype'] === 'select'}
                <select name="{$option['type']}">
                    {foreach from=$option['options']|unserialize item=selectitem}
                        <option>{$selectitem}</option>
                    {/foreach}
                </select>
                {else}
                    {foreach from=$option['options']|unserialize item=selectitem}
                        <label style="margin-right: 10px;white-space: nowrap;"><input type="checkbox" name="{$option['type']}[{$selectitem}]"> {$selectitem} </label>
                    {/foreach}
                {/if}
            </div>
        {/foreach}
        <input type="submit" name="submit" value="Add sandwich to today's order" class="button">
    </form>
{else}
    Your order has been submitted! <a href="/order/{$session['order_id']}/new/">Click here to add another sandwich</a>
{/if}


<div style="margin-top:30px;">
    Overview of the last 10 sandwiches Ordered
</div>

{if $sandwiches}
    {foreach from=$sandwiches item=sandwich}
        <div class="clients">
            <div class="client_row" style="width:60%;">
                <ul>
                    {foreach from=$sandwich['options']|unserialize key=key item=option}
                        <li>{$key}: {$option}</li>
                    {/foreach}
                </ul>
            </div>
            {if $sandwich['status'] === 'open'}
                <div class="client_row" style="text-align: right;width:30%;"><a href="/order/{$session['order_id']}/edit/{$sandwich['id']}/">Edit Sandwich</a></div>
            {else}
                <div class="client_row" style="text-align: right;width:30%;">Closed</div>
            {/if}

        </div>
    {/foreach}
{else}
    <p>
        There have been no sandwich orders in the past.
    </p>
{/if}

</div>

</body>
</html>



