package list

import "fmt"

/**
 * @synopsis 线性表的链式存储实现
 * 特点：插入，删除比较快，查找需要O(n)
 */

//结点结构
type Node struct {
	data interface{}
	next *Node
}

//链表结构
type Lists struct {
	len  int
	head *Node
}

func NewLists() *Lists {
	l := &Lists{}
	l.len = 0
	l.head = nil
	return l
}

//初始化一个结点数目为n的链表
func CreateList(n int) *Lists {
	l := &Lists{}
	l.len = 0
	l.head = nil
	for i := 0; i < n; i++ {
		l.Append(i)
	}
	return l
}

func GetVal(l *Lists) {
	tmp := l.head
	for tmp.next != nil {
		fmt.Println(tmp.data)
		tmp = tmp.next
	}
	fmt.Println(tmp.data)
}

//追加元素
func (l *Lists) Append(data interface{}) {
	node := &Node{}
	node.data = data
	node.next = nil

	if l.len == 0 {
		l.head = node
	} else {
		tmp := l.head
		for tmp.next != nil {
			tmp = tmp.next
		}
		tmp.next = node
	}
	l.len++
}

//插入元素 在第i个结点后插入元素data
func (l *Lists) Insert(data interface{}, i int) {
	if l.len == 0 || l.len < i {
		l.Append(data)
		return
	}
	node := &Node{}
	node.data = data
	node.next = nil
	tmp := l.head
	for j := 0; j < i-1; j++ {
		tmp = tmp.next
	}
	node.next = tmp.next
	tmp.next = node
	l.len++
}

//从结点中查找一个data
func (l *Lists) Select(data interface{}) bool {
	if l.len == 0 {
		return false
	}
	tmp := l.head
	for tmp.next != nil {
		if tmp.data == data {
			return true
		}
		tmp = tmp.next
	}
	return false
}

//删除第i个结点
func (l *Lists) Delete(i int) {
	if l.len == 0 || l.len < i {
		return
	}
	if i == 1 {
		l.head = l.head.next
	} else if i == l.len {
		tmp := l.head
		for j := 0; j < i-1; j++ {
			tmp = tmp.next
		}
		tmp = nil
	} else {
		tmp := l.head
		for j := 0; j < i-1; j++ {
			tmp = tmp.next
		}
		tmp.next = tmp.next.next
	}
	l.len--
}
