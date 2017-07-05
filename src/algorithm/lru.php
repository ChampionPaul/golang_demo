<?php

class Node {

    private $key;
    private $data;
    private $next;
    private $pre;

    function __contruct($key, $data){
        $this->key = $key;
        $this->data = $data;
    }

    public function setData($data){
        $this->data = $data;
    }
    public function getData(){
        return $this->data;
    }

    public function setKey($key){
        $this->key = $key;
    }
    public function getKey(){
        return $this->key;
    }

    public function setNext($next){
        $this->next = $next;
    }
    public function getNext(){
        return $this->next;
    }

    public function setPre($pre){
        $this->pre = $pre;
    }
    public function getPre(){
        return $this->pre;
    }
}

class LRU {
    private $head;
    private $tail;
    private $capacity;
    private $hashmap;

    public function __construct($capacity){
        $this->capacity = $capacity;
        $hashmap = array();
        $this->head = new Node(null,null);
        $this->tail = new Node(null,null);

        $this->head->setNext($this->tail);
        $this->tail->setPre($this->head);
    }

    public function get($key){
        //通过key寻找data,如果没找到，拉倒，如果找到了返回data，并且把该结点移动到头部
        if (!isset($this->hashmap[$key])){
            return null;
        }
        $node = $this->hashmap[$key];
        if (count($this->hashmap()) == 1){
            return $node->getData();
        }
        $this->detach($node);
        $this->attach($this->head, $node);
        return $node->getData();
    }

    public function set($key, $data){
        if ($this->capacity <= 0 ) { 
            return null;
        }
        //两种情况
        //1:key存在，将该结点的data替换，并将结点移动到头部
        if (isset($this->hashmap[$key])) {
            $node = $this->hashmap[$key];
            $node->setData($data);
            $this->detach($node);
            $this->attach($this->head, $node);
        } else {
        //2:key不存在，创建新结点，插入到头部, 填充到hashmap,如果加入结点后，hashmap超过了规定阈值，删掉尾结点
            $this->hashmap[$key] = $node;
            $node = new Node();
            $node->setKey($key);
            $node->setData($data);
            $this->attach($this->head, $node);
            if (count($this->hashmap) > $this->capacity) {
                $this->detach($this->tail->getPre());
                unset($this->hashmap[$this->tail->getPre()->getKey()]);
            }
        }
        return true;
    }

    private function attach($head, $node){
        $node->setPre($head);
        $node->setNext($head->getNext());
        $head->getNext()->setPre($node);
        $head->setNext($node);
    }

    private function detach($node){
        $node->getPre()->setNext($node->getNext());
        $node->getNext()->setPre($node->getPre());
    }

}





