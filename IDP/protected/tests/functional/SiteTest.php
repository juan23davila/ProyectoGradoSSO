<?php

class SiteTest extends WebTestCase {
   
    
    public function testLoginLogout() {
        $this->open('/index.php/site/login');
      
        $this->assertElementPresent('name=LoginForm[username]');
        $this->type('name=LoginForm[username]', 'anfho');
         $this->click("//input[@name='yt0' and @value='Login']");
        $this->waitForTextPresent('Password cannot be blank.');
        $this->type('name=LoginForm[password]', 'anfho');
        $this->clickAndWait("//input[@value='Login']");
      
        // test logout process
        //$this->assertTextNotPresent('Login');
        $this->clickAndWait('link=Logout (anfho)');
        $this->assertElementPresent('name=LoginForm[username]');
       // $this->assertTextPresent('Login');
    }
    
    public function testRegistroUsuario(){
        //TODO
    }
    
    public function testModificacionUsuario(){
        //TODO
    }
    
    
    


}
