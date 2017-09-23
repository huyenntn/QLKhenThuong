<?php
namespace User\Model;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class User
{
    public $acc;
    public $name;
    public $pass;
    protected $inputFilter;
    public function exchangeArray(array $data)
    {
        $this->acc = !empty($data['acc'])?$data['acc']:NULL;
        $this->name = !empty($data['name'])?$data['name']:NULL;
        $this->pass = !empty($data['pass'])?$data['pass']:NULL;
    }
    public function getArrayCopy()
    {
        return [
            'acc' => $this->acc,
            'name' => $this->name,
            'pass' => $this->pass
        ];
    }
    function getAcc() {
        return $this->acc;
    }

    function getName() {
        return $this->name;
    }

    function getPass() {
        return $this->pass;
    }

    function setAcc($acc) {
        $this->acc = $acc;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }
    


//     public function getInputFilter(): InputFilterInterface {
//         if (!$this->inputFilter) {
//             $inputFilter = new InputFilter();
//             $factory     = new InputFactory();
//             $inputFilter->add($factory->createInput(array(
//                 'name'     => 'acc',
//                 'required' => true,
//                 'filters'  => array(
//                     array('name' => 'StripTags'),
//                     array('name' => 'StringTrim'),
//                 ),
//                 'validators' => array(
//                     array(
//                         'name'    => 'StringLength',
//                         'options' => array(
//                             'encoding' => 'UTF-8',
//                             'min'      => 1,
//                             'max'      => 100,
//                         ),
//                     ),
//                 ),
//             )));
//             $inputFilter->add($factory->createInput(array(
//                 'name'     => 'pass',
//                 'required' => true,
//                 'filters'  => array(
//                     array('name' => 'StripTags'),
//                     array('name' => 'StringTrim'),
//                 ),
//                 'validators' => array(
//                     array(
//                         'name'    => 'StringLength',
//                         'options' => array(
//                             'encoding' => 'UTF-8',
//                             'min'      => 1,
//                             'max'      => 100,
//                         ),
//                     ),
//                 ),
//             )));
//             $this->inputFilter = $inputFilter;
//         }
//         return $this->inputFilter;
//     }

//     public function setInputFilter(InputFilterInterface $inputFilter): \Zend\InputFilter\InputFilterAwareInterface {
        
//     }

}
