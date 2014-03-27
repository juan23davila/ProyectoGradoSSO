<?php

class SiteTest extends WebTestCase {
   
    
    
    /**
     * Test Correspondiente al proceso de registro de usuario en una BD.
     */
    public function testRegistroUsuario(){
        $this->open('/index.php/usuario/create');
        $this->assertElementPresent('name=LoginForm[username]');
        $this->type('name=LoginForm[username]', 'anfho');
        $this->type('name=LoginForm[password]', 'anfho');
        $this->clickAndWait("//input[@value='Login']");
        $this->waitForTextPresent('Create Usuario');
        //se verifica que ingresen los campos requeridos.
        $this->click("//input[@value='Create']");
        $this->waitForTextPresent('Please fix the following input errors');
        
        $this->type('name=Usuario[username]', 'Godofredo123');
        $this->type('name=Usuario[password]', '123456');
        $this->type('name=Usuario[nombre]', 'Godofredo');
        $this->type('name=Usuario[apellido]', 'Hernandez');
        $this->type('name=Usuario[correo]', 'godo12@hotmail.com');
        $this->type('name=Usuario[direccion]', 'cll 45 # 25 - 36');
        $this->type('name=Usuario[cedula]', '1094925888');
        $this->type('name=Usuario[telefono]', '555-5555');
        $this->clickAndWait("//input[@value='Create']");
        $this->waitForTextPresent('View Usuario');
    }
    
    /**
     * Test Correspondiente al proceso de Login-Logout del IDP
     */
    public function testLoginLogout() {
        
        $this->open('/index.php/site/login');
        $this->assertElementPresent('name=LoginForm[username]');
        $this->type('name=LoginForm[username]', 'anfho');
        $this->click("//input[@name='yt0' and @value='Login']");
        $this->waitForTextPresent('Password cannot be blank.');
        $this->type('name=LoginForm[password]', 'anfho');
        $this->clickAndWait("//input[@value='Login']");
      
        // test logout process       
        $this->clickAndWait('link=Logout (anfho)');
       
    }
    /**
     * 
     */
    public function testModificacionUsuario(){
        $this->open('/index.php/usuario/update/2');
        $this->assertElementPresent('name=LoginForm[username]');
        $this->type('name=LoginForm[username]', 'anfho');     
        $this->type('name=LoginForm[password]', 'anfho');
        $this->clickAndWait("//input[@value='Login']");    
        $this->assertElementPresent('id=usuario-form');
        $this->type('name=Usuario[username]', 'anfho');
        $this->type('name=Usuario[password]', 'anfho');
        $this->type('name=Usuario[apellido]', 'anfho');
        $this->type('name=Usuario[correo]', 'anfho93@gmail.com');
        $this->type('name=Usuario[direccion]', 'CLl 4A');
        $this->type('name=Usuario[cedula]', '123456789');
        $this->type('name=Usuario[telefono]', '3014714343');
        $this->clickAndWait("//input[@name='yt0']");
        $this->waitForTextPresent('View Usuario #2');        
    }
    
    
    /**
     * 
     */
    public function testRecuperarContrasena(){
        //Los datos ingresados son enviados a travez del correo y el usuario ya los debe saber
        $this->open('/index.php/usuario/cambiarContrasena?correo=anfho93@gmail.com');
        $this->assertElementPresent('id=login-form');
        $this->type('id=LoginForm_username', 'anfho');
        $this->type('id=LoginForm_password', 'anfho');
        $this->clickAndWait("//input[@value='Login']");
        $this->waitForTextPresent('Cambiar Contraseña');
        $this->type('name=Usuario[password]', 'pedrino');
        $this->type('name=password', 'pedrina');
        $this->clickAndWait("//input[@name='yt0']");
        $this->waitForTextPresent('Los campos deben coincidir');
        $this->type('name=Usuario[password]', 'anfho');
        $this->type('name=password', 'anfho');
        $this->clickAndWait("//input[@name='yt0']");
        $this->waitForTextPresent('Tu contraseña fue modificada');
    }
    
    /**
     * Esta prueba valida la informacion para recuperar contrasenia
     * la que se encarga de enviar dos correos y esperar mensajes
     * previamente determinados.
     */
    public function testCambiarContrasena(){
        $this->open('/index.php/usuario/recuperarContrasena');
        $this->assertElementPresent('id=recuperarForm');
        //se ingresa un correo inexistente
        $this->type('id=Usuario[correo]', 'carelomio@gmail.com');
        $this->clickAndWait("//input[@value='Recuperar']");
        $this->waitForTextPresent('No eres un usuario de este proveedor de identidad.');
        //El siguiente debe ser un usuario valido
        $this->type('id=Usuario[correo]', 'anfho93@gmail.com');
        $this->clickAndWait("//input[@value='Recuperar']");
        $this->waitForTextPresent('Se envio un mensaje al correo electronico con la informacion necesaria para recuperar tu contraseña.');
    }   
}

