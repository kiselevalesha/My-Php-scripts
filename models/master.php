<?
include_once('../php-scripts/models/employee.php');
include_once('../php-scripts/models/salon.php');

class Master extends User
{
    public $salon;
    public $employee;

    public $idSpecialization = 0;
    public $strSpecialization = '';
    
    public $idQualification = 0;
    public $strQualification = '';
    
    public $idDepartment = 0;
    public $strDepartment = '';

    public $strUrlAppointment = '';
    public $strUrlAppointmentLower = '';

    
    public function __construct()
    {
        $this->employee = new Employee();
        $this->salon = new Salon();
    }
    
}

?>