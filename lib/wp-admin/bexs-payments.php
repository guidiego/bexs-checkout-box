<?php

function bcbCreateTable()
{
    global $wpdb;
    $dbName = $wpdb->prefix . 'bexs_payments';

    if (!empty($wpdb->charset))
            $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";

    if (!empty($wpdb->collate))
        $charset_collate .= " COLLATE $wpdb->collate";

    $dbQuery = "CREATE TABLE " . $dbName . " (
        `id` int(10) NOT NULL AUTO_INCREMENT,
        `bexs_id` varchar(100) NOT NULL,
        `name` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `last_cc_number` int(10) NOT NULL,
        `exp_date` varchar(10) NOT NULL,
        `value` varchar(25) NOT NULL,
        `installments` int(10) NOT NULL,
        `tmstp` DATETIME NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . "/wp-admin/includes/upgrade.php");
    dbDelta($dbQuery);
}

function bcbDropTable()
{
    global $wpdb;
    $dbName = $wpdb->prefix . 'bexs_payments';
    $dbQuery = "DROP TABLE " . $dbName . ";";
    $wpdb->query($dbQuery);
}

function bcbInsertPaymentRegister($payment, $bexsId)
{
    global $wpdb;
    $dbName = $wpdb->prefix . 'bexs_payments';
    $wpdb->insert($dbName, [
        'name' => $payment['ccname'],
        'email' => $payment['email'],
        'bexs_id' => $bexsId,
        'last_cc_number' => (int) substr($payment['cardnumber'], strlen($payment['cardnumber']) - 4, 4),
        'exp_date' => $payment['cc-exp'],
        'value' => $payment['value'],
        'installments' => (int) $payment['installments'],
        'tmstp' => (new DateTime('NOW'))->format('Y-m-d H:i:s'),
    ]);

    return $wpdb->insert_id;
}

function bexsPaymentPage()
{
    global $wpdb;
    $dbName = $wpdb->prefix . 'bexs_payments';
    $pageLimit = 20;
    $pageSkip = 0;
    $dbQuery = "SELECT * FROM $dbName SKIP $pageSkip LIMIT $pageLimit";
    $rows = $wpdb->get_results($dbQuery);

    ?>
    <div>
        <h2> Aaaa </h2>
        <?php print_r($rows) ?>
    </div>
    <?php
}

// function getPayments()
// {
//     $dbName = $wpdb->prefix . 'bexs_payments';
// }