<?
	include 'functions.php';

	switch ($_GET['func']) {
		case 'approveProp':
			if (is_array($_GET['propData'])){
				$propData = [];
				foreach ($_GET['propData'] as $key => $value) {
					$propData[$key] = addslashes($value);
				}
			} else {
				$propData = addslashes($_GET['propData']);
			}
			$result = query_DB("UPDATE properties SET approved=1 WHERE id='{$propData['id']}'");
			$data = getUserData('id', $propData['uid']);
			$to = [
				'email' => $data['email'],
				'name' => ($data['firstname'].' '.$data['surname'])
			];
			$from = $mailUser;
			$subject = 'Property approved';
			$message = <<<END
Hello {$to['name']},

Your property {$propData['name']} has been approved by the admin.
Your property will now be visible to everyone. You can edit the property in your settings.

Regards,
The PropView Team.
END;
			print_r($to);
			print_r($from);
			echo $subject . '\n\n' . $message;
			email($to, $from, $subject, $message);
			break;
		case 'deleteProp':
			if (is_array($_GET['propData'])){
				$propData = [];
				foreach ($_GET['propData'] as $key => $value) {
					$propData[$key] = addslashes($value);
				}
			} else {
				$propData = addslashes($_GET['propData']);
			}
			$result = query_DB("DELETE FROM properties WHERE id='{$propData['id']}'");
			$data = getUserData('id', $propData['uid']);
			$to = [
				'email' => $data['email'],
				'name' => ($data['firstname'].' '.$data['surname'])
			];
			$from = $mailUser;
			$subject = 'Property removed';
			$message = <<<END
Hello {$to['name']},

Your property {$propData['name']} has been removed by the admin.
If you think this was in error please contact the admin ASAP.

Regards,
The PropView Team.
END;
			print_r($to);
			print_r($from);
			echo $subject . '\n\n' . $message;
			email($to, $from, $subject, $message);
			break;
	}
