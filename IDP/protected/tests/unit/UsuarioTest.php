<?php

class UsuarioTest extends CDbTestCase {

    public $fixtures = array(
        'usuarios' => 'Usuario',
            //'comments'=>'Comment',
    );

    public function testCreate() {
        $usuario = $this->crearUsuario();

        $this->assertTrue($usuario->save(false));
        // verify the comment is in pending status
        $usuario = Usuario::model()->findByPk($usuario->id);
        $this->assertTrue($usuario instanceof Usuario);
        $this->assertEquals(1, $usuario->activo);
        $usuario->delete();
    }
    
    public function testUpdate(){
        $usuario = $this->crearUsuario();
        
        $this->assertTrue($usuario->save(false));
        $usuario1 = Usuario::model()->findByPk($usuario->id);
        $usuario1->apellido='mejia';
        
        $this->assertTrue($usuario1->apellido!=$usuario->apellido);
        
        $usuario1->delete();
        
    }
    
    public function testDelete(){
        $usuario = $this->crearUsuario();
        
        $this->assertTrue($usuario->save(false));
        $usuario->delete();
        $usuario = Usuario::model()->findByPk($usuario->id);
        $this->assertTrue(!($usuario instanceof Usuario));   
        
    }
    
    public function crearUsuario(){
        $usuario = new Usuario;
        $usuario->setAttributes(array(
            'username' => 'comment 1',
            'password' => "123",
            'nombre' => "",
            'apellido' => 'me',
            'correo' => 'me@example.com',
            'direccion' => "asdasdasd",
            'cedula' => '123132',
            'telefono' => '1321',
            'activo' => 1
                ), false);
        return $usuario;
    }

} 
