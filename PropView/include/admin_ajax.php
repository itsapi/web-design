<?
	include 'config.php';

	switch ($_GET['func']) {
		case 'getInfo':
			$username = addslashes($_GET['user']);
			$result = query_DB("SELECT * FROM users WHERE username='{$username}'");
			echo json_encode(mysqli_fetch_assoc($result));
			break;
		case 'getAccount':
			$result = query_DB("SELECT * FROM users WHERE admin");
			echo json_encode(mysqli_fetch_assoc($result));
			break;
		case 'deleteUser':
			$username = addslashes($_GET['user']);
			$result = query_DB("DELETE FROM users WHERE username='{$username}'");
			if ($result){
				echo 'success';
			}
			break;
		case 'editUser':
			$username = $_GET['user'];
			$result = query_DB("SELECT * FROM users WHERE username='{$username}'");
			$formData = json_decode($_GET['formData']);
			$data = [];
			foreach ($formData as $item){
				if ($item->value != ''){
					$name = addslashes($item->name);
					$value = addslashes($item->value);
					$data[$name] = $value;
				}
			}
			if (mysqli_num_rows($result) > 0){
				$query = "UPDATE users SET {updateString} WHERE username='$username'";
				$updateString = '';
				foreach ($data as $name => $value){
					$updateString .= "{$name} = '{$value}', ";
				}
				$query = str_replace('{updateString}',substr($updateString, 0, -2),$query);
				$to = [
					'email' => $data['email'],
					'name' => ($data['firstname'].' '.$data['surname'])
				];
				$from = $mailUser;
				$subject = 'Updated user information for '.$data['username'];
				$message = <<<END
Hello {$to['name']},

Your account details have recently been updated by the admin.
If you think this was in error, please contact us and we will get it sorted ASAP.

Regards,
The PropView Team.
END;
				email($to, $from, $subject, $message);
				echo $username.':';
			} else {
				$query = "INSERT INTO users ({cols}) VALUES ({vals})";
				$cols = '';
				$vals = '';
				foreach ($data as $name => $value){
					$cols .= "{$name}, ";
					$vals .= "'{$value}', ";
				}
				$cols .= 'password';
				$password = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"),0,8);
				$vals .= "'".hash('sha512',$username.hash('sha512',addslashes($password)))."'";
				$query = str_replace(['{cols}','{vals}'],[$cols,$vals],$query);
				$to = [
					'email' => $data['email'],
					'name' => ($data['firstname'].' '.$data['surname'])
				];
				$from = $mailUser;
				$subject = 'Welcome to PropView '.$data['username'].'!';
				$message = <<<END
Hello {$to['name']},

Thank you for taking interest in PropView!

Your username is {$data['username']} and your password is {$password}.
Please log in here http://dvbris.no-ip.org/webDesign/PropView and change your password ASAP.

Regards,
The PropView Team.
END;
				email($to, $from, $subject, $message);
				echo $username.':'.$password.':';
			}
			$result = query_DB($query);
			if ($result){
				echo 'success';
			}
			break;
		case 'editAccount':
			$query = "UPDATE users SET {updateString} WHERE admin";
			$updateString = '';
			$formData = json_decode($_GET['formData']);
			foreach ($formData as $item){
				if ($item->value != ''){
					if ($item->name == 'password'){
						$value = hash('sha512',addslashes($_GET['user']).hash('sha512',addslashes($item->value)));
					} else {
						$value = addslashes($item->value);
					}
					$name = addslashes($item->name);
					$updateString .= "{$name}='{$value}',";
				}
			}
			$query = str_replace('{updateString}',substr($updateString, 0, -1),$query);
			$result = query_DB($query);
			if ($result){
				echo 'success';
			}
			break;
		case 'getUsers':
			$result = query_DB("SELECT username FROM users WHERE admin IS NULL");
			while($row = mysqli_fetch_assoc($result)){
				 $json[] = $row;
			}
			echo json_encode($json);
			break;
	}