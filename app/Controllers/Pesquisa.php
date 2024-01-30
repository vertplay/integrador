<?php

namespace App\Controllers;

use App\Models\MainModel;
use CodeIgniter\Controller;

class Pesquisa extends Controller {

    public function index() {
        $termoPesquisa = $this->request->getGet('termo_pesquisa');
        $mainModel = new MainModel(); 
        $dados['termoPesquisa'] = $termoPesquisa; 
        $dados['resultados'] = $mainModel->pesquisar($termoPesquisa); 

        return view('resultados_pesquisa', $dados);
    }
}