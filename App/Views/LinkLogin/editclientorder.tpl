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
        Here you can edit the ordered sandwich.
    </p>

    <form method="post" class="form" action="/order/{$session['order_id']}/edit/{$sandwich['id']}/">

         {foreach from=$options item=option}
             <div class="form_row">
                 <label for="{$option['type']}" class="orderlabel">{$option['type']}</label>
                 {if $option['fieldtype'] === 'select'}
                 <select name="{$option['type']}">
                      {foreach from=$option['options'] item=selectitem}
                          <option{if $selectitem[1] === 1} selected{/if}>{$selectitem[0]}</option>
                      {/foreach}
                  </select>
                  {else}
                      {foreach from=$option['options'] item=selectitem}
                          <label style="margin-right: 10px;white-space: nowrap;">
                              <input type="checkbox"{if $selectitem[1] === 1} checked{/if} name="{$option['type']}[{$selectitem[0]}]">
                              {$selectitem[0]}
                          </label>
                      {/foreach}
                  {/if}
              </div>
          {/foreach}

         <input type="submit" name="submit" value="Edit sandwich for today's order" class="button">
     </form>

</div>

</body>
</html>



