<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ind_model extends CI_Model
{
	protected $table_ind = 'ai_ind';

	public function ind_get_last_id()
	{
		$sql = "SELECT * 
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

	public function ind_get_list($parent, $annee)
	{
		$sql = "SELECT * 
				FROM ".$this->table_ind."
				WHERE parent = ? AND annee = ?";
		$data = array($parent, $annee);
		$res = $this->db->query($sql, $data);
		$res = $res->result();
		if($res != NULL)
		{
			$list = array();
			foreach($res as $ind)
			{
				$list[''.$ind->mois.''] = array($ind->valeur, $ind->id);
			}
			return $list;
		}
		else
			return array();
	}

	public function ind_add($valeur, $parent, $mois, $annee)
	{
		$sql = "INSERT INTO ".$this->table_ind."(valeur, parent, mois, annee)
				VALUES (?, ?, ?, ?)";
		$data = array($valeur, $parent, $mois, $annee);
		$query = $this->db->query($sql, $data);
	}

	public function ind_get_nb_by_parent($parent)
	{
		$sql = "SELECT COUNT(*) as nb
				FROM ".$this->table_ind."
				WHERE parent = ?";
		$data = array($parent);
		$query = $this->db->query($sql, $data);
		return $query->row()->nb;
	}

	public function ind_del($id)
	{
		$sql = "DELETE FROM ".$this->table_ind."
				WHERE id = ?";
		$data = array($id);
		$query = $this->db->query($sql, $data);
	}

	public function ind_edit($id, $valeur)
	{
		$sql = "UPDATE ".$this->table_ind."
				SET valeur = ?
				WHERE id = ?";
		$data = array($valeur, $id);
		$query = $this->db->query($sql, $data);
	}
} 