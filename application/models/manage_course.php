<?php
class Manage_course extends CI_Model
{


	//fetch details from $table_name where id is given..
	function get_detail_by_id($id,$table_name)
	{
		$this->db->where('id',$id);
		$query = $this->db->get($table_name);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}

	function course_insert($data)
	{
		$query = $this->db->insert('course',$data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function course_update($data,$id)
	{
		$this->db->where('id',$id);
		$query = $this->db->update('course',$data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//function for fetch all course details form course table..
	function course_details()
	{
		$this->db->where('status',1);
		$this->db->order_by('id','desc');
		$query = $this->db->get('course');

		if( $query->num_rows() > 0)
		{
			return array( $query->result_array(), $query->num_rows() );
		}
		else
		{
			return false;
		}
	}

	//execute function when user search course..
	function search_course($search_text)
	{
		$this->db->like('name',$search_text);
		$this->db->order_by('id','desc');
		$query = $this->db->get('course');
		if($query->num_rows() > 0)
		{
			return array( $query->result_array(), $query->num_rows() );
		}
		else
		{
			return false;
		}
	}


	//function for fetch all subject details form subject table..
	function subject_details()
	{
		$this->db->where('status',1);
		$this->db->order_by('id','desc');
		$query = $this->db->get('subject');

		if( $query->num_rows() > 0)
		{
			return array( $query->result_array(), $query->num_rows() );
		}
		else
		{
			return false;
		}
	}

	function insert_subject($data)
	{
		$query = $this->db->insert('subject',$data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function update_subject($data,$id)
	{
		$this->db->where('id',$id);
		$query = $this->db->update('subject',$data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//execute function when user search subject..
	function search_subject($search_text)
	{
		$this->db->like('name',$search_text);
		$this->db->order_by('id','desc');
		$query = $this->db->get('subject');
		if($query->num_rows() > 0)
		{
			return array( $query->result_array(), $query->num_rows() );
		}
		else
		{
			return false;
		}
	}


	//function for fetch all standard details form standard table..
	function batch_details()
	{
		$this->db->where('status',1);
		$this->db->order_by('id','desc');
		$query = $this->db->get('batch');

		if( $query->num_rows() > 0)
		{
			return array( $query->result_array(), $query->num_rows() );
		}
		else
		{
			return false;
		}
	}

	//fetch course details from course table for display into standard table
	function get_course()
	{
		$this->db->where('status',1);
		$this->db->order_by('name','asc');
		$query = $this->db->get('course');

		if( $query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	//fetch subject details from subject table for display into standard table
	function get_subject()
	{
		$this->db->where('status',1);
		$this->db->order_by('name','asc');
		$query = $this->db->get('subject');

		if( $query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}


	function update_data($data,$id,$table)
	{
		$this->db->where('id',$id);
		$query = $this->db->update($table,$data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//execute function when user search standard..
	function search_batch($search_text)
	{
		$this->db->like('name',$search_text);
		$this->db->order_by('id','desc');
		$query = $this->db->get('batch');
		if($query->num_rows() > 0)
		{
			return array( $query->result_array(), $query->num_rows() );
		}
		else
		{
			return false;
		}
	}

	function fetch_batch_by_courseid($course_id)
	{
		$this->db->where('course',$course_id);
		$this->db->where('status',"1");
		$query = $this->db->get('batch');
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function first_course_id()
	{
		$this->db->select('id');
		$this->db->where('status','1');
		$this->db->limit('1');
		$query = $this->db->get('course');
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}



}
?>