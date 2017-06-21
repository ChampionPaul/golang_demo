package list

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

//追加元素
func (l *Lists) Append(data interface{}) *Lists {
	n := &Node{}
	n.data = data
	n.next = nil

	if l.head == nil {
		l.head = n
	} else {
		tmp := l.head
		for tmp.next != nil {
			tmp = tmp.next
		}
		tmp.next = n
	}
	l.len++
	return l
}
