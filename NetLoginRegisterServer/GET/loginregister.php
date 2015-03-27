	<?
		$conn = mysql_connect('127.0.0.1', 'root', '19911218');
		if(!$conn)
		{
			die('error!');
		}
		$result = mysql_select_db("LoginRegister", $conn);
		if(!$result)
		{
			mysql_close($conn);
			die('error!');
		}
		
		/*得到提交的用户名和密码*/
		$username = $_GET['username'];
		$userpwd = $_GET['userpwd'];
		$action = $_GET['action'];
		
		if('login' == $action)
		{
			/*设定字符集*/
			$sql = "set names utf8";
			$rs = mysql_query($sql);
			if(!$rs)
			{
				die("error");
			}
			$sql = "select * from t_user where username='".$username."' and userpwd ='".$userpwd."'";
			$rs = mysql_query($sql);
			if(!$rs)
			{
				mysql_close($conn);
				die("error!");
			}
			$recordCount = mysql_num_rows($rs);
			if($recordCount > 0)
			{
				echo "success!";
			}
			else
			{
				die("error!");
			}
		}
		else if('register' == $action)
		{
			/*设定字符集*/
			$sql = "set names utf8";
			$rs = mysql_query($sql);
			if(!$rs)
			{
				die("error");
			}
			/*查看用户是否存在*/
			$sql = "select * from t_user where username='".$username."' ";
			$rs = mysql_query($sql);
			if(!$rs)
			{
				mysql_close($conn);
				die("error!");
			}
			$recordCount = mysql_num_rows($rs);
			if($recordCount > 0)/*有用户了*/
			{
				mysql_close($conn);
				die("exist!");
			}
			else
			{
				$sql = "insert into t_user(username, userpwd) values('".$username."', '".$userpwd."')";
				$rs = mysql_query($sql);
				if(!$rs)
				{
					mysql_close($conn);
					die("error!");
				}	
				else
				{
					echo "success!";
				}
			}
		}
		else
		{
			echo "Wrong form!";
		}
		
		mysql_close($conn);
	?>

