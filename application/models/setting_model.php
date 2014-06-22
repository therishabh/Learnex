<?php 

/**
* 
*/
class Setting_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function insert_organization_detail($data)
	{
		$query = $this->db->insert('organization',$data);
		if($query)
		{
			return true;
		}
	}
	function update_organization_detail($data)
	{
		$query = $this->db->update('organization',$data);
		//display last run query..
		// echo $this->db->last_query();
		if($query)
		{
			return true;
		}
	}
	function get_organization_location()
	{
		//SLECT * FROM organization_location
		$this->db->order_by('id','desc');
		$query = $this->db->get('organization_location');
		if($query)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	//insert organization location into database..
	function insert_organization_location($data)
	{
		$query = $this->db->insert('organization_location',$data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function get_organization_location_by_id($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('organization_location');
		if($query)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}

	function update_organization_location($data,$id)
	{
		$this->db->where('id',$id);
		$query = $this->db->update('organization_location',$data);
		if($query)
		{
			return true;
		}
		else{
			return false;
		}
	}

	function search_location($search_text)
	{
		$this->db->like('location_name',$search_text);
		$this->db->order_by('id','desc');
		$query = $this->db->get('organization_location');
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function get_tax_details()
	{
		$query = $this->db->get('tax');
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}


	function tax_insert($data)
	{
		$query = $this->db->insert('tax',$data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function tax_update($data)
	{
		$query = $this->db->update('tax',$data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>