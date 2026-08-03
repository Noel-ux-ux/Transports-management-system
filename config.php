
  <?php
  if (session_status() === PHP_SESSION_NONE) {

session_start();
 }
$host = "localhost";
$user = "root";
$pass = "";
$db = "interface";

$important_cols = [
    'admins' => ['id','Name','email','phone'],
    'clients' => ['id','Name','email','phone'],
    'contacts' => ['id','name','email','phone','status'],
    'services' => ['id','service_Type','name','origin','destination'],
    'transactions' => ['id','clients','Transporter','goods'],
    'transporters' => ['id','Name','email','phone'],
    'yearly_summarry' => ['id','Number_of_Imported_Transaction','Number_of_Exported_Transaction','Number_of_Countries_Reached']
];

$conn = new mysqli($host, $user, $pass, $db);
if($conn->connect_error){ die("DB Error: ".$conn->connect_error); }

// TEMP: auto login as super admin for testing. Replace with real login
$_SESSION['role'] = 'super_admin';
if($_SESSION['role']!= 'super_admin'){ die("Access Denied"); }

$tables = ['admins','clients','contacts','services','transactions','transporters','yearly_summarry'];
?>
