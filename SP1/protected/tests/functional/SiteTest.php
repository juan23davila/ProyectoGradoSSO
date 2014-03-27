<?php

class SiteTest extends WebTestCase
{
	
	public function testLoginLogout()
	{
		$this->open('/index.php/');
		// ensure the user is logged out
		if($this->isTextPresent('Logout'))
			$this->clickAndWait('link=Logout (demo)');

		// test login process, including validation
	        $this->clickAndWait('link=Login');
		$this->assertElementPresent('name=f');
		$this->type('name=username','anfho');
		$this->click("//input[@value='Login']");
		$this->waitForTextPresent('Los datos que ha suministrado no son válidos');
		$this->type('name=password','anfho');
		$this->click("//input[@value='Login']");
		$this->waitForTextNotPresent('Los datos que ha suministrado no son válidos');
		$this->waitForTextPresent('Logout (anfho)');

		// test logout process
		$this->assertTextNotPresent('Login');
		$this->clickAndWait('link=Logout (anfho)');
		$this->assertTextPresent('Login');
	}
        
        public function testRecuperarContrasena(){
            $this->open('/index.php/');
            
            if($this->isTextPresent('Logout'))
			$this->clickAndWait('link=Logout (demo)');
            $this->isTextPresent('Login');
            $this->clickAndWait('link=Login');
            $this->waitForTextPresent('Indique su nombre de usuario y clave de acceso');
            $this->clickAndWait('link=Olvidaste tu contraseña? Has click aquí.');
            $this->waitForTextPresent('Recuperar Contraseña');
            $this->type('name=Usuario[correo]','anfho93@gmail.com');
            $this->clickAndWait("//input[@value='Recuperar']");
            $this->waitForTextPresent('Se envio un mensaje al correo electronico con la informacion necesaria para recuperar tu contraseña.'); 
        }
        
}
