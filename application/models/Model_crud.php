<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_crud extends CI_Model {
    
    public function insert($table, $data) {
        if($this->db->insert($table, $data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function inserted_id() {
        return $this->db->insert_id();
    }

    public function update($table, $data, $where) {
        $this->db->where($where);
        if($this->db->update($table, $data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function select($table) {
        $get = $this->db->get($table);
        if($get) {
            return $get->result_array();
        } else {
            return FALSE;
        }
    }
    
    public function select_query($query) {
        $get = $this->db->query($query);
        if ($get->num_rows() > 0) {
            return $get->result_array();
        } else {
            return FALSE;
        }
    }
    
    public function select_where($table, $where) {
        $this->db->where($where);
        $get = $this->db->get($table);
        if($get) {
            return $get->result_array();
        } else {
            return FALSE;
        }
    }
    
    public function select_limit($table, $limit) {
        $this->db->limit($limit);
        $get = $this->db->get($table);
        if($get) {
            return $get->result_array();
        } else {
            return FALSE;
        }
    }
    
    public function select_like($table, $like) {
        $this->db->like($like);
        $get = $this->db->get($table);
        if($get) {
            return $get->result_array();
        } else {
            return FALSE;
        }
    }
    
    public function select_like_limit($table, $like, $limit) {
        $this->db->like($like);
        $this->db->limit($limit);
        $get = $this->db->get($table);
        if($get) {
            return $get->result_array();
        } else {
            return FALSE;
        }
    }
    
    public function select_order($table, $order, $order_by) {
        $this->db->order_by($order, $order_by);
        $get = $this->db->get($table);
        if($get) {
            return $get->result_array();
        } else {
            return FALSE;
        }
    }
    
    public function select_where_order($table, $where, $order, $order_by) {
        $this->db->where($where);
        $this->db->order_by($order, $order_by);
        $get = $this->db->get($table);
        if($get) {
            return $get->result_array();
        } else {
            return FALSE;
        }
    }
    
    public function delete($table, $where) {
        $this->db->where($where);
        $flag = $this->db->delete($table);
        if($flag) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function sort($table, $sort, $sort_by, $offset, $dataPerPage) {
        $query = $this->db->query("SELECT * FROM $table ORDER BY $sort $sort_by LIMIT $offset, $dataPerPage");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    
    public function sort_no_order($table, $offset, $dataPerPage) {
        $query = $this->db->query("SELECT * FROM $table LIMIT $offset, $dataPerPage");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    
    public function total_row($table) {
        $get = $this->db->get($table);

        if ($get->num_rows() > 0) {
            return $get->num_rows();
        } else {
            return 0;
        }
    }
    
    public function total_row_where($table, $where) {
        $this->db->where($where);
        $get = $this->db->get($table);

        if ($get->num_rows() > 0) {
            return $get->num_rows();
        } else {
            return 0;
        }
    }


    public function total_row_query($query) {
        $get = $this->db->query($query);

        if ($get->num_rows() > 0) {
            return $get->num_rows();
        } else {
            return 0;
        }
    }
    
    public function check_duplicate($table, $where) {
        $this->db->where($where);
        $get = $this->db->get($table);

        if ($get->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function last_query() {
        return $this->db->last_query();
    }
    
    public function checkToken() {
        $now = date('Y-m-d H:i:s');

        $query = $this->db->query("SELECT * FROM `temp_forgot` WHERE expired < '$now'");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $this->db->where('id', $row['id']);
                $this->db->delete('temp_forgot');
            }
        }
    }
    
}