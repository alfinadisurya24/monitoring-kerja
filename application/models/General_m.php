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

	public function selectJoin($where, $con, $order = null, $orderValue = null, $field = null, $attr){
		if (isset($field)) {
			$this->db->select($field);
		}
		$this->db->from('pekerjaan as a');
		$this->db->join(''.$attr.' as b', 'b.id_'.$attr.' = a.'.$attr.'_id');

		if (isset($where)) {
			$this->db->where($where);
		}
		if (isset($order)) {
			$this->db->order_by($order, $orderValue);
		}
		return $this->db->get()->$con();	
	}

	public function save($table, $data){
        $this->db->insert($table, $data);

		return $this->db->insert_id();
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
