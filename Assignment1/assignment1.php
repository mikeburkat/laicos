
<?php
class Assignment1 extends CI_Controller {
    public function index()
    {
	$query = "SELECT * FROM user";
	if (isset($_POST['option'])){
		if ($_POST['option'] == 1)
		{
			$query = "SELECT * FROM `user` WHERE `firstName` = 'Percy' AND `lastName` = 'Shelly' AND YEAR(dateOfBirth) = 1972;";
			}
		else if($_POST['option'] == 2)
		{
			$query = "SELECT `user`.* 
							 FROM `relationship` 
							 INNER JOIN `user` ON (
								`status` = 'friend'
							 )
							 WHERE userID1 = (SELECT `userID` FROM `user` WHERE `firstName` = 'Percy' AND `lastName` = 'Shelly' AND YEAR(dateOfBirth) = 1972)
							 AND userID = userID2
							 ;";
							 
		}
		
		else if($_POST['option'] == 3)
		{
			$query = "	SELECT `user`.* 
								FROM `relationship`
								INNER JOIN `user` ON (
									`status` = 'friend'
									AND `userID1` = (
								SELECT userID
								FROM `relationship`
								INNER JOIN `user` ON (
									`status` = 'son'
									AND `userID2` = (SELECT `userID` FROM `user` WHERE `firstName` = 'Percy' AND `lastName` = 'Shelly' AND YEAR(dateOfBirth) = 1972)
								)
								WHERE userID1 = userID
								)
								)
								WHERE userID2 = userID
								;";
		}
	}
	//if ($test == 1) echo "blablabla";
      $resultsTable = array(
        'tableData' => $this->getUsers($query)
      );
	  $data['title'] = "Team 1";
	  $data['projectName'] = "Assignment 1";
      //var_dump($data);
      $this->load->view('templates/header',$data);
	  $this->load->view('templates/footer',$data);
	  
	  
	  $this->load->view('assignment1_view',$resultsTable);
    }

    function getUsers($query) {
      // Create connection
      $con=mysqli_connect("aa1ohsebcgmb9rk.cdzyg5scsn65.us-east-1.rds.amazonaws.com","gtmm","gt3b4140","ebdb");

      // Check connection
      if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

	  $result = mysqli_query($con, $query);
      mysqli_close($con);

      while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $rows[] = $row;
	}
      return $rows;

    }
	
		public function query_selector()
	{
		//if(_POST['query'] == //option 1, option 2, option 3,)
			//getUsers(_POST);
		$query = "SELECT * FROM user";
		echo $this->getUsers($query);
	}
}

?>