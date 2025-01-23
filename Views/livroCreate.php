<?php
include('../Controllers/LivrosController.php');
?>
<!DOCTYPE html>
<html>
<?php include '../Includes/header.php'; ?>
<hr />

<body>
    <h1 class="cadastro_title">Cadastro de Livro</h1>
    <section class="cadastro_Livros">
        <form class="form_livro_create" action="../controllers/LivrosController.php" method="POST" enctype="multipart/form-data">

            <label for="title">Título:</label>
            <input type="text" id="title" name="titulo" required><br><br>

            <label for="description">Descrição:</label>
            <textarea id="description" name="descricao" required></textarea><br><br>

            <label for="price">Preço:</label>
            <input type="number" id="price" name="preco" step="0.01" required><br><br>

            <label for="imagem">Imagem:</label>
            <input type="file" id="imagem" name="imagem" accept="image/*" required><br><br>

            <input type="submit" class="botao_create" value="Create Product">

        </form>
    </section>
    <section class="listagemLivros">
        <?php 
         $books = getAll();
         echo '<table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Título</th>
                        <th>Ativo?</th>
                        <th>Editar</th>
                        <th>Ativar / Desativar</th>
                    </tr>
                </thead>
                <tbody>';
         while ($book = $books->fetch_assoc()):
             echo  '<tr>
                        <td>'.$book['productId'].'</td>
                        <td>'.$book['productName'].'</td>
                        <td>'.($book['isActive']==1? "Sim": "Não").'</td>
                        <td>Editar</td>
                        <td>'.($book['isActive']==1? "Desativar": "Ativar").'</td>
                    </tr>';
         endwhile;
         echo ' </tbody>
               </table>'
        ?>
    </section>
   
    <hr />
    <footer class="rodape">
        <h2 class="rodape__titulo">Grupo B.LANA</h2>
    </footer>
</body>

</html>