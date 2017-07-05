package list

/*
 * 队列的实现:只允许在头删除结点，在尾部追加结点，先入先出，使用头尾两个指针维护队列
 */

type QNode struct {
	data interface{}
	next *QNode
}

type Queue struct {
	front *QNode
	rear  *QNode
}

func NewQueue(num int) {
	q := &Queue{}
	q.front = nil
	q.rear = nil
}

func (q *Queue) Append(data interface{}) {
	node := &QNode{}
	node.data = data
	node.next = nil
	q.rear.next = node
	q.rear = node
}

func (q *Queue) Delete(data interface{}) interface{} {
	if q.front == nil || q.rear == nil {
		return false
	}
	if q.front == q.rear {
		q.front = nil
		q.rear = nil
	}
	tmp := q.front.next
	data := q.front.data
	q.front = tmp
	return data
}
