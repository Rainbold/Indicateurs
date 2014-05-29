<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poles_model extends CI_Model
{
	protected $table_pole = 'ai_poles';

	public function poles_get_info($id)
	{
		$sql = "SELECT * 
				FROM ".$this->table_pole."
				WHERE id = ?";
		$data = array($id);
		$query = $this->db->query($sql, $data);
		return $query->row();
	}

	public function poles_get_all()
	{
		$sql = "SELECT * 
				FROM ".$this->table_pole;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function poles_get_list_aux($array)
	{
		$aux = array();
		foreach($array as $id)
		{
			array_push($aux, $id);
			$ch = $this->poles_get_children($id);
			foreach($ch as $id_ch)
			{
			array_push($aux, $id_ch);
			}
		}
	}

	public function poles_get_list($del = 0)
	{
		$poles = $this->poles_get_all();
		$array = array();
		foreach($poles as $pole)
		{
			// Gets only the column nom in the array returned by poles_get_nav
			$aux = array_map(function ($ar) {return $ar['nom'];}, $this->poles_get_nav($pole->id, $del));
			// If the array is not empty
			if($aux != array())
				array_push($array, array('nom' => '/'.implode('/', $aux), 'id' => $pole->id));
		}

		sort($array);
		return $array;
	}

	// Creates the path used in the navbar
	public function poles_get_nav($id, $del = 0)
	{
		$pole = $this->poles_get_info($id);
		$navbar = array();
		if($pole && $pole->id != $del)
		{
			array_unshift($navbar, array('nom'=>$pole->nom, 'id'=>$pole->id));
			while($pole != NULL && $pole->parent != -1 && $pole->id != $del)
			{
				if($pole->parent == $del)
					return array();

				$pole = $this->poles_get_info($pole->parent);
				if($pole)
					array_unshift($navbar, array('nom'=>$pole->nom, 'id'=>$pole->id));
			}
		}

		return $navbar;
	}

	public function poles_get_children($id)
	{
		$sql = "SELECT * 
				FROM ".$this->table_pole."
				WHERE parent = ?";
		$data = array($id);
		$query = $this->db->query($sql, $data);
		return $query->result();
	}

	public function poles_get_orphans()
	{
		$sql = "SELECT * 
				FROM ".$this->table_pole."
				WHERE parent NOT IN 
				(SELECT id FROM ".$this->table_pole.")
				AND parent != -1";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function poles_add($nom, $parent)
	{
		$sql = "INSERT INTO ".$this->table_pole."(nom, parent)
				VALUES (?, ?)";
		$data = array($nom, $parent);
		$query = $this->db->query($sql, $data);
	}

	public function poles_edit($id, $nom, $parent)
	{
		$sql = "UPDATE ".$this->table_pole."
				SET nom = ?, parent = ?
				WHERE id = ?";
		$data = array($nom, $parent, $id);
		$query = $this->db->query($sql, $data);
	}

	public function poles_del($id)
	{
		$sql = "DELETE FROM ".$this->table_pole."
				WHERE id = ?";
		$data = array($id);
		$query = $this->db->query($sql, $data);
	}
} 