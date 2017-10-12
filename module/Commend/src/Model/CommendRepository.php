<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Commend\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Predicate\Like;

/**
 * Description of CommendRepository
 *
 * @author Ngoc
 */
class CommendRepository extends AbstractTableGateway {

    public $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        return $this->tableGateway->select();
    }

    public function fetchByTypeAndYear($where1, $where2, $paginated = false) {
        if ($paginated) {
            $sql = $this->tableGateway->getSql();
            $select = $sql->select();
            $select->join(array('a' => 'subaward'), 'a.id = commend.idSubAward', array('subAwardName', 'institute'));
            $select->join(array('b' => 'subject'), 'b.idS = commend.idS', array('nameF', 'nameS'));
            $select->join(array('c' => 'award'), 'a.awardId = c.id', array('awardName'));
            $select->where(['a.institute' => $where1, 'year' => $where2]);
            $select->order(['nameS ASC', 'year DESC']);
            $adapter = new \Zend\Paginator\Adapter\DbSelect($select, $sql);
            $paginator = new \Zend\Paginator\Paginator($adapter);
            return $paginator;
        }

        $sqlSelect = $this->tableGateway->getSql()
                ->select()
                ->join(array('a' => 'subaward'), 'a.id = commend.idSubAward', array('subAwardName', 'institute'))
                ->join(array('b' => 'subject'), 'b.idS = commend.idS', array('nameF', 'nameS'))
                ->join(array('c' => 'award'), 'a.awardId = c.id', array('awardName'))
                ->where(['a.institute' => $where1, 'year' => $where2])
                ->order(['nameS ASC', 'year DESC']);
        return $this->tableGateway->selectWith($sqlSelect);
    }

    public function fetchByType($where) {
        
        $sqlSelect = $this->tableGateway->getSql()
                ->select()
                ->join(array('a' => 'subaward'), 'a.id = commend.idSubAward', array('subAwardName', 'institute'))
                ->join(array('b' => 'subject'), 'b.idS = commend.idS', array('nameF', 'nameS'))
                ->join(array('c' => 'award'), 'a.awardId = c.id', array('awardName'))
                ->where(['a.institute' => $where])
                ->order(['nameS ASC', 'year DESC']);
        return $this->tableGateway->selectWith($sqlSelect);
    }

    public function fetchByTypeAndSubAward($where1, $where2, $paginated = false) {
        if ($paginated) {
            $sql = $this->tableGateway->getSql();
            $select = $sql->select();
            $select->join(array('a' => 'subaward'), 'a.id = commend.idSubAward', array('subAwardName', 'institute'));
            $select->join(array('b' => 'subject'), 'b.idS = commend.idS', array('nameF', 'nameS'));
            $select->join(array('c' => 'award'), 'a.awardId = c.id', array('awardName'));
            $select->where(['a.institute' => $where1, 'idSubAward' => $where2]);
            $select->order(['nameS ASC', 'year DESC']);
            $adapter = new \Zend\Paginator\Adapter\DbSelect($select, $sql);
            $paginator = new \Zend\Paginator\Paginator($adapter);
            return $paginator;
        }

        $sqlSelect = $this->tableGateway->getSql()
                ->select()
                ->join(array('a' => 'subaward'), 'a.id = commend.idSubAward', array('subAwardName', 'institute'))
                ->join(array('b' => 'subject'), 'b.idS = commend.idS', array('nameF', 'nameS'))
                ->join(array('c' => 'award'), 'a.awardId = c.id', array('awardName'))
                ->where(['a.institute' => $where1, 'idSubAward' => $where2])
                ->order(['nameS ASC', 'year DESC']);
        return $this->tableGateway->selectWith($sqlSelect);
    }

    public function fetchByTypeSubAwardYear($where1, $where2, $where3, $paginated = false) {
        if ($paginated) {
            $sql = $this->tableGateway->getSql();
            $select = $sql->select();
            $select->join(array('a' => 'subaward'), 'a.id = commend.idSubAward', array('subAwardName', 'institute'));
            $select->join(array('b' => 'subject'), 'b.idS = commend.idS', array('nameF', 'nameS'));
            $select->join(array('c' => 'award'), 'a.awardId = c.id', array('awardName'));
            $select->where(['a.institute' => $where1, 'idSubAward' => $where2, 'year' => $where3]);
            $select->order(['nameS ASC', 'year DESC']);
            $adapter = new \Zend\Paginator\Adapter\DbSelect($select, $sql);
            $paginator = new \Zend\Paginator\Paginator($adapter);
            return $paginator;
        }

        $sqlSelect = $this->tableGateway->getSql()
                ->select()
                ->join(array('a' => 'subaward'), 'a.id = commend.idSubAward', array('subAwardName', 'institute'))
                ->join(array('b' => 'subject'), 'b.idS = commend.idS', array('nameF', 'nameS'))
                ->join(array('c' => 'award'), 'a.awardId = c.id', array('awardName'))
                ->where(['a.institute' => $where1, 'idSubAward' => $where2, 'year' => $where3])
                ->order(['nameS ASC', 'year DESC']);
        return $this->tableGateway->selectWith($sqlSelect);
    }

    public function getRow($id) {
        $sqlSelect = $this->tableGateway->getSql()
                ->select()
                ->join(array('a' => 'subaward'), 'a.id = commend.idSubAward', array('subAwardName', 'institute'))
                ->join(array('b' => 'subject'), 'b.idS = commend.idS', array('nameF', 'nameS'))
                ->join(array('c' => 'award'), 'a.awardId = c.id', array('awardName'))
                ->where(['idCmd' => $id]);
        $rowset = $this->tableGateway->selectWith($sqlSelect);
        $row = $rowset->current();
        if (!$row) {
            throw new RuntimeException(\sprintf(
                    'Could not find row with identifier %d', $id
            ));
        }
        return $row;
    }

    public function saveRow(Commend $commend) {
        $data = [
            'idS' => $commend->idS,
            'idSubAward' => $commend->idSubAward,
            'year' => $commend->year,
        ];
        if ($commend->idCmd) {
            $this->tableGateway->update($data, [
                'idCmd' => $commend->idCmd
            ]);
        } else {
            $this->tableGateway->insert($data);
//            return $this->getUser($user->id);
        }
    }

    public function delete($id) {
        return $this->tableGateway->delete(['idCmd' => $id]);
    }

    public function JoinfetchAll() {
        $sqlSelect = $this->tableGateway->getSql()
                ->select()
                ->join(array('a' => 'subaward'), 'a.id = commend.idSubAward', array('subAwardName', 'institute'))
                ->join(array('b' => 'subject'), 'b.idS = commend.idS', array('nameF', 'nameS'))
                ->join(array('c' => 'award'), 'a.awardId = c.id', array('awardName'));
        return $this->tableGateway->selectWith($sqlSelect);
    }

    public function getListYear() {
        $sqlSelect = $this->tableGateway->getSql()
                ->select()
                ->columns(array('year'))
                ->group('year')
                ->order('year ASC');

        return $this->tableGateway->selectWith($sqlSelect);
    }

    public function getDetail($where) {
        $sqlSelect = $this->tableGateway->getSql()
                ->select()
                ->join(array('a' => 'subaward'), 'a.id = commend.idSubAward', array('subAwardName', 'institute'))
                ->join(array('b' => 'subject'), 'b.idS = commend.idS', array('nameF', 'nameS'))
                ->join(array('c' => 'award'), 'a.awardId = c.id', array('awardName'))
                ->where(['commend.idS' => $where])
                ->order('year DESC');
        return $this->tableGateway->selectWith($sqlSelect);
    }

    public function searchByName($like) {
        $where = new \Zend\Db\Sql\Where();
        $where->addPredicate(new Like('nameF', '%'.$like.'%'))->orPredicate(new Like('nameS', '%'.$like.'%'));
        $sqlSelect = $this->tableGateway->getSql()
                ->select()
                ->join(array('a' => 'subaward'), 'a.id = commend.idSubAward', array('subAwardName', 'institute'))
                ->join(array('b' => 'subject'), 'b.idS = commend.idS', array('nameF', 'nameS'))
                ->join(array('c' => 'award'), 'a.awardId = c.id', array('awardName'))
                ->where($where);
        return $this->tableGateway->selectWith($sqlSelect);
    }

}
