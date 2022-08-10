<?php

namespace App\Http\Controllers\Api\V1\Orders\Interfaces;

use Illuminate\Http\Request;

interface OrderInterface
{
    public function allOrders(Request $request);

    public function findOrder($id);

    public function genereateInvoice($id);

    public function changestatus($id);

}