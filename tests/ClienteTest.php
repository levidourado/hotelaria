<?php

use PHPUnit\Framework\TestCase;

class ClienteTest extends TestCase
{
    private $pdo;
    private $stmt;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pdo = $this->createMock(PDO::class);

        $this->stmt = $this->createMock(PDOStatement::class);

        $this->pdo->method('prepare')->willReturn($this->stmt);

        $this->stmt->method('execute')->willReturn(true);

        $this->stmt->method('fetchAll')->willReturn([
            ['id' => 1, 'nome' => 'Teste de cadastro', 'telefone' => '71981457192', 'email' => 'leviod.mail@gmail.com', 'cpf' => '123.456.789-09', 'data_de_nascimento' => '1994-08-30']
        ]);

        $this->stmt->method('fetch')->willReturn([
            'id' => 1,
            'nome' => 'Teste de cadastro',
            'telefone' => '71981457192',
            'email' => 'leviod.mail@gmail.com',
            'cpf' => '123.456.789-09',
            'data_de_nascimento' => '1994-08-30'
        ]);
    }

    public function testCreateCliente()
    {
        $this->stmt->expects($this->once())->method('execute')->with($this->equalTo(['Teste de cadastro', '71981457192', 'teste@teste.com', '123.456.789-09', '1994-08-30']));
        $this->assertTrue($this->stmt->execute(['Teste de cadastro', '71981457192', 'leviod.mail@gmail.com', '123.456.789-09', '1994-08-30']));
    }

    public function testReadCliente()
    {
        $this->stmt->expects($this->once())->method('execute')->with($this->equalTo(['leviod.mail@gmail.com']));
        $this->stmt->expects($this->once())->method('fetch');
        $cliente = $this->stmt->fetch();

        $this->assertNotEmpty($cliente);
        $this->assertEquals('Teste de cadastro', $cliente['nome']);
    }

    public function testUpdateCliente()
    {
        $this->stmt->expects($this->once())->method('execute')->with($this->equalTo(['Teste Alterado', 'teste@teste.com']));
        $this->assertTrue($this->stmt->execute(['Teste Alterado', 'teste@teste.com']));
    }

    public function testDeleteCliente()
    {
        $this->stmt->expects($this->once())->method('execute')->with($this->equalTo(['teste@teste.com']));
        $this->assertTrue($this->stmt->execute(['teste@teste.com']));
    }
}
