<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fees</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
    <p class="tgju" style="display:none">
        <?php echo file_get_contents('https://tgju.org'); ?>
    </p>
    <p class="ons"></p>

</body>

</html>

<script>
    $(document).ready(function() {
        setInterval(function() {
            ons_gold = $('#l-ons .info-price').text();
            usd = $('#l-price_dollar_rl .info-price').text();
            silver = $("tr[data-market-row='silver'] .nf:first").text();
            dinar = $("tr[data-market-row='price_iqd'] .nf:first").text();
            copper = $("tr[data-market-row='general_7'] .nf:first").text();

            $.ajax({
                url: 'http://waleto.ir/parseh/server.php',
                type: 'POST',
                data: 'ons_gold=' + ons_gold + '&usd=' + usd + '&silver=' + silver + '&dinar=' + dinar + '&copper=' + copper,
            });
        }, 10000);
    //$("body").hide();
    
        
    });
</script>