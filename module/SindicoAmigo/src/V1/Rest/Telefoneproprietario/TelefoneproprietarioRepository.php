<?php
/**
 * Created by PhpStorm.
 * User: saulo
 * Date: 31/01/17
 * Time: 12:09
 */

namespace SindicoAmigo\V1\Rest\Telefoneproprietario;


use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbTableGateway;

class TelefoneproprietarioRepository
{

    private $tableGateway;

    /**
     * PessoaRepository constructor.
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    //Retorna todas as pessoas
    public function findAll()
    {
        $tableGateway = $this->tableGateway;
        $paginatorAdapter = new DbTableGateway($tableGateway);
        return new TelefoneproprietarioCollection($paginatorAdapter);
    }

    //Retornando a pessoa pelo id
    public function find($id_telefone_proprietario){
        $resultSet = $this->tableGateway->select(['id_telefone_proprietario' => (int)$id_telefone_proprietario]);
        return $resultSet->current();
    }
    
    //Inserindo o registro
    public function create($data)
    {
        try {
            $this->tableGateway->getAdapter()->getDriver()->getConnection()->beginTransaction();
            $this->tableGateway->insert($data);
            $this->tableGateway->getAdapter()->getDriver()->getConnection()->commit();
            $idTelefoneproprietario = $this->tableGateway->getLastInsertValue();
            return $idTelefoneproprietario;
        } catch (\Exception $e) {
            $this->tableGateway->getAdapter()->getDriver()->getConnection()->rollback();
            return 'error';
        }

    }
    
    public function update($id, $data)
    {
       //$this->tableGateway->update((array)$data, ["id_cadastro_reserva_area_comum"=>(int)$id]);
       //$id = $this->tableGateway->lastInsertValue;
       //return $this->find($id);
        
        try {
            $this->tableGateway->getAdapter()->getDriver()->getConnection()->beginTransaction();
            $this->tableGateway->update((array)$data, ["id_telefone_proprietario"=>(int)$id]);
            $this->tableGateway->getAdapter()->getDriver()->getConnection()->commit();
            //$id = $this->tableGateway->getLastInsertValue();
           //print_r(tableGateway);die;
            return $id;
        } catch (\Exception $e) {
            $this->tableGateway->getAdapter()->getDriver()->getConnection()->rollback();
            return 'error';
        }
    }
    
     public function delete($id)
    {
        $result = $this->find($id);
        //print_r($result);die;
        if(!$result)
        {
            return new ApiProblem(404,'Registro não encontrado');
        }
        $this->tableGateway->delete(['id_telefone_proprietario'=>(int)$id]);
        return true;
    }

}