<?php

if (role(['permissions' => ['bank_transfer_receipts' => 'view']])) {

    $columns = [
        'bank_transfer_receipts.bank_transfer_receipt_id', 'bank_transfer_receipts.membership_order_id',
        'bank_transfer_receipts.receipt_status', 'bank_transfer_receipts.created_on', 'site_users.display_name',
    ];

    $join["[>]membership_orders"] = ["bank_transfer_receipts.membership_order_id" => "order_id"];
    $join["[>]site_users"] = ["membership_orders.user_id" => "user_id"];

    if (!empty($data["offset"])) {
        $data["offset"] = array_map('intval', explode(',', $data["offset"]));
        $where["bank_transfer_receipts.bank_transfer_receipt_id[!]"] = $data["offset"];
    }

    if (!empty($data["search"])) {

        $id_search = filter_var($data["search"], FILTER_SANITIZE_NUMBER_INT);

        if (empty($id_search)) {
            $id_search = 0;
        }

        $where["AND #search_query"]["OR"] = [
            "bank_transfer_receipts.membership_order_id[~]" => $id_search,
            "site_users.display_name[~]" => $data["search"]
        ];
    }

    $where["LIMIT"] = Registry::load('settings')->records_per_call;

    if ($data["sortby"] === 'status_asc') {
        $where["ORDER"] = ["bank_transfer_receipts.receipt_status" => "ASC"];
    } else if ($data["sortby"] === 'status_desc') {
        $where["ORDER"] = ["bank_transfer_receipts.receipt_status" => "DESC"];
    } else {
        $where["ORDER"] = ["bank_transfer_receipts.bank_transfer_receipt_id" => "DESC"];
    }

    $bank_transfer_receipts = DB::connect()->select('bank_transfer_receipts', $join, $columns, $where);

    $i = 1;
    $output = array();
    $output['loaded'] = new stdClass();
    $output['loaded']->title = Registry::load('strings')->old_receipts;
    $output['loaded']->loaded = 'old_bank_receipts';
    $output['loaded']->offset = array();

    $output['filters'][1] = new stdClass();
    $output['filters'][1]->filter = Registry::load('strings')->all;
    $output['filters'][1]->class = 'load_aside';
    $output['filters'][1]->attributes['load'] = 'bank_transfer_receipts';

    $output['filters'][2] = new stdClass();
    $output['filters'][2]->filter = Registry::load('strings')->old_receipts;
    $output['filters'][2]->class = 'load_aside';
    $output['filters'][2]->attributes['load'] = 'old_bank_receipts';
    $output['filters'][2]->attributes['filter'] = 'old_receipts';
    $output['filters'][2]->attributes['skip_filter_title'] = true;

    $output['sortby'][1] = new stdClass();
    $output['sortby'][1]->sortby = Registry::load('strings')->sort_by_default;
    $output['sortby'][1]->class = 'load_aside';
    $output['sortby'][1]->attributes['load'] = 'old_bank_receipts';

    $output['sortby'][2] = new stdClass();
    $output['sortby'][2]->sortby = Registry::load('strings')->status;
    $output['sortby'][2]->class = 'load_aside sort_asc';
    $output['sortby'][2]->attributes['load'] = 'old_bank_receipts';
    $output['sortby'][2]->attributes['sort'] = 'status_asc';

    $output['sortby'][3] = new stdClass();
    $output['sortby'][3]->sortby = Registry::load('strings')->status;
    $output['sortby'][3]->class = 'load_aside sort_desc';
    $output['sortby'][3]->attributes['load'] = 'old_bank_receipts';
    $output['sortby'][3]->attributes['sort'] = 'status_desc';


    if (!empty($data["offset"])) {
        $output['loaded']->offset = $data["offset"];
    }

    foreach ($bank_transfer_receipts as $bank_receipt) {
        $output['loaded']->offset[] = $bank_receipt['bank_transfer_receipt_id'];
        $output['content'][$i] = new stdClass();
        $output['content'][$i]->image = Registry::load('config')->site_url."assets/files/defaults/bank_receipt.png";
        $output['content'][$i]->identifier = $bank_receipt['bank_transfer_receipt_id'];
        $output['content'][$i]->title = Registry::load('strings')->order_id.': '.$bank_receipt['membership_order_id'];
        $output['content'][$i]->title .= ' - '.$bank_receipt['display_name'];
        $output['content'][$i]->class = "receipt";
        $output['content'][$i]->icon = 0;
        $output['content'][$i]->unread = 0;


        if ((int)$bank_receipt['receipt_status'] === 0) {
            $output['content'][$i]->image = Registry::load('config')->site_url."assets/files/defaults/bank_receipt_pending.png";
            $output['content'][$i]->subtitle = Registry::load('strings')->pending;

        } else if ((int)$bank_receipt['receipt_status'] === 1) {

            $output['content'][$i]->image = Registry::load('config')->site_url."assets/files/defaults/bank_receipt_accepted.png";
            $output['content'][$i]->subtitle = Registry::load('strings')->accepted;

        } else if ((int)$bank_receipt['receipt_status'] === 2) {

            $output['content'][$i]->image = Registry::load('config')->site_url."assets/files/defaults/bank_receipt_rejected.png";
            $output['content'][$i]->subtitle = Registry::load('strings')->rejected;
        }


        $output['options'][$i][1] = new stdClass();
        $output['options'][$i][1]->option = Registry::load('strings')->view;
        $output['options'][$i][1]->class = 'load_form';
        $output['options'][$i][1]->attributes['form'] = 'old_bank_receipts';
        $output['options'][$i][1]->attributes['data-bank_transfer_receipt_id'] = $bank_receipt['bank_transfer_receipt_id'];
        
        $i++;
    }
}
?>