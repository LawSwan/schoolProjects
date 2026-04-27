<?php
class Role {
    private $roleNo;
    private $roleName;
    
    public function __construct($roleNo, $roleName) {
        $this->roleNo = $roleNo;
        $this->roleName = $roleName;
    }
    
    public function getRoleNo() {
        return $this->roleNo;
    }
    
    public function getRoleName() {
        return $this->roleName;
    }
    
    public function setRoleNo($roleNo) {
        $this->roleNo = $roleNo;
    }
    
    public function setRoleName($roleName) {
        $this->roleName = $roleName;
    }
}
?>
