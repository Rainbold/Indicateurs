<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ind_noms_model extends CI_Model
{
	protected $table_ind = 'ai_ind_noms';

	public function ind_get_last_id()
	{
		$sql = "SELECT id 
				FROM ".$this->table_ind."
				ORDER BY id DESC";
		$query = $this->db->query($sql, $data);
		return $query->row();
	}

	public function ind_get_info($id)
	{
		$sql = "SELECT * 
				FROM ".$this->table_ind."
				WHERE id = ?";
		$data = array($id);
		$query = $this->db->query($sql, $data);
		return $query->row();
	}

	public function ind_get_list($id)
	{
		$sql = "SELECT * 
				FROM ".$this->table_ind."
				WHERE parent = ?";
		$data = array($id);
		$query = $this->db->query($sql, $data);
		return $query->result();
	}

	public function ind_get_list_nb($id)
	{
		$sql = "SELECT COUNT(*) as nb
				FROM ".$this->table_ind."
				WHERE parent = ?";
		$data = array($id);
		$query = $this->db->query($sql, $data);
		return $query->row()->nb;
	}

	public function ind_get_orphans()
	{
		$sql = "SELECT * 
				FROM ".$this->table_ind."
				WHERE parent NOT IN 
				(SELECT id FROM ".$this->table_ind.")
				AND parent != -1";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function ind_add($nom, $parent)
	{
		$sql = "INSERT INTO ".$this->table_ind."(nom, parent)
				VALUES (?, ?)";
		$data = array($nom, $parent);
		$query = $this->db->query($sql, $data);
	}

	public function ind_edit($id, $nom, $parent)
	{
		$sql = "UPDATE ".$this->table_ind."
				SET nom = ?, parent = ?
				WHERE id = ?";
		$data = array($nom, $parent, $id);
		$query = $this->db->query($sql, $data);
	}

	public function ind_del($id)
	{
		$sql = "DELETE FROM ".$this->table_ind."
				WHERE id = ?";
		$data = array($id);
		$query = $this->db->query($sql, $data);
	}
} 