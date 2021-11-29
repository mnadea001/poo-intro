<?php

declare(strict_types=1);

require '../src/PaymentGateway/Paypal/Transaction.php';
require '../src/PaymentGateway/Stripe/Transaction.php';

const BLACK_FRIDAY = 30;

use PaymentGateway\Paypal\Transaction as Paypal;
use PaymentGateway\Stripe\Transaction as Stripe;

$paypal = new Paypal(109, 'Transaction Paypal');
$stripe = new Stripe(149, 'Transaction Stripe');
$paypal->applyDiscount(BLACK_FRIDAY);
$stripe->applyDiscount(BLACK_FRIDAY);

    echo '<pre>';
    var_dump($paypal);

    var_dump($stripe);
    echo '</pre>';