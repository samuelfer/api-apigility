<?php
namespace SindicoAmigo\V1\Rest\Modeloveiculo;

use Zend\Hydrator\ObjectProperty;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class ModeloveiculoResource extends AbstractResourceListener
{
     
    private $repository;
    
    public function __construct(ModeloveiculoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $hydrator = new ObjectProperty();
        $dataModeloveiculo = $hydrator->extract($data);
        $result = $this->repository->create($dataModeloveiculo);
        //Se der algum erro retorna a mensagem
        if($result == "error"){
            return new ApiProblem(500, 'Error ao tentar cadastrar!');
        }
        return $result;
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        //$userRole = $this->repository->findByUsername($this->getIdentity()->getRoleId());
        //if($userRole!="admin")
        //{
           // return new ApiProblem(403, 'You are not an admin. Your are an :'.$userRole);
        //}
        //print_r($id);die;
        return $this ->repository->delete($id);
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id_modelo_veiculo)
    {
        return $this->repository->find($id_modelo_veiculo);
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        return $this->repository->findAll();
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
         $result = $this->repository->update($id, $data);
        
        if($result=="error"){
            return new ApiProblem(500, 'Error');
        }
        return $result;
    }
}
