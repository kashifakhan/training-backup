<?php
	 class mysql{
		private $connection	= FALSE;
		private $dbhost;
		private $dbuser;
		private $dbpass;
		private $dbname;
		private $last_result	= FALSE;
		public $fatal_error	= FALSE;
		private $debug_mode	= FALSE;
		private $debug_info	= FALSE;
		private $ext;
		public $disconnect_on_descruct;

		
			
			public function __construct($host,$user,$pass,$name_db)
			{
				$this->dbhost=$host;
				$this->dbname=$name_db;
				$this->dbuser=$user;
				$this->dbpass=$pass;
				$this->debug_mode=$GLOBALS['C']->DEBUG_MODE;
					if( ! isset($GLOBALS['MYSQL_DEBUG_INFO']) )
					 {
						$GLOBALS['MYSQL_DEBUG_INFO']	= (object) array('queries'=>array(), 'time'=>0);
					 }
						$this->debug_info	= & $GLOBALS['MYSQL_DEBUG_INFO'];
						$this->ext	= 'mysql';
					if( isset($GLOBALS['C']) && isset($GLOBALS['C']->DB_MYEXT) && $GLOBALS['C']->DB_MYEXT=='mysqli' && function_exists('mysqli_connect') ) 
					{
						$this->ext	= 'mysqli';
					}
					$this->disconnect_on_descruct	= TRUE;
				
		}
		public function connect()
			{
				$time= microtime(TRUE);
				$this->connection=$this->exe=='mysqli'?mysqli_connect($this->dbhost,$this->dbuser,$this->dbpass,$this->dbname):mysql_connect($this->dbhost,$this->dbuser,$this->dbpass,$this->dbname);
				if($this->connection==False)
				{
					$this->fatal_error("Connect");
				}
				$this->db=$this->exe=='mysqli'?mysqli_select_db($this->connection,$this->dbname):mysql_select_db($this->$connection,$this->dbname);
				if($this->db==False)
				{
					$this->error=
				}
			}
		}
?>