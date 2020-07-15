<?php

add_filter( 'query_vars', 'bcb_query_params' );
function bcb_query_params( $vars )
{
    $vars[] = "bcbPage";
    $vars[] = "bcbQ";
    return $vars;
}

function bcbCreateTable()
{
    global $wpdb;
    $dbName = $wpdb->prefix . 'bexs_payments';

    if (!empty($wpdb->charset))
            $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";

    if (!empty($wpdb->collate))
        $charset_collate .= " COLLATE $wpdb->collate";

    // status - > 0 (waiting) / 1 (success) / 2 (error)
    $dbQuery = "CREATE TABLE " . $dbName . " (
        `id` int(10) NOT NULL AUTO_INCREMENT,
        `bexs_id` varchar(100),
        `bexs_tax` varchar(25),
        `brl_value` varchar(25),
        `contract_id` varchar(255),
        `installments` int,
        `foreign_value` varchar(25),
        `name` varchar(255),
        `email` varchar(255),
        `national_id` varchar(255),
        `status` int,
        `tmstp` DATETIME,
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

function bcbInsertPaymentRegister($payment)
{
    global $wpdb;
    $dbName = $wpdb->prefix . 'bexs_payments';
    $wpdb->insert($dbName, [
        'name' => $payment['name'],
        'email' => $payment['email'],
        'national_id' => $payment['national-id'],
        'installments' => (int) $payment['installments'],
        'contract_id' => $payment['contract_id'],
        'status' => 0,
        'tmstp' => (new DateTime('NOW'))->format('Y-m-d H:i:s'),
    ]);

    return $wpdb->insert_id;
}

function bcbUpdatePaymentRegister($id, $bexs) {
    global $wpdb;
    $dbName = $wpdb->prefix . 'bexs_payments';
    $wpdb->update($dbName, [
        'bexs_id' => $bexs['id'],
        'bexs_tax' => number_format($bexs['amount_info']['financial_tax'], 2, '.', ''),
        'brl_value' => number_format($bexs['amount_info']['gross_amount'], 2, '.', ''),
        'foreign_value' => $bexs['amount_info']['foreign_gross_amount'],
    ], ['id' => $id]);
}

function bcbCompletePayment($id, $status) {
    global $wpdb;
    $dbName = $wpdb->prefix . 'bexs_payments';
    $wpdb->update($dbName, [ 'status' => $status], ['id' => $id]);
}


function bexsPaymentPage()
{
    global $wpdb;
    global $wp;

    $dbName = $wpdb->prefix . 'bexs_payments';
    $p = array_key_exists('p', $_GET) ? (int) $_GET['p'] : 1;
    $pageLimit = 15;
    $pageSkip = $pageLimit * ($p - 1);
    $q = [];

    $qst = "";
    if (array_key_exists('qst', $_GET)) {
        $qst = $_GET['qst'];
        $q[] = "status = $qst";
    }

    $qctrc = "";
    if (array_key_exists('qctrc', $_GET)) {
        $qctrc = $_GET['qctrc'];
        $q[] = "contract_id = '$qctrc'";
    }

    $qstr = "";
    if (array_key_exists('qstr', $_GET)) {
        $qstr = $_GET['qstr'];
        $qint = [];
        $qint[] = "name LIKE '%$qstr%'";
        $qint[] = "email LIKE '%$qstr%'";
        $qint[] = "national_id LIKE '%$qstr%'";
        $q[] = "( " . join(' OR ', $qint) . " )";
    }

    $qid = "";
    $dbQuery = "SELECT * FROM $dbName";
    $countQuery = "SELECT count(*) FROM $dbName";
    $completeQuery = "";
    $q1 = join(" AND ", $q);

    if (array_key_exists('qid', $_GET)) {
        $qid = $_GET['qid'];
        $intQid = (int) $qid;
        $q2 = "(id = $intQid" . ($q1 != "" ? " AND $q1" : "") . ")";
        $q1 = "(bexs_id = '$qid'" . ($q1 != "" ? " AND $q1" : "") . ")";
        $q1 .= " OR $q2";
    }

    if ($q1 != "") {
        $completeQuery .= ' WHERE ' . $q1;
    }

    $count = $wpdb->get_var($countQuery . $completeQuery);
    $completeQuery .= " LIMIT $pageSkip, $pageLimit;";
    $pages = range(1, ceil($count / $pageLimit));

    $rows = $wpdb->get_results($dbQuery . $completeQuery);

    ?>
        <style>
            .bcb-title h1{
                padding: 40px 10px 10px;
                margin: 0;
            }

            .bcb-table {
                box-shadow: 0px 2px 1px -1px rgba(0,0,0,0.2), 0px 1px 1px 0px rgba(0,0,0,0.14), 0px 1px 3px 0px rgba(0,0,0,0.12);
                color: rgba(0, 0, 0, 0.87);
                background-color: #fff;
                border-radius: 4px;
                margin-top: 20px;
                border-spacing: 0;
                border-collapse: collapse;
                width: 98%;
            }

            .bcb-table-wrap {
                width: 100%;
                overflow-x: scroll;
                padding: 0 0 20px;
            }

            .bcb-table tr {
                border-bottom: 1px solid rgba(125, 125, 125, .4);
            }

            .bcb-table tbody tr {
                border-bottom: 1px solid rgba(125, 125, 125, .2);
            }

            .bcb-table th,
            .bcb-table td {
                padding: 10px 20px;
                text-align: center;
                white-space: nowrap;
            }

            .bcb-pagination {
                display: block;
                margin: 20px auto;
                text-align: center;
                cursor: pointer;
            }

            .bcb-pagination .bcb-page-item {
                display: inline-block;
                margin: 0 5px;
                padding: 5px 12px;
                border-radius: 5px;
                background: #FFF;
                box-shadow: 0 0.5em 1em -0.125em rgba(10,10,10,.1), 0 0 0 1px rgba(10,10,10,.02);
            }

            .bcb-filter-box {
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 0.5em 1em -0.125em rgba(10,10,10,.1), 0 0 0 1px rgba(10,10,10,.02);
                color: #4a4a4a;
                display: block;
                padding: 1.25rem;
                width: 98%;
                margin: 20px 0;
                max-width: 700px;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .bcb-filter-box input,
            .bcb-filter-box button {
                padding: 5px;
                max-height: 30px;
            }

            .bcb-wait {
                color: #ffb200;
            }

            .bcb-ok {
                color: #39ad0b;
            }

            .bcb-err {
                color: #bd0707;
            }
        </style>
    <?php if (count($rows) == 0) { ?>
        <div class="bcb-title">
            <h1>No payments registered</h1>
        </div>
    <?php } else { ?>
        <div class="bcb-title">
            <h1>Payment History <small>(<?= $count ?> payments)</small></h1>
        </div>
    <?php } ?>
        <div class="bcb-filter-box">
            <input placeholder="Consumer Data" name="bcbHistoryFilter-qstr" value="<?= $qstr ?>" />
            <input placeholder="IDs" name="bcbHistoryFilter-qid" value="<?= $qid ?>"/>
            <input placeholder="Contract" name="bcbHistoryFilter-qctrc" value="<?= $qctrc ?>"/>
            <select name="bcbHistoryFilter-qst">
                <option value=""> All </option>
                <option value="0" <?php if ($qst == '0') { ?> selected <?php } ?>> Waiting </option>
                <option value="1" <?php if ($qst == '1') { ?> selected <?php } ?> > Success </option>
                <option value="2" <?php if ($qst == '2') { ?> selected <?php } ?>> Fail </option>
            </select>
            <button type="button" id="bcbPerformSearch">
                Search
            </button>
            <button type="button" id="bcbPerformClear">
                Clear
            </button>
        </div>
    <?php if (count($rows) != 0) { ?>
        <div class="bcb-table-wrap">
            <table class="bcb-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Contract ID</th>
                        <th>Timestamp</th>
                        <th>BexsID</th>
                        <th><?= bcb_get_api_prop('coin_kind') ?></th>
                        <th>RS</th>
                        <th>Bexs Tax</th>
                        <th>X</th>
                        <th>Consumer Email</th>
                        <th>Consumer Name</th>
                        <th>National ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rows as $payment) { ?>
                        <tr>
                            <td>
                                <?php
                                    if ($payment->status == 0) {
                                        echo '<span class="bcb-wait dashicons dashicons-clock"></span>';
                                    }

                                    if ($payment->status == 1) {
                                        echo '<span class="bcb-ok dashicons dashicons-yes"></span>';
                                    }

                                    if ($payment->status == 2) {
                                        echo '<span class="bcb-err dashicons dashicons-no"></span>';
                                    }
                                ?>
                            </td>
                            <td><?= $payment->id ?></td>
                            <td><?= $payment->contract_id ?></td>
                            <td><?= $payment->tmstp ?></td>
                            <td><?= $payment->bexs_id == null ? '---' : $payment->bexs_id  ?></td>
                            <td><?= $payment->foreign_value == null ? '---' : $payment->foreign_value  ?></td>
                            <td><?= $payment->brl_value == null ? '---' : $payment->brl_value  ?></td>
                            <td><?= $payment->bexs_tax == null ? '---' : $payment->bexs_tax  ?></td>
                            <td><?= $payment->installments ?></td>
                            <td><?= $payment->email ?></td>
                            <td><?= $payment->name ?></td>
                            <td><?= $payment->national_id ?></td>
                        <tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php
                if (count($pages) > 1) {
                    $pagination = '<ul class="bcb-pagination">';

                    foreach ( $pages as $page ) {
                        $pagination .= '<li class="bcb-page-item"><a href="' . add_query_arg('p', $page, get_permalink()) . ' ">' . $page . '</a></li>';
                    }

                    $pagination .= '</ul>';
                    echo $pagination;
                }
            ?>
        </div>

        <script>
            document.body.onload = function () {
                const getQueryParams = () => {
                    return window.location.search
                        .replace('?', '')
                        .split('&')
                        .map((val) => val.split('='))
                        .reduce((a, b) => ({ ...a, [b[0]]: b[1]}), {});
                }

                const buildURL = (q) => window.location.protocol + '//' + window.location.host + window.location.pathname + '?' + q;

                document.getElementById('bcbPerformSearch').addEventListener('click', function () {
                    const data = {
                        ...getQueryParams(),
                        qstr: document.querySelector('[name="bcbHistoryFilter-qstr"]').value,
                        qid: document.querySelector('[name="bcbHistoryFilter-qid"]').value,
                        qst: document.querySelector('[name="bcbHistoryFilter-qst"]').value,
                        qctrc: document.querySelector('[name="bcbHistoryFilter-qctrc"]').value,
                    };

                    const qsParams = Object.keys(data)
                        .filter((k) => data[k] !== '')
                        .map((k) => `${k}=${data[k]}`)
                        .join('&');

                    window.location.href = buildURL(qsParams);
                });

                document.getElementById('bcbPerformClear').addEventListener('click', function () {
                    const { page } = getQueryParams();
                    window.location.href = buildURL(`page=${page}`);
                });
            }
        </script>
    <?php }
}
