<?php
/**
 * 一致性哈希算法
 * 传统哈希算法
 * 使用取余来计算，应用到分布式缓存中(memcache)中容错性和扩展性太差，服务器宕机或者新增会造成大量数据迁移
 * 一致性哈希算法改良：虚拟一个hash分布环，结点数n，数据量m，对n哈希取余得到的值对应于环上的某个点上，遍历结点
 * 后，每个结点在环上都有一个位置，用同样的哈希函数遍历数据m，这样数据在环上的位置也得到了确定，沿着环的顶点进
 * 行顺时针移动，将数据存储到其遇到的第一个结点的服务器。当一个结点宕了，需要迁移的数据为当前结点到其上一个结点
 * 中间位置的数据，增加结点同理。当结点过少的时候有可能会导致结点在环上的位置不均匀，导致数据存储分布不均匀，解
 * 决方式是增加虚拟结点
 */
/*
 *代码思想
 *1.将几个节点通过一个hash函数（比如crc32）分别计算出它们的hash值，比如1000，4000 *，8000，6000，并且排好序也就 *是1000,4000,6000,8000
 *2.将key也通过一个hash函数计算出它的hash值，比如1500
 *3.将这个key的hash于节点的hash逐一比较，当这个key的hash小于节点的hash，那么这个节点就是这个key所要储存的节点， *如果没有找到，那就存到第一个节点
 */
class Hash {
    private $node;
    private $virtualNode;
    public  $num;

    public function __contruct($num){
        $this->num = $num;
    }

    //虚拟结点数组 
    //标示虚拟哈希环，虚拟结点的key对应着实体结点的哈希值，val对应着实体结点
    //添加一个结点，相当于添加num个指向实体结点的虚拟结点，最后将所有虚拟结点按键排序，达到均匀分布的效果
    public function HashRing($nodes){
        foreach ($nodes as $key => $node){
            $this->AddNode($node);
        }
        ksort($this->virtualNode);
    }

    public function AddNode($node){
        $this->node[] = $node;
        for($i=0;$i<$this->num;$i++){
            $key = crc32($node.$i);
            $this->virtualNode[$key] = $node;
        }
    }

    public function GetNode($key){
        $key = crc32($key);
        foreach ($this->virtualNode as $k => $node){
            if ($key < $k){
                return $node;
            }
        }
        return $this->node[0];
    }
}

