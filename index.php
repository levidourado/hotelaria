<?php
include 'src/php_files/db.php';

$sql = "SELECT * FROM clientes";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotelaria</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h2>Hotelaria</h2>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Novo Cliente</button>
        <br><br>

        <table class="table" id="clientesTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>Data de Nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td>
                            <?php echo $cliente['id']; ?>
                        </td>
                        <td>
                            <?php echo $cliente['nome']; ?>
                        </td>
                        <td>
                            <?php
                            $telefone = $cliente['telefone'];
                            $telefone_formatado = strlen($telefone) === 11 ? preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $telefone) : preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $telefone);
                            echo $telefone_formatado;
                            ?>
                        </td>
                        <td>
                            <?php echo $cliente['email']; ?>
                        </td>
                        <td>
                            <?php echo $cliente['cpf']; ?>
                        </td>
                        <td>
                            <?php echo date('d/m/Y', strtotime($cliente['data_de_nascimento'])); ?>
                        </td>
                        <td>
                            <button class="btn btn-primary btn-edit" data-id="<?php echo $cliente['id']; ?>"
                                data-nome="<?php echo $cliente['nome']; ?>"
                                data-telefone="<?php echo $cliente['telefone']; ?>"
                                data-email="<?php echo $cliente['email']; ?>" data-cpf="<?php echo $cliente['cpf']; ?>"
                                data-data_de_nascimento="<?php echo date('d/m/Y', strtotime($cliente['data_de_nascimento'])); ?>">Editar</button>

                            <button class="btn btn-danger btn-delete"
                                data-id="<?php echo $cliente['id']; ?>">Excluir</button>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para edição de clientes -->
    <div class="modal" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="src/php_files/update.php" method="post">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="form-group">
                            <label for="edit-nome">Nome:</label>
                            <input type="text" class="form-control" id="edit-nome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-telefone">Telefone:</label>
                            <input type="text" class="form-control" id="edit-telefone" name="telefone" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-email">Email:</label>
                            <input type="email" class="form-control" id="edit-email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-cpf">CPF:</label>
                            <input type="text" class="form-control" id="edit-cpf" name="cpf" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-data_de_nascimento">Data de Nascimento:</label>
                            <input type="text" class="form-control" id="edit-data_de_nascimento"
                                name="data_de_nascimento" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para adição de clientes -->
    <div class="modal" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="addForm" action="src/php_files/create.php" method="post">
                        <div class="form-group">
                            <label for="add-nome">Nome:</label>
                            <input type="text" class="form-control" id="add-nome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="add-telefone">Telefone:</label>
                            <input type="text" class="form-control" id="add-telefone" name="telefone" required>
                        </div>
                        <div class="form-group">
                            <label for="add-email">Email:</label>
                            <input type="email" class="form-control" id="add-email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="add-cpf">CPF:</label>
                            <input type="text" class="form-control" id="add-cpf" name="cpf" required>
                        </div>
                        <div class="form-group">
                            <label for="add-data_de_nascimento">Data de Nascimento:</label>
                            <input type="text" class="form-control" id="add-data_de_nascimento"
                                name="data_de_nascimento" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validaCPF(cpf) {
            cpf = cpf.replace(/[^\d]+/g, '');
            if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;

            let soma = 0;
            let resto;

            for (let i = 1; i <= 9; i++) {
                soma += parseInt(cpf.charAt(i - 1)) * (11 - i);
            }
            resto = (soma * 10) % 11;

            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.charAt(9))) return false;

            soma = 0;
            for (let i = 1; i <= 10; i++) {
                soma += parseInt(cpf.charAt(i - 1)) * (12 - i);
            }
            resto = (soma * 10) % 11;

            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.charAt(10))) return false;

            return true;
        }

        $(document).ready(function () {
            $('#add-cpf').mask('000.000.000-00', { reverse: true });
            $('#add-data_de_nascimento').mask('00/00/0000');

            $('#edit-cpf').mask('000.000.000-00', { reverse: true });
            $('#edit-data_de_nascimento').mask('00/00/0000');

            $('#add-telefone, #edit-telefone').mask('(00) 0000-00009').ready(function (event) {
                var target, phone, element;
                target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                phone = target.value.replace(/\D/g, '');
                element = $(target);
                element.unmask();
                if (phone.length > 10) {
                    element.mask('(00) 00000-0000');
                } else {
                    element.mask('(00) 0000-00009');
                }
            });

            $('#addForm').submit(function (e) {
                e.preventDefault();
                var cpf = $('#add-cpf').cleanVal();
                if (!validaCPF(cpf)) {
                    alert('CPF inválido.');
                    return;
                }
                var formData = $(this).serialize();
                $.post($(this).attr('action'), formData).done(function (data) {
                    location.reload();
                }).fail(function () {
                    alert("Houve um erro ao adicionar o cliente.");
                });
            });

            $('#clientesTable').on('click', '.btn-edit', function () {
                var id = $(this).data('id');
                var nome = $(this).data('nome');
                var telefone = $(this).data('telefone');
                var email = $(this).data('email');
                var cpf = $(this).data('cpf');
                var data_de_nascimento = $(this).data('data_de_nascimento');

                $('#edit-id').val(id);
                $('#edit-nome').val(nome);
                $('#edit-telefone').val(telefone);
                $('#edit-email').val(email);
                $('#edit-cpf').val(cpf);
                $('#edit-data_de_nascimento').val(data_de_nascimento);

                $('#editModal').modal('show');
            });

            $('#editForm').submit(function (e) {
                e.preventDefault();

                var cpf = $('#edit-cpf').cleanVal();
                var telefone = $('#edit-telefone').cleanVal();
                var dataDeNascimento = $('#edit-data_de_nascimento').val().split('/').reverse().join('-');

                if (!validaCPF(cpf)) {
                    alert('CPF inválido.');
                    return;
                }

                var formData = $(this).serialize() + '&cpf=' + cpf + '&telefone=' + telefone + '&data_de_nascimento=' + dataDeNascimento;

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    dataType: 'json', // Expect a JSON response
                    success: function (response) {
                        if (response.success) {
                            $('#editModal').modal('hide');
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function (xhr) {
                        // Se a resposta não for JSON, ela será tratada aqui
                        var errorText = xhr.responseText;
                        // Tenta fazer o parse do erro para obter a mensagem se for JSON
                        try {
                            var errorJSON = JSON.parse(errorText);
                            alert(errorJSON.message);
                        } catch (e) {
                            // Se não for JSON, apenas mostra o texto do erro
                            alert("Erro ao atualizar o cliente: " + errorText);
                        }
                    }
                });
            });



            $('#clientesTable').on('click', '.btn-delete', function () {
                var id = $(this).data('id');
                if (confirm('Você tem certeza que quer excluir este cliente?')) {
                    $.post('src/php_files/delete.php', { id: id }).done(function (data) {
                        location.reload();
                    }).fail(function () {
                        alert("Erro ao excluir cliente.");
                    });
                }
            });
        });
    </script>
</body>

</html>