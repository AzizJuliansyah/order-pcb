<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model
{

    public function update_orders($order_id, $data)
    {
        $this->db->where('order_id', $order_id);
        return $this->db->update('orders', $data);
    }

    public function delete_order_with_items($order_id)
    {
        $this->db->where('order_id', $order_id);
        $this->db->delete('order_items');

        $this->db->where('order_id', $order_id);
        $this->db->delete('orders');
    }

    public function updateOrderStatuses(array $orderIds, $paymentStatus = null, $orderStatus = null)
    {
        if (empty($orderIds)) return;

        foreach ($orderIds as $orderId) {
            $data = [];

            if (!empty($paymentStatus)) {
                $data['payment_status'] = $paymentStatus;
            }

            if (!empty($orderStatus)) {
                $data['order_status'] = $orderStatus;
            }

            if (!empty($data)) {
                $this->db->where('order_id', $orderId)->update('orders', $data);
            }
        }
    }
}