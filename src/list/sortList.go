package list

import (
	"errors"
	"fmt"
)

/**
 * @synopsis 线性表的顺序存储实现
 * 特点：固定长度，内存为整块地址，连续。需要两个属性，1申请定长的数组2线性表长度代表当前元素个数
 * 1.说白了就是数组
 * 2.查询就O(1)
 * 3.插入，删除就O(n)
 */

const (
	MAX = 20
)

type List struct {
	data [MAX]int //顺序存储线性表
	len  int      //当前数据个数
}

//初始化一个顺序存储的线性表
func NewList() *List {
	l := &List{}
	l.initList()
	return l
}

func (l *List) initList() {
	for i := 0; i < MAX; i++ {
		l.data[i] = i
	}
	l.len = MAX
}

//删除data[pos]
func (l *List) Del(pos int) error {
	if pos > l.len-1 || pos < 0 {
		return errors.New("无元素可删除，操作失败！")
	}
	for i := pos; i < l.len-1; i++ {
		l.data[i] = l.data[i+1]
	}
	l.data[l.len-1] = 0
	l.len -= 1
	return errors.New("删除成功！")
}

//在data[pos]之后插入元素val
func (l *List) Insert(pos, val int) error {
	if l.len == MAX {
		return errors.New("当前线性表已满，插入失败！")
	}
	for i := l.len - 1; i > pos; i-- {
		l.data[i+1] = l.data[i]
	}
	l.data[pos+1] = val
	l.len += 1
	return errors.New("插入成功")
}

//测试demo
func Testdemo() {
	fmt.Println("test demo")
}
