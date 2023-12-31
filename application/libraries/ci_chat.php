<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ci_chat{

	public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->database();

        //$this->ci->load->model('chat_model');
        if (!isset($_SESSION['chatHistory'])) {
						$_SESSION['chatHistory'] = array();
				}
				if (!isset($_SESSION['openChatBoxes'])) {
						$_SESSION['openChatBoxes'] = array();
				}

		if( isset( $_GET['action'] ) ){
			if ($_GET['action'] == "chatheartbeat") {
				$this->chatHeartbeat();
			}
			if ($_GET['action'] == "sendchat") {
				$this->sendChat();
			}
			if ($_GET['action'] == "closechat") {
				$this->closeChat();
			}
			if ($_GET['action'] == "startchatsession") {
				$this->startChatSession();
			}
			if ($_GET['action'] == "chathistory") {
				$this->chatHistory();
			}
			if ($_GET['action'] == "readchat") {
				$this->readchat();
			}
		}
    }
	/*
	------------
	*/
	function startChatSession() {
		$items = '';
		if (!empty($_SESSION['openChatBoxes'])) {
			foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
				$items .= $this->chatBoxSession($chatbox);
			}
		}
		if ($items != '') {
			$items = substr($items, 0, -1);
		}
		header('Content-type: application/json');
		?>
		{
				"username": "<?php echo $this->ci->session->userdata('nip');?>",
				"from_username": "<?php echo $this->ci->session->userdata('nama');;?>",
				"items": [
					<?php echo $items;?>
		        ]
		}
		<?php
		exit(0);
	}
	/*
	------------
	*/
	function chatBoxSession($chatbox) {
		$items = '';
		if (isset($_SESSION['chatHistory'][$chatbox])) {
			$items = $_SESSION['chatHistory'][$chatbox];
		}else{
			// fetch from database last few records
		}
		return $items;
	}
	/*
	------------
	*/
	function closeChat() {

		// unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);

		echo "1";
		exit(0);
	}
	/*
	------------
	*/
	function sanitize($text) {
		$text = htmlspecialchars($text, ENT_QUOTES);
		$text = str_replace("\n\r","\n",$text);
		$text = str_replace("\r\n","\n",$text);
		$text = str_replace("\n","<br>",$text);
		return $text;
	}
	/*
	--------
	*/

	function sendChat() {
		$from = $this->ci->session->userdata('nip');
		$from_name = $this->ci->session->userdata('nama');
		$to = $_POST['to'];
		$to_name = $_POST['to_name'];
		$message = $_POST['message'];
		$_SESSION['openChatBoxes'][$_POST['to']] = date('Y-m-d H:i:s', time());

		$messagesan = $this->sanitize($message);

		if (!isset($_SESSION['chatHistory'][$_POST['to']])) {
			$_SESSION['chatHistory'][$_POST['to']] = '';
		}
		$d['s'] = '1';
		$d['fname'] = $to_name;
		$d['f'] = $to;
		$d['m'] = $messagesan;
		if($items<>""){$items.=',';}
		$_SESSION['chatHistory'][$_POST['to']] .= json_encode( $d )."\r\n";
		/*$_SESSION['chatHistory'][$_POST['to']] .= <<<EOD
						   {
				"s": "1",
				"f": "{$to}",
				"m": "{$messagesan}"
		   },
	EOD;*/
		unset($_SESSION['tsChatBoxes'][$_POST['to']]);

		$data = array(
		   'from' => $from ,
		   'from_name' => $from_name ,
		   'to_name' => $to_name ,
		   'to' => $to ,
		   'message' => $message,
			 'is_read' => 0,
		);
		$this->ci->db->set('sent', 'NOW()', FALSE);
		$this->ci->db->insert('chat', $data);
		//echo $this->ci->db->last_query();
		echo "1";
		exit(0);
	}

	function readchat() {
		$to = $_POST['to'];
		$sql="UPDATE chat SET is_read=1 WHERE (`from` = '".$to."'  AND  `to` = '".$this->ci->session->userdata('nip')."' ) ";
		$this->ci->db->query($sql);
	}

	function chatHistory(){
		/*
		$this->ci->db->select('*');
		$this->ci->db->where("(`from` = '".$this->ci->session->userdata('nip')."'  AND  `to` = '".$this->ci->input->get('to')."' )");
		$this->ci->db->or_where("(`to` = '".$this->ci->session->userdata('nip')."'  AND  `from` = '".$this->ci->input->get('to')."' )");
		$this->ci->db->order_by('id','ASC' );
		$this->ci->db->order_by('sent','DESC' );
		$this->ci->db->limit(3,0);
		$query = $this->ci->db->get('chat');
		*/
		$sql="SELECT * FROM (
							SELECT * FROM chat
								WHERE (`from` = '".$this->ci->session->userdata('nip')."'  AND  `to` = '".$this->ci->input->get('to')."' ) OR (`to` = '".$this->ci->session->userdata('nip')."'  AND  `from` = '".$this->ci->input->get('to')."' )
							ORDER BY id DESC LIMIT 100
							) last_chat ORDER BY `sent` ASC";
		$query = $this->ci->db->query($sql);
		//echo $this->ci->db->last_query();
		$items='';
		$chatBoxes = array();
		foreach ($query->result_array() as $chat) {
			# code...
			$chat['message'] = $this->sanitize($chat['message']);

			$d = array();
			$d['s'] = '0';
			$d['f'] = "$chat[from]";
			$d['fname'] = "$chat[from_name]";
			$d['m'] = "$chat[message]";
			if($items<>""){$items.=',';}
			$items.=json_encode( $d );
		}
		header('Content-type: application/json');
	?>
{
		"items": [
			<?php echo $items;?>
        ]
}

	<?php
				exit(0);
	} // end function

	function chatHeartbeat() {
		$this->ci->db->select('*');
		$this->ci->db->where('to', $this->ci->session->userdata('nip') );
		$this->ci->db->where('recd',0 );
		$this->ci->db->order_by('id','ASC' );
		$query = $this->ci->db->get('chat');
		$items = '';
		$chatBoxes = array();
		foreach ($query->result_array() as $chat) {
			# code...
			if (!isset($_SESSION['openChatBoxes'][$chat['from']]) && isset($_SESSION['chatHistory'][$chat['from']])) {
				$items = $_SESSION['chatHistory'][$chat['from']];
			}

			$chat['message'] = $this->sanitize($chat['message']);

			$d = array();
			$d['s'] = '0';
			$d['f'] = "$chat[from]";
			$d['fname'] = "$chat[from_name]";
			$d['m'] = "$chat[message]";
			/*$items .= <<<EOD
						   {
				"s": "0",
				"f": "{$chat['from']}",
				"m": "{$chat['message']}"
		   },
	EOD;*/
			if($items<>""){$items.=',';}
			$items.=json_encode( $d );

		if (!isset($_SESSION['chatHistory'][$chat['from']])) {
			$_SESSION['chatHistory'][$chat['from']] = '';
		}
		$ch = array();
		$ch["s"] = "0";
		$ch["f"] = "$chat[from]";
		$ch["fname"] = "$chat[from_name]";
		$ch["m"] = "$chat[message]";
		if($items<>""){$items.=',';}
		$_SESSION['chatHistory'][$chat['from']] .=  json_encode( $ch ) ."\r\n";;
		/*$_SESSION['chatHistory'][$chat['from']] .= <<<EOD
							   {
				"s": "0",
				"f": "{$chat['from']}",
				"m": "{$chat['message']}"
		   },
	EOD;*/

			unset($_SESSION['tsChatBoxes'][$chat['from']]);
			$_SESSION['openChatBoxes'][$chat['from']] = $chat['sent'];
		}

		if (!empty($_SESSION['openChatBoxes'])) {
		foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {
			if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {
				$now = time()-strtotime($time);
				$time = date('g:iA M dS', strtotime($time));

				$message = "Sent at $time";
				if ($now > 180) {

					$d = array();
					$d['s'] = '2';
					$d['f'] = "$chatbox";
					$d['m'] = "$message";
					if($items<>""){$items.=',';}
					$items.= json_encode( $d )."\r\n";
	// 				$items .= <<<EOD
	// {
	// "s": "2",
	// "f": "$chatbox",
	// "m": "{$message}"
	// },
	// EOD;

		if (!isset($_SESSION['chatHistory'][$chatbox])) {
			$_SESSION['chatHistory'][$chatbox] = '';
		}
		$d = array();
		$d['s'] = '2';
		$d['f'] = "$chatbox";
		$d['m'] = "$message";
		if($items<>""){$items.=',';}
		$_SESSION['chatHistory'][$chatbox].= json_encode( $d )."\r\n";
		/*$_SESSION['chatHistory'][$chatbox] .= <<<EOD
			{
	"s": "2",
	"f": "$chatbox",
	"m": "{$message}"
	},
	EOD;*/
				$_SESSION['tsChatBoxes'][$chatbox] = 1;
			}
			}
		}
	}

		$sql = "update chat set recd = 1 where chat.to = '".mysql_real_escape_string($this->ci->session->userdata('nip'))."' and recd = 0";
		$query = mysql_query($sql);

		if ($items != '') {
			$items = substr($items, 0, -1);
		}
	header('Content-type: application/json');
	?>
	{
			"items": [
				<?php echo $items;?>
	        ]
	}

	<?php
				exit(0);
	}
} // end class
