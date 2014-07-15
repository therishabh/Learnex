<?php 

/**
* 
*/
class User_model extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

	function check_login($username,$password,$table)
	{
		$this->db->select('password');
		$this->db->where('username',$username);
		$this->db->where('status','1');
		$query = $this->db->get($table);
		$row = $query->row();
		if($query->num_rows() > 0)
		{
			if(md5($password) == $row->password)
			{
				return TRUE;
			}
			else
			{
				return False;
			}
		}
		else
		{
			return false;
		}
	}

	


// **************** start comman functions ****************
	
	function fetchbyid($id,$table)
	{
		$this->db->where('status','1');
		$this->db->where('id',$id);
		$query = $this->db->get($table);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}

	function fetchbyfield($field,$value,$table)
	{

		$this->db->where('status','1');
		$this->db->where($field,$value);
		$query = $this->db->get($table);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}

	function fetchalldata($table)
	{
		$this->db->where('status','1');
		$query = $this->db->get($table);
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function fetchalldatadesc($table)
	{
		$this->db->where('status','1');
		$this->db->order_by('id','desc');
		$query = $this->db->get($table);
		if($query->num_rows() > 0)
		{
			$data = $query->result_array();
			$num_rows = $query->num_rows();
			return array($data,$num_rows);
		}
		else
		{
			return false;
		}
	}

	function fetchlastactivedata($table)
	{
		$this->db->where('status','1');
		$this->db->order_by('id','desc');
		$this->db->limit('1');
		$query = $this->db->get($table);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}

	function fetchlastdata($table)
	{
		$this->db->order_by('id','desc');
		$this->db->limit('1');
		$query = $this->db->get($table);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}

	function updatedata($data,$id,$table)
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

	// function for insert data into table
	function insertdata($data,$table)
	{
		$query = $this->db->insert($table,$data);
		if($query)
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}
	function update_timetable($update_data,$batch_id,$table)
	{
		$this->db->where('batch',$batch_id);
		$query = $this->db->update($table,$update_data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function update_timetable_code($update_data,$id,$table)
	{
		$this->db->where('id',$id);
		$query = $this->db->update($table,$update_data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function delete_timetable($batch_id,$table)
	{
		$this->db->where('batch',$batch_id);
		$query = $this->db->delete($table);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function create_staff_tt($table_name)
	{
		$query = $this->db->query("CREATE TABLE $table_name(
		id INT NOT NULL AUTO_INCREMENT,
		days VARCHAR(255) NOT NULL,
		one VARCHAR(255) NOT NULL,
		two VARCHAR(255) NOT NULL,
		three VARCHAR(255) NOT NULL,
		four VARCHAR(255) NOT NULL,
		five VARCHAR(255) NOT NULL,
		six VARCHAR(255) NOT NULL,
		seven VARCHAR(255) NOT NULL,
		eight VARCHAR(255) NOT NULL,
		nine VARCHAR(255) NOT NULL,
		PRIMARY KEY ( id )
		)");
	}

	//function for create random string..
	function generateRandomString($length = 3) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
		  $randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString.rand(0,9);
	}


// end create some comman functions....
//************ end comman Functions *******************

//

	function get_user_details($username,$table)
	{
		$this->db->where('username',$username);
		$this->db->where('status','1');
		$query = $this->db->get($table);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}
	function get_organization_details(){
		$query = $this->db->get("organization");
		if($query->num_rows() > 0)
		{
			$data = $query->row_array();
			return $data;
		}
		else
		{
			return false;
		}

	}

	function num_of_org_location(){
		$query = $this->db->get('organization_location');
		return $query->num_rows();
	}

	function get_organization_location(){
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

	function get_staff_details()
	{
		$this->db->where('status','1');
		$this->db->order_by('id','desc');
		$query = $this->db->get('staff');
		if($query->num_rows() > 0 )
		{
			$data = $query->result_array();
			$num_rows = $query->num_rows();
			return array($data,$num_rows);
		}
		else
		{
			return false;
		}
	}
	
	function search_by_id($id,$tabel){
		$this->db->where('id',$id);
		$query = $this->db->get($tabel);
		// echo $query->num_rows();
		if($query->num_rows() > 0 )
		{
			$data = $query->row_array();
			return $data;
		}

		else
		{
			return false;
		}
	}

	function get_staff($name,$emp_type,$staff_type)
	{

		$this->db->like('name',$name);
		$this->db->like('emp_type',$emp_type,'both');
		$this->db->like('staff_type',$staff_type,'after');
		$this->db->order_by('id','desc');
		$query = $this->db->get('staff');
		// echo $this->db->last_query();
		if($query->num_rows() > 0 )
		{
			$data = $query->result_array();
			return $data;
		}

		else
		{
			return false;
		}
	}


	function staff_detail_by_id($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('staff');
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}

	function last_staff_username()
	{
		$this->db->select('username');
		$this->db->order_by('id','desc');
		$this->db->limit('1');

		$query = $this->db->get('staff');
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}

	}

	function insert_staff_details($data)
	{
		$query = $this->db->insert('staff',$data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function check_staff_id($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('staff');
		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function staff_info($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('staff');
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}

	function update_staff($data,$id)
	{
		$this->db->where('id',$id);
		$query = $this->db->update('staff',$data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function last_student_username()
	{
		$this->db->select('username');
		$this->db->order_by('id','desc');
		$this->db->limit('1');

		$query = $this->db->get('student');
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}

	}


	//manage admin section
	function get_admin($name,$username)
	{

		$this->db->like('name',$name);
		$this->db->like('username',$username,'both');
		$this->db->order_by('id','desc');
		$query = $this->db->get('admin');
		// echo $this->db->last_query();
		if($query->num_rows() > 0 )
		{
			$data = $query->result_array();
			return $data;
		}
		else
		{
			return false;
		}
	}
	
	// end manage admin section
	// 
	function get_student($name,$username,$course,$batch)
	{
		$this->db->like('name',$name);
		$this->db->like('username',$username);
		$this->db->like('course',$course);
		$this->db->like('batch',$batch);
		$this->db->order_by('id','desc');
		$query = $this->db->get('student');
		// echo $this->db->last_query();
		if($query->num_rows() > 0 )
		{
			$data = $query->result_array();
			return $data;
		}

		else
		{
			return false;
		}
	}

	function get_student_by_course($course_id)
	{
		$this->db->like('course',$course_id);
		$this->db->order_by('id','desc');
		$query = $this->db->get('student');
		// echo $this->db->last_query();
		if($query->num_rows() > 0 )
		{
			$data = array($query->result_array() , $query->num_rows());
			return $data;
		}

		else
		{
			return false;
		}
	}
	function count_student_by_batch($batch_id)
	{
		$this->db->where('status','1');
		$this->db->where('batch',$batch_id);
		$query = $this->db->get('student');
		return $query->num_rows();
	}

	function fetch_teacher()
	{
		$this->db->where('staff_type','Teaching');
		$this->db->where('status','1');
		$query = $this->db->get('staff');
		// echo $this->db->last_query();
		if($query->num_rows() > 0 )
		{
			$data = array($query->result_array() , $query->num_rows());
			return $data;
		}

		else
		{
			return false;
		}
	}

	function update_batch_table($days_value,$update_data,$table)
	{
		$this->db->where('days',$days_value);
		$query = $this->db->update($table,$update_data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function lecture_detail($batch_id)
	{
		$query = $this->db->query("SELECT timetable.code AS code, timetable.subject AS subject_id, subject.name AS subject_name, staff.name AS teacher_name, timetable.teacher AS teacher_id, timetable.batch AS batch_id, timetable.day AS day, timetable.start_time AS start_time, timetable.end_time AS end_time FROM timetable LEFT JOIN subject ON subject.id = timetable.subject LEFT JOIN staff ON staff.id = timetable.teacher WHERE timetable.batch = $batch_id AND timetable.status = 1");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function batch_comment($batch_id)
	{
		$this->db->select("comment");
		$this->db->where('batch',$batch_id);
		$query = $this->db->get('lecture_schedule');
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}


	function fetch_teacher_lecture($id)
	{
		$query = $this->db->query("SELECT subject.name AS subject_name, staff.name AS teacher_name, staff.username AS teacher_username, staff.id AS teacher_id, timetable.start_time AS start_time, timetable.end_time AS end_time, timetable.end_time AS end_time, batch.name AS batch_name, batch.id AS batch_id, timetable.day AS day FROM timetable LEFT JOIN subject ON subject.id = timetable.subject LEFT JOIN staff ON staff.id = timetable.teacher LEFT JOIN batch ON batch.id = timetable.batch WHERE timetable.teacher = $id AND timetable.status = 1 ORDER BY STR_TO_DATE(timetable.start_time,'%h.%i%p') ASC");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	// function lecture_detail_for_attendance($batch_id)
	// {
	// 	$query = $this->db->query("SELECT timetable.code AS code, timetable.subject AS subject_id, subject.name AS subject_name, staff.name AS teacher_name, timetable.teacher AS teacher_id, timetable.batch AS batch_id, timetable.day AS day, timetable.start_time AS start_time, timetable.end_time AS end_time FROM timetable LEFT JOIN subject ON subject.id = timetable.subject LEFT JOIN staff ON staff.id = timetable.teacher WHERE timetable.batch = $batch_id AND timetable.status = 1");
	// 	if($query->num_rows() > 0)
	// 	{
	// 		return $query->result_array();
	// 	}
	// 	else
	// 	{
	// 		return false;
	// 	}
	// }

	function fetchlecturedetail($code)
	{
		$query = $this->db->query("SELECT batch.name AS batch_name, timetable.batch AS batch_id, timetable.id AS id,  course.name AS course_name, timetable.start_time AS start_time, timetable.end_time AS end_time, staff.name AS teacher_name, timetable.day AS day, subject.name AS subject_name FROM timetable LEFT JOIN batch ON batch.id = timetable.batch LEFT JOIN course ON batch.course = course.id LEFT JOIN staff ON staff.id = timetable.teacher LEFT JOIN subject ON subject.id = timetable.subject WHERE timetable.code = '$code' ");
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}

	function fetch_student_by_batch($batch_id)
	{
		$this->db->where('status','1');
		$this->db->where('batch',$batch_id);
		$this->db->order_by('name','asc');
		$query = $this->db->get('student');
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function fetchattendance($date,$timetable_id)
	{
		$this->db->where('status','1');
		$this->db->where('date',$date);
		$this->db->where('timetable_id',$timetable_id);
		$query = $this->db->get('attendance');
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}

	function fetch_news_type()
	{
		$this->db->where('status','1');
		$query = $this->db->get('news_type');
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function admin_news_notification($username)
	{
		$query = $this->db->query("SELECT * FROM news WHERE status = '1' AND create_user != '$username'");
		if( $query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function staff_news_notification($username)
	{
		date_default_timezone_set('Asia/Calcutta');
		$today_date = date("Y-m-d");
		$query = $this->db->query("SELECT * FROM news WHERE ((DATE(publish_time) <= '$today_date' AND active = '1' AND (share_with = 'all' OR custome_share LIKE '%staff%'))  OR (create_user = '$username' AND active = '1')) AND status = '1'");
		if( $query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function student_news_notification()
	{
		date_default_timezone_set('Asia/Calcutta');
		$today_date = date("Y-m-d");
		$query = $this->db->query("SELECT * FROM news WHERE DATE(publish_time) <= '$today_date' AND status = '1' AND active = '1' AND (share_with = 'all' OR custome_share LIKE '%student%')");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function search_news($title,$type,$status)
	{
		$this->db->like('news_title',$title);
		$this->db->like('news_type',$type);
		$this->db->like('active',$status);
		$this->db->where('status','1');
		$this->db->order_by('id','desc');
		$query = $this->db->get('news');
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function search_staff_news($title,$type,$username)
	{
		date_default_timezone_set('Asia/Calcutta');
		$today_date = date("Y-m-d");
		$query = $this->db->query("SELECT * FROM news WHERE ((DATE(publish_time) <= '$today_date' AND active = '1' AND (share_with = 'all' OR custome_share LIKE '%staff%')) OR create_user = '$username') AND status = '1'   AND news_type LIKE '%$type%' AND news_title LIKE '%$title%' ORDER BY DATE(publish_time) DESC");
		if($query->num_rows() > 0)
		{
			return  $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function search_student_news($title,$type)
	{
		date_default_timezone_set('Asia/Calcutta');
		$today_date = date("Y-m-d");
		$query = $this->db->query("SELECT * FROM news WHERE DATE(publish_time) <= '$today_date' AND status = '1' AND active = '1' AND (share_with = 'all' OR custome_share LIKE '%student%') AND news_type LIKE '%$type%' AND news_title LIKE '%$title%'  ORDER BY DATE(publish_time) DESC");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function fetch_staff_news($username)
	{
		date_default_timezone_set('Asia/Calcutta');
		$today_date = date("Y-m-d");
		$query = $this->db->query("SELECT * FROM news WHERE ((DATE(publish_time) <= '$today_date' AND active = '1' AND (share_with = 'all' OR custome_share LIKE '%staff%'))  OR create_user = '$username') AND status = '1' ORDER BY DATE(publish_time) DESC");
		if($query->num_rows() > 0)
		{
			$data = $query->result_array();
			$num_rows = $query->num_rows();
			return array($data,$num_rows);
		}
		else
		{
			return false;
		}
	}

	function fetch_student_news()
	{
		date_default_timezone_set('Asia/Calcutta');
		$today_date = date("Y-m-d");
		$query = $this->db->query("SELECT * FROM news WHERE DATE(publish_time) <= '$today_date' AND status = '1' AND active = '1' AND (share_with = 'all' OR custome_share LIKE '%student%') ORDER BY DATE(publish_time) DESC");
		if($query->num_rows() > 0)
		{
			$data = $query->result_array();
			$num_rows = $query->num_rows();
			return array($data,$num_rows);
		}
		else
		{
			return false;
		}
	}


	function admin_unread_news($username)
	{
		$query = $this->db->query("SELECT id FROM news WHERE status = '1' AND create_user != '$username'");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function staff_unread_news($username)
	{
		date_default_timezone_set('Asia/Calcutta');
		$today_date = date("Y-m-d");
		$query = $this->db->query("SELECT * FROM news WHERE ((DATE(publish_time) <= '$today_date' AND active = '1' AND (share_with = 'all' OR custome_share LIKE '%staff%'))  OR (create_user = '$username' AND active = '1')) AND status = '1' ORDER BY DATE(publish_time) DESC");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function student_unread_news()
	{
		date_default_timezone_set('Asia/Calcutta');
		$today_date = date("Y-m-d");
		$query = $this->db->query("SELECT * FROM news WHERE DATE(publish_time) <= '$today_date' AND status = '1' AND active = '1' AND (share_with = 'all' OR custome_share LIKE '%student%')");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	

	function fetch_news_type_by_name($name)
	{
		$this->db->where('status','1');
		$this->db->like('name',$name);
		$query = $this->db->get('news_type');
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	function update_news_type($id)
	{
		$this->db->where('news_type',$id);
		$data['news_type'] = '1';
		$query = $this->db->update('news',$data);
		if($query)
		{
			return true;
		}
	}

	function check_student_email($email,$table)
	{
		$this->db->like('email',$email,'both');
		$query = $this->db->get($table);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}

	function fetchstudentforexcel($course,$batch)
	{
		$this->db->where("status",'1');
		$this->db->like('course',$course);
		$this->db->like('batch',$batch);
		$query = $this->db->get("student");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function getstudentlist($course,$batch)
	{
		$this->db->where("status",'1');
		$this->db->like('course',$course);
		$this->db->like('batch',$batch);
		$this->db->order_by('name',"asc");
		$query = $this->db->get("student");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function fetch_course_name($id)
	{
		$this->db->select("name");
		$this->db->where("status",'1');
		$this->db->where("id",$id);
		$query = $this->db->get("course");
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}


	function fetch_batch_name($id)
	{
		$this->db->select("name");
		$this->db->where("status",'1');
		$this->db->where("id",$id);
		$query = $this->db->get("batch");
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}

	function fetch_student_deatil_with_course_batch($course_id,$batch_id)
	{
		$this->db->where("status",'1');
		$this->db->like("course",$course_id);
		$this->db->like("batch",$batch_id);
		$query = $this->db->get("student");
		if($query->num_rows() > 0)
		{
			$data = $query->result_array();
			$num_rows = $query->num_rows();
			return array($data,$num_rows);
		}
		else
		{
			return false;
		}
	}


	function fetchtopic($subject_id)
	{
		$this->db->where("subject",$subject_id);
		$this->db->select('name');
		$this->db->select('id');
		$query = $this->db->get("topic");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function deletetopic($subject_id)
	{
		$this->db->where('subject',$subject_id);
		$this->db->delete("topic");
		return true;
	}

	function lastextraclass()
	{
		$this->db->select('code');
		$this->db->order_by('id','desc');
		$this->db->limit('1');

		$query = $this->db->get('extra_class');
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}

	}

	function fetch_running_extra_class()
	{
		$this->db->where('allow',"1");
		$this->db->where('status',"1");
		$this->db->where('discart',"0");
		$this->db->order_by('id','desc');
		$query = $this->db->get('extra_class');
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function fetch_pending_extra_class()
	{
		$this->db->where('allow',"0");
		$this->db->where('status',"1");
		$this->db->where('discart',"0");
		$this->db->order_by('id','desc');
		$query = $this->db->get('extra_class');
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function fetch_own_extra_class($student_id)
	{
		$this->db->where('status',"1");
		$this->db->where('discart',"0");
		$this->db->order_by('id','desc');
		$this->db->where('created_by',$student_id);
		$query = $this->db->get('extra_class');
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function fetch_enroll_extra_class($student_id)
	{
		$query = $this->db->query("SELECT extra_class_student.class_code AS class_code FROM extra_class_student LEFT JOIN extra_class ON extra_class_student.class_code = extra_class.code  WHERE  extra_class_student.student_id = '$student_id' ORDER BY extra_class.id DESC");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function fetch_batchment($course_code,$batch,$student_id)
	{
		$this->db->where('class_code',$course_code);
		$this->db->where('batch',$batch);
		$this->db->where('student_id !=',$student_id);
		$query = $this->db->get('extra_class_student');

		if($query->num_rows() > 0)
		{
			return $query->num_rows();
		}	
		else
		{
			return "0";
		}
	}

	function running_extra_class_search($subject,$topic,$code)
	{
		$this->db->like('subject',$subject);
		$this->db->like('topic',$topic,"after");
		$this->db->like('code',$code);
		$this->db->where('allow',"1");
		$this->db->where('status',"1");
		$this->db->where('discart',"0");
		$this->db->order_by('id','desc');
		$query = $this->db->get('extra_class');
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function pending_extra_class_search($subject,$topic,$code)
	{
		$this->db->like('subject',$subject);
		$this->db->like('topic',$topic,"after");
		$this->db->like('code',$code);
		$this->db->where('allow',"0");
		$this->db->where('status',"1");
		$this->db->where('discart',"0");
		$this->db->order_by('id','desc');
		$query = $this->db->get('extra_class');
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function own_extra_class_search($subject,$topic,$code,$student_id)
	{
		$this->db->like('subject',$subject);
		$this->db->like('topic',$topic,"after");
		$this->db->like('code',$code);
		$this->db->where('status',"1");
		$this->db->where('discart',"0");
		$this->db->order_by('id','desc');
		$this->db->where('created_by',$student_id);
		$query = $this->db->get('extra_class');
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	function enroll_extra_class_search($subject,$topic,$code,$student_id)
	{
		$query = $this->db->query("SELECT extra_class_student.class_code AS class_code FROM extra_class_student LEFT JOIN extra_class ON extra_class.code LIKE '%$code%' AND extra_class.subject LIKE '%$subject%' AND extra_class.topic LIKE '$topic%' WHERE extra_class_student.class_code = extra_class.code AND extra_class_student.student_id = '$student_id' ORDER BY extra_class.id DESC");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function check_enroll($class_code,$student_id)
	{
		$this->db->where('class_code',$class_code);
		$this->db->where('student_id',$student_id);
		$query = $this->db->get('extra_class_student');
		return $query->num_rows();	
	}

	function remove_enroll($student_id,$class_code)
	{
		$this->db->where('class_code',$class_code);
		$this->db->where('student_id',$student_id);
		$query = $this->db->delete('extra_class_student');
	}
	
	function exist_class_pending_running($subject,$topic)
	{
		$this->db->where('subject',$subject);
		$this->db->where('topic',$topic);
		$this->db->where('status',"1");
		$this->db->where('discart',"0");
		$this->db->order_by('id','desc');
		$query = $this->db->get('extra_class');
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function number_of_total_student($class_code)
	{
		$this->db->where('class_code',$class_code);
		$query = $this->db->get('extra_class_student');
		return $query->num_rows();
	}
}


?>