<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model
{

    public function insert_cnc_material($data)
    {
        return $this->db->insert('cnc_material', $data);
    }

    public function edit_cnc_material($material_id, $data)
    {
        $this->db->where('id', $material_id);
        return $this->db->update('cnc_material', $data);
    }

    public function delete_cnc_material($material_id)
    {
        $this->db->where('id', $material_id);
        return $this->db->delete('cnc_material');
    }

    public function insert_cnc_finishing($data)
    {
        return $this->db->insert('cnc_finishing', $data);
    }

    public function edit_cnc_finishing($finishing_id, $data)
    {
        $this->db->where('id', $finishing_id);
        return $this->db->update('cnc_finishing', $data);
    }

    public function delete_cnc_finishing($finishing_id)
    {
        $this->db->where('id', $finishing_id);
        return $this->db->delete('cnc_finishing');
    }

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



    public function insert_to_cart($data)
    {
        return $this->db->insert('cart', $data);
    }
}