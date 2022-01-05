<?php

use yii\db\Migration;

/**
 * Class m211013_084803_init_rbac
 */
class m211013_084803_init_rbac extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

        $auth = Yii::$app->authManager;


        $adicionarGestor = $auth->createPermission('adicionarGestor');
        $adicionarGestor->description = 'Adicionar Gestor';
        $auth->add($adicionarGestor);

        $editarGestor = $auth->createPermission('editarGestor');
        $editarGestor->description = 'Editar Gestor';
        $auth->add($editarGestor);

        $apagarGestor = $auth->createPermission('apagarGestor');
        $apagarGestor->description = 'Apagar Gestor';
        $auth->add($apagarGestor);

        $bloquearCliente = $auth->createPermission('bloquearCliente');
        $bloquearCliente->description = 'Bloquear Cliente';
        $auth->add($bloquearCliente);

        //meter aqui comentarios para dizer a que requisito diz respeito
        $desbloquearCliente = $auth->createPermission('desbloquearCliente');
        $desbloquearCliente->description = 'Desbloquear Cliente';
        $auth->add($desbloquearCliente);

        $adicionarProdutos = $auth->createPermission('adicionarProdutos');
        $adicionarProdutos->description = 'Adicionar Produtos';
        $auth->add($adicionarProdutos);

        $adicionarProdutosFavoritos = $auth->createPermission('adicionarProdutosFavoritos');
        $adicionarProdutosFavoritos->description = 'Adicionar Produtos aos Favoritos';
        $auth->add($adicionarProdutosFavoritos);

        $encomendarProdutos = $auth->createPermission('encomendarProdutos');
        $encomendarProdutos->description = 'Encomendar Produtos';
        $auth->add($encomendarProdutos);

        $adicinarProdutosAoCarrinho = $auth->createPermission('adicinarProdutosAoCarrinho');
        $adicinarProdutosAoCarrinho->description = 'Adicionar Produtos ao Carinnho';
        $auth->add($adicinarProdutosAoCarrinho);

        $pesquisarProdutos = $auth->createPermission('pesquisarProdutos');
        $pesquisarProdutos->description = 'Pesquisar Produtos';
        $auth->add($pesquisarProdutos);

        $visualizarProdutos = $auth->createPermission('visualizarProdutos');
        $visualizarProdutos->description = 'Visualizar Produtos';
        $auth->add($visualizarProdutos);

        $criarModelo = $auth->createPermission('criarModelo');
        $criarModelo->description = 'Criar Modelo';
        $auth->add($criarModelo);

        $criarDesconto = $auth->createPermission('criarDesconto');
        $criarDesconto->description = 'Criar Desconto';
        $auth->add($criarDesconto);

        $apagarDesconto = $auth->createPermission('apagarDesconto');
        $apagarDesconto->description = 'Apagar Desconto';
        $auth->add($apagarDesconto);

        $visualizarDesconto = $auth->createPermission('visualizarDesconto');
        $visualizarDesconto->description = 'Visualizar Desconto';
        $auth->add($visualizarDesconto);

        $visualizarEncomendas = $auth->createPermission('visualizarEncomendas');
        $visualizarEncomendas->description = 'Visualizar Encomendas';
        $auth->add($visualizarEncomendas);

        $atualizarEncomendas = $auth->createPermission('atualizarEncomendas');
        $atualizarEncomendas->description = 'Atualizar Encomendas';
        $auth->add($atualizarEncomendas);

        $editarPerfil = $auth->createPermission('editarPerfil');
        $editarPerfil->description = 'Editar Perfil';
        $auth->add($editarPerfil);

        $eliminarFavoritos = $auth->createPermission('eliminarFavoritos');
        $eliminarFavoritos->description = 'Eliminar Favoritos';
        $auth->add($eliminarFavoritos);

        $visualizarFavoritos = $auth->createPermission('visualizarFavoritos');
        $visualizarFavoritos->description = 'Visualizar Favoritos';
        $auth->add($visualizarFavoritos);


        $eliminarProdutosAoCarrinho = $auth->createPermission('eliminarProdutosAoCarrinho');
        $eliminarProdutosAoCarrinho->description = 'Eliminar Produtos ao Carinnho';
        $auth->add($eliminarProdutosAoCarrinho);


        $cliente = $auth->createRole('cliente');
        $auth->add($cliente);
        $auth->addChild($cliente, $pesquisarProdutos);
        $auth->addChild($cliente, $encomendarProdutos);
        $auth->addChild($cliente, $adicinarProdutosAoCarrinho);
        $auth->addChild($cliente, $adicionarProdutosFavoritos);
        $auth->addChild($cliente, $visualizarProdutos);
        $auth->addChild($cliente, $visualizarEncomendas);
        $auth->addChild($cliente, $editarPerfil);
        $auth->addChild($cliente, $eliminarFavoritos);
        $auth->addChild($cliente, $visualizarFavoritos);
        $auth->addChild($cliente, $eliminarProdutosAoCarrinho);
        $auth->addChild($cliente, $visualizarDesconto);


        $gestorStock = $auth->createRole('gestorStock');
        $auth->add($gestorStock);
        $auth->addChild($gestorStock, $adicionarProdutos);
        $auth->addChild($gestorStock, $criarModelo);
        $auth->addChild($gestorStock, $criarDesconto);
        $auth->addChild($gestorStock, $apagarDesconto);
        $auth->addChild($gestorStock, $visualizarEncomendas);
        $auth->addChild($gestorStock, $atualizarEncomendas);
        $auth->addChild($gestorStock, $visualizarDesconto);
        $auth->addChild($gestorStock, $pesquisarProdutos);
        $auth->addChild($gestorStock, $visualizarProdutos);


        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $adicionarGestor);
        $auth->addChild($admin, $editarGestor);
        $auth->addChild($admin, $apagarGestor);
        $auth->addChild($admin, $bloquearCliente);
        $auth->addChild($admin, $desbloquearCliente);


        $auth->assign($admin, 1);
    }



    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

}
