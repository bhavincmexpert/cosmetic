<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);

class Webservice extends CI_Controller
{
    function login()
    {
        if (isset($_REQUEST['email']) && isset($_REQUEST['password'])) {

            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];

            $result_login = $this->db->query("select * from user where email='$email' AND password='$password' AND status != '9'");
            $row_login = $result_login->result();

            if ($result_login->num_rows > 0) {

                $data ["success"] = 1;
                $data ["message"] = "Login successful";

                foreach ($row_login as $row) {

                    $data['id'] = $row->id;
                    $data['name'] = $row->name;
                    $data['email'] = $row->email;
                    $data['password'] = $row->password;
                    $data['phone_no'] = $row->phone_no;
                    $data['status'] = $row->status;
                    $data['dt_added'] = $row->dt_added;
                    $data['dt_updated'] = $row->dt_updated;
                }
                $output = json_encode(array('responsedata' => $data));
                echo $output;
            } else {

                $response = array();
                $response ["success"] = 0;
                $response ["message"] = "Invalid email or password";
                $output = json_encode(array('responsedata' => $response));
                echo $output;
            }
        } else {

            $response = array();
            $response ["success"] = 0;
            $response ["message"] = "Error";
            $output = json_encode(array('responsedata' => $response));
            echo $output;
        }

    }

    function registration()
    {
        if (isset($_REQUEST['name']) && isset($_REQUEST['email']) && isset($_REQUEST['password']) && isset($_REQUEST['phone_no'])) {

            $name = $_REQUEST['name'];
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];
            $phone_no = $_REQUEST['phone_no'];

            $email_query = $this->db->query("SELECT * FROM user WHERE email = '$email'");

            if($email_query->num_rows > 0){

                $response = array();
                $response ["success"] = 0;
                $response ["message"] = "Email already registered";
                $output_email = json_encode(array('responsedata' => $response));
                echo $output_email;
            }else{

                $data = array(

                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'phone_no' =>  $phone_no,
                    'status' => '1',
                    'dt_added' => strtotime(date('Y-m-d H:i:s')),
                    'dt_updated' => strtotime(date('Y-m-d H:i:s'))
                );
                $insert_data = $this->db->insert('user', $data);

                if ($insert_data) {
                    $response = array();
                    $response ["success"] = 1;
                    $response ["message"] = "User added successfully";
                    $output = json_encode(array('responsedata' => $response));
                    echo $output;

                } else {
                    $response = array();
                    $response ["success"] = 0;
                    $response ["message"] = "Error.";
                    $output = json_encode(array('responsedata' => $response));
                    echo $output;
                }
            }

        } else {
            $response = array();
            $response ["success"] = 0;
            $response ["message"] = "Error.";
            $output = json_encode(array('responsedata' => $response));
            echo $output;
        }
    }

    function edit_user()
    {
        if (isset($_REQUEST['email']) && isset($_REQUEST['name']) && isset($_REQUEST['phone_no'])) {

            $name = $_REQUEST['name'];
            $email = $_REQUEST['email'];
            $phone_no = $_REQUEST['phone_no'];

            $result_login = $this->db->query("select * from user WHERE email='$email' AND status != '9'");
            $row_login = $result_login->result();

            if ($result_login->num_rows > 0) {

                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'phone_no' => $phone_no,
                    'dt_updated' => strtotime(date('Y-m-d H:i:s'))
                );
                $this->db->where('email', $email);
                $update_data = $this->db->update('user', $data);

                if ($update_data) {

                    $response = array();
                    $response ["success"] = 1;
                    $response ["message"] = "User details updated successfully";
                    $output = json_encode(array('responsedata' => $response));
                    echo $output;
                } else {

                    $response = array();
                    $response ["success"] = 0;
                    $response ["message"] = "Error";
                    $output = json_encode(array('responsedata' => $response));
                    echo $output;
                }
            }else{

                $response = array();
                $response ["success"] = 0;
                $response ["message"] = "Email is not registered";
                $output = json_encode(array('responsedata' => $response));
                echo $output;
            }
        } else {

            $response = array();
            $response ["success"] = 0;
            $response ["message"] = "Error";
            $output = json_encode(array('responsedata' => $response));
            echo $output;
        }
    }

    /*public function add_service()
    {
        if (isset($_REQUEST['name']) && isset($_REQUEST['image'])) {

            $name = $_REQUEST['name'];
            $image = time().$_REQUEST['image'];

            $gun_image_name = time().$_FILES['image']['name'];
            $config['upload_path'] = './public/images/service/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $gun_image_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->set_allowed_types('*');
            $data['upload_data'] = '';

            if (!$this->upload->do_upload('gun_image')) {
                $data = array('msg' => $this->upload->display_errors());
            } else {
                $data['upload_data'] = $this->upload->data();
            }

            $data = array(

                'name' => $name,
                'image' => $image,
                'status' => '1',
                'dt_added' => strtotime(date('Y-m-d H:i:d')),
                'dt_updated' => strtotime(date('Y-m-d H:i:d'))
            );
            $insert_data = $this->db->insert('services', $data);
            if ($insert_data) {

                $response = array();
                $response ["success"] = 1;
                $response ["message"] = "Service added successful";
                $output = json_encode(array('responsedata' => $response));
                echo $output;
            } else {

                $response = array();
                $response ["success"] = 0;
                $response ["message"] = "Error";
                $output = json_encode(array('responsedata' => $response));
                echo $output;
            }
        }else{

            $response = array();
            $response ["success"] = 0;
            $response ["message"] = "Error";
            $output = json_encode(array('responsedata' => $response));
            echo $output;
        }
    }

    public function update_service()
    {
        if (isset($_REQUEST['name']) && isset($_REQUEST['image']) && isset($_REQUEST['id'])) {

            $id = $_REQUEST['id'];
            $name = $_REQUEST['name'];
            $image = time().$_REQUEST['image'];

            $gun_image_name = time().$_FILES['image']['name'];
            $config['upload_path'] = './public/images/service/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $gun_image_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->set_allowed_types('*');
            $data['upload_data'] = '';
            $data['upload_data'] = $this->upload->data();

            $data = array(

                'name' => $name,
                'image' => $image,
                'dt_updated' => strtotime(date('Y-m-d H:i:d'))
            );

            $this->db->where('id', $id);
            $update_data = $this->db->update('services', $data);

            if ($update_data) {

                $response = array();
                $response ["success"] = 1;
                $response ["message"] = "Service updated successful";
                $output = json_encode(array('responsedata' => $response));
                echo $output;
            } else {

                $response = array();
                $response ["success"] = 0;
                $response ["message"] = "Error";
                $output = json_encode(array('responsedata' => $response));
                echo $output;
            }
        }else{

            $response = array();
            $response ["success"] = 0;
            $response ["message"] = "Error";
            $output = json_encode(array('responsedata' => $response));
            echo $output;
        }
    }*/

    public function service_list()
    {
        $query = $this->db->query("SELECT * FROM services WHERE status != '9'");
        $result = $query->result();

        $response['success'] = "1";
        $response['message'] = "Service list";
        $response["data"] = array();
        $counter = 0;

        foreach($result as $row)
        {
            $data = array();
            $data['id'] = $row->id;
            $data['name'] = $row->name;
            $data['image'] = base_url().'public/images/service/'.$row->image;
            $data['status'] = $row->status;
            $data['dt_added'] = $row->dt_added;
            $data['dt_updated'] = $row->dt_updated;
            array_push($response["data"], $data);
            $counter++;
        }
        echo $output = json_encode(array('responsedata' => $response));
    }

    public function academy_list(){

        $query = $this->db->query("SELECT * FROM setting WHERE type = '1' AND status != '9'");
        $result = $query->result();

        $response['success'] = "1";
        $response['message'] = "Academy list";
        $response["data"] = array();
        $counter = 0;

        foreach($result as $row)
        {
            $data = array();
            $data['id'] = $row->id;
            $data['description'] = $row->description;
            $data['status'] = $row->status;
            $data['dt_added'] = $row->dt_added;
            $data['dt_updated'] = $row->dt_updated;
            array_push($response["data"], $data);
            $counter++;
        }
        echo $output = json_encode(array('responsedata' => $response));
    }

    public function news_list(){

        $query = $this->db->query("SELECT * FROM setting WHERE type = '2' AND status != '9'");
        $result = $query->result();

        $response['success'] = "1";
        $response['message'] = "News list";
        $response["data"] = array();
        $counter = 0;

        foreach($result as $row)
        {
            $data = array();
            $data['id'] = $row->id;
            $data['image'] = base_url().'public/images/news/'.$row->image;
            $data['description'] = $row->description;
            $data['status'] = $row->status;
            $data['dt_added'] = $row->dt_added;
            $data['dt_updated'] = $row->dt_updated;
            array_push($response["data"], $data);
            $counter++;
        }
        echo $output = json_encode(array('responsedata' => $response));
    }

    public function promo_list(){

        $query = $this->db->query("SELECT * FROM setting WHERE type = '3' AND status != '9'");
        $result = $query->result();

        $response['success'] = "1";
        $response['message'] = "Promo list";
        $response["data"] = array();
        $counter = 0;

        foreach($result as $row)
        {
            $data = array();
            $data['id'] = $row->id;
            $data['image'] = base_url().'public/images/promo/'.$row->image;
            $data['description'] = $row->description;
            $data['status'] = $row->status;
            $data['dt_added'] = $row->dt_added;
            $data['dt_updated'] = $row->dt_updated;
            array_push($response["data"], $data);
            $counter++;
        }
        echo $output = json_encode(array('responsedata' => $response));
    }

    public function add_appointment(){

        if(isset($_REQUEST['name']) && isset($_REQUEST['email']) && isset($_REQUEST['phone_no']) && isset($_REQUEST['date']) && isset($_REQUEST['time']) && isset($_REQUEST['service_id'])){

            $id = $_REQUEST['user_id'];
            $name = $_REQUEST['name'];
            $email = $_REQUEST['email'];
            $phone_no = $_REQUEST['phone_no'];
            $date = $_REQUEST['date'];
            $time = $_REQUEST['time'];
            $service_id = $_REQUEST['service_id'];

            if($id){
                $data = array(
                    'user_id' => $id,
                    'service_id' => $service_id,
                    'name' => $name,
                    'email' => $email,
                    'phone_no' => $phone_no,
                    'date' => $date,
                    'time' => $time,
                    'status' => '1',
                    'dt_added' => strtotime(date('Y-m-d H:i:s')),
                    'dt_updated' => strtotime(date('Y-m-d H:i:s'))
                );
            }else{
                $data = array(
                    'service_id' => $service_id,
                    'name' => $name,
                    'email' => $email,
                    'phone_no' => $phone_no,
                    'date' => $date,
                    'time' => $time,
                    'status' => '1',
                    'dt_added' => strtotime(date('Y-m-d H:i:s')),
                    'dt_updated' => strtotime(date('Y-m-d H:i:s'))
                );
            }
            $insert_data = $this->db->insert('appointment', $data);
            if($insert_data){

                $response = array();
                $response ["success"] = 1;
                $response ["message"] = "Appointment booked successful";
                $output = json_encode(array('responsedata' => $response));
                echo $output;
            }else{

                $response = array();
                $response ["success"] = 0;
                $response ["message"] = "Error";
                $output = json_encode(array('responsedata' => $response));
                echo $output;
            }
        }
        else{

            $response = array();
            $response ["success"] = 0;
            $response ["message"] = "Error";
            $output = json_encode(array('responsedata' => $response));
            echo $output;
        }
    }

    /*public function update_appointment(){

        if(isset($_REQUEST['name']) && isset($_REQUEST['email']) && isset($_REQUEST['phone_no']) && isset($_REQUEST['date']) && isset($_REQUEST['time']) && isset($_REQUEST['service_id']) && isset($_REQUEST['id'])){

            $id = $_REQUEST['id'];
            $user_id = $_REQUEST['user_id'];
            $service_id = $_REQUEST['service_id'];
            $name = $_REQUEST['name'];
            $email = $_REQUEST['email'];
            $phone_no = $_REQUEST['phone_no'];
            $date = $_REQUEST['date'];
            $time = $_REQUEST['time'];

            if($id){
                $data = array(
                    'user_id' => $user_id,
                    'service_id' => $service_id,
                    'name' => $name,
                    'email' => $email,
                    'phone_no' => $phone_no,
                    'date' => $date,
                    'time' => $time,
                    'status' => '1',
                    'dt_updated' => strtotime(date('Y-m-d H:i:s'))
                );
            }else{
                $data = array(
                    'service_id' => $service_id,
                    'name' => $name,
                    'email' => $email,
                    'phone_no' => $phone_no,
                    'date' => $date,
                    'time' => $time,
                    'status' => '1',
                    'dt_updated' => strtotime(date('Y-m-d H:i:s'))
                );
            }
            $this->db->where('id', $id);
            $update_data = $this->db->update('appointment', $data);

            if($update_data){

                $response = array();
                $response ["success"] = 1;
                $response ["message"] = "Appointment updated";
                $output = json_encode(array('responsedata' => $response));
                echo $output;
            }else{

                $response = array();
                $response ["success"] = 0;
                $response ["message"] = "Error";
                $output = json_encode(array('responsedata' => $response));
                echo $output;
            }
        }
        else{

            $response = array();
            $response ["success"] = 0;
            $response ["message"] = "Error";
            $output = json_encode(array('responsedata' => $response));
            echo $output;
        }
    }

    public function delete_appointment(){

        if(isset($_REQUEST['id'])){

            $id = $_REQUEST['id'];
            $this->db->query("DELETE FROM appointment WHERE id = '$id'");

            $response = array();
            $response ["success"] = 1;
            $response ["message"] = "Appointment deleted successful";
            $output = json_encode(array('responsedata' => $response));
            echo $output;
        }
        else{

            $response = array();
            $response ["success"] = 0;
            $response ["message"] = "Error";
            $output = json_encode(array('responsedata' => $response));
            echo $output;
        }
    }*/

    public function haircut_nail_list(){

        $query = $this->db->query("SELECT * FROM setting WHERE type = '4' AND status != '9'");
        $result = $query->result();

        $haircut_nail_id = $result[0]->id;

        $image_query = $this->db->query("SELECT * FROM image WHERE haircutnail_id = '$haircut_nail_id' AND status != '9'");
        $image_result = $image_query->result();

        foreach ($image_result as $term){

            $data = array(
                'id' => $term->id,
                'haircutnail_id' => $term->haircutnail_id,
                'name' => base_url().'public/images/haircut_nail/'.$term->name
            );
            $image_arr[]=$data;
        }
        $image_array = $image_arr;

        $response['success'] = "1";
        $response['message'] = "Haircut & Nail list";
        $response["data"] = array();
        $counter = 0;

        foreach($result as $row)
        {
            $data = array();
            $data['id'] = $row->id;
            $data['description'] = $row->description;
            $data['status'] = $row->status;
            $data['dt_added'] = $row->dt_added;
            $data['dt_updated'] = $row->dt_updated;
            $data['image_list'] = $image_array;
            array_push($response["data"], $data);
            $counter++;
        }
        echo $output = json_encode(array('responsedata' => $response));
    }

    public function fire_pushnotification_all()
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
                }
                else
                {
                    $response = array();
                    $response ["success"] = 0;
                    $response ["message"] = "Error Push Notification";
                    $output2 = json_encode(array('responsedata' => $response));
                    echo $output2;
                }
                // push notification code ends here
            }
            // code for Android PUSH notification ends here
        }
    }
}