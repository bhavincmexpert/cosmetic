<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);

class Notification extends CI_Controller {

	public function index()
	{
		$this->load->view('notification');
	}

	public function add()
	{
		$this->load->view('notification_profile');
	}

	public function add_update()
	{
		$notication = $_REQUEST['message'];

		$res = $this->db->query("select * from device_token_check");
		$rows = $res->result();

		foreach ($rows as $single_row) {
			$device_os = $single_row->device_os;
			// code for IOS PUSH notification starts here
			if($device_os == 'ios')
			{
				//echo "IOS";
				$device_token_ios = $single_row->device_token;
				// $select_drop_location_data = $this->db->query("select * from device_token_check where user_id='$drop_location_id'");
				// $row_select_drop_location_data = $select_drop_location_data->result();
				// $device_token = $row_select_drop_location_data['0']->device_token;
				// $device_token_ios = $row_select_drop_location_data['0']->device_token;
				// Provide the Host Information.
				//$tHost = 'gateway.sandbox.push.apple.com';
				$tHost = 'gateway.sandbox.push.apple.com';
				$tPort = 2195;
				// Provide the Certificate and Key Data.

				$tCert = 'ck.pem';
				// Provide the Private Key Passphrase (alternatively you can keep this secrete
				// and enter the key manually on the terminal -> remove relevant line from code).
				// Replace XXXXX with your Passphrase
				$tPassphrase = '1234';
				// Provide the Device Identifier (Ensure that the Identifier does not have spaces in it).
				// Replace this token with the token of the iOS device that is to receive the notification.
				//$tToken = 'b3d7a96d5bfc73f96d5bfc73f96d5bfc73f7a06c3b0101296d5bfc73f38311b4';
				$tToken = $device_token_ios;
				//0a32cbcc8464ec05ac3389429813119b6febca1cd567939b2f54892cd1dcb134
				// The message that is to appear on the dialog.
				$tAlert = $notication;
				// The Badge Number for the Application Icon (integer >=0).
				$tBadge = 1;
				// Audible Notification Option.
				$tSound = 'default';
				// The content that is returned by the LiveCode "pushNotificationReceived" message.
				$tPayload = '';
				// Create the message content that is to be sent to the device.
				$tBody['aps'] = array (
					'alert' => $tAlert,
					'badge' => $tBadge,
					'sound' => $tSound,
				);
				$tBody ['payload'] = $tPayload;
				// Encode the body to JSON.
				$tBody = json_encode ($tBody);
				// Create the Socket Stream.
				$tContext = stream_context_create ();
				stream_context_set_option ($tContext, 'ssl', 'local_cert', $tCert);
				// Remove this line if you would like to enter the Private Key Passphrase manually.
				stream_context_set_option ($tContext, 'ssl', 'passphrase', $tPassphrase);
				// Open the Connection to the APNS Server.
				$tSocket = stream_socket_client ('ssl://'.$tHost.':'.$tPort, $error, $errstr, 30, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $tContext);
				// Check if we were able to open a socket.
				if (!$tSocket)
					exit ("APNS Connection Failed: $error $errstr" . PHP_EOL);
				// Build the Binary Notification.
				$tMsg = chr (0) . chr (0) . chr (32) . pack ('H*', $tToken) . pack ('n', strlen ($tBody)) . $tBody;
				// Send the Notification to the Server.
				$tResult = fwrite ($tSocket, $tMsg, strlen ($tMsg));

				// if ($tResult){
				//   //echo 'Delivered Message to APNS' . PHP_EOL;
				//  $response = array();
				//  $response ["success"] = 1;
				//  $output2 = json_encode(array('responsedata' => $response));
				//  echo $output2;
				// }
				// else
				// {
				//  $response = array();
				//  $response ["success"] = 0;
				//  $output2 = json_encode(array('responsedata' => $response));
				//  echo $output2;
				//      //echo 'Could not Deliver Message to APNS' . PHP_EOL;
				// }
				// Close the Connection to the Server.
				fclose ($tSocket);

				// }

			}
			// code for IOS PUSH notification ends here

			// code for Android PUSH notification starts here
			if($device_os == 'android')
			{
				//echo "Android";
				$device_token = $single_row->device_token;
				$api_key = $single_row->device_key;
				$device_token = array($device_token);
				######// push notification code starts here ##########
				//Getting the message
				$message = $notication;

				//Creating a message array
				$msg = array
				(
					'message'   => $message,
					'title'     => 'Message from Simplified Coding',
					'subtitle'  => 'Android Push Notification using GCM Demo',
					'tickerText'    => 'Ticker text here...Ticker text here...Ticker text here',
					'vibrate'   => 1,
					'sound'     => 1

				);

				//Creating a new array fileds and adding the msg array and registration token array here
				$fields = array
				(
					'registration_ids'  => $device_token,
					'data'          => $msg
				);

				//Adding the api key in one more array header
				$headers = array
				(
					'Authorization: key=' . $api_key,
					'Content-Type: application/json'
				);

				//Using curl to perform http request
				$ch = curl_init();
				curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
				curl_setopt( $ch,CURLOPT_POST, true );
				curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
				curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
				curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );

				//Getting the result
				$result = curl_exec($ch );
				curl_close( $ch );

				//Decoding json from result
				$res = json_decode($result);

				//Getting value from success
				$flag = $res->success;

				if($flag == 1){
					$response = array();
					$response ["success"] = 1;
					$response ["message"] = "Push Notification fired...!";
					$output2 = json_encode(array('responsedata' => $response));
					echo $output2;
					redirect(base_url() . 'index.php/notification/index');
				}
				else
				{
					$response = array();
					$response ["success"] = 0;
					$response ["message"] = "Error Push Notification";
					$output2 = json_encode(array('responsedata' => $response));
					echo $output2;
					redirect(base_url() . 'index.php/notification/index');
				}
				// push notification code ends here
			}
			// code for Android PUSH notification ends here
		}
		redirect(base_url() . 'index.php/notification/index');
	}

	public function single_delete_product()
	{
		$ids = $_REQUEST['ids'];

		$this->db->where('id', $ids);
		$this->db->delete('device_token_check');

		ob_get_clean();
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');
		echo json_encode(['status'=>1]);
		exit;
	}

}