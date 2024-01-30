<?php

namespace App\Models;

use CodeIgniter\Model;

class AvaliacaoModel extends Model {
    
    protected $table = 'avalia_avaliacao';
    protected $allowedFields = ['ID_usuario', 'ID_clinica', 'Texto_avaliacao', 'Nota_avaliacao'];

    public function getComentariosPorClinica($ID_clinica)
    {
        return $this->select('Usuario.Nome_usuario, avalia_avaliacao.Texto_avaliacao, avalia_avaliacao.Nota_avaliacao')
            ->join('Usuario', 'Usuario.ID_usuario = avalia_avaliacao.ID_usuario')
            ->where('avalia_avaliacao.ID_clinica', $ID_clinica)
            ->findAll();
    }

    public function inserirAvaliacao($data) {

        $this->insert($data);
    }
}
