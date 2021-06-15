<?php
class General_m extends CI_Model{
	public function select($table, $where, $con, $order = null, $orderValue = null, $field = null){
		if (isset($field)) {
			$this->db->select($field);
		}
		if (isset($where)) {
			$this->db->where($where);
		}
		if (isset($order)) {
			$this->db->order_by($order, $orderValue);
		}
		return $this->db->get($table)->$con();	
	}

	public function save($table, $data){
        return $this->db->insert($table, $data);
	}

	public function update($table, $data, $where){
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

	public function delete($table, $where){
        $this->db->where($where);
        return $this->db->delete($table);
    }

}
?>
