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



    public function insert_shipping_status($data)
    {
        return $this->db->insert('shipping_status', $data);
    }

    public function edit_shipping_status($material_id, $data)
    {
        $this->db->where('id', $material_id);
        return $this->db->update('shipping_status', $data);
    }

    public function delete_shipping_status($material_id)
    {
        $this->db->where('id', $material_id);
        return $this->db->delete('shipping_status');
    }



    public function delete_order_with_items($order_id)
    {
        // Ambil semua order_items yang terkait dengan order_id
        $order_items = $this->db->get_where('order_items', ['order_id' => $order_id])->result_array();

        foreach ($order_items as $item) {
            $product_info = json_decode($item['product_info'], true);

            if ($item['product_type'] == 'pcb') {
                $file_fields = ['gerberfile', 'bomfile', 'pickandplacefile'];
            } elseif ($item['product_type'] == 'cnc') {
                $file_fields = ['3dfile', '2dfile'];
            } else {
                $file_fields = [];
            }

            foreach ($file_fields as $field) {
                if (!empty($product_info[$field])) {
                    $clean_path = str_replace('\\', '/', $product_info[$field]);
                    $full_path = FCPATH . 'public/' . $clean_path;

                    if (file_exists($full_path)) {
                        unlink($full_path);
                    }
                }
            }
        }

        // Hapus order_items
        $this->db->where('order_id', $order_id);
        $this->db->delete('order_items');

        // Hapus order utama
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

    public function update_orders($order_id, $data)
    {
        $this->db->where('order_id', $order_id);
        return $this->db->update('orders', $data);
    }

}